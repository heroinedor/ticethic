
<?
/************************************************************************/
/*  Fonctions utilis�es pour la manipulation des serveurs dans la BDD   */
/************************************************************************/

	/*****************************************
	*	R�cup�ration de la liste des serveurs
	******************************************/
	function liste_serveurs(){
			 $sql_serv = 'SELECT `serv_id` ,
			 					`serv_nom` ,
								`serv_adresse` ,
								`serv_port` ,
								`serv_game_type` ,
								`serv_url_stat` ,
								`serv_etat`,
								`serv_comments` '
	        . ' FROM `servstat_servers`'
			. ' ORDER BY `serv_etat`';
			$resultat_serv = mysql_query($sql_serv);
			if (!$resultat_serv) {
				$GLOBALS["message_1er_tab"] .= '<br><div class="ROUGE">Impossible d\'ex�cuter la requ�te de listage des serveurs: ' . mysql_error().'</div><br>';
			}
			$k = 0;
				while ($row = mysql_fetch_array($resultat_serv)){
				foreach ($row as $key => $value ){
					$liste_serv[$k][$key]=$value;
				}
				$k++;
			}
			mysql_free_result($resultat_serv);
			return $liste_serv;
	}

	/**************************************************************************/
	//fonction d'ajout d'un serveur dans la base de donn�es
	/**************************************************************************/
	function ajout_serveur(){
		if (isset($_POST['serv_nom'])) {
			$sql_serv_ajt = 'INSERT INTO `servstat_servers` '
						. ' (`serv_nom`,`serv_adresse`, `serv_port`,`serv_game_type` , `serv_url_stat`, `serv_etat`, `serv_comments`)'
						. ' VALUES (\''.stripslashes(FixQuotes($_POST['serv_nom'])).'\',
							\''.stripslashes(FixQuotes($_POST['serv_adresse'])).'\',
							\''.stripslashes(FixQuotes($_POST['serv_port'])).'\',
							\''.stripslashes(FixQuotes($_POST['serv_game_type'])).'\',
							\''.stripslashes(FixQuotes($_POST['serv_url_stat'])).'\',
							\''.stripslashes(FixQuotes($_POST['serv_etat'])).'\',
							\''.stripslashes(FixQuotes($_POST['serv_comments'])).'\')';
			$result_ajt = mysql_query ($sql_serv_ajt);
			$row_affected =mysql_affected_rows();
			//Messages de confirmation ou d'erreur
			if ($result_ajt && $row_affected>0){
				$GLOBALS["message_1er_tab"] .= "<br><strong> $row_affected serveur(s) ajout�(s) </strong><br>";
			}
			else {
				$GLOBALS["message_1er_tab"] .= "<br><div class=\"NOIR\">Une erreur s'est produite lors de l'ajout des donn�es du serveurs: ";
				$GLOBALS["message_1er_tab"] .= "<br>Erreur SQL : <b>".mysql_error()."</b>";
			}
		}
		consultation_serveurs();
	}

	/**************************************************************************/
	//Fonction de modification d'un serveur dans la base de donn�es
	/**************************************************************************/
	function modif_serveur(){
		global $serveur;
		if (isset($_GET['no_serv']) && !isset($_POST['serv_id'])) {
			//Cas o� le num�ro du serveur $no_serv est d�fini par la m�thode GET
			//ce qui correspond � l'affichage des donn�es du serveur dans le tableau de modification
			$no_serv=$_GET['no_serv'];
			//r�cup�ration des donn�es de l'adh�rent � modifier/valider
			$sql_serv_mod = 'SELECT `serv_id` ,
								`serv_nom` ,
								`serv_adresse` ,
								`serv_port` ,
								`serv_game_type` ,
								`serv_url_stat` ,
								`serv_etat` ,
								`serv_comments` '
					. ' FROM `servstat_servers`'
					. ' WHERE `serv_id`='.$no_serv;
			$resultat_serv_mod = mysql_query ($sql_serv_mod);
			$serveur = mysql_fetch_assoc($resultat_serv_mod);
			mysql_free_result($resultat_serv_mod);

			//patam�tre action du formulaire
			$GLOBALS["action"] = "admin.php?op=Extend-Admin-SubModule&ModPath=servstat&ModStart=admin/admin_serv&choix=ModifServeur";
			//texte de l'ent�te du tableau
			$GLOBALS["entete"] ="Modification d'un serveur";
			//texte des boutons
			$GLOBALS["bouton_valider"] ="Valider";
			$GLOBALS["bouton_retour"] ="<a href=\"admin.php?op=Extend-Admin-SubModule&ModPath=servstat&ModStart=admin/admin_serv\">
				  <input type=\"button\" name=\"Validate\" value=\"Retour\" CLASS=\"BOUTON_STANDARD\">
				</a>";

		} else{
			if (!isset($_GET['no_serv'])&& isset($_POST['serv_id'])) {
				//Cas o� le num�ro du serveur $no_serv est d�fini par la m�thode POST
				//ce qui correspond � la modification des donn�es concernant le serveur
				$no_serv = $_POST['serv_id'];
				$sql_serv_mod = 'UPDATE `servstat_servers` '
							. ' SET `serv_nom` =\''.stripslashes(FixQuotes($_POST['serv_nom'])).'\',
								`serv_adresse` =\''.stripslashes(FixQuotes($_POST['serv_adresse'])).'\',
								`serv_port` =\''.stripslashes(FixQuotes($_POST['serv_port'])).'\',
								`serv_game_type` =\''.stripslashes(FixQuotes($_POST['serv_game_type'])).'\',
								`serv_url_stat` =\''.stripslashes(FixQuotes($_POST['serv_url_stat'])).'\',
								`serv_comments` =\''.stripslashes(FixQuotes($_POST['serv_comments'])).'\',
								`serv_etat` =\''.stripslashes(FixQuotes($_POST['serv_etat'])).'\''
					. ' WHERE `serv_id`='.$no_serv;
				$result_mod = mysql_query ($sql_serv_mod);
				$row_affected =mysql_affected_rows();
				//Messages de confirmation ou d'erreur
				if ($result_mod && $row_affected>0){
					$GLOBALS["message_1er_tab"] .= "<br><strong> $row_affected serveur(s) modifi�(s) </strong><br>";
				}
				else {
					$GLOBALS["message_1er_tab"] .= "<br><div class=\"NOIR\">Une erreur s'est produite lors de la modification des donn�es du serveurs: ";
					$GLOBALS["message_1er_tab"] .= "<br>Erreur SQL : <b>".mysql_error()."</b>";
				}

			}
			consultation_serveurs();
		}
	}

	/**************************************************************************/
	//fonction de suppression  d'un serveur dans la base de donn�es
	/**************************************************************************/
	function suppr_serveur(){
		if (isset($_GET['no_serv'])) {
			$no_serv = $_GET['no_serv'];
			$sql_serv_dlt = 'DELETE FROM `servstat_servers` WHERE `serv_id` = '.$no_serv;
			$result_dlt = mysql_query ($sql_serv_dlt);
			$row_affected =mysql_affected_rows();
			//Messages de confirmation ou d'erreur
			if ($result_dlt && $row_affected>0){
				$GLOBALS["message_1er_tab"] .= "<br><strong> $row_affected serveur(s) supprim�(s) </strong><br>";
			}
			else {
				$GLOBALS["message_1er_tab"] .= "<br><div class=\"NOIR\">Une erreur s'est produite lors de la suppression de serveur: ";
				$GLOBALS["message_1er_tab"] .= "<br>Erreur SQL : <b>".mysql_error()."</b>";
			}
		}
		consultation_serveurs();
	}

	/**************************************************************************/
	//Fonction par d�faut de consultation de la liste des serveurs
	/**************************************************************************/
	function consultation_serveurs(){
		$GLOBALS["serveur"]= array();
		//patam�tre action du formulaire
		$GLOBALS["action"] = "admin.php?op=Extend-Admin-SubModule&ModPath=servstat&ModStart=admin/admin_serv&choix=AjoutServeur";
		//texte de l'ent�te du tableau
		$GLOBALS["entete"] = "Ajout d'un serveur";
		//texte du bouton
		$GLOBALS["bouton_valider"] = "Ajouter";
		$GLOBALS["bouton_retour"] = "";
	}

	//Fonction de d�bugage qui affiche en clair le contenu d'un tableau pass� en param�tre
	function debug_tab($table,$nom){
	  	//echo '<br>$sql ='.$sql.'<br>';
		echo "<table border=1>";
		echo "<tr><th>D�tail de $nom</th></tr>";
		foreach ($table as $key => $value) {
			echo "<tr><td>Cl� de $nom: $key; </td><td>Valeur: $value</td></tr>\n";
		    if (is_array($value)){
			    foreach ($value as $cle => $valeur) {
		      		echo "<tr><td> - </td><td>Sous-Cl�: $cle; </td><td>Valeur: $valeur</td></tr>\n";
		      		if (is_array($valeur)){
			      		foreach ($valeur as $k => $v) {
			      		    echo "<tr><td> - </td><td> - </td><td>Sous-Cl�: $k; </td><td>Valeur: $v</td></tr>\n";
			      		}
		      		}
			    }
		    }
	    }
		echo "</table>";
	}




/************************************************************************/
/*  Squery 3.9 Standalone Query code                                    */
/* =================================================                    */
/*                                                                      */
/* Copyright (c) 2005 Curtis Brown   (webmaster@squery.com)             */
/* http://www.squery.com	                 	            */
/*							                  */
/*				                                          */
/* These files are the base code for all methods of use.           	*/
/*   						                        */
/* To configure:  					                  */
/* You must edit your settings in the config.php file                   */
/* located in the /SQuery/lib/ directory.                               */
/* 						                        */
/************************************************************************/

error_reporting(0);
// redefine the user error constants - PHP 4 only
define("FATAL", E_ERROR);
define("ERROR", E_WARNING);
define("WARNING", E_NOTICE);
define("OTHER", E_PARSE);


// error handler function
function myErrorHandler($errno, $errstr, $errfile, $errline)
{
  echo "<!--";
switch ($errno) {
  case FATAL:
   echo "<b>FATAL</b> [$errno] $errstr<br />\n";
   echo "  Fatal error in line $errline of file $errfile";
   echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
   echo "</body></html>";
   die();
   break;
  case ERROR:
   echo "<b>ERROR</b> [$errno] $errstr<br />\n";
   echo "  Error in line $errline of file $errfile";
   echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
   break;
  case WARNING:
   echo "<b>WARNING</b> [$errno] $errstr<br />\n";
   echo "  Non-Fatal error in line $errline of file $errfile";
   echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
   break;
 case OTHER:
   echo "<b>PARSE</b> [$errno] $errstr<br />\n";
   echo "  Parse error in line $errline of file $errfile";
   echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
   break;
  default:
  echo $errno;
  break;
  }
  echo "-->";
}


/*function showFavorites() {
	global $favorites;
	$cnt = count($favorites);
	if ($cnt > 0)
		echo "(";
	for ($i=0;$i<$cnt;$i++) {
		$z = explode(",", $favorites[$i]);
		echo " <a href=\"".$_SERVER['PHP_SELF']."?ModPath=servstat&ModStart=serv_detail&ip=$z[1]&port=$z[2]&game=$z[3]&block=0\" class=\"link\">$z[0]</a> ";
		if ($i+1 < $cnt) echo checkmark();
	}
	if ($cnt > 0)
		echo ")";
}*/

/**
*   Affiche la liste des serveurs d�finie par l'administrateur
*   stock�e dans la base de donn�es
*/
function afficheServeurs() {

    //R�cup�ration de la liste des serveurs dans la variable $liste_serv
	$liste_serv = liste_serveurs();
	$nb_serv = sizeof($liste_serv);
	
	//Affichage de la liste de serveur avec un petit ast�risque avant chacun d'eux
	if ($nb_serv>0){
		for ($i=0;$i<$nb_serv;$i++) {
		    if ($liste_serv[$i]['serv_etat']!=0){
				echo checkmark();
				echo " <a href=\"".$_SERVER['PHP_SELF']."?ModPath=servstat&ModStart=serv_detail&ip=".$liste_serv[$i]['serv_adresse']."&port=".$liste_serv[$i]['serv_port']."&game=".htmlentities($liste_serv[$i]['serv_game_type'])."\" class=\"link\">".$liste_serv[$i]['serv_nom']."</a> &nbsp";
				echo "<br>";
		    }
		}
	}
}


//////////////////////////////////////////////////////////////////
///// Fonctions utilis�e dans la page principale du module ///////
//////////////////////////////////////////////////////////////////
function queryServer($address, $port, $protocol)
{
	global $serv_lib_path;
  include_once($serv_lib_path."gsQuery.php");

  if(!$address && !$port && !$protocol) {
    echo "No parameters given\n";
    return FALSE;
  }

  $gameserver=gsQuery::createInstance($protocol, $address, $port);
  if(!$gameserver) {
    echo "Could not instantiate gsQuery class. Does the protocol you've specified exist?\n";
    return FALSE;
  }

  if(!$gameserver->query_server(TRUE, TRUE)) { // fetch everything
    // query was not succesful, dumping some debug info
    echo "<div>Error ".$gameserver->errstr."</div>\n";
    return FALSE;
  }

  return $gameserver;
}

//////////////////////////////////////////////////////////////////
///// Fonctions utilis�e dans la partie block du module    ///////
//////////////////////////////////////////////////////////////////
function TinyqueryServer($address, $port, $protocol)
{
	echo 'entree dans TinyqueryServer';
  global $serv_lib_path,$content;
  include_once($serv_lib_path."gsQuery.php");

  if(!$address && !$port && !$protocol) {
    $content.="No parameters given\n";
    return FALSE;
  }
	echo '<br>avant ex�cution de gsQuery::createInstance';
  $gameserver=gsQuery::createInstance($protocol, $address, $port);
	echo '<br>apr�s ex�cution de gsQuery::createInstance';
  if(!$gameserver) {
    $content.="Could not instantiate gsQuery class. Does the protocol you've specified exist?\n";
    return FALSE;
  }


  if(!$gameserver->query_server(TRUE, TRUE)) { // fetch everything
    // query was not succesful, dumping some debug info
    $content.="<div>Error ".$gameserver->errstr."</div>\n";
    return FALSE;
  }

  return $gameserver;
}

/*************************************************************************/
/******Fonction permettant de g�n�rer le chemin d'acc�s � une image*******/
/******de map � partir des donn�es fournies pour un serveur       ********/
/*************************************************************************/
function cheminImage($server)
{
	global $serv_img_path, $rep_module;
	$picpath="./modules/".$rep_module."/images/maps/".$server->gamename."/".$server->mapname.".JPG";
	$picpath=strtolower($picpath);
	echo "<!-- ".$picpath."-->";
	if (!file_exists($picpath)) $picpath="./modules/".$rep_module."/images/maps/unknown.gif";
	return $picpath;
}

?>
