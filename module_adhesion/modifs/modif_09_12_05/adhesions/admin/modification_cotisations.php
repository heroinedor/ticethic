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
/* Page de confirmation de modification des données d'une cotisation                              */
/**************************************************************************************************/

/***********************************
* 2 cas possibles :
* - ActionForm = 1 : mise à jour des données de la cotisation
* - ActionForm = 2 : insertion des données pour une nouvelle cotisation
* */

	if (isset($_POST["ActionForm"])) {
	        if ($_POST["ActionForm"]==1){
			$sql = "UPDATE `adhesion_cotisations` "
						."SET `cot_adh_id` = '".$_POST["adh_id"]."' "
						.",`cot_montant` = '".$_POST["cot_montant"]."' "
						.",`cot_comments` = '".$_POST["cot_comments"]."' "
						.",`cot_type` = '".$_POST["cot_type"]."' "
						.",`cot_date` = '"
							.$_POST["date_paie_annee"]."-"
							.$_POST["date_paie_mois"]."-"
							.$_POST["date_paie_jour"]."' "
						.",`cot_session` = '".$_POST["cot_session"]."' "
						.",`cot_reference` = '".$_POST["cot_reference"]."' "
						."WHERE `cot_id` = '".$_POST["cot_id"]."'";
		}else{
			$sql = "INSERT INTO `adhesion_cotisations` "
				."( `cot_id` , `cot_adh_id` , `cot_montant` , `cot_date` , `cot_session` , `cot_type` , `cot_comments`, `cot_reference` ) "
	        	. " VALUES ( '".$_POST["cot_id"]."', "
				. "'".$_POST["adh_id"]."', "
				."'".$_POST["cot_montant"]."', "
				."'".$_POST["date_paie_annee"]."-"
					.$_POST["date_paie_mois"]."-"
					.$_POST["date_paie_jour"]."', "
				."'".$_POST["cot_session"]."', "
				."'".$_POST["cot_type"]."', "
				."'".$_POST["cot_comments"]."', "
				."'".$_POST["cot_reference"]."' )";
		}
	}else{
		$sql = "UPDATE `adhesion_cotisations` "
		        ."SET `cot_adh_id` = '' "
		        ."WHERE `cot_id` = ''";
	}
?>

<table width="100%" border="0" cellspacing="1" cellpadding="6" bgcolor="#C2D7EB">
	<tr>
		<td>
			<center>
<?
  	//Debug
		//echo '$sql : '.$sql;
		if ($resultat = mysql_query ($sql)){
		        echo "<br>";
			echo mysql_affected_rows() ." Enregistrement(s) Modifié(s) avec succès";
			echo "<br><br>";
			echo "<a href=\"admin.php?op=Extend-Admin-SubModule&ModPath=adhesions&ModStart=admin/admin_adhesion&choix=Cotisations\">";
			echo "<input type=\"button\" value=\"Retour\" CLASS=\"BOUTON_STANDARD\">";
			echo "</a>";
		}
		else {
			echo "<br><div class=\"ROUGE\">Une erreur s'est produite lors de la modification de l'enregistrement : ";
			echo "<br>Erreur SQL : <b>".mysql_error()."</b>";
			echo "<br><input type=\"button\" value=\"Retour\" CLASS=\"BOUTON_STANDARD\" onClick=\"javascript:history.back(-1)\">";
		}
?>
			</center>
			<BR>
		</td>
	</tr>
</table>
