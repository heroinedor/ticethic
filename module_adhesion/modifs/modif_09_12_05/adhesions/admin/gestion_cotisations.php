<?
/**************************************************************************************************/
/* Module de gestion des adhérents d'une association pour NPDS version 5.0 P1 Runner              */
/* ===============================================================================================*/
/*                                                                                                */
/* This program is free software. You can redistribute it and/or modify it under the terms of     */
/* the GNU General Public License as published by the Free Software Foundation; either version 2  */
/* of the License.                                                                                */
/**************************************************************************************************/

	//initialisation des sessions de cotisations avec les données issues
	// de la table adhesion_config_tab
	$sql_ses = 'SELECT `valeur` , `parametre` '
		. ' FROM `adhesion_config_tab`'
		. ' WHERE `parametre` '
		. ' IN ( \'cfg_date_start\', \'cfg_nb_sessions\')';
    $result_ses = mysql_query($sql_ses);
	while (list($valeur, $parametre) = mysql_fetch_row($result_ses)){
		$config_ses[$parametre]=$valeur;
	}
	mysql_free_result($result_ses);
	$NB_SESSION=$config_ses['cfg_nb_sessions'];
	$ANNEE_DEBUT = $config_ses['cfg_date_start'];
	for ($i = 0; $i<$NB_SESSION; $i++){
	    $cotisation_tab[$i]['index']=0;
	}

	//Récupération dans la base des données
	 $sql = 'SELECT aa.`adh_nom`, 
	 			aa.`adh_prenom`, 
				aa.`adh_pseudo`,  
				g.`groupe_name`,
				ac.* '
			.'FROM `adhesion_cotisations` ac 
				INNER JOIN `adhesion_adherents` aa ON ac.`cot_adh_id` = aa.`adh_id`
				INNER JOIN `groupes` g ON aa.`adh_equipe` = g.`groupe_id` '
			.'ORDER BY 4,3';
	$resultat = mysql_query ($sql); 
	

	//On répartie les cotisations en tableaux: 1 par session de cotisation
	while (list ( $adh_nom, $adh_prenom, $adh_pseudo, $adh_equipe, $cot_id, $cot_adh_id, $cot_montant, $cot_date, $cot_session, $cot_type, $cot_comments) = mysql_fetch_row ($resultat)) {
		//index des cotisations dans le tableau des cotisations par session
		$index=$cotisation_tab[$cot_session]['index'];
		//Calcul du montant cotisé pour chaque équipe par session de cotisation
		if (isset($cotisation_tab[$cot_session]['cot_montant'][$adh_equipe])){
		    $montant_tmp=$cotisation_tab[$cot_session]['cot_montant'][$adh_equipe];
		}else{
		    $montant_tmp=0;
		}
		$cotisation_tab[$cot_session]['cot_montant'][$adh_equipe]=$montant_tmp+$cot_montant;
		
		//Remplissage du tableau des cotisations par session
		$cotisation_tab[$cot_session]['adh_nom'][$index]=$adh_nom;
		$cotisation_tab[$cot_session]['adh_prenom'][$index]=$adh_prenom;
		$cotisation_tab[$cot_session]['adh_pseudo'][$index]=$adh_pseudo;
		$cotisation_tab[$cot_session]['adh_equipe'][$index]=$adh_equipe;
		$cotisation_tab[$cot_session]['cot_id'][$index]=$cot_id;
		$cotisation_tab[$cot_session]['cot_adh_id'][$index]=$cot_adh_id;
		$cotisation_tab[$cot_session]['cot_montant'][$index]=$cot_montant;
		$cotisation_tab[$cot_session]['cot_date'][$index]=$cot_date;
		$cotisation_tab[$cot_session]['cot_session'][$index]=$cot_session;
		$cotisation_tab[$cot_session]['cot_type'][$index]=$cot_type;
		$cotisation_tab[$cot_session]['cot_comments'][$index]=$cot_comments;
  		switch ($cot_type){
		    case 1:
		        $cotisation_tab[$cot_session]['cot_type'][$index]= "Chèque";
		        break;
		    case 2:
		        $cotisation_tab[$cot_session]['cot_type'][$index]= "Virement";
		        break;
		    case 3:
		        $cotisation_tab[$cot_session]['cot_type'][$index]= "Espèce";
		        break;
		    case 4:
		        $cotisation_tab[$cot_session]['cot_type'][$index]= "Autre";
		        break;
			default:
			    $cotisation_tab[$cot_session]['cot_type'][$index]= "bla";
		}
		$cotisation_tab[$cot_session]['index']++;
	}
	mysql_free_result($resultat);
	//debug

  	//echo '<br>$sql ='.$sql.'<br>';
	/*echo "<table>";
	foreach ($cotisation_tab as $key => $value) {
		echo "<tr><td>Clé cotisation_tab: $key; </td><td>Valeur: $value</td></tr>\n";
	    if (is_array($value)){
		    foreach ($value as $cle => $valeur) {
	      		echo "<tr><td> - </td><td>Sous-Clé: $cle; </td><td>Valeur: $valeur</td></tr>\n";
	      		if (is_array($valeur)){
		      		foreach ($valeur as $k => $v) {
		      		    echo "<tr><td> - </td><td> - </td><td>Sous-Clé: $k; </td><td>Valeur: $v</td></tr>\n";
		      		}
	      		}
		    }
	    }
    }
	echo "</table>";*/
?>
<style type="text/css">
#tablist{
padding: 3px 0;
margin-left: 0;
margin-bottom: 0;
margin-top: 0.1em;
font: bold 12px Verdana;
}

#tablist li{
list-style: none;
display: inline;
margin: 0;
}

#tablist li a{
text-decoration: none;
padding: 3px 0.5em;
margin-left: 3px;
border: 1px solid #778;
border-bottom: none;
background: white;
}

#tablist li a:link, #tablist li a:visited{
color: navy;
}

#tablist li a.current{
background: lightyellow;
}

#tabcontentcontainer{
width:100%;
}

.tabcontent{
display:none;
}
</style>
<script type="text/javascript">

/***********************************************
* DD Tab Menu script- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

//Set tab to intially be selected when page loads:
//[which tab (1=first tab), ID of tab content to display]:
var initialtab=[1, "sc1"]

//Turn menu into single level image tabs (completely hides 2nd level)?
var turntosingle=0 //0 for no (default), 1 for yes

//Disable hyperlinks in 1st level tab images?
var disabletablinks=0 //0 for no (default), 1 for yes

////////Stop editting////////////////

var previoustab=""

if (turntosingle==1)
document.write('<style type="text/css">\n#tabcontentcontainer{display: none;}\n</style>')

function expandcontent(cid, aobject){
if (disabletablinks==1)
aobject.onclick=new Function("return false")
if (document.getElementById){
highlighttab(aobject)
if (turntosingle==0){
if (previoustab!="")
document.getElementById(previoustab).style.display="none"
document.getElementById(cid).style.display="block"
previoustab=cid
}
}
}

function highlighttab(aobject){
if (typeof tabobjlinks=="undefined")
collecttablinks()
for (i=0; i<tabobjlinks.length; i++)
tabobjlinks[i].className=""
aobject.className="current"
}

function collecttablinks(){
var tabobj=document.getElementById("tablist")
tabobjlinks=tabobj.getElementsByTagName("A")
}

function do_onload(){
collecttablinks()
expandcontent(initialtab[1], tabobjlinks[initialtab[0]-1])
}

if (window.addEventListener)
window.addEventListener("load", do_onload, false)
else if (window.attachEvent)
window.attachEvent("onload", do_onload)
else if (document.getElementById)
window.onload=do_onload


</script>
<br>
<?
	//Affichage des titres des onglets
	echo "<div id=\"tablist\">";
	for ($j=1;$j< $NB_SESSION+1;$j++){
	    $annee=$j+$ANNEE_DEBUT;
		echo '<li><a href="#" onClick="expandcontent(\'sc'.$j.'\', this)" alt="Année de cotisation">'.$annee.'</a>';
	}
	echo "</div>";
?>
<DIV id="tabcontentcontainer">
<?
	//Boucle pour afficher chaque tableau
	for ($index_session = 1; $index_session<$NB_SESSION+1; $index_session++){
?>
	<div id="sc<? echo $index_session?>" class="tabcontent">
		<table width="100%" border="0" cellspacing="0" cellpadding="2">
			<tr CLASS="HEADER">
				<th colspan=9>Détail des cotisations, année <? echo $index_session+$ANNEE_DEBUT; ?></th>
			</tr>
			<tr>
				<td CLASS="ONGL" width="10px"> &nbsp;# </td>
				<td CLASS="ONGL" width="90px"> &nbsp;Groupe </td>
				<td CLASS="ONGL" width="90px"> &nbsp;Pseudo </td>
				<td CLASS="ONGL" width="180px"> &nbsp;Nom Prénom </td>
				<td CLASS="ONGL" width="60px"> &nbsp;Montant</td>
				<td CLASS="ONGL" width="100px"> &nbsp;Date </td>
				<td CLASS="ONGL" width="60px"> &nbsp;Type </td>
				<td CLASS="ONGL" width="400px"> &nbsp;Commentaire </td>
				<td CLASS="ONGL" width="50px">&nbsp; </td>
			</tr>
	<?
	    //Affichage des lignes de chaque tableau
	    for ($index_ligne =0; $index_ligne<$cotisation_tab[$index_session]['index'];$index_ligne++){
	        $rowcolor = tablos();
			//Cas d'une ligne d'un membre d'une équipe
			echo "\n\t<tr $rowcolor>".
	      		"\n\t\t<td width=10px>&nbsp;".$cotisation_tab[$index_session]['cot_id'][$index_ligne]."<INPUT type=\"hidden\" name=\"adh_id\" value=\"".$cotisation_tab[$index_session]['cot_id'][$index_ligne]."\"></td>".
	            "\n\t\t<td width=90px>&nbsp;".$cotisation_tab[$index_session]['adh_equipe'][$index_ligne]."</td>".
	            "\n\t\t<td width=90px>&nbsp;".$cotisation_tab[$index_session]['adh_pseudo'][$index_ligne]."</td>".
	            "\n\t\t<td width=180px>&nbsp;".$cotisation_tab[$index_session]['adh_nom'][$index_ligne]." ".$cotisation_tab[$index_session]['adh_prenom'][$index_ligne]."</td>".
	            "\n\t\t<td width=60px>&nbsp;".$cotisation_tab[$index_session]['cot_montant'][$index_ligne]."</td>".
				"\n\t\t<td width=100px>&nbsp;".$cotisation_tab[$index_session]['cot_date'][$index_ligne]."</td>".
				"\n\t\t<td width=60px>&nbsp;".$cotisation_tab[$index_session]['cot_type'][$index_ligne]."</td>".
	            "\n\t\t<td width=400px>&nbsp;".$cotisation_tab[$index_session]['cot_comments'][$index_ligne]."</td>".
	            "\n\t\t<td width=50px align=right>&nbsp;".
							"<a href=\"admin.php?op=Extend-Admin-SubModule&ModPath=adhesions&ModStart=admin/admin_adhesion&choix=Cotisations&no_cot=".$cotisation_tab[$index_session]['cot_id'][$index_ligne]."\" CLASS=\"NOIR\">Editer</a>&nbsp;".
							"&nbsp;|&nbsp;".
							"<a href=\"admin.php?op=Extend-Admin-SubModule&ModPath=adhesions&ModStart=admin/admin_adhesion&choix=SupprCotisations&no_cot=".$cotisation_tab[$index_session]['cot_id'][$index_ligne]."\" CLASS=\"ROUGE\">Supprimer</a>".
	            "\n\t\t</td>\n\t</tr>";
	        //Cas d'une ligne de total d'une équipe
	        if ($cotisation_tab[$index_session]['adh_equipe'][$index_ligne]!=$cotisation_tab[$index_session]['adh_equipe'][$index_ligne+1]){
				$equipe=$cotisation_tab[$index_session]['adh_equipe'][$index_ligne];
				echo "\n\t<tr>".
					"\n\t\t<td colspan=\"3\" width=\"190px\" align=\"right\"><b>Total : </b></td>".
		      	    "\n\t\t<td width=\"180px\" align=\"center\"><b>".$cotisation_tab[$index_session]['adh_equipe'][$index_ligne]."</b></td>".
					"\n\t\t<td width=\"60px\">&nbsp;<b>".$cotisation_tab[$index_session]['cot_montant'][$equipe]." €</b></td>".
		            "\n\t\t<td colspan=\"4\">&nbsp;</td>\n\t</tr>";
			}
	    }
	?>
		</table>
	<br>
	</div>
	<?
	}//fin boucle affichage de chaque tableau
	?>
</DIV>


<?
/*******************************************************************/
/*******Affichage tableau d'ajout/modification des cotisation*******/
/*******************************************************************/
//Remplissage du tableau de la cotisation à modifier
  if (isset($no_cot)) {
        //Cas où le numéro de cotisation $no_cot est défini
        //ce qui correspond à une étape de modification d'une cotisation
        $ActionForm=1;
        //récupération des données de la cotisation à modifier
		$sql_cot = 'SELECT aa.`adh_id`,
				aa.`adh_pseudo`,
				ac.* '
			.'FROM `adhesion_cotisations` ac
					INNER JOIN `adhesion_adherents` aa ON ac.`cot_adh_id` = aa.`adh_id`'
			.'WHERE `cot_id`='.$no_cot;
	    $resultat_cot = mysql_query ($sql_cot);
	    $cotisation = mysql_fetch_assoc($resultat_cot);
	    mysql_free_result($resultat_cot);
	    
	    //Contenu du champs pseudo: ici c'est simplement le pseudo issu de la base
		$champs_pseudo ="<INPUT type=\"hidden\" name=\"adh_id\" value=\"".$cotisation['adh_id']."\"><b>".$cotisation['adh_pseudo']."</b>";
       	//texte de l'entête du tableau
	  	$entete="Modification d'une cotisation";
        //texte des boutons
		$bouton_valider="Valider";
		$bouton_retour="<a href=\"admin.php?op=Extend-Admin-SubModule&ModPath=adhesions&ModStart=admin/admin_adhesion&choix=Cotisations\">
			  <input type=\"button\" name=\"Validate\" value=\"Retour\" CLASS=\"BOUTON_STANDARD\">
			</a>";
	    
  } else {
        //Cas où le numéro de cotisation $no_cot n'est pas défini
        //ce qui correspond à une étape d'ajout de cotisation
        $ActionForm=2;
       	//texte de l'entête du tableau
	  	$entete="Ajout d'une cotisation";
	  	//Contenu du champs pseudo: ici c'est une liste déroulante qui contient
	  	//tous les pseudos des adhérents
		$champs_pseudo ="\n\t\t<select name=\"adh_id\" CLASS=\"TEXTBOX_STANDARD\">";
      	$sqlpseudos = 'SELECT aa.`adh_pseudo` , aa.`adh_id` '
	        		. ' FROM `adhesion_adherents` aa';
		$resultpseudo = mysql_query ($sqlpseudos);
		while (list ( $adh_pseudo, $adh_id) = mysql_fetch_row ($resultpseudo)) {
	        if ($adh_id==$cotisation['adh_id']){
	            $selected="selected";
			}
	        else {
				$selected="";
			}
		    $champs_pseudo .= "\n\t\t\t<option value=\"".$adh_id."\" ".$selected.">".$adh_pseudo."</option>\n";
		}
		$champs_pseudo .="\n\t\t\t\t</select>";
		mysql_free_result($resultpseudo);
		//texte du bouton
	  	$bouton_valider="Ajouter";
	  	$bouton_retour="";
	  	$adherent = array();
  }
?>

<form name="cotisation" method="post" action="admin.php?op=Extend-Admin-SubModule&ModPath=adhesions&ModStart=admin/admin_adhesion&choix=ModifCotisations">
  <table width="360px" border="0" cellspacing="1" cellpadding="2" align="center">
    <tr CLASS="HEADER">
      <th colspan=2> <?echo  $entete ?> </th>
    </tr>
    <tr>
      	<td>
	      	<INPUT type="hidden" name="cot_id" value="<?echo  $cotisation['cot_id']?>">
	      	<INPUT type="hidden" name="ActionForm" value="<?echo  $ActionForm?>">
		</td>
      	<td>  </td>
    </tr>
    <tr>
      <td> Pseudo </td>
      	<td>
            <?echo  $champs_pseudo ?>
		</td>
    </tr>
    <tr>
	    <td> Montant </td>
	    <td>
	  		<input type="text" name="cot_montant" CLASS="TEXTBOX_STANDARD" value="<?echo  $cotisation['cot_montant']?>" size="10" maxlength="6">
	  		<b>&nbsp; Euros </b>
		</td>
    </tr>
    <tr>
      <td> Date de paiement </td>
      <td>
      	<input type="text" name="date_paie_jour" CLASS="TEXTBOX_STANDARD" value="<?echo  substr($cotisation['cot_date'],8,2)?>" size="1" maxlength="2">&nbsp;
				/
	  	<input type="text" name="date_paie_mois" CLASS="TEXTBOX_STANDARD" value="<?echo  substr($cotisation['cot_date'],5,2)?>" size="1" maxlength="2">&nbsp;
				/
	  	<input type="text" name="date_paie_annee" CLASS="TEXTBOX_STANDARD" value="<?echo  substr($cotisation['cot_date'],0,4)?>" size="2" maxlength="4">&nbsp;
		&nbsp;<B>(format jj/mm/aaaa)</B>
	  </td>
    </tr>
    <tr>
      <td> Année </td>
      <td valign="middle">
        <select name="cot_session" CLASS="TEXTBOX_STANDARD">
            <?
                for ($k=0; $k<$NB_SESSION; $k++){
                    $v=$k+1;
                    echo "\n<option value=\"$v\"";
					if ($cotisation['cot_session']==$v){echo "selected";};
					echo ">";
					echo ($v+$ANNEE_DEBUT);
					echo "</option>";
                }
            ?>
	    </select>
	</td>
    <tr>
      <td> Type / référence</td>
      <td valign="middle">
        <select name="cot_type" CLASS="TEXTBOX_STANDARD">
            <option value="1" <? if ($cotisation['cot_type']==1){echo "selected";}?>>Chèque</option>
            <option value="2" <? if ($cotisation['cot_type']==2){echo "selected";}?>>Virement</option>
            <option value="3" <? if ($cotisation['cot_type']==3){echo "selected";}?>>Espèce</option>
            <option value="4" <? if ($cotisation['cot_type']==4){echo "selected";}?>>Autre</option>
	    </select>
	    /
		<input type="text" name="cot_reference" CLASS="TEXTBOX_STANDARD" value="<? echo  $cotisation['cot_reference']?>" size="27" maxlength="20">
	</td>
    </tr>
    <tr>
      <td> Commentaire </td>
      <td>
      	<Textarea name="cot_comments" CLASS="TEXTBOX_STANDARD" cols="40" rows="4" wrap="virtual"><? echo  $cotisation['cot_comments']?></Textarea>
      </td>
    </tr>
    <tr>
    	<td colspan=2 align="center">
      		<input type="submit" name="Validate" value="<?echo  $bouton_valider?>" CLASS="BOUTON_STANDARD">&nbsp;
      		<input type="reset" name="Reset" value="Remise à zéro" CLASS="BOUTON_STANDARD">&nbsp;
      		<? echo  $bouton_retour?>
   		</td>
    </tr>
  </table>
</form>
