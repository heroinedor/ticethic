<?PHP

/**************************************************************************************************/
/* Module de gestion de galeries pour NPDS version 1.3                                            */
/* GALERIE photos utilisée sur http://www.derumier.net                                            */
/* ===================================================                                            */
/* (c) 2003 Christophe Derumier http://www.derumier.net                                           */
/*                                                                                                */
/* This program is free software. You can redistribute it and/or modify it under the terms of     */
/* the GNU General Public License as published by the Free Software Foundation; either version 2  */
/* of the License.                                                                                */
/**************************************************************************************************/

/**************************************************************************************************/
/* Administration du MODULE    Servstat                                                           */
/**************************************************************************************************/


  include_once($_SERVER["DOCUMENT_ROOT"]."npds/modules/servstat/serv_config.php");
	include_once($_SERVER["DOCUMENT_ROOT"]."npds/modules/servstat/lib.php");
	
	OpenTable();

?>
<TABLE WIDTH=100% CELLSPACING=2 CELLPADDING=2 BORDER=0>
	<TR>
		<TD CLASS="HEADER">Console d'administration du module Servstat</TD>
	</TR>
</TABLE>

<table width="100%" border="1" cellspacing="1" cellpadding="0" bgcolor="#E6F2FF">
	<tr>
		<td>
			<table width="100%" border="1" cellspacing="1" cellpadding="6" bgcolor="#C2D7EB">
				<tr>
					<table WIDTH=100% CELLSPACING=0 CELLPADDING=2 BORDER=1>
						<tr>
							<td class="HEADER">N°Serveur</td>
							<td class="HEADER">Adresse</td>
							<td class="HEADER" align="center">Port</td>
							<td class="HEADER" align="center">Nom Affiché</td>
							<td class="HEADER" align="center">URL stats</td>
						</tr>
						<tr CLASS="LIGNA">
							<td>1</td>
							<td><?echo $serv["address"][1]?></td>
							<td align="center"><?echo $serv["port"][1]?></td>
							<td align="center"><?echo $text["top"][1]?></td>
							<td align="center"><?echo $topTen["url"][1]?></td>
						</TR>
						<tr CLASS="LIGNB">
							<td>2</td>
							<td><?echo $serv["address"][2]?></td>
							<td align="center"><?echo $serv["port"][2]?></td>
							<td align="center"><?echo $text["top"][2]?></td>
							<td align="center"><?echo $topTen["url"][2]?></td>
						</TR>
						<tr CLASS="LIGNA">
							<td>3</td>
							<td><?echo $serv["address"][3]?></td>
							<td align="center"><?echo $serv["port"][3]?></td>
							<td align="center"><?echo $text["top"][3]?></td>
							<td align="center"><?echo $topTen["url"][3]?></td>
						</TR>
					</TABLE>
				</tr>
			</table>
		</td>
	</tr>
</table>
<?
  closeTable();  
/*

							$result["netaddress"]
							$result["nameofthehost"]
							$result["nameofthemap"]
							$result["gamedirectory"]
							$result["gamedescription"]
							$result["activeclientcount"]
							$result["maximumclientsallowed"]
							$result["protocolversion"]
							$result[$i]["clientnumber"]
							$result[$i]["playername"]
							$result[$i]["clientfragtotal"]
							$result[$i]["clienttotaltimein-game"]
							$result[$i]["rulename"]
							$result[$i]["rulevalue"]
							$result["netaddress"]
							$result["nameofthehost"]
							$result["nameofthe map"]
							$result["gamedirectory"]
							$result["gamedescription"]
							$result["activeclientcount"]
							$result["maximumclientsallowed"]
							$result["protocolversion"]
							$result["typeofserver"]
							$result["osofserver"]
							$result["passwordonserver"]
							$result["runningamod"]
							$result["urlformodwebsite"]
							$result["urlformodftpserver"]
							$result["modversion"]
							$result["moddownloadsize"]
							$result["modaserverside"]
							$result["thisserverrequirecustomclient"]
						*/
?>
