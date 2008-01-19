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
   	//traduction du module
    include_once($serv_lang_path.$language.".php");

    
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
	<TABLE BORDER=0 CELLSPACING=0 CELLPADDING=2 width="100%">
		<TR>
		    <td width="30%">&nbsp;</td>
		    <td width="30%" align="center">
		        <?
	        	global $rep_module;
				$picpath="./modules/".$rep_module."/images/servstat.jpg"
		        ?>
		        <img src="<?=$picpath?>" width="317" height="62" border="0">
		        <br>&nbsp;
		    </td>
		    <td align="right" width="30%">
		        <i><?=servstat_translate("Version 2.0 basée sur")?> <a href="http://www.squery.com" class="link">SQuery 3.9</a></i>
			</td>
		</tr>
		<tr>
			<TD align=center colspan="3">
				<form method="get" action="modules.php">
					<table>
						<tr>
							<td class="NOIR">
								<input type="hidden" name="ModPath" value="<?=$modpath?>">
								<input type="hidden" name="ModStart" value="<?=$modstart?>">
								&nbsp;&nbsp;&nbsp;<?=servstat_translate("Adresse")?>:&nbsp;&nbsp;&nbsp;
								<input type=text name=ip value="<?=$ip?>" class="TEXTBOX_STANDARD">
							</td>
							<td class="NOIR">
								&nbsp;&nbsp;&nbsp;<?=servstat_translate("Port")?>:&nbsp;&nbsp;&nbsp;
								<input type=text name=port value="<?=$port?>" class="TEXTBOX_STANDARD">
							</td>
							<td class="NOIR">
								&nbsp;&nbsp;&nbsp;<?=servstat_translate("Jeu")?>:&nbsp;&nbsp;&nbsp;
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
		</tr>
		<TR>
		    <td colspan="3" align="center"><?=afficheServeurs();?></td>
		</TR>
	</TABLE><br>
<?
/***************************************************************************************/
/*                      FIN DES CHAMPS PERMETTANT D'ENVOYER    				           */
/*						UNE REQUETE D'INTERROGATION DE SERVEUR     		               */
/***************************************************************************************/

$qport=calcqport($port,$qgame);
if ($queryfromurl) {
	include_once($serv_lib_path."gsQuery.php");
 	$gameserver=gsQuery::unserializeFromURL("http://www.squery.com/sqserial/serializer.php?ip=$ip&port=$qport&protocol=$enginetype");
    if(!$gameserver) {
        echo servstat_translate("Impossible de parcourir l'objet sérialisé");
	}
}else{
	$gameserver=queryServer($ip,$qport,$enginetype);
}
//Debug
//echo "<!--".var_dump($gameserver)."-->";
/***************************************************************************************/
/*                      AFFICHAGE DU TABLEAU DETAILLANT LES                            */
/*                      LES CARACT2RISTIQUES GENERALES DU SERVEUR                      */
/***************************************************************************************/
if ($gameserver) {
	?>
	<strong class="big"></strong><br>
	<table width="70%" cellspacing=0 cellpadding=3 align="center" border=0>
	    <tr CLASS="HEADER">
	        <td colspan =2 align="center"><?=$gameserver->htmlize($gameserver->servertitle)?></td>
	    </tr>
		<tr class="LIGNA">
		    <td width="50%" valign="top" align="center" cellpadding=10>
		        <?
		            //Définition du chemin de l'image
		        	$mappic=cheminImage($gameserver);
		        ?>
				<img src='<?=htmlspecialchars($mappic)?>' alt="<?=htmlspecialchars($gameserver->maptitle)?>" width="160px" height="120px">
				<br><br>
				<table width="100%" cellspacing=0 cellpadding=3 border=0>
					<? $gameserver->mapname=ucwords(htmlspecialchars($gameserver->mapname)); ?>
					<tr>
						<td align="right" class="NOIR">
							<?=servstat_translate("IP/URL")?> :
						</td>
						<td>
							<strong><?=$gameserver->address?> : <?=$gameserver->hostport?></strong>
						</td>
					</tr>
					<tr>
						<td align="right" class="NOIR">
							<?=servstat_translate("Jeu")?> :
						</td>
						<td>
							<?=gametitle(htmlentities($gameserver->gamename))?>
						</td>
					</tr>
					<tr>
						<td align="right" class="NOIR">
							<?=servstat_translate("Map")?> :
						</td>
						<td>
							<?=$gameserver->mapname?>
						</td>
					</tr>
					<? $gameserver->gametype=strtoupper(htmlentities($gameserver->gametype)); ?>
					<tr>
						<td align="right" class="NOIR">
							<?=servstat_translate("Joueurs")?>:
						</td>
						<td>
							<b><?=$gameserver->numplayers?> / <?=$gameserver->maxplayers;?></b>
							<?if ($gameserver->numplayers == $gameserver->maxplayers)
								echo "&nbsp;&nbsp;&nbsp;(<font class=\"color\">".servstat_translate("Serveur plein")."</font>)";
							elseif ($gameserver->numplayers == 0)
								echo "&nbsp;&nbsp;&nbsp;(<font class=\"color\">".servstat_translate("Serveur vide")."</font>)";
							?>
						</td>
					</tr>
					<?
					if (isset($gameserver->rules["sv_punkbuster"])&&($gameserver->rules["sv_punkbuster"]<>""))
					{ ?>
					<tr><td align="right" class="NOIR"><?=servstat_translate("PunkBuster")?>:</td><td><?=($gameserver->rules["sv_punkbuster"] == 1 ? "Enabled" : "Disabled")?></td></tr>
					<?}
					if (isset($gameserver->password)){
					    switch($gameserver->password){
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
						echo "<tr><td align=\"center\" colspan=2><b>$use_pass</b></td></tr>";
					}?>
				</table>
			</td>
			<td width="50%" valign="top">
				<table border=0 cellspacing=1 cellpadding=1>
					<tr>
						<td class="BOXB">
							<font class="color"><?=servstat_translate("Version")?>:</font>
						</td>
						<td class="BOXB">
							<?=htmlentities($gameserver->gameversion)?>
						</td>
					</tr>
					<tr>
						<td class="BOXB">
							<font class="color"><?=servstat_translate("Type de jeu")?>:</font>
						</td>
						<td class="BOXB">
						    <?=$gameserver->gametype?>
						</td>
					</tr>
					<?
					if (isset($gameserver->rules[".admin"])&&($gameserver->rules[".admin"]<>""))
					{ ?>
					<tr><td class="BOXB"><?=servstat_translate("Nom Admin")?>:</td><td class="BOXB"><?=$gameserver->rules[".admin"]?></td></tr>
					<?}
					if (isset($gameserver->rules["admin"])&&($gameserver->rules["admin"]<>""))
					{ ?>
					<tr><td class="BOXB"><?=servstat_translate("Nom Admin")?>:</td><td class="BOXB"><?=$gameserver->rules["admin"]?></td></tr>
					<?}
					if (isset($gameserver->rules["adminname"])&&($gameserver->rules["adminname"]<>""))
					{ ?>
					<tr><td class="BOXB"><font class ="color"><?=servstat_translate("Nom Admin")?>:</font></td><td class="BOXB"><?=$gameserver->rules["adminname"]?></td></tr>
					<?}
					if (isset($gameserver->rules["admin name"])&&($gameserver->rules["admin name"]<>""))
					{ ?>
					<tr><td class="BOXB"><font class ="color"><?=servstat_translate("Nom Admin")?>:</font></td><td class="BOXB"><?=$gameserver->rules["admin name"]?></td></tr>
					<?}
					if (isset($gameserver->rules["administrator"])&&($gameserver->rules["administrator"]<>""))
					{ ?>
					<tr><td class="BOXB"><font class ="color"><?=servstat_translate("Nom Admin")?>:</font></td><td class="BOXB"><?=$gameserver->rules["administrator"]?></td></tr>
					<?}
					if (isset($gameserver->rules[".administrator"])&&($gameserver->rules[".administrator"]<>""))
					{ ?>
					<tr><td class="BOXB"><font class ="color"><?=servstat_translate("Nom Admin")?>:</font></td><td class="BOXB"><?=$gameserver->rules[".administrator"]?></td></tr>
					<?}
					if (isset($gameserver->rules[".email"])&&($gameserver->rules[".email"]<>""))
					{ ?>
					<tr><td class="BOXB"><font class ="color"><?=servstat_translate("Email Admin")?>:</font></td><td class="BOXB"><?=$gameserver->rules[".email"]?></td></tr>
					<? }
					if (isset($gameserver->rules["sv_contact"])&&($gameserver->rules["sv_contact"]<>""))
					{ ?>
					<tr><td class="BOXB"><font class ="color"><?=servstat_translate("Email Admin")?>:</font></td><td class="BOXB"><?=$gameserver->rules["sv_contact"]?></td></tr>
					<? }
					if (isset($gameserver->rules["adminemail"])&&($gameserver->rules["adminemail"]<>""))
					{ ?>
					<tr><td class="BOXB"><font class ="color"><?=servstat_translate("Email Admin")?>:</font></td><td class="BOXB"><?=$gameserver->rules["adminemail"]?></td></tr>
					<? }
					if (isset($gameserver->rules["admin email"])&&($gameserver->rules["admin email"]<>""))
					{ ?>
					<tr><td class="BOXB"><font class ="color"><?=servstat_translate("Email Admin")?>:</font></td><td class="BOXB"><?=$gameserver->rules["admin email"]?></td></tr>
					<? }
					if (isset($gameserver->rules["admin e-mail"])&&($gameserver->rules["admin e-mail"]<>""))
					{ ?>
					<tr><td class="BOXB"><font class ="color"><?=servstat_translate("Email Admin")?>:</font></td><td class="BOXB"><?=$gameserver->rules["admin e-mail"]?></td></tr>
					<? }
					if (isset($gameserver->rules[".e-mail"])&&($gameserver->rules[".e-mail"]<>""))
					{ ?>
					<tr><td class="BOXB"><font class ="color"><?=servstat_translate("Email Admin")?>:</font></td><td class="BOXB"><?=$gameserver->rules[".e-mail"]?></td></tr>
					<? }
					if (isset($gameserver->rules[".icq"])&&($gameserver->rules[".icq"]<>""))
					{ ?>
					<tr><td class="BOXB"><font class ="color"><?=servstat_translate("ICQ Admin")?>:</font></td><td class="BOXB"><?=$gameserver->rules[".icq"]?></td></tr>
					<? }
					if (isset($gameserver->rules["icq"])&&($gameserver->rules["icq"]<>""))
					{ ?>
					<tr><td class="BOXB"><font class ="color"><?=servstat_translate("ICQ Admin")?>:</font></td><td class="BOXB"><?=$gameserver->rules["icq"]?></td></tr>
					<? }
					if (isset($gameserver->rules[".website"])&&($gameserver->rules[".website"]<>""))
					{ ?>
					<tr><td class="BOXB"><font class ="color"><?=servstat_translate("Site Web")?>:</font></td><td class="BOXB"><?=$gameserver->rules[".website"]?></td></tr>
					<? }
					if (isset($gameserver->rules[".location"])&&($gameserver->rules[".location"]<>""))
					{ ?>
					<tr><td class="BOXB"><font class ="color"><?=servstat_translate("Localisation serveur")?>:</font></td><td class="BOXB"><?=$gameserver->rules[".location"]?></td></tr>
					<? }
					if (isset($gameserver->rules["location"])&&($gameserver->rules["location"]<>""))
					{ ?>
					<tr><td class="BOXB"><font class ="color"><?=servstat_translate("Localisation serveur")?>:</font></td><td class="BOXB"><?=$gameserver->rules["location"]?></td></tr>
					<? }
					if (isset($gameserver->rules["email"])&&($gameserver->rules["email"]<>""))
					{ ?>
					<tr><td class="BOXB"><font class ="color"><?=servstat_translate("Email Admin")?>:</font></td><td class="BOXB"><?=$gameserver->rules["email"]?></td></tr>
					<? }
					if (isset($gameserver->rules[".url"])&&($gameserver->rules[".url"]<>""))
					{ ?>
					<tr><td class="BOXB"><font class ="color"><?=servstat_translate("Site Web")?>:</font></td><td class="BOXB"><?=$gameserver->rules[".url"]?></td></tr>
					<? }
					if (isset($gameserver->rules["web"])&&($gameserver->rules["web"]<>""))
					{ ?>
					<tr><td class="BOXB"><font class ="color"><?=servstat_translate("Site Web")?>:</font></td><td class="BOXB"><?=$gameserver->rules["web"]?></td></tr>
					<? }
					if (isset($gameserver->rules["webpage"])&&($gameserver->rules["webpage"]<>""))
					{ ?>
					<tr><td class="BOXB"><font class ="color"><?=servstat_translate("Site Web")?>:</font></td><td class="BOXB"><?=$gameserver->rules["webpage"]?></td></tr>
					<? }
					if (isset($gameserver->rules["url"])&&($gameserver->rules["url"]<>""))
					{ ?>
					<tr><td class="BOXB"><font class ="color"><?=servstat_translate("Site Web")?>:</font></td><td class="BOXB"><?=$gameserver->rules["url"]?></td></tr>
					<? }
					if (isset($gameserver->rules[".irc"])&&($gameserver->rules[".irc"]<>""))
					{ ?>
					<tr><td class="BOXB"><font class ="color"><?=servstat_translate("Canal IRC")?>:</font></td><td class="BOXB"><?=$gameserver->rules[".irc"]?></td></tr>
					<? }
					if (isset($gameserver->rules["irc"])&&($gameserver->rules["irc"]<>""))
					{ ?>
					<tr><td class="BOXB"><font class ="color"><?=servstat_translate("Canal IRC")?>:</font></td><td class="BOXB"><?=$gameserver->rules["irc"]?></td></tr>
					<? }
					if (isset($gameserver->rules["cpu"])&&($gameserver->rules["cpu"]<>""))
					{ ?>
					<tr><td class="BOXB"><font class ="color"><?=servstat_translate("CPU")?>:</font></td><td class="BOXB"><?=$gameserver->rules["cpu"]?></td></tr>
					<? }
					if (isset($gameserver->rules[".cpu"])&&($gameserver->rules[".cpu"]<>""))
					{ ?>
					<tr><td class="BOXB"><font class ="color"><?=servstat_translate("CPU")?>:</font></td><td class="BOXB"><?=$gameserver->rules[".cpu"]?></td></tr>
					<? }
					if (isset($gameserver->rules["server spec"])&&($gameserver->rules["server spec"]<>""))
					{ ?>
					<tr><td class="BOXB"><font class ="color"><?=servstat_translate("CPU")?>:</font></td><td class="BOXB"><?=$gameserver->rules["server spec"]?></td></tr>
					<? }
                    if (isset($gameserver->rules["connection"])&&($gameserver->rules["connection"]<>""))
					{ ?>
					<tr><td class="BOXB"><font class ="color"><?=servstat_translate("Connexion")?>:</font></td><td class="BOXB"><?=$gameserver->rules["connection"]?></td></tr>
					<? }
					if (isset($gameserver->rules["gamestartup"])&&($gameserver->rules["gamestartup"]<>""))
					{ ?>
					<tr><td class="BOXB"><font class ="color"><?=servstat_translate("Dernier redémarrage")?>:</font></td><td class="BOXB"><?=$gameserver->rules["gamestartup"]?></td></tr>
					<? }
					if (isset($gameserver->rules["gameversion"])&&($gameserver->rules["gameversion"]<>""))
					{ ?>
					<tr><td class="BOXB"><font class ="color"><?=servstat_translate("Version jeu")?>:</font></td><td class="BOXB"><?=$gameserver->rules["gameversion"]?></td></tr>
					<? }
					if (isset($gameserver->rules["plug"])&&($gameserver->rules["plug"]<>""))
					{ ?>
					<tr><td class="BOXB"><font class ="color"><?=servstat_translate("Plugin")?>:</font></td><td class="BOXB"><?=$gameserver->rules["plug"]?></td></tr>
					<? }
					if (isset($gameserver->rules["motd"])&&($gameserver->rules["motd"]<>""))
					{ ?>
					<tr><td class="BOXB"><font class ="color"><?=servstat_translate("Motd")?>:</font></td><td class="BOXB"><?=$gameserver->rules["motd"]?></td></tr>
					<? }?>
				</table>
				<br>
				<?=$gameserver->docvars($gameserver);?>
			</td>

		</tr>
	</table>
<?
}
/****************************************************************************************/
/*               FIN DU TABLEAU DES	CARACT2RISTIQUES GENERALES DU SERVEUR				*/
/****************************************************************************************/
?>
<br>
<?
/****************************************************************************************/
/*               TABLEAU DETAIL DES JOUEURS				*/
/****************************************************************************************/
?>

	<TABLE cellpadding=0 cellspacing=0 width="100%" align="center" border=0>
		<?
		if(!count($gameserver->playerteams)){
		//////////////////////////////////////////////////////////
		// 				Jeu sans équipe (Ex: COD) ou dont		//
		//				les librairies ne le gère pas (Ex: CS)  //
		//////////////////////////////////////////////////////////
		?>
		<tr>
			<td align=center valign=top>
				<table width="100%" cellspacing=0 cellpadding=3>
				    <tr class="HEADER">
				        <?
							//Détermination du nombre de colonne pour le tableau
							if (isset ($gameserver->playerkeys)){
							    $colspan = sizeof($gameserver->playerkeys);
							}else{
							    $colspan = 0;
							}
				        ?>
				        <td colspan=<?=$colspan?> align="center"><?=servstat_translate("Informations sur les joueurs")?></td>
				    </tr>
					<tr>
						<?
						 if (isset($gameserver->playerkeys["name"])){
						  ?>
						<td align=center CLASS="ONGL"><?=servstat_translate("Pseudo")?></td>
						<? }
						if (isset($gameserver->playerkeys["score"])) {
						  ?>
						<td align=center CLASS="ONGL"><?=servstat_translate("Score")?></td>
						 <? }
						if (isset($gameserver->playerkeys["goal"])) {
						  ?>
						<td align=center CLASS="ONGL"><?=servstat_translate("Buts")?></td>
						 <? }
						if (isset($gameserver->playerkeys["leader"])) {
						  ?>
						<td align=center CLASS="ONGL"><?=servstat_translate("Leader")?></td>
						 <? }
						if (isset($gameserver->playerkeys["enemy"])) {
						  ?>
						<td align=center CLASS="ONGL"><?=servstat_translate("Ennemi")?></td>
						 <? }
						if (isset($gameserver->playerkeys["kia"])) {
						  ?>
						<td align=center CLASS="ONGL"><?=servstat_translate("KIA")?></td>
						 <? }
						if (isset($gameserver->playerkeys["roe"])) {
						  ?>
						<td align=center CLASS="ONGL"><?=servstat_translate("ROE")?></td>
						 <? }
						if (isset($gameserver->playerkeys["ping"])) {
						  ?>
						<td align=center CLASS="ONGL"><?=servstat_translate("Ping")?></td>
						<? }
						if (isset($gameserver->playerkeys["kills"])) {
						  ?>
						<td align=center CLASS="ONGL"><?=servstat_translate("Tués")?></td>
						 <? }
						if (isset($gameserver->playerkeys["deaths"])) {
						  ?>
						<td align=center CLASS="ONGL"><?=servstat_translate("Morts")?></td>
						 <? }
						if (isset($gameserver->playerkeys["skill"])) {
						  ?>
						<td align=center CLASS="ONGL"><?=servstat_translate("Skill")?></td>
						 <? }
						if (isset($gameserver->playerkeys["time"])) {
						  ?>
						<td align=center CLASS="ONGL"><?=servstat_translate("Temps de jeu")?></td>
						<? }
						 ?>
					</tr>

			<?
			if(!count($gameserver->players)) {
			    //Cas où aucun joueur à afficher
		    	echo "<tr><td align=\"center\">(".servstat_translate("Aucun joueur actuellement").")</td></tr>";
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
				    	<td colspan=4 ALIGN="center"> <a href="http://www.funxp.net" class="BOX" target="_blank">© cassosiation 2005</a> & <a href="http://www.squery.com" class="BOX" target="_blank">Squery</a></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>

		<?
		}else{
		//////////////////////////////////////////////////////////
		// 				Jeu en  équipe (Ex: SOF2) 				//
		//////////////////////////////////////////////////////////
		?>
		<tr>
	        <?
				//Détermination du nombre de colonne pour les tableaux
				if (isset ($gameserver->playerkeys)){
				    $colspan = sizeof($gameserver->playerkeys);
				}else{
				    $colspan = 0;
				}
	        ?>
			<td valign=top><br>
				<table border=0 cellspacing=0 cellpadding=3 width="100%">
					<tr class="HEADER">
						<td align=center colspan="<?=$colspan?>">
							<?=servstat_translate("Informations sur les joueurs")?>
						</td>
					</tr>
					<tr>
						<td align=center width="50%" style="padding-bottom: 2px;">
							<font class="NOIR"><?=$gameserver->team1?></font><br>
						</td>
						<td align=center width="50%" style="padding-bottom: 2px;">
							<font class="NOIR"><?=$gameserver->team2?></font><br>
							<table width=100% cellspacing=0 cellpadding=0 border=1>

							</table>
						</td>
					</tr>
					<tr>
						<td align=center valign=top>
							<table width="100%" cellspacing=0 cellpadding=2 border=0>
								<tr>
									<?
									 if ($gameserver->playerkeys["name"]) {
									  ?>
									 <td CLASS="ONGL"><?=servstat_translate("Pseudo")?></td>
									<? }
									if ($gameserver->playerkeys["ping"]) {
									  ?>
									<td align=center CLASS="ONGL"><?=servstat_translate("Ping")?></td>
									<? }
									if ($gameserver->playerkeys["score"]) {
									  ?>
									<td align=center CLASS="ONGL"><?=servstat_translate("Score")?></td>
									 <? }
									if ($gameserver->playerkeys["deaths"]) {
									  ?>
									<td align=center CLASS="ONGL"><?=servstat_translate("Morts")?></td>
									 <? }
									if ($gameserver->playerkeys["kills"]) {
									  ?>
									<td align=center CLASS="ONGL"><?=servstat_translate("Tués")?></td>
									 <? }
									if ($gameserver->playerkeys["time"]) {
									  ?>
									<td align=center CLASS="ONGL"><?=servstat_translate("Temps de jeu")?></td>
									 <? } ?>
								</tr>
								<?
								//Affichage du détail des joueurs pour la première équipe
								$o = 0;
								for ($i=0;$i<$gameserver->numplayers+1;$i++) {
									if ($gameserver->playerteams[$i] == "1") {
										$o++;
										$rowcolor=tablos();
	    								echo '	<tr '.$rowcolor.'>';
										if (isset($gameserver->playerkeys["name"])) {
											echo "<td>".$gameserver->htmlize($gameserver->players[$i]["name"])."</td>";
										}
										if (isset($gameserver->playerkeys["ping"])) {
											echo "<td align=center \">".$gameserver->players[$i]["ping"]."</td>";
										}
										if (isset($gameserver->playerkeys["score"])) {
											echo "<td align=center \">".$gameserver->players[$i]["score"]."</td>";
										}
										if (isset($gameserver->playerkeys["deaths"])) {
											echo "<td align=center \">".$gameserver->players[$i]["deaths"]."</td>";
										}
										if (isset($gameserver->playerkeys["kills"])) {
											echo "<td align=center \">".$gameserver->players[$i]["kills"]."</td>";
										}
										if (isset($gameserver->playerkeys["time"])) {
											echo "<td align=center \">".$gameserver->players[$i]["time"]."</td>";
										}
										echo "</tr>";
									}
								}

								if ($o == 0){
									echo "<tr><td align=center>(".servstat_translate("Aucun joueur actuellement").")</td></tr>";
								}else{
									echo "\n<tr><td class=\"ONGL\">&nbsp;Nombre de joueurs : ".$gameserver->teamcnt1."</td>";
									echo '<td CLASS="ONGL" colspan = '.($colspan-1).'>';
									if (isset($gameserver->scorelimit)&& isset($gameserver->teamscore1)){
										echo "&nbsp;".servstat_translate("Score total")." : ".$gameserver->teamscore1." / ".$gameserver->scorelimit;
									}
									echo "</td></tr>";
								}
								?>
							</table>
						</td>
						<td align=center valign=top>
							<table width="100%" cellspacing=0 cellpadding=2 border=0>
								<tr>
									<?
									 if ($gameserver->playerkeys["name"]) {
									  ?>
									 <td CLASS="ONGL"><?=servstat_translate("Pseudo")?></td>
									<? }
									if ($gameserver->playerkeys["ping"]) {
									  ?>
									<td align=center CLASS="ONGL"><?=servstat_translate("Ping")?></td>
									<? }
									if ($gameserver->playerkeys["score"]) {
									  ?>
									<td align=center CLASS="ONGL"><?=servstat_translate("Score")?></td>
									 <? }
									if ($gameserver->playerkeys["deaths"]) {
									  ?>
									<td align=center CLASS="ONGL"><?=servstat_translate("Morts")?></td>
									 <? }
									if ($gameserver->playerkeys["kills"]) {
									  ?>
									<td align=center CLASS="ONGL"><?=servstat_translate("Tués")?></td>
									 <? }
									if ($gameserver->playerkeys["time"]) {
									  ?>
									<td align=center CLASS="ONGL"><?=servstat_translate("Temps de jeu")?></td>
									 <? } ?>
								</tr>
								<?
								//Affichage du détail des joueurs pour la seconde équipe
								$o = 0;
								for ($i=0;$i<$gameserver->numplayers+1;$i++) {
									if ($gameserver->playerteams[$i] == "2") {
										$o++;
										$rowcolor=tablos();
	    								echo '	<tr '.$rowcolor.'>';
										if (isset($gameserver->playerkeys["name"])) {
											echo "<td>".$gameserver->htmlize($gameserver->players[$i]["name"])."</td>";
										}
										if (isset($gameserver->playerkeys["ping"])) {
											echo "<td align=center \">".$gameserver->players[$i]["ping"]."</td>";
										}
										if (isset($gameserver->playerkeys["score"])) {
											echo "<td align=center \">".$gameserver->players[$i]["score"]."</td>";
										}
										if (isset($gameserver->playerkeys["deaths"])) {
											echo "<td align=center \">".$gameserver->players[$i]["deaths"]."</td>";
										}
										if (isset($gameserver->playerkeys["kills"])) {
											echo "<td align=center \">".$gameserver->players[$i]["kills"]."</td>";
										}
										if (isset($gameserver->playerkeys["time"])) {
											echo "<td align=center \">".$gameserver->players[$i]["time"]."</td>";
										}
										echo "</tr>";
									}
								}
								if ($o == 0){
									echo "<tr><td align=center>(".servstat_translate("Aucun joueur actuellement").")</td></tr>";
								}else{
									echo "\n<tr><td class=\"ONGL\">&nbsp;Nombre de joueurs : ".$gameserver->teamcnt2."</td>";
									echo '<td CLASS="ONGL" colspan = '.($colspan-1).'>';
									if (isset($gameserver->scorelimit)&& isset($gameserver->teamscore2)){
										echo "&nbsp;Score total : ".$gameserver->teamscore2." / ".$gameserver->scorelimit;
									}
									echo "</td></tr>";
								}
								?>
							</table>
						</td>
					</tr>
					<tr>
					    <td colspan="2">
							<font align="right" class="NOIR"> &nbsp; <?=servstat_translate("Spectateurs")?>:</font>
							<?
							$o = 0;
							for ($i=0;$i<$gameserver->numplayers;$i++) {
								if ($gameserver->playerteams[$i] == "3") {
									$o++;
									echo $gameserver->htmlize($gameserver->players[$i]["name"]);
									if ($o < $gameserver->spec)
										echo "<font class=\"specteam\">,</font> ";
								}
							}
							if ($o == 0) echo "(".servstat_translate("Aucun actuellement").")";
							?>
					    </td>
					</tr>
					<tr CLASS="HEADER">
				    	<td colspan=4 ALIGN="center"> <a href="http://www.funxp.net" class="BOX" target="_blank">© cassosiation 2005</a> & <a href="http://www.squery.com" class="BOX" target="_blank">Squery</a></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<br>
			<?
			}
			?>

<!--	Fin du code généré par le module Servstat		-->
<?
closeTable(); 
include_once($root_path."footer.php");
?>
