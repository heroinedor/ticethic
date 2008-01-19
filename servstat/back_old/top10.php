<HTML>
<HEAD>
<TITLE>TOP 10</TITLE>

<style>
/* ====================================== Style sheet  ======================================= */
BODY { color:#000000; font-size : 11px; font-family : tahoma,verdana,arial,helvetica; font-weight : normal; text-decoration: none }
TD { color:#000000; font-size : 11px; font-family : tahoma,verdana,arial,helvetica; font-weight : normal; text-decoration: none }
TEXTAREA { color:#000000; font-size : 11px; font-family : tahoma,verdana,arial,helvetica; font-weight : normal; text-decoration: none }
INPUT { color:#000000; font-size : 11px; font-family : tahoma,verdana,arial,helvetica; font-weight : normal; text-decoration: none }
SELECT { color:#000000; font-size : 11px; font-family : tahoma,verdana,arial,helvetica; font-weight : normal; text-decoration: none }
a { color:#3c5e83; font-size : 11px; font-family : tahoma,verdana,arial,helvetica; font-weight : normal; text-decoration: none }
a:active { color:#3c5e83; font-size : 11px; font-family : tahoma,verdana,arial,helvetica; font-weight : normal; text-decoration: none }
a:visited { color:#3c5e83; font-size : 11px; font-family : tahoma,verdana,arial,helvetica; font-weight : normal; text-decoration: none }
a:hover { color:#3c5e83; font-size : 11px; font-family : tahoma,verdana,arial,helvetica; font-weight : normal; text-decoration: underline }
a.header { color:#000000; font-size : 11px; font-family : tahoma,verdana,arial,helvetica; font-weight : normal; text-decoration: none }
a.header:active { color:#000000; font-size : 11px; font-family : tahoma,verdana,arial,helvetica; font-weight : normal; text-decoration: none }
a.header:visited { color:#000000; font-size : 11px; font-family : tahoma,verdana,arial,helvetica; font-weight : normal; text-decoration: none }
a.header:hover { color:#000000; font-size : 11px; font-family : tahoma,verdana,arial,helvetica; font-weight : normal; text-decoration: none }

/* Black body text */
.ctnegro, a.ctnegro:link, a.ctnegro:visited, a.ctnegro:active, table.ctnegro, td.ctnegro
{ color:#000000; font-size : 11px; font-family : tahoma,verdana,arial,helvetica; font-weight : normal; text-decoration: none }

/* White body text */
.ctblanco, a.ctblanco:link, a.ctblanco:visited, a.ctblanco:active, table.ctblanco, td.ctblanco
{ color:#FFFFFF; font-size : 11px; font-family : tahoma,verdana,arial,helvetica; font-weight : normal; text-decoration: none }

/* White title */
.tblanco, a.tblanco:link, a.tblanco:visited, a.tblanco:active, table.tblanco, td.tblanco, h1.tblanco
{ color:#FFFFFF; font-size : 12px; font-family : arial,helvetica; font-weight : bold; text-decoration: none }

/* Black Subtitle */
.stnegro, a.stnegro:link, a.stnegro:visited, a.stnegro:active, table.stnegro, td.stnegro
{ color:#000000; font-size : 12px; font-family : tahoma,verdana,arial,helvetica; font-weight : normal; text-decoration: none }

.cp, a.cp:link, a.cp:visited, a.cp:active
{ font-size : 9px;}
</style>

</HEAD>

<BODY LEFTMARGIN="0" TOPMARGIN="0" MARGINWIDTH="0" MARGINHEIGHT="0">

<?
include_once($_SERVER["DOCUMENT_ROOT"]."/npds/modules/servstat/serv_config.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/npds/modules/servstat/lib.php");

$topX="";
$path_cache = "./top10caching/";
$name_cache = "top10.cache";
	$d = dir($path_cache);
		while($entry = $d->read()) {
			if ($entry ==$name_cache){
				$date_cache_file=date ("Ymd",filemtime($path_cache.$entry));
			}
		}
	$d->close();


if ($date_cache_file != date("Ymd")){

$buffer="";
	if($fp = @fopen("http://statscs.verygames.net/server60/", "r")){
			while (!feof($fp)) {
				$buffer .= fgets($fp, 4096);
			}
		fclose ($fp);
	
	$tmp=explode('<table width="100%" border="0" cellpadding="1" cellspacing="1">',$buffer);
	$tmp = explode('</table>',$tmp[1]);
	$tmp = explode('<tr',$tmp[0]);

		for ($x = 2; $x <= 11 ; $x++){
			$tmptd=explode('</td>',$tmp[$x]);
			$top10[$x-1]["name"]=trim(strip_tags ($tmptd[1]));
			$top10[$x-1]["kills"]=trim(strip_tags ($tmptd[2]));
			$top10[$x-1]["deaths"]=trim(strip_tags ($tmptd[3]));
			$top10[$x-1]["kd"]=trim(strip_tags ($tmptd[4]));
			$top10[$x-1]["skill"]=trim(strip_tags ($tmptd[7]));
		}
}
$topX.='<TABLE CELLPADDING="0" CELLSPACING="0" BORDER="0" WIDTH="100%">'."\n";
$topX.='	<TR>'."\n";
$topX.='		<TD><IMG SRC="'.$topTen["imgheader"].'" BORDER="0"></TD>'."\n";
$topX.='	</TR>'."\n";
$topX.='	<TR>'."\n";
$topX.='		<TD>'."\n";
$topX.='<TABLE CELLPADDING="1" CELLSPACING="1" BORDER="0" WIDTH="100%">'."\n";
$topX.='	<TR>'."\n";
$topX.='		<TD><B>Rang</B></TD>'."\n";
$topX.='		<TD><B>Nom</B></TD>'."\n";
$topX.='		<TD><B>Kills</B></TD>'."\n";
$topX.='		<TD><B>Death</B></TD>'."\n";
$topX.='		<TD><B>Skill</B></TD>'."\n";
$topX.='	</TR>'."\n";
	if(isset($top10)){
		for ($x= 1 ; $x <= sizeof($top10) ; $x++){
			$topX.='	<TR>';
			$topX.='		<TD>'.$x.'</TD>'."\n";
			$topX.='		<TD><DIV TITLE="">';
				if (strlen($top10[$x]["name"]) > 14){
					$topX.=substr($top10[$x]["name"],0,12)."..";
				}else{
					$topX.=$top10[$x]["name"];
				}	
			$topX.='</DIV></TD>'."\n";
			$topX.='		<TD>'.$top10[$x]["kills"].'</TD>'."\n";
			$topX.='		<TD>'.$top10[$x]["deaths"].'</TD>'."\n";
			$topX.='		<TD>'.$top10[$x]["skill"].'</TD>'."\n";
			$topX.='	</TR>'."\n";
		}
	}
$topX.='</TABLE>'."\n";
$topX.='		</TD>'."\n";
$topX.='	<TR>'."\n";
$topX.='<TABLE>'."\n";
$topX.='<FONT COLOR="#CC0000"><B>Nota :</B> le Top10 est rafraichit tous les soirs à minuit.</FONT><BR><CENTER><DIV CLASS="cp">script écrit par : <A HREF="mailto:mat@clan-csa.net" CLASS="cp">m@t</A></DIV></CENTER>';
$create_cache = fopen($path_cache.$name_cache,"w");
fwrite($create_cache,$topX); 
fclose($create_cache);

}else{
	$fp = fopen($path_cache.$name_cache, "r");
		while (!feof($fp)) {
			$topX.= fgets($fp, 4096);
		}
}
print $topX;
?>
</BODY>
</HTML>
