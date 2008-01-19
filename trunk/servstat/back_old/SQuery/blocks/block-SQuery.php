<?
/************************************************************************/
/*  Squery 3.9 PHPNuke Block                                            */
/* =================================================                    */
/*                                                                      */
/* Copyright (c) 2005 Curtis Brown   (webmaster@squery.com)             */
/* http://www.squery.com                                                */
/*                                                                      */
/*                                                                      */
/* This Block requires that the standalone and module code be in place. */
/*                                                                      */
/* To configure:                                                        */
/* You must set your block_ip,block_port, and block_game in the         */
/* config.php file in the /SQuery/lib/ directory.                       */
/*                                                                      */
/************************************************************************/

if (eregi("block-SQuery.php",$_SERVER['PHP_SELF'])) {
    Header("Location: index.php");
    die();
}
$serv_lib_path="./SQuery/lib/";
// require our main library =)
require($serv_lib_path.'config.php');
require_once($serv_lib_path.'HttpClient.class.php');
$cnt = count($block_servers);
$content="";
for ($i=0;$i<$cnt;$i++) {
if ($i>0) $content.="<hr>";
$z = explode(",", $block_servers[$i]);
$local_game=$z[2];
$local_game=str_replace(" ","+",$local_game);
if ($websiteurl=="http://www.yoursitehere.com") $content="You must Configure your SQuery install Correctly.<br>Please read the Readme";
else { $geturl=$websiteurl."/SQuery/index.php?ip=".$z[0]."&port=".$z[1]."&game=".$local_game."&block=1";
$tempcontent=HttpClient::quickGet($geturl);
$tempcontent=str_replace("./lib/",$serv_lib_path,$tempcontent);
$tempcontent=str_replace(".\\\\\\lib\\\\\\",".\\\\\\SQuery\\\\\\lib\\\\\\",$tempcontent);
$content.=$tempcontent; }
}

?>
