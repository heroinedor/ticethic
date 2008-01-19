<?
/************************************************************************/
/*  Squery 3.5 PHPNuke Block                                            */
/* =================================================                    */
/*                                                                      */
/* Copyright (c) 2004 Curtis Brown   (webmaster@squery.com)          */
/* http://www.squery.com						*/
/*									*/
/*					                                */
/* This Block requires that the standalone and module code be in place. */
/*   								        */
/* To configure:  						        */
/* You must set your block_ip,block_port, and block_game in the         */
/* config.php file in the /SQuery/lib/ directory.                       */
/* 								        */
/************************************************************************/

if (eregi("block-SQuery_tiny.php",$_SERVER['PHP_SELF'])) {
    Header("Location: index.php");
    die();
}

error_reporting(0);
$serv_lib_path="./SQuery/lib/";
// require our main library =)
require_once($serv_lib_path.'config.php');
require_once($serv_lib_path.'main.lib.php');
$serv_lib_path="./SQuery/lib/";
//////////////////////////////////////////////////////////
function TinyqueryServer($address, $port, $protocol)
{
	global $serv_lib_path,$content;
  include_once($serv_lib_path."gsQuery.php");

  if(!$address && !$port && !$protocol) {
    $content.="No parameters given\n";
    return FALSE;
  }

  $gameserver=gsQuery::createInstance($protocol, $address, $port);
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
$content="";

$content='
<HEAD>
<meta http-equiv="Content-Language" content="en-us">
<STYLE>';

$content.='
BODY {
	background: #222222;
	color: #c0c0c0;
}
BODY, TD, INPUT, A, SELECT {
	font-family: Tahoma;
	font-size: 8pt;
}
.tooltip_bg {
	background-color: #222222;
}
A.tooltip_close {
	color: #ffffff;
}
.tooltip_bg_text {
	color: #ffffff;
}
.tooltip_fg_text {
	color: #e7e7e7;
}
.tooltip_fg {
	background: #333333;
}
.color {
	color: e7e7e7;
}
.big {
	font-size: 12pt;
	font-family: Arial;
	color: #9999AA;
}
.nblock {
	font-size: 9pt;
	font-family: Arial;
	color: #9999AA;
}

// Q3 Color Codes
.gsquery-black { color: black; }
.gsquery-red { color: red; }
.gsquery-yellow { color: #E6E600; }
.gsquery-darkgreen { color: darkgreen; }
.gsquery-blue { color: blue; }
.gsquery-cyan { color: cyan; }
.gsquery-pink { color: pink; }
.gsquery-white { color: darkgrey; }
.gsquery-blue-night { color:#7F7FFD; }
.gsquery-red-night { color:#D06B6B; }

// colors for FarCry
.gsquery-light-blue { color: #00FFFF; }
.gsquery-green { color: green; }
.gsquery-orange { color: #FF9600; }
.gsquery-grey { color: #000099; }

.gsquery-1 { color: #FF1924;}
.gsquery-2 { color: #A0B965;}
.gsquery-3 { color: #F5F501;}
.gsquery-4 { color: #4A54EA;}
.gsquery-5 { color: #05FFFF;}
.gsquery-6 { color: #FF02FC;}
.gsquery-7 { color: #FFFFFF;}
.gsquery-8 { color: #7B00D5;}
.gsquery-9 { color: #7B00D5;}
.gsquery-0 { color: #000000;}
.gsquery-a { color: #30DBB9;}
.gsquery-b { color: #D79244;}
.gsquery-c { color: #B461A5;}
.gsquery-d { color: #87A8D3;}
.gsquery-e { color: #BB1080;}
.gsquery-f { color: #70C2D0;}
.gsquery-g { color: #92E154;}
.gsquery-h { color: #6A0E25;}
.gsquery-i { color: #374D7F;}
.gsquery-j { color: #5CCB24;}
.gsquery-k { color: #CDB78E;}
.gsquery-l { color: #A1BDD3;}
.gsquery-m { color: #AE32A4;}
.gsquery-n { color: #577B3D;}
.gsquery-o { color: #A36C71;}
.gsquery-p { color: #259364;}
.gsquery-q { color: #A29894;}
.gsquery-r { color: #B254AA;}
.gsquery-s { color: #280176;}
.gsquery-t { color: #690B25;}
.gsquery-u { color: #332089;}
.gsquery-v { color: #07D944;}
.gsquery-w { color: #000000;}
.gsquery-x { color: #000829;}
.gsquery-y { color: #1093BF;}
.gsquery-z { color: #B08537;}
.gsquery-A { color: #4601EF;}
.gsquery-B { color: #3DDD31;}
.gsquery-C { color: #DD5835;}
.gsquery-D { color: #354C80;}
.gsquery-E { color: #69B127;}
.gsquery-F { color: #01226F;}
.gsquery-G { color: #4CB02A;}
.gsquery-H { color: #98727D;}
.gsquery-I { color: #4DBEE0;}
.gsquery-J { color: #97AE9E;}
.gsquery-K { color: #A6D77E;}
.gsquery-L { color: #AA83D6;}
.gsquery-M { color: #0BD67A;}
.gsquery-N { color: #DF910B;}
.gsquery-O { color: #BDBEEA;}
.gsquery-P { color: #00FF01;}
.gsquery-Q { color: #E744B7;}
.gsquery-R { color: #293CD6;}
.gsquery-S { color: #45EC2C;}
.gsquery-T { color: #C84F35;}
.gsquery-U { color: #8649D8;}
.gsquery-V { color: #8AC9AC;}
.gsquery-W { color: #7F00B1;}
.gsquery-X { color: #22B8B6;}
.gsquery-Y { color: #8DD600;}
.gsquery-Z { color: #AE96E2;}
.gsquery-exc { color: #000000; }
.gsquery-at { color: #B58A2E;}
.gsquery-pound { color: #000000; }
.gsquery-dollar { color: #FF1924; }
.gsquery-percent { color: #5844B3;}
.gsquery-and { color: #0000F8;}
.gsquery-star { color: #FFFFFF; }
.gsquery-lparen { color: #E417E2; }
.gsquery-rparen { color: #01FFFF; }
.gsquery-_ { color: #A42627;}
.gsquery-plus { color: #C3C2BD; }
.gsquery-lbracket { color: #B2150C;}
.gsquery-rbracket { color: #30414B; }
.gsquery-bar { color: #7ADC4B;}
.gsquery-colon { color: #CCB8AD; }
.gsquery-less { color: #00FC02;}
.gsquery-greater { color: #24B6AB;}
.gsquery-questionmark { color: #8CD746;}

.gsquery-- { color: #42433B;}
.gsquery-equal { color: #92BEA7;}
.gsquery-lsqr { color: #3FAD92;}
.gsquery-rsqr { color: #24BA94;}
.gsquery-lslash { color: #A95D77;}
.gsquery-comma { color: #7D827B;}
.gsquery-point { color: #614A82;}
.gsquery-rslash { color: #2B0163;}
.gsquery-tick { color: #F5F501;}
.gsquery-quote { color: #000000; }
.gsquery-semic { color: #E744B7; }
';
$content.='</STYLE></HEAD>';
//$content.='<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>';
$content.='<script language="JavaScript" src="';
$content.=$serv_lib_path;
$content.='overlib.js"><!-- overLIB (c) Erik Bosrup --></script>';

$content.='<TR><TD align=center>';

$cnt = count($block_servers);

for ($i=0;$i<$cnt;$i++) {
$z = explode(",", $block_servers[$i]);
$ip=$z[0];
$port=$z[1];
$qgame=$z[2];

	foreach($gametable as $key=>$value)
	{
   	if ($key==$qgame)
	{
	 $enginetype=$value;
	}

 }
$content.='<TR>
	<TD align=center>';
	
        $qport=calcqport($port,$qgame);
        if ($queryfromurl) {
		include_once($serv_lib_path."gsQuery.php");
	 $gameserver=gsQuery::unserializeFromURL("http://www.squery.com/sqserial/serializer.php?ip=$ip&port=$qport&protocol=$enginetype");
          if(!$gameserver) {
            $content.="Could not fetch the serialized object.";
          }
	}
	else $gameserver=TinyqueryServer($ip,$qport,$enginetype);

	if ($gameserver) {

$content.='<strong class="nblock">';
$content.="<a href=\"".$websiteurl."/SQuery/index.php?name=SQuery&ip=$ip&port=$port&game=$qgame&block=0\" class=\"nblock\" target=\"_blank\">";
$content.=gametitle(htmlentities($gameserver->gamename));
$content.='</a>
</strong><br>
		<TABLE cellpadding=0 cellspacing=0 width="130">
		<tr><td valign=top><br>
		<table width="100%" cellspacing=0 cellpadding=0 align="center">
		<tr><td width="100%" style="padding-left: 10px; padding-right: 10px;" valign=top>
		<table cellspacing=0 cellpadding=0>';
		
$content.='<tr><td class="row"><font class="color">Name:</font></td><td class="row">';
$content.=$gameserver->htmlize($gameserver->servertitle);
$content.='</td></tr>
		<tr><td class="row"><font class="color">IP:</font></td><td class="row">';
$content.=$gameserver->address;
$content.='</td></tr>
		<tr><td class="row"><font class="color">Port:</font></td><td class="row">';
$content.=$gameserver->hostport;
$content.='</td></tr>
		<tr><td class="row"><font class="color">Users:</font></td><td class="row">';
$content.=$gameserver->numplayers.' / '.$gameserver->maxplayers;
$content.='</td></tr>';
$gameserver->mapname=ucwords(htmlentities($gameserver->mapname));
$content.='<tr><td class="row"><font class="color">Map:</font></td><td class="row">';
$content.=$gameserver->mapname;
$content.='</td></tr>';
$gameserver->gametype=strtoupper(htmlentities($gameserver->gametype));
$content.='<tr><td class="row"><font class="color">Game:</font></td><td class="row">';
$content.=$gameserver->gametype;
$content.='</td></tr>';
$content.='</table>';

		if ($gameserver->numplayers == $gameserver->maxplayers)
			$content.="(<font class=\"color\">This server is FULL</font>)";
		elseif ($gameserver->numplayers == 0)
			$content.="(<font class=\"color\">This server is EMPTY</font>)";
$content.='</table></TABLE>';
   }
  $content.='<hr>';
} // end main loop
 $content.='<center>';
 //$content.=showCredits(showVersion());
 $content.="<a href=\"http://www.squery.com\" target=\"_blank\">".showVersion()."</a>";
 $content.='</center>';
 
?>
