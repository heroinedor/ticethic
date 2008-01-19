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
/* Page de confirmation de la demande d'adhésion											          */
/**************************************************************************************************/

	//global $adhesion_path;
	//config maison
	//$adhesion_path = "F:\\riquet_decembre_2004\KSOS\cassosiation\\";
	//config verygames
	$adhesion_path = $_SERVER["DOCUMENT_ROOT"];
 	if (!isset($mainfile)) { include_once("mainfile.php"); }
	include_once($adhesion_path."npds/header.php");
  
  //Balisage du début du code du module dans les sources HTML
  echo "\n<!-- Début du code généré par le module de Adhesion  -->";	
  OpenTable();	
  //debug
 /* echo "<table>";
    foreach ($_POST as $key => $value) {
      echo "<tr><td>Clé: $key; </td><td>Valeur: $value</td></tr>\n";
    }*/

		switch($ActionForm){
		case 1: // Modification des données
			$sql = "UPDATE `adhesion_adherents` "
						."SET `adh_adresse` = '".$_POST["address"]."' "
						.",`adh_nom` = '".$_POST["name"]."' "
						.",`adh_prenom` = '".$_POST["firstname"]."' "
						.",`adh_code_postal` = '".$_POST["postal_code"]."' "
						.",`adh_ville` = '".$_POST["city"]."' "
						.",`adh_pays` = '".$_POST["country"]."' "
						.",`adh_email` = '".$_POST["email"]."' "
						.",`adh_pseudo` = '".$_POST["nickname"]."' "
						.",`adh_equipe` = '".$_POST["team"]."' "
						.",`adh_sexe` = '".$_POST["sexe"]."' "
						.",`adh_telephone_fixe` = '".$_POST["telephone_fixe"]."' "
						.",`adh_telephone_portable` = '".$_POST["telephone_portable"]."' "
						.",`adh_date_naissance` = '".$_POST["date_naiss_annee"]."-".$_POST["date_naiss_mois"]."-".$_POST["date_naiss_jour"]."' "
						."WHERE `adh_id` = '".$_POST["uid"]."'";
			break;
		case 2: // Ajoût d'un nouvel adhérent
			$sql = "INSERT INTO `adhesion_adherents` "
						."SET `adh_adresse` = '".$_POST["address"]."' "
						.",`adh_id` = '".$_POST["uid"]."' "
						.",`adh_nom` = '".$_POST["name"]."' "
						.",`adh_prenom` = '".$_POST["firstname"]."' "
						.",`adh_code_postal` = '".$_POST["postal_code"]."' "
						.",`adh_ville` = '".$_POST["city"]."' "
						.",`adh_pays` = '".$_POST["country"]."' "
						.",`adh_email` = '".$_POST["email"]."' "
						.",`adh_pseudo` = '".$_POST["nickname"]."' "
						.",`adh_equipe` = '".$_POST["team"]."' "
						.",`adh_telephone_fixe` = '".$_POST["telephone_fixe"]."' "
						.",`adh_telephone_portable` = '".$_POST["telephone_portable"]."' "
						.",`adh_date_naissance` = '".$_POST["date_naiss_annee"]."-".$_POST["date_naiss_mois"]."-".$_POST["date_naiss_jour"]."' "
						.",`adh_statut` = '2' "
						.",`adh_sexe` = '".$_POST["sexe"]."' ";
			break;
		default:
			$sql = "";
	} // switch

?>

<table width="100%" border="0" cellspacing="1" cellpadding="6" bgcolor="#C2D7EB">
	<tr>
		<td>
			<center>
<?
    $row_affected =mysql_affected_rows();
  	//Debug
	//	echo '$sql : '.$sql.'<br>';
	//echo '$row_affected = '.$row_affected;
		if ($resultat = mysql_query ($sql) and $row_affected>0){
	        echo " Votre demande a été prise en compte";
			echo "<br> Vous pourrez suivre son évolution dans le bloc \"cassosiation\" en page d'accueil";
			echo "<br> Un mail vous sera envoyé pour vous avertir de la validation de votre inscription";
			echo "<br><br>";
			echo "<a href=\"index.php?op=edito\">";
			echo "<input type=\"button\" value=\"Retour accueil\" CLASS=\"BOUTON_STANDARD\">";
			echo "</a>";
		}
		else {
			echo "<br><div class=\"NOIR\">Une erreur s'est produite lors de l'enregistrement de vos coordonnées: ";
			echo "Veuillez noter le message d'erreur ci dessous et prendre contact avec le webmaster du site";
			echo "<br>Erreur SQL : <b>".mysql_error()."</b>";
			echo "<br><input type=\"button\" value=\"Retour\" CLASS=\"BOUTON_STANDARD\" onClick=\"javascript:history.back(-1)\">";
		}
?>
			</center>
			<BR>
		</td>
	</tr>
</table>
<?
closeTable();  
echo "\n<!-- Fin du code généré par le module de Adhesion  -->";
include_once($adhesion_path."npds/footer.php");
?>

