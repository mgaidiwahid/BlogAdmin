/*
MySQL Data Transfer
Source Host: localhost
Source Database: opendev
Target Host: localhost
Target Database: opendev
Date: 01/12/2016 16:46:56
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for post
-- ----------------------------
DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_id` int(11) NOT NULL,
  `photo2_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `publicationDate` datetime NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5A8A6C8D7E9E4C8C` (`photo_id`),
  KEY `IDX_5A8A6C8D20A9D33A` (`photo2_id`),
  CONSTRAINT `FK_5A8A6C8D20A9D33A` FOREIGN KEY (`photo2_id`) REFERENCES `images` (`id`),
  CONSTRAINT `FK_5A8A6C8D7E9E4C8C` FOREIGN KEY (`photo_id`) REFERENCES `images` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `post` VALUES ('1', '6', null, '[Symfony2] doctrine:schema:update', '<p>J&#39;ai cr&eacute;&eacute; une entit&eacute; Tag et ajout&eacute; la propri&eacute;t&eacute; tags dans le fichier Entity/Article.php seulement quand j&#39;entre la fameuse commande pour mettre &agrave; jour la base de donn&eacute;e, dans phpMyAdmin je vois bien une nouvelle table tag mais il n&#39;y a pas eu de cr&eacute;ation de table de liaison. Et donc que la mise en relation des deux entit&eacute;s a &eacute;chou&eacute;e.<br />\r\n<br />\r\nJ&#39;ai ensuite essay&eacute; en ajoutant l&#39;option --complete et comme je m&#39;en doutais, la table article n&#39;est bien plus pr&eacute;sente.<br />\r\n<br />\r\nMa conclusion: une erreur de syntaxe dans le fichier Entity/Article.php qui emp&ecirc;che le gestionnaire de la base de donn&eacute;e de trouver mes propri&eacute;t&eacute;s, mes relations etc... du coup pour lui, il n&#39;y a rien &agrave; chercher dans Article.php, d&#39;o&ugrave; la suppression de la table avec --complete.</p>', '1', '2016-11-07 18:01:00', '');
INSERT INTO `post` VALUES ('2', '5', null, 'La présidence de la République réagit à la vidéo du Parisien', '<p>La pr&eacute;sidence de la R&eacute;publique a r&eacute;agi &agrave; la vid&eacute;o du Parisien dans laquelle des membres des familles des victimes fran&ccedil;aises de l&rsquo;attentat du Bardo le 18 mars 2015 ont exprim&eacute; leur forte d&eacute;ception de l&rsquo;attitude de B&eacute;ji Ca&iuml;d Essebsi.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>En effet, le conseiller du pr&eacute;sident de la R&eacute;publique, en charge des Affaires culturelles, Hassan Arfaoui, a d&eacute;menti, dans une d&eacute;claration &agrave; Mosa&iuml;que Fm, dimanche 20 novembre 2016, les faits en soulignant que &laquo;<em>les familles et repr&eacute;sentants des victimes qui &eacute;taient pr&eacute;sents aupr&egrave;s du pr&eacute;sident de la R&eacute;publique vont r&eacute;v&eacute;ler la v&eacute;rit&eacute; de ce qui s&rsquo;est pass&eacute; dans un communiqu&eacute; qui sera rendu public</em>&raquo;.</p>\r\n\r\n<p>M. Arfaoui a expliqu&eacute; que si le pr&eacute;sident Ca&iuml;d Essebsi a insist&eacute; sur le fait que les familles des attentats de Bardo assistent &agrave; l&rsquo;inauguration de l&rsquo;exposition &quot;Lieux sacr&eacute;s communs&quot; vendredi dernier au mus&eacute;e du Bardo, c&rsquo;est pour leur exprimer sa solidarit&eacute;, sa sympathie et son soutien, comme il l&rsquo;a d&eacute;j&agrave; indiqu&eacute; lors de l&rsquo;&eacute;v&eacute;nement.</p>\r\n\r\n<p>Le conseiller a affirm&eacute;, &eacute;galement, que cette rencontre a permis de d&eacute;passer certains malentendus et rumeurs v&eacute;hicul&eacute;s par ceux qui d&eacute;testent, la Tunisie, les &eacute;trangers r&eacute;sidents en France et les musulmans d&rsquo;une mani&egrave;re g&eacute;n&eacute;rale.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Hassan Arfaoui a indiqu&eacute; que ce qui a &eacute;t&eacute; diffus&eacute; concernant le boycott de la Tunisie par les familles des victimes et les bless&eacute;s de l&rsquo;attentant du Bardo a &eacute;t&eacute; &eacute;mis par un avocat fran&ccedil;ais connu pour son appartenance &agrave; l&rsquo;extr&ecirc;me droite fran&ccedil;aise. Ce dernier publie r&eacute;guli&egrave;rement sur Atlantico des articles qui refl&egrave;tent sa vision extr&eacute;miste.</p>\r\n\r\n<p>Le conseiller a rappel&eacute; la pr&eacute;sence du pr&eacute;sident de l&rsquo;association des victimes de l&rsquo;attentant du Bardo Serge Mayet &agrave; l&rsquo;inauguration de l&rsquo;exposition &quot;Lieux sacr&eacute;s communs&quot;, qui comme la majorit&eacute; &eacute;crasante des participants, ne cautionne absolument pas le contenu de la vid&eacute;o du Parisien, qui vise uniquement &agrave; cr&eacute;er le Buzz.</p>\r\n\r\n<p>Enfin, il a pr&eacute;cis&eacute; que les deux personnes, ayant t&eacute;moign&eacute; dans cette vid&eacute;o, &eacute;taient pr&eacute;sentes lors de la c&eacute;r&eacute;monie et consid&egrave;rent que leur propos ont &eacute;t&eacute; d&eacute;form&eacute;s.</p>', '1', '2016-11-21 10:10:00', '');
INSERT INTO `post` VALUES ('3', '4', null, 'Hi! This is Fadelicious. New unique look for your blog & portfolio. Quis autem vel eum iure', '<h1>Hi! This is Fadelicious. New unique look for your blog &amp; portfolio. Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum.</h1>', '1', '2016-11-21 10:58:00', '');
INSERT INTO `post` VALUES ('4', '4', null, 'Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit', '<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>\r\n\r\n<p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>', '1', '2016-11-21 16:38:00', '');
INSERT INTO `post` VALUES ('5', '19', null, 'Package Design', '<p>Praesent erat anteport hanip, condimentum quis facilisisac condimentum in ipsum.</p>', '1', '2016-11-21 17:36:00', '');
INSERT INTO `post` VALUES ('6', '20', null, 'Web Design', '<p>Sed sit amet tortor vel risus volut pretium non at estar. Maecenas vitae lectus moles.</p>', '1', '2016-11-21 17:38:00', '');
INSERT INTO `post` VALUES ('7', '21', null, 'E-Commerce', '<p>Praesent erat anteport hanip, condimentum quis facilisisac condimentum in ipsum.</p>', '1', '2016-11-21 17:39:00', '');
INSERT INTO `post` VALUES ('8', '22', null, 'Full Support', '<p>Curabitur nulla antenov, ullamcor iaculis utar, convallis ac massa erat anteport hanip.</p>', '1', '2016-11-21 17:40:00', '');
