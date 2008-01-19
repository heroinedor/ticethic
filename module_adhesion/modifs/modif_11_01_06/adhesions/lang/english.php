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
       case "Groupe": $tmp = "Group"; break;
       case "Pseudo": $tmp = "Nick."; break;
	   case "Nom Prénom": $tmp = "Name Surname"; break;
	   case "Adresse Complète": $tmp = "Complete Address"; break;
	   case "Tel. Fixe": $tmp = "Phone Num."; break;
	   case "Tel. Port.": $tmp = "Cell Phone"; break;
	   case "Email": $tmp = "Email"; break;
	   case "Modification/validation d'un adhérent": $tmp = "Member modification/validation"; break;
	   case "Valider": $tmp = "Validate"; break;
	   case "Ajout d'un adhérent": $tmp = "Add new member"; break;
	   case "Ajouter": $tmp = "Add"; break;
	   case "Nom": $tmp = "Name"; break;
	   case "Prénom": $tmp = "Surname"; break;
	   case "Adresse": $tmp = "Address"; break;
	   case "Code Postal": $tmp = "Postal Code"; break;
	   case "Ville": $tmp = "Town"; break;
	   case "Pays": $tmp = "Country"; break;
	   case "Téléphone Fixe": $tmp = "Phone Number"; break;
	   case "Téléphone Portable": $tmp = "Cell Phone"; break;
	   case "Date de naissance": $tmp = "Birth Date"; break;
	   case "Sexe": $tmp = "Sex"; break;
	   case "Statut": $tmp = "Status"; break;
	   case "Validé": $tmp = "Approved"; break;
	   case "En attente": $tmp = "Waiting"; break;
	   case "Refusé": $tmp = "Refused"; break;
	   case "Remise à zéro": $tmp = "Reset"; break;
	   case "Adhérents": $tmp = "Members"; break;
	   case "Demandes en attentes de validation": $tmp = "Pending subscription requests"; break;
	   case "Demandes refusées": $tmp = "Refused resquests"; break;
	   case "Configuration du module adhésion": $tmp = "Adhesion addon configuration"; break;
	   case "Page de l'adhérent": $tmp = "Member page"; break;
	   case "Texte d'accueil du formulaire d'adhésion": $tmp = "Welcome text for the subscription form"; break;
	   case "Bloc adhésion": $tmp = "Adhesion block"; break;
	   case "Titre": $tmp = "Title"; break;
	   case "Contenu": $tmp = "Content"; break;
	   case "Paramètre de l'adhésion": $tmp = "Subscription parameters"; break;
	   case "Les cotisations se font sur une base annuelle.": $tmp = "Subscriptions are based on the civil year."; break;
	   case "Entrez ci-dessous l'année de la première session de cotisation": $tmp = "Please enter here above the year of the first subscription session"; break;
	   case "(format jj/mm/aaaa)": $tmp = "(format dd/mm/yyyy)"; break;
	   case "Entrez ci-dessous le nombre de sessions de cotisation à afficher dans le module adhésion": $tmp = "Please enter here above the number of sessions to be shown in the adhesion addon"; break;
	   case "Année": $tmp = "Year"; break;

       default: $tmp = "Translation error <b>[** $phrase **]</b>"; break;
    }
    return $tmp;
}
?>
