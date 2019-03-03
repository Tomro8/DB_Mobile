-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 02 mars 2019 à 19:25
-- Version du serveur :  5.7.24-log
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `revendiquons`
--

-- --------------------------------------------------------

--
-- Structure de la table `re_ticket`
--

create database revendiquons;
use revendiquons;
DROP TABLE IF EXISTS `re_ticket`;
CREATE TABLE IF NOT EXISTS `re_ticket` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `re_user`
--

DROP TABLE IF EXISTS `re_user`;
CREATE TABLE IF NOT EXISTS `re_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `mail` text NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `password` text NOT NULL,
  `register` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isActivate` tinyint(4) NOT NULL DEFAULT '0',
  `keyActivation` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `re_vote_ticket`
--

DROP TABLE IF EXISTS `re_vote_ticket`;
CREATE TABLE IF NOT EXISTS `re_vote_ticket` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) NOT NULL,
  `id_ticket` bigint(20) NOT NULL,
  `forOrAgainst` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_vt_user` (`id_user`),
  KEY `FK_vt_ticket` (`id_ticket`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `re_ticket`
--
ALTER TABLE `re_ticket`
  ADD CONSTRAINT `FK_user` FOREIGN KEY (`id_user`) REFERENCES `re_user` (`id`);

--
-- Contraintes pour la table `re_vote_ticket`
--
ALTER TABLE `re_vote_ticket`
  ADD CONSTRAINT `FK_vt_ticket` FOREIGN KEY (`id_ticket`) REFERENCES `re_ticket` (`id`),
  ADD CONSTRAINT `FK_vt_user` FOREIGN KEY (`id_user`) REFERENCES `re_user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
