-- --------------------------------------------------------

-- 
-- Structure de la table `servstat_servers`
-- 

CREATE TABLE `servstat_servers` (
  `serv_id` int(11) NOT NULL auto_increment,
  `serv_nom` varchar(40) NOT NULL default '',
  `serv_adresse` varchar(16) NOT NULL default '',
  `serv_port` int(5) NOT NULL default '0',
  `serv_url_stat` varchar(50) NOT NULL default '',
  `serv_etat` int(11) NOT NULL default '1',
  `serv_comments` text NOT NULL,
  `serv_game_type` varchar(50) NOT NULL default '',
  `serv_show_img` int(2) NOT NULL default '1',
  `serv_show_player` int(2) NOT NULL default '1',
  `serv_show_map` int(2) NOT NULL default '1',
  PRIMARY KEY  (`serv_id`)
) COMMENT='Servstats  détails des serveurs' AUTO_INCREMENT=1 ;

-- 
-- Contenu de la table `servstat_servers`
-- 

INSERT INTO `servstat_servers` VALUES (6, 'Fun.Xp DM =|20|=', '213.186.50.2', 27015, 'http://cassosiation.verygames.net/psychostats/', 3, 'serveur Counter-Strike Deathmatch', 'Counterstrike', 1, 0, 1);
