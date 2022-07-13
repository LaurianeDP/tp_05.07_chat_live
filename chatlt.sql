-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 13 juil. 2022 à 11:28
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
(1, 15, NULL),
(2, 15, 18);

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
(1, 15, 18);

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
(1, 18, 15, 'Bienvenu sur cette application de chat en ligne. Pour ajouter un contact, cliquez sur le bouton burger, puis sur le symbol utilisateur +, saisissez ensuite le pseudo de votre ami et appuyez sur \'ajouter\'. Amusez-vous bien !', '2022-07-13 08:21:30.485672', 1),
(2, 15, 18, 'Merci admin!', '2022-07-13 08:25:45.478588', 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_user` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `photo` varchar(150) DEFAULT NULL,
  `nom_complet` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_user`, `email`, `mdp`, `pseudo`, `photo`, `nom_complet`) VALUES
(15, 'admin@admin.fr', '$2y$10$IM70ATs3eK8l7FljAPkuXuoqtsVkDDYWPupvn.hHz4Oihiht0k64G', 'admin', NULL, 'administrateur'),
(18, 'utilisateur1@mail.fr', '$2y$10$uojDDZ/.1QJfgpEzFYanmeTyaiKLimv7PL0nOZRHytt/UTS/Jal26', 'util1', NULL, 'utilisateur numero 1');

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
  MODIFY `id_contact_list` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id_conversation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
