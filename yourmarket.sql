-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 05 avr. 2021 à 18:35
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `yourmarket`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `fname`, `lname`, `email`, `password`) VALUES
(1, 'Richard', 'Richard', 'richard', 'richard');

-- --------------------------------------------------------

--
-- Structure de la table `card`
--

DROP TABLE IF EXISTS `card`;
CREATE TABLE IF NOT EXISTS `card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exp` int(10) NOT NULL,
  `security` int(10) NOT NULL,
  `number` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `buyerid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_buyerid` (`buyerid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `card`
--

INSERT INTO `card` (`id`, `exp`, `security`, `number`, `type`, `buyerid`) VALUES
(1, 2022, 546, 12341234, 'VISA', 1);

-- --------------------------------------------------------

--
-- Structure de la table `command`
--

DROP TABLE IF EXISTS `command`;
CREATE TABLE IF NOT EXISTS `command` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price` int(11) NOT NULL,
  `histuser` int(11) NOT NULL,
  `date` date NOT NULL,
  `shipped` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_histo` (`histuser`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `itemid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_itemid` (`itemid`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`id`, `image`, `itemid`) VALUES
(21, 'christophe-mae.jpg', 33),
(22, 'peachesjb.jpg', 34),
(23, 'images (1).jpg', 35),
(25, 'images.jpg', 36);

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `startingprice` int(11) NOT NULL,
  `actualprice` int(11) DEFAULT NULL,
  `description` varchar(500) NOT NULL,
  `sellerid` int(11) NOT NULL,
  `commandid` int(11) DEFAULT NULL,
  `type` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_seller` (`sellerid`),
  KEY `fk_command` (`commandid`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `item`
--

INSERT INTO `item` (`id`, `category`, `brand`, `model`, `startingprice`, `actualprice`, `description`, `sellerid`, `commandid`, `type`) VALUES
(33, 'Vinyl', 'NRJ', 'Christophe MaÃ©', 15, NULL, '3rd album', 1, NULL, 'Buy'),
(34, 'Vinyl', 'VEVO', 'Clip JB peaches', 7, NULL, 'NEW! last hit ', 1, NULL, 'Auction'),
(35, 'Light', 'LUMEX', 'Lumi-3000', 840, NULL, 'Huge light', 2, NULL, 'Buy'),
(36, 'Guitar', 'Fender', 'Guitguit', 689, NULL, 'Tipping the hat on iconic Fender guitar shapes, the Fullerton Series Ukuleles are nothing short of electric. The Fullerton Stratocaster departs from traditional ukulele construction and aesthetics while staying true to Fender histor', 1, NULL, 'Best');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(75) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `background` varchar(255) NOT NULL,
  `adress` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `fname`, `lname`, `email`, `password`, `tel`, `photo`, `background`, `adress`) VALUES
(1, 'Richard', 'LHUISSIER', 'richard', 'richard', '2468', 'Moi', 'Bleu', '33, rue Jean Brunet, PARIS'),
(2, 'Etienne', 'Correge', 'etienne', 'etienne', '0987654321', 'Toi', 'Rouge', '90 avenue Triumph'),
(11, 'Arthur', 'MASK', 'art', '76 rue PIERRE', '564738', 'art', 'art', 'art');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `card`
--
ALTER TABLE `card`
  ADD CONSTRAINT `fk_buyerid` FOREIGN KEY (`buyerid`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `command`
--
ALTER TABLE `command`
  ADD CONSTRAINT `fk_histo` FOREIGN KEY (`histuser`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `fk_itemid` FOREIGN KEY (`itemid`) REFERENCES `item` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `fk_command` FOREIGN KEY (`commandid`) REFERENCES `command` (`id`),
  ADD CONSTRAINT `fk_seller` FOREIGN KEY (`sellerid`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
