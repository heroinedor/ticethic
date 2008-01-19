<?

/**************************************************************************************************/
/* Module de gestion des adh�rents d'une association pour NPDS version 5.0 P1 Runner              */
/* ===============================================================================================*/
/*                                                                                                */
/* This program is free software. You can redistribute it and/or modify it under the terms of     */
/* the GNU General Public License as published by the Free Software Foundation; either version 2  */
/* of the License.                                                                                */
/**************************************************************************************************/

/**************************************************************************************************/
/* Page de modification des options de configuration du module ad�hsion                           */
/**************************************************************************************************/

/****************************************************
* 2 cas possibles :
* - ActionForm non d�fini : consultation des donn�es
* - ActionForm = 1 : mise � jour de la configuration
*****************************************************/


	if (isset($_POST['ActionForm']) and $_POST['ActionForm']==1) {
		/*************************************************/
		//On est dans le cas d'une mise � jour des donn�es
		/*************************************************/
		
		//1ere �tape : mise en forme des donn�es � mettre � jour dans la base
		//texte d'accueil de la page adh�rent
		$config_module['cfg_txt_accueil']=removeHack(stripslashes(FixQuotes($_POST['cfg_textaccueil'])));
		//titre du bloc adh�sion
		$config_module['cfg_bloc_titre']=stripslashes(FixQuotes($_POST['cfg_bloc_titre']));
		//contenu du bloc adh�sion
		$config_module['cfg_bloc_contenu']=stripslashes(FixQuotes($_POST['cfg_bloc_contenu']));
		//date de d�but des cotisations
		$config_module['cfg_date_start'] = $_POST["cfg_start_annee"]."-".$_POST["cfg_start_mois"]."-".$_POST["cfg_start_jour"];
		//nombre de sessions de cotisations
		$config_module['cfg_nb_sessions'] = $_POST["cfg_nb_sessions"];
		//Liste des groupes adh�rents
		for($i=0; $i<sizeof($_POST['cfg_groupe']);$i++){
			$config_module['cfg_groupe'.$i] = $_POST['cfg_groupe'][$i];
		}
		
		// On r�cup�re la liste de tous les groupes disponibles en BDD
		$groupe = groupe_base();
		
		//2eme �tape : ex�cution de la mise � jour � proprement parler		
	    foreach ($config_module as $parametre => $valeur){
			// Ex�cution pour tous les param�tres except� pour les num�ros de groupes d'adh�rents
			if (substr($parametre,0,10)!='cfg_groupe'){
				$sql_maj= 'UPDATE `adhesion_config_tab` '.
					'SET `valeur` = \''.$valeur.'\' WHERE `parametre` =\''.$parametre.'\''; 
				//Debug 
				//echo '<br>$sql_maj = '.$sql_maj.'<br>';
				$resultat_maj = mysql_query ($sql_maj);
				$row_updated = mysql_affected_rows();
				if($row_updated>0){
					echo "<br><div class=\"NOIR\">".substr($parametre,4)." mis � jour correctement</div><br>";
				}
				else{
					if($row_updated==-1){
						echo "<br><div class=\"ROUGE\">Erreur lors de la modification du param�tre ".substr($parametre,4)." : ";
						echo mysql_error()."</div><br>";
					}else{
						//on n'affiche rien quand rien n'est modifi�
						//echo "<br><div class=\"NOIR\">".substr($parametre,4)." inchang�</div><br>";
					}
				}
			}
		}
		// Mise � jour des num�ros de groupes adh�rents
		$sql_grp= 'DELETE FROM `adhesion_config_tab` WHERE `parametre` like (\'cfg_groupe%\')';
		mysql_query($sql_grp);
		$sql_grp = 'INSERT INTO `adhesion_config_tab` (`id`,`parametre`, `valeur`) VALUES ';
		$grp = "";
		foreach ($config_module as $parametre => $valeur){
			if (substr($parametre,0,10)=='cfg_groupe'){
				$grp .='("","'.$parametre.'", "'.$valeur.'"),';
			}
		}
		$sql_grp .=substr($grp,0,strlen($grp)-1);
		//Debug
		//echo '<br>$sql_grp = '.$sql_grp.'<br>';
		mysql_query($sql_grp);
		$row_inserted = mysql_affected_rows();
		if($row_inserted>0){
			echo "<br><div class=\"NOIR\">".$row_inserted." groupes adh�rants</div><br>";
		}
		else{
			if($row_inserted==-1){
				echo "<br><div class=\"ROUGE\">Erreur lors de la modification des groupes adh�rents : ";
				echo mysql_error()."</div><br>";
			}else{
				//on n'affiche rien quand on ne modifie rien
				//echo "<br><div class=\"NOIR\">groupes adh�rents inchang�s</div><br>";
			}
		}
	}
	else{
		/*********************************************************/
		//On est dans le cas d'une simple consultation des donn�es
		/*********************************************************/
		
		//R�cup�ration des donn�es de la table adhesion_config_tab
		$sql = 'SELECT `parametre`,`valeur`  FROM `adhesion_config_tab`';
		$resultat = mysql_query($sql);
		if (!$resultat) {
			echo '<br><div class="ROUGE">Impossible d\'ex�cuter la requ�te sur la configuration: ' . mysql_error().'</div><br>';
			exit;
		}
		while (list($parametre, $valeur) = mysql_fetch_row($resultat)){
			$config_module[$parametre]=$valeur;
		}
		mysql_free_result($resultat);
		
		// On r�cup�re la liste de tous les groupes disponibles en BDD
		$groupe = groupe_base();
		
	}

/**************************************************************************
*	R�cup�ration de la liste de tous les groupes disponibles sur le site:
***************************************************************************/
function groupe_base(){
		$sql_gr = 'SELECT `groupe_id`,`groupe_name`  FROM `groupes`';
		$resultat_gr = mysql_query($sql_gr);
		if (!$resultat_gr) {
			echo '<br><div class="ROUGE">Impossible d\'ex�cuter la requ�te sur les groupes: ' . mysql_error().'</div><br>';
			exit;
		}
		$i=0;
		while (list($groupe_id,$groupe_name) = mysql_fetch_row($resultat_gr)){
			$groupe[$i]['groupe_id']=$groupe_id;
			$groupe[$i]['groupe_name']=$groupe_name;
			$i++;
		}
		mysql_free_result($resultat_gr);
		return $groupe;
}


	//debug
	/*echo '<br>taille ='.sizeof($_POST).'<br>';
	echo "<table border = 1>";
	foreach ($_POST as $key => $value) {
		echo "<tr><td>Cl� _POST: $key; </td><td>Valeur: $value</td></tr>\n";
	    if (is_array($value)){
		    foreach ($value as $cle => $valeur) {
	      		echo "<tr><td> - </td><td>Sous-Cl�: $cle; </td><td>Valeur: $valeur</td></tr>\n";
	      		if (is_array($valeur)){
		      		foreach ($valeur as $k => $v) {
		      		    echo "<tr><td> - </td><td> - </td><td>Sous-Cl�: $k; </td><td>Valeur: $v</td></tr>\n";
		      		}
	      		}
		    }
	    }
    }
	echo "</table>";*/
?>

		<SCRIPT LANGUAGE="JavaScript">
		//Validation du formulaire
		function Valider(formF){
			//V�rification de la date de naissance
			var dateForm = formF.cfg_start_jour.value+'/'+
							formF.cfg_start_mois.value+'/'+
							formF.cfg_start_annee.value;
		    //alert("dateForm = "+dateForm);
			if (!CheckDate(dateForm)){
		    	return false;
			}else{
			formF.submit();
			}
		}

		function CheckDate(d) {
		  // Cette fonction v�rifie le format JJ/MM/AAAA saisi et la validit� de la date.
		  // Le s�parateur est d�fini dans la variable separateur
		  var amin=1900; // ann�e mini
		  var amax=new Date().getFullYear()+5; // ann�e maxi
		  var separateur="/"; // separateur entre jour/mois/annee
		  var j=(d.substring(0,2));
		  var m=(d.substring(3,5));
		  var a=(d.substring(6));
		  var ok=1;
		  if ( ((isNaN(j))||(j<1)||(j>31)) && (ok==1) ) {
		     alert("Le jour de la date de naissance n'est pas correct."); ok=0;
		  }
		  if ( ((isNaN(m))||(m<1)||(m>12)) && (ok==1) ) {
		     alert("Le mois de la date de naissance n'est pas correct."); ok=0;
		  }
		  if ( ((isNaN(a))||(a<amin)||(a>amax)) && (ok==1) ) {
		     alert("L'ann�e de la date de naissance n'est pas correcte."); ok=0;
		  }
		  if ( ((d.substring(2,3)!=separateur)||(d.substring(5,6)!=separateur)) && (ok==1) ) {
		     alert("Les s�parateurs doivent �tre des "+separateur); ok=0;
		  }
		  if (ok==1) {
		     var d2=new Date(a,m-1,j);
		     j2=d2.getDate();
		     m2=d2.getMonth()+1;
		     a2=d2.getFullYear();
		     if (a2<=100) {a2=1900+a2}
		     if ( (j!=j2)||(m!=m2)||(a!=a2) ) {
		        alert("La date "+d+" n'existe pas !");
		        ok=0;
		     }
		  }
	  	return ok;
		}
		</SCRIPT>
		<SCRIPT LANGUAGE="JavaScript">
		//D'autres scripts sur http://www.toutjavascript.com
		//Si vous utilisez ce script, merci de m'avertir !  < webmaster@toutjavascript.com >
			function Deplacer(l1,l2) {
				if (l1.options.selectedIndex>=0) {
					o=new Option(l1.options[l1.options.selectedIndex].text,l1.options[l1.options.selectedIndex].value);
					l2.options[l2.options.length]=o;
					l1.options[l1.options.selectedIndex]=null;
				}else{
					alert("Aucune activit� s�lectionn�e");
				}
			}
		</SCRIPT>
<?
	//var_dump($config_module);
	global $ModPath, $ModStart;
	// C'est bien admin.php qui appel� mais avec les codes op�rations op ET subop
	echo"<form name=\"config_module\" action=\"admin.php\" method=\"post\">";
	
	// lignes obligatoires pour pouvoir utiliser NPDS-plugins
	echo "\n<input type=\"hidden\" name=\"op\" value=\"Extend-Admin-SubModule\">";
	echo "\n<input type=\"hidden\" name=\"ModPath\" value=\"$ModPath\">";
	echo "\n<input type=\"hidden\" name=\"ModStart\" value=\"$ModStart\">";
	
	// sous-op�ration du module
	echo "\n<input type=\"hidden\" name=\"subop\" value=\"Configuration\">";
	// lignes obligatoires pour pouvoir utiliser NPDS-plugins
?>
<!--<form name="config_module" method="post" action="admin.php?op=Extend-Admin-SubModule&ModPath=adhesions&ModStart=admin/admin_adhesion&subop=Configuration">-->
  <table width="100%" border="1" cellspacing="5" cellpadding="2" align="center" b>
    <tr CLASS="HEADER">
      <th colspan="2"> <? echo adhesion_translate("Configuration du module adh�sion")?></th>
    </tr>
	<tr>
		<td class="ONGL" align="center" colspan="2">
			<strong><? echo adhesion_translate("Param�tre de l'adh�sion")?></strong>
		</td>
	</tr>
	<tr>
		<td align="center">
			<? echo adhesion_translate("Les cotisations se font sur une base annuelle.")?>&nbsp;<br>
			<? echo adhesion_translate("Entrez ci-dessous l'ann�e de la premi�re session de cotisation")?> :&nbsp;<br><br>
			<input type="text" name="cfg_start_jour" CLASS="TEXTBOX_STANDARD" value="<? echo  substr($config_module['cfg_date_start'],8,2)?>" size="1" maxlength="2">&nbsp;
					/
			<input type="text" name="cfg_start_mois" CLASS="TEXTBOX_STANDARD" value="<? echo  substr($config_module['cfg_date_start'],5,2)?>" size="1" maxlength="2">&nbsp;
					/
			<input type="text" name="cfg_start_annee" CLASS="TEXTBOX_STANDARD" value="<? echo  substr($config_module['cfg_date_start'],0,4)?>" size="2" maxlength="4">&nbsp;
			&nbsp;<B><? echo adhesion_translate("(format jj/mm/aaaa)")?></B><br><br><br><br>
			<? echo adhesion_translate("Entrez ci-dessous le nombre de sessions de cotisation � afficher dans le module adh�sion")?> :&nbsp;<br><br>
			<input type="text" name="cfg_nb_sessions" CLASS="TEXTBOX_STANDARD" value="<? echo  $config_module['cfg_nb_sessions']?>" size="1" maxlength="2">&nbsp;

		</td>
	</tr>
    <tr>
      <td class="ONGL" colspan="2" align="center"><strong><? echo adhesion_translate("Page de l'adh�rent")?></strong></td>
	</tr>
    <tr>
		<TD colspan="2" align="center">
		<BR>
		<? echo adhesion_translate("Texte d'accueil du formulaire d'adh�sion")?> :
		
	  <?
	   	if (strstr(getenv("HTTP_USER_AGENT"),"MSIE")) {$max_car=70;$MSIE=true;} else {$max_car=40;}
   		echo "<TEXTAREA class=\"textbox\" wrap=\"virtual\" cols=\"$max_car\" rows=\"24\" name=\"cfg_textaccueil\">".$config_module['cfg_txt_accueil']."</TEXTAREA>";
  		if ($MSIE) {
      		echo "&nbsp;<A HREF=\"javascript:\" onClick=\"window.open('editeur/editor.htm?story&activ=true', 'win1', 'width=650, height=450, resizable=yes');\">";
      		if ($ibid=theme_image("editeur/edit.gif")) {
		         $imgtmp="<IMG ALT=\"Editeur\" SRC=\"".$ibid."\" BORDER=\"0\" align=\"middle\">";
		      } else {
		         $imgtmp="<FONT CLASS=\"ROUGE\">[Editeur]</FONT>";
		      }
		      echo "$imgtmp</A>";
		   }
	  ?>
	  </TD> 
    </tr>
	<tr>
      <td class="ONGL" align="center" colspan="2"> 
	  	<strong><? echo adhesion_translate("Bloc adh�sion")?></strong>
	  </td>
    </tr>
	<tr>
		<td align="center" colspan="2">
			<? echo adhesion_translate("Titre")?> :<BR>
			<input class="textbox" type="text" name="cfg_bloc_titre" size="40" maxlength="60" value="<? echo  $config_module['cfg_bloc_titre'] ?>">
			<BR><BR><? echo adhesion_translate("Contenu")?> :<BR>
			<textarea class="textbox" cols="<? echo $max_car ?>" rows="12" name="cfg_bloc_contenu"><? echo  $config_module['cfg_bloc_contenu'] ?></textarea>
			<BR><BR>
		</td>
	</tr>

	<tr CLASS="HEADER">
      <th colspan="2">&nbsp; </th>
    </tr>
    <tr>
		<td align="center" colspan="2">
      		<input type="button" name="validate" value="<? echo adhesion_translate("Valider")?>" CLASS="BOUTON_STANDARD" onClick=Valider(config_module)>
			<input type="hidden" name="ActionForm" value="1">
		</td>
    </tr>
  </table>
</form>
