<?

/**************************************************************************************************/
/* Module de gestion des adh�rents d'une association pour NPDS version 5.0 P1 Runner              */
/* ===============================================================================================*/
/*                                                                                                */
/* This program is free software. You can redistribute it and/or modify it under the terms of     */
/* the GNU General Public License as published by the Free Software Foundation; either version 2  */
/* of the License.                                                                                */
/**************************************************************************************************/

/**************************************************************************************************/
/* Page de confirmation de modification/ajo�t des donn�es d'un adh�rent												          */
/**************************************************************************************************/

/***********************************
* 2 cas possibles : 
* - ActionForm = 1 : mise � jour des donn�es de l'utilisateur
* - ActionForm = 2 : insertion des donn�es pour un nouvel utlisateur
***********************************/

	if (isset($_POST["ActionForm"])) {
		//on fait le contr�le des donn�es
		$controle = controle_data_adherent($_POST["statut"],$_POST["adh_id"]);
		switch ($controle){
			case 1:// cas o� on peut faire la mise � jour / ajout des donn�es
				$resultat = maj_donnee();
				$affichage = affichage($resultat);
				break;
			case 2: // cas o� on peut faire la mise � jour / ajout des donn�es
					// et de plus l'adh�rent recevra un mail de confirmation
				$resultat = maj_donnee();
				if ($resultat >0){
					$affichage = envoi_mail($_POST["adh_id"]);
				}
				$affichage .= affichage($resultat);
				break;
			case 3:// cas o� l'adh�rent n'a pas de cotisation d�j� pr�sente dans la BDD
				$affichage = "<br><div class=\"ROUGE\">L'adh�rent ne peut �tre valid� que s'il a d�j� cotis�.</div>";
				$affichage .="<br>Entrer d'abord la cotisation de l'adh�rent avant de le passer en statut 'valid�'<br>";
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
		// Cas o� $_POST["ActionForm"] n'est pas d�fini
		// --> on ne fait rien
	}
	
/*********
* Fonction permettant de contr�ler les donn�es de l'adh�rent avant de les rentrer/modifier dans la BDD
* renvoie un code d'erreur
*	1- le contr�le est ok la mise � jour peut �tre faite
*	2- le contr�le est ok la mise � jour peut �tre faite et l'adh�rent recevra un mail
*	3- l'adh�rent n'a pas encore cotis�, le passage en statut 'valid�' n'est pas possible
**********/
function controle_data_adherent($new_statut,$adh_id){
	// cas o� le statut rentr� est 1 (adh�rent valid�)
	if ($new_statut == 1){
		//D'abord on v�rifie dans la BDD que c'est bien un changement de statut
		$sql_sta  = 'SELECT `adh_statut` FROM `adhesion_adherents` where `adh_id` = '.$adh_id;
		$result_sta = mysql_query ($sql_sta);
		list($statut_bdd)=mysql_fetch_row($result_sta);
		mysql_free_result($result_sta);
		if ($statut_bdd==1){
			//Cas o� l'adh�rent �tait d�j� valid� dans la bdd
			//--> on n'a pas besoin de recontr�ler quoique ce soit la mise � jour peut se faire
			return 1;
		}else{
			//Cas o� l'adh�rent change de statut pous passer en valid�
			//--> on v�rifie que sa cotisation existe d�j� en base
			$sql_cot = 'SELECT `cot_id` FROM `adhesion_cotisations` where `cot_adh_id` = '.$adh_id;
			$result_cot = mysql_query ($sql_cot);
			if (mysql_num_rows($result_cot) > 0){
				// il existe au moins une cotisation pour cet adh�rent dans la BDD donc 
				// l'adh�rent peut �tre valid� et de plus il change de statut donc il
				// recevra un mail l'en informant
				return 2;
			}else{
				// il n'existe pas de  cotisation pour cet adh�rent dans la base donc 
				// l'adh�rent ne peut pas �tre valid�
				return 3;
			}
			mysql_free_result($result_cot);
		}
	}else{
		// Cas o� l'adh�rent aura un autre statut que 'valid� 
		// --> aucun contr�le � faire donc la mise � jour peut �tre faite
		return 1;
	}
}

// fonction qui permet de d�finir $affichage , la string qui repr�sente le message de confirmation 
// de mise � jour des donn�es
function affichage($resultat){
	if ($resultat>0){
		$message =  $resultat ." Enregistrement(s) Modifi�(s) avec succ�s";
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
			$message =  "Aucun enregistrement Modifi�";
			$message .= "<br><br>";
			$message .= "<br><input type=\"button\" value=\"Retour\" CLASS=\"BOUTON_STANDARD\" onClick=\"javascript:history.back(-1)\">";
		}
	}
	return $message;
}

// Fonction de mise � jour des donn�es � proprement parler
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
			//D�termination pr�alable du pseudo du user
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
// retourne le message � afficher
function envoi_mail($adh_id){
		//D�finition des param�tres pour l'envoi du mail
		$destinataire = $_POST["email"];
		$sujet = "Validation de l'insciption � la cassosiation";
		//D�termination pr�alable du pseudo du user
		$pseudo = deter_pseudo($_POST["adh_id"]);
		//r�cup�ration du montant cotis�
		$sql_mont = ' SELECT `cot_montant` FROM `adhesion_cotisations` where `cot_adh_id` ='.$adh_id;
		$result_mont = mysql_query ($sql_mont);
		list($montant) = mysql_fetch_row($result_mont);
		mysql_free_result($result_mont);

//Corps du texte
//  /!\ NE PAS TOUCHER AUX ESPACES ET TABULATION!!! /!\
$message = 'Bonjour '.$_POST["firstname"].',

Ton adh�sion � la Cassosiation vient d\'�tre valid�e. 
Tu vas bient�t pouvoir b�n�ficier de tes droits dans le cadre du projet communautaire Fun eXperience. 
A ce propos, quelques rappels importants:
- Tu as accept� d\'adh�rer au projet avec tout ce qu\'il comporte de r�gles de vie et d\'obligations, notamment toutes celles relat�es dans les diff�rentes chartes que tu as approuv�es lors de ton inscription
- Tu t\'es engag� � respecter toutes ces r�gles, mais aussi � participer � la vie de la communaut�
- Tu as particip� � hauteur de '.$montant.' euros � la cotisation annuelle des '.$_POST["team"].', d�finie � 650� pour cette session 2005

Tu t\'es �galementent engag� � nous faire parvenir toutes les coordonn�es n�cessaires � 
l\'�tablissement de tes droits et � la r�gularisation de notre association d\'un point de vue l�gal.
Voici un r�sum� de tes coordonn�es:
	- r�f�rence joueur:
		�quipe/cat�gorie : '.$_POST["team"].'
		pseudo :  '.$pseudo.'
		email : '.$_POST["email"].'
		
	- coordonn�es :
		'.$_POST["name"].' '.$_POST["firstname"].'
		'.$_POST["date_naiss_annee"].'-'.$_POST["date_naiss_mois"].'-'.$_POST["date_naiss_jour"].'
		'.$_POST["address"].'
		'.$_POST["postal_code"].' '.$_POST["city"].'
		'.$_POST["telephone_fixe"].' / '.$_POST["telephone_portable"].'

Si tes coordonn�es ne sont pas � jour ou �ronn�es, tu peux les modifier en cliquant sur le lien suivant :
- http://cassosiation.verygames.net/npds/modules.php?ModPath=adhesions&ModStart=adhesion_formulaire
Tu peux contacter le bureau en cas de probl�mes:
- Site web: http://www.funxp.tk
- Irc: #fun.eXperience (r�seau quakenet)
- Irc via le site web: http://cassosiation.verygames.net/npds/modules.php?ModPath=chatterbox&ModStart=chat
- Mail: cassosiation@verygames.net
- Forum: http://cassosiation.verygames.net/npds/modules.php?ModPath=phpBB2&ModStart=index
	

Have Fun !.... eXperience ;)';

		//Envoi du mail
		$mail_sent = send_email($destinataire, $sujet, $message);
		if ($mail_sent){
			$confirmation = '<br><b>Mail envoy�</b><br>';
		}else{
			$confirmation = '<br><div class=\"ROUGE\">Probl�me lors de l\'envoi du mail</div><br>';
		}
		return $confirmation;
}

/**********************************************
*	fonctino permettant de r�cup�rer le pseudo
*	en prenant comme argument son adh_id
***********************************************/
function deter_pseudo($adh_id){
	//D�termination pr�alable du pseudo du user
	$presql = 'select  `uname` FROM `users` where `uid`='.$adh_id;
	$preresultat = mysql_query ($presql);
	list($pseudo)=mysql_fetch_row($preresultat);
	mysql_free_result($preresultat);
	return $pseudo;
}
?>

