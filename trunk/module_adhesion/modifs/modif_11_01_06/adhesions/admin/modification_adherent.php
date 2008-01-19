<?

/**************************************************************************************************/
/* Module de gestion des adhérents d'une association pour NPDS version 5.0 P1 Runner              */
/* ===============================================================================================*/
/*                                                                                                */
/* This program is free software. You can redistribute it and/or modify it under the terms of     */
/* the GNU General Public License as published by the Free Software Foundation; either version 2  */
/* of the License.                                                                                */
/**************************************************************************************************/

/**************************************************************************************************/
/* Page de confirmation de modification/ajoût des données d'un adhérent												          */
/**************************************************************************************************/

/***********************************
* 2 cas possibles : 
* - ActionForm = 1 : mise à jour des données de l'utilisateur
* - ActionForm = 2 : insertion des données pour un nouvel utlisateur
***********************************/

	if (isset($_POST["ActionForm"])) {
		//on fait le contrôle des données
		$controle = controle_data_adherent($_POST["statut"],$_POST["adh_id"]);
		switch ($controle){
			case 1:// cas où on peut faire la mise à jour / ajout des données
				$resultat = maj_donnee();
				$affichage = affichage($resultat);
				break;
			case 2: // cas où on peut faire la mise à jour / ajout des données
					// et de plus l'adhérent recevra un mail de confirmation
				$resultat = maj_donnee();
				if ($resultat >0){
					$affichage = envoi_mail($_POST["adh_id"]);
				}
				$affichage .= affichage($resultat);
				break;
			case 3:// cas où l'adhérent n'a pas de cotisation déjà présente dans la BDD
				$affichage = "<br><div class=\"ROUGE\">L'adhérent ne peut être validé que s'il a déjà cotisé.</div>";
				$affichage .="<br>Entrer d'abord la cotisation de l'adhérent avant de le passer en statut 'validé'<br>";
				$affichage .= "<br><input type=\"button\" value=\"Retour\" CLASS=\"BOUTON_STANDARD\" onClick=\"javascript:history.back(-1)\">";
				break;
			default;
				//Debug
				echo '<br> action defaut';
				break;
		}
?>

<table width="100%" border="0" cellspacing="1" cellpadding="6" bgcolor="#C2D7EB">
	<tr>
		<td>
			<center>
			<? echo  $affichage ?>
			</center>
			<BR>
		</td>
	</tr>
</table>

<?
	}else{
		// Cas où $_POST["ActionForm"] n'est pas défini
		// --> on ne fait rien
	}
	
/*********
* Fonction permettant de contrôler les données de l'adhérent avant de les rentrer/modifier dans la BDD
* renvoie un code d'erreur
*	1- le contrôle est ok la mise à jour peut être faite
*	2- le contrôle est ok la mise à jour peut être faite et l'adhérent recevra un mail
*	3- l'adhérent n'a pas encore cotisé, le passage en statut 'validé' n'est pas possible
**********/
function controle_data_adherent($new_statut,$adh_id){
	// cas où le statut rentré est 1 (adhérent validé)
	if ($new_statut == 1){
		//D'abord on vérifie dans la BDD que c'est bien un changement de statut
		$sql_sta  = 'SELECT `adh_statut` FROM `adhesion_adherents` where `adh_id` = '.$adh_id;
		$result_sta = mysql_query ($sql_sta);
		list($statut_bdd)=mysql_fetch_row($result_sta);
		mysql_free_result($result_sta);
		if ($statut_bdd==1){
			//Cas où l'adhérent était déjà validé dans la bdd
			//--> on n'a pas besoin de recontrôler quoique ce soit la mise à jour peut se faire
			return 1;
		}else{
			//Cas où l'adhérent change de statut pous passer en validé
			//--> on vérifie que sa cotisation existe déjà en base
			$sql_cot = 'SELECT `cot_id` FROM `adhesion_cotisations` where `cot_adh_id` = '.$adh_id;
			$result_cot = mysql_query ($sql_cot);
			if (mysql_num_rows($result_cot) > 0){
				// il existe au moins une cotisation pour cet adhérent dans la BDD donc 
				// l'adhérent peut être validé et de plus il change de statut donc il
				// recevra un mail l'en informant
				return 2;
			}else{
				// il n'existe pas de  cotisation pour cet adhérent dans la base donc 
				// l'adhérent ne peut pas être validé
				return 3;
			}
			mysql_free_result($result_cot);
		}
	}else{
		// Cas où l'adhérent aura un autre statut que 'validé 
		// --> aucun contrôle à faire donc la mise à jour peut être faite
		return 1;
	}
}

// fonction qui permet de définir $affichage , la string qui représente le message de confirmation 
// de mise à jour des données
function affichage($resultat){
	if ($resultat>0){
		$message =  $resultat ." Enregistrement(s) Modifié(s) avec succès";
		$message .= "<br><br>";
		$message .= "<a href=\"admin.php?op=Extend-Admin-SubModule&ModPath=adhesions&ModStart=admin/admin_adhesion&choix=Adherents\">";
		$message .= "<input type=\"button\" value=\"Retour\" CLASS=\"BOUTON_STANDARD\" onClick=\"javascript:history.back(-1)\">";
		$message .= "</a>";
	}else{
		if ($resultat==-1){
			$message = "<br><div class=\"ROUGE\">Une erreur s'est produite lors de la modification de l'enregistrement : </div>";
			$message .= "<br>Veuillez noter le message d'erreur ci dessous et prendre contact avec le webmaster<br>";
			$message .= "<br>Erreur SQL : <b>".mysql_error()."</b><br>";
			$message .= "<br><input type=\"button\" value=\"Retour\" CLASS=\"BOUTON_STANDARD\" onClick=\"javascript:history.back(-1)\">";
			}
		else {
			$message =  "Aucun enregistrement Modifié";
			$message .= "<br><br>";
			$message .= "<br><input type=\"button\" value=\"Retour\" CLASS=\"BOUTON_STANDARD\" onClick=\"javascript:history.back(-1)\">";
		}
	}
	return $message;
}

// Fonction de mise à jour des données à proprement parler
function maj_donnee(){
	    if ($_POST["ActionForm"]==1){
			$sql = "UPDATE `adhesion_adherents` "
						."SET `adh_adresse` = '".$_POST["address"]."' "
						.",`adh_nom` = '".$_POST["name"]."' "
						.",`adh_prenom` = '".$_POST["firstname"]."' "
						.",`adh_code_postal` = '".$_POST["postal_code"]."' "
						.",`adh_ville` = '".$_POST["city"]."' "
						.",`adh_pays` = '".$_POST["country"]."' "
						.",`adh_email` = '".$_POST["email"]."' "
						.",`adh_equipe` = '".$_POST["team"]."' "
						.",`adh_statut` = '".$_POST["statut"]."' "
						.",`adh_sexe` = '".$_POST["sexe"]."' "
						.",`adh_telephone_fixe` = '".$_POST["telephone_fixe"]."' "
						.",`adh_telephone_portable` = '".$_POST["telephone_portable"]."' "
						.",`adh_date_naissance` = '".$_POST["date_naiss_annee"]."-".$_POST["date_naiss_mois"]."-".$_POST["date_naiss_jour"]."' "
						."WHERE `adh_id` = '".$_POST["adh_id"]."'";
		}else{
			//Détermination préalable du pseudo du user
			$pseudo = deter_pseudo($_POST["adh_id"]);
			
			$sql = "INSERT INTO `adhesion_adherents` "
				."( `adh_id`, 
					`adh_nom`, 
					`adh_prenom`, 
					`adh_adresse`, 
					`adh_code_postal`, 
					`adh_ville`, 
					`adh_pays`, 
					`adh_sexe`, 
					`adh_email`, 
					`adh_pseudo`, 
					`adh_equipe`, 
					`adh_statut`, 
					`adh_date_naissance`, 
					`adh_telephone_fixe`, 
					`adh_telephone_portable`) "
	        	. " VALUES ( '".$_POST["adh_id"]."', "
				."'".$_POST["name"]."', "
				."'".$_POST["firstname"]."', "
				."'".$_POST["address"]."', "
				."'".$_POST["postal_code"]."', "
				."'".$_POST["city"]."', "
				."'".$_POST["country"]."', "
				."'".$_POST["sexe"]."', "
				."'".$_POST["email"]."', "
				."'".$pseudo."', "
				."'".$_POST["team"]."', "
				."'".$_POST["statut"]."', "
				."'".$_POST["date_naiss_annee"]."-".$_POST["date_naiss_mois"]."-".$_POST["date_naiss_jour"]."', "
				."'".$_POST["telephone_fixe"]."', "
				."'".$_POST["telephone_portable"]."' )";
		}
		$resultat = mysql_query ($sql);
		$nb_row = mysql_affected_rows();
		//Debug
		//echo '<br>$sql : '.$sql.'<br>';
		//echo '<br>$nb_row : '.$nb_row.'<br>';
		return $nb_row;
}

// fonction permettant de remplir correctement le corps du mail
// puis de l'envoyer
// retourne le message à afficher
function envoi_mail($adh_id){
		//Définition des paramètres pour l'envoi du mail
		$destinataire = $_POST["email"];
		$sujet = "Validation de l'insciption à la cassosiation";
		//Détermination préalable du pseudo du user
		$pseudo = deter_pseudo($_POST["adh_id"]);
		//récupération du montant cotisé
		$sql_mont = ' SELECT `cot_montant` FROM `adhesion_cotisations` where `cot_adh_id` ='.$adh_id;
		$result_mont = mysql_query ($sql_mont);
		list($montant) = mysql_fetch_row($result_mont);
		mysql_free_result($result_mont);

//Corps du texte
//  /!\ NE PAS TOUCHER AUX ESPACES ET TABULATION!!! /!\
$message = 'Bonjour '.$_POST["firstname"].',

Ton adhésion à la Cassosiation vient d\'être validée. 
Tu vas bientôt pouvoir bénéficier de tes droits dans le cadre du projet communautaire Fun eXperience. 
A ce propos, quelques rappels importants:
- Tu as accepté d\'adhérer au projet avec tout ce qu\'il comporte de règles de vie et d\'obligations, notamment toutes celles relatées dans les différentes chartes que tu as approuvées lors de ton inscription
- Tu t\'es engagé à respecter toutes ces règles, mais aussi à participer à la vie de la communauté
- Tu as participé à hauteur de '.$montant.' euros à la cotisation annuelle des '.$_POST["team"].', définie à 650€ pour cette session 2005

Tu t\'es égalementent engagé à nous faire parvenir toutes les coordonnées nécessaires à 
l\'établissement de tes droits et à la régularisation de notre association d\'un point de vue légal.
Voici un résumé de tes coordonnées:
	- référence joueur:
		équipe/catégorie : '.$_POST["team"].'
		pseudo :  '.$pseudo.'
		email : '.$_POST["email"].'
		
	- coordonnées :
		'.$_POST["name"].' '.$_POST["firstname"].'
		'.$_POST["date_naiss_annee"].'-'.$_POST["date_naiss_mois"].'-'.$_POST["date_naiss_jour"].'
		'.$_POST["address"].'
		'.$_POST["postal_code"].' '.$_POST["city"].'
		'.$_POST["telephone_fixe"].' / '.$_POST["telephone_portable"].'

Si tes coordonnées ne sont pas à jour ou éronnées, tu peux les modifier en cliquant sur le lien suivant :
- http://cassosiation.verygames.net/npds/modules.php?ModPath=adhesions&ModStart=adhesion_formulaire
Tu peux contacter le bureau en cas de problêmes:
- Site web: http://www.funxp.tk
- Irc: #fun.eXperience (réseau quakenet)
- Irc via le site web: http://cassosiation.verygames.net/npds/modules.php?ModPath=chatterbox&ModStart=chat
- Mail: cassosiation@verygames.net
- Forum: http://cassosiation.verygames.net/npds/modules.php?ModPath=phpBB2&ModStart=index
	

Have Fun !.... eXperience ;)';

		//Envoi du mail
		$mail_sent = send_email($destinataire, $sujet, $message);
		if ($mail_sent){
			$confirmation = '<br><b>Mail envoyé</b><br>';
		}else{
			$confirmation = '<br><div class=\"ROUGE\">Problème lors de l\'envoi du mail</div><br>';
		}
		return $confirmation;
}

/**********************************************
*	fonctino permettant de récupérer le pseudo
*	en prenant comme argument son adh_id
***********************************************/
function deter_pseudo($adh_id){
	//Détermination préalable du pseudo du user
	$presql = 'select  `uname` FROM `users` where `uid`='.$adh_id;
	$preresultat = mysql_query ($presql);
	list($pseudo)=mysql_fetch_row($preresultat);
	mysql_free_result($preresultat);
	return $pseudo;
}
?>

