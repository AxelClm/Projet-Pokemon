-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 13, 2019 at 02:46 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `***REMOVED***`
--

-- --------------------------------------------------------

--
-- Table structure for table `Capacite`
--

CREATE TABLE `Capacite` (
  `Num` int(11) NOT NULL,
  `Nom` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Type` int(11) NOT NULL,
  `Type_capacite` int(11) NOT NULL,
  `Puissance` int(11) DEFAULT NULL,
  `Pourcentage_Precision` int(11) DEFAULT NULL,
  `PP` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Capacite`
--

INSERT INTO `Capacite` (`Num`, `Nom`, `Type`, `Type_capacite`, `Puissance`, `Pourcentage_Precision`, `PP`) VALUES
(1, 'Balayage', 2, 1, 50, 100, 20),
(2, 'Double-pied', 2, 1, 30, 100, 30),
(3, 'Frappe Atlas', 2, 1, 0, 85, 15),
(4, 'Mawashi Geri', 2, 1, 60, 85, 15),
(5, 'Pied Sauté', 2, 1, 70, 95, 10),
(6, 'Pied Voltige', 2, 1, 85, 90, 10),
(7, 'Riposte', 2, 1, 0, 100, 20),
(8, 'Sacrifice', 2, 1, 80, 80, 25),
(9, 'Poing-Karaté', 10, 1, 50, 100, 25),
(10, 'Draco-Rage', 3, 2, 0, 100, 10),
(11, 'Bulle d\'O', 4, 2, 65, 100, 20),
(12, 'Cascade', 4, 2, 80, 100, 15),
(13, 'Claquoir', 4, 2, 35, 85, 15),
(14, 'Écume', 4, 2, 20, 100, 30),
(15, 'Hydrocanon', 4, 2, 120, 80, 5),
(16, 'Pince-Masse', 4, 2, 90, 85, 10),
(17, 'Pistolet à O', 4, 2, 40, 100, 25),
(18, 'Repli', 4, 3, 0, 0, 40),
(19, 'Surf', 4, 2, 95, 100, 15),
(20, 'Cage-Éclair', 5, 3, 0, 100, 20),
(21, 'Éclair', 5, 2, 40, 100, 30),
(22, 'Fatal-Foudre', 5, 2, 120, 70, 10),
(23, 'Poing-Éclair', 5, 2, 75, 100, 15),
(24, 'Tonnerre', 5, 2, 95, 100, 15),
(25, 'Danse Flamme', 7, 2, 15, 70, 15),
(26, 'Déflagration', 7, 2, 120, 85, 5),
(27, 'Flammèche', 7, 2, 40, 100, 25),
(28, 'Lance-Flammes', 7, 2, 95, 100, 15),
(29, 'Poing de Feu', 7, 2, 75, 100, 15),
(30, 'Blizzard', 8, 2, 120, 90, 5),
(31, 'Brume', 8, 3, 0, 0, 30),
(32, 'Buée Noire', 8, 3, 0, 0, 30),
(33, 'Laser Glace', 8, 2, 95, 100, 10),
(34, 'Onde Boréale', 8, 2, 65, 100, 20),
(35, 'Poing-Glace', 8, 2, 75, 100, 15),
(36, 'Dard-Nuée', 9, 1, 14, 85, 20),
(37, 'Double-Dard', 9, 1, 25, 100, 20),
(38, 'Sécrétion', 9, 3, 0, 95, 40),
(39, 'Vampirisme', 9, 1, 80, 100, 15),
(40, 'Affûtage', 10, 3, 0, 0, 30),
(41, 'Armure', 10, 3, 0, 0, 30),
(42, 'Bélier', 10, 1, 90, 85, 20),
(43, 'Berceuse', 10, 3, 0, 85, 20),
(44, 'Bombe\'Oeuf', 10, 1, 100, 75, 10),
(45, 'Boule Armure', 10, 3, 0, 0, 40),
(46, 'Brouillard', 10, 3, 0, 100, 20),
(47, 'Charge', 10, 1, 50, 100, 30),
(48, 'Clônage', 10, 3, 0, 0, 10),
(49, 'Combo-Griffe', 10, 1, 18, 80, 15),
(50, 'Conversion', 10, 3, 0, 0, 30),
(51, 'Constriction', 10, 1, 10, 100, 35),
(52, 'Coud\'Krâne', 10, 1, 130, 100, 10),
(53, 'Copie', 10, 3, 0, 100, 10),
(54, 'Coup d\'Boule', 10, 1, 70, 100, 15),
(55, 'Coupe', 10, 1, 50, 95, 30),
(56, 'Coupe-Vent', 10, 2, 80, 100, 10),
(57, 'Croc de Mort', 10, 1, 80, 90, 15),
(58, 'Croc Fatal', 10, 1, 0, 90, 10),
(59, 'Croissance', 10, 3, 0, 0, 20),
(60, 'Cyclone', 10, 3, 0, 100, 20),
(61, 'Damoclès', 10, 1, 120, 100, 15),
(62, 'Danse-Lames', 10, 3, 0, 0, 20),
(63, 'Destruction', 10, 1, 200, 100, 5),
(64, 'E-Coque', 10, 3, 0, 100, 10),
(65, 'Écrasement', 10, 1, 65, 100, 20),
(66, 'Écras\'Face', 10, 1, 40, 100, 35),
(67, 'Empal\'Korne', 10, 1, 0, 0, 5),
(68, 'Entrave', 10, 3, 0, 100, 20),
(69, 'Étreinte', 10, 1, 15, 85, 20),
(70, 'Explosion', 10, 1, 250, 100, 5),
(71, 'Flash', 10, 3, 0, 100, 20),
(72, 'Force', 10, 1, 80, 100, 15),
(73, 'Force Poigne', 10, 1, 55, 100, 30),
(74, 'Frénésie', 10, 1, 20, 100, 20),
(75, 'Furie', 10, 1, 15, 85, 20),
(76, 'Griffe', 10, 1, 40, 100, 35),
(77, 'Grincement', 10, 3, 0, 85, 40),
(78, 'Grobisou', 10, 3, 0, 75, 10),
(79, 'Groz\'Yeux', 10, 3, 0, 100, 30),
(80, 'Guillotine', 10, 1, 0, 0, 5),
(81, 'Hurlement', 10, 3, 0, 100, 20),
(82, 'Jackpot', 10, 1, 40, 100, 20),
(83, 'Koud\'Korne', 10, 1, 65, 100, 25),
(84, 'Ligotage', 10, 1, 15, 90, 20),
(85, 'Lilliput', 10, 3, 0, 0, 10),
(86, 'Lutte', 10, 1, 50, 100, 0),
(87, 'Mania', 10, 1, 120, 100, 10),
(88, 'Météores', 10, 2, 60, 0, 20),
(89, 'Métronome', 10, 3, 0, 0, 10),
(90, 'Mimi-Queue', 10, 3, 0, 100, 30),
(91, 'Morphing', 10, 3, 0, 0, 10),
(92, 'Patience', 10, 1, 0, 100, 10),
(93, 'Picanon', 10, 1, 20, 100, 15),
(94, 'Pilonage', 10, 1, 15, 85, 20),
(95, 'Poing Comète', 10, 1, 18, 85, 15),
(96, 'Puissance', 10, 3, 0, 0, 30),
(97, 'Reflet', 10, 3, 0, 0, 15),
(98, 'Regard Médusant', 10, 3, 0, 100, 30),
(99, 'Rugissement', 10, 3, 0, 100, 40),
(100, 'Soin', 10, 3, 0, 0, 10),
(101, 'Sonic Boom', 10, 2, 0, 90, 20),
(102, 'Souplesse', 10, 1, 80, 75, 20),
(103, 'Torgnole', 10, 1, 15, 85, 10),
(104, 'Tranche', 10, 1, 70, 100, 20),
(105, 'Trempette', 10, 3, 0, 0, 40),
(106, 'Triplattaque', 10, 2, 80, 100, 10),
(107, 'Ultimapoing', 10, 1, 80, 85, 20),
(108, 'Ultimawashi', 10, 1, 120, 75, 5),
(109, 'Ultralaser', 10, 2, 150, 90, 5),
(110, 'Ultrason', 10, 3, 0, 55, 20),
(111, 'Uppercut', 10, 1, 70, 100, 10),
(112, 'Vive-Attaque', 10, 1, 40, 100, 30),
(113, 'Danse-Fleur', 11, 2, 120, 100, 10),
(114, 'Fouet Lianes', 11, 1, 45, 100, 25),
(115, 'Lance-Soleil', 11, 2, 200, 100, 10),
(116, 'Méga-Sansue', 11, 2, 40, 100, 15),
(117, 'Para-Spore', 11, 3, 0, 75, 30),
(118, 'Poudre Dodo', 11, 3, 0, 75, 15),
(119, 'Spore', 11, 3, 0, 100, 15),
(120, 'Tranche-Herbe', 11, 1, 55, 95, 25),
(121, 'Vampigraine', 11, 3, 0, 90, 10),
(122, 'Vol-Vie', 11, 2, 20, 100, 25),
(123, 'Acidarmure', 12, 3, 0, 0, 20),
(124, 'Acide', 12, 2, 40, 100, 30),
(125, 'Dard-Venin', 12, 1, 20, 100, 35),
(126, 'Détritus', 12, 2, 65, 100, 20),
(127, 'Gaz Toxik', 12, 3, 0, 90, 40),
(128, 'Poudre Toxik', 12, 3, 0, 75, 35),
(129, 'Purédpois', 12, 2, 30, 70, 20),
(130, 'Toxik', 12, 3, 0, 90, 10),
(131, 'Amnésie', 13, 3, 0, 0, 20),
(132, 'Bouclier', 13, 3, 0, 0, 20),
(133, 'Choc Mental', 13, 2, 50, 100, 25),
(134, 'Dévorêve', 13, 2, 100, 100, 15),
(135, 'Hâte', 13, 3, 0, 0, 30),
(136, 'Hypnose', 13, 3, 0, 60, 20),
(137, 'Mur Lumière', 13, 3, 0, 0, 30),
(138, 'Protection', 13, 3, 0, 0, 20),
(139, 'Psyko', 13, 2, 65, 100, 20),
(140, 'Rafale Psy', 13, 2, 65, 100, 20),
(141, 'Repos', 13, 3, 0, 0, 10),
(142, 'Télékinésie', 13, 3, 0, 0, 15),
(143, 'Téléport', 13, 3, 0, 0, 20),
(144, 'Vague Psy', 13, 2, 0, 100, 15),
(145, 'Yoga', 13, 3, 0, 0, 40),
(146, 'Éboulement', 14, 1, 75, 90, 10),
(147, 'Jet-Pierres', 14, 1, 50, 90, 15),
(148, 'Abîme', 15, 1, 0, 0, 5),
(149, 'Massd\'Os', 15, 1, 65, 85, 20),
(150, 'Osmerang', 15, 1, 50, 90, 100),
(151, 'Séisme', 15, 1, 100, 100, 10),
(152, 'Tunnel', 15, 1, 80, 100, 10),
(153, 'Jet de Sable', 15, 3, 0, 100, 15),
(154, 'Léchouille', 16, 1, 30, 100, 30),
(155, 'Ombre Nocturne', 16, 2, 0, 100, 15),
(156, 'Onde Folie', 16, 3, 0, 100, 10),
(157, 'Morsure', 17, 1, 60, 100, 25),
(158, 'Bec Vrille', 18, 1, 80, 100, 20),
(159, 'Cru-Aile', 18, 1, 60, 100, 35),
(160, 'Mimique', 18, 3, 0, 0, 20),
(161, 'Picpic', 18, 1, 35, 100, 35),
(162, 'Piqué', 18, 1, 140, 90, 5),
(163, 'Vol', 18, 1, 90, 95, 15),
(164, 'Tornade', 18, 2, 10, 100, 35),
(165, 'Plaquage', 10, 1, 85, 100, 15);

-- --------------------------------------------------------

--
-- Table structure for table `Evolution_spéciale`
--

CREATE TABLE `Evolution_spéciale` (
  `Num_Pokemon` int(11) NOT NULL,
  `Num_Objet` int(11) NOT NULL,
  `Evolve_num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Evolution_spéciale`
--

INSERT INTO `Evolution_spéciale` (`Num_Pokemon`, `Num_Objet`, `Evolve_num`) VALUES
(25, 4, 26),
(30, 5, 31),
(33, 5, 34),
(35, 5, 36);

-- --------------------------------------------------------

--
-- Table structure for table `Faiblesse_et_Resistances`
--

CREATE TABLE `Faiblesse_et_Resistances` (
  `Type_defensif` int(11) NOT NULL,
  `Type_offensif` int(11) NOT NULL,
  `Multiplicateur` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Faiblesse_et_Resistances`
--

INSERT INTO `Faiblesse_et_Resistances` (`Type_defensif`, `Type_offensif`, `Multiplicateur`) VALUES
(1, 1, 0.5),
(1, 2, 2),
(1, 3, 0.5),
(1, 4, 1),
(1, 5, 1),
(1, 6, 0.5),
(1, 7, 2),
(1, 8, 0.5),
(1, 9, 0.5),
(1, 10, 0.5),
(1, 11, 0.5),
(1, 12, 0),
(1, 13, 0.5),
(1, 14, 0.5),
(1, 15, 2),
(1, 16, 1),
(1, 17, 1),
(1, 18, 0.5),
(2, 1, 1),
(2, 2, 1),
(2, 3, 1),
(2, 4, 1),
(2, 5, 1),
(2, 6, 2),
(2, 7, 1),
(2, 8, 1),
(2, 9, 0.5),
(2, 10, 1),
(2, 11, 1),
(2, 12, 1),
(2, 13, 2),
(2, 14, 0.5),
(2, 15, 1),
(2, 16, 1),
(2, 17, 0.5),
(2, 18, 2),
(3, 1, 1),
(3, 2, 1),
(3, 3, 2),
(3, 4, 0.5),
(3, 5, 0.5),
(3, 6, 2),
(3, 7, 0.5),
(3, 8, 2),
(3, 9, 1),
(3, 10, 1),
(3, 11, 0.5),
(3, 12, 1),
(3, 13, 1),
(3, 14, 1),
(3, 15, 1),
(3, 16, 1),
(3, 17, 1),
(3, 18, 1),
(4, 1, 0.5),
(4, 2, 1),
(4, 3, 1),
(4, 4, 0.5),
(4, 5, 2),
(4, 6, 1),
(4, 7, 0.5),
(4, 8, 0.5),
(4, 9, 0.5),
(4, 10, 1),
(4, 11, 1),
(4, 12, 2),
(4, 13, 1),
(4, 14, 1),
(4, 15, 1),
(4, 16, 1),
(4, 17, 1),
(4, 18, 1),
(5, 1, 0.5),
(5, 2, 1),
(5, 3, 1),
(5, 4, 1),
(5, 5, 0.5),
(5, 6, 1),
(5, 7, 1),
(5, 8, 1),
(5, 9, 1),
(5, 10, 1),
(5, 11, 1),
(5, 12, 1),
(5, 13, 1),
(5, 14, 1),
(5, 15, 2),
(5, 16, 1),
(5, 17, 1),
(5, 18, 0.5),
(6, 1, 2),
(6, 2, 0.5),
(6, 3, 0),
(6, 4, 1),
(6, 5, 1),
(6, 6, 1),
(6, 7, 1),
(6, 8, 1),
(6, 9, 0.5),
(6, 10, 1),
(6, 11, 1),
(6, 12, 2),
(6, 13, 1),
(6, 14, 1),
(6, 15, 1),
(6, 16, 1),
(6, 17, 0.5),
(6, 18, 1),
(7, 1, 0.5),
(7, 2, 1),
(7, 3, 1),
(7, 4, 2),
(7, 5, 1),
(7, 6, 0.5),
(7, 7, 0.5),
(7, 8, 0.5),
(7, 9, 0.5),
(7, 10, 1),
(7, 11, 0.5),
(7, 12, 1),
(7, 13, 1),
(7, 14, 2),
(7, 15, 2),
(7, 16, 1),
(7, 17, 1),
(7, 18, 1),
(8, 1, 2),
(8, 2, 2),
(8, 3, 1),
(8, 4, 1),
(8, 5, 1),
(8, 6, 1),
(8, 7, 2),
(8, 8, 0.5),
(8, 9, 1),
(8, 10, 1),
(8, 11, 1),
(8, 12, 1),
(8, 13, 1),
(8, 14, 2),
(8, 15, 1),
(8, 16, 1),
(8, 17, 1),
(8, 18, 1),
(9, 1, 1),
(9, 2, 0.5),
(9, 3, 1),
(9, 4, 1),
(9, 5, 1),
(9, 6, 1),
(9, 7, 2),
(9, 8, 1),
(9, 9, 1),
(9, 10, 1),
(9, 11, 0.5),
(9, 12, 1),
(9, 13, 1),
(9, 14, 2),
(9, 15, 0.5),
(9, 16, 1),
(9, 17, 1),
(9, 18, 2),
(10, 1, 1),
(10, 2, 2),
(10, 3, 1),
(10, 4, 1),
(10, 5, 1),
(10, 6, 1),
(10, 7, 1),
(10, 8, 1),
(10, 9, 1),
(10, 10, 1),
(10, 11, 1),
(10, 12, 1),
(10, 13, 1),
(10, 14, 1),
(10, 15, 1),
(10, 16, 0),
(10, 17, 1),
(10, 18, 1),
(11, 1, 1),
(11, 2, 1),
(11, 3, 1),
(11, 4, 0.5),
(11, 5, 0.5),
(11, 6, 1),
(11, 7, 2),
(11, 8, 2),
(11, 9, 2),
(11, 10, 1),
(11, 11, 0.5),
(11, 12, 2),
(11, 13, 1),
(11, 14, 1),
(11, 15, 0.5),
(11, 16, 1),
(11, 17, 1),
(11, 18, 2),
(12, 1, 1),
(12, 2, 0.5),
(12, 3, 1),
(12, 4, 1),
(12, 5, 1),
(12, 6, 0.5),
(12, 7, 1),
(12, 8, 1),
(12, 9, 0.5),
(12, 10, 1),
(12, 11, 0.5),
(12, 12, 0.5),
(12, 13, 2),
(12, 14, 1),
(12, 15, 2),
(12, 16, 1),
(12, 17, 1),
(12, 18, 1),
(13, 1, 1),
(13, 2, 0.5),
(13, 3, 1),
(13, 4, 1),
(13, 5, 1),
(13, 6, 1),
(13, 7, 1),
(13, 8, 1),
(13, 9, 2),
(13, 10, 1),
(13, 11, 1),
(13, 12, 1),
(13, 13, 0.5),
(13, 14, 1),
(13, 15, 1),
(13, 16, 2),
(13, 17, 2),
(13, 18, 1),
(14, 1, 2),
(14, 2, 2),
(14, 3, 1),
(14, 4, 2),
(14, 5, 1),
(14, 6, 1),
(14, 7, 0.5),
(14, 8, 1),
(14, 9, 1),
(14, 10, 0.5),
(14, 11, 2),
(14, 12, 0.5),
(14, 13, 1),
(14, 14, 1),
(14, 15, 2),
(14, 16, 1),
(14, 17, 1),
(14, 18, 0.5),
(15, 1, 1),
(15, 2, 1),
(15, 3, 1),
(15, 4, 2),
(15, 5, 0),
(15, 6, 1),
(15, 7, 1),
(15, 8, 2),
(15, 9, 1),
(15, 10, 1),
(15, 11, 2),
(15, 12, 0.5),
(15, 13, 1),
(15, 14, 0.5),
(15, 15, 1),
(15, 16, 1),
(15, 17, 1),
(15, 18, 1),
(16, 1, 1),
(16, 2, 0),
(16, 3, 1),
(16, 4, 1),
(16, 5, 1),
(16, 6, 1),
(16, 7, 1),
(16, 8, 1),
(16, 9, 0.5),
(16, 10, 0),
(16, 11, 1),
(16, 12, 0.5),
(16, 13, 1),
(16, 14, 1),
(16, 15, 1),
(16, 16, 2),
(16, 17, 2),
(16, 18, 1),
(17, 1, 1),
(17, 2, 2),
(17, 3, 1),
(17, 4, 1),
(17, 5, 1),
(17, 6, 2),
(17, 7, 1),
(17, 8, 1),
(17, 9, 2),
(17, 10, 1),
(17, 11, 1),
(17, 12, 1),
(17, 13, 0),
(17, 14, 1),
(17, 15, 1),
(17, 16, 0.5),
(17, 17, 0.5),
(17, 18, 1),
(18, 1, 1),
(18, 2, 0.5),
(18, 3, 1),
(18, 4, 1),
(18, 5, 2),
(18, 6, 1),
(18, 7, 1),
(18, 8, 2),
(18, 9, 0.5),
(18, 10, 1),
(18, 11, 0.5),
(18, 12, 1),
(18, 13, 1),
(18, 14, 2),
(18, 15, 0),
(18, 16, 1),
(18, 17, 1),
(18, 18, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Objet_evolution`
--

CREATE TABLE `Objet_evolution` (
  `Num` int(11) NOT NULL,
  `Nom` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Objet_evolution`
--

INSERT INTO `Objet_evolution` (`Num`, `Nom`) VALUES
(1, 'Pierre Feu'),
(2, 'Pierre Eau'),
(3, 'Pierre Plante'),
(4, 'Pierre Foudre'),
(5, 'Pierre Lune'),
(6, 'Pierre Aube'),
(7, 'Pierre Nuit'),
(8, 'Pierre Éclat'),
(9, 'Pierre Bonheur'),
(10, 'Pierre Échange');

-- --------------------------------------------------------

--
-- Table structure for table `Pokemon`
--

CREATE TABLE `Pokemon` (
  `Num` int(11) NOT NULL,
  `Nom` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Type_1` int(11) NOT NULL,
  `Type_2` int(11) DEFAULT NULL,
  `Niveau_Evolution` int(11) DEFAULT NULL,
  `Evolution_par_événements` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Pokemon`
--

INSERT INTO `Pokemon` (`Num`, `Nom`, `Type_1`, `Type_2`, `Niveau_Evolution`, `Evolution_par_événements`) VALUES
(1, 'Bulbizarre', 11, 12, 16, NULL),
(2, 'Herbizarre', 11, 12, 32, NULL),
(3, 'Florizzare', 11, 12, NULL, NULL),
(4, 'Salamèche', 7, NULL, 16, NULL),
(5, 'Reptincel', 7, NULL, 36, NULL),
(6, 'Dracaufeu', 7, 18, NULL, NULL),
(7, 'Carapuce', 4, NULL, 16, NULL),
(8, 'Carabaffe', 4, NULL, 36, NULL),
(9, 'Tortank', 4, NULL, NULL, NULL),
(10, 'Chenipan', 9, NULL, 7, NULL),
(11, 'Chrysacier', 9, NULL, 10, NULL),
(12, 'Papilusion', 9, 18, NULL, NULL),
(13, 'Aspicot', 9, 12, 7, NULL),
(14, 'Coconfort', 9, 12, 10, NULL),
(15, 'Dardargnan', 9, 12, NULL, NULL),
(16, 'Roucool', 10, 18, 18, NULL),
(17, 'Roucoups', 10, 18, 36, NULL),
(18, 'Roucarnage', 10, 18, NULL, NULL),
(19, 'Rattata', 10, NULL, 20, NULL),
(20, 'Rattatac', 10, NULL, NULL, NULL),
(21, 'Piafabec', 10, 18, 20, NULL),
(22, 'Rapasdepic', 10, 18, NULL, NULL),
(23, 'Abo', 12, NULL, 22, NULL),
(24, 'Arbok', 12, NULL, NULL, NULL),
(25, 'Pikachu', 5, NULL, NULL, 1),
(26, 'Raichu', 5, NULL, NULL, NULL),
(27, 'Sabelette', 15, NULL, 22, NULL),
(28, 'Sablaireau', 15, NULL, NULL, NULL),
(29, 'Nidoran', 12, NULL, 16, NULL),
(30, 'Nidorina', 12, NULL, NULL, 1),
(31, 'Nidoqueen', 12, 15, NULL, NULL),
(32, 'Nidoran', 12, NULL, 16, NULL),
(33, 'Nidorino', 12, NULL, NULL, 1),
(34, 'Nidoking', 12, 15, NULL, NULL),
(35, 'Melofée', 6, NULL, NULL, 1),
(36, 'Mélodelfe', 6, NULL, NULL, NULL),
(37, 'Goupix', 7, NULL, NULL, 1),
(38, 'Feunard', 7, NULL, NULL, NULL),
(39, 'Rondoudou', 10, 6, NULL, 1),
(40, 'Grodoudou', 10, 6, NULL, NULL),
(41, 'Nosferapti', 12, 18, 22, NULL),
(42, 'Nosferalto', 12, 18, NULL, NULL),
(43, 'Mystherbe', 11, 12, 21, NULL),
(44, 'Ortide', 11, 12, NULL, 1),
(45, 'Rafflesia', 11, 12, NULL, NULL),
(46, 'Paras', 9, 11, 24, NULL),
(47, 'Parasect', 9, 11, NULL, NULL),
(48, 'Mimitoss', 9, 12, 31, NULL),
(49, 'Aéromite', 9, 12, NULL, NULL),
(50, 'Taupikeur', 15, NULL, 26, NULL),
(51, 'Triopikeur', 15, NULL, NULL, NULL),
(52, 'Miaouss', 10, NULL, 28, NULL),
(53, 'Persian', 10, NULL, NULL, NULL),
(54, 'Psykokwak', 4, NULL, 33, NULL),
(55, 'Akwakwak', 4, NULL, NULL, NULL),
(56, 'Férosinge', 2, NULL, 28, NULL),
(57, 'Colossinge', 2, NULL, NULL, NULL),
(58, 'Caninos', 7, NULL, NULL, 1),
(59, 'Arcanin', 7, NULL, NULL, NULL),
(60, 'Ptitard', 4, NULL, 25, NULL),
(61, 'Têtarte', 4, NULL, NULL, 1),
(62, 'Tartard', 4, 2, NULL, NULL),
(63, 'Abra', 13, NULL, 16, NULL),
(64, 'Kadabra', 13, NULL, NULL, 1),
(65, 'Alakazam', 13, NULL, NULL, NULL),
(66, 'Machoc', 2, NULL, 28, NULL),
(67, 'Machopeur', 2, NULL, NULL, 1),
(68, 'Mackogneur', 2, NULL, NULL, NULL),
(69, 'Chétiflor', 11, 12, 21, NULL),
(70, 'Boustiflor', 11, 12, NULL, 1),
(71, 'Empiflor', 11, 12, NULL, NULL),
(72, 'Tentacool', 4, 12, 30, NULL),
(73, 'Tentacruel', 4, 12, NULL, NULL),
(74, 'Racaillou', 14, 15, 25, NULL),
(75, 'Gravalanche', 14, 15, NULL, 1),
(76, 'Grolem', 14, 15, NULL, NULL),
(77, 'Ponyta', 7, NULL, 40, NULL),
(78, 'Galopa', 7, NULL, NULL, NULL),
(79, 'Ramoloss', 4, 13, 37, NULL),
(80, 'Flagadoss', 4, 13, NULL, NULL),
(81, 'Magnéti', 5, 1, 30, NULL),
(82, 'Magnéton', 5, 1, NULL, NULL),
(83, 'Canarticho', 10, 18, NULL, NULL),
(84, 'Doduo', 10, 18, 31, NULL),
(85, 'Dodrio', 10, 18, NULL, NULL),
(86, 'Otaria', 4, NULL, 34, NULL),
(87, 'Lamantine', 4, 8, NULL, NULL),
(88, 'Tadmorv', 12, NULL, 38, NULL),
(89, 'Grotadmorv', 12, NULL, NULL, NULL),
(90, 'Kokiyas', 4, NULL, NULL, 1),
(91, 'Crustabri', 4, 8, NULL, NULL),
(92, 'Fantominus', 16, 12, 25, NULL),
(93, 'Spectrum', 16, 12, NULL, 1),
(94, 'Ectoplasma', 16, 12, NULL, NULL),
(95, 'Onix', 14, 15, NULL, NULL),
(96, 'Soporifik', 13, NULL, 26, NULL),
(97, 'Hypnomade', 13, NULL, NULL, NULL),
(98, 'Krabby', 4, NULL, 28, NULL),
(99, 'Krabboss', 4, NULL, NULL, NULL),
(100, 'Voltorbe', 5, NULL, 30, NULL),
(101, 'Electrode', 5, NULL, NULL, NULL),
(102, 'Noeunoeuf', 11, 13, NULL, 1),
(103, 'Noadkoko', 11, 13, NULL, NULL),
(104, 'Osselait', 15, NULL, 28, NULL),
(105, 'Ossatueur', 15, NULL, NULL, NULL),
(106, 'Kicklee', 2, NULL, 20, NULL),
(107, 'Tygnon', 15, NULL, NULL, NULL),
(108, 'Excelangue', 10, NULL, NULL, NULL),
(109, 'Smogo', 12, NULL, 35, NULL),
(110, 'Smogogo', 12, NULL, NULL, NULL),
(111, 'Rhinocorne', 15, 14, 42, NULL),
(112, 'Rhinoféros', 15, 14, NULL, NULL),
(113, 'Leveinard', 10, NULL, NULL, NULL),
(114, 'Saquedeneu', 11, NULL, NULL, NULL),
(115, 'Kangourex', 10, NULL, NULL, NULL),
(116, 'Hypotrempe', 4, NULL, 32, NULL),
(117, 'Hyoicéan', 4, NULL, NULL, NULL),
(118, 'Poissiréne', 4, NULL, 33, NULL),
(119, 'Poissoroy', 4, NULL, NULL, NULL),
(120, 'Stari', 4, NULL, NULL, 1),
(121, 'Staross', 4, 13, NULL, NULL),
(122, 'M. Mime', 13, 6, NULL, NULL),
(123, 'Insécateur', 9, 18, NULL, NULL),
(124, 'Lippoutou', 8, 13, NULL, NULL),
(125, 'Elektek', 5, NULL, NULL, NULL),
(126, 'Magmar', 7, NULL, NULL, NULL),
(127, 'Scarabrute', 9, NULL, NULL, NULL),
(128, 'Tauros', 10, NULL, NULL, NULL),
(129, 'Magicarpe', 4, NULL, 20, NULL),
(130, 'Léviator', 4, 18, NULL, NULL),
(131, 'Lokhlass', 4, 8, NULL, NULL),
(132, 'Métamorph', 18, NULL, NULL, NULL),
(133, 'Evoli', 10, NULL, NULL, 1),
(134, 'Aquali', 4, NULL, NULL, NULL),
(135, 'Voltali', 5, NULL, NULL, NULL),
(136, 'Pyroli', 7, NULL, NULL, NULL),
(137, 'Porygon', 18, NULL, NULL, NULL),
(138, 'Amonita', 14, 4, 40, NULL),
(139, 'Amonistar', 14, 4, NULL, NULL),
(140, 'Kabuto', 14, 4, 40, NULL),
(141, 'Kabutops', 14, 4, NULL, NULL),
(142, 'Ptéra', 14, 4, NULL, NULL),
(143, 'Ronflex', 10, NULL, NULL, NULL),
(144, 'Artikodin', 8, 18, NULL, NULL),
(145, 'Electhor', 5, 18, NULL, NULL),
(146, 'Sulfura', 7, 18, NULL, NULL),
(147, 'Minidraco', 3, NULL, 30, NULL),
(148, 'Draco', 3, NULL, 55, NULL),
(149, 'Dracolosse', 3, 18, NULL, NULL),
(150, 'Mewtwo', 13, NULL, NULL, NULL),
(151, 'Mew', 13, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Types`
--

CREATE TABLE `Types` (
  `Num` int(11) NOT NULL,
  `Nom_Type` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Types`
--

INSERT INTO `Types` (`Num`, `Nom_Type`) VALUES
(1, 'Acier'),
(2, 'Combat'),
(3, 'Dragon'),
(4, 'Eau'),
(5, 'Électrik'),
(6, 'Fée'),
(7, 'Feu'),
(8, 'Glace'),
(9, 'Insecte'),
(10, 'Normal'),
(11, 'Plante'),
(12, 'Poison'),
(13, 'Psy'),
(14, 'Roche'),
(15, 'Sol'),
(16, 'Spectre'),
(17, 'Ténèbres'),
(18, 'Vol');

-- --------------------------------------------------------

--
-- Table structure for table `Types_de_Capacite`
--

CREATE TABLE `Types_de_Capacite` (
  `Num` int(11) NOT NULL,
  `Nom` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Types_de_Capacite`
--

INSERT INTO `Types_de_Capacite` (`Num`, `Nom`) VALUES
(1, 'Physique'),
(2, 'Spéciale'),
(3, 'Statut');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Capacite`
--
ALTER TABLE `Capacite`
  ADD PRIMARY KEY (`Num`),
  ADD KEY `Type` (`Type`),
  ADD KEY `Categorie` (`Type_capacite`);

--
-- Indexes for table `Evolution_spéciale`
--
ALTER TABLE `Evolution_spéciale`
  ADD PRIMARY KEY (`Num_Pokemon`,`Num_Objet`),
  ADD KEY `objet` (`Num_Objet`),
  ADD KEY `evolve` (`Evolve_num`);

--
-- Indexes for table `Faiblesse_et_Resistances`
--
ALTER TABLE `Faiblesse_et_Resistances`
  ADD PRIMARY KEY (`Type_defensif`,`Type_offensif`),
  ADD KEY `offensif` (`Type_offensif`);

--
-- Indexes for table `Objet_evolution`
--
ALTER TABLE `Objet_evolution`
  ADD PRIMARY KEY (`Num`);

--
-- Indexes for table `Pokemon`
--
ALTER TABLE `Pokemon`
  ADD PRIMARY KEY (`Num`),
  ADD KEY `Type_1` (`Type_1`),
  ADD KEY `Type_2` (`Type_2`);

--
-- Indexes for table `Types`
--
ALTER TABLE `Types`
  ADD PRIMARY KEY (`Num`);

--
-- Indexes for table `Types_de_Capacite`
--
ALTER TABLE `Types_de_Capacite`
  ADD PRIMARY KEY (`Num`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Capacite`
--
ALTER TABLE `Capacite`
  MODIFY `Num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT for table `Objet_evolution`
--
ALTER TABLE `Objet_evolution`
  MODIFY `Num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Pokemon`
--
ALTER TABLE `Pokemon`
  MODIFY `Num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `Types`
--
ALTER TABLE `Types`
  MODIFY `Num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `Types_de_Capacite`
--
ALTER TABLE `Types_de_Capacite`
  MODIFY `Num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Capacite`
--
ALTER TABLE `Capacite`
  ADD CONSTRAINT `Categorie` FOREIGN KEY (`Type_capacite`) REFERENCES `Types_de_Capacite` (`Num`),
  ADD CONSTRAINT `Type` FOREIGN KEY (`Type`) REFERENCES `Types` (`Num`);

--
-- Constraints for table `Evolution_spéciale`
--
ALTER TABLE `Evolution_spéciale`
  ADD CONSTRAINT `evolve` FOREIGN KEY (`Evolve_num`) REFERENCES `Pokemon` (`Num`),
  ADD CONSTRAINT `objet` FOREIGN KEY (`Num_Objet`) REFERENCES `Objet_evolution` (`Num`),
  ADD CONSTRAINT `pokemon` FOREIGN KEY (`Num_Pokemon`) REFERENCES `Pokemon` (`Num`);

--
-- Constraints for table `Faiblesse_et_Resistances`
--
ALTER TABLE `Faiblesse_et_Resistances`
  ADD CONSTRAINT `défensif` FOREIGN KEY (`Type_defensif`) REFERENCES `Types` (`Num`),
  ADD CONSTRAINT `offensif` FOREIGN KEY (`Type_offensif`) REFERENCES `Types` (`Num`);

--
-- Constraints for table `Pokemon`
--
ALTER TABLE `Pokemon`
  ADD CONSTRAINT `Type_1` FOREIGN KEY (`Type_1`) REFERENCES `Types` (`Num`),
  ADD CONSTRAINT `Type_2` FOREIGN KEY (`Type_2`) REFERENCES `Types` (`Num`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
