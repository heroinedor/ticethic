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
	//config module
	include_once('modules/servstat/serv_config.php');
	//fonctions du module
	include_once($serv_path."serv_functions.php");
	

	
	
	// debut affichage du bloc
	$content = "\n<!-- Début du code généré par le bloc Servstat 2 -->\n";

	//Récupération de la liste de serveur stockés en Base
	$liste_serv = liste_serveurs();
	$nb_server = sizeof($liste_serv);

//Boucle d'affichage sur l'ensemble des serveurs
for($no_server=0; $no_server < $nb_server; $no_server++){
	//Determination de la variable "enginetype"
	foreach($gametable as $key=>$value){
		if ($key==$liste_serv[$no_server]['serv_game_type']){
			$enginetype=$value;
    		$content.='<br>$enginetype = '.$enginetype;
		}
	}
	//Interrogation du serveur
    //$server=TinyqueryServer($liste_serv[$no_server]['serv_adresse'],$liste_serv[$i]['serv_port'],$enginetype);
	    $content.='<TABLE CELLPADDING="1" CELLSPACING="1" BORDER="0" ALIGN="center">'."\n";
	if ($server) { //Cas où les serveurs répondent correctement
		//Debug
	    $content.='<br>adresse et port'.$server->address.':'.$server->hostport;
		//Nom affiché du serveur (ATTENTION: c'est le nom stocké en base de données et non le véritable en ligne)
		$content.='	<TR>'."\n";
	    $content.='		<TD class=boxcontent ALIGN="center">'.$liste_serv[$no_server]['serv_nom'].'</TD>'."\n";
	    $content.='	</TR>'."\n";
	    //Image de la map
	    //un clic sur l'image renvoie à la page de détail du serveur
	    $url_detail_server = $root_path."npds/modules.php?ModPath=servstat&ModStart=serv_detail&ip=".$liste_serv[$no_server]['serv_adresse']."&port=".$liste_serv[$no_server]['serv_port']."&game=".$liste_serv[$no_server]['serv_game_type'];
	    $content.='	<TR>'."\n";
		$content.='		<TD ALIGN="center"><A HREF="'.$url_detail_server.'" target="_blank"><IMG SRC="'.$path["mappicture"][$no_server].'/'.$info["nameofthemap"].'.jpg" BORDER="1" ALT="'.$info["nameofthemap"].'" HEIGHT="80"></A></TD>'."\n";
	    //$content.='		<TD ALIGN="center"><A HREF=modules.php?ModPath=servstat&ModStart=serv_detail&no_server='.$no_server.' target="_self"><IMG SRC="'.$path["mappicture"][$no_server].'/'.$info["nameofthemap"].'.jpg" BORDER="1" ALT="'.$info["nameofthemap"].'" HEIGHT="80"></A></TD>'."\n";
	    $content.='	</TR>'."\n";
	    //Nom de la map en cours
	    $server->mapname=ucwords(htmlentities($server->mapname));
		$content.='	<TR>'."\n";
	    $content.='		<TD class=boxcontent ALIGN="center">'.$server->mapname.'</TD>'."\n";
	    $content.='	</TR>'."\n";
	    //Nombre de joueur en cours
	    $content.='	<TR>'."\n";
	    $content.='		<TD class=boxcontent ALIGN="center"><NOBR><FONT COLOR="#CC0000"><b>'.$server->numplayers.' / '.$server->maxplayers.'</b></FONT></NOBR></TD>'."\n";
	    $content.='	</TR>'."\n";
	    //Liste déroulante des joueurs
	    $content.='	<TR>'."\n";
	    $content.='		<TD>liste joueur'."\n";
	    /*if  ($players[0]["playername"]){
	      $content.='			<SELECT CLASS="TEXTBOX_STANDARD" name="nom_joueur">'."\n";
	      	for ($x=0 ; $x <=sizeof($players)-1 ; $x++){


	      			$content.='				<OPTION value="'.$x.'">';

	      			if (strlen($players[$x]["playername"]) > 14){
	      				$content.=substr($players[$x]["playername"],0,12)."..";
	      			}else{
	      				$content.=$players[$x]["playername"];
	      			}
	      			$content.='</OPTION>'."\n";
	      	}
	    	$content.='			</SELECT>'."\n";
		}*/
	    $content.='		</TD>'."\n";
	    $content.='	</TR>'."\n";
	    $content.='</TABLE>'."\n";
   	} else {  //Cas où les serveurs ne répondent pas correctement
		//Test pour ne pas afficher les serveurs marqués comme "cachés"
		if ($liste_serv[$no_server]['serv_etat']!=0){
			$content.='	<TR>'."\n";
			$url_detail_server = "modules.php?ModPath=servstat&ModStart=serv_detail&ip=".$liste_serv[$no_server]['serv_adresse']."&port=".$liste_serv[$no_server]['serv_port']."&game=".$liste_serv[$no_server]['serv_game_type'];
		    $content.='		<TD ALIGN="center"><A HREF="'.$url_detail_server.'">'.$liste_serv[$no_server]['serv_nom'].'</A>';
	   	    $content.='		</TD>'."\n";
		    $content.='	</TR>'."\n";
		}
   	}
   	$content.='</TABLE>'."\n";
}

	// fin affichage du bloc
	$content .= "\n<!-- Fin du code généré par le bloc Adhésion  -->\n";
?>
