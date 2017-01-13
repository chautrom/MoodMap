-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 12 Janvier 2017 à 15:37
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `moodmapdb`
--
DROP SCHEMA IF EXISTS `moodmapDB` ;
CREATE SCHEMA IF NOT EXISTS `moodmapDB` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `moodmapDB` ;

-- --------------------------------------------------------

--
-- Structure de la table `criteria`
--

DROP TABLE IF EXISTS `moodmapDB`.`criteria` ;

CREATE TABLE IF NOT EXISTS `moodmapDB`.`criteria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `iconpath` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `iconpath_UNIQUE` (`iconpath`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `criteria`
--

INSERT INTO `moodmapDB`.`criteria` (`id`, `name`, `iconpath`) VALUES
(1, 'verdure', '/icons/verdure.png'),
(2, 'bruit', '/icons/bruit.png');

-- --------------------------------------------------------

--
-- Structure de la table `datazone`
--

DROP TABLE IF EXISTS `moodmapDB`.`datazone` ;

CREATE TABLE IF NOT EXISTS `moodmapDB`.`datazone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `score` float NOT NULL,
  `id_zone` int(11) NOT NULL,
  `id_criteria` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_datazone_1_idx` (`id_zone`),
  KEY `id_im_idx` (`id_criteria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Contenu de la table `datazone`
--

INSERT INTO `moodmapDB`.`datazone` (`id`, `score`, `id_zone`, `id_criteria`) VALUES
(1, 1, 1, 1),
(2, 0, 2, 1),
(3, 1, 3, 1),
(4, 3, 4, 1),
(5, 4, 5, 1),
(6, 3, 6, 1),
(7, 2, 7, 1),
(8, 4, 8, 1),
(9, 4, 9, 1),
(10, 1, 10, 1),
(11, 3, 11, 1),
(12, 4, 12, 1),
(13, 3, 13, 1),
(14, 4, 14, 1),
(15, 0, 15, 1),
(16, 1, 16, 1),
(17, 2, 1, 2),
(18, 2, 2, 2),
(19, 1, 3, 2),
(20, 1, 4, 2),
(21, 0, 5, 2),
(22, 0, 6, 2),
(23, 2, 7, 2),
(24, 1, 8, 2),
(25, 1, 9, 2),
(26, 1, 10, 2),
(27, 1, 11, 2),
(28, 0, 12, 2),
(29, 1, 13, 2),
(30, 1, 14, 2),
(31, 3, 15, 2),
(32, 3, 16, 2);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `moodmapDB`.`user` ;

CREATE TABLE IF NOT EXISTS `moodmapDB`.`user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `activated` tinyint(1) NOT NULL,
  `challenge` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `user`
--

INSERT INTO `moodmapDB`.`user` (`id`, `username`, `email`, `password`, `activated`, `challenge`) VALUES
(1, 'elhafiani', 'elhafiani@ensicaen.fr', 'A59DFE0E288E1208A0FFF3C', 0, 'AB123EF'),
(2, 'poupi', 'pierre.poupard@ecole.ensicaen.fr', '66bf09db124762712dbd2b39bdff5da7', 1, 'AB12345ZA'),
(3, 'moodmap', 'moodmap@gmail.com', '4337d088fa103f6bd4c866cb69e8f3c5', 1, 'MOODMAP2017');

-- --------------------------------------------------------

--
-- Structure de la table `vote`
--

DROP TABLE IF EXISTS `moodmapDB`.`vote` ;

CREATE TABLE IF NOT EXISTS `moodmapDB`.`vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_criteria` int(11) NOT NULL,
  `id_datazone` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_idx` (`id_user`),
  KEY `id_idx1` (`id_criteria`),
  KEY `id_d_idx` (`id_datazone`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=97 ;

--
-- Contenu de la table `vote`
--

INSERT INTO `moodmapDB`.`vote` (`id`, `id_user`, `id_criteria`, `id_datazone`, `score`) VALUES
(1, 1, 1, 1, 2),
(2, 1, 1, 2, 1),
(3, 1, 1, 3, 2),
(4, 1, 1, 4, 3),
(5, 1, 1, 5, 4),
(6, 1, 1, 6, 2),
(7, 1, 1, 7, 1),
(8, 1, 1, 8, 4),
(9, 1, 1, 9, 4),
(10, 1, 1, 10, 1),
(11, 1, 1, 11, 3),
(12, 1, 1, 12, 4),
(13, 1, 1, 13, 3),
(14, 1, 1, 14, 4),
(15, 1, 1, 15, 0),
(16, 1, 1, 16, 0),
(17, 1, 2, 17, 3),
(18, 1, 2, 18, 2),
(19, 1, 2, 19, 1),
(20, 1, 2, 20, 2),
(21, 1, 2, 21, 1),
(22, 1, 2, 22, 0),
(23, 1, 2, 23, 2),
(24, 1, 2, 24, 1),
(25, 1, 2, 25, 1),
(26, 1, 2, 26, 2),
(27, 1, 2, 27, 1),
(28, 1, 2, 28, 0),
(29, 1, 2, 29, 1),
(30, 1, 2, 30, 1),
(31, 1, 2, 31, 3),
(32, 1, 2, 32, 4),
(33, 2, 1, 1, 1),
(34, 2, 1, 2, 0),
(35, 2, 1, 3, 1),
(36, 2, 1, 4, 3),
(37, 2, 1, 5, 4),
(38, 2, 1, 6, 4),
(39, 2, 1, 7, 2),
(40, 2, 1, 8, 4),
(41, 2, 1, 9, 4),
(42, 2, 1, 10, 1),
(43, 2, 1, 11, 4),
(44, 2, 1, 12, 4),
(45, 2, 1, 13, 2),
(46, 2, 1, 14, 4),
(47, 2, 1, 15, 0),
(48, 2, 1, 16, 1),
(49, 2, 2, 17, 2),
(50, 2, 2, 18, 3),
(51, 2, 2, 19, 1),
(52, 2, 2, 20, 1),
(53, 2, 2, 21, 0),
(54, 2, 2, 22, 0),
(55, 2, 2, 23, 2),
(56, 2, 2, 24, 0),
(57, 2, 2, 25, 2),
(58, 2, 2, 26, 1),
(59, 2, 2, 27, 0),
(60, 2, 2, 28, 0),
(61, 2, 2, 29, 1),
(62, 2, 2, 30, 2),
(63, 2, 2, 31, 4),
(64, 2, 2, 32, 3),
(65, 3, 1, 1, 0),
(66, 3, 1, 2, 0),
(67, 3, 1, 3, 1),
(68, 3, 1, 4, 3),
(69, 3, 1, 5, 4),
(70, 3, 1, 6, 2),
(71, 3, 1, 7, 2),
(72, 3, 1, 8, 3),
(73, 3, 1, 9, 3),
(74, 3, 1, 10, 1),
(75, 3, 1, 11, 2),
(76, 3, 1, 12, 3),
(77, 3, 1, 13, 3),
(78, 3, 1, 14, 4),
(79, 3, 1, 15, 1),
(80, 3, 1, 16, 1),
(81, 3, 2, 17, 0),
(82, 3, 2, 18, 2),
(83, 3, 2, 19, 1),
(84, 3, 2, 20, 1),
(85, 3, 2, 21, 0),
(86, 3, 2, 22, 1),
(87, 3, 2, 23, 2),
(88, 3, 2, 24, 1),
(89, 3, 2, 25, 1),
(90, 3, 2, 26, 1),
(91, 3, 2, 27, 1),
(92, 3, 2, 28, 0),
(93, 3, 2, 29, 2),
(94, 3, 2, 30, 1),
(95, 3, 2, 31, 3),
(96, 3, 2, 32, 2);

-- --------------------------------------------------------

--
-- Structure de la table `zone`
--

DROP TABLE IF EXISTS `moodmapDB`.`zone` ;

CREATE TABLE IF NOT EXISTS `moodmapDB`.`zone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `x` float NOT NULL,
  `y` float NOT NULL,
  `r` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `zone`
--

INSERT INTO `moodmapDB`.`zone` (`id`, `name`, `x`, `y`, `r`) VALUES
(1, 'Le Cargo Caen', -0.3472, 49.1811, 1),
(2, 'CHU Caen', -0.3576, 49.205, 1),
(3, 'ENSICaen Site B', -0.3582, 49.2092, 1),
(4, 'ENSICaen Site A', -0.3678, 49.2142, 1),
(5, 'Cim. St Gabriel Caen', -0.3779, 49.1896, 1),
(6, 'Abbaye aux Hommes Caen', -0.373, 49.1818, 1),
(7, 'Zenith Caen', -0.3823, 49.1716, 1),
(8, 'Parc d''Ornano Caen', -0.3522, 49.1867, 1),
(9, 'Chateau de Caen', -0.3625, 49.1863, 1),
(10, 'Rives de l''Orne', -0.3503, 49.1779, 1),
(11, 'Stade de la Fossette Caen', -0.3849, 49.2053, 1),
(12, 'Colline aux oiseaux Caen', -0.3918, 49.1978, 1),
(13, 'Place de la République Caen', -0.3647, 49.1809, 1),
(14, 'Prairie de Caen', -0.3647, 49.1745, 1),
(15, 'Castorama Caen Herouville', -0.3343, 49.1899, 1),
(16, 'Place Saint Pierre Caen', -0.3609, 49.1838, 1);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `datazone`
--
ALTER TABLE `moodmapDB`.`datazone`
  ADD CONSTRAINT `id_z` FOREIGN KEY (`id_zone`) REFERENCES `zone` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_im` FOREIGN KEY (`id_criteria`) REFERENCES `criteria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `vote`
--
ALTER TABLE `moodmapDB`.`vote`
  ADD CONSTRAINT `id_u` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_i` FOREIGN KEY (`id_criteria`) REFERENCES `criteria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_d` FOREIGN KEY (`id_datazone`) REFERENCES `datazone` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
