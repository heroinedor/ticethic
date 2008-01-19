<?

// SQuery version 3.9 by Curtis Brown
// Based on code by David Cramer released to the public domain.


//########### CONFIGURATION BEGIN ############//

// Static display for Standalone and Module
// If you set this it will not display the query box, or any of your favorites, it will only show the server you put in below
 //$static_ip = "70.85.139.243";
 //$static_port = "28960"; 
 //$static_game = "Call of Duty"; 
    
// Static display for PHPNuke Block
// This must be set for the Block to work. Add a line for each server you want displayed in the block.
// SERVER IP, PORT, GAMETYPE
$block_servers = array (
	"70.85.139.243,28960,CoD:United Offensive",
	"64.34.164.46,20100,SOF II",
	"64.34.164.46,20200,SOF II",
	);

 // Be sure to set this to your web site or the block won't work!
 $websiteurl ="http://www.yoursitehere.com";

// Display tips at bottom of query TRUE or FALSE
 $displaytips=TRUE;
// Display IP Entry Form at Top TRUE or FALSE
$show_ip_entry_form=TRUE;

// Here you can add or change the tips

$tipmsg = array (
"If you fire burst shots with an assault rifle, you'll greatly increase accuracy and range.",
"When you're at close range with an opponent, try to hit them with your gun instead of shooting them.",
"Listen! The sounds the enemy makes are very revealing...",
"You shouldn't make fun of nerds... you'll be working for one some day (Great Tip!)",
"Visit www.PBBans.com, The Best Anti-Cheat Punkbuster Site around!"
);
  

/* Add your favorite servers here (shows them under the form)
Use these game types:
"Americas Army"
"BField:1942"
"BField:Vietnam"
"Battlefield 2"
"Call of Duty"
"CoD:United Offensive"
"Chaser"
"Chrome"
"Counterstrike"
"Cstrike:Source"
"CnC Renegade"
"Descent 3"
"Doom3"
"Devastation"
"FarCry"
"Global Ops"
"Gore"
"Halo"
"Heretic 2"
"Half-Life"
"Half-Life 2"
"HLife:CndZero"
"HLife:Cstrike"
"HLife:DMC"
"HLife:DOD"
"HLife:N.S."
"HLife:O.F."
"HLife:TFC"
"IL-2 Sturmovik"
"IGI2"
"Jedi Knight 2"
"Jedi Knight 3"
"MOH:AA"
"MOH:BT"
"MOH:PA"
"MOH:SH"
"MTA(GTA3)" 
"NASCAR SimRacer"
"NetPanzer"
"NOLF"
"NOLF 2"
"Op. Flshpnt"
"Painkiller"
"Postal 2"
"Purge Jihad"
"Quake 2"
"Quake 3"
"Quake 3:UT" 
"QuakeWorld"
"Rally Masters" 
"RavenShield" 
"RTCW" 
"RTCW:ET" 
"Rune" 
"Savage"
"Serious Sam"
"Serious Sam 2" 
"Sin" 
"SOF"
"SOF II" 
"Soldat"
"ST:Elite Force"
"ST:Elite Force 2"
"SW:Battlefront"
"Tactical Ops" 
"Unreal" 
"Unreal 2 XMP"
"UT" 
"UT2003" 
"UT2004" 
"VietCong" 
 example:  */
 

 $favorites = array (
	"MB COD:UO,70.85.139.243,28960,CoD:United Offensive",
	"PEZ SOF2,GamersLobby.net,20300,SOF II",
	"CS:S#1,65.255.231.189,27016,Counterstrike",
	"CS:S#2,203.81.47.81,27015,Half-Life 2",
	"CS:S#3,195.182.92.179,27016,Half-Life 2",
	"MOH:SH,64.37.120.128,12203,MOH:SH",
	"Rev SoF2,64.34.164.46,20200,SOF II",
	"TEAMFN SoF2,64.34.164.46,20100,SOF II",
	"FNM SoF2,68.196.82.107,20102,SOF II",
	"UT,62.212.75.166,7000,UT",
	"TT RvS#4,66.151.108.70,7777,RavenShield"
 );

//########### CONFIGURATION END ##############//
//Unsupported at this time, leave alone unless told to change it:
$queryfromurl=FALSE;

if (eregi("config.php", $_SERVER['PHP_SELF'])) {
  print_r($block_servers);
  print_r($favorites);
  echo $static_ip;
  echo $static_port;
  echo $static_game;
  echo $websiteurl;
}
