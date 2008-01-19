<?PHP

/**************************************************************************************************/
/* Module de root_path de galeries pour NPDS version 1.3                                            */
/* GALERIE photos utilisée sur http://www.derumier.net                                            */
/* ===================================================                                            */
/* (c) 2003 Christophe Derumier http://www.derumier.net                                           */
/*                                                                                                */
/* This program is free software. You can redistribute it and/or modify it under the terms of     */
/* the GNU General Public License as published by the Free Software Foundation; either version 2  */
/* of the License.                                                                                */
/**************************************************************************************************/

/**************************************************************************************************/
/* Page d'affichage du détail des informations sur le serveur                                     */
/**************************************************************************************************/

	//debug
	/*echo "\n<table>";
	foreach ($_SERVER as $key=> $value){
		echo '<tr><td><b>$_SERVER['.$key.'] </b></td><td>'.$value."</td></tr>\n";
	}
	echo "\n</table>";
	*/
	
	/**************/
	/* Inclusions */
	/**************/
	//config module
	require("serv_config.php");
	//mainfile
	if (!isset($mainfile)) { include_once($root_path."npds/mainfile.php"); }
	//Header
	include_once($root_path."npds/header.php");
	//fonctions du module
	include_once($serv_path."serv_functions.php");
	//Librairies de communication avec le serveur
    include_once($serv_lib_path."main.lib.php");

    
	//affichage des blocs de droite
	global $pdst;
	$pdst="1";


	OpenTable();
	  /*$server = new server;
	  //$no_server= $_POST['no_server'];
	  if(!isset($no_server))
	  {
	  	die('no_server non défini');
	  }
	  $info = $server->SendCmd($serv["address"][$no_server],$serv["port"][$no_server],"info");
	  $players = $server->SendCmd($serv["address"][$no_server],$serv["port"][$no_server],"players");
	  $rules = $server->SendCmd($serv["address"][$no_server],$serv["port"][$no_server],"rules");*/
	  

	// set to the user defined error handler
	$old_error_handler = set_error_handler("myErrorHandler");
	
	$blockmode=0;
	$ip = $_GET['ip']; $port = $_GET['port'];$qgame = $_GET['game'];
	//$blockmode = $_GET['block'];


?>
    <!--	Code généré par le module Servstat		-->
	<TABLE BORDER=1 CELLSPACING=0 CELLPADDING=3 CLASS="main_table">
		<TR>
			<TD align=center>
				<table border=1 width=100% cellspacing=0 cellpadding=0>
					<tr>
						<td>
							<font class="color">
							<?
								if ($show_ip_entry_form)
									echo "Entrez l'adresse du serveur à interroger:";
							   	else echo "Choisissez un serveur parmi la liste suivante:";
							?>
							</font>
						</td>
						<td align=right>
							<?=showCredits(showVersion())?>
						</td>
					</tr>
				</table>
				<form method=get>
					<table>
						<tr>
							<td>
								<b class="color">&nbsp;&nbsp;&nbsp;Adresse IP:</b>
								&nbsp;&nbsp;&nbsp;
								<input type=text name=ip value="<?=$ip?>" class="TEXTBOX_STANDARD">
							</td>
							<td>
								&nbsp;&nbsp;&nbsp;
								<b>Port:</b>
								&nbsp;&nbsp;&nbsp;
								<input type=text name=port value="<?=$port?>" class="TEXTBOX_STANDARD">
							</td>
							<td>
								&nbsp;&nbsp;&nbsp;
								<b class="color">Jeu:</b>
								&nbsp;&nbsp;&nbsp;
								<select name="game" class="TEXTBOX_STANDARD">
								    <?
										foreach($gametable as $key=>$value){
											echo "<OPTION ";
											if ($key==$qgame){
												echo "SELECTED ";
												$enginetype=$value;
											}
											echo "VALUE=\"$key\">".$key;
										}
									?>
								</select>
							</td>
							<td>
								<input type="hidden" name="block" value="0">
								<input type=submit value="Query" class="BOUTON_STANDARD">
							</td>
						</tr>
					</table>
				</form>
			</TD>
			<TD>
			    <b>Nos serveurs:</b><br>
				<?=afficheServeurs();?><br>
			</TD>
		</TR>
	</TABLE>
	<br><br><br><br>

	<TABLE BORDER=1 CELLSPACING=0 CELLPADDING=3 class="main_table" align=center>
		<TR>
			<TD align=center>
				<?
		        $qport=calcqport($port,$qgame);
		        if ($queryfromurl) {
					include_once($serv_lib_path."gsQuery.php");
				 	$gameserver=gsQuery::unserializeFromURL("http://www.squery.com/sqserial/serializer.php?ip=$ip&port=$qport&protocol=$enginetype");
			        if(!$gameserver) {
			            echo "Could not fetch the serialized object.";
	      			}
				}else{
					$gameserver=queryServer($ip,$qport,$enginetype);
				}
/***************************************************************************************/
/*                      AFFICHAGE DU TABLEAU DETAILLANT LES                            */
/*                      LES CARACT2RISTIQUES GENERALES DU SERVEUR                      */
/***************************************************************************************/
				if ($gameserver) {
				?>
				<strong class="big"></strong><br>
				<table width="100%" cellspacing=0 cellpadding=3 align="center" border=1>
				    <tr CLASS="HEADER">
				        <td colspan =2 align="center"><?=$gameserver->htmlize($gameserver->servertitle)?></td>
				    </tr>
					<tr>
						<td width="100%" style="padding-left: 10px; padding-right: 10px;" valign=top>
							<table border=1 cellspacing=0 cellpadding=0>
								<tr>
									<td class="row">
										<font class="color">Adresse IP:</font>
									</td>
									<td class="row">
										<?=$gameserver->address?>:<?=$gameserver->hostport?>&nbsp;&nbsp;&nbsp;
									</td>
								</tr>
								<tr>
									<td class="row">
										<font class="color">Jeu:</font>
									</td>
									<td class="row">
										<?=gametitle(htmlentities($gameserver->gamename))?>
									</td>
								</tr>

								<tr>
									<td class="row">
										<font class="color">Version:</font>
									</td>
									<td class="row">
										<?=htmlentities($gameserver->gameversion)?>
									</td>
								</tr>
								<tr>
									<td class="row">
										<font class="color">Game Type:</font>
									</td>
									<td class="row">
									    <?=$gameserver->gametype?>

									</td>
								</tr>
								<?
								if ($gameserver->rules[".admin"]<>"")
								{ ?>
								<tr><td class="row"><font class ="color">Admin Name:</font></td><td class="row"><?=$gameserver->rules[".admin"]?></td></tr>
								<?}
								if ($gameserver->rules["admin"]<>"")
								{ ?>
								<tr><td class="row"><font class ="color">Admin Name:</font></td><td class="row"><?=$gameserver->rules["admin"]?></td></tr>
								<?}
								if ($gameserver->rules["adminname"]<>"")
								{ ?>
								<tr><td class="row"><font class ="color">Admin Name:</font></td><td class="row"><?=$gameserver->rules["adminname"]?></td></tr>
								<?}
								if ($gameserver->rules["admin name"]<>"")
								{ ?>
								<tr><td class="row"><font class ="color">Admin Name:</font></td><td class="row"><?=$gameserver->rules["admin name"]?></td></tr>
								<?}
								if ($gameserver->rules["administrator"]<>"")
								{ ?>
								<tr><td class="row"><font class ="color">Admin Name:</font></td><td class="row"><?=$gameserver->rules["administrator"]?></td></tr>
								<?}
								if ($gameserver->rules[".administrator"]<>"")
								{ ?>
								<tr><td class="row"><font class ="color">Admin Name:</font></td><td class="row"><?=$gameserver->rules[".administrator"]?></td></tr>
								<?}
								if ($gameserver->rules[".email"]<>"")
								{ ?>
								<tr><td class="row"><font class ="color">Admin Email:</font></td><td class="row"><?=$gameserver->rules[".email"]?></td></tr>
								<? }
								if ($gameserver->rules["sv_contact"]<>"")
								{ ?>
								<tr><td class="row"><font class ="color">Admin Email:</font></td><td class="row"><?=$gameserver->rules["sv_contact"]?></td></tr>
								<? }
								if ($gameserver->rules["adminemail"]<>"")
								{ ?>
								<tr><td class="row"><font class ="color">Admin Email:</font></td><td class="row"><?=$gameserver->rules["adminemail"]?></td></tr>
								<? }
								if ($gameserver->rules["admin email"]<>"")
								{ ?>
								<tr><td class="row"><font class ="color">Admin Email:</font></td><td class="row"><?=$gameserver->rules["admin email"]?></td></tr>
								<? }
								if ($gameserver->rules["admin e-mail"]<>"")
								{ ?>
								<tr><td class="row"><font class ="color">Admin Email:</font></td><td class="row"><?=$gameserver->rules["admin e-mail"]?></td></tr>
								<? }
								if ($gameserver->rules[".e-mail"]<>"")
								{ ?>
								<tr><td class="row"><font class ="color">Admin Email:</font></td><td class="row"><?=$gameserver->rules[".e-mail"]?></td></tr>
								<? }
								if ($gameserver->rules[".icq"]<>"")
								{ ?>
								<tr><td class="row"><font class ="color">Admin ICQ:</font></td><td class="row"><?=$gameserver->rules[".icq"]?></td></tr>
								<? }
								if ($gameserver->rules["icq"]<>"")
								{ ?>
								<tr><td class="row"><font class ="color">Admin ICQ:</font></td><td class="row"><?=$gameserver->rules["icq"]?></td></tr>
								<? }
								if ($gameserver->rules[".website"]<>"")
								{ ?>
								<tr><td class="row"><font class ="color">Website:</font></td><td class="row"><?=$gameserver->rules[".website"]?></td></tr>
								<? }
								if ($gameserver->rules[".location"]<>"")
								{ ?>
								<tr><td class="row"><font class ="color">Server Location:</font></td><td class="row"><?=$gameserver->rules[".location"]?></td></tr>
								<? }
								if ($gameserver->rules["location"]<>"")
								{ ?>
								<tr><td class="row"><font class ="color">Server Location:</font></td><td class="row"><?=$gameserver->rules["location"]?></td></tr>
								<? }
								if ($gameserver->rules["email"]<>"")
								{ ?>
								<tr><td class="row"><font class ="color">Admin Email:</font></td><td class="row"><?=$gameserver->rules["email"]?></td></tr>
								<? }
								if ($gameserver->rules[".url"]<>"")
								{ ?>
								<tr><td class="row"><font class ="color">Website:</font></td><td class="row"><?=$gameserver->rules[".url"]?></td></tr>
								<? }
								if ($gameserver->rules["web"]<>"")
								{ ?>
								<tr><td class="row"><font class ="color">Website:</font></td><td class="row"><?=$gameserver->rules["web"]?></td></tr>
								<? }
								if ($gameserver->rules["webpage"]<>"")
								{ ?>
								<tr><td class="row"><font class ="color">Website:</font></td><td class="row"><?=$gameserver->rules["webpage"]?></td></tr>
								<? }
								if ($gameserver->rules["url"]<>"")
								{ ?>
								<tr><td class="row"><font class ="color">Website:</font></td><td class="row"><?=$gameserver->rules["url"]?></td></tr>
								<? }
								if ($gameserver->rules[".irc"]<>"")
								{ ?>
								<tr><td class="row"><font class ="color">IRC Channel:</font></td><td class="row"><?=$gameserver->rules[".irc"]?></td></tr>
								<? }
								if ($gameserver->rules["irc"]<>"")
								{ ?>
								<tr><td class="row"><font class ="color">IRC Channel:</font></td><td class="row"><?=$gameserver->rules["irc"]?></td></tr>
								<? }
								if ($gameserver->rules["cpu"]<>"")
								{ ?>
								<tr><td class="row"><font class ="color">CPU:</font></td><td class="row"><?=$gameserver->rules["cpu"]?></td></tr>
								<? }
								if ($gameserver->rules[".cpu"]<>"")
								{ ?>
								<tr><td class="row"><font class ="color">CPU:</font></td><td class="row"><?=$gameserver->rules[".cpu"]?></td></tr>
								<? }
								if ($gameserver->rules["server spec"]<>"")
								{ ?>
								<tr><td class="row"><font class ="color">CPU:</font></td><td class="row"><?=$gameserver->rules["server spec"]?></td></tr>
								<? }
								if ($gameserver->rules["connection"]<>"")
								{ ?>
								<tr><td class="row"><font class ="color">Connection:</font></td><td class="row"><?=$gameserver->rules["connection"]?></td></tr>
								<? }
								if ($gameserver->rules["gamestartup"]<>"")
								{ ?>
								<tr><td class="row"><font class ="color">Last Boot:</font></td><td class="row"><?=$gameserver->rules["gamestartup"]?></td></tr>
								<? }
								if ($gameserver->rules["gameversion"]<>"")
								{ ?>
								<tr><td class="row"><font class ="color">Game Ver:</font></td><td class="row"><?=$gameserver->rules["gameversion"]?></td></tr>
								<? }
								if ($gameserver->rules["plug"]<>"")
								{ ?>
								<tr><td class="row"><font class ="color">Motto:</font></td><td class="row"><?=$gameserver->rules["plug"]?></td></tr>
								<? }
								if ($gameserver->rules["motd"]<>"")
								{ ?>
								<tr><td class="row"><font class ="color">Motto:</font></td><td class="row"><?=$gameserver->rules["motd"]?></td></tr>
								<? }?>
							</table>
							<br>
							<table cellspacing=0 cellpadding=0 width="100%">
								<tr>
									<td class="row">
											<?
											switch($gameserver->password)
											{
											case "1":
											echo "Serveur privé (mot de passe)</font>";
											break;
											case"0":
											echo "Serveur publique </font>";
											break;
											default:
											echo "Mode publique/privé inconnu.";
											break;
											}
											?>
									</td>
								</tr>
							</table>
							<br>
							<?=$gameserver->docvars($gameserver);
							/////////////////////////////////////////////////////////
							// function is called, sees server type, creates a pathname to pictures based on mapname and server type.
							$mappic=domappic($gameserver);
							// if the picture isn't there, sets to unknown.gif.
							///////////////////////////////////////////////////////////////////////////////////
							?>
						</td>
						<td width="20%" valign="top" style="padding-left: 10px; padding-right: 10px;">
							<img src="<?=$mappic?>" alt="<?=htmlentities($gameserver->maptitle)?>" style="border: 1px solid #000000;">
							<br><br>
							<table width="100%" cellspacing=1 cellpadding=1>
								<? $gameserver->mapname=ucwords(htmlentities($gameserver->mapname)); ?>
								<tr>
									<td>
										<font class="color">Current Map:</font>
									</td>
									<td>
										<?=$gameserver->mapname?>
									</td>
								</tr>
								<? $gameserver->gametype=strtoupper(htmlentities($gameserver->gametype)); ?>
								<tr>
									<td>
										<font class="color">Nombre de joueurs:</font>
									</td>
									<td>
										<b><?=$gameserver->numplayers?> / <?=$gameserver->maxplayers;?></b>
          								<?if ($gameserver->numplayers == $gameserver->maxplayers)
											echo "&nbsp;&nbsp;&nbsp;(<font class=\"color\">Serveur plein</font>)";
										elseif ($gameserver->numplayers == 0)
											echo "&nbsp;&nbsp;&nbsp;(<font class=\"color\">Serveur vide</font>)";
										?>
									</td>
								</tr>
								<?
								if ($gameserver->rules["sv_punkbuster"]<>"")
								{ ?>
								<tr><td><font class="color">PunkBuster:</font></td><td><?=($gameserver->rules["sv_punkbuster"] == 1 ? "Enabled" : "Disabled")?></td></tr>
								<?} ?>
							</table>
						</td>
					</tr>
				</table>
				<br>
<?
				}
/****************************************************************************************/
/*               FIN DU TABLEAU DES	CARACT2RISTIQUES GENERALES DU SERVEUR				*/
/****************************************************************************************/
				?>
			</TD>
		</TR>
	</TABLE>
<br><br><br>
<?
/****************************************************************************************/
/*               TABLEAU DETAIL DES JOUEURS				*/
/****************************************************************************************/
?>

	<TABLE cellpadding=0 cellspacing=0 width="100%" align="center" border=1>
		<?
		if(!count($gameserver->playerteams)){
		//////////////////////////////////////////////////////////
		// 				No Team Info (like COD)                 //
		//////////////////////////////////////////////////////////
		?>
		<tr>
			<td align=center valign=top>
				<table width="100%" cellspacing=0 cellpadding=3>
				    <tr class="HEADER">
				        <td colspan=3 align="center">Informations sur les joueurs</td>
				    </tr>
					<tr>
						<?
						 if ($gameserver->playerkeys["name"]) {
						  ?>
						<td align=center CLASS="ONGL">Pseudo</td>
						<? }
						if ($gameserver->playerkeys["score"]) {
						  ?>
						<td align=center CLASS="ONGL">Score</td>
						 <? }
						if ($gameserver->playerkeys["goal"]) {
						  ?>
						<td align=center CLASS="ONGL">Goals</td>
						 <? }
						if ($gameserver->playerkeys["leader"]) {
						  ?>
						<td align=center CLASS="ONGL">Leader</td>
						 <? }
						if ($gameserver->playerkeys["enemy"]) {
						  ?>
						<td align=center CLASS="ONGL">Enemy</td>
						 <? }
						if ($gameserver->playerkeys["kia"]) {
						  ?>
						<td align=center CLASS="ONGL">KIA</td>
						 <? }
						if ($gameserver->playerkeys["roe"]) {
						  ?>
						<td align=center CLASS="ONGL">ROE</td>
						 <? }
						if ($gameserver->playerkeys["ping"]) {
						  ?>
						<td align=center CLASS="ONGL">Ping</td>
						<? }
						if ($gameserver->playerkeys["kills"]) {
						  ?>
						<td align=center CLASS="ONGL">Kills</td>
						 <? }
						if ($gameserver->playerkeys["deaths"]) {
						  ?>
						<td align=center CLASS="ONGL">Deaths</td>
						 <? }
						if ($gameserver->playerkeys["skill"]) {
						  ?>
						<td align=center CLASS="ONGL">Skill</td>
						 <? }
						if ($gameserver->playerkeys["time"]) {
						  ?>
						<td align=center CLASS="ONGL">Temps de jeu</td>
						<? }
						 ?>
					</tr>

			<?
			if(!count($gameserver->players)) {
			    //Cas où aucun joueur à afficher
		    	echo "<tr><td align=\"center\">(none)</td></tr>";
		    }else{
		        //////////////////////////////////////////////////////
		        //Liste des joueurs et de leurs caractéristiques    //
		        //////////////////////////////////////////////////////
				for ($i=0;$i<$gameserver->numplayers;$i++) {
					$rowcolor=tablos();
    				echo '	<tr '.$rowcolor.'>';
					if ($gameserver->playerkeys["name"]) {
					  ?>
					 <td><?=$gameserver->htmlize($gameserver->players[$i]["name"])?></td>
					<? }
					if ($gameserver->playerkeys["score"]) {
					  ?>
					 <td align=center><?=$gameserver->players[$i]["score"]?></td>
					<? }
					if ($gameserver->playerkeys["goal"]) {
					  ?>
					 <td align=center><?=$gameserver->players[$i]["goal"]?></td>
					<? }
					if ($gameserver->playerkeys["leader"]) {
					  ?>
					 <td align=center><?=$gameserver->players[$i]["leader"]?></td>
					<? }
					if ($gameserver->playerkeys["enemy"]) {
					  ?>
					 <td align=center><?=$gameserver->players[$i]["enemy"]?></td>
					<? }
					if ($gameserver->playerkeys["kia"]) {
					  ?>
					 <td align=center><?=$gameserver->players[$i]["kia"]?></td>
					<? }
					if ($gameserver->playerkeys["roe"]) {
					  ?>
					 <td align=center><?=$gameserver->players[$i]["roe"]?></td>
					<? }
					if ($gameserver->playerkeys["ping"]) {
					  ?>
					 <td align=center><?=$gameserver->players[$i]["ping"]?></td>
					<? }
					if ($gameserver->playerkeys["kills"]) {
					  ?>
					 <td align=center><?=$gameserver->players[$i]["kills"]?></td>
					<? }
					if ($gameserver->playerkeys["deaths"]) {
					  ?>
					 <td align=center><?=$gameserver->players[$i]["deaths"]?></td>
					<? }
					if ($gameserver->playerkeys["skill"]) {
					  ?>
					 <td align=center><?=$gameserver->players[$i]["skill"]?></td>
					<? }
					if ($gameserver->playerkeys["time"]) {
					  ?>
					 <td align=center><?=$gameserver->players[$i]["time"]?></td>
					<? }
					echo "</tr>";
				}
				//////////////////////////////////////////////////////
		        // FIN Liste des joueurs 						    //
		        //////////////////////////////////////////////////////
			}?>
				  	<tr CLASS="HEADER">
				    	<td colspan=4 ALIGN="center"> © cassosiation 2004</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>

		<?
		}else{

		//////////////////////////////////////////////////////////
		// 				with teams (like SOF2)                 //
		//////////////////////////////////////////////////////////

		?>
		<tr><td valign=top><br>
		<table border=0 cellspacing=0 cellpadding=0 width="100%">
		<tr><td align=center width="50%" style="padding-bottom: 2px;"><font class="blueteam"><?=$gameserver->team1?></font>
		<br>
		<table width=100% cellspacing=0 cellpadding=0>
		<tr>
<td style="padding-left: 3px;">Players on this team: <font class=blueteam><?=$gameserver->teamcnt1?></font></td>
		<?
		   if ($gameserver->teamscore1) { ?>
		<td align=right style="padding-right: 3px;">Points scored: <font class=blueteam><?=$gameserver->teamscore1?></font>
		<? if ($gameserver->scorelimit) { ?>
		 / <font class=blueteam><?=$gameserver->scorelimit?></font>
		<? } ?>
		</td>
		<? } ?>
				</tr>
				</table>
				<td align=center width="50%" style="padding-bottom: 2px;"><font class="redteam"><?=$gameserver->team2?></font>
				<br>
				<table width=100% cellspacing=0 cellpadding=0>
				<tr>
				<td style="padding-left: 6px;">Players on this team: <font class=redteam><?=$gameserver->teamcnt2?></font></td>
		<?
		   if ($gameserver->teamscore2) { ?>
		<td align=right style="padding-right: 3px;">Points scored: <font class=redteam><?=$gameserver->teamscore2?></font>
		<? if ($gameserver->scorelimit) { ?>
		 / <font class=redteam><?=$gameserver->scorelimit?></font>
		<? } ?>
		</td>
		<? } ?>
				</tr>
				</table>
				</td></tr>
				<tr><td align=center valign=top>
				<table width="100%" cellspacing=0 cellpadding=3><tr>

		<?
		 if ($gameserver->playerkeys["name"]) {
		  ?>
		 <td CLASS="ONGL" style="padding-left: 4px; border: 1px solid <?=$col_border?>;"><strong>Player Name</strong></td>
		<? }
		if ($gameserver->playerkeys["ping"]) {
		  ?>
		<td align=center CLASS="ONGL" style="border: 1px solid <?=$col_border?>; border-left: none;"><strong>Ping</strong></td>
		<? }
		if ($gameserver->playerkeys["score"]) {
		  ?>
		<td align=center CLASS="ONGL" style="border: 1px solid <?=$col_border?>; border-left: none;"><strong>Score</strong></td>
		 <? }
		if ($gameserver->playerkeys["deaths"]) {
		  ?>
		<td align=center CLASS="ONGL" style="border: 1px solid <?=$col_border?>; border-left: none;"><strong>Deaths</strong></td>
		 <? }
		if ($gameserver->playerkeys["kills"]) {
		  ?>
		<td align=center CLASS="ONGL" style="border: 1px solid <?=$col_border?>; border-left: none;"><strong>Kills</strong></td>
		 <? }
		if ($gameserver->playerkeys["time"]) {
		  ?>
		<td align=center CLASS="ONGL" style="border: 1px solid <?=$col_border?>; border-left: none;"><strong>Time</strong></td>
		 <? } ?>

		</tr>
				<?
				$o = 0;


				for ($i=0;$i<$gameserver->numplayers+1;$i++) {
					if ($gameserver->playerteams[$i] == "1") {
					$o++;
		            echo "<tr>";
		if ($gameserver->playerkeys["name"]) {
		echo "<td class=\"bluebox\" style=\"padding-left: 4px; border: 1px solid $col_border; border-top: none;\">".$gameserver->htmlize($gameserver->players[$i]["name"])."</td>";
		}
		if ($gameserver->playerkeys["ping"]) {
		echo "<td align=center class=\"bluebox\" style=\"border-bottom: 1px solid $col_border; border-right: 1px solid $col_border;\">".$gameserver->players[$i]["ping"]."</td>";
		}
		if ($gameserver->playerkeys["score"]) {
		echo "<td align=center class=\"bluebox\" style=\"border-bottom: 1px solid $col_border; border-right: 1px solid $col_border;\">".$gameserver->players[$i]["score"]."</td>";
		}
		if ($gameserver->playerkeys["deaths"]) {
		echo "<td align=center class=\"bluebox\" style=\"border-bottom: 1px solid $col_border; border-right: 1px solid $col_border;\">".$gameserver->players[$i]["deaths"]."</td>";
		}
		if ($gameserver->playerkeys["kills"]) {
		echo "<td align=center class=\"bluebox\" style=\"border-bottom: 1px solid $col_border; border-right: 1px solid $col_border;\">".$gameserver->players[$i]["kills"]."</td>";
		}
		if ($gameserver->playerkeys["time"]) {
		echo "<td align=center class=\"bluebox\" style=\"border-bottom: 1px solid $col_border; border-right: 1px solid $col_border;\">".$gameserver->players[$i]["time"]."</td>";
		}
		echo "</tr>";
					}
				}

				if ($o == 0)
					echo "<tr><td style=\"padding-left: 4px; border: 1px solid $col_border; border-top: none;\" class=\"bluebox\">(none)</td></tr>";
				?>
				</table>
				</td><td align=center valign=top>
				<table width="100%" cellspacing=0 cellpadding=3><tr>

		<?
		 if ($gameserver->playerkeys["name"]) {
		  ?>
		 <td class="redbox" style="padding-left: 4px; border: 1px solid <?=$col_border?>;"><strong>Player Name</strong></td>
		<? }
		if ($gameserver->playerkeys["ping"]) {
		  ?>
		<td align=center class="redbox" style="border: 1px solid <?=$col_border?>; border-left: none;"><strong>Ping</strong></td>
		<? }
		if ($gameserver->playerkeys["score"]) {
		  ?>
		<td align=center class="redbox" style="border: 1px solid <?=$col_border?>; border-left: none;"><strong>Score</strong></td>
		 <? }
		if ($gameserver->playerkeys["deaths"]) {
		  ?>
		<td align=center class="redbox" style="border: 1px solid <?=$col_border?>; border-left: none;"><strong>Deaths</strong></td>
		 <? }
		if ($gameserver->playerkeys["kills"]) {
		  ?>
		<td align=center CLASS="ONGL" style="border: 1px solid <?=$col_border?>; border-left: none;"><strong>Kills</strong></td>
		 <? }
		if ($gameserver->playerkeys["time"]) {
		  ?>
		<td align=center class="redbox" style="border: 1px solid <?=$col_border?>; border-left: none;"><strong>Time</strong></td>
		 <? } ?>





		</tr>
				<?
				$o = 0;
				for ($i=0;$i<$gameserver->numplayers+1;$i++) {
					if ($gameserver->playerteams[$i] == "2") {
						$o++;
						echo "<tr>";
						if ($gameserver->playerkeys["name"]) {
						echo "<td class=\"redbox\" style=\"padding-left: 4px; border: 1px solid $col_border; border-top: none;\">".$gameserver->htmlize($gameserver->players[$i]["name"])."</td>";
						}
						if ($gameserver->playerkeys["ping"]) {
						echo"<td align=center class=\"redbox\" style=\"border-bottom: 1px solid $col_border; border-right: 1px solid $col_border;\">".$gameserver->players[$i]["ping"]."</td>";
						}
						if ($gameserver->playerkeys["score"]) {
						echo"<td align=center class=\"redbox\" style=\"border-bottom: 1px solid $col_border; border-right: 1px solid $col_border;\">".$gameserver->players[$i]["score"]."</td>";
						}
						if ($gameserver->playerkeys["deaths"]) {
						echo"<td align=center class=\"redbox\" style=\"border-bottom: 1px solid $col_border; border-right: 1px solid $col_border;\">".$gameserver->players[$i]["deaths"]."</td>";
						}
						if ($gameserver->playerkeys["kills"]) {
						echo "<td align=center class=\"bluebox\" style=\"border-bottom: 1px solid $col_border; border-right: 1px solid $col_border;\">".$gameserver->players[$i]["kills"]."</td>";
						}
						if ($gameserver->playerkeys["time"]) {
						echo"<td align=center class=\"redbox\" style=\"border-bottom: 1px solid $col_border; border-right: 1px solid $col_border;\">".$gameserver->players[$i]["time"]."</td>";
						}
						echo"</tr>";
					}
				}

				if ($o == 0)
					echo "<tr><td style=\"padding-left: 4px; border: 1px solid $col_border; border-top: none;\" class=\"redbox\">(none)</td></tr>";
				?>
				</table>
				</td></tr>
				</table>
				</td></tr>
				</table><br>
				<font class="specteam">Spectators:</font> <?
				$o = 0;
				for ($i=0;$i<$gameserver->numplayers;$i++) {
					if ($gameserver->playerteams[$i] == "3") {
						$o++;
						echo $gameserver->htmlize($gameserver->players[$i]["name"]);
						if ($o < $gameserver->spec)
							echo "<font class=\"specteam\">,</font> ";
					}
				}
				if ($o == 0) echo "(none)";




				}

		/*	}else{
				echo "We were unable to contact the server you requested, it is most likely <font class=red>Offline</font>";
			}*/
			?>
			</TD>
		</TR>
	</TABLE>


<!--	Fin du code généré par le module Servstat		-->
<?
closeTable(); 
include_once($root_path."npds/footer.php");
?>
