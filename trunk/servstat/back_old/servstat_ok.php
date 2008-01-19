<?
include_once($_SERVER["DOCUMENT_ROOT"]."npds/modules/servstat/config.php");
include_once($_SERVER["DOCUMENT_ROOT"]."npds/modules/servstat/lib.php");

$server = new server;
$players = $server->SendCmd($serv["address"],$serv["port"],"players");
$info = $server->SendCmd($serv["address"],$serv["port"],"info");

$content='<SCRIPT LANGUAGE="JavaScript">'."\n";
$content.='function Zoom(url,name){'."\n";
$content.='x=399;'."\n";
$content.='y=263;'."\n";
$content.='newWindow = window.open(url,name,"width=" + x + ",height=" + y + ",toolbar=no,menubar=no,location=no,resizable=no,scrollbars=no,top=0,left=0" );'."\n";
	$content.='newWindow.focus();'."\n";
$content.='}'."\n";
$content.='</SCRIPT>'."\n";

$content.='<TABLE CELLPADDING="1" CELLSPACING="1" BORDER="0" ALIGN="center">'."\n";
$content.='	<TR>'."\n";
$content.='		<TD ALIGN="center">'.$text["top"].'</TD>'."\n";
$content.='	</TR>'."\n";
$content.='	<TR>'."\n";
$content.='		<TD ALIGN="center"><IMG SRC="'.$path["mappicture"].'/'.$info["nameofthemap"].'.jpg" BORDER="1" ALT="'.$info["nameofthemap"].'" HEIGHT="80"></TD>'."\n";
$content.='	</TR>'."\n";
$content.='	<TR>'."\n";
$content.='		<TD ALIGN="center">'.$info["nameofthemap"].'</TD>'."\n";
$content.='	</TR>'."\n";
$content.='	<TR>'."\n";
$content.='		<TD ALIGN="center"><NOBR><FONT COLOR="#CC0000">'.$info["activeclientcount"].' sur '.$info["maximumclientsallowed"].' joueurs</FONT></NOBR></TD>'."\n";
$content.='	</TR>'."\n";
$content.='	<TR>'."\n";
$content.='		<TD>'."\n";
$content.='			<SELECT CLASS="TEXTBOX_STANDARD" name="nom_joueur">'."\n";
	for ($x=0 ; $x <=sizeof($players)-1 ; $x++){

		/*	$content.='<DIV TITLE="';
			if (eregi("hltv",$players[$x]["playername"])){
				$content.= $players[$x]["playername"].' (212.43.245.10:27020)';
			}else{
				$content.= $players[$x]["playername"];
			}*/
			$content.='				<OPTION value="'.$x.'">';

			if (strlen($players[$x]["playername"]) > 14){
				$content.=substr($players[$x]["playername"],0,12)."..";
			}else{
				$content.=$players[$x]["playername"];
			}
			$content.='</OPTION>'."\n";
	}
$content.='			</SELECT>'."\n";
$content.='		</TD>'."\n";
$content.='	</TR>'."\n";

if ($topTen !=""){
$content.='	<TR>'."\n";
$content.='		<TD  ALIGN="center"><B><A HREF="javascript:Zoom(\'/npds/modules/servstat/top10.php\',\'top10\')">TOP 10</a></B></TD>'."\n";
}
$content.='	</TR>'."\n";
$content.='</TABLE>'."\n";
?>