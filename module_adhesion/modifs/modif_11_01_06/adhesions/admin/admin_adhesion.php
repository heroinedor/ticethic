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
/* Console d'administration visible seulement par les admins  de niveau radminsuper               */
/**************************************************************************************************/

if(!IsSet($mainfile)) { include ("mainfile.php"); }
// Permanent double-side theme
global $pdsts;
$pdst="0";
//include ("modules/$ModPath/adhesion.conf.php");
include ("modules/$ModPath/lang/$language.php");

//Sécurisation de l'accès
if (!eregi("admin.php", $PHP_SELF)) { Access_Error(); }
$result = mysql_query("select radminsuper, radminuser from authors where aid='$aid'");
list($radminsuper, $radminuser) = mysql_fetch_row($result);
if ($radminsuper!=1 && $radminuser!=1) {Access_Error();}

//On calcule l'année des cotisation
$sessCotis = sessionCotisation();
//Debug
/*	echo "<br>sql_ac : ".$sql_ac."<br>";
	echo "<br>sql_cfg : ".$sql_cfg."<br>";*/
	echo "<br>sessCotis : ".var_dump($sessCotis);

//Balisage du début du code du module dans les sources HTML
echo "<!-- Début du code généré par le module de Adhesion  -->";

//intégration de la feuille de style pour les onglet et du fichier javascript
//initialisation du premier onglet à être affiché sur celui de l'année en cours
echo "\n<style type=\"text/css\" media=\"all\">@import \"modules/$ModPath/admin/onglets.css\";</style>";
echo "\n<script type=\"text/javascript\" language=\"JavaScript\">var initialtab=[".$sessCotis['nowSession'].", \"sc".$sessCotis['nowSession']."\"]</script>";
echo "\n<script language=\"javascript\" type=\"text/javascript\" src=\"modules/$ModPath/admin/onglets.js\"></script>";


//Affichage des onglets de navigation
AfficheOngletNavig();

//corps de la page
OpenTable();

switch ($subop){
	case "Configuration":
		include ("config_module.php");
		break;
 	case "SupprCotisationsOk":
	case "SupprCotisations":
		include ("suppression_cotisation.php");
		break;
 	case "ModifCotisations":
		include "modification_cotisations.php";
		break;
	case "Cotisations":
		include ("gestion_cotisations.php");
		break;
	case "SupprAdherent":
	case "SupprAdherentOk":
		include "suppression_adherent.php";
		break;
	case "ModifAdherent":
		include "modification_adherent.php";
		break;
	case "":
	case "Adherents":
		include ("gestion_adherents.php");
		break;
	case "Groupes":
		include ("gestion_groupes.php");
		break;
	default:
		Access_Error();
		break;
}
closeTable();  
echo "<!-- Fin du code généré par le module de Adhesion  -->";


/********************************************************************/
/* Fonction d'affichage du tableau de navigation en haut de la page	*/
/********************************************************************/
function AfficheOngletNavig(){
	echo "\n<BR>";
	echo "\n\t<TABLE cellSpacing=\"2\" cellPadding=\"2\" width=\"100%\" BORDER=\"0\" CLASS=\"HEADER\">";
	echo "\n\t\t<TR>";
	//onglet Consultation/Validation des adhérents
	echo "\n\t\t<TD CLASS=\"TITBOXC\" ALIGN=\"CENTER\">";
  	echo "\n\t\t\t&nbsp;[&nbsp;";
	echo "\n\t\t\t<a href=\"admin.php?op=Extend-Admin-SubModule&ModPath=adhesions&ModStart=admin/admin_adhesion&subop=Adherents\" CLASS=\"HEADA\">".adhesion_translate("Gestion des adhérents")."</a>";
 	echo "\n\t\t\t&nbsp;]";
	echo "\n\t\t</TD>";
	//onglet Gestion des cotisations
	echo "\n\t\t<TD CLASS=\"TITBOXC\" ALIGN=\"CENTER\">";
  	echo "\n\t\t\t&nbsp;[&nbsp;";
	echo "\n\t\t\t<a href=\"admin.php?op=Extend-Admin-SubModule&ModPath=adhesions&ModStart=admin/admin_adhesion&subop=Cotisations\" CLASS=\"HEADA\">".adhesion_translate("Gestion des cotisations")."</a>";
 	echo "\n\t\t\t&nbsp;]";
	echo "\n\t\t</TD>";
	
	echo "\n\t</TR>";
	echo "\n\t<TR>";
	
	//onglet Consultation/Validation des groupes	
	echo "\n\t\t<TD CLASS=\"TITBOXC\" ALIGN=\"CENTER\">";
  	echo "\n\t\t\t&nbsp;[&nbsp;";
	echo "\n\t\t\t<a href=\"admin.php?op=Extend-Admin-SubModule&ModPath=adhesions&ModStart=admin/admin_adhesion&subop=Groupes\" CLASS=\"HEADA\">".adhesion_translate("Gestion des groupes")."</a>";
 	echo "\n\t\t\t&nbsp;]";
	echo "\n\t\t</TD>";
	//onglet Configuration du module
	echo "\n\t\t<TD CLASS=\"TITBOXC\" ALIGN=\"CENTER\">";
  	echo "\n\t\t\t&nbsp;[&nbsp;";
	echo "\n\t\t\t<a href=\"admin.php?op=Extend-Admin-SubModule&ModPath=adhesions&ModStart=admin/admin_adhesion&subop=Configuration\" CLASS=\"HEADA\">".adhesion_translate("Configuration du module")."</a>";
 	echo "\n\t\t\t&nbsp;]";
	echo "\n\t\t</TD>";	
	
	echo "\n\t</TR>";
	echo "\n</TABLE><BR>";
}


function debug_post(){
	global  $ModPath, $ModStart;
	echo "<br>_POST : ";
	var_dump ($_POST);
	echo "<br>_GET : ";
	var_dump ($_GET);
	echo ("<br>ModPath = $ModPath, <br>ModStart =  $ModStart");
}



/********************************************************************/
/* Fonction permettant de déterminer automatiquement dans quelle	*/
/* session de cotisation on se situe, ainsi que la liste des 		*/
/* sessions de cotisation à afficher								*/
/********************************************************************/
function sessionCotisation(){
	//On récupère de la table adhesion_config_tab l'année de première cotisation et le nombre d'année à afficher
	$sql_cfg = 'SELECT `parametre`, `valeur` FROM `adhesion_config_tab` WHERE `parametre` = \'cfg_date_start\' OR `parametre` = \'cfg_nb_sessions\' ';
	$resultat_cfg = mysql_query($sql_cfg);
	if (!$resultat_cfg) {
		echo '<br><div class="ROUGE">Impossible d\'exécuter la requête sur la configuration: ' . mysql_error().'</div><br>';
		exit;
	}
	while (list($parametre, $valeur) = mysql_fetch_row($resultat_cfg)){
		if ($parametre == 'cfg_date_start'){
			$sessionCotis['firstSession'] = substr($valeur,0,4);
		}
		if ($parametre == 'cfg_nb_sessions'){
			$sessionCotis['nbSession'] = $valeur;
		}
	}
	mysql_free_result($resultat_cfg);


	//On récupère toutes les sessions devant être affichées et on détermine l'année de la session actuelle
	$sql_ac = 'SELECT `ses_id` , `ses_annee_civ` , `ses_annee_scol` FROM `adhesion_session` LIMIT 0,'.$sessionCotis['nbSession'];
	$resultat_ac = mysql_query($sql_ac);
	//gestion d'erreur
	if (!$resultat_ac) {
		echo '<br><div class="ROUGE">Impossible d\'exécuter la requête sur les sessions de cotisation: ' . mysql_error().'</div><br>';
		exit;
	}
	while (list($sesId, $anneeCiv, $anneeScol) = mysql_fetch_row($resultat_ac)){
		$sessionCotis[$sesId]['ses_annee_civ']=$anneeCiv;
		$sessionCotis[$sesId]['ses_annee_scol']=$anneeScol;
		if ($anneeCiv == date ("Y")){
			$sessionCotis['nowSession'] = $sesId;
		}
	}
	mysql_free_result($resultat_ac);
	
	return $sessionCotis;
}
?>

