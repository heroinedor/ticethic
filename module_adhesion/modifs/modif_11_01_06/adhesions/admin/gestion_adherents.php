<?
/**************************************************************************************************/
/* Module de gestion des adhérents d'une association pour NPDS version 5.0 P1 Runner              */
/* ===============================================================================================*/
/*                                                                                                */
/* This program is free software. You can redistribute it and/or modify it under the terms of     */
/* the GNU General Public License as published by the Free Software Foundation; either version 2  */
/* of the License.                                                                                */
/**************************************************************************************************/

/**************************************************************************************************/
/* Gestion des adhérents faisant partie de l'association en fonction de l'année de cotisation 	  */
/**************************************************************************************************/

/********************************************
*	Remplissage des 3 tableaux des adhérents
*		1- Adhérents validés
*		2- Demandes en attente de validation
*		3- Demandes refusées
**********************************************/

global $sessCotis;

	//Détermination de la clé de tri des tableaux
	if (!isset($_GET['sort'])){
		$sort = 1;
	}else{
		$sort = $_GET['sort'];
	}
	//Détermination de l'ordre de tri des tableaux
	if (!isset($_GET['sortorder'])){
		$sortorder = "ASC";
	}else{
		$sortorder = $_GET['sortorder'];
	}

	//remplissage du tableau global contenant tous les enregistrements issus de la BDD
	$sql = 'SELECT distinct aa.`adh_id`, 
	   aa.`adh_nom`, 
	   aa.`adh_prenom`, 
	   aa.`adh_adresse`, 
	   aa.`adh_code_postal`, 
	   aa.`adh_ville`, 
	   aa.`adh_pays`, 
	   aa.`adh_sexe`, 
	   aa.`adh_email`, 
	   aa.`adh_pseudo`,
	   ag.`gr_name` adh_equipe,
	   ac.`cot_adh_statut` adh_statut,
	   aa.`adh_date_naissance`, 
	   aa.`adh_telephone_fixe`, 
	   aa.`adh_telephone_portable`,
	   ac.`cot_adh_gerant`,
	   ase.`ses_id`
	FROM `adhesion_adherent` aa
		 INNER JOIN `adhesion_cotisation` ac ON aa.`adh_id` = ac.`adh_id`
		 INNER JOIN `adhesion_groupe` ag ON ac.`gr_id` = ag.`gr_id`
		 INNER JOIN `adhesion_session` ase ON ac.`ses_id` = ase.`ses_id`
	ORDER BY '.$sort.' '.$sortorder;
  	$resultat = mysql_query ($sql);
	$adherent_tab = array();
	$j=0;
	while ($adh_row = mysql_fetch_array($resultat)){
		$adherent_tab['global'][$j]=$adh_row;
		$j++;
	}
	mysql_free_result($resultat);
	
	
	//Affichage des titres des onglets
	echo "<div id=\"tablist\">";
	for ($j=1;$j< $sessCotis['nbSession']+1;$j++){
	    $annee=$j+$sessCotis['firstSession'];
		echo '<li><a href="#" onClick="expandcontent(\'sc'.$j.'\', this)" alt="Année de cotisation">'.$annee.'</a>';
	}
	echo "</div>";
?>
<DIV id="tabcontentcontainer">
<?
	//Répartition des données du tableau global en 3 sous tableaux:
	//		1- adhérents validés
	//		2- adhérents en attente
	//		3- adhérents refusés
	
	//initialisation des index
	$index_val = 0;
	$index_att = 0;
	$index_ref = 0;
	//initialisation des titres
	$adherent_tab[1]['title']=adhesion_translate("Adhérents");
	$adherent_tab[2]['title']=adhesion_translate("Demandes en attentes de validation");
	$adherent_tab[3]['title']=adhesion_translate("Demandes refusées");

	//répartition en 3 tableaux
	for ($i = 0; $i < sizeof($adherent_tab['global']); $i++){
	 	switch($adherent_tab['global'][$i]['adh_statut']){
			case 1:
				$adherent_tab[1][$index_val]=$adherent_tab['global'][$i];
				$index_val++;
				break;
			case 2:
				$adherent_tab[2][$index_att]=$adherent_tab['global'][$i];
				$index_att++;
				break;
			case 3:
				$adherent_tab[3][$index_ref]=$adherent_tab['global'][$i];
				$index_ref++;
				break;
			default:
				break;
		}
	 }


	 //Boucle pour l'affichage des différentes sessions
	 	//Boucle pour afficher chaque tableau
	for ($index_session = 1; $index_session<$sessCotis['nbSession']+1; $index_session++){
?>
	<div id="sc<? echo $index_session?>" class="tabcontent">
<?
		//Boucle pour l'affichage des 3 tableaux
		for($tab = 1; $tab < sizeof($adherent_tab); $tab++){
	?>
		<table width="100%" border="0" cellspacing="1" cellpadding="2">
		<tr CLASS="HEADER">
		  <th colspan=9> <? echo adhesion_translate("Année")." ".($sessCotis['firstSession'] + $index_session) ?> </th>
		</tr>
		<tr CLASS="HEADER">
		  <th colspan=9> <? echo $adherent_tab[$tab]['title'] ?> </th>
		</tr>
		<tr>
			<!--<td CLASS="ONGL" width="50px" align="center" nowrap="nowrap"> 
				<a href="admin.php?op=Extend-Admin-SubModule&ModPath=adhesions&ModStart=admin/admin_adhesion&sort=1&sortorder=ASC"><img src="images/download/up.gif"  alt="Ordre croissant" title="Ordre croissant" border="0"></a>
				id
				<a href="admin.php?op=Extend-Admin-SubModule&ModPath=adhesions&ModStart=admin/admin_adhesion&sort=1&sortorder=DESC"><img src="images/download/down.gif"  alt="Ordre décroissant" title="Ordre décroissant" border="0"></a>
			</td>-->
			<td CLASS="ONGL" width="80px" align="center" nowrap="nowrap">
				<a href="admin.php?op=Extend-Admin-SubModule&ModPath=adhesions&ModStart=admin/admin_adhesion&sort=11&sortorder=ASC"><img src="images/download/up.gif"  alt="Ordre croissant" title="Ordre croissant" border="0"></a>
				<? echo adhesion_translate("Groupe")?>
				<a href="admin.php?op=Extend-Admin-SubModule&ModPath=adhesions&ModStart=admin/admin_adhesion&sort=11&sortorder=DESC"><img src="images/download/down.gif"  alt="Ordre décroissant" title="Ordre décroissant" border="0"></a>
			</td>
			<td CLASS="ONGL" width="80px" align="center" nowrap="nowrap">
				<a href="admin.php?op=Extend-Admin-SubModule&ModPath=adhesions&ModStart=admin/admin_adhesion&sort=10&sortorder=ASC"><img src="images/download/up.gif"  alt="Ordre croissant" title="Ordre croissant" border="0"></a>
				<? echo adhesion_translate("Pseudo")?>
				<a href="admin.php?op=Extend-Admin-SubModule&ModPath=adhesions&ModStart=admin/admin_adhesion&sort=10&sortorder=DESC"><img src="images/download/down.gif"  alt="Ordre décroissant" title="Ordre décroissant" border="0"></a>
			</td>
			<td CLASS="ONGL" width="130px" align="center" nowrap="nowrap">
				<a href="admin.php?op=Extend-Admin-SubModule&ModPath=adhesions&ModStart=admin/admin_adhesion&sort=2&sortorder=ASC"><img src="images/download/up.gif"  alt="Ordre croissant" title="Ordre croissant" border="0"></a>
				<? echo adhesion_translate("Nom Prénom")?>
				<a href="admin.php?op=Extend-Admin-SubModule&ModPath=adhesions&ModStart=admin/admin_adhesion&sort=2&sortorder=DESC"><img src="images/download/down.gif"  alt="Ordre décroissant" title="Ordre décroissant" border="0"></a>
			</td>
			<td CLASS="ONGL" width="200px" align="center" nowrap="nowrap">
				<a href="admin.php?op=Extend-Admin-SubModule&ModPath=adhesions&ModStart=admin/admin_adhesion&sort=3&sortorder=ASC"><img src="images/download/up.gif"  alt="Ordre croissant" title="Ordre croissant" border="0"></a>
				<? echo adhesion_translate("Adresse Complète")?>
				<a href="admin.php?op=Extend-Admin-SubModule&ModPath=adhesions&ModStart=admin/admin_adhesion&sort=3&sortorder=DESC"><img src="images/download/down.gif"  alt="Ordre décroissant" title="Ordre décroissant" border="0"></a>
			</td>
			<td CLASS="ONGL" width="90px" align="center" nowrap="nowrap">
				<a href="admin.php?op=Extend-Admin-SubModule&ModPath=adhesions&ModStart=admin/admin_adhesion&sort=14&sortorder=ASC"><img src="images/download/up.gif"  alt="Ordre croissant" title="Ordre croissant" border="0"></a>
				<? echo adhesion_translate("Tel. Fixe")?>
				<a href="admin.php?op=Extend-Admin-SubModule&ModPath=adhesions&ModStart=admin/admin_adhesion&sort=14&sortorder=DESC"><img src="images/download/down.gif"  alt="Ordre décroissant" title="Ordre décroissant" border="0"></a>
			</td>
			<td CLASS="ONGL" width="90px" align="center" nowrap="nowrap">
				<a href="admin.php?op=Extend-Admin-SubModule&ModPath=adhesions&ModStart=admin/admin_adhesion&sort=15&sortorder=ASC"><img src="images/download/up.gif"  alt="Ordre croissant" title="Ordre croissant" border="0"></a>
				<? echo adhesion_translate("Tel. Port.")?>
				<a href="admin.php?op=Extend-Admin-SubModule&ModPath=adhesions&ModStart=admin/admin_adhesion&sort=15&sortorder=DESC"><img src="images/download/down.gif"  alt="Ordre décroissant" title="Ordre décroissant" border="0"></a>
			</td>
			<td CLASS="ONGL" width="170px" align="center" nowrap="nowrap">
				<a href="admin.php?op=Extend-Admin-SubModule&ModPath=adhesions&ModStart=admin/admin_adhesion&sort=9&sortorder=ASC"><img src="images/download/up.gif"  alt="Ordre croissant" title="Ordre croissant" border="0"></a>
				<? echo adhesion_translate("Email")?>
				<a href="admin.php?op=Extend-Admin-SubModule&ModPath=adhesions&ModStart=admin/admin_adhesion&sort=9&sortorder=DESC"><img src="images/download/down.gif"  alt="Ordre décroissant" title="Ordre décroissant" border="0"></a>
			</td>
			<td CLASS="ONGL" width="50px">&nbsp; </td>
		</tr>
	<?
		 for ($tab_index = 0; $tab_index < sizeof($adherent_tab[$tab])-1; $tab_index++) {
			$rowcolor = tablos();
			echo "\n\t<tr $rowcolor>".
					//"\n\t\t<td width=50px  align=\"center\">&nbsp;".$adherent_tab[$tab][$tab_index]['adh_id']."<INPUT type=\"hidden\" name=\"adh_id\" value=\"$adh_id\"></td>".
					//"\n\t\t<td width=80px align=\"center\" nowrap=\"nowrap\">&nbsp;".$adherent_tab[$tab][$tab_index]['adh_equipe']."</td>".
					"\n\t\t<td width=80px align=\"center\" nowrap=\"nowrap\">&nbsp;".$adherent_tab[$tab][$tab_index]['adh_equipe']."<INPUT type=\"hidden\" name=\"adh_id\" value=\"$adh_id\"></td>".
					"\n\t\t<td width=80px>&nbsp;".$adherent_tab[$tab][$tab_index]['adh_pseudo']."</td>".
					"\n\t\t<td width=130px>&nbsp;".$adherent_tab[$tab][$tab_index]['adh_nom']." ".$adherent_tab[$tab][$tab_index]['adh_prenom']."</td>".
					"\n\t\t<td width=200px>&nbsp;".$adherent_tab[$tab][$tab_index]['adh_adresse']." ".$adherent_tab[$tab][$tab_index]['adh_code_postal']." ".$adherent_tab[$tab][$tab_index]['adh_ville']."</td>".
					"\n\t\t<td width=90px align=\"center\" nowrap=\"nowrap\">&nbsp;".$adherent_tab[$tab][$tab_index]['adh_telephone_fixe']."</td>".
					"\n\t\t<td width=90px align=\"center\" nowrap=\"nowrap\">&nbsp;".$adherent_tab[$tab][$tab_index]['adh_telephone_portable']."</td>".
					"\n\t\t<td width=170px>&nbsp;".$adherent_tab[$tab][$tab_index]['adh_email']."</td>".
					"\n\t\t<td width=50px align=right>&nbsp;".
								"<a href=\"admin.php?op=Extend-Admin-SubModule&ModPath=adhesions&ModStart=admin/admin_adhesion&subop=Adherents&no_adh=".$adherent_tab[$tab][$tab_index]['adh_id']."\" CLASS=\"NOIR\">Editer</a>&nbsp;".
								"&nbsp;|&nbsp;".
								"<a href=\"admin.php?op=Extend-Admin-SubModule&ModPath=adhesions&ModStart=admin/admin_adhesion&subop=SupprAdherent&no_adh=".$adherent_tab[$tab][$tab_index]['adh_id']."\" CLASS=\"ROUGE\">Supprimer</a>".
					"\n\t\t</td>\n\t</tr>";
		  }
	?>
		</table>
	<br>
	<?
	}//fin boucle affichage des 3 tableaux

echo "\n\t</div>"; //fin du div de chaque session
	}//fin boucle affichage de chaque session
echo "\n</div>"; //fin du div du contentcontainer





/*******************************************************************/
/*******Affichage tableau d'ajout/modification des adhérents*******/
/*******************************************************************/
  if (isset($_GET['no_adh'])) {
        //Cas où le numéro d'adhérent $no_adh est défini
        //ce qui correspond à une étape de modification d'un adhérent
        $ActionForm=1;
		$no_adh=$_GET['no_adh'];
		//récupération des données de l'adhérent à modifier/valider
			$sql_adh = 'SELECT aa.`adh_id`, 
					   aa.`adh_nom`, 
					   aa.`adh_prenom`, 
					   aa.`adh_adresse`, 
					   aa.`adh_code_postal`, 
					   aa.`adh_ville`, 
					   aa.`adh_pays`, 
					   aa.`adh_sexe`, 
					   aa.`adh_email`, 
					   aa.`adh_pseudo`,
					   ag.`gr_name` adh_equipe,
					   ac.`cot_adh_statut` adh_statut,
					   aa.`adh_date_naissance`, 
					   aa.`adh_telephone_fixe`, 
					   aa.`adh_telephone_portable`,
					   ac.`cot_adh_gerant` adh_gerant
					FROM `adhesion_adherent` aa
						 INNER JOIN `adhesion_cotisation` ac ON aa.`adh_id` = ac.`adh_id`
						 INNER JOIN `adhesion_groupe` ag ON ac.`gr_id` = ag.`gr_id`
					WHERE aa.`adh_id`='.$no_adh;
		
		/*$sql_adh ='SELECT aa.`adh_id`, 
					aa.`adh_nom`, 
					aa.`adh_prenom`, 
					aa.`adh_adresse`, 
					aa.`adh_code_postal`, 
					aa.`adh_ville`, 
					aa.`adh_pays`, 
					aa.`adh_sexe`, 
					aa.`adh_email`, 
					aa.`adh_pseudo`, 
					aa.`adh_equipe`, 
					aa.`adh_statut`, 
					aa.`adh_date_naissance`, 
					aa.`adh_telephone_fixe`, 
					aa.`adh_telephone_portable` 
			FROM `adhesion_adherents` aa WHERE `adh_id`='.$no_adh;*/
		//$sql_adh = 'SELECT * FROM `adhesion_adherents` WHERE `adh_id`='.$no_adh;
		$resultat_adh = mysql_query ($sql_adh);
		$adherent = mysql_fetch_assoc($resultat_adh);
		mysql_free_result($resultat_adh);
	    
	    //Contenu du champs pseudo: ici c'est simplement le pseudo issu de la base
		$champs_pseudo ="<INPUT type=\"hidden\" name=\"adh_id\" value=\"".$adherent['adh_id']."\"><b>".$adherent['adh_pseudo']."</b>";
       	//texte de l'entête du tableau
	  	$entete=adhesion_translate("Modification/validation d'un adhérent");
        //texte des boutons
		$bouton_valider=adhesion_translate("Valider");
		$bouton_retour="<a href=\"admin.php?op=Extend-Admin-SubModule&ModPath=adhesions&ModStart=admin/admin_adhesion&subop=Adherents\">
			  <input type=\"button\" name=\"Validate\" value=\"".adhesion_translate("Valider")."\" CLASS=\"BOUTON_STANDARD\">
			</a>";

  } else {
        //Cas où le numéro d'adhérent $no_adh n'est pas défini
        //ce qui correspond à une étape d'ajout d'adhérent
        $ActionForm=2;
		$adherent = array();
       	//texte de l'entête du tableau
	  	$entete=adhesion_translate("Ajout d'un adhérent");
	  	//Contenu du champs pseudo: ici c'est une liste déroulante qui contient
	  	//tous les pseudos des adhérents
		$champs_pseudo ="\n\t\t<select name=\"adh_id\" CLASS=\"TEXTBOX_STANDARD\">";
      	$sqlpseudos = 'SELECT `uname`,`uid` FROM `users`';
		$resultpseudo = mysql_query ($sqlpseudos);
		while (list ( $adh_pseudo, $adh_id) = mysql_fetch_row ($resultpseudo)) {
		    $champs_pseudo .= "\n\t\t\t<option value=\"".$adh_id."\">".$adh_pseudo."</option>\n";
		}
		$champs_pseudo .="\n\t\t\t\t</select>";
		mysql_free_result($resultpseudo);
		//texte du bouton
	  	$bouton_valider=adhesion_translate("Ajouter");
	  	$bouton_retour="";
  }
  
/*********************************************************
*Fonction de récupération de la liste de tous les groupes adhérents
**********************************************************/
function groupe_adherents(){
		 $sql_gr = 'SELECT `gr_id` , `gr_name` FROM `adhesion_groupe` ';
		 $resultat_gr = mysql_query($sql_gr);
		 if (!$resultat_gr) {
			echo '<br><div class="ROUGE">Impossible d\'exécuter la requête sur les groupes adhérents: ' . mysql_error().'</div><br>';
			exit;
		}
		 /*$sql_adh = 'SELECT ac.`valeur` , g.`groupe_name` '
		        . ' FROM `adhesion_config_tab` ac'
        		. ' INNER JOIN `groupes` g ON ac.`valeur` = g.`groupe_id` '
		        . ' WHERE ac.`parametre` '
		        . ' LIKE ( \'cfg_groupe%\' )';*/
		$k = 0;
		while ($valeur = mysql_fetch_array($resultat_gr)){
			$groupe_adh[$k] = $valeur;
			$k++;
		}
		mysql_free_result($resultat_gr);
		return $groupe_adh;
}


?>
<?
var_dump($adherent);
global $ModPath, $ModStart;
// C'est bien admin.php qui appelé mais avec les codes opérations op ET subop
echo"<form name=\"adherent\" action=\"admin.php\" method=\"post\">";

// lignes obligatoires pour pouvoir utiliser NPDS-plugins
echo "\n<input type=\"hidden\" name=\"op\" value=\"Extend-Admin-SubModule\">";
echo "\n<input type=\"hidden\" name=\"ModPath\" value=\"$ModPath\">";
echo "\n<input type=\"hidden\" name=\"ModStart\" value=\"$ModStart\">";

// sous-opération du module
echo "\n<input type=\"hidden\" name=\"subop\" value=\"ModifAdherent\">";
// lignes obligatoires pour pouvoir utiliser NPDS-plugins
?>
<!--<form name="adherent" method="post" action="admin.php?op=Extend-Admin-SubModule&ModPath=adhesions&ModStart=admin/admin_adhesion&choix=ModifAdherent">-->
  <table width="400px" border="0" cellspacing="1" cellpadding="2" align="center">
    <tr CLASS="HEADER">
      <th colspan=2> <? echo  $entete ?> </th>
    </tr>
	<tr>
      	<td><INPUT type="hidden" name="ActionForm" value="<? echo  $ActionForm ?>"></td>
      	<td> <? echo  $champs_pseudo ?> </td>
    </tr>
	<tr>
      <td> <? echo adhesion_translate("Nom")?> </td>
      <td> <input type="text" name="name" CLASS="TEXTBOX_STANDARD" value="<?echo  $adherent['adh_nom']?>" size="50" maxlength="40"> </td>
    </tr>
    <tr>
      <td> <? echo adhesion_translate("Prénom")?> </td>
      <td> <input type="text" name="firstname" CLASS="TEXTBOX_STANDARD" value="<?echo  $adherent['adh_prenom']?>" size="50" maxlength="30"> </td>
    </tr>
    <tr>
      <td> <? echo adhesion_translate("Adresse")?> </td>
      <td> <input type="text" name="address" CLASS="TEXTBOX_STANDARD" value="<?echo  $adherent['adh_adresse']?>" size="50" maxlength="100"> </td>
    </tr>
    <tr>
      <td> <? echo adhesion_translate("Code Postal")?> </td>
      <td> <input type="text" name="postal_code" CLASS="TEXTBOX_STANDARD" value="<?echo  $adherent['adh_code_postal']?>" size="50" maxlength="10"> </td>
    </tr>
    <tr>
      <td> <? echo adhesion_translate("Ville")?> </td>
      <td> <input type="text" name="city" CLASS="TEXTBOX_STANDARD" value="<?echo  $adherent['adh_ville']?>" size="50" maxlength="30"> </td>
    </tr>
    <tr>
      <td> <? echo adhesion_translate("Pays")?> </td>
      <td> <input type="text" name="country" CLASS="TEXTBOX_STANDARD" value="<?echo  $adherent['adh_pays']?>" size="50" maxlength="20"> </td>
    </tr>
		<tr>
      <td> <? echo adhesion_translate("Téléphone Fixe")?> </td>
      <td> <input type="text" name="telephone_fixe" CLASS="TEXTBOX_STANDARD" value="<?echo  $adherent['adh_telephone_fixe']?>" size="50" maxlength="14"> </td>
    </tr>
	<tr>
      <td> <? echo adhesion_translate("Téléphone Portable")?> </td>
      <td> <input type="text" name="telephone_portable" CLASS="TEXTBOX_STANDARD" value="<?echo  $adherent['adh_telephone_portable']?>" size="50" maxlength="14"> </td>
    </tr>
    <tr>
      <td> <? echo adhesion_translate("Date de naissance")?> </td>
      <td> 
	  	<input type="text" name="date_naiss_jour" CLASS="TEXTBOX_STANDARD" value="<?echo  substr($adherent['adh_date_naissance'],8,2)?>" size="1" maxlength="2">&nbsp; 
				/ 
	  	<input type="text" name="date_naiss_mois" CLASS="TEXTBOX_STANDARD" value="<?echo  substr($adherent['adh_date_naissance'],5,2)?>" size="1" maxlength="2">&nbsp; 
				/ 
	  	<input type="text" name="date_naiss_annee" CLASS="TEXTBOX_STANDARD" value="<?echo  substr($adherent['adh_date_naissance'],0,4)?>" size="2" maxlength="4">&nbsp; 
		&nbsp;<B>(format jj/mm/aaaa)</B> 
	  </td>
    </tr>
    <tr>
      <td> <? echo adhesion_translate("Sexe")?> </td>
      <td valign="middle"> 
  				&nbsp; H
					<input type="radio" name="sexe" value="H" <? if ($adherent['adh_sexe']=='H'){echo "checked";}?>>&nbsp; 
  				F
  				<input type="radio" name="sexe" value="F" <? if ($adherent['adh_sexe']=='F'){echo "checked";}?>> 
  		</td>
    </tr>
    <tr>
			<td> <? echo adhesion_translate("Email")?> </td>
      <td>
				<input type="text" name="email" CLASS="TEXTBOX_STANDARD" value="<? echo  $adherent['adh_email']?>" size="50" maxlength="60">
			</td>
    </tr>
    <tr>
		<td> <? echo adhesion_translate("Groupe")?> </td>
		<td>
			<select name="team" CLASS="TEXTBOX_STANDARD">
			<?
				//Récupération des groupes adhérents
				$groupe_adh = groupe_adherents();
				for ($i = 0; $i<sizeof($groupe_adh);$i++){
					$selected = "";
					if  ($adherent['adh_equipe']==$groupe_adh[$i]['gr_name']) {$selected = "selected";}
					echo "<option $selected value=".$groupe_adh[$i]['gr_id'].">".$groupe_adh[$i]['gr_name']."</option>";
				}
			?>
			</select>
		</td>
    </tr>
    <tr>
      <td> <? echo adhesion_translate("Statut")?> </td>
      <td  valign="middle"> 
				&nbsp; <? echo adhesion_translate("Validé")?>
				<input type="radio" name="statut" value="1" <? if ($adherent['adh_statut']==1){echo "checked";}?>>&nbsp; 
				<? echo adhesion_translate("En attente")?>
				<input type="radio" name="statut" value="2" <? if ($adherent['adh_statut']==2){echo "checked";}?>>&nbsp; 
				<? echo adhesion_translate("Refusé")?> 
				<input type="radio" name="statut" value="3" <? if ($adherent['adh_statut']==3){echo "checked";}?>> 
			</td>
    </tr>
    <tr>
      <td>  </td>
      <td>  </td>
    </tr>
    <tr>
		<td colspan=2 align="center">
      		<input type="submit" name="validate" value="<? echo  $bouton_valider ?>" CLASS="BOUTON_STANDARD">
			<input type="reset" name="Reset" value="<? echo adhesion_translate("Remise à zéro")?>" CLASS="BOUTON_STANDARD">&nbsp;
			<? echo  $bouton_retour ?>
		</td>
    </tr>
  </table>
</form>
