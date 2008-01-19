<?
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

// set to the user defined error handler
$old_error_handler = set_error_handler("myErrorHandler");

function showFavorites() {
	global $favorites;
	$cnt = count($favorites);
	if ($cnt > 0)
		echo "(";
	for ($i=0;$i<$cnt;$i++) {
		$z = explode(",", $favorites[$i]);
		echo " <a href=\"".$_SERVER['PHP_SELF']."?name=SQuery&ip=$z[1]&port=$z[2]&game=$z[3]&block=0\" class=\"link\">$z[0]</a> ";
		if ($i+1 < $cnt) echo checkmark();
	}
	if ($cnt > 0)
		echo ")";
}

$blockmode=0;
$ip = $_GET['ip']; $port = $_GET['port'];$qgame = $_GET['game']; 
$blockmode = $_GET['block'];

$serv_lib_path="./lib/";
// require our main library =)
require($serv_lib_path.'main.lib.php');

//////////////////////////////////////////////////////////
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


?>
<HTML>
<HEAD>
<meta http-equiv="Content-Language" content="en-us">
<TITLE>
.:: SQuery <?=$version;?> .::
</TITLE>

<STYLE>
<?
include($serv_lib_path."default.css");
?>
</STYLE>
</HEAD>
<BODY LEFTMARGIN=0 TOPMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0>
<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>
<script language="JavaScript" src="<?echo$serv_lib_path;?>overlib.js"><!-- overLIB (c) Erik Bosrup --></script> 
<BR>
<TABLE BORDER=0 CELLSPACING=0 CELLPADDING=3 width=100%>
<TR><TD align=center>
<?
 if (!isset($static_ip)&&!$blockmode) {
	?>
	<TABLE BORDER=0 CELLSPACING=0 CELLPADDING=3 CLASS="main_table">
	<TD align=center>
   
	<table width=100% cellspacing=0 cellpadding=0>
	<tr><td><font class="color">
	<?
	if ($show_ip_entry_form) echo "Please enter an IP Address to query:";
	   else echo "Please Choose a Favorite:";
	  ?>
	</font></td><td align=right><?=showCredits(showVersion())?></td></tr>
	</table>
	<?
 if ($show_ip_entry_form) {
 	// Start of Form
 	?>
	<form method=get>
	<table><tr>
	<td>&nbsp;&nbsp;&nbsp;</td>
	<td><b class="color">&nbsp;&nbsp;&nbsp;Host:</b>&nbsp;&nbsp;&nbsp;<input type=text name=ip value="<?=$ip?>" style="width: 100px;"></td><td>&nbsp;&nbsp;&nbsp;<b class="color">Port:</b>&nbsp;&nbsp;&nbsp;<input type=text name=port value="<?=$port?>" style="width: 45px;"></td><td>&nbsp;&nbsp;&nbsp;<b class="color">Game:</b>&nbsp;&nbsp;&nbsp;

<select name="game">
<?

foreach($gametable as $key=>$value)
{
  echo "<OPTION ";
 if ($key==$qgame)
	{
	 echo "SELECTED ";
	 $enginetype=$value;
	}
 echo "VALUE=\"$key\">".$key;
}
//<OPTION SELECTED VALUE="igi2">IGI2
//<OPTION VALUE="sof2">SOFII
?>
</select></td><td>
<input type="hidden" name="block" value="0">
<input type=submit value="Query Server"></td>
	</tr>
	</table>
	</form>
	<?
	} // END of form
	else {
	foreach($gametable as $key=>$value)
	{
  	 if ($key==$qgame) $enginetype=$value;
  	 }
	}
	?>
	
	<?=showFavorites();?><br>
	</TD>
	</TR>
	</TABLE>
	<br>
	<?
} else { // doing static IP
        
	if (!$blockmode) {
          
	$ip = $static_ip;
	$port = ($static_port ? $static_port : "2302");
	$qgame = $static_game;
         }
	foreach($gametable as $key=>$value)
	{
   	if ($key==$qgame)
	{
	 $enginetype=$value;
	}
     
 }
	
}
if ($ip && $port) {
	?>
	<TABLE BORDER=0 CELLSPACING=0 CELLPADDING=3 class="main_table" align=center>
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
	}
	else $gameserver=queryServer($ip,$qport,$enginetype);

	if ($gameserver) {
	?>
		<strong class="big"><? echo gametitle(htmlentities($gameserver->gamename))?></strong><br>
		<TABLE cellpadding=0 cellspacing=0 width="550">
		<tr><td valign=top><br>
		<table width="100%" cellspacing=0 cellpadding=3 align="center">
		<tr><td width="100%" style="padding-left: 10px; padding-right: 10px;" valign=top>
		<table cellspacing=0 cellpadding=0>
		<tr><td class="row"><font class="color">Server name:</font></td><td class="row"><?=$gameserver->htmlize($gameserver->servertitle)?></td></tr>
		<tr><td class="row"><font class="color">Server Address:</font></td><td class="row"><?=$gameserver->address?>:<?=$gameserver->hostport?>&nbsp;&nbsp;&nbsp;</td></tr>
		<tr><td class="row"><font class="color">Server Version:</font></td><td class="row"><?=htmlentities($gameserver->gameversion)?></td></tr>
		<tr><td class="row"><font class="color">Players:</font></td><td class="row"><?=$gameserver->numplayers?> / <?=$gameserver->maxplayers;
	
		if ($gameserver->numplayers == $gameserver->maxplayers)
			echo "&nbsp;&nbsp;&nbsp;(<font class=\"color\">This server is FULL</font>)";
		elseif ($gameserver->numplayers == 0)
			echo "&nbsp;&nbsp;&nbsp;(<font class=\"color\">This server is EMPTY</font>)";
		?></td></tr>
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
<? }

?>
		</table>
		<br>
		<table cellspacing=0 cellpadding=0 width="100%">
		<tr><td class="row">
		<font class="color"><?

switch($gameserver->password)
{
case "1":
echo "This server requires a password to join</font> (Private Server)";
break;
case"0":
echo "This server is open to the public </font>(No password)";
break;
default:
echo "Server Password Setting is Unknown.";
break;
}

?></td></tr>
		</table>
		<br>

<?=$gameserver->docvars($gameserver);
/////////////////////////////////////////////////////////
// function is called, sees server type, creates a pathname to pictures based on mapname and server type.
$mappic=domappic($gameserver);
// if the picture isn't there, sets to unknown.gif.
///////////////////////////////////////////////////////////////////////////////////
?>

		</TD><td width="20%" valign="top" style="padding-left: 10px; padding-right: 10px;">
		<img src="<?=$mappic?>" alt="<?=htmlentities($gameserver->maptitle)?>" style="border: 1px solid #000000;"><br><br>
		<table width="100%" cellspacing=1 cellpadding=1>
		<? $gameserver->mapname=ucwords(htmlentities($gameserver->mapname)); ?>
		<tr><td><font class="color">Current Map:</font></td><td><?=$gameserver->mapname?></td></tr>
		<? $gameserver->gametype=strtoupper(htmlentities($gameserver->gametype)); ?>
		<tr><td><font class="color">Game Type:</font></td><td><?=$gameserver->gametype?></td></tr>

<?
if ($gameserver->rules["sv_punkbuster"]<>"") 
{ ?>
<tr><td><font class="color">PunkBuster:</font></td><td><?=($gameserver->rules["sv_punkbuster"] == 1 ? "Enabled" : "Disabled")?></td></tr>
<?} ?>

		</table>
		</td>
		</tr>
		</table>
		</table>
		<br>

		<div align=center><strong class="big">Player Information</strong></div><br>
		<TABLE cellpadding=0 cellspacing=0 width="520">

		<? 
		if(!count($gameserver->playerteams))  
		////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		 {  // No Team Info (like COD)
		?>
		
		<tr><td align=center valign=top>
		<table width="100%" cellspacing=0 cellpadding=3><tr>
<?
 if ($gameserver->playerkeys["name"]) {
  ?>
 <td class="bluebox" style="padding-left: 4px; border: 1px solid <?=$col_border?>;"><strong>Player Name</strong></td>
<? } 
if ($gameserver->playerkeys["score"]) {
  ?>
<td align=center class="bluebox" style="border: 1px solid <?=$col_border?>; border-left: none;"><strong>Score</strong></td>
 <? }
if ($gameserver->playerkeys["goal"]) {
  ?>
<td align=center class="bluebox" style="border: 1px solid <?=$col_border?>; border-left: none;"><strong>Goals</strong></td>
 <? }
if ($gameserver->playerkeys["leader"]) {
  ?>
<td align=center class="bluebox" style="border: 1px solid <?=$col_border?>; border-left: none;"><strong>Leader</strong></td>
 <? }
if ($gameserver->playerkeys["enemy"]) {
  ?>
<td align=center class="bluebox" style="border: 1px solid <?=$col_border?>; border-left: none;"><strong>Enemy</strong></td>
 <? }
if ($gameserver->playerkeys["kia"]) {
  ?>
<td align=center class="bluebox" style="border: 1px solid <?=$col_border?>; border-left: none;"><strong>KIA</strong></td>
 <? }
if ($gameserver->playerkeys["roe"]) {
  ?>
<td align=center class="bluebox" style="border: 1px solid <?=$col_border?>; border-left: none;"><strong>ROE</strong></td>
 <? }
if ($gameserver->playerkeys["ping"]) {
  ?>
<td align=center class="bluebox" style="border: 1px solid <?=$col_border?>; border-left: none;"><strong>Ping</strong></td>
<? }
if ($gameserver->playerkeys["kills"]) {
  ?>
<td align=center class="bluebox" style="border: 1px solid <?=$col_border?>; border-left: none;"><strong>Kills</strong></td>
 <? }
if ($gameserver->playerkeys["deaths"]) {
  ?>
<td align=center class="bluebox" style="border: 1px solid <?=$col_border?>; border-left: none;"><strong>Deaths</strong></td>
 <? } 
if ($gameserver->playerkeys["skill"]) {
  ?>
<td align=center class="bluebox" style="border: 1px solid <?=$col_border?>; border-left: none;"><strong>Skill</strong></td>
 <? } 
if ($gameserver->playerkeys["time"]) {
  ?>
<td align=center class="bluebox" style="border: 1px solid <?=$col_border?>; border-left: none;"><strong>Time</strong></td>
<? }
 ?>
   </tr>
 
	<?
	if(!count($gameserver->players)) {
    	echo "<tr><td style=\"padding-left: 4px; border: 1px solid $col_border; border-top: none;\" class=\"bluebox\">(none)</td></tr>";
    	}
	else {
	for ($i=0;$i<$gameserver->numplayers;$i++) {
 echo "<tr>";
if ($gameserver->playerkeys["name"]) {
  ?>
 <td class="bluebox" style="padding-left: 4px; border: 1px solid <?=$col_border?>; border-top: none;"><?=$gameserver->htmlize($gameserver->players[$i]["name"])?></td>
<? } 
if ($gameserver->playerkeys["score"]) {
  ?>
 <td align=center class="bluebox" style="border-bottom: 1px solid <?=$col_border?>; border-right: 1px solid <?=$col_border?>;"><?=$gameserver->players[$i]["score"]?></td>
<? }
if ($gameserver->playerkeys["goal"]) {
  ?>
 <td align=center class="bluebox" style="border-bottom: 1px solid <?=$col_border?>; border-right: 1px solid <?=$col_border?>;"><?=$gameserver->players[$i]["goal"]?></td>
<? }
if ($gameserver->playerkeys["leader"]) {
  ?>
 <td align=center class="bluebox" style="border-bottom: 1px solid <?=$col_border?>; border-right: 1px solid <?=$col_border?>;"><?=$gameserver->players[$i]["leader"]?></td>
<? }
if ($gameserver->playerkeys["enemy"]) {
  ?>
 <td align=center class="bluebox" style="border-bottom: 1px solid <?=$col_border?>; border-right: 1px solid <?=$col_border?>;"><?=$gameserver->players[$i]["enemy"]?></td>
<? }
if ($gameserver->playerkeys["kia"]) {
  ?>
 <td align=center class="bluebox" style="border-bottom: 1px solid <?=$col_border?>; border-right: 1px solid <?=$col_border?>;"><?=$gameserver->players[$i]["kia"]?></td>
<? }
if ($gameserver->playerkeys["roe"]) {
  ?>
 <td align=center class="bluebox" style="border-bottom: 1px solid <?=$col_border?>; border-right: 1px solid <?=$col_border?>;"><?=$gameserver->players[$i]["roe"]?></td>
<? }
if ($gameserver->playerkeys["ping"]) {
  ?>
 <td align=center class="bluebox" style="border-bottom: 1px solid <?=$col_border?>; border-right: 1px solid <?=$col_border?>;"><?=$gameserver->players[$i]["ping"]?></td>
<? } 
if ($gameserver->playerkeys["kills"]) {
  ?>
 <td align=center class="bluebox" style="border-bottom: 1px solid <?=$col_border?>; border-right: 1px solid <?=$col_border?>;"><?=$gameserver->players[$i]["kills"]?></td>
<? }
if ($gameserver->playerkeys["deaths"]) {
  ?>
 <td align=center class="bluebox" style="border-bottom: 1px solid <?=$col_border?>; border-right: 1px solid <?=$col_border?>;"><?=$gameserver->players[$i]["deaths"]?></td>
<? }
if ($gameserver->playerkeys["skill"]) {
  ?>
 <td align=center class="bluebox" style="border-bottom: 1px solid <?=$col_border?>; border-right: 1px solid <?=$col_border?>;"><?=$gameserver->players[$i]["skill"]?></td>
<? }
if ($gameserver->playerkeys["time"]) {
  ?>
 <td align=center class="bluebox" style="border-bottom: 1px solid <?=$col_border?>; border-right: 1px solid <?=$col_border?>;"><?=$gameserver->players[$i]["time"]?></td>
<? }
            echo "</tr>";
			}
		 }
			
		?>
		</table>
		</td></tr>
		</table>

		<?
		}
		else {
		///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		// with teams (like SOF2)
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
 <td class="bluebox" style="padding-left: 4px; border: 1px solid <?=$col_border?>;"><strong>Player Name</strong></td>
<? } 
if ($gameserver->playerkeys["ping"]) {
  ?>
<td align=center class="bluebox" style="border: 1px solid <?=$col_border?>; border-left: none;"><strong>Ping</strong></td>
<? }
if ($gameserver->playerkeys["score"]) {
  ?>
<td align=center class="bluebox" style="border: 1px solid <?=$col_border?>; border-left: none;"><strong>Score</strong></td>
 <? }
if ($gameserver->playerkeys["deaths"]) {
  ?>
<td align=center class="bluebox" style="border: 1px solid <?=$col_border?>; border-left: none;"><strong>Deaths</strong></td>
 <? }
if ($gameserver->playerkeys["kills"]) {
  ?>
<td align=center class="bluebox" style="border: 1px solid <?=$col_border?>; border-left: none;"><strong>Kills</strong></td>
 <? }
if ($gameserver->playerkeys["time"]) {
  ?>
<td align=center class="bluebox" style="border: 1px solid <?=$col_border?>; border-left: none;"><strong>Time</strong></td>
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
<td align=center class="bluebox" style="border: 1px solid <?=$col_border?>; border-left: none;"><strong>Kills</strong></td>
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
		if ($o == 0)
			echo "(none)";
		?>
		<?
		} 

	}
	else {
		echo "We were unable to contact the server you requested, it is most likely <font class=red>Offline</font>";
	}

	?>
	</TD>
	</TR>
	</TABLE>
	<?
}

?>
<br>
<div align=center><?
if ($displaytips) echo showTip();
?></div>
</TD></TR>
</TABLE>
<? echo "<div align=center>".showCredits(showVersion())."</div>"; ?>
</BODY>
</HTML>
<?
restore_error_handler();
?>
