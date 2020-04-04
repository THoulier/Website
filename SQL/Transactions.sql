-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : sam. 04 avr. 2020 à 16:50
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `test`
--

-- --------------------------------------------------------

--
-- Structure de la table `Transactions`
--

CREATE TABLE `Transactions` (
  `ID` int(11) NOT NULL,
  `Msg_exp` text NOT NULL,
  `User_src` int(11) NOT NULL,
  `User_cible` int(11) NOT NULL,
  `Montant` int(11) NOT NULL,
  `Date_creation` date NOT NULL DEFAULT current_timestamp(),
  `Statut` int(11) NOT NULL DEFAULT 0,
  `Date_fermeture` date DEFAULT NULL,
  `Msg_fer` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Transactions`
--

INSERT INTO `Transactions` (`ID`, `Msg_exp`, `User_src`, `User_cible`, `Montant`, `Date_creation`, `Statut`, `Date_fermeture`, `Msg_fer`) VALUES
(2, 'Course', 4, 1, 76, '2020-04-04', 0, NULL, NULL),
(3, 'camping \r\naaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa\r\naaaaaaaaaaaaaaaaaaaaaaaaaaaa\r\naaaaaaaaaaaaaaaaaaaaaaaaaaaaa\r\naaaaaaaaaaaaaaaaaaaaaaaaaa\r\naaaaaaaaaaaaaaaaaaaaaaaaaa', 2, 3, 180, '2020-04-04', 1, NULL, NULL),
(4, 'Voiture', 1, 2, 560, '2020-04-04', 2, NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Transactions`
--
ALTER TABLE `Transactions`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `User_src` (`User_src`),
  ADD KEY `User_cible` (`User_cible`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Transactions`
--
ALTER TABLE `Transactions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Transactions`
--
ALTER TABLE `Transactions`
  ADD CONSTRAINT `Transactions_ibfk_1` FOREIGN KEY (`User_src`) REFERENCES `Utilisateur` (`ID`),
  ADD CONSTRAINT `Transactions_ibfk_2` FOREIGN KEY (`User_cible`) REFERENCES `Utilisateur` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
