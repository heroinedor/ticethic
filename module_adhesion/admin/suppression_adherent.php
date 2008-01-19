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
/* Page de confirmation lors de la suppression d'un adhérent ou d'une période d'adhésion          */
/**************************************************************************************************/


?>
<table width="100%" border="0" cellspacing="1" cellpadding="6" bgcolor="#C2D7EB">
	<tr>
		<td>
			<center>
			<?
			if ($choix == "SupprAdherentOk") {
			    $sql = 'DELETE FROM `adhesion_adherents` WHERE `adh_id`='.$no_adh;
			  	$resultat = mysql_query ($sql);
				//echo "<br>".$sql."<br>";
				if (mysql_affected_rows()<1) {
				    echo "une erreur est survenue : ".mysql_error()."<br>";
				}else{
					echo mysql_affected_rows()." enregistrement supprimé<br><br>";
				}
				echo "<a href=\"admin.php?op=Extend-Admin-SubModule&ModPath=adhesions&ModStart=admin/admin_adhesion\" CLASS=\"NOIR\">";
				echo "Retour";
				echo "</a>";
			}
			else{
			?>
				<FONT CLASS="ROUGE">
					Etes-vous sûr de vouloir effacer l'adhérent n°<?echo $no_adh?>?
				</FONT>
				<BR><BR>[ 
				<a href="admin.php?op=Extend-Admin-SubModule&ModPath=adhesions&ModStart=admin/admin_adhesion&choix=SupprAdherentOk&no_adh=<?echo $no_adh?>" CLASS="ROUGE">Oui</a>
				| 
				<a href="admin.php?op=Extend-Admin-SubModule&ModPath=adhesions&ModStart=admin/admin_adhesion" CLASS="NOIR">Non</a>
				 ]
			<?
			}
			?>
			</center>
			<BR>
		</td>
	</tr>
</table>

