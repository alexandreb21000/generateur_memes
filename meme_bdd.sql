-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 18 juin 2018 à 07:20
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `meme_generateur`
--

-- --------------------------------------------------------

--
-- Structure de la table `meme`
--

DROP TABLE IF EXISTS `meme`;
CREATE TABLE IF NOT EXISTS `meme` (
  `ME_id` int(11) NOT NULL AUTO_INCREMENT,
  `ME_image` varchar(255) NOT NULL,
  `ME_date` datetime DEFAULT NULL,
  PRIMARY KEY (`ME_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `meme`
--

INSERT INTO `meme` (`ME_id`, `ME_image`, `ME_date`) VALUES
(1, 'https://www.swad.fr/upload/membres/51/profil_1464097916.jpg', NULL),
(2, 'https://www.swad.fr/upload/membres/51/profil_1464097916.jpg', NULL),
(3, 'https://www.swad.fr/upload/membres/51/profil_1464097916.jpg', NULL),
(4, 'https://www.swad.fr/upload/membres/51/profil_1464097916.jpg', NULL),
(5, 'https://www.swad.fr/upload/membres/51/profil_1464097916.jpg', NULL),
(6, 'https://www.swad.fr/upload/membres/51/profil_1464097916.jpg', NULL),
(7, 'https://www.swad.fr/upload/membres/37/profil_1464097921.jpg', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
