-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  jeu. 18 avr. 2019 à 10:35
-- Version du serveur :  10.1.34-MariaDB
-- Version de PHP :  7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `***REMOVED***`
--

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`***REMOVED***`@`%` PROCEDURE `Pokemon_swap_equipe` (IN `p_pokemon1` INT, IN `p_pokemon2` INT)  BEGIN
		SET @var1 = 0;
        SET @var2 = 0;
    	SELECT Pokemon_des_dresseurs.Place_dans_equipe INTO @var1 FROM Pokemon_des_dresseurs WHERE Pokemon_des_dresseurs.Id_pokemon = p_pokemon1;
    	SELECT Pokemon_des_dresseurs.Place_dans_equipe INTO @var2 FROM Pokemon_des_dresseurs WHERE Pokemon_des_dresseurs.Id_pokemon = p_pokemon2;
        UPDATE Pokemon_des_dresseurs SET Pokemon_des_dresseurs.Place_dans_equipe = @var2 WHERE Pokemon_des_dresseurs.Id_pokemon = p_pokemon1;
        UPDATE Pokemon_des_dresseurs SET Pokemon_des_dresseurs.Place_dans_equipe = @var1 WHERE Pokemon_des_dresseurs.Id_pokemon = p_pokemon2;
END$$

CREATE DEFINER=`***REMOVED***`@`%` PROCEDURE `pokemon_vers_boite` (IN `p_num_dresseur` INT, IN `p_pokemon1` INT)  BEGIN
	SET @var1 = 99;
    SET @var2 = 0;
    SELECT COUNT(Id_pokemon) INTO @var2 FROM Pokemon_des_dresseurs WHERE Num_dresseur = p_num_dresseur AND Equipe = 1;
    IF @var2 > 1
    THEN 
    SELECT Place_dans_equipe INTO @var1 FROM Pokemon_des_dresseurs WHERE Id_pokemon = p_pokemon1;
    UPDATE Pokemon_des_dresseurs SET Place_dans_equipe = null ,Equipe = 0 WHERE Id_pokemon = p_pokemon1;
    UPDATE Pokemon_des_dresseurs SET Place_dans_equipe = Place_dans_equipe - 1 WHERE Place_dans_equipe > @var1 AND Num_dresseur = p_num_dresseur;
    END IF;
END$$

CREATE DEFINER=`***REMOVED***`@`%` PROCEDURE `pokemon_vers_equipe` (IN `p_Num_pokemon` INT, IN `p_Num_dresseur` INT)  BEGIN
	SET @var0 = 0;
	SELECT COUNT(*) INTO @var0 FROM Pokemon_des_dresseurs WHERE Equipe = 1 AND Pokemon_des_dresseurs.Num_dresseur = p_Num_dresseur;
    IF @var0 <= 5
    THEN
    	UPDATE Pokemon_des_dresseurs SET Pokemon_des_dresseurs.Place_dans_equipe = @var0 + 1,Pokemon_des_dresseurs.Equipe = 1 WHERE Pokemon_des_dresseurs.Id_pokemon = p_Num_pokemon;
	END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `Capacite`
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
-- Déchargement des données de la table `Capacite`
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
-- Structure de la table `Evolution_spéciale`
--

CREATE TABLE `Evolution_spéciale` (
  `Num_Pokemon` int(11) NOT NULL,
  `Num_Objet` int(11) NOT NULL,
  `Evolve_num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `Evolution_spéciale`
--

INSERT INTO `Evolution_spéciale` (`Num_Pokemon`, `Num_Objet`, `Evolve_num`) VALUES
(25, 4, 26),
(30, 5, 31),
(33, 5, 34),
(35, 5, 36),
(37, 1, 38),
(39, 5, 40),
(44, 3, 45),
(58, 1, 59),
(61, 2, 62),
(64, 10, 65),
(67, 10, 68),
(70, 2, 71),
(75, 10, 76),
(90, 2, 91),
(93, 10, 94),
(102, 2, 103),
(120, 2, 121),
(133, 2, 134),
(133, 4, 135),
(133, 1, 136);

-- --------------------------------------------------------

--
-- Structure de la table `Faiblesse_et_Resistances`
--

CREATE TABLE `Faiblesse_et_Resistances` (
  `Type_defensif` int(11) NOT NULL,
  `Type_offensif` int(11) NOT NULL,
  `Multiplicateur` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `Faiblesse_et_Resistances`
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
-- Structure de la table `friends`
--

CREATE TABLE `friends` (
  `user` int(11) NOT NULL,
  `friend` int(11) NOT NULL,
  `accepte` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `friends`
--

INSERT INTO `friends` (`user`, `friend`, `accepte`) VALUES
(39, 41, 1),
(39, 42, 1),
(39, 43, 1),
(39, 44, 0),
(39, 46, 1),
(39, 47, 1),
(40, 70, NULL),
(41, 39, 1),
(42, 39, 1),
(43, 39, 1),
(44, 39, 0),
(46, 39, 1),
(47, 39, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Objets_des_dresseurs`
--

CREATE TABLE `Objets_des_dresseurs` (
  `num_dresseur` int(11) NOT NULL,
  `num_objet` int(11) NOT NULL,
  `qqte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `Objets_des_dresseurs`
--

INSERT INTO `Objets_des_dresseurs` (`num_dresseur`, `num_objet`, `qqte`) VALUES
(39, 12, 65),
(39, 13, 650),
(40, 12, 10),
(40, 13, 100),
(41, 12, 20),
(41, 13, 200),
(42, 12, 15),
(42, 13, 150),
(43, 12, 15),
(43, 13, 150),
(44, 12, 5),
(44, 13, 50),
(46, 12, 5),
(46, 13, 50),
(47, 12, 15),
(47, 13, 150),
(49, 12, 5),
(49, 13, 50),
(50, 12, 5),
(50, 13, 50),
(52, 12, 5),
(52, 13, 50),
(53, 12, 5),
(53, 13, 50),
(54, 12, 5),
(54, 13, 50),
(55, 12, 5),
(55, 13, 50),
(56, 12, 5),
(56, 13, 50),
(57, 12, 5),
(57, 13, 50),
(58, 12, 5),
(58, 13, 50),
(59, 12, 5),
(59, 13, 50),
(60, 12, 5),
(60, 13, 50),
(61, 12, 5),
(61, 13, 50),
(62, 12, 5),
(62, 13, 50),
(63, 12, 5),
(63, 13, 50),
(64, 12, 5),
(64, 13, 50),
(65, 12, 5),
(65, 13, 50),
(66, 12, 5),
(66, 13, 50),
(67, 12, 5),
(67, 13, 50),
(68, 12, 5),
(68, 13, 50),
(69, 12, 5),
(69, 13, 50),
(70, 12, 5),
(70, 13, 50);

-- --------------------------------------------------------

--
-- Structure de la table `Objet_evolution`
--

CREATE TABLE `Objet_evolution` (
  `Num` int(11) NOT NULL,
  `Nom` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `Objet_evolution`
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
(10, 'Pierre Échange'),
(11, 'Potion'),
(12, 'Pokeball'),
(13, 'Pokedollar');

-- --------------------------------------------------------

--
-- Structure de la table `Pokemon`
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
-- Déchargement des données de la table `Pokemon`
--

INSERT INTO `Pokemon` (`Num`, `Nom`, `Type_1`, `Type_2`, `Niveau_Evolution`, `Evolution_par_événements`) VALUES
(1, 'Bulbizarre', 11, 12, 16, NULL),
(2, 'Herbizarre', 11, 12, 32, NULL),
(3, 'Florizarre', 11, 12, NULL, NULL),
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
-- Structure de la table `Pokemon_des_dresseurs`
--

CREATE TABLE `Pokemon_des_dresseurs` (
  `Id_pokemon` int(11) NOT NULL,
  `Num_dresseur` int(11) DEFAULT NULL,
  `Num_pokemon` int(11) NOT NULL,
  `IV_PV` int(11) NOT NULL,
  `IV_Attaque` int(11) NOT NULL,
  `IV_Defense` int(11) NOT NULL,
  `IV_Attaque_Spe` int(11) NOT NULL,
  `IV_Defense_Spe` int(11) NOT NULL,
  `IV_Vitesse` int(11) NOT NULL,
  `Niveau` int(11) NOT NULL DEFAULT '1',
  `Equipe` tinyint(1) NOT NULL DEFAULT '0',
  `Place_dans_equipe` int(11) DEFAULT NULL,
  `degat_subis` int(11) NOT NULL DEFAULT '0',
  `experience` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `Pokemon_des_dresseurs`
--

INSERT INTO `Pokemon_des_dresseurs` (`Id_pokemon`, `Num_dresseur`, `Num_pokemon`, `IV_PV`, `IV_Attaque`, `IV_Defense`, `IV_Attaque_Spe`, `IV_Defense_Spe`, `IV_Vitesse`, `Niveau`, `Equipe`, `Place_dans_equipe`, `degat_subis`, `experience`) VALUES
(27, 39, 1, 20, 24, 24, 25, 8, 31, 1, 1, 2, 0, 0),
(28, 40, 7, 3, 25, 16, 9, 13, 9, 1, 1, NULL, 0, 0),
(29, 42, 4, 24, 5, 19, 16, 7, 25, 1, 1, NULL, 0, 0),
(30, 43, 4, 15, 7, 29, 22, 7, 30, 1, 1, NULL, 0, 0),
(31, 47, 4, 27, 27, 24, 7, 31, 0, 1, 1, 1, 0, 0),
(32, 39, 50, 10, 18, 25, 31, 10, 20, 1, 1, 3, 0, 0),
(33, 39, 12, 26, 27, 21, 29, 19, 21, 1, 1, 1, 0, 0),
(34, 39, 24, 30, 2, 28, 24, 16, 26, 1, 1, 4, 0, 0),
(35, 39, 89, 20, 22, 24, 19, 11, 30, 1, 1, 6, 0, 0),
(37, 39, 20, 4, 1, 7, 13, 17, 14, 1, 0, NULL, 0, 0),
(38, 39, 37, 31, 7, 0, 25, 23, 26, 1, 0, NULL, 0, 0),
(39, 49, 4, 12, 25, 10, 1, 22, 23, 1, 1, 1, 0, 0),
(40, 50, 8, 20, 2, 28, 28, 27, 14, 1, 1, 1, 0, 0),
(41, 52, 4, 6, 13, 17, 12, 2, 9, 1, 1, 1, 0, 0),
(42, 41, 4, 13, 20, 9, 7, 20, 16, 1, 1, 1, 0, 0),
(43, 53, 4, 14, 23, 31, 0, 29, 5, 1, 1, 1, 0, 0),
(44, 54, 8, 13, 18, 12, 3, 28, 14, 1, 1, 1, 0, 0),
(45, 55, 4, 30, 27, 6, 22, 12, 29, 1, 1, 1, 0, 0),
(46, 56, 1, 9, 17, 31, 3, 16, 22, 1, 1, 1, 0, 0),
(47, 57, 4, 19, 23, 5, 14, 30, 30, 1, 1, 1, 0, 0),
(48, 58, 4, 3, 7, 16, 5, 16, 18, 1, 1, 1, 0, 0),
(49, 59, 8, 28, 13, 2, 21, 23, 10, 1, 1, 1, 0, 0),
(50, 60, 4, 7, 1, 8, 23, 11, 15, 1, 1, 1, 0, 0),
(51, 61, 1, 8, 26, 21, 8, 23, 11, 1, 1, 1, 0, 0),
(52, 62, 1, 28, 2, 2, 30, 9, 1, 1, 1, 1, 0, 0),
(53, 63, 1, 23, 24, 2, 29, 1, 15, 1, 1, 1, 0, 0),
(54, 64, 4, 27, 16, 30, 20, 9, 23, 1, 1, 1, 0, 0),
(55, 65, 1, 8, 26, 26, 0, 0, 3, 1, 1, 1, 0, 0),
(56, 66, 4, 26, 6, 13, 6, 6, 23, 1, 1, 1, 0, 0),
(57, NULL, 1, 16, 29, 18, 7, 1, 29, 1, 1, 1, 0, 0),
(58, NULL, 7, 24, 30, 3, 27, 19, 30, 1, 1, 1, 0, 0),
(59, 67, 1, 20, 8, 30, 23, 19, 25, 1, 1, 1, 0, 0),
(60, 68, 1, 22, 11, 0, 5, 17, 2, 1, 1, 1, 0, 0),
(61, 44, 4, 24, 6, 11, 14, 16, 15, 1, 1, 1, 0, 0),
(62, 46, 7, 25, 28, 12, 29, 25, 20, 1, 1, 1, 0, 0),
(63, 69, 4, 29, 24, 25, 12, 28, 13, 1, 1, 1, 0, 0),
(64, 70, 1, 27, 0, 29, 19, 31, 13, 1, 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `Stat_basique_pokemon`
--

CREATE TABLE `Stat_basique_pokemon` (
  `Num` int(11) NOT NULL,
  `PV` int(11) NOT NULL,
  `Attaque` int(11) NOT NULL,
  `Defense` int(11) NOT NULL,
  `Attaque_Spe` int(11) NOT NULL,
  `Defense_Spe` int(11) NOT NULL,
  `Vitesse` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `Stat_basique_pokemon`
--

INSERT INTO `Stat_basique_pokemon` (`Num`, `PV`, `Attaque`, `Defense`, `Attaque_Spe`, `Defense_Spe`, `Vitesse`) VALUES
(1, 45, 49, 49, 65, 65, 45),
(2, 60, 62, 63, 80, 80, 60),
(3, 80, 82, 83, 100, 100, 80),
(4, 39, 52, 43, 60, 50, 65),
(5, 58, 64, 58, 80, 65, 80),
(6, 78, 84, 78, 109, 85, 100),
(7, 44, 48, 65, 50, 64, 43),
(8, 59, 63, 80, 65, 80, 58),
(9, 79, 83, 100, 85, 105, 78),
(10, 45, 30, 35, 20, 20, 45),
(11, 50, 20, 55, 25, 25, 30),
(12, 60, 45, 50, 90, 80, 70),
(13, 40, 35, 30, 20, 20, 50),
(14, 45, 25, 50, 25, 25, 35),
(15, 65, 90, 40, 45, 80, 75),
(16, 40, 45, 40, 35, 35, 56),
(17, 63, 60, 55, 50, 50, 71),
(18, 83, 80, 75, 70, 70, 101),
(19, 30, 56, 35, 25, 35, 72),
(20, 55, 81, 60, 50, 70, 97),
(21, 40, 60, 30, 31, 31, 70),
(22, 65, 90, 65, 61, 61, 100),
(23, 35, 60, 44, 40, 54, 55),
(24, 60, 95, 69, 65, 79, 80),
(25, 35, 55, 40, 50, 50, 90),
(26, 60, 90, 55, 90, 80, 110),
(27, 50, 75, 85, 20, 30, 40),
(28, 75, 100, 110, 45, 55, 65),
(29, 55, 47, 52, 40, 40, 41),
(30, 70, 62, 67, 55, 55, 56),
(31, 90, 92, 87, 75, 85, 76),
(32, 46, 57, 40, 40, 40, 50),
(33, 61, 72, 57, 55, 55, 65),
(34, 81, 102, 77, 85, 75, 85),
(35, 70, 45, 48, 60, 65, 35),
(36, 95, 70, 73, 95, 90, 60),
(37, 38, 41, 40, 50, 65, 65),
(38, 73, 76, 75, 81, 100, 100),
(39, 115, 45, 20, 45, 25, 20),
(40, 140, 70, 45, 85, 50, 45),
(41, 40, 45, 35, 30, 40, 55),
(42, 75, 80, 70, 65, 75, 90),
(43, 45, 50, 55, 75, 65, 30),
(44, 60, 65, 70, 85, 75, 40),
(45, 75, 80, 85, 110, 90, 50),
(46, 35, 70, 55, 45, 55, 25),
(47, 60, 95, 80, 60, 80, 30),
(48, 60, 55, 50, 40, 55, 45),
(49, 70, 65, 60, 90, 75, 90),
(50, 10, 55, 25, 35, 45, 95),
(51, 35, 100, 50, 50, 70, 120),
(52, 40, 45, 35, 40, 40, 90),
(53, 65, 70, 60, 65, 65, 115),
(54, 50, 52, 48, 65, 50, 55),
(55, 80, 82, 78, 95, 80, 85),
(56, 40, 80, 35, 35, 45, 70),
(57, 65, 105, 60, 60, 70, 95),
(58, 55, 70, 45, 70, 50, 60),
(59, 90, 110, 80, 100, 80, 95),
(60, 40, 50, 40, 40, 40, 90),
(61, 65, 65, 65, 50, 50, 90),
(62, 90, 95, 95, 70, 90, 70),
(63, 25, 20, 15, 105, 55, 90),
(64, 40, 35, 30, 120, 70, 105),
(65, 55, 50, 45, 135, 95, 120),
(66, 70, 80, 50, 35, 35, 35),
(67, 80, 100, 70, 50, 60, 45),
(68, 90, 130, 80, 65, 85, 55),
(69, 50, 75, 35, 70, 30, 40),
(70, 65, 90, 50, 85, 45, 55),
(71, 80, 105, 65, 100, 70, 70),
(72, 40, 40, 35, 50, 100, 70),
(73, 80, 70, 65, 80, 120, 100),
(74, 40, 80, 100, 30, 30, 20),
(75, 55, 95, 115, 45, 45, 35),
(76, 80, 120, 130, 55, 65, 45),
(77, 50, 85, 55, 65, 65, 90),
(78, 65, 100, 70, 80, 80, 105),
(79, 90, 65, 65, 40, 40, 15),
(80, 95, 75, 110, 100, 80, 30),
(81, 25, 35, 70, 95, 55, 45),
(82, 50, 60, 95, 120, 70, 70),
(83, 52, 90, 55, 58, 62, 60),
(84, 35, 85, 45, 35, 35, 75),
(85, 60, 110, 70, 60, 60, 110),
(86, 65, 45, 55, 45, 70, 45),
(87, 90, 70, 80, 70, 95, 70),
(88, 80, 80, 50, 40, 50, 25),
(89, 105, 105, 75, 65, 100, 50),
(90, 30, 65, 100, 45, 25, 40),
(91, 50, 95, 180, 85, 45, 70),
(92, 30, 35, 30, 100, 35, 80),
(93, 45, 50, 45, 115, 55, 95),
(94, 60, 65, 60, 130, 75, 110),
(95, 35, 45, 160, 30, 45, 70),
(96, 60, 48, 45, 43, 90, 42),
(97, 85, 73, 70, 73, 115, 67),
(98, 30, 105, 90, 25, 25, 50),
(99, 55, 130, 115, 50, 50, 75),
(100, 40, 30, 50, 55, 55, 100),
(101, 60, 50, 70, 80, 80, 150),
(102, 60, 40, 80, 60, 45, 40),
(103, 95, 95, 85, 125, 75, 65),
(104, 50, 50, 95, 40, 50, 35),
(105, 60, 80, 110, 50, 80, 45),
(106, 50, 120, 53, 35, 110, 87),
(107, 50, 105, 79, 35, 110, 76),
(108, 90, 55, 75, 60, 75, 30),
(109, 40, 65, 95, 60, 45, 35),
(110, 65, 90, 120, 85, 70, 60),
(111, 80, 85, 95, 30, 30, 25),
(112, 105, 130, 120, 45, 45, 40),
(113, 250, 5, 5, 35, 105, 50),
(114, 65, 55, 115, 100, 40, 60),
(115, 105, 95, 80, 40, 80, 90),
(116, 30, 40, 70, 70, 25, 60),
(117, 55, 55, 65, 95, 45, 85),
(118, 45, 67, 60, 35, 50, 63),
(119, 80, 92, 65, 65, 80, 68),
(120, 30, 45, 55, 70, 55, 85),
(121, 60, 75, 85, 100, 85, 115),
(122, 0, 40, 45, 65, 100, 120),
(123, 70, 110, 80, 55, 80, 105),
(124, 65, 50, 35, 115, 95, 95),
(125, 65, 83, 57, 95, 85, 105),
(126, 65, 95, 57, 100, 85, 93),
(127, 65, 125, 100, 55, 70, 85),
(128, 75, 100, 95, 40, 70, 110),
(129, 20, 10, 55, 15, 20, 80),
(130, 95, 125, 79, 60, 100, 81),
(131, 130, 85, 80, 85, 95, 60),
(132, 48, 48, 48, 48, 48, 48),
(133, 55, 55, 50, 45, 65, 55),
(134, 130, 65, 60, 110, 95, 65),
(135, 65, 65, 60, 110, 95, 130),
(136, 65, 130, 60, 95, 110, 65),
(137, 65, 60, 70, 85, 75, 40),
(138, 35, 40, 100, 90, 55, 35),
(139, 70, 60, 125, 115, 70, 55),
(140, 30, 80, 90, 55, 45, 55),
(141, 60, 115, 105, 65, 70, 80),
(142, 80, 105, 65, 60, 75, 130),
(143, 160, 110, 65, 65, 110, 30),
(144, 90, 85, 100, 95, 125, 85),
(145, 90, 90, 85, 125, 90, 100),
(146, 90, 100, 90, 125, 85, 90),
(147, 41, 64, 45, 50, 50, 50),
(148, 61, 84, 65, 70, 70, 70),
(149, 91, 134, 95, 100, 100, 80),
(150, 106, 110, 90, 154, 90, 130),
(151, 100, 100, 100, 100, 100, 100);

-- --------------------------------------------------------

--
-- Structure de la table `Types`
--

CREATE TABLE `Types` (
  `Num` int(11) NOT NULL,
  `Nom_Type` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `Types`
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
-- Structure de la table `Types_de_Capacite`
--

CREATE TABLE `Types_de_Capacite` (
  `Num` int(11) NOT NULL,
  `Nom` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `Types_de_Capacite`
--

INSERT INTO `Types_de_Capacite` (`Num`, `Nom`) VALUES
(1, 'Physique'),
(2, 'Spéciale'),
(3, 'Statut');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `starter` tinyint(1) NOT NULL DEFAULT '0',
  `last_connect` int(11) NOT NULL,
  `last_reward` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `starter`, `last_connect`, `last_reward`) VALUES
(39, 'test', '098f6bcd4621d373cade4e832627b4f6', 1, 1555582565, 1555570903),
(40, 'louis', '777cadc280bb23ebea268ded98338c39', 1, 1555488764, 1555487789),
(41, 'test1', '5a105e8b9d40e1329780d62ea2265d8a', 1, 1555573242, 1555572940),
(42, 'test2', 'ad0234829205b9033196ba818f7a872b', 1, 1555493334, 1555487592),
(43, 'test3', '8ad8757baa8564dc136c1e07507f4a98', 1, 1555583051, 1555582708),
(44, 'test4', '86985e105f79b95d6bc918fb45ec7727', 1, 1555493383, 1555493371),
(45, 'test6', '4cfad7076129962ee70c36839a1e3e15', 0, 1554448303, 0),
(46, 'test5', 'e3d704f3542b44a621ebed70dc0efe13', 1, 1555494884, 1555493391),
(47, 'test9', '739969b53246b2c727850dbb3490ede6', 1, 1555570081, 1555569997),
(48, 'test10', 'c1a8e059bfd1e911cf10b626340c9a54', 0, 1554478721, 0),
(49, 'test7', 'b04083e53e242626595e2b8ea327e525', 1, 1554642903, 1554642648),
(50, 'test8', '5e40d09fa0529781afd1254a42913847', 1, 1554644874, 1554644867),
(51, 'test18', 'df71df92c31111f810a7d89bd2c2e35d', 0, 1554643180, 0),
(52, 'test12', '60474c9c10d7142b7508ce7a50acf414', 1, 1554647384, 1554644962),
(53, 'test13', '33fc3dbd51a8b38a38b1b85b6a76b42b', 1, 1554649951, 1554649903),
(54, 'tel', '7b95a2ac8713cd7a3fdc04ba95ccdf9d', 1, 1554654080, 1554654030),
(55, 'test11', 'f696282aa4cd4f614aa995190cf442fe', 1, 1554757026, 1554756873),
(56, 'test22', '4d42bf9c18cb04139f918ff0ae68f8a0', 1, 1554758308, 1554757927),
(57, 'test99', '1d56a580bb00ff669f38e5c1f69b497c', 1, 1554794379, 1554794252),
(58, 'test33', '9cb45d54b2ccdc1c486e2f3eb87fbe9f', 1, 1554804997, 1554804923),
(59, 'test44', 'fd196d87b9d4752fa86a3ddf1481412a', 1, 1554805936, 1554805660),
(60, 'test66', '3f1bc06510a4e5ac9bd49f64d247354c', 1, 1554808287, 1554805955),
(61, 'test88', '841f54c24fd24fb27f45377b2e941070', 1, 1554808422, 1554808354),
(62, '91', '54229abfcfa5649e7003b83dd4755294', 1, 1554809265, 1554808582),
(63, 'test77', 'd40b31764c7f77dad3fa57e01d2c19fd', 1, 1554817376, 1554817327),
(64, 'kk', 'dc468c70fb574ebd07287b38d0d0676d', 1, 1554817440, 1554817392),
(65, 'aa', '4124bc0a9335c27f086f24ba207a4912', 1, 1554844905, 1554830602),
(66, 'oo', 'e47ca7a09cf6781e29634502345930a7', 1, 1554931612, 1554931601),
(67, 'lea', '812b94eb454835665e25797809c1d137', 1, 1555339666, 1555335453),
(68, 'azer', '13085a63a2b3e4beb7ab10ee395aefe4', 1, 1555396990, 1555396973),
(69, 'luko', '01d6b6e2c66f1456b57cd227618fa22f', 1, 1555495486, 1555494730),
(70, 'Autre', 'dc51784c068014fdaf42ac1885188009', 1, 1555525508, 1555525469);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Capacite`
--
ALTER TABLE `Capacite`
  ADD PRIMARY KEY (`Num`),
  ADD KEY `Type` (`Type`),
  ADD KEY `Categorie` (`Type_capacite`);

--
-- Index pour la table `Evolution_spéciale`
--
ALTER TABLE `Evolution_spéciale`
  ADD PRIMARY KEY (`Num_Pokemon`,`Num_Objet`),
  ADD KEY `objet` (`Num_Objet`),
  ADD KEY `evolve` (`Evolve_num`);

--
-- Index pour la table `Faiblesse_et_Resistances`
--
ALTER TABLE `Faiblesse_et_Resistances`
  ADD PRIMARY KEY (`Type_defensif`,`Type_offensif`),
  ADD KEY `offensif` (`Type_offensif`);

--
-- Index pour la table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`user`,`friend`),
  ADD KEY `user_friend` (`friend`);

--
-- Index pour la table `Objets_des_dresseurs`
--
ALTER TABLE `Objets_des_dresseurs`
  ADD PRIMARY KEY (`num_dresseur`,`num_objet`),
  ADD KEY `objets_num` (`num_objet`);

--
-- Index pour la table `Objet_evolution`
--
ALTER TABLE `Objet_evolution`
  ADD PRIMARY KEY (`Num`);

--
-- Index pour la table `Pokemon`
--
ALTER TABLE `Pokemon`
  ADD PRIMARY KEY (`Num`),
  ADD KEY `Type_1` (`Type_1`),
  ADD KEY `Type_2` (`Type_2`);

--
-- Index pour la table `Pokemon_des_dresseurs`
--
ALTER TABLE `Pokemon_des_dresseurs`
  ADD PRIMARY KEY (`Id_pokemon`),
  ADD KEY `Num_pokemon` (`Num_pokemon`),
  ADD KEY `Id_Dresseur` (`Num_dresseur`);

--
-- Index pour la table `Stat_basique_pokemon`
--
ALTER TABLE `Stat_basique_pokemon`
  ADD PRIMARY KEY (`Num`);

--
-- Index pour la table `Types`
--
ALTER TABLE `Types`
  ADD PRIMARY KEY (`Num`);

--
-- Index pour la table `Types_de_Capacite`
--
ALTER TABLE `Types_de_Capacite`
  ADD PRIMARY KEY (`Num`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Capacite`
--
ALTER TABLE `Capacite`
  MODIFY `Num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT pour la table `Objet_evolution`
--
ALTER TABLE `Objet_evolution`
  MODIFY `Num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `Pokemon`
--
ALTER TABLE `Pokemon`
  MODIFY `Num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT pour la table `Pokemon_des_dresseurs`
--
ALTER TABLE `Pokemon_des_dresseurs`
  MODIFY `Id_pokemon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT pour la table `Stat_basique_pokemon`
--
ALTER TABLE `Stat_basique_pokemon`
  MODIFY `Num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT pour la table `Types`
--
ALTER TABLE `Types`
  MODIFY `Num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `Types_de_Capacite`
--
ALTER TABLE `Types_de_Capacite`
  MODIFY `Num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Capacite`
--
ALTER TABLE `Capacite`
  ADD CONSTRAINT `Categorie` FOREIGN KEY (`Type_capacite`) REFERENCES `Types_de_Capacite` (`Num`),
  ADD CONSTRAINT `Type` FOREIGN KEY (`Type`) REFERENCES `Types` (`Num`);

--
-- Contraintes pour la table `Evolution_spéciale`
--
ALTER TABLE `Evolution_spéciale`
  ADD CONSTRAINT `evolve` FOREIGN KEY (`Evolve_num`) REFERENCES `Pokemon` (`Num`),
  ADD CONSTRAINT `objet` FOREIGN KEY (`Num_Objet`) REFERENCES `Objet_evolution` (`Num`),
  ADD CONSTRAINT `pokemon` FOREIGN KEY (`Num_Pokemon`) REFERENCES `Pokemon` (`Num`);

--
-- Contraintes pour la table `Faiblesse_et_Resistances`
--
ALTER TABLE `Faiblesse_et_Resistances`
  ADD CONSTRAINT `défensif` FOREIGN KEY (`Type_defensif`) REFERENCES `Types` (`Num`),
  ADD CONSTRAINT `offensif` FOREIGN KEY (`Type_offensif`) REFERENCES `Types` (`Num`);

--
-- Contraintes pour la table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friend_user` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_friend` FOREIGN KEY (`friend`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Objets_des_dresseurs`
--
ALTER TABLE `Objets_des_dresseurs`
  ADD CONSTRAINT `objets_num` FOREIGN KEY (`num_objet`) REFERENCES `Objet_evolution` (`Num`),
  ADD CONSTRAINT `user` FOREIGN KEY (`num_dresseur`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Pokemon`
--
ALTER TABLE `Pokemon`
  ADD CONSTRAINT `Type_1` FOREIGN KEY (`Type_1`) REFERENCES `Types` (`Num`),
  ADD CONSTRAINT `Type_2` FOREIGN KEY (`Type_2`) REFERENCES `Types` (`Num`);

--
-- Contraintes pour la table `Pokemon_des_dresseurs`
--
ALTER TABLE `Pokemon_des_dresseurs`
  ADD CONSTRAINT `Id_Dresseur` FOREIGN KEY (`Num_dresseur`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Num_pokemon` FOREIGN KEY (`Num_pokemon`) REFERENCES `Pokemon` (`Num`);

--
-- Contraintes pour la table `Stat_basique_pokemon`
--
ALTER TABLE `Stat_basique_pokemon`
  ADD CONSTRAINT `Pokémon` FOREIGN KEY (`Num`) REFERENCES `Pokemon` (`Num`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
