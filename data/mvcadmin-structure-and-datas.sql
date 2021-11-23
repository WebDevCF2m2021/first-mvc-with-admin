-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : mar. 23 nov. 2021 à 14:44
-- Version du serveur :  10.5.4-MariaDB
-- Version de PHP : 7.3.21

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données : `mvcadmin`
--
DROP DATABASE IF EXISTS `mvcadmin`;
CREATE DATABASE IF NOT EXISTS `mvcadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mvcadmin`;

-- --------------------------------------------------------

--
-- Structure de la table `thearticle`
--

DROP TABLE IF EXISTS `thearticle`;
CREATE TABLE IF NOT EXISTS `thearticle` (
  `idthearticle` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `thearticleTitle` varchar(180) NOT NULL,
  `thearticleText` text NOT NULL,
  `thearticleDate` datetime NOT NULL DEFAULT current_timestamp(),
  `thearticleStatus` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0 => wait validation\n1 => validate\n2 => wait correction\n3 => ban\n',
  `theuser_idtheuser` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`idthearticle`),
  KEY `fk_thearticle_theuser1_idx` (`theuser_idtheuser`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `thearticle`
--

INSERT INTO `thearticle` (`idthearticle`, `thearticleTitle`, `thearticleText`, `thearticleDate`, `thearticleStatus`, `theuser_idtheuser`) VALUES
(1, 'Les Secrets d\'un Esprit Millionaire', 'Savez-vous pourquoi certaines personnes s\'enrichissent facilement, alors que d\'autres semblent destinées à une vie remplie de difficultés financières? Est-ce une question d\'éducation, d\'intelligence, de compétences, de moments opportuns, d\'habitudes de travail, de contacts, de chance, ou encore de choix de carrière, d\'entreprise ou d\'investissement? Et bien non !\r\n\r\nPour T. Harv Eker, chaque personne a un plan financier personnel imprimé dans son subconscient, un plan qui détermine son avenir. Vous avez beau tout savoir sur le marketing, la vente, les négociations, la bourse, l\'immobilier et le monde de la finance, si votre plan financier intérieur ne vise pas un degré de réussite élevé, vous n\'aurez jamais beaucoup d\'argent. Et si, par hasard, vous veniez à avoir une somme importante, vous la perdriez fort probablement! Il est donc urgent de refaire son plan financier intérieur pour réussir de manière naturelle et automatique.\r\n\r\nGrâce à une brillante alliance de débrouillardise et d\'humour, T. Harv Eker explique comment l\'enfance façonne la destinée financière. Consultez aussi de nombreux dossiers qui décrivent exactement en quoi les riches pensent et agissent différemment de la plupart des gens pauvres et de la classe moyenne. \r\n\r\nVous y trouverez des actions simples à mettre en pratique pour accroître ses revenus et faire fortune.Pour T. Harv Eker, les choses sont simples : si vous pensez comme les riches et faites ce qu\'ils font, vous pouvez devenir aussi riche qu\'eux !', '2021-11-18 13:57:19', 1, 1),
(2, 'Kant et la paix universelle', 'Vers la paix perpétuelle (Titre original : Zum ewigen Frieden. Ein philosophischer Entwurf) est un essai philosophique d\'Emmanuel Kant publié en 1795.\r\n\r\nReprenant une idée de Charles-Irénée Castel de Saint-Pierre dont était paru en 1713 le Projet de paix perpétuelle, Kant y formule un certain nombre de principes destinés à créer les conditions d’une « paix perpétuelle » (par opposition à une simple « cessation des hostilités » provisoire qui est la seule forme de paix possible tant que « l’état de nature » continue de régner entre les États). \r\n\r\nIl constitue les prémices de la théorie de la paix démocratique, et du courant idéaliste en théorie des relations internationales.', '2021-11-23 14:22:11', 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `thearticle_has_thesection`
--

DROP TABLE IF EXISTS `thearticle_has_thesection`;
CREATE TABLE IF NOT EXISTS `thearticle_has_thesection` (
  `thearticle_idthearticle` int(10) UNSIGNED NOT NULL,
  `thesection_idthesection` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`thearticle_idthearticle`,`thesection_idthesection`),
  KEY `fk_thearticle_has_thesection_thesection1_idx` (`thesection_idthesection`),
  KEY `fk_thearticle_has_thesection_thearticle1_idx` (`thearticle_idthearticle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `thearticle_has_thesection`
--

INSERT INTO `thearticle_has_thesection` (`thearticle_idthearticle`, `thesection_idthesection`) VALUES
(1, 3),
(1, 6),
(2, 2),
(2, 5),
(2, 6);

-- --------------------------------------------------------

--
-- Structure de la table `theright`
--

DROP TABLE IF EXISTS `theright`;
CREATE TABLE IF NOT EXISTS `theright` (
  `idtheright` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `therightName` varchar(60) NOT NULL,
  `therightdesc` varchar(300) DEFAULT NULL,
  `therightPerm` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 => user\n1 => redactor\n2 => moderator\n3 => admin',
  PRIMARY KEY (`idtheright`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `theright`
--

INSERT INTO `theright` (`idtheright`, `therightName`, `therightdesc`, `therightPerm`) VALUES
(1, 'Utilisateur', 'Vous pouvez consultez tous nos articles', 0),
(2, 'Rédacteur', 'Créat.eur.rice de contenu', 1),
(3, 'Modérateur', 'Gestionnaire de contenu', 2),
(4, 'Admin', 'Administrat.eur.rice', 3);

-- --------------------------------------------------------

--
-- Structure de la table `thesection`
--

DROP TABLE IF EXISTS `thesection`;
CREATE TABLE IF NOT EXISTS `thesection` (
  `idthesection` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `thesectionTitle` varchar(150) NOT NULL,
  `thesectionDesc` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`idthesection`),
  UNIQUE KEY `thesectionTitle_UNIQUE` (`thesectionTitle`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `thesection`
--

INSERT INTO `thesection` (`idthesection`, `thesectionTitle`, `thesectionDesc`) VALUES
(1, 'Méditation', 'Le terme méditation désigne une pratique mentale qui consiste généralement en une attention portée sur un certain objet, au niveau de la pensée, des émotions, du corps. Dans une approche spirituelle, elle peut être un exercice, voire une voie de réalisation du Soi et d\'éveil. '),
(2, 'Spirituel', 'La notion de spiritualité comporte aujourd\'hui des acceptions différentes selon le contexte de son usage. Elle se rattache conventionnellement, en Occident, à la religion dans la perspective de l\'être humain en relation avec des êtres supérieurs et le salut de l\'âme. '),
(3, 'Paix', 'La paix est un concept qui désigne un état de calme ou de tranquillité ainsi que l\'absence de perturbation, de trouble, de guerre et de conflit. Elle correspond aussi à un idéal social et politique. '),
(4, 'Nature', 'Le mot « nature »  peut désigner la composition et la matière d\'une chose (ce qu\'elle est, son essence), l\'origine et le devenir d\'une chose, l\'ensemble du réel indépendant de la culture humaine, ou l\'ensemble des systèmes et des phénomènes naturels'),
(5, 'Univers', 'L\'Univers, au sens cosmologique, est l\'ensemble de tout ce qui existe, régi par un certain nombre de lois. '),
(6, 'Esprit', 'L\'esprit est la totalité des phénomènes et des facultés mentales : perception, affectivité, intuition, pensée, jugement, morale, etc. ');

-- --------------------------------------------------------

--
-- Structure de la table `theuser`
--

DROP TABLE IF EXISTS `theuser`;
CREATE TABLE IF NOT EXISTS `theuser` (
  `idtheuser` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `theuserName` varchar(150) NOT NULL,
  `theuserLogin` varchar(60) NOT NULL,
  `theuserPwd` varchar(255) NOT NULL,
  `theright_idtheright` smallint(5) UNSIGNED NOT NULL,
  PRIMARY KEY (`idtheuser`),
  UNIQUE KEY `theuserLogin_UNIQUE` (`theuserLogin`),
  KEY `fk_theuser_theright_idx` (`theright_idtheright`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `theuser`
--

INSERT INTO `theuser` (`idtheuser`, `theuserName`, `theuserLogin`, `theuserPwd`, `theright_idtheright`) VALUES
(1, 'Pity Mika', 'admin', 'admin', 4),
(2, 'Jean-Luc Lebleu ', 'lebleu', 'lebleu', 2);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `thearticle`
--
ALTER TABLE `thearticle`
  ADD CONSTRAINT `fk_thearticle_theuser1` FOREIGN KEY (`theuser_idtheuser`) REFERENCES `theuser` (`idtheuser`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Contraintes pour la table `thearticle_has_thesection`
--
ALTER TABLE `thearticle_has_thesection`
  ADD CONSTRAINT `fk_thearticle_has_thesection_thearticle1` FOREIGN KEY (`thearticle_idthearticle`) REFERENCES `thearticle` (`idthearticle`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_thearticle_has_thesection_thesection1` FOREIGN KEY (`thesection_idthesection`) REFERENCES `thesection` (`idthesection`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `theuser`
--
ALTER TABLE `theuser`
  ADD CONSTRAINT `fk_theuser_theright` FOREIGN KEY (`theright_idtheright`) REFERENCES `theright` (`idtheright`) ON DELETE NO ACTION ON UPDATE NO ACTION;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
