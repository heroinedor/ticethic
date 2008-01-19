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
/* Adhesion English Language File											                      */
/**************************************************************************************************/

function adhesion_translate($phrase) {
    switch ($phrase) {
       case "Gestion des adhérents": $tmp = "Members management"; break;
       case "Gestion des cotisations": $tmp = "Subscriptions management"; break;
       case "Gestion des groupes": $tmp = "Groups management"; break;
       case "Configuration du module": $tmp = "Addon configuration"; break;
       case "Liste des IP bannies": $tmp = "Bannished @IP"; break;
       case "Liste des DNS bannis": $tmp = "Bannished DNS"; break;

       default: $tmp = "Translation error <b>[** $phrase **]</b>"; break;
    }
    return $tmp;
}
?>
