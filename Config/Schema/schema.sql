DROP TABLE IF EXISTS `tinyadmin`.`ta_blocks`;
DROP TABLE IF EXISTS `tinyadmin`.`ta_users`;
DROP TABLE IF EXISTS `tinyadmin`.`ta_metadata`;


CREATE TABLE `tinyadmin`.`ta_blocks` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`url` varchar(255) DEFAULT NULL,
	`dom_id` varchar(255) DEFAULT NULL,
	`content` mediumtext DEFAULT NULL,
	`created` datetime DEFAULT NULL,
	`modified` datetime DEFAULT NULL,	PRIMARY KEY  (`id`),
	KEY `URL` (`url`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_unicode_ci,
	ENGINE=MyISAM;

CREATE TABLE `tinyadmin`.`ta_users` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`email` varchar(255) DEFAULT NULL,
	`password` varchar(255) DEFAULT NULL,
	`created` datetime DEFAULT NULL,
	`modified` datetime DEFAULT NULL,	PRIMARY KEY  (`id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_unicode_ci,
	ENGINE=MyISAM;

CREATE TABLE `tinyadmin`.`ta_metadata` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`url` varchar(255) DEFAULT NULL,
	`title` varchar(255) DEFAULT NULL,
	`description` text DEFAULT NULL,
	`keywords` text DEFAULT NULL,
	`created` datetime DEFAULT NULL,
	`modified` datetime DEFAULT NULL,	PRIMARY KEY  (`id`),
	UNIQUE KEY `URL` (`url`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_unicode_ci,
	ENGINE=MyISAM;

