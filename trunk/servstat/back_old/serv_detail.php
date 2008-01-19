<?PHP

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
/* Page d'affichage du détail des informations sur le serveur                                     */
/**************************************************************************************************/

	/**************/
	/* Inclusions */
	/**************/
	//config module
	require("serv_config.php");
	//mainfile
	if (!isset($mainfile)) { include_once($root_path."mainfile.php"); }
	//Header
	include_once($root_path."header.php");
	//fonctions du module
	include_once($serv_path."serv_functions.php");
	//Librairies de communication avec le serveur
    include_once($serv_lib_path."main.lib.php");

    
	//affichage des blocs de droite
	global $pdst;
	$pdst="1";


	OpenTable();


	$old_error_handler = set_error_handler("myErrorHandler");
	
	$blockmode=0;
	$ip = $_GET['ip'];
	$port = $_GET['port'];
	$qgame = $_GET['game'];
	$modpath = $_GET['ModPath'];
	$modstart = $_GET['ModStart'];
?>
    <!--	Code généré par le module Servstat		-->
<?
/***************************************************************************************/
/*                      AFFICHAGE DES CHAMPS PERMETTANT D'ENVOYER    		           */
/*						UNE REQUETE D'INTERROGATION DE SERVEUR     		               */
/***************************************************************************************/
?>
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
				<form method="get" action="modules.php">
					<table>
						<tr>
							<td>
								<input type="hidden" name="ModPath" value="<?=$modpath?>">
								<input type="hidden" name="ModStart" value="<?=$modstart?>">
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
								<input type="submit" value="Query" class="BOUTON_STANDARD">
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
<?
/***************************************************************************************/
/*                      FIN DES CHAMPS PERMETTANT D'ENVOYER    				           */
/*						UNE REQUETE D'INTERROGATION DE SERVEUR     		               */
/***************************************************************************************/
?>
	
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
								if (isset($gameserver->rules[".admin"])&&($gameserver->rules[".admin"]<>""))
								{ ?>
								<tr><td class="row"><font class ="color">Admin Name:</font></td><td class="row"><?=$gameserver->rules[".admin"]?></td></tr>
								<?}
								if (isset($gameserver->rules["admin"])&&($gameserver->rules["admin"]<>""))
								{ ?>
								<tr><td class="row"><font class ="color">Admin Name:</font></td><td class="row"><?=$gameserver->rules["admin"]?></td></tr>
								<?}
								if (isset($gameserver->rules["adminname"])&&($gameserver->rules["adminname"]<>""))
								{ ?>
								<tr><td class="row"><font class ="color">Admin Name:</font></td><td class="row"><?=$gameserver->rules["adminname"]?></td></tr>
								<?}
								if (isset($gameserver->rules["admin name"])&&($gameserver->rules["admin name"]<>""))
								{ ?>
								<tr><td class="row"><font class ="color">Admin Name:</font></td><td class="row"><?=$gameserver->rules["admin name"]?></td></tr>
								<?}
								if (isset($gameserver->rules["administrator"])&&($gameserver->rules["administrator"]<>""))
								{ ?>
								<tr><td class="row"><font class ="color">Admin Name:</font></td><td class="row"><?=$gameserver->rules["administrator"]?></td></tr>
								<?}
								if (isset($gameserver->rules[".administrator"])&&($gameserver->rules[".administrator"]<>""))
								{ ?>
								<tr><td class="row"><font class ="color">Admin Name:</font></td><td class="row"><?=$gameserver->rules[".administrator"]?></td></tr>
								<?}
								if (isset($gameserver->rules[".email"])&&($gameserver->rules[".email"]<>""))
								{ ?>
								<tr><td class="row"><font class ="color">Admin Email:</font></td><td class="row"><?=$gameserver->rules[".email"]?></td></tr>
								<? }
								if (isset($gameserver->rules["sv_contact"])&&($gameserver->rules["sv_contact"]<>""))
								{ ?>
								<tr><td class="row"><font class ="color">Admin Email:</font></td><td class="row"><?=$gameserver->rules["sv_contact"]?></td></tr>
								<? }
								if (isset($gameserver->rules["adminemail"])&&($gameserver->rules["adminemail"]<>""))
								{ ?>
								<tr><td class="row"><font class ="color">Admin Email:</font></td><td class="row"><?=$gameserver->rules["adminemail"]?></td></tr>
								<? }
								if (isset($gameserver->rules["admin email"])&&($gameserver->rules["admin email"]<>""))
								{ ?>
								<tr><td class="row"><font class ="color">Admin Email:</font></td><td class="row"><?=$gameserver->rules["admin email"]?></td></tr>
								<? }
								if (isset($gameserver->rules["admin e-mail"])&&($gameserver->rules["admin e-mail"]<>""))
								{ ?>
								<tr><td class="row"><font class ="color">Admin Email:</font></td><td class="row"><?=$gameserver->rules["admin e-mail"]?></td></tr>
								<? }
								if (isset($gameserver->rules[".e-mail"])&&($gameserver->rules[".e-mail"]<>""))
								{ ?>
								<tr><td class="row"><font class ="color">Admin Email:</font></td><td class="row"><?=$gameserver->rules[".e-mail"]?></td></tr>
								<? }
								if (isset($gameserver->rules[".icq"])&&($gameserver->rules[".icq"]<>""))
								{ ?>
								<tr><td class="row"><font class ="color">Admin ICQ:</font></td><td class="row"><?=$gameserver->rules[".icq"]?></td></tr>
								<? }
								if (isset($gameserver->rules["icq"])&&($gameserver->rules["icq"]<>""))
								{ ?>
								<tr><td class="row"><font class ="color">Admin ICQ:</font></td><td class="row"><?=$gameserver->rules["icq"]?></td></tr>
								<? }
								if (isset($gameserver->rules[".website"])&&($gameserver->rules[".website"]<>""))
								{ ?>
								<tr><td class="row"><font class ="color">Website:</font></td><td class="row"><?=$gameserver->rules[".website"]?></td></tr>
								<? }
								if (isset($gameserver->rules[".location"])&&($gameserver->rules[".location"]<>""))
								{ ?>
								<tr><td class="row"><font class ="color">Server Location:</font></td><td class="row"><?=$gameserver->rules[".location"]?></td></tr>
								<? }
								if (isset($gameserver->rules["location"])&&($gameserver->rules["location"]<>""))
								{ ?>
								<tr><td class="row"><font class ="color">Server Location:</font></td><td class="row"><?=$gameserver->rules["location"]?></td></tr>
								<? }
								if (isset($gameserver->rules["email"])&&($gameserver->rules["email"]<>""))
								{ ?>
								<tr><td class="row"><font class ="color">Admin Email:</font></td><td class="row"><?=$gameserver->rules["email"]?></td></tr>
								<? }
								if (isset($gameserver->rules[".url"])&&($gameserver->rules[".url"]<>""))
								{ ?>
								<tr><td class="row"><font class ="color">Website:</font></td><td class="row"><?=$gameserver->rules[".url"]?></td></tr>
								<? }
								if (isset($gameserver->rules["web"])&&($gameserver->rules["web"]<>""))
								{ ?>
								<tr><td class="row"><font class ="color">Website:</font></td><td class="row"><?=$gameserver->rules["web"]?></td></tr>
								<? }
								if (isset($gameserver->rules["webpage"])&&($gameserver->rules["webpage"]<>""))
								{ ?>
								<tr><td class="row"><font class ="color">Website:</font></td><td class="row"><?=$gameserver->rules["webpage"]?></td></tr>
								<? }
								if (isset($gameserver->rules["url"])&&($gameserver->rules["url"]<>""))
								{ ?>
								<tr><td class="row"><font class ="color">Website:</font></td><td class="row"><?=$gameserver->rules["url"]?></td></tr>
								<? }
								if (isset($gameserver->rules[".irc"])&&($gameserver->rules[".irc"]<>""))
								{ ?>
								<tr><td class="row"><font class ="color">IRC Channel:</font></td><td class="row"><?=$gameserver->rules[".irc"]?></td></tr>
								<? }
								if (isset($gameserver->rules["irc"])&&($gameserver->rules["irc"]<>""))
								{ ?>
								<tr><td class="row"><font class ="color">IRC Channel:</font></td><td class="row"><?=$gameserver->rules["irc"]?></td></tr>
								<? }
								if (isset($gameserver->rules["cpu"])&&($gameserver->rules["cpu"]<>""))
								{ ?>
								<tr><td class="row"><font class ="color">CPU:</font></td><td class="row"><?=$gameserver->rules["cpu"]?></td></tr>
								<? }
								if (isset($gameserver->rules[".cpu"])&&($gameserver->rules[".cpu"]<>""))
								{ ?>
								<tr><td class="row"><font class ="color">CPU:</font></td><td class="row"><?=$gameserver->rules[".cpu"]?></td></tr>
								<? }
								if (isset($gameserver->rules["server spec"])&&($gameserver->rules["server spec"]<>""))
								{ ?>
								<tr><td class="row"><font class ="color">CPU:</font></td><td class="row"><?=$gameserver->rules["server spec"]?></td></tr>
								<? }
                                if (isset($gameserver->rules["connection"])&&($gameserver->rules["connection"]<>""))
								{ ?>
								<tr><td class="row"><font class ="color">Connection:</font></td><td class="row"><?=$gameserver->rules["connection"]?></td></tr>
								<? }
								if (isset($gameserver->rules["gamestartup"])&&($gameserver->rules["gamestartup"]<>""))
								{ ?>
								<tr><td class="row"><font class ="color">Last Boot:</font></td><td class="row"><?=$gameserver->rules["gamestartup"]?></td></tr>
								<? }
								if (isset($gameserver->rules["gameversion"])&&($gameserver->rules["gameversion"]<>""))
								{ ?>
								<tr><td class="row"><font class ="color">Game Ver:</font></td><td class="row"><?=$gameserver->rules["gameversion"]?></td></tr>
								<? }
								if (isset($gameserver->rules["plug"])&&($gameserver->rules["plug"]<>""))
								{ ?>
								<tr><td class="row"><font class ="color">Motto:</font></td><td class="row"><?=$gameserver->rules["plug"]?></td></tr>
								<? }
								if (isset($gameserver->rules["motd"])&&($gameserver->rules["motd"]<>""))
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
							$mappic=cheminImage($gameserver);
							// if the picture isn't there, sets to unknown.gif.
							///////////////////////////////////////////////////////////////////////////////////
							?>
						</td>
						<td width="20%" valign="top" style="padding-left: 10px; padding-right: 10px;">
							<img src=<?=$mappic ?> alt="<?=htmlentities($gameserver->maptitle)?>" style="border: 1px solid #000000;">
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
								if (isset($gameserver->rules["sv_punkbuster"])&&($gameserver->rules["sv_punkbuster"]<>""))
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
						 if (isset($gameserver->playerkeys["name"])){
						  ?>
						<td align=center CLASS="ONGL">Pseudo</td>
						<? }
						if (isset($gameserver->playerkeys["score"])) {
						  ?>
						<td align=center CLASS="ONGL">Score</td>
						 <? }
						if (isset($gameserver->playerkeys["goal"])) {
						  ?>
						<td align=center CLASS="ONGL">Goals</td>
						 <? }
						if (isset($gameserver->playerkeys["leader"])) {
						  ?>
						<td align=center CLASS="ONGL">Leader</td>
						 <? }
						if (isset($gameserver->playerkeys["enemy"])) {
						  ?>
						<td align=center CLASS="ONGL">Enemy</td>
						 <? }
						if (isset($gameserver->playerkeys["kia"])) {
						  ?>
						<td align=center CLASS="ONGL">KIA</td>
						 <? }
						if (isset($gameserver->playerkeys["roe"])) {
						  ?>
						<td align=center CLASS="ONGL">ROE</td>
						 <? }
						if (isset($gameserver->playerkeys["ping"])) {
						  ?>
						<td align=center CLASS="ONGL">Ping</td>
						<? }
						if (isset($gameserver->playerkeys["kills"])) {
						  ?>
						<td align=center CLASS="ONGL">Kills</td>
						 <? }
						if (isset($gameserver->playerkeys["deaths"])) {
						  ?>
						<td align=center CLASS="ONGL">Deaths</td>
						 <? }
						if (isset($gameserver->playerkeys["skill"])) {
						  ?>
						<td align=center CLASS="ONGL">Skill</td>
						 <? }
						if (isset($gameserver->playerkeys["time"])) {
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
					if (isset($gameserver->playerkeys["name"])) {
					  ?>
					 <td><?=$gameserver->htmlize($gameserver->players[$i]["name"])?></td>
					<? }
					if (isset($gameserver->playerkeys["score"])) {
					  ?>
					 <td align=center><?=$gameserver->players[$i]["score"]?></td>
					<? }
					if (isset($gameserver->playerkeys["goal"])) {
					  ?>
					 <td align=center><?=$gameserver->players[$i]["goal"]?></td>
					<? }
					if (isset($gameserver->playerkeys["leader"])) {
					  ?>
					 <td align=center><?=$gameserver->players[$i]["leader"]?></td>
					<? }
					if (isset($gameserver->playerkeys["enemy"])) {
					  ?>
					 <td align=center><?=$gameserver->players[$i]["enemy"]?></td>
					<? }
					if (isset($gameserver->playerkeys["kia"])) {
					  ?>
					 <td align=center><?=$gameserver->players[$i]["kia"]?></td>
					<? }
					if (isset($gameserver->playerkeys["roe"])) {
					  ?>
					 <td align=center><?=$gameserver->players[$i]["roe"]?></td>
					<? }
					if (isset($gameserver->playerkeys["ping"])) {
					  ?>
					 <td align=center><?=$gameserver->players[$i]["ping"]?></td>
					<? }
					if (isset($gameserver->playerkeys["kills"])) {
					  ?>
					 <td align=center><?=$gameserver->players[$i]["kills"]?></td>
					<? }
					if (isset($gameserver->playerkeys["deaths"])) {
					  ?>
					 <td align=center><?=$gameserver->players[$i]["deaths"]?></td>
					<? }
					if (isset($gameserver->playerkeys["skill"])) {
					  ?>
					 <td align=center><?=$gameserver->players[$i]["skill"]?></td>
					<? }
					if (isset($gameserver->playerkeys["time"])) {
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
				    	<td colspan=4 ALIGN="center"> © cassosiation 2005</td>
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
		<tr>
			<td valign=top><br>
				<table border=0 cellspacing=0 cellpadding=0 width="100%">
					<tr>
						<td align=center width="50%" style="padding-bottom: 2px;">
							<font class="blueteam"><?=$gameserver->team1?></font><br>
							<table width=100% cellspacing=0 cellpadding=0>
								<tr>
									<td style="padding-left: 3px;">
										Players on this team: <font class=blueteam><?=$gameserver->teamcnt1?></font>
									</td>
									<?
										if ($gameserver->teamscore1) { ?>
									<td align=right style="padding-right: 3px;">
										Points scored: <font class=blueteam><?=$gameserver->teamscore1?></font>
										<? if ($gameserver->scorelimit) { ?>
										 / <font class=blueteam><?=$gameserver->scorelimit?></font>
										<? } ?>
									</td>
									<? 	} ?>
								</tr>
							</table>
						</td>
						<td align=center width="50%" style="padding-bottom: 2px;">
							<font class="redteam"><?=$gameserver->team2?></font><br>
							<table width=100% cellspacing=0 cellpadding=0>
								<tr>
									<td style="padding-left: 6px;">
										Players on this team: <font class=redteam><?=$gameserver->teamcnt2?></font>
									</td>
									<?
									   if ($gameserver->teamscore2) { ?>
									<td align=right style="padding-right: 3px;">
										Points scored: <font class=redteam><?=$gameserver->teamscore2?></font>
										<? if ($gameserver->scorelimit) { ?>
										 / <font class=redteam><?=$gameserver->scorelimit?></font>
										<? } ?>
									</td>
									<? } ?>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td align=center valign=top>
							<table width="100%" cellspacing=0 cellpadding=3>
								<tr>
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
						</td>
						<td align=center valign=top>
							<table width="100%" cellspacing=0 cellpadding=3>
								<tr>
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
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<br>
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
		/*	}else{
				echo "We were unable to contact the server you requested, it is most likely <font class=red>Offline</font>";
			}*/
			?>
						</TD>
					</TR>
				</TABLE>
			<?
			}
			?>

<!--	Fin du code généré par le module Servstat		-->
<?
closeTable(); 
include_once($root_path."footer.php");
?>
