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
/* Page de confirmation lors de la suppression d'une cotisation          */
/**************************************************************************************************/


?>
<table width="100%" border="0" cellspacing="1" cellpadding="6" bgcolor="#C2D7EB">
	<tr>
		<td>
			<center>
			<?
			if ($choix == "SupprCotisationsOk") {
			    $sql = 'DELETE FROM `adhesion_cotisations` WHERE `cot_id`='.$no_cot;
			  	$resultat = mysql_query ($sql);
			  	//Debug
				//echo "<br>".$sql."<br>";
				if (mysql_affected_rows()<1) {
				    echo "une erreur est survenue : ".mysql_error()."<br>";
				}else{
					echo mysql_affected_rows()." enregistrement(s) supprim�(s)<br><br>";
				}
				echo "<a href=\"admin.php?op=Extend-Admin-SubModule&ModPath=adhesions&ModStart=admin/admin_adhesion&choix=Cotisations\" CLASS=\"NOIR\">";
				echo "Retour";
				echo "</a>";
			}
			else{
			?>
				<FONT CLASS="ROUGE">
					Etes-vous s�r de vouloir effacer la cotisation n�<?echo $no_cot?>?
				</FONT>
				<BR><BR>[
				<a href="admin.php?op=Extend-Admin-SubModule&ModPath=adhesions&ModStart=admin/admin_adhesion&choix=SupprCotisationsOk&no_cot=<?echo $no_cot?>" CLASS="ROUGE">Oui</a>
				|
				<a href="admin.php?op=Extend-Admin-SubModule&ModPath=adhesions&ModStart=admin/admin_adhesion&choix=Cotisations" CLASS="NOIR">Non</a>
				 ]
			<?
			}
			?>
			</center>
			<BR>
		</td>
	</tr>
</table>
