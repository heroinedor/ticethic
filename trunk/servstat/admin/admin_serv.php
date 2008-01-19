<?PHP

/**************************************************************************************************/
/* Module d'affichage des statistiques d'un parc de serveurs de jeux en ligne                     */
/* pour NPDS version Sable. www.funxp.net pour plus de renseignements                             */
/* ===============================================================================================*/
/*                                                                                                */
/* This program is free software. You can redistribute it and/or modify it under the terms of     */
/* the GNU General Public License as published by the Free Software Foundation; either version 2  */
/* of the License.                                                                                */
/**************************************************************************************************/

/**************************************************************************************************/
/* Administration du MODULE    Servstat 2                                                         */
/**************************************************************************************************/

/*************************************************************
*	Plusieurs cas de figure possible suivant 
*	l'état de la variable $choix
*		0- $choix non définie : Consultation
*		1- $choix = AjoutServeur : Ajout d'un serveur
*		2- $choix = ModifServeur : Modification d'un serveur
*		3- $choix = SupprServeur : Suppressoin d'un serveur
*************************************************************/

	//Sécurisation de l'accès
	if (!eregi("admin.php", $PHP_SELF)) { Access_Error(); }
	if ($admin) {
	
	/**************/
	/* Inclusions */
	/**************/
	global $language,$ModPath;
	//config module
	require_once("modules/$ModPath/serv_config.php");
	//fonctions du module
	include_once($serv_path."serv_functions.php");
	//Librairies de communication avec le serveur
    include_once($serv_lib_path."main.lib.php");
    //traduction du module
    include_once($serv_lang_path.$language.".php");

	global $servstat_path;
	$serveur = array();
	$message_1er_tab = "";
	$message_2nd_tab = "";
	$action = ""; //Action du formulaire du 2nd tableau
	$entete = ""; //Entete du 2nd tableau
	$bouton_valider = ""; //Texte  du bouton valider du 2nd tableau
	$bouton_retour = ""; //Code du bouton retour du 2nd tableau
	
	// Si une valeur a été définie pour $choix via la méthode
	// POST elle est prioritaire sur celle définie via la méthode GET
	if (isset($_POST['choix'])) {
		$choix = $_POST['choix'];
	}else{
		if (isset($_GET['choix'])) {
			$choix = $_GET['choix'];
		}
	}

	//Sélection de l'action à effectuer en fonction de la valeur de $choix
	switch($choix){
		case "AjoutServeur": //1- Ajout de Serveur
			ajout_serveur();
			break;
		case "ModifServeur": //2- Modification de Serveur
			modif_serveur();
			break;
		case "SupprServeur": //3- Suppression d'un Serveur
			suppr_serveur();
			break;
		default:
			consultation_serveurs();
			break;
	}
	
	//Récupération de la liste des serveurs dans la variable $liste_serv
	$liste_serv = liste_serveurs();

	//Balisage du début du code du module dans les sources HTML
	echo "\n<!-- Début du code généré par le module de Servstat  -->";
	OpenTable();
	echo $message_1er_tab;
?>
<table width="100%" border="0" cellspacing="1" cellpadding="2">
	<tr CLASS="HEADER">
		<th colspan=10><?=servstat_translate("Console d'administration du module Servstat")?></th>
	</tr>
	<tr>
		<!--<td CLASS="ONGL" width="10px"> &nbsp;# </td>-->
		<td CLASS="ONGL" width="360px"> &nbsp;<?=servstat_translate("Nom Affiché")?> </td>
		<td CLASS="ONGL" width="120px"> &nbsp;<?=servstat_translate("Adresse")?> : <?=servstat_translate("Port")?> </td>
		<td CLASS="ONGL" width="100px"> &nbsp;<?=servstat_translate("Jeu")?> </td>
		<td CLASS="ONGL" width="80px"> &nbsp;<?=servstat_translate("URL des statistiques")?></td>
		<td CLASS="ONGL" width="20px" align="center"> &nbsp;<?=servstat_translate("Ordre")?> </td>
		<td CLASS="ONGL" width="20px" align="center"> &nbsp;<?=servstat_translate("Map")?> </td>
		<td CLASS="ONGL" width="20px" align="center"> &nbsp;<?=servstat_translate("Joueurs")?> </td>
		<td CLASS="ONGL" width="20px" align="center"> &nbsp;<?=servstat_translate("Raccourci")?> </td>
		<td CLASS="ONGL" width="100px">&nbsp;<?=servstat_translate("Commentaires")?> </td>
		<td CLASS="ONGL" width="50px">&nbsp;</td>
	</tr>
<?
	    //Affichage des lignes de chaque tableau
	    for ($index_ligne =0; $index_ligne<sizeof($liste_serv);$index_ligne++){
	        $rowcolor = tablos();
			//Cas d'une ligne d'un membre d'une équipe
			echo "\n\t<tr $rowcolor>".
	      		//"\n\t\t<td width=10px>&nbsp;".$liste_serv[$index_ligne]['serv_id']."<INPUT type=\"hidden\" name=\"adh_id\" value=\"".$liste_serv[$index_ligne]['serv_id']."\"></td>".
	            "\n\t\t<td width=360px>&nbsp;".$liste_serv[$index_ligne]['serv_nom']."<INPUT type=\"hidden\" name=\"adh_id\" value=\"".$liste_serv[$index_ligne]['serv_id']."\"></td>".
	            "\n\t\t<td width=120px>&nbsp;".$liste_serv[$index_ligne]['serv_adresse'].":".$liste_serv[$index_ligne]['serv_port']."</td>".
				"\n\t\t<td width=100px>&nbsp;".$liste_serv[$index_ligne]['serv_game_type']."</td>".
	            "\n\t\t<td width=80px>&nbsp;".$liste_serv[$index_ligne]['serv_url_stat']."</td>".
				"\n\t\t<td width=20px  align=\"center\">&nbsp;".($liste_serv[$index_ligne]['serv_etat']==0?servstat_translate("caché"):$liste_serv[$index_ligne]['serv_etat'])."</td>".
				"\n\t\t<td width=20px  align=\"center\">&nbsp;".($liste_serv[$index_ligne]['serv_show_img']==0?servstat_translate("caché"):servstat_translate("affiché"))."</td>".
				"\n\t\t<td width=20px  align=\"center\">&nbsp;".($liste_serv[$index_ligne]['serv_show_player']==0?servstat_translate("caché"):servstat_translate("affiché"))."</td>".
				"\n\t\t<td width=20px  align=\"center\">&nbsp;".($liste_serv[$index_ligne]['serv_show_quick']==0?servstat_translate("caché"):servstat_translate("affiché"))."</td>".
	            "\n\t\t<td width=100px>&nbsp;".substr($liste_serv[$index_ligne]['serv_comments'],0,18)."</td>".
	            "\n\t\t<td width=50px align=right>&nbsp;".
							"<a href=\"admin.php?op=Extend-Admin-SubModule&ModPath=servstat&ModStart=admin/admin_serv&choix=ModifServeur&no_serv=".$liste_serv[$index_ligne]['serv_id']."\" CLASS=\"NOIR\">".servstat_translate("Editer")."</a>".
							"&nbsp;|&nbsp;".
							"<a href=\"admin.php?op=Extend-Admin-SubModule&ModPath=servstat&ModStart=admin/admin_serv&choix=SupprServeur&no_serv=".$liste_serv[$index_ligne]['serv_id']."\" CLASS=\"ROUGE\">".servstat_translate("Supprimer")."</a>".
	            "\n\t\t</td>\n\t</tr>";
	    }
?>
</table>

<br><br>
<? 	echo $message_2nd_tab; ?>
<form name="serveur" method="post" action="<? echo $action ?>">
  <table width="360px" border="0" cellspacing="1" cellpadding="2" align="center">
    <tr CLASS="HEADER">
      <th colspan=2> <? echo  $entete ?> </th>
    </tr>
    <tr>
      <td> <?=servstat_translate("Nom Affiché")?> </td>
      	<td>
			<input type="hidden" name="serv_id" value="<? echo  $serveur['serv_id']?>">
            <input type="text" name="serv_nom" CLASS="TEXTBOX_STANDARD" value="<?=htmlspecialchars($serveur['serv_nom'])?>" size="43" maxlength="50">
		</td>
    </tr>
    <tr>
	    <td> <?=servstat_translate("Adresse")?> : <?=servstat_translate("Port")?></td>
	    <td>
	  		<input type="text" name="serv_adresse" CLASS="TEXTBOX_STANDARD" value="<?=$serveur['serv_adresse']?>" size="24" maxlength="50">
			:
			<input type="text" name="serv_port" CLASS="TEXTBOX_STANDARD" value="<?=$serveur['serv_port']?>" size="13" maxlength="6">
		</td>
    </tr>
    <tr>
    	<td> <?=servstat_translate("Jeu")?> </td>
    	<td valign="middle">
	        <select name="serv_game_type" CLASS="TEXTBOX_STANDARD">
				<?
					foreach($gametable as $key=>$value){
						echo "<OPTION ";
						if ($key==$serveur['serv_game_type']){
							echo "SELECTED ";
							//$enginetype=$value;
						}
						echo "VALUE=\"".$key."\">".$key."</OPTION>";
					}
				?>
		    </select>
		</td>
    </tr>
    <tr>
      <td> <?=servstat_translate("URL des statistiques")?> </td>
      <td>
      	<input type="text" name="serv_url_stat" CLASS="TEXTBOX_STANDARD" value="<?=htmlspecialchars($serveur['serv_url_stat'])?>" size="43" maxlength="50">
	  </td>
    </tr>
    <tr>
      <td> <?=servstat_translate("Etat/Ordre d'affichage")?> </td>
      <td valign="middle">
        <select name="serv_etat" CLASS="TEXTBOX_STANDARD">
            <option value="0" <? if ($serveur['serv_etat']==0){echo "selected";}?>><?=servstat_translate("Cacher")?></option>
            <option value="1" <? if ($serveur['serv_etat']==1){echo "selected";}?>>1</option>
			<option value="2" <? if ($serveur['serv_etat']==2){echo "selected";}?>>2</option>
			<option value="3" <? if ($serveur['serv_etat']==3){echo "selected";}?>>3</option>
			<option value="4" <? if ($serveur['serv_etat']==4){echo "selected";}?>>4</option>
			<option value="5" <? if ($serveur['serv_etat']==5){echo "selected";}?>>5</option>
			<option value="6" <? if ($serveur['serv_etat']==6){echo "selected";}?>>6</option>
			<option value="7" <? if ($serveur['serv_etat']==7){echo "selected";}?>>7</option>
			<option value="8" <? if ($serveur['serv_etat']==8){echo "selected";}?>>8</option>
	    </select>
		</td>
    </tr>
    <tr>
		<td> <?=servstat_translate("Image map")?> </td>
		<td  valign="middle">
			&nbsp; <?=servstat_translate("Afficher")?>
			<input type="radio" name="serv_show_img" value="1" <? if ($serveur['serv_show_img']==1){echo "checked";}?>>&nbsp;
			<?=servstat_translate("Cacher")?>
			<input type="radio" name="serv_show_img" value="0" <? if ($serveur['serv_show_img']==0){echo "checked";}?>>&nbsp;
		</td>
    </tr>
    <tr>
		<td> <?=servstat_translate("Nom map")?> </td>
		<td  valign="middle">
			&nbsp; <?=servstat_translate("Afficher")?>
			<input type="radio" name="serv_show_map" value="1" <? if ($serveur['serv_show_map']==1){echo "checked";}?>>&nbsp;
			<?=servstat_translate("Cacher")?>
			<input type="radio" name="serv_show_map" value="0" <? if ($serveur['serv_show_map']==0){echo "checked";}?>>&nbsp;
		</td>
    </tr>
    <tr>
      <td> <?=servstat_translate("Liste joueurs")?> </td>
      	<td  valign="middle">
			&nbsp; <?=servstat_translate("Afficher")?>
			<input type="radio" name="serv_show_player" value="1" <? if ($serveur['serv_show_player']==1){echo "checked";}?>>&nbsp;
			<?=servstat_translate("Cacher")?>
			<input type="radio" name="serv_show_player" value="0" <? if ($serveur['serv_show_player']==0){echo "checked";}?>>&nbsp;
		</td>
    </tr>
    <tr>
    <td> <?=servstat_translate("Raccourci")?> </td>
      	<td  valign="middle">
			&nbsp; <?=servstat_translate("Afficher")?>
			<input type="radio" name="serv_show_quick" onClick="javascript:document.getElementsByName('serv_quicklink')[0].disabled=false" value="1" <? if ($serveur['serv_show_quick']==1){echo "checked";}?>>&nbsp;
			<?=servstat_translate("Cacher")?>
			<input type="radio" name="serv_show_quick" onClick="javascript:document.getElementsByName('serv_quicklink')[0].disabled=true" value="0" <? if ($serveur['serv_show_quick']==0){echo "checked";}?>>&nbsp;
		</td>
    </tr>
    <tr>
      <td> &nbsp; </td>
      <td>
      	<input type="text" name="serv_quicklink" CLASS="TEXTBOX_STANDARD" value="<?=htmlspecialchars($serveur['serv_quicklink'])?>" size="43" maxlength="100">
	  </td>
    </tr>
    <tr>
      <td> <?=servstat_translate("Commentaires")?> </td>
      <td>
      	<Textarea name="serv_comments" CLASS="TEXTBOX_STANDARD" cols="40" rows="4" ><?=$serveur['serv_comments']?></Textarea>
      </td>
    </tr>
    <tr>
    	<td colspan=2 align="center">
      		<input type="submit" name="Validate" value="<?=$bouton_valider ?>" CLASS="BOUTON_STANDARD">&nbsp;
      		<input type="reset" name="Reset" value="<?=servstat_translate("Remise à zéro")?>" CLASS="BOUTON_STANDARD">&nbsp;
      		<? echo  $bouton_retour?>
   		</td>
    </tr>
  </table>
</form>
<?
closeTable();  
echo "\n<!-- Fin du code généré par le module Servstat  -->";  
}else{Access_Error();}
?>
