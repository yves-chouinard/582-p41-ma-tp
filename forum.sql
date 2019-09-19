-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mer. 24 oct. 2018 à 12:10
-- Version du serveur :  5.6.38
-- Version de PHP :  7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `forum`
--

-- --------------------------------------------------------

--
-- Structure de la table `p41_tp_reponse`
--

CREATE TABLE `p41_tp_reponse` (
  `id` int(10) UNSIGNED NOT NULL,
  `titre` varchar(255) NOT NULL,
  `texte` text NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nom_usager` varchar(50) NOT NULL,
  `id_sujet` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `p41_tp_reponse`
--

INSERT INTO `p41_tp_reponse` (`id`, `titre`, `texte`, `date_creation`, `nom_usager`, `id_sujet`) VALUES
(1, 'Salut', 'Bienvenue sur le forum!', '2018-10-20 09:30:16', 'master', 2),
(2, 'asd', 'asdas\r\n\r\nasd', '2018-10-20 09:47:38', 'master', 2),
(5, 'Salut moi aussi', 'Bienvenue sur le site', '2018-10-21 12:22:23', 'reg', 2),
(6, 'Je trouve que Claude Julien ressemble à Jabba the Hut', 'Juste mon avis personnel.\r\n\r\nQue voulez-vous.', '2018-10-21 12:23:31', 'reg', 6),
(7, 'asdasd', 'asdasd', '2018-10-21 16:03:32', 'master', 6),
(8, 'Shame', 'Quelques semaines, il parait.', '2018-10-22 14:30:59', 'master', 12),
(9, 'Price est moyen', 'Il était nul l\'an passé. Maintenant il n\'est plus nul, mais il n\'est pas non plus revenu à un niveau élite.\r\n\r\nIl est moyen.', '2018-10-22 14:33:20', 'master', 12),
(10, 'Ouin', 'Mmm...', '2018-10-22 14:37:16', 'master', 12),
(11, 'Hey', 'askdjaksdj', '2018-10-22 14:45:32', 'master', 12),
(12, 'Oh', 'Non', '2018-10-22 14:45:44', 'master', 12);

-- --------------------------------------------------------

--
-- Structure de la table `p41_tp_sujet`
--

CREATE TABLE `p41_tp_sujet` (
  `id` int(10) UNSIGNED NOT NULL,
  `titre` varchar(255) NOT NULL,
  `texte` text NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nom_usager` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `p41_tp_sujet`
--

INSERT INTO `p41_tp_sujet` (`id`, `titre`, `texte`, `date_creation`, `nom_usager`) VALUES
(2, 'Mouse est là', 'Moi aussi je sais faire des posts de nouveaux sujets.\r\n\r\nJe regarde le hockey.', '2018-10-13 23:24:47', 'mouse'),
(6, 'Star Wars', 'andskjskaj sd\r\nasjdhkajshda\r\naskjdhakjsdh', '2018-10-17 11:39:19', 'master'),
(10, 'Paul Byron va faire 30 buts', 'Y est pas mal vite Paul Byron, puis il a toute une shot.', '2018-10-21 12:22:00', 'reg'),
(12, 'Pleky est blessé au dos', 'C\'est ben dommage.', '2018-10-22 14:29:35', 'master');

-- --------------------------------------------------------

--
-- Structure de la table `p41_tp_usager`
--

CREATE TABLE `p41_tp_usager` (
  `nom_usager` varchar(50) NOT NULL,
  `mot_passe` varchar(255) NOT NULL,
  `est_admin` tinyint(1) NOT NULL,
  `est_banni` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `p41_tp_usager`
--

INSERT INTO `p41_tp_usager` (`nom_usager`, `mot_passe`, `est_admin`, `est_banni`) VALUES
('master', '$2y$10$zBR/xKdhWDWD4eChaHpA5e2i6Z6jHCqUr.NC7TJYiMIIGj.FyKFCi', 1, 0),
('mouse', '$2y$10$HzUz/rphvDthVPQz1ZYpNedpRLp0DhZ5RsP0XofVlYHuJACV32JZW', 0, 0),
('reg', '$2y$10$t54nWQL3Pnn.tXkKjQV7Eengyko.KfvYgj5/O9qqn0IZVhEREiDyW', 0, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `p41_tp_reponse`
--
ALTER TABLE `p41_tp_reponse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nom_usager` (`nom_usager`),
  ADD KEY `p41_tp_reponse_ibfk_1` (`id_sujet`);

--
-- Index pour la table `p41_tp_sujet`
--
ALTER TABLE `p41_tp_sujet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nom_usager` (`nom_usager`);

--
-- Index pour la table `p41_tp_usager`
--
ALTER TABLE `p41_tp_usager`
  ADD PRIMARY KEY (`nom_usager`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `p41_tp_reponse`
--
ALTER TABLE `p41_tp_reponse`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `p41_tp_sujet`
--
ALTER TABLE `p41_tp_sujet`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `p41_tp_reponse`
--
ALTER TABLE `p41_tp_reponse`
  ADD CONSTRAINT `p41_tp_reponse_ibfk_1` FOREIGN KEY (`id_sujet`) REFERENCES `p41_tp_sujet` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `p41_tp_reponse_ibfk_2` FOREIGN KEY (`nom_usager`) REFERENCES `p41_tp_usager` (`nom_usager`);

--
-- Contraintes pour la table `p41_tp_sujet`
--
ALTER TABLE `p41_tp_sujet`
  ADD CONSTRAINT `p41_tp_sujet_ibfk_1` FOREIGN KEY (`nom_usager`) REFERENCES `p41_tp_usager` (`nom_usager`);
