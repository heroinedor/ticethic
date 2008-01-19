<table width="50%" border="0" cellspacing="1" cellpadding="2" ALIGN="center">
  <tr CLASS="HEADER">
    <TD colspan=2 ALIGN="center"> <?echo $info["nameofthehost"];?></TD>
  </tr>

  <TR CLASS="LIGNA">
  	<TD colspan=2 ALIGN="center" VALIGN="center">
  		<a href="<? echo $topTen["url"][$no_server] ?>" target="_blank" class="NOIR"> Stats</a>
			&nbsp;
  		<IMG SRC="<? echo $path["mappicture"][$no_server].'/'.$info["nameofthemap"];?>.jpg" BORDER="1" ALT="<? echo $info["nameofthemap"]?>" HEIGHT="80">
  		&nbsp;
			<a href="<? echo $topTen["url"][$no_server] ?>" target="_blank" class="NOIR"> Stats</a>
  	</TD>
  </TR>

  <TR CLASS="LIGNB">
  	<TD ALIGN="right"><b>Adresse</b></TD>
  	<TD ALIGN="center"><? echo $info["netaddress"]?></TD>
  </TR>

  <TR CLASS="LIGNA">
    <TD ALIGN="right"><b>Map</b></TD>
    <TD ALIGN="center"><? echo $info["nameofthemap"]?></TD>
  </TR>

  <TR CLASS="LIGNB">
  	<TD ALIGN="right"><b>Joueurs en Ligne</b></TD>
  	<TD ALIGN="center" CLASS="ROUGE"><? echo $info["activeclientcount"].'/'.$info["maximumclientsallowed"]?></TD>
  </TR>

  <TR CLASS="LIGNA">
  	<TD ALIGN="right"><b>Jeu</b></TD>
  	<TD ALIGN="center"><? echo $info["gamedescription"].' (protocole : '.$info["protocolversion"]?>)</TD>
  </TR>

  <TR CLASS="LIGNB">
    <TD ALIGN="right"><b>Règles</b></TD>
    <TD ALIGN="center">
    	<SELECT CLASS="TEXTBOX_STANDARD">
<?
		//boucle sur les règles du serveur CS pour peupler le tag <OPTION>
		foreach ($rules as $key=> $value){
  		if ($key){
      	echo "\n".'				<OPTION value='.$key.'>'.$value["rulename"].' = '.$value["rulevalue"].'</OPTION>';
      }
    }
		//fin affichage boucle
?>
  		</SELECT>
  	</TD>
  </TR>


  <tr CLASS="HEADER">
    <td colspan=4 ALIGN="center"> &nbsp;</td>
  </tr>
</table>
<br>
<table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr CLASS="HEADER">
    <TD colspan=4 ALIGN="center"> Détails Joueurs</TD>
  </tr>
  <tr CLASS="ONGL">
    <td ALIGN="center" CLASS="ONGL"> # </td>
    <td ALIGN="center" CLASS="ONGL"> Pseudo </td>
    <td ALIGN="center" CLASS="ONGL"> Frags </td>
    <td ALIGN="center" CLASS="ONGL"> Temps de jeu </td>
  </tr>
<?
	// Affichage du détail de tous les joueurs présents sur le serveur
	if  ($players[0]["playername"]){
    	for ($x=0 ; $x <=sizeof($players)-1 ; $x++){
    	$rowcolor=tablos();
    		echo '	<tr '.$rowcolor.'>';
    		echo '		<td>'.$players[$x]["clientnumber"].'</td>';
    		echo '		<td>'.$players[$x]["playername"].'</td>';
    		echo '		<td>'.$players[$x]["clientfragtotal"].'</td>';
    		echo '		<td>'.$players[$x]["clienttotaltimein-game"].'</td>';
    		echo '	</tr>';
    	}
  }
  else
  {
  	echo '	<tr>';
  	echo '		<td colspan = 4 align= center> Aucun joueur en ligne</td>';
  	echo '	</tr>';
  }
?>

  <tr CLASS="HEADER">
    <td colspan=4 ALIGN="center"> © cassosiation 2004</td>
  </tr>
</table>
