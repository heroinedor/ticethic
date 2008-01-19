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
/* Formulaire de demande d'adhésion consultable par les utilisateurs                              */
/*********************************************************()*****************************************/
	
	global $adhesion_path;
	//config maison
	//$adhesion_path = "F:\\riquet_decembre_2004\KSOS\cassosiation\\";
	//config verygames
	$adhesion_path = $_SERVER["DOCUMENT_ROOT"];
	if (!isset($mainfile)) { include_once("mainfile.php"); }
	include_once($adhesion_path."npds/header.php");

	//Balisage du début du code du module dans les sources HTML
	echo "\n<!-- Début du code généré par le module de Adhesion  -->";
	OpenTable();

	//Récupération de l'entête d'affichage
	$sql_ent = "SELECT `valeur` FROM `adhesion_config_tab` WHERE `parametre`='cfg_txt_accueil'";
	$result_ent = mysql_query ($sql_ent);
	list($presentation['cfg_textaccueil']) = mysql_fetch_array($result_ent);
  
	//Récupération des données utilisateur
	$user_info = getusrinfo($user);
	if ($user_info['uid']){
			$sql = "SELECT * FROM `adhesion_adherents` WHERE `adh_id`='".$user_info['uid']."'";
			$resultat = mysql_query ($sql);
			//Cas où l'utilisateur a déjà envoyé une demande d'adhésion
			if (mysql_num_rows($resultat)>0){
				while ($row = mysql_fetch_array($resultat)){
				$user_info['uname'] = $row['adh_pseudo'];
				$user_info['nom'] = $row['adh_nom'];
				$user_info['name'] = $row['adh_prenom'];
				$user_info['adresse'] = $row['adh_adresse'];
				$user_info['code_postal'] = $row['adh_code_postal'];
				$user_info['user_from'] = $row['adh_ville'];
				$user_info['pays'] = $row['adh_pays'];
				$user_info['telephone_fixe'] = $row['adh_telephone_fixe'];
				$user_info['telephone_portable'] = $row['adh_telephone_portable'];
				$user_info['date_naissance'] = $row['adh_date_naissance'];
				$user_info['sexe'] = $row['adh_sexe'];
				$user_info['email'] = $row['adh_email'];
				$user_info['equipe'] = $row['adh_equipe'];
				$user_info['statut'] = $row['adh_statut'];
				}
				$presentation['action_form']= "modules.php?ModPath=adhesions&ModStart=confirmation_adhesion&ActionForm=1";
			}
			//Cas où l'utilisateur n'a pas encore fait sa demande
			else{
				$user_info['nom'] = "";
				$user_info['adresse'] = "";
				$user_info['code_postal'] = "";
				$user_info['pays'] = "";
				$user_info['telephone_fixe'] = "";
				$user_info['telephone_portable'] = "";
				$user_info['date_naissance'] ="";
				$user_info['sexe'] = "";
				$user_info['equipe'] = "";
				$user_info['statut'] = "2";
				$presentation['action_form']= "modules.php?ModPath=adhesions&ModStart=confirmation_adhesion&ActionForm=2";
			}
			mysql_free_result($resultat);

		  //debug
		  	/*
		  	echo '<br>$sql ='.$sql.'<br>';
			echo "<table>";
		    foreach ($user_info as $key => $value) {
		      echo "<tr><td>Clé: $key; </td><td>Valeur: $value</td></tr>\n";
		    }
			echo "</table>";*/

			//Enregistrement des données

		?>
		<SCRIPT LANGUAGE="JavaScript">
		function Valider(formF){
			//Vérification du nom
			if (formF.name.value == ''){
			    alert("Vous devez fournir un nom");
			    return false;
			}
			//Vérification du prénom
			if (formF.firstname.value == ''){
			    alert("Vous devez fournir un prénom");
			    return false;
			}
			//Vérification de l'adresse
			if (formF.address.value == ''){
			    alert("Vous devez fournir une adresse de résidence");
			    return false;
			}
			//Vérification de la ville
			if (formF.city.value == ''){
			    alert("Vous devez fournir une ville de résidence");
			    return false;
			}
			//Vérification du pays
			if (formF.country.value == ''){
			    alert("Vous devez fournir un pays de résidence");
			    return false;
			}
			//Vérification de la date de naissance
			var dateForm = formF.date_naiss_jour.value+'/'+
							formF.date_naiss_mois.value+'/'+
							formF.date_naiss_annee.value;
		    //alert("dateForm = "+dateForm);
			if (!CheckDate(dateForm)){
		    	return false;
			}
			//Vérification du mail
			if (!verifiermail(formF.email.value)){
		    	return false;
			}
			//Vérification de la case conditions d'incirption cochée
			if (formF.lu_approuve.checked == false){
			    alert("Vous devez lire et accepter les conditions d'inscription");
			    return false;
			}
			//Vérification de la case déclaration sur l'honneur cochée
			if (formF.info_exacte.checked == false){
			    alert("Vous devez certifier que les informations fournies sont exactes");
			    return false;
			}
			formF.submit();
		}
		// Fonctions CheckDate et verifiemail issues du site
		// http://www.toutjavascript.com/savoir/savoir06_4.php3
		function verifiermail(mail) {
		  if ((mail.indexOf("@")>=0)&&(mail.indexOf(".")>=0)) {
		     return true
		  } else {
		     alert("Mail invalide !");
		     return false
		  }
		}

		function CheckDate(d) {
		  // Cette fonction vérifie le format JJ/MM/AAAA saisi et la validité de la date.
		  // Le séparateur est défini dans la variable separateur
		  var amin=1940; // année mini
		  var amax=new Date().getFullYear()-17; // année maxi
		  var separateur="/"; // separateur entre jour/mois/annee
		  var j=(d.substring(0,2));
		  var m=(d.substring(3,5));
		  var a=(d.substring(6));
		  var ok=1;
		  if ( ((isNaN(j))||(j<1)||(j>31)) && (ok==1) ) {
		     alert("Le jour de la date de naissance n'est pas correct."); ok=0;
		  }
		  if ( ((isNaN(m))||(m<1)||(m>12)) && (ok==1) ) {
		     alert("Le mois de la date de naissance n'est pas correct."); ok=0;
		  }
		  if ( ((isNaN(a))||(a<amin)||(a>amax)) && (ok==1) ) {
		     alert("L'année de la date de naissance n'est pas correcte."); ok=0;
		  }
		  if ( ((d.substring(2,3)!=separateur)||(d.substring(5,6)!=separateur)) && (ok==1) ) {
		     alert("Les séparateurs doivent être des "+separateur); ok=0;
		  }
		  if (ok==1) {
		     var d2=new Date(a,m-1,j);
		     j2=d2.getDate();
		     m2=d2.getMonth()+1;
		     a2=d2.getYear();
		     if (a2<=100) {a2=1900+a2}
		     if ( (j!=j2)||(m!=m2)||(a!=a2) ) {
		        alert("La date "+d+" n'existe pas !");
		        ok=0;
		     }
		  }
		  return ok;
		}
		</SCRIPT>
		<table width="100%" border="0" cellspacing="0" cellpadding="2" align = "center">
			<TR CLASS="HEADER">
				<th>Adhésion : mode d'emploi</th>
			</TR>
			<TR>
				<TD>&nbsp;</TD>
			</TR>
			<TR>
				<TD>
					<table width="80%" border="1" cellspacing="0" cellpadding="2" align = "center">
						<TR>
							<TD>
								<? echo $presentation['cfg_textaccueil'] ?>
							</TD>
						</TR>
					</TABLE>
				</TD>
			</TR>
		</TABLE>

		<br><br>
		<form name="demande_adhesion" method="post" action="<? echo $presentation['action_form']?>">
		  <table width="50%" border="0" cellspacing="1" cellpadding="2" align = "center">
		    <tr CLASS="HEADER">
		      <th colspan=2> Demande d'adhésion </th>
		    </tr>
		    <tr>
		      <td> Pseudo </td>
		      <td>
			  	<b><?echo  $user_info['uname']?></b>
				<input type="hidden" name="nickname" value="<?echo  $user_info['uname']?>">
				<input type="hidden" name="uid" value="<?echo  $user_info['uid']?>">
			  </td>
		    </tr>
		    <tr>
		      <td> Nom </td>
		      <td> <input type="text" name="name" CLASS="TEXTBOX_STANDARD" value="<?echo  $user_info['nom']?>" size="50" maxlength="40"> </td>
		    </tr>
		    <tr>
		      <td> Prénom </td>
		      <td> <input type="text" name="firstname" CLASS="TEXTBOX_STANDARD" value="<?echo  $user_info['name']?>" size="50" maxlength="30"> </td>
		    </tr>
		    <tr>
		      <td> Adresse </td>
		      <td> <input type="text" name="address" CLASS="TEXTBOX_STANDARD" value="<?echo  $user_info['adresse']?>" size="50" maxlength="100"> </td>
		    </tr>
		    <tr>
		      <td> Code Postal </td>
		      <td> <input type="text" name="postal_code" CLASS="TEXTBOX_STANDARD" value="<?echo  $user_info['code_postal']?>" size="50" maxlength="10"> </td>
		    </tr>
		    <tr>
		      <td> Ville </td>
		      <td> <input type="text" name="city" CLASS="TEXTBOX_STANDARD" value="<?echo  $user_info['user_from']?>" size="50" maxlength="30"> </td>
		    </tr>
		    <tr>
		      <td> Pays </td>
		      <td> <input type="text" name="country" CLASS="TEXTBOX_STANDARD" value="<?echo  $user_info['pays']?>" size="50" maxlength="20"> </td>
		    </tr>
			<tr>
		      <td> Téléphone fixe </td>
		      <td> <input type="text" name="telephone_fixe" CLASS="TEXTBOX_STANDARD" value="<?echo  $user_info['telephone_fixe']?>" size="50" maxlength="10"> </td>
		    </tr>
			<tr>
		      <td> Téléphone portable </td>
		      <td> <input type="text" name="telephone_portable" CLASS="TEXTBOX_STANDARD" value="<?echo  $user_info['telephone_portable']?>" size="50" maxlength="10"> </td>
		    </tr>
		    <tr>
		      <td> Date de naissance </td>
		      <td>
			  	<input type="text" name="date_naiss_jour" CLASS="TEXTBOX_STANDARD" size="1" value="<?echo  substr($user_info['date_naissance'],8,2)?>" maxlength="2">&nbsp;
						/
			  	<input type="text" name="date_naiss_mois" CLASS="TEXTBOX_STANDARD" size="1" value="<?echo  substr($user_info['date_naissance'],5,2)?>" maxlength="2">&nbsp;
						/
			  	<input type="text" name="date_naiss_annee" CLASS="TEXTBOX_STANDARD" size="2" value="<?echo  substr($user_info['date_naissance'],0,4)?>" maxlength="4">&nbsp;
				&nbsp;<B>(format jj/mm/aaaa)</B>
			  </td>
		    </tr>
		    <tr>
		      <td> Sexe </td>
		      <td>
		  				H
						<input type="radio" name="sexe" value="H" <?if($user_info['sexe']=='H') {echo 'checked';}?>>&nbsp;
		  				F
		  				<input type="radio" name="sexe" value="F" <?if($user_info['sexe']=='F') {echo 'checked';}?>>
		  		</td>
		    </tr>
		    <tr>
					<td> Email </td>
		      <td>
						<input type="text" name="email" CLASS="TEXTBOX_STANDARD" value="<?echo  $user_info['email']?>" size="50" maxlength="100">
					</td>
		    </tr>
		    <tr>
				<td> Equipe </td>
			  	<td>
					<select name="team" CLASS="TEXTBOX_STANDARD">
					<?
						//Récupération des groupes adhérents
						$groupe_adh = groupe_adherents($groupe_adh);
						for ($i = 0; $i<sizeof($groupe_adh);$i++){
							$selected = "";
							if  ($user_info['equipe']==$groupe_adh[$i]['valeur']) {$selected = "selected";}
							echo "<option $selected value=".$groupe_adh[$i]['valeur'].">".$groupe_adh[$i]['groupe_name']."</option>";
						}
					?>
					</select>
				</td>
		    </tr>
		    <tr>
		      <td colspan=2>
		      	<table border=0 align="right" width="80%">
		      	    <tr>
		      	        <td>
					      	<input type="checkbox" id="lu_approuve">
					      	J'ai lu et accepté les conditions d'inscription <br>
					      	<input type="checkbox" id="info_exacte">
					      	Je déclare sur l'honneur que les informations fournies sont exactes
			      	    </td>
			      	</tr>
		      	</table>
		      </td>
		    </tr>
		    <tr>
		      <td>  </td>
		      <td>
			  	<input type="button" name="validate" value="Valider"  CLASS="BOUTON_STANDARD" onClick=Valider(demande_adhesion)>
			  	<input type="reset" name="cancel" value="Effacer" CLASS="BOUTON_STANDARD">
			  </td>
		    </tr>
		  </table>
		</form>
	<?
	}else{
	    echo "<br><center> Veuillez vous <a href=\"user.php?op=only_newuser\">enregistrer</a> avant de faire une demande d'adhésion à notre association</center><br>";
	}
closeTable();  
echo "\n<!-- Fin du code généré par le module de Adhesion  -->";
include_once($adhesion_path."npds/footer.php");

/*********************************************************
*	Récupération de la liste de tous les groupes adhérents
**********************************************************/
function groupe_adherents(){
		 $sql_adh = 'SELECT ac.`valeur` , g.`groupe_name` '
		        . ' FROM `adhesion_config_tab` ac'
        		. ' INNER JOIN `groupes` g ON ac.`valeur` = g.`groupe_id` '
		        . ' WHERE ac.`parametre` '
		        . ' LIKE ( \'cfg_groupe%\' )';
		$resultat_adh = mysql_query($sql_adh);
		if (!$resultat_adh) {
			echo '<br><div class="ROUGE">Impossible d\'exécuter la requête sur les groupes adhérents: ' . mysql_error().'</div><br>';
			exit;
		}
		$k = 0;
		while ($valeur = mysql_fetch_array($resultat_adh)){
			$groupe_adh[$k] = $valeur;
			$k++;
		}
		mysql_free_result($resultat_adh);
		return $groupe_adh;
}
?>

