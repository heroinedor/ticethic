-- !!! faire attention aux valeurs qui sont en 'auto-incrément' dans SQL
-- !!! Bien mettre à jour la liste des groupes adhérents sur TOUTES LES SESSIONS avant de migrer les données
-- 




-- 
-- Données pour `adhesion_paiement`
-- 
INSERT INTO `adhesion_paiement` 
	   ( `pai_id`, 
	   `pai_montant`, 
	   `pai_date`, 
	   `pai_comments`, 
	   `pai_reference`, 
	   `pai_type` )
SELECT distinct
	`cot_id`,  
	`cot_montant`, 
	`cot_date`, 
	`cot_comments`, 
	`cot_reference`,
	`cot_type`
FROM `adhesion_cotisations`;


-- 
-- Données pour `adhesion_adherent`
-- 
INSERT INTO `adhesion_adherent` (
`adh_id` ,
`adh_nom` ,
`adh_prenom` ,
`adh_adresse` ,
`adh_code_postal` ,
`adh_ville` ,
`adh_pays` ,
`adh_sexe` ,
`adh_email` ,
`adh_pseudo` ,
`adh_date_naissance` ,
`adh_telephone_fixe` ,
`adh_telephone_portable`
)
SELECT `adh_id` , 
	   `adh_nom` , 
	   `adh_prenom` , 
	   `adh_adresse` , 
	   `adh_code_postal` , 
	   `adh_ville` , 
	   `adh_pays` , 
	   `adh_sexe` , 
	   `adh_email` , 
	   `adh_pseudo` , 
	   `adh_date_naissance` , 
	   `adh_telephone_fixe` , 
	   `adh_telephone_portable`
FROM `adhesion_adherents`;


-- 
-- Données pour `adhesion_cotisation`
-- 	
INSERT INTO `adhesion_cotisation` (
	`adh_id`, 
	`ses_id`, 
	`gr_id`, 
	`pai_id`, 
	`cot_adh_statut`, 
	`cot_adh_gerant`
)
SELECT 	  aa.`adh_id`,
	  ac.`cot_session`, 
	  aa.`adh_equipe`,
	  ac.`cot_id`,
	  aa.`adh_statut`,
	  0
FROM `adhesion_cotisations` ac, `adhesion_adherents` aa
WHERE aa.`adh_id` = ac.`cot_adh_id`;


-- 
-- Données pour `adhesion_groupe`
-- 
INSERT INTO `adhesion_groupe` (
	`gr_id`, 
	`gr_name`, 
	`gr_description`, 
	`gr_web`, 
	`gr_irc`
)
SELECT 
	`groupe_id`, 
	`groupe_name`, 
	`groupe_description`,
	'',
	''
FROM `groupes` 
WHERE `groupe_id` in(SELECT `valeur`
			FROM `adhesion_config_tab`
			WHERE `parametre` LIKE 'cfg_groupe%')

-- 
-- Mise à jour de la table de adhesion_config_tab
-- 
-- DELETE FROM `adhesion_config_tab` WHERE `parametre` LIKE 'cfg_groupe%';