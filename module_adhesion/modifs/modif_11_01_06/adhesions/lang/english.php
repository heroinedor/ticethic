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
/* Adhesion English Language File											                      */
/**************************************************************************************************/

function adhesion_translate($phrase) {
    switch ($phrase) {
       case "Gestion des adh�rents": $tmp = "Members management"; break;
       case "Gestion des cotisations": $tmp = "Subscriptions management"; break;
       case "Gestion des groupes": $tmp = "Groups management"; break;
       case "Configuration du module": $tmp = "Addon configuration"; break;
       case "Groupe": $tmp = "Group"; break;
       case "Pseudo": $tmp = "Nick."; break;
	   case "Nom Pr�nom": $tmp = "Name Surname"; break;
	   case "Adresse Compl�te": $tmp = "Complete Address"; break;
	   case "Tel. Fixe": $tmp = "Phone Num."; break;
	   case "Tel. Port.": $tmp = "Cell Phone"; break;
	   case "Email": $tmp = "Email"; break;
	   case "Modification/validation d'un adh�rent": $tmp = "Member modification/validation"; break;
	   case "Valider": $tmp = "Validate"; break;
	   case "Ajout d'un adh�rent": $tmp = "Add new member"; break;
	   case "Ajouter": $tmp = "Add"; break;
	   case "Nom": $tmp = "Name"; break;
	   case "Pr�nom": $tmp = "Surname"; break;
	   case "Adresse": $tmp = "Address"; break;
	   case "Code Postal": $tmp = "Postal Code"; break;
	   case "Ville": $tmp = "Town"; break;
	   case "Pays": $tmp = "Country"; break;
	   case "T�l�phone Fixe": $tmp = "Phone Number"; break;
	   case "T�l�phone Portable": $tmp = "Cell Phone"; break;
	   case "Date de naissance": $tmp = "Birth Date"; break;
	   case "Sexe": $tmp = "Sex"; break;
	   case "Statut": $tmp = "Status"; break;
	   case "Valid�": $tmp = "Approved"; break;
	   case "En attente": $tmp = "Waiting"; break;
	   case "Refus�": $tmp = "Refused"; break;
	   case "Remise � z�ro": $tmp = "Reset"; break;
	   case "Adh�rents": $tmp = "Members"; break;
	   case "Demandes en attentes de validation": $tmp = "Pending subscription requests"; break;
	   case "Demandes refus�es": $tmp = "Refused resquests"; break;
	   case "Configuration du module adh�sion": $tmp = "Adhesion addon configuration"; break;
	   case "Page de l'adh�rent": $tmp = "Member page"; break;
	   case "Texte d'accueil du formulaire d'adh�sion": $tmp = "Welcome text for the subscription form"; break;
	   case "Bloc adh�sion": $tmp = "Adhesion block"; break;
	   case "Titre": $tmp = "Title"; break;
	   case "Contenu": $tmp = "Content"; break;
	   case "Param�tre de l'adh�sion": $tmp = "Subscription parameters"; break;
	   case "Les cotisations se font sur une base annuelle.": $tmp = "Subscriptions are based on the civil year."; break;
	   case "Entrez ci-dessous l'ann�e de la premi�re session de cotisation": $tmp = "Please enter here above the year of the first subscription session"; break;
	   case "(format jj/mm/aaaa)": $tmp = "(format dd/mm/yyyy)"; break;
	   case "Entrez ci-dessous le nombre de sessions de cotisation � afficher dans le module adh�sion": $tmp = "Please enter here above the number of sessions to be shown in the adhesion addon"; break;
	   case "Ann�e": $tmp = "Year"; break;

       default: $tmp = "Translation error <b>[** $phrase **]</b>"; break;
    }
    return $tmp;
}
?>
