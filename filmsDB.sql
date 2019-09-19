-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 27 Septembre 2018 à 16:41
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `filmsdb`
--

-- --------------------------------------------------------

--
-- Structure de la table `films`
--

CREATE TABLE IF NOT EXISTS `films` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titre` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `idRealisateur` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idRealisateur` (`idRealisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `films`
--

INSERT INTO `films` (`id`, `titre`, `description`, `idRealisateur`) VALUES
(1, 'Jaws', 'Un film de requin', 1),
(2, 'Titanic', 'Un film de bateau qui coule', 2);

-- --------------------------------------------------------

--
-- Structure de la table `realisateurs`
--

CREATE TABLE IF NOT EXISTS `realisateurs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `bio` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `realisateurs`
--

INSERT INTO `realisateurs` (`id`, `prenom`, `nom`, `bio`) VALUES
(1, 'Steven', 'Spielberg', 'Un homme très riche!'),
(2, 'James', 'Cameron', 'Un autre homme très riche!');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `films`
--
ALTER TABLE `films`
  ADD CONSTRAINT `films_ibfk_1` FOREIGN KEY (`idRealisateur`) REFERENCES `realisateurs` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
