-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 04 juin 2023 à 19:04
-- Version du serveur : 5.7.36
-- Version de PHP : 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `xibo`
--

-- --------------------------------------------------------

--
-- Structure de la table `documents`
--

DROP TABLE IF EXISTS `documents`;
CREATE TABLE IF NOT EXISTS `documents` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `documents`
--

INSERT INTO `documents` (`id`, `file_name`, `file_path`, `file_type`) VALUES
(25, 'Capture_nouvel_utilisateur.PNG', '/documents/Capture_nouvel_utilisateur.PNG', 'image/png'),
(26, 'Capture_dns.PNG', '/documents/Capture_dns.PNG', 'image/png'),
(27, 'Capture_xibo.PNG', '/documents/Capture_xibo.PNG', 'image/png'),
(32, 'BACHELOR3_.PNG', '/documents/BACHELOR3_.PNG', 'image/png'),
(37, 'afficheur.png', '/documents/afficheur.png', 'image/png');

-- --------------------------------------------------------

--
-- Structure de la table `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jour` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `entree` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `plat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dessert` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=80 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `menus`
--

INSERT INTO `menus` (`id`, `jour`, `entree`, `plat`, `dessert`) VALUES
(74, 'Mercredi', 'oeuf', '', ''),
(44, 'Mardi', '', '', ''),
(76, 'Jeudi', 'oeuf', 'saumon / haricots verts', 'entremet'),
(79, 'Lundi', 'tomate', 'kebab', 'glace'),
(77, 'Vendredi', 'oeuf', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `meteo`
--

DROP TABLE IF EXISTS `meteo`;
CREATE TABLE IF NOT EXISTS `meteo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `week_start_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `meteo`
--

INSERT INTO `meteo` (`id`, `location`, `week_start_date`) VALUES
(35, 'Chine', '2023-06-04');

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

DROP TABLE IF EXISTS `professeur`;
CREATE TABLE IF NOT EXISTS `professeur` (
  `nom_professeur` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `prenom_professeur` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `debut_absence` datetime DEFAULT NULL,
  `fin_absence` datetime DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `professeur`
--

INSERT INTO `professeur` (`nom_professeur`, `prenom_professeur`, `debut_absence`, `fin_absence`, `id`) VALUES
('Chassel', 'Quentin', '2023-04-25 10:00:00', '2023-05-26 18:00:00', 42),
('Neggaoui', 'Ali', '2023-05-09 10:11:00', '2023-05-18 11:12:00', 39),
('Bengora', 'Bouggera', '2023-06-04 08:00:00', '2023-06-04 12:00:00', 45);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `nom_utilisateur` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mot_de_passe` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`nom_utilisateur`, `mot_de_passe`, `id`) VALUES
('Administrateur', '$2y$10$vVa88spMor6J5diNNu6TPORBT476kpNanX2raCC4vrV/3kDXC9v4y', 5),
('Killian', '$2y$10$.q9fTiABWqIfKlwl888f.OjkPxEDrHVzftjmV7lz8yys2Q/BtUY2.', 44),
('Neggaoui', '$2y$10$nf7e5n9LmJ6UUyb7zCHxnOZU9UrCziLY9EqLzfQ.gdzX9PlH2rmqG', 41);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*   _  ____     __ ___
    | |/ /\ \   / /| __ \
    | ' /  \ \ / / | |_) |
    | . \   \ V /  |  _ /
    |_|\_\   \_/   |_| \_\ */