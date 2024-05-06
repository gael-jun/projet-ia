-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 02 mai 2024 à 07:59
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet_ia`
--

-- --------------------------------------------------------

--
-- Structure de la table `faits`
--

CREATE TABLE `faits` (
  `id_faits` int(11) NOT NULL,
  `libelle_faits` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `faits`
--

INSERT INTO `faits` (`id_faits`, `libelle_faits`) VALUES
(1, 'Paludisme'),
(2, 'Vomissement'),
(3, 'Fievre'),
(4, 'COVID19'),
(5, 'Maux de tête'),
(6, 'temperature > 38'),
(7, 'toux'),
(8, 'Perte d’odorat'),
(9, 'Grippe'),
(11, 'Feuille de neem'),
(13, 'Tisane Kinkéliba + Citronnelle  '),
(14, 'Urines fréquentes surtout la nuit'),
(15, 'Infections cutanées inexpliquées'),
(16, 'Notion d\'hérédité '),
(17, 'Diabète'),
(18, 'Tisane miel, citron et gingembre'),
(19, 'Douleur dentaire'),
(20, 'Trous dans les dents'),
(21, 'Carries dentaires'),
(22, 'Appliquer une pate de clous de girofle'),
(23, 'Ecorce de manguier'),
(24, 'infusion de cannelle et de gingembre');

-- --------------------------------------------------------

--
-- Structure de la table `liaison`
--

CREATE TABLE `liaison` (
  `id` int(11) NOT NULL,
  `regle` int(11) NOT NULL,
  `premisse` int(11) NOT NULL,
  `conclusion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `liaison`
--

INSERT INTO `liaison` (`id`, `regle`, `premisse`, `conclusion`) VALUES
(32, 2, 5, 4),
(33, 2, 6, 4),
(34, 2, 7, 4),
(35, 2, 8, 4),
(43, 13, 7, 10),
(44, 13, 8, 10),
(50, 16, 2, 1),
(51, 16, 3, 1),
(52, 16, 5, 1),
(59, 20, 14, 17),
(60, 20, 15, 17),
(61, 20, 16, 17),
(64, 14, 1, 11),
(71, 12, 3, 9),
(72, 12, 5, 9),
(73, 12, 7, 9),
(76, 24, 21, 22),
(77, 25, 2, 1),
(78, 25, 3, 1),
(79, 25, 5, 1),
(80, 22, 9, 18),
(81, 26, 1, 23),
(82, 27, 19, 21),
(83, 27, 20, 21),
(84, 28, 17, 24),
(85, 29, 4, 13);

-- --------------------------------------------------------

--
-- Structure de la table `regles`
--

CREATE TABLE `regles` (
  `id_regles` int(11) NOT NULL,
  `libelle_regles` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `regles`
--

INSERT INTO `regles` (`id_regles`, `libelle_regles`) VALUES
(2, 'R2'),
(3, 'R3'),
(4, 'R4'),
(5, 'R5'),
(12, 'R3'),
(13, 'R4'),
(14, 'R5'),
(15, 'R5'),
(18, 'R5'),
(19, 'R0'),
(20, 'R4'),
(22, 'R7'),
(24, 'R9'),
(25, 'R1'),
(26, 'R6'),
(27, 'R8'),
(28, 'R10'),
(29, 'R11');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `faits`
--
ALTER TABLE `faits`
  ADD PRIMARY KEY (`id_faits`);

--
-- Index pour la table `liaison`
--
ALTER TABLE `liaison`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `regles`
--
ALTER TABLE `regles`
  ADD PRIMARY KEY (`id_regles`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `faits`
--
ALTER TABLE `faits`
  MODIFY `id_faits` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `liaison`
--
ALTER TABLE `liaison`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT pour la table `regles`
--
ALTER TABLE `regles`
  MODIFY `id_regles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
