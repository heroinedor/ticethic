-- phpMyAdmin SQL Dump
-- version 2.6.4-pl4-Debian-2
-- http://www.phpmyadmin.net
-- 
-- Serveur: sql-1.verygames.net
-- Généré le : Mercredi 11 Janvier 2006 à 21:16
-- Version du serveur: 4.1.15
-- Version de PHP: 4.4.0-4
-- 
-- Base de données: `server60`
-- 

-- --------------------------------------------------------

-- 
-- Structure de la table `groupes`
-- 

CREATE TABLE "groupes" (
  "groupe_id" int(3) default NULL,
  "groupe_name" varchar(30) NOT NULL default '',
  "groupe_description" varchar(255) NOT NULL default '',
  UNIQUE KEY "groupe_id" ("groupe_id")
);

-- 
-- Contenu de la table `groupes`
-- 

INSERT INTO `groupes` (`groupe_id`, `groupe_name`, `groupe_description`) VALUES (2, 'Cassosiation', 'Membres de la Cassosiation');
INSERT INTO `groupes` (`groupe_id`, `groupe_name`, `groupe_description`) VALUES (3, '=KSOS=', 'Clan KSOS');
INSERT INTO `groupes` (`groupe_id`, `groupe_name`, `groupe_description`) VALUES (4, '=BdX=', 'Clan Brutal de luXe');
INSERT INTO `groupes` (`groupe_id`, `groupe_name`, `groupe_description`) VALUES (5, '[Cul Mouton]', 'Clan CulMouton');
INSERT INTO `groupes` (`groupe_id`, `groupe_name`, `groupe_description`) VALUES (6, 'FRATELLO', 'Clan FRATELLO');
INSERT INTO `groupes` (`groupe_id`, `groupe_name`, `groupe_description`) VALUES (7, 'Freeplayers', 'Membres de la Cassosiation, catégorie Freeplayer');
INSERT INTO `groupes` (`groupe_id`, `groupe_name`, `groupe_description`) VALUES (9, 'K4mizol', 'Clan K4mizol');
INSERT INTO `groupes` (`groupe_id`, `groupe_name`, `groupe_description`) VALUES (10, 'Newsers', 'Administrateur de news');
INSERT INTO `groupes` (`groupe_id`, `groupe_name`, `groupe_description`) VALUES (11, '-=[EKT]=-', 'Clan EKT');
INSERT INTO `groupes` (`groupe_id`, `groupe_name`, `groupe_description`) VALUES (12, 'Conseil d''administration', 'Tous les membres du CA');
INSERT INTO `groupes` (`groupe_id`, `groupe_name`, `groupe_description`) VALUES (13, '=SIM=', 'les =SIM=');
INSERT INTO `groupes` (`groupe_id`, `groupe_name`, `groupe_description`) VALUES (14, '[ELI]', 'Membre du clan [ELI]');
INSERT INTO `groupes` (`groupe_id`, `groupe_name`, `groupe_description`) VALUES (15, 'FQP', 'Team des Fromages Qui Puent');
INSERT INTO `groupes` (`groupe_id`, `groupe_name`, `groupe_description`) VALUES (16, 'CHE', 'Team des Chevaliers');
INSERT INTO `groupes` (`groupe_id`, `groupe_name`, `groupe_description`) VALUES (17, 'FunXp DOD', 'Membres de la team FunXp Day Of Defeat');
