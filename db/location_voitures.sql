-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 26 mai 2025 à 12:18
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `location_voitures`
--

-- --------------------------------------------------------

--
-- Structure de la table `factures`
--

CREATE TABLE `factures` (
  `id` int(11) NOT NULL,
  `id_reservation` int(11) DEFAULT NULL,
  `montant` decimal(10,2) DEFAULT NULL,
  `date_emission` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `factures`
--

INSERT INTO `factures` (`id`, `id_reservation`, `montant`, `date_emission`) VALUES
(2, 2, 180.00, '2025-06-03 00:00:00'),
(5, 2, 180.00, '2025-06-03 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `sujet` varchar(150) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `date_envoi` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `nom`, `email`, `sujet`, `message`, `date_envoi`) VALUES
(1, 'Fatima Zahra', 'fatima@example.com', 'Demande d\'information', 'Bonjour, je souhaite avoir plus de détails sur la location longue durée.', '2025-05-20 00:00:00'),
(2, 'Rachid Amine', 'rachid@example.com', 'Problème de réservation', 'J’ai effectué une réservation mais je n’ai pas reçu de confirmation.', '2025-05-21 00:00:00'),
(3, 'Leila Bouzid', 'leila@example.com', 'Merci !', 'Merci pour votre service rapide et efficace. Je suis très satisfaite.', '2025-05-22 00:00:00'),
(4, 'Fatima Zahra', 'fatima@example.com', 'Demande d\'information', 'Bonjour, je souhaite avoir plus de détails sur la location longue durée.', '2025-05-20 00:00:00'),
(5, 'Rachid Amine', 'rachid@example.com', 'Problème de réservation', 'J’ai effectué une réservation mais je n’ai pas reçu de confirmation.', '2025-05-21 00:00:00'),
(6, 'Leila Bouzid', 'leila@example.com', 'Merci !', 'Merci pour votre service rapide et efficace. Je suis très satisfaite.', '2025-05-22 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  `id_voiture` int(11) DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `statut` enum('en attente','confirmée','annulée') DEFAULT 'en attente',
  `date_reservation` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `id_utilisateur`, `id_voiture`, `date_debut`, `date_fin`, `statut`, `date_reservation`) VALUES
(2, 2, 2, '2025-06-03', '2025-06-06', 'en attente', '2025-05-25 19:25:44'),
(5, 2, 2, '2025-06-03', '2025-06-06', 'en attente', '2025-05-25 19:28:09');

-- --------------------------------------------------------

--
-- Structure de la table `statistiques`
--

CREATE TABLE `statistiques` (
  `id` int(11) NOT NULL,
  `page` varchar(100) DEFAULT NULL,
  `nombre_visites` int(11) DEFAULT 0,
  `date_enregistrement` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `temoignages`
--

CREATE TABLE `temoignages` (
  `id` int(11) NOT NULL,
  `utilisateur_id` int(11) DEFAULT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `date_ajout` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `temoignages`
--

INSERT INTO `temoignages` (`id`, `utilisateur_id`, `nom`, `message`, `date_ajout`) VALUES
(5, NULL, 'Amine B.', 'Service excellent et voiture très propre. Je recommande vivement !', '2025-05-20 00:00:00'),
(6, NULL, 'Sofia L.', 'Location rapide, personnel accueillant et très professionnel.', '2025-05-21 00:00:00'),
(7, NULL, 'Youssef M.', 'Très satisfait de la voiture louée. Aucune mauvaise surprise.', '2025-05-22 00:00:00'),
(8, NULL, 'Nadia R.', 'Bon rapport qualité/prix et support client réactif.', '2025-05-23 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `motdepasse` varchar(255) DEFAULT NULL,
  `role` enum('utilisateur','admin') DEFAULT 'utilisateur',
  `date_inscription` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `email`, `motdepasse`, `role`, `date_inscription`) VALUES
(2, 'Yasmine Fares', 'yasmine@example.com', '123456', '', '2025-05-02 00:00:00'),
(3, 'Admin Principal', 'admin@admin.com', 'admin123', 'admin', '2025-04-15 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `voitures`
--

CREATE TABLE `voitures` (
  `id` int(11) NOT NULL,
  `marque` varchar(100) DEFAULT NULL,
  `modele` varchar(100) DEFAULT NULL,
  `categorie` varchar(100) DEFAULT NULL,
  `prix_par_jour` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `disponible` tinyint(1) DEFAULT 1,
  `date_ajout` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `voitures`
--

INSERT INTO `voitures` (`id`, `marque`, `modele`, `categorie`, `prix_par_jour`, `image`, `disponible`, `date_ajout`) VALUES
(1, 'Renault', 'Clio', 'Citadine', 45.00, 'clio.jpg', 1, '2025-05-01 00:00:00'),
(2, 'Peugeot', '308', 'Compacte', 60.00, '308.jpg', 1, '2025-05-02 00:00:00'),
(3, 'Dacia', 'Duster', 'SUV', 55.00, 'duster.jpg', 1, '2025-05-03 00:00:00'),
(4, 'Citroën', 'C3', 'Citadine', 50.00, 'c3.jpg', 1, '2025-05-04 00:00:00'),
(5, 'Renault', 'Clio', 'Citadine', 45.00, 'clio.jpg', 1, '2025-05-01 00:00:00'),
(6, 'Peugeot', '308', 'Compacte', 60.00, '308.jpg', 1, '2025-05-02 00:00:00'),
(7, 'Dacia', 'Duster', 'SUV', 55.00, 'duster.jpg', 1, '2025-05-03 00:00:00'),
(8, 'Citroën', 'C3', 'Citadine', 50.00, 'c3.jpg', 1, '2025-05-04 00:00:00'),
(9, 'Renault', 'Clio', 'Citadine', 45.00, 'clio.jpg', 1, '2025-05-01 00:00:00'),
(10, 'Peugeot', '308', 'Compacte', 60.00, '308.jpg', 1, '2025-05-02 00:00:00'),
(11, 'Dacia', 'Duster', 'SUV', 55.00, 'duster.jpg', 1, '2025-05-03 00:00:00'),
(12, 'Citroën', 'C3', 'Citadine', 50.00, 'c3.jpg', 1, '2025-05-04 00:00:00');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `factures`
--
ALTER TABLE `factures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_reservation` (`id_reservation`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_utilisateur` (`id_utilisateur`),
  ADD KEY `id_voiture` (`id_voiture`);

--
-- Index pour la table `statistiques`
--
ALTER TABLE `statistiques`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `temoignages`
--
ALTER TABLE `temoignages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utilisateur_id` (`utilisateur_id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `voitures`
--
ALTER TABLE `voitures`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `factures`
--
ALTER TABLE `factures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `statistiques`
--
ALTER TABLE `statistiques`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `temoignages`
--
ALTER TABLE `temoignages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `voitures`
--
ALTER TABLE `voitures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `factures`
--
ALTER TABLE `factures`
  ADD CONSTRAINT `factures_ibfk_1` FOREIGN KEY (`id_reservation`) REFERENCES `reservations` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`id_voiture`) REFERENCES `voitures` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `temoignages`
--
ALTER TABLE `temoignages`
  ADD CONSTRAINT `temoignages_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
