-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Lun 08 Juin 2020 à 05:46
-- Version du serveur :  5.7.30-0ubuntu0.18.04.1
-- Version de PHP :  7.2.24-0ubuntu0.18.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `Joueurs`
--

CREATE TABLE `Joueurs` (
  `J_id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `connect` int(11) DEFAULT '0',
  `password` varchar(20) NOT NULL,
  `score` int(11) DEFAULT '0',
  `nb_parties` int(11) DEFAULT '0',
  `victoires` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `Joueurs`
--

INSERT INTO `Joueurs` (`J_id`, `pseudo`, `connect`, `password`, `score`, `nb_parties`, `victoires`) VALUES
(7, 'widad', 0, 'mouchtaki', 0, 0, 0),
(8, 'walid', 1, 'moudden', 0, 0, 0),
(9, 'mouad', 1, 'sadik', 0, 0, 0),
(10, 'max', 0, 'maxime', 0, 0, 0),
(11, 'tom', 0, 'web1', 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `Parties`
--

CREATE TABLE `Parties` (
  `id` int(11) NOT NULL,
  `J_id1` int(11) DEFAULT NULL,
  `J_id2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Joueurs`
--
ALTER TABLE `Joueurs`
  ADD PRIMARY KEY (`J_id`);

--
-- Index pour la table `Parties`
--
ALTER TABLE `Parties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `J_id1` (`J_id1`),
  ADD KEY `J_id2` (`J_id2`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Joueurs`
--
ALTER TABLE `Joueurs`
  MODIFY `J_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `Parties`
--
ALTER TABLE `Parties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Parties`
--
ALTER TABLE `Parties`
  ADD CONSTRAINT `Parties_ibfk_1` FOREIGN KEY (`J_id1`) REFERENCES `Joueurs` (`J_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Parties_ibfk_2` FOREIGN KEY (`J_id2`) REFERENCES `Joueurs` (`J_id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
