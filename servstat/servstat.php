<?
/**************************************************************************************************/
/* Module d'affichage des statistiques d'un parc de serveurs de jeux en ligne                     */
/* pour NPDS version Sable. www.funxp.net pour plus de renseignements                             */
/* ===============================================================================================*/
/*                                                                                                */
/* This program is free software. You can redistribute it and/or modify it under the terms of     */
/* the GNU General Public License as published by the Free Software Foundation; either version 2  */
/* of the License.                                                                                */
/**************************************************************************************************/

/**************************************************************************************************/
/* Bloc d'affichage des informations sur le(s) serveur(s). Module Servstat 2 	                  */
/**************************************************************************************************/

	/**************/
	/* Inclusions */
	/**************/
	global $language;
	//config module
	require("modules/servstat/serv_config.php");
	//fonctions du module
	include_once($serv_path."serv_functions.php");
	//fonctions du module
	include_once($serv_lib_path."main.lib.php");
	//traduction du module
    include_once($serv_lang_path.$language.".php");

	// debut affichage du bloc
	$content = "\n<!-- Début du code généré par le bloc Servstat 2 -->\n";

	//Récupération de la liste de serveur stockés en Base
	$liste_serv = liste_serveurs();
	$nb_server = sizeof($liste_serv);

	if (!isset($gametable)){
		global $gametable;
	}
	//Inclusion du javascript dans le code HTML
	$content .= scriptLayer();

	//Boucle d'affichage sur l'ensemble des serveurs
	for($no_server=0; $no_server < $nb_server; $no_server++){
	    //Test pour ne pas interroger les serveurs à l'état caché
		if (isset($liste_serv[$no_server]['serv_etat']) && $liste_serv[$no_server]['serv_etat']!=0){
			foreach($gametable as $key=>$value){
				if ($key==$liste_serv[$no_server]['serv_game_type']){
					$enginetype=$value;
				}
			}

			//Interrogation du serveur
			//Test d'abord pour savoir si toutes les valeurs des serveurs favoris sont bonnes
			if ( isset($liste_serv[$no_server]['serv_adresse']) && isset($liste_serv[$no_server]['serv_port']) && isset($enginetype)){
			    /**Code inspiré de TinyqueryServer**/
			    $address =$liste_serv[$no_server]['serv_adresse'];
			    $port =$liste_serv[$no_server]['serv_port'];
			    $protocol =$enginetype;

				include_once($serv_lib_path."gsQuery.php");

				if(!$address && !$port && !$protocol) {
					$content.= servstat_translate("Serveur n°").$liste_serv[$no_server]['serv_id']." : ".servstat_translate("Aucun paramètre fourni")."\n";
				}
				$server=gsQuery::createInstance($protocol, $address, $port);
				if(!$server) {
					$content.= servstat_translate("Serveur n°").$liste_serv[$no_server]['serv_id']." : ".servstat_translate("Impossible d'instancier la classe gsQuery. Le protocole spécifié existe-t-il?")."\n";
				}
				if(!$server->query_server(TRUE, TRUE)) { // fetch everything
				// query was not succesful, dumping some debug info
					$content.=servstat_translate("Erreur sur serveur n°").$liste_serv[$no_server]['serv_id']." : ".$server->errstr."\n";
				}
			    /***********************************/
			}else{
				$server=NULL;
				//Message d'erreur si adresse serveur nulle
				if (!isset($liste_serv[$no_server]['serv_adresse'])){
				    $content.="<br><b>".servstat_translate("Serveur n°").$no_server." : ".servstat_translate("adresse nulle")."</b>";
				}
				//Message d'erreur si port nul
				if (!isset($liste_serv[$no_server]['serv_port'])){
				    $content.="<br><b>".servstat_translate("Serveur n°").$no_server." : ".servstat_translate("port nul")."</b>";
				}
				//Message d'erreur si protocole nul
				if (!isset($enginetype)){
				    $content.="<br><b>".servstat_translate("Serveur n°").$no_server." : ".servstat_translate("protocole nul")."</b>";
				}
			}
		if ($server) { //Cas où les serveurs répondent correctement
			//Affichage de la layer avec les infos complémentaires sur le serveur
			$content.=drawDiv($server, $no_server);
			//Construction des tableaux de résultats
			$content.='<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0" ALIGN="center">'."\n";

				//Test pour ne pas afficher les serveurs marqués comme "cachés"
				if ($liste_serv[$no_server]['serv_etat']!=0){
					//Calcul du lien pour accéder à la page de détail du serveur
   				    $url_detail_server = "modules.php?ModPath=servstat&ModStart=serv_detail&ip=".$liste_serv[$no_server]['serv_adresse']."&port=".$liste_serv[$no_server]['serv_port']."&game=".$liste_serv[$no_server]['serv_game_type'];
					//Nom affiché du serveur (ATTENTION: c'est le nom stocké en base de données et non celui du serveur de jeu)
					$content.='	<TR>'."\n";
					$click_detail = servstat_translate("Cliquez pour avoir le détail du serveur");
				    $content.='		<TD class=boxcontent ALIGN="center"><A HREF="'.$url_detail_server.'" ALT="'.$click_detail.'">'.$liste_serv[$no_server]['serv_nom'].'</a></TD>'."\n";
				    $content.='	</TR>'."\n";
				    
					//Affichage de l'image si configuré par l'admin
				    //un clic sur l'image renvoie à la page de détail du serveur
				    $server->mapname=ucwords(htmlentities($server->mapname));

					if (isset($liste_serv[$no_server]['serv_show_img'])&& $liste_serv[$no_server]['serv_show_img']==1){
						$content.='	<TR>'."\n";
						$content.='		<TD ALIGN="center"><A HREF="'.$url_detail_server.'" ALT="'.$click_detail.'" onMouseOver="show(\'server'.$no_server.'\'); return true;" onMouseOut="hide(\'server'.$no_server.'\'); return true;">';
						//Debug
						//echo "<!--".var_dump($server)."-->";
						//Calcul du chemin de l'image
						$picpath="./modules/".$rep_module."/images/maps/".$server->gamename."/".$server->mapname."_p.JPG";
					    //Adaptation pour Plan Of Attack (à supprimer quand jeu supporté par SQuery
						if (isset($server->rules["gamedir"]) && $server->rules["gamedir"]=="planofattack"){
						    $picpath="./modules/".$rep_module."/images/maps/planofattack/".$server->mapname."_p.JPG";
						}
						$picpath=strtolower($picpath);
						echo "<!-- ".$picpath."-->";
						if (!file_exists($picpath)) $picpath="./modules/".$rep_module."/images/maps/unknown.gif";
						$content.='<IMG SRC=\''.$picpath.'\' BORDER="1" ALT="'.$server->mapname.'" HEIGHT="80">';
						$content.='</A></TD>'."\n";
					    $content.='	</TR>'."\n";
				    }
				    
				    //Affichage du nom de la map et du nombre de joueur en cours si configuré par l'admin
					//Calcul du nom de la map (max. 11 caractère sinon ça dépasse le bloc
					if (isset($liste_serv[$no_server]['serv_show_map'])&& $liste_serv[$no_server]['serv_show_map']==1){
						if (strlen($server->mapname) > 11){
		      				$mapname=substr($server->mapname,0,10).".";
		      			}else{
		      				$mapname=$server->mapname;
		      			}
					    $content.='	<TR>'."\n";
					    $content.='		<TD class=boxcontent ALIGN="center"><A HREF="'.$url_detail_server.'" ALT="'.$click_detail.'" class=boxcontent ALIGN="center"><NOBR>'.$mapname.'&nbsp; <b>'.$server->numplayers.' / '.$server->maxplayers.'</b></NOBR></a></TD>'."\n";
					    $content.='	</TR>'."\n";
					}
					
					//Affichage d'un lien permettant de se connecter directement au jeu
					if (isset($liste_serv[$no_server]['serv_show_quick'])&& $liste_serv[$no_server]['serv_show_quick']==1){
					    $url_connect = htmlentities($liste_serv[$no_server]['serv_quicklink']);
					    $content.='	<TR>'."\n";
					    $content.='		<TD class=boxcontent ALIGN="center"><A HREF="'.$url_connect.'" class=boxcontent ALIGN="center">'.servstat_translate("se connecter").'</a></TD>'."\n";
					    $content.='	</TR>'."\n";
					}
					
				    //Liste déroulante des joueurs apparaît si configuré par admin
				    if (isset($liste_serv[$no_server]['serv_show_player']) && $liste_serv[$no_server]['serv_show_player']==1 && $server->numplayers!=0){
					    $content.='	<TR>'."\n";
					    $content.='		<TD align="center">'."\n";
					    if  (sizeof($server->players)>0){
					      $content.='			<SELECT CLASS="TEXTBOX_STANDARD" name="nom_joueur">'."\n";
					      	for ($x=0 ; $x <=sizeof($server->players)-1 ; $x++){
				      			$content.='				<OPTION value="'.$x.'">';
				      			if (strlen($server->players[$x]["name"]) > 14){
				      				$content.=substr($server->players[$x]["name"],0,12)."..";
				      			}else{
				      				$content.=$server->players[$x]["name"];
				      			}
				      			$content.='</OPTION>'."\n";
					      	}
					    	$content.='			</SELECT>'."\n";
						}
					    $content.='		</TD>'."\n";
					    $content.='	</TR>'."\n";
				    }
				    $content.='</TABLE>'."\n";
				    $content.='<hr class="SEPAR" width="122px" align="center">';
				}
		   	} else {
	   			//Construction des tableaux de résultats
				$content.='<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0" ALIGN="center">'."\n";
				//Cas où les serveurs ne répondent pas correctement
				$content.='	<TR>'."\n";
				$url_detail_server = "modules.php?ModPath=servstat&ModStart=serv_detail&ip=".$liste_serv[$no_server]['serv_adresse']."&port=".$liste_serv[$no_server]['serv_port']."&game=".$liste_serv[$no_server]['serv_game_type'];
			    $content.='		<TD ALIGN="center"><A HREF="'.$url_detail_server.'">'.$liste_serv[$no_server]['serv_nom'].'</A>';
		   	    $content.='		</TD>'."\n";
			    $content.='	</TR>'."\n";
			   	$content.='</TABLE>'."\n";
		   	}
		}
	}

	// fin affichage du bloc
	$content .= "\n<!-- Fin du code généré par le bloc Servstat 2 -->\n";
?>
