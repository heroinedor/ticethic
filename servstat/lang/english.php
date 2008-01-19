<?
/************************************************************************/
/* NPDS V : Net Portal Dynamic System                                   */
/* ===========================                                          */
/*                                                                      */
/* IPBAN Language File Copyright (c) 2002 by Philippe Brunier           */
/*                                                                      */
/************************************************************************/

function servstat_translate($phrase) {
    switch ($phrase) {
       case "Version 2.0 basée sur": $tmp = "Version 2.0 based on"; break;
       case "Adresse": $tmp = "Address"; break;
       case "Port": $tmp = "Port"; break;
       case "Jeu": $tmp = "Game"; break;
       case "Nos Serveurs": $tmp = "Our Servers"; break;
       case "IP/URL": $tmp = "IP/URL"; break;
       case "URL Statistiques": $tmp = "Stats URL"; break;
       case "Impossible de parcourir l'objet sérialisé": $tmp = "Could not fetch the serialized object"; break;
       case "Map": $tmp = "Map"; break;
	   case "Joueurs": $tmp = "Players"; break;
	   case "Serveur plein": $tmp = "Server full"; break;
	   case "Serveur vide": $tmp = "Empty Server"; break;
	   case "PunkBuster": $tmp = "PunkBuster"; break;
	   case "Serveur privé (mot de passe)": $tmp = "Private Server (password required)"; break;
	   case "Serveur publique": $tmp = "Public Server"; break;
	   case "Mode publique/privé inconnu": $tmp = "Public/private mode unknown"; break;
	   case "Version": $tmp = "Version"; break;
	   case "Type de jeu": $tmp = "Game Type"; break;
	   case "Nom Admin": $tmp = "Admin Name"; break;
	   case "Email Admin": $tmp = "Admin Email"; break;
	   case "ICQ Admin": $tmp = "Admin ICQ"; break;
	   case "Site Web": $tmp = "Website"; break;
	   case "Localisation serveur": $tmp = "Server Location"; break;
	   case "Canal IRC": $tmp = "IRC Channel"; break;
	   case "CPU": $tmp = "CPU"; break;
	   case "Connexion": $tmp = "Connection"; break;
	   case "Dernier redémarrage": $tmp = "Last Boot"; break;
	   case "Version jeu": $tmp = "Game version"; break;
	   case "Plugin": $tmp = "Motto"; break;
	   case "Informations sur les joueurs": $tmp = "Players details"; break;
	   case "Pseudo": $tmp = "Nickname"; break;
	   case "Score": $tmp = "Score"; break;
	   case "Buts": $tmp = "Goals"; break;
	   case "Leader": $tmp = "Leader"; break;
	   case "Ennemi": $tmp = "Enemy"; break;
	   case "KIA": $tmp = "KIA"; break;
	   case "ROE": $tmp = "ROE"; break;
	   case "Ping": $tmp = "Ping"; break;
	   case "Tués": $tmp = "Kills"; break;
	   case "Morts": $tmp = "Deaths"; break;
	   case "Skill": $tmp = "Skill"; break;
	   case "Temps de jeu": $tmp = "Played time"; break;
	   case "Aucun joueur actuellement": $tmp = "No player at the moment"; break;
	   case "Score total": $tmp = "Total score"; break;
	   case "Spectateurs": $tmp = "Spectators"; break;
	   case "Aucun actuellement": $tmp = "None at the moment"; break;
	   case "Aucun paramètre fourni": $tmp = "No parameters given"; break;
	   case "Serveur n°": $tmp = "Server #"; break;
	   case "Erreur sur serveur n°": $tmp = "Error on server #"; break;
	   case "adresse nulle": $tmp = "null address"; break;
	   case "port nul": $tmp = "null port"; break;
	   case "protocole nul": $tmp = "null"; break;
	   case "Cliquez pour avoir le détail du serveur": $tmp = "Clik here to get server detail"; break;
	   case "Nom Affiché": $tmp = "Name on screen"; break;
	   case "URL des statistiques": $tmp = "Statistics Webpage"; break;
	   case "Ordre": $tmp = "Order"; break;
	   case "Commentaires": $tmp = "Comments"; break;
	   case "Console d'administration du module Servstat": $tmp = "Servstat module administration page"; break;
	   case "Etat/Ordre d'affichage": $tmp = "Status/Order on screen"; break;
	   case "Image map": $tmp = "Map image"; break;
	   case "Nom map": $tmp = "Map name"; break;
	   case "Liste joueurs": $tmp = "Players list"; break;
	   case "Cacher": $tmp = "Hide"; break;
	   case "Afficher": $tmp = "Show"; break;
	   case "Impossible d'exécuter la requête de listage des serveurs": $tmp = "Impossible to execute servers list query"; break;
	   case "serveur ajouté": $tmp = "server added"; break;
	   case "Une erreur s'est produite lors de l'ajout des données du serveurs": $tmp = "An error occured while adding server's data"; break;
	   case "Erreur SQL": $tmp = "SQL error"; break;
	   case "Modification d'un serveur": $tmp = "Server modification"; break;
	   case "Valider": $tmp = "Validate"; break;
	   case "Retour": $tmp = "Return"; break;
	   case "Valider": $tmp = "Validate"; break;
	   case "Ajouter": $tmp = "Add"; break;
	   case "Editer": $tmp = "Edit"; break;
	   case "Supprimer": $tmp = "Suppress"; break;
	   case "Une erreur s'est produite lors de la modification des données du serveur": $tmp = "An error occured while modifying server's data"; break;
	   case "serveur modifié": $tmp = "server modified"; break;
	   case "serveur supprimé": $tmp = "server suppressed"; break;
	   case "Une erreur s'est produite lors de la suppression d'un serveur": $tmp = "An error occured while suppressing server's data"; break;
	   case "Ajout d'un serveur": $tmp = "Add a server"; break;
	   case "Remise à zéro": $tmp = "Reset"; break;
	   case "caché": $tmp = "hidden"; break;
	   case "affiché": $tmp = "shown"; break;
	   case "Raccourci": $tmp = "Quicklink"; break;
	   case "se connecter": $tmp = "play now!"; break;
	   case "Impossible d'instancier la classe gsQuery. Le protocole spécifié existe-t-il?": $tmp = "Could not instantiate gsQuery class. Does the protocol you've specified exist?"; break;
	   case "Erreur": $tmp = "Error"; break;
       default: $tmp = "Translation error <b>[** $phrase **]</b>"; break;
    }
    return $tmp;
}
?>
