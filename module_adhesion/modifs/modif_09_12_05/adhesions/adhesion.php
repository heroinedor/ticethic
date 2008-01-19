<?php
/**************************************************************************************************/
/* Module de gestion des adhérents d'une association pour NPDS version 5.0 P1 Runner              */
/* ===============================================================================================*/
/*                                                                                                */
/* This program is free software. You can redistribute it and/or modify it under the terms of     */
/* the GNU General Public License as published by the Free Software Foundation; either version 2  */
/* of the License.                                                                                */
/**************************************************************************************************/

/**************************************************************************************************/
/* BLoc d'affichage en page d'accueil , coté utilisateur			                              */
/**************************************************************************************************/
global $site_font,$bgcolor1,$bgcolor2;

	// parametre personnel
	// Pour changer le titre de ce bloc modifier $title
	$title="Cassosiation";
	// debut affichage du bloc
	$content = "\n<!-- Début du code généré par le bloc Adhésion  -->\n";

	// Affichage du statut
	//Récupération des données utilisateur
	$user_info = getusrinfo($user);
	if ($user_info['uid']!=0){//le statut ne doit pas apparaître pour les anonymes
		$content .= "<center>";
		$sql_statut = "SELECT `adh_statut` FROM `adhesion_adherents` WHERE `adh_id`='".$user_info['uid']."'";
		$resultat_statut = mysql_query ($sql_statut);
		$resultat_tab = mysql_fetch_array($resultat_statut);
		switch ($resultat_tab['adh_statut']){
			case 1 : //statut "adhésion validée"
				$content .="<br><font color=\"green\">Statut : <b>Validé</b></font></center><br>";
				break;
			case 2 : //statut "adhésion en attente"
				$content .="<br><font color=\"orange\">Statut : En attente</font></center><br>";
				break;
			case 3 : //statut "adhésion rejetée"
				$content .="<br><font color=\"red\" >Statut : <b>Refusé</b></font></center><br>";
				break;
			default:
				$content .="</center>";
				break;
		}
		mysql_free_result($resultat_statut);
	}
	// Affichage du reste des liens du bloc
	$sql_bloc = "SELECT `valeur` FROM `adhesion_config_tab` WHERE `parametre`='cfg_bloc_contenu'";
	$resultat_bloc = mysql_query ($sql_bloc);
	list($texte_bloc) = mysql_fetch_array($resultat_bloc);
	mysql_free_result($resultat_bloc);
	$content .=$texte_bloc;
	// fin affichage du bloc
	$content .= "\n<!-- Fin du code généré par le bloc Adhésion  -->\n";
?>

