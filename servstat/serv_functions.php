
<?
/************************************************************************/
/*  Fonctions utilisées pour la manipulation des serveurs dans la BDD   */
/************************************************************************/

	/*****************************************
	*	Récupération de la liste des serveurs
	******************************************/
	function liste_serveurs(){
			 $sql_serv = 'SELECT `serv_id` ,
			 					`serv_nom` ,
								`serv_adresse` ,
								`serv_port` ,
								`serv_game_type` ,
								`serv_show_img` ,
								`serv_show_player` ,
								`serv_show_quick` ,
								`serv_quicklink` ,
								`serv_url_stat` ,
								`serv_etat`,
								`serv_show_map`,
								`serv_comments` '
	        . ' FROM `servstat_servers`'
			. ' ORDER BY `serv_etat`';
			$resultat_serv = mysql_query($sql_serv);
			if (!$resultat_serv) {
			    $impossible = servstat_translate("Impossible d'exécuter la requête de listage des serveurs");
				$GLOBALS["message_1er_tab"] .= '<br><div class="ROUGE">'.$impossible.' : ' . mysql_error().'</div><br>';
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
	//fonction d'ajout d'un serveur dans la base de données
	/**************************************************************************/
	function ajout_serveur(){
		if (isset($_POST['serv_nom'])) {
			$sql_serv_ajt = 'INSERT INTO `servstat_servers` '
						. ' (`serv_nom`,`serv_adresse`, `serv_port`,`serv_game_type` , `serv_show_img`,`serv_show_player`,`serv_show_quick`, `serv_quicklink`, `serv_url_stat`, `serv_etat`, `serv_show_map`, `serv_comments`)'
						. ' VALUES (\''.stripslashes(FixQuotes($_POST['serv_nom'])).'\',
							\''.stripslashes(FixQuotes($_POST['serv_adresse'])).'\',
							\''.stripslashes(FixQuotes($_POST['serv_port'])).'\',
							\''.stripslashes(FixQuotes($_POST['serv_game_type'])).'\',
							\''.stripslashes(FixQuotes($_POST['serv_show_img'])).'\',
							\''.stripslashes(FixQuotes($_POST['serv_show_player'])).'\',
							\''.stripslashes(FixQuotes($_POST['serv_show_quick'])).'\',
							\''.stripslashes(FixQuotes($_POST['serv_quicklink'])).'\',
							\''.stripslashes(FixQuotes($_POST['serv_url_stat'])).'\',
							\''.stripslashes(FixQuotes($_POST['serv_etat'])).'\',
							\''.stripslashes(FixQuotes($_POST['serv_show_map'])).'\',
							\''.stripslashes(FixQuotes($_POST['serv_comments'])).'\')';
			//Debug
			//echo "<br>".$sql_serv_ajt."<br>";
			$result_ajt = mysql_query ($sql_serv_ajt);
			$row_affected =mysql_affected_rows();
			//Messages de confirmation ou d'erreur
			if ($result_ajt && $row_affected>0){
				$GLOBALS["message_1er_tab"] .= "<br><strong> $row_affected ".servstat_translate("serveur ajouté")." </strong><br>";
			}
			else {
				$GLOBALS["message_1er_tab"] .= "<br><div class=\"NOIR\">".servstat_translate("Une erreur s'est produite lors de l'ajout des données du serveurs")." : ";
				$GLOBALS["message_1er_tab"] .= "<br>".servstat_translate("Erreur SQL")." : <b>".mysql_error()."</b>";
			}
		}
		consultation_serveurs();
	}

	/**************************************************************************/
	//Fonction de modification d'un serveur dans la base de données
	/**************************************************************************/
	function modif_serveur(){
		global $serveur;
		if (isset($_GET['no_serv']) && !isset($_POST['serv_id'])) {
			//Cas où le numéro du serveur $no_serv est défini par la méthode GET
			//ce qui correspond à l'affichage des données du serveur dans le tableau de modification
			$no_serv=$_GET['no_serv'];
			//récupération des données du serveur à modifier/valider
			$sql_serv_mod = 'SELECT `serv_id` ,
								`serv_nom` ,
								`serv_adresse` ,
								`serv_port` ,
								`serv_game_type` ,
								`serv_show_img` ,
								`serv_show_player` ,
								`serv_show_quick` ,
								`serv_quicklink` ,
								`serv_url_stat` ,
								`serv_etat` ,
								`serv_show_map`,
								`serv_comments` '
					. ' FROM `servstat_servers`'
					. ' WHERE `serv_id`='.$no_serv;
			$resultat_serv_mod = mysql_query ($sql_serv_mod);
			$serveur = mysql_fetch_assoc($resultat_serv_mod);
			mysql_free_result($resultat_serv_mod);

			//paramètre action du formulaire
			$GLOBALS["action"] = "admin.php?op=Extend-Admin-SubModule&ModPath=servstat&ModStart=admin/admin_serv&choix=ModifServeur";
			//texte de l'entête du tableau
			$GLOBALS["entete"] = servstat_translate("Modification d'un serveur");
			//texte des boutons
			$GLOBALS["bouton_valider"] = servstat_translate("Valider");
			$GLOBALS["bouton_retour"] ="<a href=\"admin.php?op=Extend-Admin-SubModule&ModPath=servstat&ModStart=admin/admin_serv\">
				  <input type=\"button\" name=\"Validate\" value=\"".servstat_translate("Retour")."\" CLASS=\"BOUTON_STANDARD\">
				</a>";

		} else{
			if (!isset($_GET['no_serv'])&& isset($_POST['serv_id'])) {
				//Cas où le numéro du serveur $no_serv est défini par la méthode POST
				//ce qui correspond à la modification des données concernant le serveur
				$no_serv = $_POST['serv_id'];
				$sql_serv_mod = 'UPDATE `servstat_servers` '
							. ' SET `serv_nom` =\''.stripslashes(FixQuotes($_POST['serv_nom'])).'\',
								`serv_adresse` =\''.stripslashes(FixQuotes($_POST['serv_adresse'])).'\',
								`serv_port` =\''.stripslashes(FixQuotes($_POST['serv_port'])).'\',
								`serv_game_type` =\''.stripslashes(FixQuotes($_POST['serv_game_type'])).'\',
								`serv_show_img` =\''.stripslashes(FixQuotes($_POST['serv_show_img'])).'\',
								`serv_show_player` =\''.stripslashes(FixQuotes($_POST['serv_show_player'])).'\',
								`serv_show_quick` =\''.stripslashes(FixQuotes($_POST['serv_show_quick'])).'\',
								`serv_quicklink` =\''.stripslashes(FixQuotes($_POST['serv_quicklink'])).'\',
								`serv_show_map` =\''.stripslashes(FixQuotes($_POST['serv_show_map'])).'\',
								`serv_url_stat` =\''.stripslashes(FixQuotes($_POST['serv_url_stat'])).'\',
								`serv_comments` =\''.stripslashes(FixQuotes($_POST['serv_comments'])).'\',
								`serv_etat` =\''.stripslashes(FixQuotes($_POST['serv_etat'])).'\''
					. ' WHERE `serv_id`='.$no_serv;
				$result_mod = mysql_query ($sql_serv_mod);
				$row_affected =mysql_affected_rows();
				//Messages de confirmation ou d'erreur
				if ($result_mod && $row_affected>0){
					$GLOBALS["message_1er_tab"] .= "<br><strong> $row_affected ".servstat_translate("serveur modifié")." </strong><br>";
				}
				else {
					$GLOBALS["message_1er_tab"] .= "<br><div class=\"NOIR\">".servstat_translate("Une erreur s'est produite lors de la modification des données du serveur")." : ";
					$GLOBALS["message_1er_tab"] .= "<br>".servstat_translate("Erreur SQL")." : <b>".mysql_error()."</b>";
				}

			}
			consultation_serveurs();
		}
	}

	/**************************************************************************/
	//fonction de suppression  d'un serveur dans la base de données
	/**************************************************************************/
	function suppr_serveur(){
		if (isset($_GET['no_serv'])) {
			$no_serv = $_GET['no_serv'];
			$sql_serv_dlt = 'DELETE FROM `servstat_servers` WHERE `serv_id` = '.$no_serv;
			$result_dlt = mysql_query ($sql_serv_dlt);
			$row_affected =mysql_affected_rows();
			//Messages de confirmation ou d'erreur
			if ($result_dlt && $row_affected>0){
				$GLOBALS["message_1er_tab"] .= "<br><strong> $row_affected ".servstat_translate("serveur supprimé")." </strong><br>";
			}
			else {
				$GLOBALS["message_1er_tab"] .= "<br><div class=\"NOIR\">".servstat_translate("Une erreur s'est produite lors de la suppression d'un serveur")." : ";
				$GLOBALS["message_1er_tab"] .= "<br>".servstat_translate("Erreur SQL")." : <b>".mysql_error()."</b>";
			}
		}
		consultation_serveurs();
	}

	/**************************************************************************/
	//Fonction par défaut de consultation de la liste des serveurs
	/**************************************************************************/
	function consultation_serveurs(){
		$GLOBALS["serveur"]= array();
		//patamètre action du formulaire
		$GLOBALS["action"] = "admin.php?op=Extend-Admin-SubModule&ModPath=servstat&ModStart=admin/admin_serv&choix=AjoutServeur";
		//texte de l'entête du tableau
		$GLOBALS["entete"] = servstat_translate("Ajout d'un serveur");
		//texte du bouton
		$GLOBALS["bouton_valider"] = servstat_translate("Ajouter");
		$GLOBALS["bouton_retour"] = "";
	}

	//Fonction de débugage qui affiche en clair le contenu d'un tableau passé en paramêtre
	function debug_tab($table,$nom){
	  	//echo '<br>$sql ='.$sql.'<br>';
		echo "<table border=1>";
		echo "<tr><th>Détail de $nom</th></tr>";
		foreach ($table as $key => $value) {
			echo "<tr><td>Clé de $nom: $key; </td><td>Valeur: $value</td></tr>\n";
		    if (is_array($value)){
			    foreach ($value as $cle => $valeur) {
		      		echo "<tr><td> - </td><td>Sous-Clé: $cle; </td><td>Valeur: $valeur</td></tr>\n";
		      		if (is_array($valeur)){
			      		foreach ($valeur as $k => $v) {
			      		    echo "<tr><td> - </td><td> - </td><td>Sous-Clé: $k; </td><td>Valeur: $v</td></tr>\n";
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


// Fonction de gestion des erreurs (inutilisé ici)
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

//////////////////////////////////////////////////////////////////
///// Fonctions utilisée dans la page principale du module ///////
//////////////////////////////////////////////////////////////////
function queryServer($address, $port, $protocol)
{
	global $serv_lib_path;
	//echo "<br>$serv_lib_path dans queryServer";
  include_once($serv_lib_path."gsQuery.php");

  if(!$address && !$port && !$protocol) {
    echo servstat_translate("Aucun paramètre fourni")."\n";
    return FALSE;
  }

  $gameserver=gsQuery::createInstance($protocol, $address, $port);
  if(!$gameserver) {
    echo servstat_translate("Impossible d'instancier la classe gsQuery. Le protocole spécifié existe-t-il?")."\n";
    return FALSE;
  }

  if(!$gameserver->query_server(TRUE, TRUE)) { // fetch everything
    // query was not succesful, dumping some debug info
    echo servstat_translate("Erreur")." : ".$gameserver->errstr."\n";
    return FALSE;
  }

  return $gameserver;
}

/************************************************************************/
/*  Fin des fonctions dérivées de SQuery                                */
/************************************************************************/

/**
*   Affiche la liste des serveurs définie par l'administrateur et
*   stockée dans la base de données
*/
function afficheServeurs() {

    //Récupération de la liste des serveurs dans la variable $liste_serv
	$liste_serv = liste_serveurs();
	$nb_serv = sizeof($liste_serv);
	
	//Affichage de la liste de serveur avec un petit astérisque avant chacun d'eux
	if ($nb_serv>0){
		echo "<table border=0 cellspacing=\"0\" cellpadding=\"2\">";
		//Entête du tableau
		echo "\n\t<tr>".
        "\n\t\t<td width=20px  CLASS=\"ONGL\">&nbsp;</td>".
		"\n\t\t<td width=300px CLASS=\"ONGL\">&nbsp;".servstat_translate("Nos Serveurs")."</td>".
        "\n\t\t<td width=120px CLASS=\"ONGL\">&nbsp;".servstat_translate("IP/URL")."</td>".
		"\n\t\t<td width=100px CLASS=\"ONGL\">&nbsp;".servstat_translate("Jeu")."</td>".
        "\n\t\t<td width=100px CLASS=\"ONGL\">&nbsp;".servstat_translate("URL Statistiques")."</td>".
        "\n\t</tr>";
        //Corps
		for ($i=0;$i<$nb_serv;$i++) {
		    if ($liste_serv[$i]['serv_etat']!=0){
	        	$rowcolor = tablos();
				//Cas d'une ligne d'un membre d'une équipe
				echo "\n\t<tr $rowcolor>".
	            "\n\t\t<td width=20px  align=\"center\">&nbsp;".checkmark()."</td>".
				"\n\t\t<td width=300px>&nbsp;".
				"<a href=\"".$_SERVER['PHP_SELF']."?ModPath=servstat&ModStart=serv_detail&ip=".$liste_serv[$i]['serv_adresse']."&port=".$liste_serv[$i]['serv_port']."&game=".htmlentities($liste_serv[$i]['serv_game_type'])."\" class=\"link\">".
				$liste_serv[$i]['serv_nom']."</a></td>".
	            "\n\t\t<td width=120px>&nbsp;".$liste_serv[$i]['serv_adresse'].":".$liste_serv[$i]['serv_port']."</td>".
				"\n\t\t<td width=100px>&nbsp;".$liste_serv[$i]['serv_game_type']."</td>".
	            "\n\t\t<td width=100px>&nbsp;".
				"<a href=\"".htmlentities($liste_serv[$i]['serv_url_stat'])."\" class=\"link\" target=\"_blank\">".
				$liste_serv[$i]['serv_url_stat']."</a></td>".
	            "\n\t</tr>";
			}
		}
		echo "</table>";
	}
}

/*************************************************************************/
/******Fonction permettant de générer le chemin d'accès à une image*******/
/******de map à partir des données fournies pour un serveur       ********/
/*************************************************************************/
function cheminImage($server)
{
	global $serv_img_path, $rep_module;
	$picpath="./modules/".$rep_module."/images/maps/".$server->gamename."/".$server->mapname.".JPG";
    //Adaptation pour Plan Of Attack (à supprimer quand jeu supporté par SQuery
	if (isset($server->rules["gamedir"]) && $server->rules["gamedir"]=="planofattack"){
	    $picpath="./modules/".$rep_module."/images/maps/planofattack/".$server->mapname.".JPG";
	}
	$picpath=strtolower($picpath);
	echo "<!-- ".$picpath."-->";
	if (!file_exists($picpath)) $picpath="./modules/".$rep_module."/images/maps/unknown.gif";
	return $picpath;
}

/**
*   fonction pour intégrer le script javascript
*   permettant d'afficher la layer contenant les
*	infos complémentaires sur le serveur
*/
function scriptLayer() {
	return "<script language=\"javascript\" type=\"text/javascript\">
	   NS4 = (document.layers) ? 1 : 0;
	   IE4 = (document.all) ? 1 : 0;
	   if (!IE4)
	      MOZ = (document.getElementById) ? 1 : 0;
	   else
	      MOZ=0;

	   function show (name) {
		  if (currentX+100 > screen.availWidth){
		    x = currentX - 200;
		  }else{
			x = currentX - 100;
		  }
	      y = currentY + 20;
	      if (NS4) {
	         document.layers[name].xpos = parseInt(x);
	         document.layers[name].left = parseInt(x);
	         document.layers[name].ypos = parseInt(y);
	         document.layers[name].top = parseInt(y);
	         document.layers[name].visibility = \"show\";
	      }
	      if (IE4) {
	         document.all[name].style.left = self.document.body.scrollLeft + parseInt(x);
	         document.all[name].style.top = self.document.body.scrollTop + parseInt(y);
	         document.all[name].style.visibility = \"visible\";
	      }
	      if (MOZ) {
	         document.getElementById(name).style.left = parseInt(x);
	         document.getElementById(name).style.top = parseInt(y);
	         document.getElementById(name).style.visibility = \"visible\";
	      }
	   }

	   function hide (name) {
	      if (NS4) {
	         document.layers[name].visibility = \"hide\";
	      }
	      if (IE4) {
	         document.all[name].style.visibility = \"hidden\";
	      }
	      if (MOZ) {
	         document.getElementById(name).style.visibility = \"hidden\";
	      }
	   }
	   currentX = currentY = 0;

	   function grabEl(e) {
	      if (IE4) {
	         currentX = event.x;
	         currentY = event.y;
	      } else {
	         currentX = e.pageX;
	         currentY = e.pageY;
	      }
	   }

	   if ( NS4 ) {
	      document.captureEvents(Event.MOUSEDOWN | Event.MOUSEMOVE);
	   }
	   document.onmousemove = grabEl;
	   </script>";
}

/**
*   Construction du layer contenant les infos complémentaires du serveur
*/
function drawDiv($server,$no_server){
	if (isset($server->mapname)){
	    $mapname = ucwords(htmlentities($server->mapname));
	}else{$mapname ="";}
	if (isset($server->gamename)){
	    $gamename = gametitle(htmlentities($server->gamename));
	}else{$gamename ="";}
	if (isset($server->address)){
	    $address = $server->address;
	}else{$address ="";}
	if (isset($server->hostport)){
	    $port = $server->hostport;
	}else{$port ="";}
	if (isset($server->numplayers)){
	    $numplayers = $server->numplayers;
	}else{$numplayers ="";}
	if (isset($server->maxplayers)){
	    $maxplayers = $server->maxplayers;
	}else{$maxplayers ="";}
	
    $result="";
    $result.="<div id=\"server$no_server\" style=\"position: absolute;z-index: 20; visibility: hidden; top: 0px; left: 0px; width: 200px;\">
			<table border=\"0\" width=\"100%\" cellpadding=\"1\">
				<tr>
					<td class=\"HEADER\">
						<table width=\"100%\" cellspacing=0 border=0>
							<tr class=\"LIGNB\">
								<td align=\"left\">
									<span class=\"NOIR\">".servstat_translate("IP/URL")." : </span><strong>$address : $port</strong><br>
									<span class=\"NOIR\">".servstat_translate("Jeu")." : </span><strong>$gamename</strong><br>
									<span class=\"NOIR\">".servstat_translate("Map")." : </span><strong>$mapname</strong><br>
									<span class=\"NOIR\">".servstat_translate("Joueurs")." : </span><strong>$numplayers / $maxplayers</strong><br>";
	if (isset($server->password)){
	    switch($server->password){
			case "1":
				$use_pass = servstat_translate("Serveur privé (mot de passe)");
				break;
			case"0":
				$use_pass = servstat_translate("Serveur publique");
				break;
			default:
				$use_pass = servstat_translate("Mode publique/privé inconnu");
				break;
		}
		$result.= "<strong>$use_pass</strong><br>";
	}
	$result.="								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</div>";
	return $result;
}
?>
