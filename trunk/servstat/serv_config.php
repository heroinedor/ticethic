<?
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
/* Page de configuration du module									                              */
/**************************************************************************************************/

	

	/*******************************************************
	*   Chemin relatif de servstat par rapport au nom de domaine
	*   Exemple : si votre site s'appelle :
	*       - http://www.monsite.org 		alors $path_to_index = "/";
	*       - http://www.monsite.org/npds   alors $path_to_index = "/npds/";
	*   ATTENTION : dans certains cas il peut �tre n�cessaire de
	*   rajouter ou d'enlever le "/" au d�but de $path_to_index.
	*   A tester pour trouver la bonne configuration
	*******************************************************/
	//$path_to_index = "npds/";			//config Web
	$path_to_index = "/";			//config maison


	//########### NE RIEN EDITER SOUS CETTE LIMITE ############//
	//Nom du r�pertoire du module
    $rep_module = "servstat";
	//Chemin d'acc�s au fichie index.php
	$root_path = $_SERVER["DOCUMENT_ROOT"].$path_to_index;
	//Chemin d'acc�s au module
	$serv_path = $root_path."modules/".$rep_module."/";
	//Chemin d'acc�s aux librairies du module
	$serv_lib_path = $serv_path."lib/";
	//Chemin d'acc�s aux images du module
	$serv_img_path = $serv_path."images/";
	//Chemin d'acc�s aux traductions du module
	$serv_lang_path = $serv_path."lang/";
	//config particuli�re utilisant la librairie du site SQuery
	$queryfromurl=FALSE;
	//################## FIN CONFIGURATION ###################//

?>
