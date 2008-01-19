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
/* Console d'administration visible seulement par les admins  de niveau radminsuper               */
/**************************************************************************************************/
echo ("<br>ModPath = $ModPath, <br>ModStart =  $ModStart");
if(!IsSet($mainfile)) { include ("mainfile.php"); }
// Permanent double-side theme
global $pdsts;
$pdst="0";
//include ("modules/$ModPath/adhesion.conf.php");
include ("modules/$ModPath/lang/$language.php");

//S�curisation de l'acc�s
if (!eregi("admin.php", $PHP_SELF)) { Access_Error(); }
$result = mysql_query("select radminsuper, radminuser from authors where aid='$aid'");
list($radminsuper, $radminuser) = mysql_fetch_row($result);
if ($radminsuper!=1 && $radminuser!=1) {Access_Error();}


//Balisage du d�but du code du module dans les sources HTML
echo "<!-- D�but du code g�n�r� par le module de Adhesion  -->";

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
echo "<!-- Fin du code g�n�r� par le module de Adhesion  -->";


/********************************************************************/
/* Fonction d'affichage du tableau de navigation en haut de la page	*/
/********************************************************************/
function AfficheOngletNavig(){
	echo "\n<BR>";
	echo "\n\t<TABLE cellSpacing=\"2\" cellPadding=\"2\" width=\"100%\" BORDER=\"0\" CLASS=\"HEADER\">";
	echo "\n\t\t<TR>";
	//onglet Consultation/Validation des adh�rents
	echo "\n\t\t<TD CLASS=\"TITBOXC\" ALIGN=\"CENTER\">";
  	echo "\n\t\t\t&nbsp;[&nbsp;";
	echo "\n\t\t\t<a href=\"admin.php?op=Extend-Admin-SubModule&ModPath=adhesions&ModStart=admin/admin_adhesion&subop=Adherents\" CLASS=\"HEADA\">".adhesion_translate("Gestion des adh�rents")."</a>";
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
?>

