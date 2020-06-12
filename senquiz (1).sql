-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 11 juin 2020 à 14:10
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `senquiz`
--

-- --------------------------------------------------------

--
-- Structure de la table `dejajouer`
--

CREATE TABLE `dejajouer` (
  `id` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `idquestion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `dejajouer`
--

INSERT INTO `dejajouer` (`id`, `iduser`, `idquestion`) VALUES
(33, 59, 18),
(34, 59, 21),
(35, 59, 22),
(36, 59, NULL),
(37, 59, NULL),
(38, 59, NULL),
(39, 59, 23),
(40, 59, NULL),
(41, 59, 25),
(42, 59, 26);

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE `questions` (
  `idquestion` int(11) NOT NULL,
  `question` text NOT NULL,
  `rubrique` varchar(250) NOT NULL,
  `type` varchar(250) NOT NULL,
  `score` int(11) NOT NULL,
  `reponse` text NOT NULL,
  `vrais` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`idquestion`, `question`, `rubrique`, `type`, `score`, `reponse`, `vrais`) VALUES
(18, 'la capital du sénégal ?', 'culturegeneral', 'choixtext', 4, 'dakar', 'dakar'),
(21, 'la drogue est ', 'tous', 'choixsimple', 5, '-bon pour la sante-mauvais por le sante', '2'),
(22, 'le code ', 'informatique', 'choixmultiple', 4, '-bon-cool-exelent-mové', '-1-2-3'),
(23, 'les moustiques ', 'tous', 'choixtext', 5, 'pique', 'pique'),
(25, 'quel son les quatres point cadinaux', 'culturegeneral', 'choixmultiple', 4, '-est-ouest-Nord-Sud-sud est-centre', '-1-2-3-4'),
(26, 'en quel anné le sénégal a obtenu son idépendance ?', 'culturegeneral', 'choixsimple', 4, '-1927-1670-1960', '3'),
(27, 'ou est née ASSANE ?', 'culturegeneral', 'choixtext', 4, 'joal Fadiouth', 'joal Fadiouth');

-- --------------------------------------------------------

--
-- Structure de la table `score`
--

CREATE TABLE `score` (
  `idscore` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `point` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `score`
--

INSERT INTO `score` (`idscore`, `iduser`, `point`) VALUES
(1, 59, 13),
(2, 76, 10),
(3, 62, 25),
(4, 64, 26),
(5, 69, 21),
(6, 77, 45);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `iduser` int(11) NOT NULL,
  `prenom` varchar(250) NOT NULL,
  `nom` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `type` varchar(250) NOT NULL,
  `login` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `privilege` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`iduser`, `prenom`, `nom`, `email`, `type`, `login`, `password`, `photo`, `privilege`) VALUES
(43, 'Assane', 'Dione', 'Dioneassane0290@gmail.com', 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', NULL, 1),
(55, 'nasir', 'dione', 'nasir@gmail.com', 'admin', 'nasir', '78e96b7de2cfaa6d3743781169c32680', NULL, 1),
(58, 'Assane', 'Dione', 'admin1@gmail.com', 'admin', 'prince', '21232f297a57a5a743894a0e4a801fc3', '1556776451271.jpg', 1),
(59, 'amy', 'amy', 'senfatou@gmail.com', 'joueur', 'amy', '7771fbb20af6ef10827c593daa3aff7b', NULL, 1),
(62, 'assane', 'a', 'assane@gmail.com', 'admin', 'ad', '523af537946b79c4f8369ed39ba78605', NULL, 1),
(64, 'assane', 'z', 'snnnn@gmail.com', 'admin', 'assane', '6b55726f47eb584a880a039db22d5af4', NULL, 1),
(68, 'kante', 'ka', 'senefatou1998@gmail.com', 'admin', 'ka', '7ce8636c076f5f42316676f7ca5ccfbe', NULL, 1),
(69, 'assane', 'dione', 'dione@gmail.com', 'joueur', 'assane', '6b55726f47eb584a880a039db22d5af4', '1557066536343.jpg', 1),
(72, 'fatou ass', 'dd', 'Dioneassane0290@gmail.com', 'joueur', 'e', 'e1671797c52e15f763380b45e841ec32', 'images.jpg', 1),
(73, 'mal', 'mal', 'mal@gmail.com', 'admin', 'mal', '749dfe7c0cd3b291ec96d0bb8924cb46', 'index.png', 1),
(74, 'HJLCCCCCCCGU BH', 'bbbb', 'saliou@gmail.com', 'joueur', 'ghggh', '8fa14cdd754f91cc6554c9e71929cce7', 'index.png', 1),
(75, 'h', 'j', 'saliou@gmail.com', 'joueur', 'po', 'f6122c971aeb03476bf01623b09ddfd4', 'Capture.PNG', 1),
(76, 'amy', 'amy', 'senfatou@gmail.com', 'joueur', 'amy', '723c47c0cb89bfc8496faa34189e22a1', NULL, 1),
(77, 'Assane', 'Dione', 'Dioneassane0290@gmail.com', 'admin', 'admin', '785b1acb864ea0134efa806b8702482c', NULL, 1),
(78, 'soda', 'top', 'soda@gmail.com', 'jouer', 'soda', 'ac95c3e7a5e1685f4f63172cd680f7e6', NULL, 1),
(79, 'doumbé', 'diouf', 'diouf@gmail.com', 'admin', 'diouf', 'a3c0f833831d2680572c89bec6305fc3', 'HP1.jpg', 1),
(80, 'mali', 'mali', 'mali@gmail.com', 'jouer', 'mali', 'd372d4727d7feea47b8c92f8a137c05d', 'HP1.jpg', 1),
(81, 'mali', 'mail', 'snnnn@gmail.com', 'admin', 'koli', 'b83a886a5c437ccd9ac15473fd6f1788', 'HP1.jpg', 1),
(85, 'edd', 'ddd', 'ggggggggg@gmail.com', 'admin', 'ggtg', '27260988f3f1b86c87407fedb4ffd4da', 'HP1.jpg', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `dejajouer`
--
ALTER TABLE `dejajouer`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`idquestion`);

--
-- Index pour la table `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`idscore`),
  ADD KEY `iduser` (`iduser`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `dejajouer`
--
ALTER TABLE `dejajouer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pour la table `questions`
--
ALTER TABLE `questions`
  MODIFY `idquestion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `score`
--
ALTER TABLE `score`
  MODIFY `idscore` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `score`
--
ALTER TABLE `score`
  ADD CONSTRAINT `score_ibfk_1` FOREIGN KEY (`iduser`) REFERENCES `utilisateur` (`iduser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
