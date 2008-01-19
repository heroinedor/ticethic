-- phpMyAdmin SQL Dump
-- version 2.6.4-pl4-Debian-2
-- http://www.phpmyadmin.net
-- 
-- Serveur: sql-1.verygames.net
-- Généré le : Mercredi 11 Janvier 2006 à 20:34
-- Version du serveur: 4.1.15
-- Version de PHP: 4.4.0-4
-- 
-- Base de données: `server60`
-- 

-- --------------------------------------------------------

-- 
-- Structure de la table `adhesion_cotisations`
-- 

CREATE TABLE "adhesion_cotisations" (
  "cot_id" int(11) unsigned NOT NULL auto_increment,
  "cot_adh_id" int(30) NOT NULL default '0',
  "cot_montant" float default NULL,
  "cot_date" date default NULL,
  "cot_session" int(11) unsigned default NULL,
  "cot_type" int(10) unsigned default NULL,
  "cot_comments" varchar(100) default NULL,
  "cot_reference" varchar(20) default NULL,
  PRIMARY KEY  ("cot_id")
);

-- 
-- Contenu de la table `adhesion_cotisations`
-- 

INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (6, 30, 50, '2004-12-10', 1, 1, 'Mandat international à Fabien Spengler --> Dépot espèce', '04 3072089 G');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (7, 43, 80, '2004-10-29', 1, 1, '', '3813176');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (8, 45, 80, '2004-10-17', 1, 1, '', '6204741');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (13, 44, 45, '2004-12-02', 1, 1, 'Chèque1 : 04 4652016 F\r\n\r\n', '04 4652016 F');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (35, 44, 45, '2004-12-02', 1, 1, 'Chèque2 : 04 4652017 F', '04 4652017 F');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (10, 13, 65, '2004-11-08', 1, 1, '', '0000281');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (21, 7, 55, '2004-11-19', 1, 1, '', '9594656');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (14, 12, 75, '2004-10-11', 1, 1, '', '6573158');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (15, 18, 54.2, '2004-12-06', 1, 1, '', '6573158');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (16, 31, 54.2, '2004-12-07', 1, 1, '', '7463992');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (17, 37, 54.2, '2004-12-06', 1, 1, '', '04 4429020 B');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (18, 40, 54.2, '2004-12-15', 1, 1, '', '2409516');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (19, 87, 54.2, '2004-12-15', 1, 1, '', '2409516');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (20, 2, 100, '2004-11-26', 1, 1, '', '04 4633004 F');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (22, 53, 55, '2004-11-07', 1, 1, 'Chèque de 110€ - Bénéficiaires : D3lta et FonzD', '0188782');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (23, 9, 55, '2004-11-07', 1, 1, 'Chèque de 110€ - Bénéficiaires : D3lta et FonzD', '0188782');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (24, 3, 60, '2004-11-07', 1, 3, 'Versés à Klochette', '');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (25, 8, 25, '2004-12-12', 1, 1, '', '02 2677011 B');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (26, 41, 54.2, '2004-12-07', 1, 1, '', '7463992');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (27, 38, 54.2, '2004-12-22', 1, 2, 'Herrero pour Cassosiation', '');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (28, 48, 50, '2005-01-03', 1, 2, 'Nancy Daumas - Cotisation P4nther', '');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (31, 42, 54.2, '2004-12-14', 1, 1, '', '0000067');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (32, 81, 65, '2004-12-08', 1, 1, '', '0198364');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (33, 19, 30, '2004-12-30', 1, 1, '', '2361831');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (34, 47, 35, '2004-12-30', 1, 1, '', '0000031');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (53, 60, 50, '2005-01-31', 1, 1, 'FreePlayer', '0000001');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (54, 63, 50, '2005-02-16', 1, 2, 'BERNARD  COTISATION', '');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (39, 85, 54.2, '2004-12-15', 1, 1, '', '2409516');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (40, 56, 80, '2005-01-02', 1, 1, '', '2127485');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (41, 46, 80, '2004-12-21', 1, 1, '', '1022763');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (44, 16, 25, '2005-01-11', 1, 3, '', '');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (45, 21, 65, '2004-01-17', 1, 1, 'Chèque de 130€ - Bénéficiaires : Campbell et Latex', '8993891');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (46, 39, 65, '2005-01-17', 1, 1, 'Chèque de 130€ - Bénéficiaires : Campbell et Latex', '8993891');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (47, 12, 30, '2005-01-25', 1, 2, 'Virement de 165€ au total - Bénéficiaire : Nicux 65€ - Luther 40€ - ZIM 30€ - Durex 30€', '');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (48, 51, 80, '2005-01-25', 1, 2, 'MR OUGAB FATHI COTISATION ALG', 'Cotisation Alg');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (49, 14, 65, '2005-01-25', 1, 2, 'Virement de 165€ au total - Bénéficiaire : Nicux 65€ - Luther 40€ - ZIM 30€ - Durex 30€', '');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (50, 59, 25, '2005-01-28', 1, 1, 'Chèque de 80€ de Mr Carry - Bénéficiaire :  Lilo (15€) ---> Attend complément de 10€ par Slapinou', '');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (51, 65, 65, '2005-01-28', 1, 1, 'Chèque de 80€ de Mr Carry - Bénéficiaire : KlocheTTe (65 €)', '0109869');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (52, 17, 65.7, '2005-02-08', 1, 1, '3 chèques précédents non-signés, non-encaissés, détruits (0000087, 0000088, 0000089)', '0470005');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (55, 70, 70, '2005-02-14', 1, 1, 'Chèque commun avec Aline', '5546713');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (56, 98, 55, '2005-02-19', 1, 1, '', '5446557');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (57, 69, 45, '2005-02-26', 1, 2, 'ROBIN THOMAS COTISE ELI BLACK', '');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (58, 3, 30, '2005-02-26', 1, 2, 'Cotis. compl. slap', '');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (59, 124, 70, '2005-02-27', 1, 1, 'Chèque commun avec Noir', '5546713');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (60, 11, 50, '2005-03-03', 1, 2, 'VIREMENT LIM FRA', '');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (61, 25, 150, '2005-03-03', 1, 2, 'DON POUR CASSOSIATION BY KUDOS - 300€ en tout', '');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (62, 4, 150, '2005-03-03', 1, 2, 'DON POUR CASSOSIATION BY KUDOS - 300€ en tout', '');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (64, 86, 80, '2005-03-04', 1, 1, 'date = date de dépôt', '8173306');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (65, 115, 80, '2005-03-04', 1, 1, 'date = date de dépôt\r\n', '04 4632013 B');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (66, 139, 55, '2005-03-04', 1, 1, 'date = date de dépôt du chèque', '4741007');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (67, 137, 65, '2005-03-04', 1, 1, 'date = date de dépôt du chèque', '0000227');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (68, 73, 40, '2005-01-04', 1, 1, '', '02 2596014 B');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (69, 7, 30, '2005-04-08', 1, 2, 'Compl. Cotis. Gpx', '');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (70, 16, 20, '2005-04-09', 1, 2, 'Compl. Cotis. Barbu', '');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (71, 65, 30, '2005-04-13', 1, 3, ' Compl. Cotis.KlocheTTe', '');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (72, 151, 70, '2005-03-16', 1, 1, '', '04 4631015 E');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (73, 69, 25, '2005-03-12', 1, 2, 'Compl. Cot. Black', '');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (74, 159, 40, '2005-05-02', 1, 2, 'Virement de 165€ au total - Bénéficiaire : Nicux 65€ - Luther 40€ - ZIM 30€ - Durex 30€', '');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (75, 53, 50, '2005-04-29', 1, 2, 'Compl. Cotis. D3lt@', '');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (76, 162, 25, '2005-05-18', 1, 1, '', '');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (77, 141, 30, '2005-01-25', 1, 2, 'Virement de 165€ au total - Bénéficiaire : Nicux 65€ - Luther 40€ - ZIM 30€ - Durex 30€', '');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (78, 169, 25, '2005-06-06', 1, 1, '<br>Il faut rentrer le n° de chèque</b>', '');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (79, 158, 25, '2005-06-02', 1, 1, '', '8072484');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (80, 28, 54, '2005-06-09', 1, 2, 'YOLDAS CICEK - COTISATION ELI KOALA', '');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (81, 202, 25, '2005-08-01', 1, 2, 'Virement de 50€ de sébastien Montadre - Bénéficiaires : Doggpound + Shoulders', '');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (82, 189, 25, '2005-09-29', 1, 2, 'M. PETRE AMAURY<br>\r\nCOTISATION FUNXP METALMAGIC', '');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (83, 223, 25, '2005-10-01', 1, 1, 'METTRE LE N° DE CHEQUE', '');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (84, 230, 25, '2005-10-11', 1, 2, 'M CHRISTOPHE GUILLARD', '');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (91, 69, 40, '2005-11-25', 2, 2, 'ROBIN THOMAS\r\nCOTISATION ELI BLACK', '');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (93, 3, 50, '2005-12-03', 2, 2, 'Cotisation 2006 Slapinou', '');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (94, 71, 50, '2005-11-24', 2, 1, 'Dépôt le 20/12/2005', '7039106');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (95, 32, 50, '2005-11-22', 2, 1, 'Dépôt le 20/12/2005', '2143685');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (96, 7, 30, '2005-12-07', 2, 2, 'LEAUTE ROMAIN\r\nCOTIS 2006', '');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (97, 137, 36, '2005-12-09', 2, 2, 'COTISATION ELI - SKELET', '');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (98, 141, 40, '2005-12-07', 2, 1, 'Dépôt le 20/12/2005', '7186427');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (100, 98, 36, '2005-12-13', 2, 1, 'Dépôt le 20/12/2005', '5446583');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (99, 47, 20, '2005-12-07', 2, 1, 'Dépôt le 20/12/2005', '0000068');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (101, 139, 36, '2005-12-04', 2, 1, 'Dépôt le 20/12/2005', '4741024');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (102, 28, 36, '2005-12-12', 2, 1, 'Dépôt le 20/12/2005', '0000064');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (103, 53, 50, '2005-12-18', 2, 2, 'COTISATION KSOS DELTA', '');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (104, 210, 36, '2005-12-05', 2, 1, 'Dépôt le 20/12/2005', '3641023');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (105, 69, 80, '2005-12-20', 2, 2, '', 'Cotise');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (106, 38, 40, '2005-12-21', 2, 2, 'PAIEMENT DE RICKII', '');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (107, 73, 30, '2005-12-18', 2, 1, 'Dépôt le 23/12/2005', '0025893');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (108, 8, 30, '2005-12-19', 2, 1, 'Dépôt le 23/12/2005', '2677016');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (109, 63, 43.75, '2005-12-18', 2, 1, 'Dépôt le 23/12/2005', '9791849');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (110, 70, 36, '2005-12-18', 2, 1, 'Dépôt le 23/12/2005', '5546729');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (111, 223, 43.75, '2005-12-19', 2, 1, 'Dépôt le 23/12/2005', '9307173');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (112, 65, 50, '2005-12-20', 2, 1, 'Dépôt le 20/12/2005', '-');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (113, 12, 40, '2006-01-04', 2, 2, 'COTISATION FUNXP JCEX', '');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (114, 40, 50, '2005-12-21', 2, 1, 'Dépôt le 05/01/2006', '2409776');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (115, 87, 50, '2005-12-24', 2, 1, 'Dépôt le 05/01/2006\r\n(chèque #6457593 150€ pour hUm, Olmo, Ben)', '6457593');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (116, 30, 50, '2005-12-24', 2, 1, 'Dépôt le 05/01/2006\r\n(chèque #6457593 150€ pour hUm, Olmo, Ben)', '6457593');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (117, 85, 50, '2005-12-24', 2, 1, 'Dépôt le 05/01/2006\r\n(chèque #6457593 150€ pour hUm, Olmo, Ben)', '6457593');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (118, 158, 43.75, '2005-12-20', 2, 1, 'Dépôt le 05/01/2006', '8072513');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (119, 204, 50, '2005-12-30', 2, 1, 'Dépôt le 05/01/2006', '5438223');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (120, 282, 50, '2005-12-30', 2, 1, 'Dépôt le 05/01/2006', '5365568');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (121, 286, 50, '2005-12-28', 2, 1, 'Dépôt le 05/01/2006', '9968101');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (122, 37, 50, '2006-01-03', 2, 1, 'Dépôt le 05/01/2006', '5726003');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (123, 21, 36, '2006-01-02', 2, 1, 'Dépôt le 05/01/2006', '5102169');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (124, 45, 43.75, '2005-12-28', 2, 1, 'Dépôt le 05/01/2006', '8479868');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (125, 277, 50, '2006-01-05', 2, 2, 'GENDRE JULIEN\r\nCOTISAT', '');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (126, 25, 40, '2005-01-07', 2, 2, 'LAVAUX - INTERNET- LAVAUX FRANCOIS<br>\r\n80€ en tout => Zany + Kudos', '');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (127, 4, 40, '2005-01-07', 2, 2, 'LAVAUX - INTERNET- LAVAUX FRANCOIS<br>\r\n80€ en tout => Zany + Kudos', '');
INSERT INTO `adhesion_cotisations` (`cot_id`, `cot_adh_id`, `cot_montant`, `cot_date`, `cot_session`, `cot_type`, `cot_comments`, `cot_reference`) VALUES (128, 297, 36, '0000-00-00', 2, 1, 'Dépôt le 05/01/2006', '');
