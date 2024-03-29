-- phpMyAdmin SQL Dump
-- version 2.6.1
-- http://www.phpmyadmin.net
-- 
-- Serveur: localhost
-- Généré le : Jeudi 12 Janvier 2006 à 00:51
-- Version du serveur: 4.1.9
-- Version de PHP: 4.3.10
-- 
-- Base de données: `server60`
-- 

-- --------------------------------------------------------

-- 
-- Structure de la table `adhesion_adherent`
-- 

CREATE TABLE "adhesion_adherent" (
  "adh_id" int(11) NOT NULL default '0',
  "adh_nom" varchar(40) default NULL,
  "adh_prenom" varchar(30) default NULL,
  "adh_adresse" varchar(100) default NULL,
  "adh_code_postal" varchar(10) default NULL,
  "adh_ville" varchar(30) default NULL,
  "adh_pays" varchar(20) default NULL,
  "adh_sexe" char(1) default NULL,
  "adh_email" varchar(100) default NULL,
  "adh_pseudo" varchar(30) default NULL,
  "adh_date_naissance" date default NULL,
  "adh_telephone_fixe" varchar(14) default NULL,
  "adh_telephone_portable" varchar(14) default NULL,
  PRIMARY KEY  ("adh_id")
);

-- 
-- Contenu de la table `adhesion_adherent`
-- 

INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (2, 'Dorso', 'Erwan', '46 bis rue Jacques Provost', '31200', 'toulouse', 'france', 'H', 'heroined@mageos.com', 'karamazov', '1975-10-26', '0534309159', '0663875230');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (65, 'Spengler', 'Fabien', '53 rue planchat', '75020', 'Paris', 'France', 'H', 'fab.mail@laposte.fr', 'KlocheTTe', '1975-03-13', '0870370535', '0622230535');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (3, 'Montadre', 'Sébastien', '43 rue Ernest Renan', '92190', 'Meudon', 'France', 'H', 'slapinou@gmail.com', 'Slapinou', '1979-10-03', '0145078609', '0684476845');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (59, 'Carry', 'Lionel', '6 bis rue Robert Julien', '92190', 'Meudon', 'France', 'H', 'coeurdelio@hotmail.com', 'Lilo', '1980-05-09', '0145346087', '0660233488');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (7, 'LEAUTE', 'Sébastien', '202 rue Hector Berlioz', '41100', 'Vendome', 'France', 'H', 'macleote@msn.com', 'GPX', '1976-11-21', '0254731326', '0611178984');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (45, 'DEBOVE', 'Florent', '10 rue Mulet', '38460', 'CREMIEU', 'FRANCE', 'H', 'korozif@ekt.fr.st', 'KoRoZiF', '1969-09-21', '0437061162', '0665005120');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (13, 'GRIFFOULIERE', 'Guillaume', '20 rue du Saget', '74100', 'Annemasse', 'France', 'H', 'coredumped@culmouton.com', 'Core Dumped', '1979-03-02', '0450375293', '0612337039');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (14, 'Desneux', 'Nicolas', 'Indianapolis', 'c''est usa.', 'Indianapolis/Tours', 'USA', 'H', 'nicux@msn.com', 'Nicux', '1975-01-19', 'nothing', 'nothing');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (44, 'Moerman', 'Alain', '45 rue neuve', '44320', 'st pere en retz', 'France', 'F', 'inscription.lettre@wanadoo.fr', 'ZuuR', '1971-02-25', '', '');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (12, 'Lenoir', 'Jean-Christophe', '125, rue Goerge Sand', '37000', 'Tours', 'France', 'H', 'jcex@culmouton.com', 'JCex', '1978-05-03', '0234381121', '0664320503');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (21, 'Dumont', 'Philippe', '8, rue de la Paix', '63910', 'Vertaizon', 'France', 'H', 'campbell@culmouton.com', 'Campbell', '1981-05-12', '', '0662520439');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (19, 'LETOURNEL', 'Julien', '2 bd Jean Bouin', '77370', 'NANGIS', 'France', 'H', 'makaveli@24kra.net', 'makaveLi', '1985-02-17', '0164081220', '0683203519');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (30, 'Morel', 'Aurélien', 'Rue du Midi 17b', '1400', 'Yverdon', 'Suisse', '', 'aurelien.morel@freesurf.ch', 'Olmolism', '1980-09-15', '', '');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (31, 'Cabrelli', 'Clément', '82 rue des roissys', '92320', 'chatillon', 'france', 'H', 'skax@brutalrush.com', 'SkaX', '1981-03-07', '0158882899', '0622088871');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (18, 'Taleb', 'Kamel', '3 allée du languedoc', '95310', 'Saint ouen l''aumône', 'France', 'H', 'tounsi007@msn.com', 'Onkyo', '1978-09-16', '0134300653', '');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (37, 'Louison-François', 'Mickaël', '72 rue Bernard Palissy', '37000', 'TOURS', 'France', 'H', 'its.m@wanadoo.fr', 'ITS', '1973-09-02', '', '0661717630');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (81, 'Chaffiol', 'Antoine', '6 rue maurice boyau', '91220', 'Bretigny sur orge', 'F', 'H', 'toinux@culmouton.com', 'Toinux', '1977-07-27', '', '');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (41, 'Duroc', 'Nicolas', '78, Avenue de Paris', '92320', 'Chatillon', 'France', 'H', 'jediforce_stg@hotmail.com', 'BaBeuH', '1981-10-28', '0146542566', '0687495097');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (17, 'Verdier', 'Frédéric', '15 Rue Thiers', '26000', 'Valence', 'France', 'H', 'hxh_kass@yahoo.fr', 'Kass', '1982-10-24', '', '0660937347');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (42, 'Metzinger', 'David', '3 chemin des vaugeroux', '95300', 'Pontoise', 'France', 'H', 'frapa95@hotmail.com', 'Frapa', '1980-08-10', '', '0658577827');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (43, 'Stremsdoerfer', 'Jérôme', '107 ter Rue Dalayrac', '94120', 'Fontenay Sous Bois', 'France', '', 'pulverisator@msn.com', 'Pulve', '1976-02-17', '', '0663657666');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (16, 'beziade', 'benoît', '1 rue jean françois lépine', '75018', 'paris', 'fr', 'H', 'winielebarbu@gmail.com', 'bArbu', '1982-10-12', '0140212807', '0664783491');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (8, 'FARINA', 'Franck', '5 rue edouard TIL', '94400', 'Vitry sur seine', 'FRANCE', 'H', 'celos94@yahoo.fr', 'Celos', '1984-07-25', '', '0625691453');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (87, 'LANIECE', 'Denis', '6 place victor jacquemont', '37200', 'Tours', 'france', 'H', 'humu37@wanadoo.fr', 'hUm', '1978-01-17', '', '0684636003');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (38, 'Herreros', 'Jose', '03 rue titon', '75011', 'Paris', 'France', 'H', 'RickBlood@noos.fr', 'Rickii', '1978-08-16', '0143700158', '0622743275');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (86, 'desalmand', 'brice', '7 chemin du clos des sapins', '69260', 'charbonnieres les bains', 'france', 'H', 'calamar124@hotmail.com', 'big-ben-koala', '1979-11-18', '', '0679060279');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (39, 'chayla', 'Jean Marc', '14 rue nationale', '63170', 'Aubière', 'France', 'H', 'killerman63@hotmail.com', 'Latex', '1986-06-30', '', '0682046928');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (53, 'SIERRA', 'David', 'camp d''Hannibal bat g rue du 11 novembre', '07800', 'La Voulte sur Rhône', 'France', 'H', 'onclebensdelt@wanadoo.fr', 'D3lta', '1970-05-10', '0475622185', '0630964807');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (9, 'Sierra', 'Mathieu', '13  castel pavillon', '07800', 'Beauchastel', 'france', 'H', 'Mike_lol@hotmail.com', 'FoNzD', '1985-06-16', '', '0618045023');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (47, 'Herbreteau', 'Romuald', '2 allée René Guy Cadou', '49170', 'La Possonnière', 'France', 'H', 'romuald.herbreteau@wanadoo.fr', 'Flam', '1976-01-28', '', '0662732246');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (40, 'AZNAR', 'Matthieu', '144, rue du Plat d''Etain', '37000', 'Tours (37)', 'France', 'H', 'TiouZi@wanadoo.fr', 'TiouZi', '1978-09-21', '', '0660311995');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (46, 'SZCZEPANSKIKI', 'guillaume', '165 avenue de flandre', '75019', 'Paris', 'France', 'H', 'zhed75@hotmail.com', 'CyRuS', '1983-08-26', '0146078228', '');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (51, 'Ougab', 'Fathi', '12 rue marx dormoy', '75018', 'Paris', 'France', 'H', 'algrien@hotmail.com', 'alg', '1982-04-16', '0142094103', '0616472754');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (48, 'Arfi', 'Benjamin', '11 rue Suffren', '13120', 'Gardanne', 'France', 'H', 'p4nth3r@wanadoo.fr', 'P4nTh3R', '1981-02-21', '0442517719', '0625421494');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (56, 'redon', 'franck', '53 place des meulieres', '77550', 'moissy cramayel', 'france', 'H', 'ekt.effer@free.fr', 'EffeR', '1966-07-02', '0160600275', '');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (85, 'Allard', 'Benjamin', '6 place Victor Jacquemont', '37000', 'Tours', 'france', 'H', 'ben187_37@hotmail.com', 'Ben', '1978-08-25', '', '0661903856');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (60, 'Albert', 'Philippe', '11, rue St-Barthélémy', '46000', 'CAHORS', 'France', 'H', 'albphi@hotmail.com', 'AlbPhi', '1982-07-09', '', '');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (63, 'BERNARD', 'Pascal', '15, rue EdgarDegas', '44570', 'Loire Atlantique', 'France', 'H', 'pascal.bernard62@wanadoo.fr', 'Pibi', '1965-05-07', '0251105688', '0662331794');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (115, 'Negoti', 'stephane', '7 rue de cambrai', '75019', 'paris', 'france', 'H', 'stebo@noos.fr', 'Stebo', '1982-09-12', '0146075885', '0621830288');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (25, 'Lavaux', 'Francois', '15 rue haute du ponceau', '94000', 'Cergy', 'France', 'H', 'kudos_style@hotmail.com', 'Kudos', '1979-10-07', '', '');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (11, 'LIM', 'Francis', '23 Av Youri Gagarine', '93270', 'Sevran', 'France', 'H', 'cis_cs@yahoo.fr', 'Janus', '1979-02-08', '', '0616177446');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (69, 'ROBIN', 'Thomas', '24 C8 rue Simon Jallade', '69110', 'Sainte Foy Les Lyon', 'France', 'H', 'baxan69@hotmail.com', 'black', '1982-10-22', '', '0661742096');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (70, 'DUMAS', 'Laurent', '18, rue du petit bois', '79000', 'Niort(79)', 'France', 'H', 'lolold@hotmail.com', 'Noir', '1981-11-25', '0549791924', '');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (98, 'TARDY', 'Lionel', 'Le Perron', '38160', 'Saint Sauveur', 'FRANCE', 'H', 'beelzebud38@hotmail.com', 'beelz', '1984-07-27', '', '');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (137, 'de DREZIGUE', 'Xavier', '2 rue fernand Pelloutier', '83000', 'TOULON', 'France', 'H', 'xavaude@wanadoo.fr', 'skelet', '1973-03-20', '', '');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (139, 'LIBERGE', 'Greg', '33 rue des berges', '77700', 'Bailly-Romainvilliers', 'FRANCE', 'H', 'vdzys@hotmail.com', 'CptZeB', '1981-03-26', '', '');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (124, 'Dumas', 'Aline', '18 rue du petit bois', '79000', 'Niort (79)', 'France', 'F', 'Alinead79@hotmail.com', 'Aline', '1991-01-09', '', '');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (4, 'lavaux', 'steven', '15 Rue Haute du Ponceau', '95000', 'Cergy', 'France', 'H', 'power_maker@hotmail.com', 'zany', '1986-11-05', '0130732689', '');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (73, 'Carminati', 'Olivier', '886, rue marc chagall', '77190', 'Dammarie', 'France', 'H', 'ksosclan@free.fr', 'Uboat', '1976-01-19', '', '');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (151, 'REIGNIER', 'Damien', '3 all Jakes Riou', '29280', 'PLOUZANE', 'FRANCE', 'H', 'tessuo@cegetel.net', 'tetsuo', '1973-04-04', '', '0662551492');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (158, 'MICHELOT', 'STEPHANE', '17 BD DE SUNDERLAND', '44600', 'Loire Atlantique', 'FRANCE', 'H', 'michelotstephane@wanadoo.fr', 'Buteau', '1963-12-03', '0240533794', '0625902996');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (159, 'DOGAN', 'Azim', '18 rue de Bretagne', '25200', 'Grand Charmont', 'France', 'H', 'zim25200@free.fr', 'ZIM', '1978-05-16', '0871055890', '0663722982');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (162, 'Menard', 'Guillaume', '11 avenue Pasteur', '93100', 'Montreuil', 'France', 'H', 'revengersisko93@hotmail.com', 'RevSisko93', '1986-06-03', '0148571781', '0682441516');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (141, 'Lamandé', 'Dorian', 'Ecole Primaire du Château', '77370', 'Nangis', 'France', 'H', 'rhadbouk@yahoo.fr', 'Durex', '1987-05-03', '0164080455', '0688891266');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (169, 'Roelandt', 'Julien.R', 'Rue', '6000', 'Charleroi', 'Belgique', 'H', 'z0rgleet@hotmail.com', 'JayL', '1985-08-12', '/', '0474/367.8');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (28, 'CICEK', 'Yoldas', '43 rue des petites Ecuries', '75010', 'Paris', 'France', 'H', 'ya1hic@free.fr', 'koala', '1979-12-05', '0142466533', '0614858415');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (189, 'Pétré', 'Amaury', '14 rue michel henry', '77440', 'crécy la chapelle', 'france', 'H', 'amaury51@hotmail.com', 'metalmagic', '1982-07-28', '', '0683335338');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (202, 'Alet', 'Fabien', '17 rue Edouard Laferrière', '92190', 'Meudon', 'France', 'H', 'fabienalet@yahoo.fr', 'Shoulders', '1979-08-17', '0146266336', '');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (201, 'Hierry', 'Kévin', '25, rue du château d''eau', '68740', 'Blodelsheim', 'France', 'H', 'D3pmod@hotmail.fr', 'D3pmod', '1988-10-28', '0389485476', '');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (207, 'Losenbergh', 'Boris', 'Rue emille vandervelde 113', '7390', 'Quaregnon', 'Belgique', '', 'vicerale217@hotmail.com', 'NarutoKyubi', '1987-12-14', '', '0495.61.59');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (223, 'MENARD', 'Mathieu', '11 avenue pasteur', '93100', 'montreuil sous bois', 'FRANCE', 'H', 'donstar25@hotmail.com', 'DouDou', '1978-09-01', '', '0663061336');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (230, 'guillard', 'christophe', 'chemin de la ville heulin', '44600', 'saint-nazaire', 'france', 'H', 'titiastof@hotmail.fr', 'Ares', '1980-09-08', '', '0677791863');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (71, 'Moussaud', 'Marie-Pierre', '231 avenue Louis ravet bat b', '06700', 'saint laurent du var', 'france', 'F', 'krall@wanadoo.fr', 'KrALL', '1974-03-22', '0492270524', '0661953590');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (32, 'PLUMEJEAU', 'Philippe', '62 Rue Louis Blanc', '37000', 'Tours', 'France', 'H', 'AtomiZer_B52@msn.com', 'AtomiZer', '1969-07-20', '0247055552', '');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (27, 'Gerland', 'Frederic', '43 allée Camille Claudel', '07500', 'Guilherand-Granges', 'France', 'H', 'cityhunter12002@hotmail.com', 'CitY-HunteR', '1981-04-01', '', '');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (265, 'gollion', 'amandine', '28 rue guilloux', '69230', 'saint genis laval', 'france', 'F', 'ADN1664@hotmail.com', 'DArk_N', '1983-11-19', '', '0603460816');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (268, 'leggeri', 'antoine', '52 voie de la grange', '95150', 'Taverny', 'france', 'H', 'darkstalkers95@free.fr', 'broly_95', '1980-10-26', '0134180656', '');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (276, 'martel', 'tiphaine', '15 impass barthere villa 39', '31300', 'toulouse', 'france', 'H', 'marteltiphaine@hotmail.com', 'krg', '1983-11-13', 'aucun', '0616224003');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (269, 'masserot', 'vincent', '1 rue des marsauderies', '44300', 'Nantes', 'france', 'H', 'vince269@caramail.com', 'laspa', '1979-07-31', '', '0663940637');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (275, 'Baradeau', 'François', '19 rue de la Gripière', '78320', 'Levis st Nom', 'France', 'H', 'francinou78@hotmail.com', '0z', '1985-06-10', '0134611284', '0676795592');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (206, 'gagnant', 'mathieu', '16 rue de nexon', '87000', 'Limoges', 'france', 'H', 'math367@hotmail.com', 'TeXaSPoNeY', '1978-06-19', '', '0681479043');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (210, 'ARENE', 'Michael', 'Le 4L1  357 rue Marc et Yvonne Baron', '83000', 'Toulon', 'France', 'H', 'drag0n_n0ir@hotmail.com', 'Dragon', '1984-07-06', '0872231602', '0625111330');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (213, 'Espagnol', 'Gregory', '105 rue du sabot', '38660', 'La terrasse', 'France', 'H', 'greg38@lavache.com', 'Leerd', '1977-06-18', '', '0631151755');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (282, 'GRAIN', 'boris', 'Hameau de bellegarde', '76190', 'Rouen', 'France', 'H', 'bobogo_76@hotmail.com', 'bobog', '1980-01-26', '', '0616547452');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (281, 'Lopez', 'Romain', '51 C rue du coq saint marceau', '45100', 'Orléans', 'France', 'H', 'rom145@hotmail.com', 'CaPrice', '1988-04-07', '0238560964', '0603297481');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (286, 'Trabut', ' romain', '7 rue henri moissan', '38000', 'isere', 'france', 'H', 'crevette38@lavache.com', 'Gouda', '1979-09-21', '', '');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (288, 'Mathieu', 'Jerome', '31 rue d''arsonval', '69800', 'Saint Priest', 'France', 'H', 'emoman@free.fr', 'Parmesan', '1986-01-20', '', '');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (277, 'Gendre', 'Julien', '150 bd Voltaire', '92600', 'Asnières sur Seine', 'France', 'H', 'julliien@hotmail.com', 'Chavroux', '1982-08-02', '', '0668970620');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (204, 'MESSINA', 'Gabriel-Emmanuel', '5, chemin de l''église', '38000', 'Grenoble', 'France', 'H', 'gabs119@hotmail.com', 'St-MarS', '1977-05-28', '', '0607901395');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (291, 'bats', 'sebastien', '86 citée montadour', '40500', 'st-sever', 'france', 'H', 'sbatsou@hotmail.com', 'Cabecou', '1976-10-05', '', '0624127077');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (294, 'stagne', 'cyril', 'les ardrets', '91220', 'bretigny', 'france', 'H', 'cyrnad2@free.fr', 'cyrnad', '1977-03-06', '0000000000', '0000000000');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (290, 'sanchez', 'pablo', '1, rue choderlos de laclos appt 334', '75013', 'paris', 'france', 'H', 'zildjian-@hotmail.fr', 'zildjian-', '1974-07-23', '0153619893', '0612964472');
INSERT INTO `adhesion_adherent` (`adh_id`, `adh_nom`, `adh_prenom`, `adh_adresse`, `adh_code_postal`, `adh_ville`, `adh_pays`, `adh_sexe`, `adh_email`, `adh_pseudo`, `adh_date_naissance`, `adh_telephone_fixe`, `adh_telephone_portable`) VALUES (297, 'CAO VAN', 'Christian', 'rue du fossé st Denis', '84400', 'GARGAS', 'FRANCE', 'H', 'chriselix@hotmail.com', 'Tx', '1983-11-29', '', '0677751538');

-- --------------------------------------------------------

-- 
-- Structure de la table `adhesion_config_tab`
-- 

CREATE TABLE "adhesion_config_tab" (
  "id" int(11) NOT NULL,
  "parametre" varchar(20) NOT NULL default '',
  "valeur" text NOT NULL,
  PRIMARY KEY  ("id")
);

-- 
-- Contenu de la table `adhesion_config_tab`
-- 

INSERT INTO `adhesion_config_tab` (`id`, `parametre`, `valeur`) VALUES (1, 'cfg_txt_accueil', '<span class="HEADER">Conditions dâ€™inscription</span>\r\n<p>\r\nLâ€™adhÃ©sion Ã  la Cassosiation est soumise Ã  certaines conditions:\r\n</p>\r\n<ol>\r\n<li>Etre majeur</li>\r\n<li>Avoir lu et approuvÃ© la charte de lâ€™adhÃ©rent disponible <a href="/npds/sections.php?op=viewarticle&artid=5" target=_blank>ICI</a></li>\r\n<li>Remplir le formulaire ci-dessous en fournissant toutes les coordonnÃ©es demandÃ©es</li>\r\n</ol>\r\n<p>\r\nUne fois ce formulaire rempli, <b>votre adhÃ©sion sera soumise Ã  lâ€™approbation du Conseil dâ€™Administration de lâ€™association et sera validÃ©e Ã  la rÃ©ception de votre cotisation</b>.\r\n</p><br>\r\n<p>Pour  votre paiement :<br>\r\n<ul>\r\n<li>si câ€™est un chÃ¨que vous trouverez les coordonnÃ©es pour lâ€™envoi et lâ€™ordre <a href="/npds/sections.php?op=viewarticle&artid=18" target=_blank>ICI</a></li>\r\n<li>si câ€™est un virement vous trouverez le RIB de lâ€™association <a href="/npds/sections.php?op=viewarticle&artid=13" target=_blank>ICI</a></li>\r\n</ul>\r\n</p>\r\n<br>\r\n<font size=-2><i>Les informations recueillies sont nÃ©cessaires\r\npour votre adhÃ©sion. Elles font lâ€™objet dâ€™un traitement informatique et\r\nsont destinÃ©es au secrÃ©tariat de lâ€™association. En application de\r\nlâ€™article 34 de la loi du 6 janvier 1978, vous bÃ©nÃ©ficiez dâ€™un droit\r\ndâ€™accÃ¨s et de rectification aux informations qui vous concernent. Si\r\nvous souhaitez exercer ce droit veuillez utiliser lâ€™accÃ¨s par le module adhÃ©sion\r\nmis Ã  votre disposition en premiÃ¨re page. Pour toute autre demande ou requÃªte,\r\nveuillez vous adresser au prÃ©sident de lâ€™association (coordonnÃ©es disponible sur le site)\r\n</i>\r\n</font>');
INSERT INTO `adhesion_config_tab` (`id`, `parametre`, `valeur`) VALUES (2, 'cfg_date_start', '2004-12-26');
INSERT INTO `adhesion_config_tab` (`id`, `parametre`, `valeur`) VALUES (115, 'cfg_groupe5', '14');
INSERT INTO `adhesion_config_tab` (`id`, `parametre`, `valeur`) VALUES (114, 'cfg_groupe4', '11');
INSERT INTO `adhesion_config_tab` (`id`, `parametre`, `valeur`) VALUES (7, 'cfg_bloc_contenu', '<li><a href="modules.php?ModPath=adhesions&amp;ModStart=adhesion_formulaire"><b>AdhÃ©sion</b></a></li>\r\n<hr class="SEPAR"><li><a href="sections.php?op=viewarticle&amp;artid=1">PrÃ©sentation</a></li>\r\n<li><a href="sections.php?op=viewarticle&amp;artid=6">Conseil Administration</a></li>\r\n<li><a href="links.php?op=viewslink&amp;sid=9">Membres</a></li>\r\n<li><a href="loi1901.pdf" target="_blank">Loi 1901</a></li>\r\n<hr class="SEPAR"><li><a href="sections.php?op=viewarticle&amp;artid=5">Charte adhÃ©rent</a></li>\r\n<li><a href="sections.php?op=viewarticle&amp;artid=4">Chartes Serveurs</a>');
INSERT INTO `adhesion_config_tab` (`id`, `parametre`, `valeur`) VALUES (8, 'cfg_bloc_titre', 'cassosiation');
INSERT INTO `adhesion_config_tab` (`id`, `parametre`, `valeur`) VALUES (113, 'cfg_groupe3', '7');
INSERT INTO `adhesion_config_tab` (`id`, `parametre`, `valeur`) VALUES (112, 'cfg_groupe2', '5');
INSERT INTO `adhesion_config_tab` (`id`, `parametre`, `valeur`) VALUES (80, 'cfg_nb_sessions', '3');
INSERT INTO `adhesion_config_tab` (`id`, `parametre`, `valeur`) VALUES (111, 'cfg_groupe1', '4');
INSERT INTO `adhesion_config_tab` (`id`, `parametre`, `valeur`) VALUES (110, 'cfg_groupe0', '3');
INSERT INTO `adhesion_config_tab` (`id`, `parametre`, `valeur`) VALUES (116, 'cfg_groupe6', '15');
INSERT INTO `adhesion_config_tab` (`id`, `parametre`, `valeur`) VALUES (117, 'cfg_groupe7', '16');
INSERT INTO `adhesion_config_tab` (`id`, `parametre`, `valeur`) VALUES (118, 'cfg_groupe8', '17');

-- --------------------------------------------------------

-- 
-- Structure de la table `adhesion_cotisation`
-- 

CREATE TABLE "adhesion_cotisation" (
  "adh_id" int(11) NOT NULL default '0',
  "ses_id" int(11) NOT NULL default '0',
  "gr_id" int(11) NOT NULL default '0',
  "pai_id" int(11) NOT NULL default '0',
  "cot_adh_statut" int(11) default NULL,
  "cot_adh_gerant" tinyint(1) default NULL,
  PRIMARY KEY  ("adh_id","ses_id","gr_id","pai_id"),
  KEY "FK_adhesion_cotisation_ses_id" ("ses_id"),
  KEY "FK_adhesion_cotisation_gr_id" ("gr_id"),
  KEY "FK_adhesion_cotisation_pai_id" ("pai_id")
);

-- 
-- Contenu de la table `adhesion_cotisation`
-- 

INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (30, 1, 4, 6, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (43, 1, 7, 7, 2, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (45, 1, 17, 8, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (44, 1, 17, 13, 2, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (44, 1, 17, 35, 2, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (13, 1, 7, 10, 2, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (7, 1, 3, 21, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (12, 1, 7, 14, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (18, 1, 4, 15, 2, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (31, 1, 7, 16, 2, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (37, 1, 4, 17, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (40, 1, 4, 18, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (87, 1, 4, 19, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (2, 1, 7, 20, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (53, 1, 3, 22, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (9, 1, 3, 23, 2, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (3, 1, 3, 24, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (8, 1, 3, 25, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (41, 1, 4, 26, 2, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (38, 1, 7, 27, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (48, 1, 7, 28, 2, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (42, 1, 4, 31, 2, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (81, 1, 7, 32, 2, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (19, 1, 3, 33, 2, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (47, 1, 3, 34, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (60, 1, 7, 53, 2, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (63, 1, 17, 54, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (85, 1, 4, 39, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (56, 1, 7, 40, 2, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (46, 1, 7, 41, 2, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (16, 1, 3, 44, 2, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (21, 1, 14, 45, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (39, 1, 14, 46, 2, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (12, 1, 7, 47, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (51, 1, 7, 48, 2, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (14, 1, 7, 49, 2, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (59, 1, 3, 50, 2, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (65, 1, 3, 51, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (17, 1, 4, 52, 2, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (70, 1, 14, 55, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (98, 1, 14, 56, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (69, 1, 14, 57, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (3, 1, 3, 58, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (124, 1, 14, 59, 2, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (11, 1, 7, 60, 2, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (25, 1, 3, 61, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (4, 1, 3, 62, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (86, 1, 17, 64, 2, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (115, 1, 7, 65, 2, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (139, 1, 14, 66, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (137, 1, 14, 67, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (73, 1, 3, 68, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (7, 1, 3, 69, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (16, 1, 3, 70, 2, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (65, 1, 3, 71, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (151, 1, 14, 72, 2, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (69, 1, 14, 73, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (159, 1, 7, 74, 2, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (53, 1, 3, 75, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (162, 1, 7, 76, 2, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (141, 1, 7, 77, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (169, 1, 7, 78, 2, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (158, 1, 17, 79, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (28, 1, 14, 80, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (202, 1, 7, 81, 2, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (189, 1, 7, 82, 2, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (223, 1, 17, 83, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (230, 1, 17, 84, 2, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (69, 2, 14, 91, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (3, 2, 3, 93, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (71, 2, 3, 94, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (32, 2, 3, 95, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (7, 2, 3, 96, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (137, 2, 14, 97, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (141, 2, 7, 98, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (98, 2, 14, 100, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (47, 2, 3, 99, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (139, 2, 14, 101, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (28, 2, 14, 102, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (53, 2, 3, 103, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (210, 2, 14, 104, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (69, 2, 14, 105, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (38, 2, 7, 106, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (73, 2, 3, 107, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (8, 2, 3, 108, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (63, 2, 17, 109, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (70, 2, 14, 110, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (223, 2, 17, 111, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (65, 2, 3, 112, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (12, 2, 7, 113, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (40, 2, 4, 114, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (87, 2, 4, 115, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (30, 2, 4, 116, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (85, 2, 4, 117, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (158, 2, 17, 118, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (204, 2, 15, 119, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (282, 2, 15, 120, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (286, 2, 15, 121, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (37, 2, 4, 122, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (21, 2, 14, 123, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (45, 2, 17, 124, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (277, 2, 15, 125, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (25, 2, 3, 126, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (4, 2, 3, 127, 1, 0);
INSERT INTO `adhesion_cotisation` (`adh_id`, `ses_id`, `gr_id`, `pai_id`, `cot_adh_statut`, `cot_adh_gerant`) VALUES (297, 2, 14, 128, 1, 0);

-- --------------------------------------------------------

-- 
-- Structure de la table `adhesion_cotisation_groupe`
-- 

CREATE TABLE "adhesion_cotisation_groupe" (
  "gr_id" int(11) NOT NULL default '0',
  "ses_id" int(11) NOT NULL default '0',
  "cot_gr_statut" varchar(20) default NULL,
  "cot_gr_type" varchar(20) default NULL,
  "cot_gr_montant" float default NULL,
  PRIMARY KEY  ("gr_id","ses_id"),
  KEY "FK_adhesion_cotisation_groupe_ses_id" ("ses_id")
);

-- 
-- Contenu de la table `adhesion_cotisation_groupe`
-- 

INSERT INTO `adhesion_cotisation_groupe` (`gr_id`, `ses_id`, `cot_gr_statut`, `cot_gr_type`, `cot_gr_montant`) VALUES (3, 1, 'validé', 'team match', 650);
INSERT INTO `adhesion_cotisation_groupe` (`gr_id`, `ses_id`, `cot_gr_statut`, `cot_gr_type`, `cot_gr_montant`) VALUES (4, 1, 'validé', 'team match', 650);
INSERT INTO `adhesion_cotisation_groupe` (`gr_id`, `ses_id`, `cot_gr_statut`, `cot_gr_type`, `cot_gr_montant`) VALUES (5, 1, 'validé', 'team FFA', 500);
INSERT INTO `adhesion_cotisation_groupe` (`gr_id`, `ses_id`, `cot_gr_statut`, `cot_gr_type`, `cot_gr_montant`) VALUES (7, 1, 'validé', 'freeplayers', NULL);
INSERT INTO `adhesion_cotisation_groupe` (`gr_id`, `ses_id`, `cot_gr_statut`, `cot_gr_type`, `cot_gr_montant`) VALUES (11, 1, 'validé', 'team match', 650);
INSERT INTO `adhesion_cotisation_groupe` (`gr_id`, `ses_id`, `cot_gr_statut`, `cot_gr_type`, `cot_gr_montant`) VALUES (14, 1, 'validé', 'team match', 650);
INSERT INTO `adhesion_cotisation_groupe` (`gr_id`, `ses_id`, `cot_gr_statut`, `cot_gr_type`, `cot_gr_montant`) VALUES (3, 2, 'en attente', 'team match', 440);
INSERT INTO `adhesion_cotisation_groupe` (`gr_id`, `ses_id`, `cot_gr_statut`, `cot_gr_type`, `cot_gr_montant`) VALUES (4, 2, 'en attente', 'team match', 440);
INSERT INTO `adhesion_cotisation_groupe` (`gr_id`, `ses_id`, `cot_gr_statut`, `cot_gr_type`, `cot_gr_montant`) VALUES (14, 2, 'en attente', 'team match', 440);
INSERT INTO `adhesion_cotisation_groupe` (`gr_id`, `ses_id`, `cot_gr_statut`, `cot_gr_type`, `cot_gr_montant`) VALUES (15, 2, 'en attente', 'team match', 440);
INSERT INTO `adhesion_cotisation_groupe` (`gr_id`, `ses_id`, `cot_gr_statut`, `cot_gr_type`, `cot_gr_montant`) VALUES (16, 2, 'en attente', 'team match', 440);
INSERT INTO `adhesion_cotisation_groupe` (`gr_id`, `ses_id`, `cot_gr_statut`, `cot_gr_type`, `cot_gr_montant`) VALUES (17, 2, 'en attente', 'team FFA', 300);
INSERT INTO `adhesion_cotisation_groupe` (`gr_id`, `ses_id`, `cot_gr_statut`, `cot_gr_type`, `cot_gr_montant`) VALUES (7, 2, 'en attente', 'freeplayers', NULL);

-- --------------------------------------------------------

-- 
-- Structure de la table `adhesion_groupe`
-- 

CREATE TABLE "adhesion_groupe" (
  "gr_id" int(11) NOT NULL default '0',
  "gr_name" varchar(30) default NULL,
  "gr_description" varchar(255) default NULL,
  "gr_web" varchar(100) default NULL,
  "gr_irc" varchar(30) default NULL,
  PRIMARY KEY  ("gr_id")
);

-- 
-- Contenu de la table `adhesion_groupe`
-- 

INSERT INTO `adhesion_groupe` (`gr_id`, `gr_name`, `gr_description`, `gr_web`, `gr_irc`) VALUES (3, '=KSOS=', 'Clan KSOS', '', '');
INSERT INTO `adhesion_groupe` (`gr_id`, `gr_name`, `gr_description`, `gr_web`, `gr_irc`) VALUES (4, '=BdX=', 'Clan Brutal de luXe', '', '');
INSERT INTO `adhesion_groupe` (`gr_id`, `gr_name`, `gr_description`, `gr_web`, `gr_irc`) VALUES (5, '[Cul Mouton]', 'Clan CulMouton', '', '');
INSERT INTO `adhesion_groupe` (`gr_id`, `gr_name`, `gr_description`, `gr_web`, `gr_irc`) VALUES (7, 'Freeplayers', 'Membres de la Cassosiation, catégorie Freeplayer', '', '');
INSERT INTO `adhesion_groupe` (`gr_id`, `gr_name`, `gr_description`, `gr_web`, `gr_irc`) VALUES (11, '-=[EKT]=-', 'Clan EKT', '', '');
INSERT INTO `adhesion_groupe` (`gr_id`, `gr_name`, `gr_description`, `gr_web`, `gr_irc`) VALUES (14, '[ELI]', 'Membre du clan [ELI]', '', '');
INSERT INTO `adhesion_groupe` (`gr_id`, `gr_name`, `gr_description`, `gr_web`, `gr_irc`) VALUES (15, 'FQP', 'Team des Fromages Qui Puent', '', '');
INSERT INTO `adhesion_groupe` (`gr_id`, `gr_name`, `gr_description`, `gr_web`, `gr_irc`) VALUES (16, 'CHE', 'Team des Chevaliers', '', '');
INSERT INTO `adhesion_groupe` (`gr_id`, `gr_name`, `gr_description`, `gr_web`, `gr_irc`) VALUES (17, 'FunXp DOD', 'Membres de la team FunXp Day Of Defeat', '', '');

-- --------------------------------------------------------

-- 
-- Structure de la table `adhesion_paiement`
-- 

CREATE TABLE "adhesion_paiement" (
  "pai_id" int(11) NOT NULL default '0',
  "pai_montant" float default NULL,
  "pai_date" date default NULL,
  "pai_comments" varchar(100) default NULL,
  "pai_reference" varchar(20) default NULL,
  "pai_type" int(11) default NULL,
  PRIMARY KEY  ("pai_id")
);

-- 
-- Contenu de la table `adhesion_paiement`
-- 

INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (6, 50, '2004-12-10', 'Mandat international à Fabien Spengler --> Dépot espèce', '04 3072089 G', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (7, 80, '2004-10-29', '', '3813176', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (8, 80, '2004-10-17', '', '6204741', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (13, 45, '2004-12-02', 'Chèque1 : 04 4652016 F\r\n\r\n', '04 4652016 F', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (35, 45, '2004-12-02', 'Chèque2 : 04 4652017 F', '04 4652017 F', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (10, 65, '2004-11-08', '', '0000281', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (21, 55, '2004-11-19', '', '9594656', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (14, 75, '2004-10-11', '', '6573158', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (15, 54.2, '2004-12-06', '', '6573158', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (16, 54.2, '2004-12-07', '', '7463992', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (17, 54.2, '2004-12-06', '', '04 4429020 B', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (18, 54.2, '2004-12-15', '', '2409516', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (19, 54.2, '2004-12-15', '', '2409516', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (20, 100, '2004-11-26', '', '04 4633004 F', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (22, 55, '2004-11-07', 'Chèque de 110€ - Bénéficiaires : D3lta et FonzD', '0188782', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (23, 55, '2004-11-07', 'Chèque de 110€ - Bénéficiaires : D3lta et FonzD', '0188782', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (24, 60, '2004-11-07', 'Versés à Klochette', '', 3);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (25, 25, '2004-12-12', '', '02 2677011 B', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (26, 54.2, '2004-12-07', '', '7463992', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (27, 54.2, '2004-12-22', 'Herrero pour Cassosiation', '', 2);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (28, 50, '2005-01-03', 'Nancy Daumas - Cotisation P4nther', '', 2);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (31, 54.2, '2004-12-14', '', '0000067', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (32, 65, '2004-12-08', '', '0198364', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (33, 30, '2004-12-30', '', '2361831', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (34, 35, '2004-12-30', '', '0000031', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (53, 50, '2005-01-31', 'FreePlayer', '0000001', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (54, 50, '2005-02-16', 'BERNARD  COTISATION', '', 2);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (39, 54.2, '2004-12-15', '', '2409516', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (40, 80, '2005-01-02', '', '2127485', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (41, 80, '2004-12-21', '', '1022763', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (44, 25, '2005-01-11', '', '', 3);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (45, 65, '2004-01-17', 'Chèque de 130€ - Bénéficiaires : Campbell et Latex', '8993891', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (46, 65, '2005-01-17', 'Chèque de 130€ - Bénéficiaires : Campbell et Latex', '8993891', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (47, 30, '2005-01-25', 'Virement de 165€ au total - Bénéficiaire : Nicux 65€ - Luther 40€ - ZIM 30€ - Durex 30€', '', 2);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (48, 80, '2005-01-25', 'MR OUGAB FATHI COTISATION ALG', 'Cotisation Alg', 2);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (49, 65, '2005-01-25', 'Virement de 165€ au total - Bénéficiaire : Nicux 65€ - Luther 40€ - ZIM 30€ - Durex 30€', '', 2);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (50, 25, '2005-01-28', 'Chèque de 80€ de Mr Carry - Bénéficiaire :  Lilo (15€) ---> Attend complément de 10€ par Slapinou', '', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (51, 65, '2005-01-28', 'Chèque de 80€ de Mr Carry - Bénéficiaire : KlocheTTe (65 €)', '0109869', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (52, 65.7, '2005-02-08', '3 chèques précédents non-signés, non-encaissés, détruits (0000087, 0000088, 0000089)', '0470005', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (55, 70, '2005-02-14', 'Chèque commun avec Aline', '5546713', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (56, 55, '2005-02-19', '', '5446557', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (57, 45, '2005-02-26', 'ROBIN THOMAS COTISE ELI BLACK', '', 2);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (58, 30, '2005-02-26', 'Cotis. compl. slap', '', 2);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (59, 70, '2005-02-27', 'Chèque commun avec Noir', '5546713', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (60, 50, '2005-03-03', 'VIREMENT LIM FRA', '', 2);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (61, 150, '2005-03-03', 'DON POUR CASSOSIATION BY KUDOS - 300€ en tout', '', 2);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (62, 150, '2005-03-03', 'DON POUR CASSOSIATION BY KUDOS - 300€ en tout', '', 2);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (64, 80, '2005-03-04', 'date = date de dépôt', '8173306', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (65, 80, '2005-03-04', 'date = date de dépôt\r\n', '04 4632013 B', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (66, 55, '2005-03-04', 'date = date de dépôt du chèque', '4741007', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (67, 65, '2005-03-04', 'date = date de dépôt du chèque', '0000227', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (68, 40, '2005-01-04', '', '02 2596014 B', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (69, 30, '2005-04-08', 'Compl. Cotis. Gpx', '', 2);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (70, 20, '2005-04-09', 'Compl. Cotis. Barbu', '', 2);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (71, 30, '2005-04-13', ' Compl. Cotis.KlocheTTe', '', 3);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (72, 70, '2005-03-16', '', '04 4631015 E', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (73, 25, '2005-03-12', 'Compl. Cot. Black', '', 2);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (74, 40, '2005-05-02', 'Virement de 165€ au total - Bénéficiaire : Nicux 65€ - Luther 40€ - ZIM 30€ - Durex 30€', '', 2);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (75, 50, '2005-04-29', 'Compl. Cotis. D3lt@', '', 2);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (76, 25, '2005-05-18', '', '', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (77, 30, '2005-01-25', 'Virement de 165€ au total - Bénéficiaire : Nicux 65€ - Luther 40€ - ZIM 30€ - Durex 30€', '', 2);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (78, 25, '2005-06-06', '<br>Il faut rentrer le n° de chèque</b>', '', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (79, 25, '2005-06-02', '', '8072484', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (80, 54, '2005-06-09', 'YOLDAS CICEK - COTISATION ELI KOALA', '', 2);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (81, 25, '2005-08-01', 'Virement de 50€ de sébastien Montadre - Bénéficiaires : Doggpound + Shoulders', '', 2);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (82, 25, '2005-09-29', 'M. PETRE AMAURY<br>\r\nCOTISATION FUNXP METALMAGIC', '', 2);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (83, 25, '2005-10-01', 'METTRE LE N° DE CHEQUE', '', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (84, 25, '2005-10-11', 'M CHRISTOPHE GUILLARD', '', 2);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (91, 40, '2005-11-25', 'ROBIN THOMAS\r\nCOTISATION ELI BLACK', '', 2);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (93, 50, '2005-12-03', 'Cotisation 2006 Slapinou', '', 2);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (94, 50, '2005-11-24', 'Dépôt le 20/12/2005', '7039106', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (95, 50, '2005-11-22', 'Dépôt le 20/12/2005', '2143685', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (96, 30, '2005-12-07', 'LEAUTE ROMAIN\r\nCOTIS 2006', '', 2);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (97, 36, '2005-12-09', 'COTISATION ELI - SKELET', '', 2);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (98, 40, '2005-12-07', 'Dépôt le 20/12/2005', '7186427', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (100, 36, '2005-12-13', 'Dépôt le 20/12/2005', '5446583', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (99, 20, '2005-12-07', 'Dépôt le 20/12/2005', '0000068', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (101, 36, '2005-12-04', 'Dépôt le 20/12/2005', '4741024', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (102, 36, '2005-12-12', 'Dépôt le 20/12/2005', '0000064', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (103, 50, '2005-12-18', 'COTISATION KSOS DELTA', '', 2);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (104, 36, '2005-12-05', 'Dépôt le 20/12/2005', '3641023', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (105, 80, '2005-12-20', '', 'Cotise', 2);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (106, 40, '2005-12-21', 'PAIEMENT DE RICKII', '', 2);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (107, 30, '2005-12-18', 'Dépôt le 23/12/2005', '0025893', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (108, 30, '2005-12-19', 'Dépôt le 23/12/2005', '2677016', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (109, 43.75, '2005-12-18', 'Dépôt le 23/12/2005', '9791849', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (110, 36, '2005-12-18', 'Dépôt le 23/12/2005', '5546729', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (111, 43.75, '2005-12-19', 'Dépôt le 23/12/2005', '9307173', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (112, 50, '2005-12-20', 'Dépôt le 20/12/2005', '-', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (113, 40, '2006-01-04', 'COTISATION FUNXP JCEX', '', 2);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (114, 50, '2005-12-21', 'Dépôt le 05/01/2006', '2409776', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (115, 50, '2005-12-24', 'Dépôt le 05/01/2006\r\n(chèque #6457593 150€ pour hUm, Olmo, Ben)', '6457593', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (116, 50, '2005-12-24', 'Dépôt le 05/01/2006\r\n(chèque #6457593 150€ pour hUm, Olmo, Ben)', '6457593', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (117, 50, '2005-12-24', 'Dépôt le 05/01/2006\r\n(chèque #6457593 150€ pour hUm, Olmo, Ben)', '6457593', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (118, 43.75, '2005-12-20', 'Dépôt le 05/01/2006', '8072513', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (119, 50, '2005-12-30', 'Dépôt le 05/01/2006', '5438223', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (120, 50, '2005-12-30', 'Dépôt le 05/01/2006', '5365568', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (121, 50, '2005-12-28', 'Dépôt le 05/01/2006', '9968101', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (122, 50, '2006-01-03', 'Dépôt le 05/01/2006', '5726003', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (123, 36, '2006-01-02', 'Dépôt le 05/01/2006', '5102169', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (124, 43.75, '2005-12-28', 'Dépôt le 05/01/2006', '8479868', 1);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (125, 50, '2006-01-05', 'GENDRE JULIEN\r\nCOTISAT', '', 2);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (126, 40, '2005-01-07', 'LAVAUX - INTERNET- LAVAUX FRANCOIS<br>\r\n80€ en tout => Zany + Kudos', '', 2);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (127, 40, '2005-01-07', 'LAVAUX - INTERNET- LAVAUX FRANCOIS<br>\r\n80€ en tout => Zany + Kudos', '', 2);
INSERT INTO `adhesion_paiement` (`pai_id`, `pai_montant`, `pai_date`, `pai_comments`, `pai_reference`, `pai_type`) VALUES (128, 36, '0000-00-00', 'Dépôt le 05/01/2006', '', 1);

-- --------------------------------------------------------

-- 
-- Structure de la table `adhesion_session`
-- 

CREATE TABLE "adhesion_session" (
  "ses_id" int(11) NOT NULL,
  "ses_annee_civ" varchar(10) default NULL,
  "ses_annee_scol" varchar(10) default NULL,
  PRIMARY KEY  ("ses_id")
);

-- 
-- Contenu de la table `adhesion_session`
-- 

INSERT INTO `adhesion_session` (`ses_id`, `ses_annee_civ`, `ses_annee_scol`) VALUES (1, '2005', '2004/2005');
INSERT INTO `adhesion_session` (`ses_id`, `ses_annee_civ`, `ses_annee_scol`) VALUES (2, '2006', '2005/2006');
INSERT INTO `adhesion_session` (`ses_id`, `ses_annee_civ`, `ses_annee_scol`) VALUES (3, '2007', '2006/2007');
INSERT INTO `adhesion_session` (`ses_id`, `ses_annee_civ`, `ses_annee_scol`) VALUES (4, NULL, NULL);
INSERT INTO `adhesion_session` (`ses_id`, `ses_annee_civ`, `ses_annee_scol`) VALUES (5, NULL, NULL);
INSERT INTO `adhesion_session` (`ses_id`, `ses_annee_civ`, `ses_annee_scol`) VALUES (6, NULL, NULL);
INSERT INTO `adhesion_session` (`ses_id`, `ses_annee_civ`, `ses_annee_scol`) VALUES (7, NULL, NULL);
INSERT INTO `adhesion_session` (`ses_id`, `ses_annee_civ`, `ses_annee_scol`) VALUES (8, NULL, NULL);
INSERT INTO `adhesion_session` (`ses_id`, `ses_annee_civ`, `ses_annee_scol`) VALUES (9, NULL, NULL);
INSERT INTO `adhesion_session` (`ses_id`, `ses_annee_civ`, `ses_annee_scol`) VALUES (10, NULL, NULL);
INSERT INTO `adhesion_session` (`ses_id`, `ses_annee_civ`, `ses_annee_scol`) VALUES (11, NULL, NULL);
INSERT INTO `adhesion_session` (`ses_id`, `ses_annee_civ`, `ses_annee_scol`) VALUES (12, NULL, NULL);
INSERT INTO `adhesion_session` (`ses_id`, `ses_annee_civ`, `ses_annee_scol`) VALUES (13, NULL, NULL);
INSERT INTO `adhesion_session` (`ses_id`, `ses_annee_civ`, `ses_annee_scol`) VALUES (14, NULL, NULL);
INSERT INTO `adhesion_session` (`ses_id`, `ses_annee_civ`, `ses_annee_scol`) VALUES (15, NULL, NULL);
INSERT INTO `adhesion_session` (`ses_id`, `ses_annee_civ`, `ses_annee_scol`) VALUES (16, NULL, NULL);
INSERT INTO `adhesion_session` (`ses_id`, `ses_annee_civ`, `ses_annee_scol`) VALUES (17, NULL, NULL);
INSERT INTO `adhesion_session` (`ses_id`, `ses_annee_civ`, `ses_annee_scol`) VALUES (18, NULL, NULL);
INSERT INTO `adhesion_session` (`ses_id`, `ses_annee_civ`, `ses_annee_scol`) VALUES (19, NULL, NULL);
INSERT INTO `adhesion_session` (`ses_id`, `ses_annee_civ`, `ses_annee_scol`) VALUES (20, NULL, NULL);
INSERT INTO `adhesion_session` (`ses_id`, `ses_annee_civ`, `ses_annee_scol`) VALUES (21, NULL, NULL);
INSERT INTO `adhesion_session` (`ses_id`, `ses_annee_civ`, `ses_annee_scol`) VALUES (22, NULL, NULL);
INSERT INTO `adhesion_session` (`ses_id`, `ses_annee_civ`, `ses_annee_scol`) VALUES (23, NULL, NULL);
INSERT INTO `adhesion_session` (`ses_id`, `ses_annee_civ`, `ses_annee_scol`) VALUES (24, NULL, NULL);
INSERT INTO `adhesion_session` (`ses_id`, `ses_annee_civ`, `ses_annee_scol`) VALUES (25, NULL, NULL);
INSERT INTO `adhesion_session` (`ses_id`, `ses_annee_civ`, `ses_annee_scol`) VALUES (26, NULL, NULL);
INSERT INTO `adhesion_session` (`ses_id`, `ses_annee_civ`, `ses_annee_scol`) VALUES (27, NULL, NULL);
INSERT INTO `adhesion_session` (`ses_id`, `ses_annee_civ`, `ses_annee_scol`) VALUES (28, NULL, NULL);
INSERT INTO `adhesion_session` (`ses_id`, `ses_annee_civ`, `ses_annee_scol`) VALUES (29, NULL, NULL);
INSERT INTO `adhesion_session` (`ses_id`, `ses_annee_civ`, `ses_annee_scol`) VALUES (30, NULL, NULL);
