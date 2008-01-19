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
/* Gestion des groupes faisant partie de l'association en fonction de l'ann�e de cotisation       */
/**************************************************************************************************/

	//initialisation des sessions de cotisations avec les donn�es issues
	// de la table adhesion_config_tab
	// On renseigne 2 constantes:
	// $NB_SESSION qui repr�sente le nombre de session affich� par le module
	// $ANNEE_DEBUT qui repr�sente la date de d�but de la premi�re saison de cotisation
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

	//R�cup�ration dans la base des donn�es de tous les groupes ayant adh�r� � l'association
	 $sql = 'SELECT 
				ag.`gr_id` , 
				ag.`gr_name` , 
				ag.`gr_description` , 
				ag.`gr_web` , 
				ag.`gr_irc`, 
				acg.`ses_id` , 
				acg.`cot_gr_statut` , 
				acg.`cot_gr_type` , 
				acg.`cot_gr_montant` 
			FROM `adhesion_groupe` ag 
			INNER JOIN `adhesion_cotisation_groupe` acg ON ag.`gr_id` = acg.`gr_id`';
	$resultat = mysql_query ($sql); 
	

	//On r�partie les cotisations en tableaux: 1 par session de cotisation
	while (list ( $gr_id, $gr_name, $gr_description, $gr_web, $gr_irc, $ses_id, $cot_gr_statut, $cot_gr_type, $cot_gr_montant) = mysql_fetch_row ($resultat)) {
		//index des cotisations dans le tableau des cotisations par session
		$index=$cotisation_tab[$ses_id]['index'];
		//Calcul du montant cotis� pour chaque �quipe par session de cotisation
		if (isset($cotisation_tab[$ses_id]['cot_montant'][$adh_equipe])){
		    $montant_tmp=$cotisation_tab[$ses_id]['cot_montant'][$adh_equipe];
		}else{
		    $montant_tmp=0;
		}
		$cotisation_tab[$ses_id]['cot_montant'][$adh_equipe]=$montant_tmp+$cot_montant;
		
		//Remplissage du tableau des cotisations par session
		$cotisation_tab[$ses_id]['gr_id'][$index]=$gr_id;
		$cotisation_tab[$ses_id]['gr_name'][$index]=$gr_name;
		$cotisation_tab[$ses_id]['gr_description'][$index]=$gr_description;
		$cotisation_tab[$ses_id]['gr_web'][$index]=$gr_web;
		$cotisation_tab[$ses_id]['gr_irc'][$index]=$gr_irc;
		$cotisation_tab[$ses_id]['ses_id'][$index]=$ses_id;
		$cotisation_tab[$ses_id]['cot_gr_statut'][$index]=$cot_gr_statut;
		$cotisation_tab[$ses_id]['cot_gr_type'][$index]=$cot_gr_type;
		$cotisation_tab[$ses_id]['cot_gr_montant'][$index]=$cot_gr_montant;
  		/*switch ($cot_type){
		    case 1:
		        $cotisation_tab[$ses_id]['cot_type'][$index]= "Ch�que";
		        break;
		    case 2:
		        $cotisation_tab[$ses_id]['cot_type'][$index]= "Virement";
		        break;
		    case 3:
		        $cotisation_tab[$ses_id]['cot_type'][$index]= "Esp�ce";
		        break;
		    case 4:
		        $cotisation_tab[$ses_id]['cot_type'][$index]= "Autre";
		        break;
			default:
			    $cotisation_tab[$ses_id]['cot_type'][$index]= "bla";
		}*/
		$cotisation_tab[$ses_id]['index']++;
	}
	mysql_free_result($resultat);
	//debug

  	//echo '<br>$sql ='.$sql.'<br>';
	var_dump($cotisation_tab);
	/*echo "<table>";
	foreach ($cotisation_tab as $key => $value) {
		echo "<tr><td>Cl� cotisation_tab: $key; </td><td>Valeur: $value</td></tr>\n";
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

<br>
<?
	//Affichage des titres des onglets
	echo "<div id=\"tablist\">";
	for ($j=1;$j< $NB_SESSION+1;$j++){
	    $annee=$j+$ANNEE_DEBUT;
		echo '<li><a href="#" onClick="expandcontent(\'sc'.$j.'\', this)" alt="Ann�e de cotisation">'.$annee.'</a>';
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
				<th colspan=9>D�tail des cotisations, ann�e <? echo $index_session+$ANNEE_DEBUT; ?></th>
			</tr>
			<tr>
				<td CLASS="ONGL" width="10px"> &nbsp;# </td>
				<td CLASS="ONGL" width="90px"> &nbsp;Groupe </td>
				<td CLASS="ONGL" width="90px"> &nbsp;Description </td>
				<td CLASS="ONGL" width="180px"> &nbsp;Site Web </td>
				<td CLASS="ONGL" width="60px"> &nbsp;Chan IRC </td>
				<td CLASS="ONGL" width="100px"> &nbsp;Statut </td>
				<td CLASS="ONGL" width="60px"> &nbsp;Type cotisation </td>
				<td CLASS="ONGL" width="400px"> &nbsp;Montant </td>
				<td CLASS="ONGL" width="50px">&nbsp; </td>
			</tr>
	<?
	    //Affichage des lignes de chaque tableau
	    for ($index_ligne =0; $index_ligne<$cotisation_tab[$index_session]['index'];$index_ligne++){
	        $rowcolor = tablos();
			//Cas d'une ligne d'un membre d'une �quipe
			echo "\n\t<tr $rowcolor>".
	      		"\n\t\t<td width=10px>&nbsp;".$cotisation_tab[$index_session]['gr_id'][$index_ligne]."<INPUT type=\"hidden\" name=\"adh_id\" value=\"".$cotisation_tab[$index_session]['gr_id'][$index_ligne]."\"></td>".
	            "\n\t\t<td width=90px>&nbsp;".$cotisation_tab[$index_session]['gr_name'][$index_ligne]."</td>".
	            "\n\t\t<td width=90px>&nbsp;".$cotisation_tab[$index_session]['gr_description'][$index_ligne]."</td>".
	            "\n\t\t<td width=180px>&nbsp;".$cotisation_tab[$index_session]['gr_web'][$index_ligne]." ".$cotisation_tab[$index_session]['adh_prenom'][$index_ligne]."</td>".
	            "\n\t\t<td width=60px>&nbsp;".$cotisation_tab[$index_session]['gr_irc'][$index_ligne]."</td>".
				"\n\t\t<td width=100px>&nbsp;".$cotisation_tab[$index_session]['cot_gr_statut'][$index_ligne]."</td>".
				"\n\t\t<td width=60px>&nbsp;".$cotisation_tab[$index_session]['cot_gr_type'][$index_ligne]."</td>".
	            "\n\t\t<td width=400px>&nbsp;".$cotisation_tab[$index_session]['cot_gr_montant'][$index_ligne]."</td>".
	            "\n\t\t<td width=50px align=right>&nbsp;".
							"<a href=\"admin.php?op=Extend-Admin-SubModule&ModPath=adhesions&ModStart=admin/admin_adhesion&choix=Cotisations&no_cot=".$cotisation_tab[$index_session]['cot_id'][$index_ligne]."\" CLASS=\"NOIR\">Editer</a>&nbsp;".
							"&nbsp;|&nbsp;".
							"<a href=\"admin.php?op=Extend-Admin-SubModule&ModPath=adhesions&ModStart=admin/admin_adhesion&choix=SupprCotisations&no_cot=".$cotisation_tab[$index_session]['cot_id'][$index_ligne]."\" CLASS=\"ROUGE\">Supprimer</a>".
	            "\n\t\t</td>\n\t</tr>";
	        //Cas d'une ligne de total d'une �quipe
	        if ($cotisation_tab[$index_session]['adh_equipe'][$index_ligne]!=$cotisation_tab[$index_session]['adh_equipe'][$index_ligne+1]){
				$equipe=$cotisation_tab[$index_session]['adh_equipe'][$index_ligne];
				echo "\n\t<tr>".
					"\n\t\t<td colspan=\"3\" width=\"190px\" align=\"right\"><b>Total : </b></td>".
		      	    "\n\t\t<td width=\"180px\" align=\"center\"><b>".$cotisation_tab[$index_session]['adh_equipe'][$index_ligne]."</b></td>".
					"\n\t\t<td width=\"60px\">&nbsp;<b>".$cotisation_tab[$index_session]['cot_montant'][$equipe]." �</b></td>".
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
//Remplissage du tableau de la cotisation � modifier
  if (isset($no_cot)) {
        //Cas o� le num�ro de cotisation $no_cot est d�fini
        //ce qui correspond � une �tape de modification d'une cotisation
        $ActionForm=1;
        //r�cup�ration des donn�es de la cotisation � modifier
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
       	//texte de l'ent�te du tableau
	  	$entete="Modification d'une cotisation";
        //texte des boutons
		$bouton_valider="Valider";
		$bouton_retour="<a href=\"admin.php?op=Extend-Admin-SubModule&ModPath=adhesions&ModStart=admin/admin_adhesion&choix=Cotisations\">
			  <input type=\"button\" name=\"Validate\" value=\"Retour\" CLASS=\"BOUTON_STANDARD\">
			</a>";
	    
  } else {
        //Cas o� le num�ro de cotisation $no_cot n'est pas d�fini
        //ce qui correspond � une �tape d'ajout de cotisation
        $ActionForm=2;
       	//texte de l'ent�te du tableau
	  	$entete="Ajout d'une cotisation";
	  	//Contenu du champs pseudo: ici c'est une liste d�roulante qui contient
	  	//tous les pseudos des adh�rents
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
<?
global $ModPath, $ModStart;
// C'est bien admin.php qui appel� mais avec les codes op�rations op ET subop
echo"<form name=\"cotisation\" action=\"admin.php\" method=\"post\">";

// lignes obligatoires pour pouvoir utiliser NPDS-plugins
echo "\n<input type=\"hidden\" name=\"op\" value=\"Extend-Admin-SubModule\">";
echo "\n<input type=\"hidden\" name=\"ModPath\" value=\"$ModPath\">";
echo "\n<input type=\"hidden\" name=\"ModStart\" value=\"$ModStart\">";

// sous-op�ration du module
echo "\n<input type=\"hidden\" name=\"subop\" value=\"ModifCotisations\">";
// lignes obligatoires pour pouvoir utiliser NPDS-plugins
?>

<!--<form name="cotisation" method="post" action="admin.php?op=Extend-Admin-SubModule&ModPath=adhesions&ModStart=admin/admin_adhesion&choix=ModifCotisations">-->
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
      <td> Ann�e </td>
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
      <td> Type / r�f�rence</td>
      <td valign="middle">
        <select name="cot_type" CLASS="TEXTBOX_STANDARD">
            <option value="1" <? if ($cotisation['cot_type']==1){echo "selected";}?>>Ch�que</option>
            <option value="2" <? if ($cotisation['cot_type']==2){echo "selected";}?>>Virement</option>
            <option value="3" <? if ($cotisation['cot_type']==3){echo "selected";}?>>Esp�ce</option>
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
      		<input type="reset" name="Reset" value="Remise � z�ro" CLASS="BOUTON_STANDARD">&nbsp;
      		<? echo  $bouton_retour?>
   		</td>
    </tr>
  </table>
</form>
