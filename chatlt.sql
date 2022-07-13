-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 12 juil. 2022 à 16:26
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `chatlt`
--
-- CREATE DATABASE IF NOT EXISTS `chatlt` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
-- USE `chatlt`;

-- --------------------------------------------------------

--
-- Structure de la table `contact_lists`
--

CREATE TABLE `contact_lists` (
  `id_contact_list` int(11) NOT NULL,
  `id_user1` int(11) DEFAULT NULL,
  `id_user2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `contact_lists`
--

INSERT INTO `contact_lists` (`id_contact_list`, `id_user1`, `id_user2`) VALUES
(1, 2, 3),
(2, 3, 5),
(3, 2, 5),
(4, 2, 6),
(5, 3, 8),
(6, 3, 10),
(7, 3, 6),
(8, 4, 5),
(9, 4, 8),
(10, 6, 11),
(11, 6, 9),
(12, 6, 8),
(13, 10, 2),
(14, 10, 5),
(15, 11, 3),
(16, 4, 9),
(17, 4, 10),
(22, 4, 6);

-- --------------------------------------------------------

--
-- Structure de la table `conversations`
--

CREATE TABLE `conversations` (
  `id_conversation` int(11) NOT NULL,
  `utilisateur_1` int(11) DEFAULT NULL,
  `utilisateur_2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `conversations`
--

INSERT INTO `conversations` (`id_conversation`, `utilisateur_1`, `utilisateur_2`) VALUES
(1, 4, 8),
(5, 4, 5),
(6, 4, 9),
(7, 4, 10),
(8, 4, 6),
(9, 4, 3);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id_message` int(11) NOT NULL,
  `destinataire` int(11) DEFAULT NULL,
  `emetteur` int(11) DEFAULT NULL,
  `contenu` varchar(500) NOT NULL,
  `time_stamp` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `id_conversation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id_message`, `destinataire`, `emetteur`, `contenu`, `time_stamp`, `id_conversation`) VALUES
(1, 4, 8, 'Ceci est un message de util7 à util3', '2022-07-07 09:06:57.000000', 1),
(2, 8, 4, 'Ceci est un message de util3 à util7.', '2022-07-07 09:11:26.000000', 1),
(15, 8, 4, 'ceci est un message de util3 à util7 envoyé depuis la page de chat', '2022-07-11 09:53:28.568804', 1),
(16, 8, 4, 'test 3', '2022-07-11 09:54:26.633155', 1),
(25, 5, 4, 'Premier message à util4', '2022-07-11 12:28:20.950913', 5),
(27, 9, 4, 'premier message à util8', '2022-07-11 14:08:28.814407', 6),
(28, 10, 4, 'test', '2022-07-12 09:45:32.541691', 7),
(33, 3, 4, 'test', '2022-07-12 10:16:59.619668', 9),
(35, 10, 4, 'message 2', '2022-07-12 11:39:49.931835', 7),
(36, 8, 4, 'encore un message à util7', '2022-07-12 12:38:59.788358', 1),
(37, 6, 4, 'test', '2022-07-12 12:40:25.965073', 8),
(46, 6, 4, 'message test', '2022-07-12 13:38:06.473947', 8),
(48, 8, 4, 'et un autre', '2022-07-12 13:55:41.072035', 1),
(49, 8, 4, 'et encore un autre', '2022-07-12 13:56:14.746592', 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_user` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mdp` varchar(120) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `photo` varchar(150) DEFAULT NULL,
  `nom_complet` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_user`, `email`, `mdp`, `pseudo`, `photo`, `nom_complet`) VALUES
(1, 'admin@admin.fr', 'admin', 'admin', '', 'admin'),
(2, 'utilisateur1@mail.fr', 'test1', 'util1', '', 'utilisateur numéro un'),
(3, 'utilisateur2@mail.fr', 'test2', 'util2', '', 'utilisateur numéro deux'),
(4, 'utilisateur3@mail.fr', 'test3', 'util3', '', 'utilisateur numéro 3'),
(5, 'utilisateur4@mail.fr', 'test4', 'util4', '', 'utilisateur numéro quatre'),
(6, 'utilisateur5@mail.fr', 'test5', 'util5', '', 'utilisateur numéro cinq'),
(7, 'utilisateur6@mail.fr', 'test6', 'util6', '', 'utilisateur numéro six'),
(8, 'utilisateur7@mail.fr', 'test7', 'util7', '', 'utilisateur numéro sept'),
(9, 'utilisateur8@mail.fr', 'test8', 'util8', '', 'utilisateur numéro huit'),
(10, 'utilisateur9@mail.fr', 'test9', 'util9', '', 'utilisateur numéro neuf'),
(11, 'utilisateur10@mail.fr', 'test10', 'util10', '', 'utilisateur numéro dix');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `contact_lists`
--
ALTER TABLE `contact_lists`
  ADD PRIMARY KEY (`id_contact_list`),
  ADD KEY `fk_user1` (`id_user1`),
  ADD KEY `fk_user2` (`id_user2`);

--
-- Index pour la table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id_conversation`),
  ADD KEY `utilisateur_1` (`utilisateur_1`),
  ADD KEY `utilisateur_2` (`utilisateur_2`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id_message`),
  ADD KEY `messages_ibfk_1` (`id_conversation`),
  ADD KEY `destinataire` (`destinataire`),
  ADD KEY `emetteur` (`emetteur`),
  ADD KEY `time_stamp` (`time_stamp`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `pseudo` (`pseudo`),
  ADD KEY `nom_complet` (`nom_complet`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `contact_lists`
--
ALTER TABLE `contact_lists`
  MODIFY `id_contact_list` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id_conversation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `contact_lists`
--
ALTER TABLE `contact_lists`
  ADD CONSTRAINT `fk_user1` FOREIGN KEY (`id_user1`) REFERENCES `utilisateurs` (`id_user`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_user2` FOREIGN KEY (`id_user2`) REFERENCES `utilisateurs` (`id_user`) ON DELETE SET NULL;

--
-- Contraintes pour la table `conversations`
--
ALTER TABLE `conversations`
  ADD CONSTRAINT `conversations_ibfk_1` FOREIGN KEY (`utilisateur_1`) REFERENCES `utilisateurs` (`id_user`) ON DELETE SET NULL,
  ADD CONSTRAINT `conversations_ibfk_2` FOREIGN KEY (`utilisateur_2`) REFERENCES `utilisateurs` (`id_user`) ON DELETE SET NULL;

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_destinataire` FOREIGN KEY (`destinataire`) REFERENCES `utilisateurs` (`id_user`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_emetteur` FOREIGN KEY (`emetteur`) REFERENCES `utilisateurs` (`id_user`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
