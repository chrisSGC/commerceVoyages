-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 17 nov. 2021 à 01:00
-- Version du serveur : 5.7.35
-- Version de PHP : 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `av_christophe`
--
CREATE DATABASE IF NOT EXISTS `av_christophe` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `av_christophe`;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL,
  `categorie` varchar(14) COLLATE utf8_bin DEFAULT NULL,
  `description` varchar(117) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categorie` (`categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `categorie`, `description`) VALUES
(1, 'Aventure', 'Les visites « Aventure » regroupent les activités de ski, de plongée, de grimpe et de randonnée.'),
(2, 'Bénévolat', 'Les voyages de bénévolat envoient des volontaires travailler dans des zones touchées par des catastrophes naturelles.'),
(3, 'Culture', 'Les visites « Culture » mettent l\'accent sur les festivals historiques et les échanges culturels.'),
(4, 'Famille', 'Les visites « Famille » concernent des activités de rencontre, mariage et réunion.'),
(5, 'Formation', 'Les visites de formation complètent les acquis scolaires.'),
(6, 'Sport', 'Les visites « Sport » proposent de découvrir les coulisses des grands événements sportifs.'),
(7, 'Visite de site', 'Les visites de sites concentrent les activités sur des attractions touristiques.');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id` int(11) NOT NULL,
  `prenom` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `nom` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `adresse` varchar(28) COLLATE utf8_bin DEFAULT NULL,
  `ville` varchar(19) COLLATE utf8_bin DEFAULT NULL,
  `CP` varchar(7) COLLATE utf8_bin DEFAULT NULL,
  `telephone` varchar(14) COLLATE utf8_bin DEFAULT NULL,
  `courriel` varchar(35) COLLATE utf8_bin DEFAULT NULL,
  `genre` varchar(1) COLLATE utf8_bin DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `premierContact_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prenom` (`prenom`,`nom`),
  KEY `province_id` (`province_id`),
  KEY `premierContact_id` (`premierContact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `prenom`, `nom`, `adresse`, `ville`, `CP`, `telephone`, `courriel`, `genre`, `province_id`, `premierContact_id`) VALUES
(1, 'Bernard', 'Moulineau', '368, rue du Campanile', 'Québec', 'G1X 4G6', '(418) 228/1234', 'bmoulineau@videotron.ca', 'M', 10, 1),
(2, 'Martine', 'Allard', '996, St-Michel', 'Montréal-Nord', 'H1H 5G7', '(514) 111/6931', 'mmallard@irbc.net', 'F', 10, 1),
(3, 'Camille', 'Boucher', '540, Bd des Galeries', 'Québec', 'G2K 1N4', '(418) 111/3081', 'cboucher@golfedoman.net', 'M', 10, 2),
(4, 'Alicia', 'Beaulieu', '220, Bd Le Corbusier', 'Laval', 'H7S 2C9', '(450) 222/9101', 'abeaulieu@cowanind.net', 'F', 10, 2),
(5, 'Bertrande', 'Bédard', '573, Ferncroft', 'Hampstead', 'H3X 1C4', '(514) 222/7002', 'bbedard@marines.com', 'F', 10, 1),
(6, 'Christine', 'Renard', '120, Av. de Germain-des-Prés', 'Québec', 'G1V 3M7', '(418) 222/3602', 'crenard@plumearabe.com', 'F', 10, 4),
(7, 'Denise', 'Chavant', '444, Bd R. Lévesque Ouest', 'Montréal', 'H2Z 1Z6', '(514) 222/8402', 'camel2@jugeorges.com', 'F', 10, 3),
(8, 'Eugène', 'Clovis', '694, Hochelaga', 'Montréal', 'H1N 1Y9', '(514) 222/5102', 'eclovis@shipwreck.org', 'M', 10, 1),
(9, 'Jeanne', 'Côté', '338, Bd de la Concorde Est', 'Laval', 'H7E 2C2', '(450) 333/9871', 'jcote@foxnews.com', 'F', 10, 3),
(10, 'Andrée', 'Ernest', 'Place Ste-Foy', 'Québec', 'G2T 1C4', '(418) 333/0401', 'aernest@chinaoil.com', 'F', 10, 2),
(11, 'Ginette', 'Déchêne', '659, 3E Avenue', 'Québec', 'G1L 2W5', '(418) 333/0401', 'gdechene@cavutobusiness.com', 'F', 10, 1),
(12, 'Carole', 'Denault', '117, Sherbrooke Ouest', 'Montréal', 'H3A 1H6', '(514) 444/4404', 'cdenault@colonelsmoutarde.com', 'F', 10, 3),
(13, 'Marie', 'Durant', '333, rue du Carrefour', 'Québec', 'G1C 5R9', '(418) 444/8844', 'marie@fontanelle.gouv', 'F', 10, 2),
(14, 'Claude', 'Éloi', 'Place Laurier', 'Québec', 'G1V 2L8', '(418) 444/7414', 'celoy@tremblementdeterre.com', 'M', 10, 4),
(15, 'Jean', 'Gagnon', '215, avenue Pierre-Péladeau', 'Laval', 'H7T 3C2', '(450) 566/4344', 'gagnon@dalailama.net', 'M', 10, 4),
(16, 'Louise', 'Garneau', '542 Métropolitain Est', 'Saint-Léonard', 'H1P 1X2', '(514) 666/1324', 'louise.garneau@dowind.com', 'F', 10, 2),
(17, 'Michel', 'Hébert', '20, Bd d\'Anjou', 'Châteauguay', 'J6K 1C5', '(450) 666/0365', 'mhebert@militarytrends.com', 'M', 10, 2),
(18, 'Joseph', 'Hervieux', '11, St-Jean-Baptiste', 'Le Bic', 'G5L 3S4', '(418) 777/8774', 'jhervieux@refroidissementglobal.org', 'M', 10, 3),
(19, 'Claude', 'Huberty', '162, rue Laurier', 'Québec', 'G1V 4T3', '(418) 888/6004', 'chuberty@rechauffementglobal.net', 'F', 10, 1),
(20, 'Christelle', 'Juneau', '30, Prince-Arthur Ouest', 'Montréal', 'H2X 1S3', '(514) 999/7154', 'chjuneau@nyquilmed.com', 'F', 10, 3),
(21, 'François', 'Levesque', '447, Métropolitain Est', 'Chomedey', 'H7T 1C8', '(514) 999/8777', 'levesque55@perle.com', 'M', 10, 1),
(22, 'Nathalie', 'Lussier', '447 Métropolitain Est', 'Saint-Léonard', 'H1R 1Z4', '(514) 222/8908', 'lussier60@visionnaire.com', 'F', 10, 3),
(23, 'Alban', 'Martin', '15, Laurier Ouest', 'Montréal', 'H2T 2N7', '(450) 333/8505', 'amartin@coteouest.net', 'M', 10, 4),
(24, 'Catherine', 'Morency', '130, Ste-Catherine Ouest', 'Montréal', 'H3G 1P7', '(514) 444/8505', 'cmorency@bretzelbrot.ca', 'F', 10, 1),
(25, 'Élise', 'Moulineau', '55, Bd Wilfrid-Hamel', 'Québec', 'G1M 2S6', '(418) 777/9414', 'emoulineau@filigrane.com', 'F', 10, 2),
(26, 'Robert', 'Maxit', '145, Peel', 'Montréal', 'H3A 1S8', '(514) 888/4514', 'maxit@maximum.com', 'M', 10, 3),
(27, 'Gaëlle', 'Maillard', '217, Montagne', 'Montréal', 'H3G 1ZB', '(514) 777/6434', 'gmaillard@vastetat.org', 'F', 10, 2),
(28, 'Grégoire', 'Normand', '820, 19e Avenue', 'Montréal', 'H1Z 4J8', '(514) 666/5084', 'gnormand@seimensindustry.com', 'M', 10, 1),
(29, 'Marguerite', 'Olive', '119, St-Jean', 'Québec', 'G1R 1S7', '(418) 222/1388', 'molive@kflbanquet.net', 'F', 10, 3),
(30, 'Gabrielle', 'Ouelet', '447, Métropolitain Est', 'Chomedey', 'H7T 1C8', '(514) 333/2434', 'gouelet@switchcity.org', 'F', 10, 1),
(31, 'Ange', 'Patel', '31, Bd Labelle Rosemere', 'Sainte-Thérèse', 'H7U 3J8', '(450) 666/4404', 'apatel@quebecassurances.net', 'F', 10, 2),
(32, 'Jean-Marc', 'Vachon', '780, Bd Thibeau', 'Cap-de-la-Madeleine', 'G8T 6X5', '(819) 777/8504', 'vachonfrere@urgences.net', 'M', 10, 2),
(33, 'Mérisa', 'Villeneuve', '91, rue Champlain', 'Dieppe', 'E1A 1N4', '(506) 111/0403', 'mvilleneuve@century12.com', 'F', 4, 4),
(34, 'Camille', 'Turcotte', '30, Barkoff', 'Cap-de-la-Madeleine', 'G8T 2A3', '(819) 222/8503', 'cturcottepresident@trainvoiture.com', 'M', 10, 4),
(35, 'Alexandra', 'Pelletier', '27, Av. des Pionniers', 'Balmoral', 'E4S 3J5', '(506) 222/8773', 'apelletier@bransonmo.net', 'F', 4, 4);

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

DROP TABLE IF EXISTS `departement`;
CREATE TABLE IF NOT EXISTS `departement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codeDepartement` varchar(3) COLLATE utf8_bin NOT NULL,
  `nomDepartement` varchar(23) COLLATE utf8_bin DEFAULT NULL,
  `region_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nomDepartement` (`nomDepartement`),
  KEY `region_id` (`region_id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `departement`
--

INSERT INTO `departement` (`id`, `codeDepartement`, `nomDepartement`, `region_id`) VALUES
(1, '1', 'Ain', 27),
(2, '10', 'Aube', 7),
(3, '11', 'Aude', 17),
(4, '12', 'Aveyron', 19),
(5, '13', 'Bouches-du-Rhône', 22),
(6, '14', 'Calvados', 4),
(7, '15', 'Cantal', 3),
(8, '16', 'Charente', 23),
(9, '17', 'Charente-Maritime', 23),
(10, '18', 'Cher', 8),
(11, '19', 'Corrèze', 15),
(12, '2', 'Aisne', 25),
(13, '21', 'Côte-d\'Or', 5),
(14, '22', 'Côtes-d\'Armor', 6),
(15, '23', 'Creuse', 15),
(16, '24', 'Dordogne', 2),
(17, '25', 'Doubs', 10),
(18, '26', 'Drôme', 27),
(19, '27', 'Eure', 13),
(20, '28', 'Eure-et-Loir', 8),
(21, '29', 'Finistère', 6),
(22, '2A', 'Corse-du-Sud', 9),
(23, '2B', 'Haute-Corse', 9),
(24, '3', 'Allier', 3),
(25, '30', 'Gard', 17),
(26, '31', 'Haute-Garonne', 19),
(27, '32', 'Gers', 19),
(28, '33', 'Gironde', 2),
(29, '34', 'Hérault', 17),
(30, '35', 'Ille-et-Vilaine', 6),
(31, '36', 'Indre', 8),
(32, '37', 'Indre-et-Loire', 8),
(33, '38', 'Isère', 27),
(34, '39', 'Jura', 10),
(35, '4', 'Alpes-de-Haute-Provence', 22),
(36, '40', 'Landes', 2),
(37, '41', 'Loir-et-Cher', 8),
(38, '42', 'Loire', 27),
(39, '43', 'Haute-Loire', 3),
(40, '44', 'Loire-Atlantique', 26),
(41, '45', 'Loiret', 8),
(42, '46', 'Lot', 19),
(43, '47', 'Lot-et-Garonne', 2),
(44, '48', 'Lozère', 17),
(45, '49', 'Maine-et-Loire', 26),
(46, '5', 'Hautes-Alpes', 22),
(47, '50', 'Manche', 4),
(48, '51', 'Marne', 7),
(49, '52', 'Haute-Marne', 7),
(50, '53', 'Mayenne', 26),
(51, '54', 'Meurthe-et-Moselle', 16),
(52, '55', 'Meuse', 16),
(53, '56', 'Morbihan', 6),
(54, '57', 'Moselle', 16),
(55, '58', 'Nièvre', 5),
(56, '59', 'Nord', 21),
(57, '6', 'Alpes-Maritimes', 22),
(58, '60', 'Oise', 25),
(59, '61', 'Orne', 4),
(60, '62', 'Pas-de-Calais', 21),
(61, '63', 'Puy-de-Dôme', 3),
(62, '64', 'Pyrénées-Atlantiques', 2),
(63, '65', 'Hautes-Pyrénées', 19),
(64, '66', 'Pyrénées-Orientales', 17),
(65, '67', 'Bas-Rhin', 1),
(66, '68', 'Haut-Rhin', 1),
(67, '69', 'Rhône', 27),
(68, '7', 'Ardèche', 27),
(69, '70', 'Haute-Saône', 10),
(70, '71', 'Saône-et-Loire', 5),
(71, '72', 'Sarthe', 26),
(72, '73', 'Savoie', 27),
(73, '74', 'Haute-Savoie', 27),
(74, '75', 'Paris', 14),
(75, '76', 'Seine-Maritime', 13),
(76, '77', 'Seine-et-Marne', 14),
(77, '78', 'Yvelines', 14),
(78, '79', 'Deux-Sèvres', 23),
(79, '8', 'Ardennes', 7),
(80, '80', 'Somme', 25),
(81, '81', 'Tarn', 19),
(82, '82', 'Tarn-et-Garonne', 19),
(83, '83', 'Var', 22),
(84, '84', 'Vaucluse', 22),
(85, '85', 'Vendée', 26),
(86, '86', 'Vienne', 23),
(87, '87', 'Haute-Vienne', 15),
(88, '88', 'Vosges', 16),
(89, '89', 'Yonne', 5),
(90, '9', 'Ariège', 19),
(91, '90', 'Territoire de Belfort', 10),
(92, '91', 'Essonne', 14),
(93, '92', 'Hauts-de-Seine', 14),
(94, '93', 'Seine-Saint-Denis', 14),
(95, '94', 'Val-de-Marne', 14),
(96, '95', 'Val-d\'Oise', 14),
(97, '971', 'Guadeloupe', 11),
(98, '972', 'Martinique', 18),
(99, '973', 'Guyanne', 12),
(100, '974', 'Réunion', 28),
(101, '987', 'Polynésie française', 24);

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

DROP TABLE IF EXISTS `paiement`;
CREATE TABLE IF NOT EXISTS `paiement` (
  `id` int(11) NOT NULL,
  `datePaiement` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `montantPaiement` decimal(7,2) DEFAULT NULL,
  `vente_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vente_id` (`vente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `paiement`
--

INSERT INTO `paiement` (`id`, `datePaiement`, `montantPaiement`, `vente_id`) VALUES
(1, '30-avr-18', '250.00', 1),
(2, '30-avr-18', '450.00', 2),
(3, '30-avr-18', '750.00', 3),
(4, '30-avr-18', '600.00', 4),
(5, '01-juin-18', '600.00', 5),
(6, '01-juin-18', '600.00', 6),
(7, '01-juin-18', '600.00', 7),
(8, '07-juil-18', '100.00', 8),
(9, '08-juil-18', '200.00', 9),
(10, '09-juil-18', '200.00', 10),
(11, '09-juil-18', '200.00', 11),
(12, '09-juil-18', '600.00', 12),
(13, '01-avr-18', '750.00', 13),
(14, '11-juil-18', '750.00', 14),
(15, '23-juil-18', '250.00', 15),
(16, '11-juil-18', '750.00', 16),
(17, '11-juil-18', '750.00', 17),
(18, '11-juil-18', '450.00', 18),
(19, '12-juil-18', '450.00', 19),
(20, '12-juil-18', '450.00', 20),
(21, '13-juil-18', '450.00', 21),
(22, '13-juil-18', '450.00', 22),
(23, '14-juil-18', '1000.00', 23),
(24, '14-juil-18', '600.00', 24),
(25, '15-juil-18', '600.00', 25),
(26, '15-juil-18', '600.00', 26),
(27, '15-juil-18', '600.00', 27),
(28, '19-juil-18', '350.00', 28),
(29, '20-juil-18', '400.00', 29),
(30, '20-juil-18', '400.00', 30),
(31, '21-juil-18', '400.00', 31),
(32, '22-juil-18', '300.00', 32),
(33, '22-juil-18', '300.00', 33),
(34, '26-juil-18', '300.00', 34),
(35, '26-juil-18', '250.00', 35),
(36, '26-juil-18', '300.00', 36),
(37, '26-juil-18', '250.00', 37),
(38, '26-juil-18', '150.00', 38),
(39, '02-janv-19', '150.00', 39),
(40, '02-janv-19', '200.00', 40),
(41, '01-mai-18', '750.00', 13),
(42, '23-juil-18', '750.00', 14),
(43, '11-juil-18', '750.00', 15),
(44, '20-juil-18', '750.00', 16),
(45, '01-juil-18', '100.00', 5),
(46, '30-mai-18', '250.00', 1),
(47, '30-mai-18', '100.00', 4),
(48, '07-août-18', '100.00', 8),
(49, '01-juil-18', '300.00', 6),
(50, '09-août-18', '100.00', 12),
(51, '14-août-18', '100.00', 12),
(52, '23-juil-18', '750.00', 17),
(53, '14-sept-18', '100.00', 24),
(54, '15-août-18', '100.00', 25),
(55, '15-août-18', '100.00', 27),
(56, '14-août-18', '200.00', 28),
(57, '19-août-18', '100.00', 98),
(58, '01-juil-18', '200.00', 7),
(59, '20-août-18', '100.00', 29),
(60, '20-août-18', '100.00', 30),
(61, '21-août-18', '100.00', 31),
(62, '11-août-18', '100.00', 18),
(63, '22-août-18', '100.00', 32),
(64, '12-août-18', '150.00', 19),
(65, '21-août-18', '100.00', 33),
(66, '01-sept-18', '100.00', 34),
(67, '01-sept-18', '50.00', 20),
(68, '01-sept-18', '50.00', 35),
(69, '01-oct-18', '100.00', 36),
(70, '01-oct-18', '100.00', 21),
(71, '01-juil-19', '100.00', 38),
(72, '01-déc-18', '200.00', 22),
(73, '01-juil-19', '100.00', 39),
(74, '30-juin-18', '250.00', 2),
(75, '01-juil-19', '50.00', 40),
(76, '01-août-18', '200.00', 5),
(77, '01-août-18', '200.00', 6),
(78, '01-août-18', '200.00', 7),
(79, '01-sept-18', '200.00', 7),
(80, '01-nov-18', '100.00', 21);

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `voyage_id` int(11) NOT NULL,
  `ip` varchar(15) COLLATE utf8_bin NOT NULL,
  `quantite` int(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `voyage_id` (`voyage_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id`, `voyage_id`, `ip`, `quantite`) VALUES
(1, 55, '127.0.0.1', 12);

-- --------------------------------------------------------

--
-- Structure de la table `premiercontact`
--

DROP TABLE IF EXISTS `premiercontact`;
CREATE TABLE IF NOT EXISTS `premiercontact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `premierContact` varchar(8) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `premiercontact`
--

INSERT INTO `premiercontact` (`id`, `premierContact`) VALUES
(1, 'Ami'),
(2, 'Autre'),
(3, 'Internet'),
(4, 'Radio');

-- --------------------------------------------------------

--
-- Structure de la table `province`
--

DROP TABLE IF EXISTS `province`;
CREATE TABLE IF NOT EXISTS `province` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `province` varchar(25) COLLATE utf8_bin DEFAULT NULL,
  `codeProvince` varchar(2) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `province` (`province`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `province`
--

INSERT INTO `province` (`id`, `province`, `codeProvince`) VALUES
(1, 'Alberta', 'AB'),
(2, 'Colombie-Britannique', 'BC'),
(3, 'Manitoba', 'MB'),
(4, 'Nouveau-Brunswick', 'NB'),
(5, 'Terre-Neuve-et-Labrador', 'NL'),
(6, 'Nouvelle-Écosse', 'NS'),
(7, 'Territoires du Nord-Ouest', 'NT'),
(8, 'Ontario', 'ON'),
(9, 'Île-du-Prince-Édouard', 'PE'),
(10, 'Québec', 'QC'),
(11, 'Saskatchewan', 'SK'),
(12, 'Territoires du Yukon', 'YT');

-- --------------------------------------------------------

--
-- Structure de la table `region`
--

DROP TABLE IF EXISTS `region`;
CREATE TABLE IF NOT EXISTS `region` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codeRegion` varchar(4) COLLATE utf8_bin NOT NULL,
  `nomRegion` varchar(35) COLLATE utf8_bin DEFAULT NULL,
  `typeRegion` varchar(3) COLLATE utf8_bin DEFAULT NULL,
  `ancienNom` varchar(26) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nomRegion` (`nomRegion`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `region`
--

INSERT INTO `region` (`id`, `codeRegion`, `nomRegion`, `typeRegion`, `ancienNom`) VALUES
(1, 'AL', 'Alsace-Champagne-Ardenne-Lorraine', 'MET', 'Alsace'),
(2, 'AQ', 'Aquitaine-Limousin-Poitou-Charentes', 'MET', 'Aquitaine'),
(3, 'AU', 'Auvergne-Rhône-Alpes', 'MET', 'Auvergne'),
(4, 'BN', 'Normandie', 'MET', 'Basse-Normandie'),
(5, 'BO', 'Bourgogne-Franche-Comté', 'MET', 'Bourgogne'),
(6, 'BR', 'Bretagne', 'MET', 'Bretagne'),
(7, 'CA', 'Alsace-Champagne-Ardenne-Lorraine', 'MET', 'Champagne-Ardenne'),
(8, 'CE', 'Centre-Val de Loire', 'MET', 'Centre'),
(9, 'CO', 'Corse', 'MET', 'Corse'),
(10, 'FC', 'Bourgogne-Franche-Comté', 'MET', 'Franche-Comté'),
(11, 'GD', 'Guadeloupe', 'ROM', 'Guadeloupe'),
(12, 'GN', 'Guyane', 'ROM', 'Guyane'),
(13, 'HN', 'Normandie', 'MET', 'Haute-Normandie'),
(14, 'IF', 'Île-de-France', 'MET', 'Île-de-France'),
(15, 'LI', 'Aquitaine-Limousin-Poitou-Charentes', 'MET', 'Limousin'),
(16, 'LO', 'Alsace-Champagne-Ardenne-Lorraine', 'MET', 'Lorraine'),
(17, 'LR', 'Languedoc-Roussillon-Midi-Pyrénées', 'MET', 'Languedoc-Roussillon'),
(18, 'MA', 'Martinique', 'ROM', 'Martinique'),
(19, 'MP', 'Languedoc-Roussillon-Midi-Pyrénées', 'MET', 'Midi-Pyrrénées'),
(20, 'MY', 'Mayotte', 'COM', 'Mayotte'),
(21, 'NPC', 'Nord-Pas-de-Calais-Picardie', 'MET', 'Nord-Pas de Calais'),
(22, 'PACA', 'Provence-Alpes-Côte d\'Azur', 'MET', 'Provence-Alpes-Côte d\'Azur'),
(23, 'PC', 'Aquitaine-Limousin-Poitou-Charentes', 'MET', 'Poitou-Charentes'),
(24, 'PF', 'Polynésie Française', 'COM', 'Polynésie Française'),
(25, 'PI', 'Nord-Pas-de-Calais-Picardie', 'MET', 'Picardie'),
(26, 'PL', 'Pays-de-la-Loire', 'MET', 'Pays-de-la-Loire'),
(27, 'RA', 'Auvergne-Rhône-Alpes', 'MET', 'Rhône-Alpes'),
(28, 'RE', 'La Réunion', 'ROM', 'La Réunion'),
(29, 'SB', 'Saint-Barthélemy', 'COM', 'Saint-Barthélemy'),
(30, 'SM', 'Saint-Martin', 'COM', 'Saint-Martin'),
(31, 'WF', 'Wallis et Futuna', 'COM', 'Wallis et Futuna');

-- --------------------------------------------------------

--
-- Structure de la table `vente`
--

DROP TABLE IF EXISTS `vente`;
CREATE TABLE IF NOT EXISTS `vente` (
  `id` int(11) NOT NULL,
  `dateVente` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `voyage_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`),
  KEY `voyage_id` (`voyage_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `vente`
--

INSERT INTO `vente` (`id`, `dateVente`, `client_id`, `voyage_id`) VALUES
(1, '30-avr-18', 6, 3),
(2, '30-mars-18', 32, 1),
(3, '31-mai-18', 34, 1),
(4, '01-juin-18', 6, 47),
(5, '01-juin-18', 4, 36),
(6, '01-juin-18', 8, 36),
(7, '01-juin-18', 15, 36),
(8, '07-juil-18', 6, 51),
(9, '08-juil-18', 7, 51),
(10, '09-juil-18', 8, 51),
(11, '09-juil-18', 9, 51),
(12, '09-juil-18', 9, 36),
(13, '11-juil-18', 1, 2),
(14, '11-juil-18', 2, 2),
(15, '11-juil-18', 3, 2),
(16, '11-juil-18', 5, 2),
(17, '11-juil-18', 11, 2),
(18, '11-juil-18', 19, 3),
(19, '12-juil-18', 21, 3),
(20, '12-juil-18', 24, 3),
(21, '13-juil-18', 28, 3),
(22, '13-juil-18', 30, 3),
(23, '14-juil-18', 10, 4),
(24, '14-juil-18', 11, 5),
(25, '15-juil-18', 12, 5),
(26, '15-juil-18', 13, 5),
(27, '15-juil-18', 14, 5),
(28, '19-juil-18', 15, 6),
(29, '20-juil-18', 16, 6),
(30, '20-juil-18', 17, 6),
(31, '21-juil-18', 18, 6),
(32, '22-juil-18', 20, 7),
(33, '22-juil-18', 22, 7),
(34, '26-juil-18', 23, 7),
(35, '26-juil-18', 25, 8),
(36, '26-juil-18', 26, 8),
(37, '26-juil-18', 27, 9),
(38, '26-juil-18', 29, 9),
(39, '27-mai-18', 31, 9),
(40, '27-mai-18', 33, 9),
(81, '11-juin-18', 3, 12),
(82, '11-mai-18', 4, 2),
(83, '11-juil-18', 5, 2),
(84, '01-juin-18', 6, 36),
(85, '11-juil-18', 15, 2),
(86, '30-avr-18', 16, 1),
(87, '01-juin-18', 16, 36),
(88, '07-juil-18', 16, 51),
(89, '08-juil-18', 17, 51),
(90, '01-juin-18', 18, 36),
(91, '09-juil-18', 19, 51),
(92, '09-juil-18', 11, 51),
(93, '09-juil-18', 12, 36),
(94, '14-juil-18', 13, 4),
(95, '11-juil-18', 14, 2),
(96, '14-juil-18', 15, 5),
(97, '15-juil-18', 17, 5),
(98, '15-juil-18', 35, 5),
(99, '15-juil-18', 34, 5),
(100, '01-juin-18', 30, 36),
(101, '19-juil-18', 31, 6),
(102, '20-juil-18', 32, 6),
(103, '20-juil-18', 33, 6),
(104, '21-juil-18', 25, 6),
(105, '11-juil-18', 26, 3),
(106, '22-juil-18', 27, 7),
(107, '12-juil-18', 29, 2),
(108, '22-juil-18', 28, 7),
(109, '26-juil-18', 21, 7),
(110, '12-juil-18', 22, 3),
(111, '26-juil-18', 23, 8),
(112, '26-juil-18', 24, 8),
(113, '30-juin-18', 25, 1),
(114, '13-juil-18', 29, 3),
(115, '26-juil-18', 15, 9),
(116, '13-juil-18', 16, 3),
(117, '27-mai-18', 17, 10),
(118, '30-mars-18', 6, 1),
(119, '27-mai-18', 12, 10),
(120, '30-avr-18', 19, 1),
(121, '01-août-18', 1, 53),
(122, '01-sept-18', 2, 44);

-- --------------------------------------------------------

--
-- Structure de la table `voyage`
--

DROP TABLE IF EXISTS `voyage`;
CREATE TABLE IF NOT EXISTS `voyage` (
  `id` int(11) NOT NULL,
  `nomVoyage` varchar(41) COLLATE utf8_bin DEFAULT NULL,
  `dateDebut` date DEFAULT NULL,
  `duree` int(2) DEFAULT NULL,
  `ville` varchar(24) COLLATE utf8_bin DEFAULT NULL,
  `prix` decimal(7,2) DEFAULT NULL,
  `departement_id` int(11) DEFAULT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nomVoyage` (`nomVoyage`),
  KEY `departement_id` (`departement_id`),
  KEY `categorie_id` (`categorie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `voyage`
--

INSERT INTO `voyage` (`id`, `nomVoyage`, `dateDebut`, `duree`, `ville`, `prix`, `departement_id`, `categorie_id`) VALUES
(1, 'Découverte marine', '2018-07-24', 7, 'Nice', '750.00', 57, 1),
(2, 'Club de plongée Baie de St-Jean', '2018-07-24', 6, 'Saint-Jean-Cap-Ferrat', '1500.00', 57, 1),
(3, 'Club de ski Cyclone', '2019-01-20', 7, 'Tarbes', '850.00', 63, 1),
(4, '6e Troupe de Scouts', '2019-01-31', 10, 'Lourdes', '1900.00', 63, 1),
(5, 'Jachères sauvages', '2019-03-05', 10, 'Arthès-de-Béarn', '1200.00', 62, 1),
(6, 'Réunion familiale Rizières', '2019-03-29', 7, 'Saintes-Maries de la Mer', '700.00', 5, 4),
(7, 'Club de ski Aéronautes', '2019-03-31', 7, 'Châtel', '600.00', 73, 1),
(8, 'Réunion de la famille Lavoie-Mercier', '2019-06-30', 7, 'Bonifacio', '500.00', 22, 4),
(9, 'Séjours séniors en forme', '2019-07-08', 4, 'Bastia', '250.00', 23, 1),
(10, 'Troupe de dance Flamenco', '2018-06-10', 5, 'Arles', '550.00', 5, 7),
(11, 'Omaha Alpha Phi', '2018-06-17', 7, 'Dunkerke', '725.00', 57, 7),
(12, 'Mariage Barilla-Cavuto', '2018-06-17', 7, 'Foix', '825.00', 90, 4),
(13, 'Grands Aventuriers', '2018-06-23', 7, 'Privas', '575.00', 68, 1),
(14, 'Grimpeurs-randonneurs', '2018-06-30', 4, 'Morez', '400.00', 34, 7),
(15, 'Club de débat les Patriotes', '2018-06-30', 7, 'Paris', '605.00', 74, 7),
(16, 'Exploration des calanques', '2018-07-07', 7, 'Cassis', '655.00', 5, 1),
(17, 'Club de randonnée sauvage du Buech', '2018-07-07', 7, 'Aspres-sur-Buech', '695.00', 46, 1),
(18, 'Paradis tropical', '2018-07-07', 7, 'Antibes', '595.00', 57, 1),
(19, 'Découverte de Nous', '2018-07-14', 5, 'Moustier', '550.00', 83, 1),
(20, 'Réserve naturelle de Scandolo', '2018-07-17', 7, 'Porto', '700.00', 23, 1),
(21, 'Vagues idéales', '2018-07-17', 5, 'Capbreton', '500.00', 36, 1),
(22, 'Jeunes forestiers bénévoles', '2018-07-15', 7, 'Orcines', '395.00', 61, 2),
(23, 'Jeunes bénévoles de Saint-Denis', '2018-07-17', 7, 'Saint-Denis', '425.00', 100, 2),
(24, 'Association des jeunes d\'Emmanuelle', '2018-07-19', 7, 'Paris', '500.00', 74, 2),
(25, 'Mariage Metayer-Michel', '2018-07-20', 3, 'Papeete', '300.00', 101, 4),
(26, 'Réunion de la famille Merlot', '2018-07-20', 3, 'Hyacinthe', '350.00', 98, 4),
(27, 'Réunion de la famille Barchon', '2018-07-20', 4, 'Les Anses d\'Arlet', '395.00', 98, 4),
(28, 'Pays de l\'or', '2018-07-31', 14, 'Saint-Girons', '1200.00', 90, 5),
(29, 'Mystères du Rhône', '2018-08-01', 7, 'Lyon', '800.00', 67, 5),
(30, 'Jazz à Juan-les-Pins', '2018-07-31', 7, 'Juan-les-Pins', '890.00', 57, 5),
(31, 'Cinq jours au Paradis', '2019-08-08', 5, 'Hatiheu (Nuku Hiva)', '1600.00', 101, 5),
(32, 'Magazinage sur les Champs-Élysées', '2018-09-11', 7, 'Paris', '1000.00', 74, 5),
(33, 'Architecture coloniale en Guyane', '2018-09-06', 14, 'Saint-Laurent-du-Maroni', '3000.00', 99, 5),
(34, 'Visites du patrimoine de la Liberté', '2018-09-11', 7, 'Paris', '1000.00', 74, 5),
(35, 'Héritage de la noblesse européenne', '2018-09-11', 7, 'Versailles', '1200.00', 77, 5),
(36, 'Musée de volcanologie', '2018-10-02', 7, 'Saint-Denis', '800.00', 100, 5),
(37, 'Fondation pour la préservation de l\'eau', '2018-10-09', 14, 'Rueil-Malmaison', '1300.00', 93, 5),
(38, 'La Nef des Sciences', '2018-08-07', 7, 'Mulhouse', '1000.00', 66, 5),
(39, 'Laboratoire forestier de l\'Ébène vert', '2018-10-17', 14, 'Cambrouze', '1500.00', 99, 5),
(40, 'Musée de préhistoire des gorges du Verdon', '2018-11-06', 10, 'Quinson', '900.00', 35, 7),
(41, 'Échanges en langue française', '2018-09-06', 7, 'Brest', '800.00', 21, 7),
(42, 'Échanges culturels Francophonie-Chine', '2018-09-06', 4, 'Limoges', '424.00', 87, 3),
(43, 'Aventures à la Vallée des Ours', '2018-09-06', 7, 'Arbas', '725.00', 26, 1),
(44, 'Club de randonnée du Mouton noir', '2018-09-13', 4, 'Ajaccio', '525.00', 22, 1),
(45, 'Oueds et Rios radeau', '2018-07-31', 4, 'Guillestre', '455.00', 46, 1),
(46, 'Amicale de dépollution du Mont-Blanc', '2018-08-07', 14, 'Chamonix Mont Blanc', '1100.00', 73, 2),
(47, 'Les bâtisseurs de villages perdus', '2016-08-01', 10, 'Lamothe', '950.00', 36, 2),
(48, 'Viaduc de Millau', '2018-07-31', 10, 'Milleau', '1400.00', 4, 3),
(50, 'Les grands musées d\'art et d\'histoire', '2018-08-07', 9, 'Paris', '800.00', 74, 5),
(51, 'Club de randonnée des canyons du Verdon', '2016-01-08', 7, 'Esparron de Verdon', '950.00', 35, 1),
(52, 'Visite de Paris, vue de la Seine', '2018-12-19', 4, 'Paris', '700.00', 74, 7),
(53, 'Séjour de pèche en rivière d\'altitude', '2018-08-31', 7, 'Cazères', '1400.00', 26, 1),
(54, 'Traversée de la Baie du Mont St-Michel', '2019-10-25', 4, 'Le Mont St-Michel', '500.00', 47, 7),
(55, 'Feux d\'artifice du 1er aout', '2019-07-31', 3, 'Châtel', '300.00', 73, 7),
(56, 'Conservatoire du Saumon', '2019-05-05', 4, 'Chanteuges', '800.00', 39, 1),
(57, 'La Venise des Alpes', '2019-07-04', 3, 'Annecy', '500.00', 73, 7),
(58, 'Croisière épique en Méditerranée', '2019-08-01', 10, 'Marseille', '2000.00', 5, 1),
(59, 'Rapaces du Puy-de-Dôme', '2019-01-09', 7, 'Orcines', '700.00', 61, 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `client_ibfk_1` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`),
  ADD CONSTRAINT `client_ibfk_2` FOREIGN KEY (`premierContact_id`) REFERENCES `premiercontact` (`id`);

--
-- Contraintes pour la table `departement`
--
ALTER TABLE `departement`
  ADD CONSTRAINT `departement_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`);

--
-- Contraintes pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD CONSTRAINT `paiement_ibfk_1` FOREIGN KEY (`vente_id`) REFERENCES `vente` (`id`);

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`voyage_id`) REFERENCES `voyage` (`id`);

--
-- Contraintes pour la table `vente`
--
ALTER TABLE `vente`
  ADD CONSTRAINT `vente_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`),
  ADD CONSTRAINT `vente_ibfk_2` FOREIGN KEY (`voyage_id`) REFERENCES `voyage` (`id`);

--
-- Contraintes pour la table `voyage`
--
ALTER TABLE `voyage`
  ADD CONSTRAINT `voyage_ibfk_1` FOREIGN KEY (`departement_id`) REFERENCES `departement` (`id`),
  ADD CONSTRAINT `voyage_ibfk_2` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
