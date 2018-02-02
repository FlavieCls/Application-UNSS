-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 18 Décembre 2017 à 16:43
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `unss`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `idCategorie` int(11) NOT NULL,
  `nomCategorie` varchar(255) NOT NULL,
  `codeCategorie` char(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`idCategorie`, `nomCategorie`, `codeCategorie`) VALUES
(1, 'JUNIORS GARCON ETABLISSEMENT', NULL),
(2, 'BENJAMINS FILLE ETABLISSEMENT', NULL),
(3, 'MINIMES GARCON ETABLISSEMENT', NULL),
(4, 'BENJAMINS GARCON ETABLISSEMENT', NULL),
(5, 'MINIMES FILLE ETABLISSEMENT', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE `compte` (
  `idCompte` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `compte`
--

INSERT INTO `compte` (`idCompte`, `nom`, `prenom`, `email`, `password`) VALUES
(1, 'Alpha', 'Testeur', 'alpha@testeur.com', '$2y$10$JhmQkLHMJ0PHgwXUDFUvIOq.aBf8cWzxhRI394w6srvVbPy1Y/JJu'),
(2, 'Potter', 'Harry', 'harry.potter@hotmail.fr', '$2y$10$VYp6a2qGcMGxqD54KgHU2u8fw6t3gzrw/R6kJcedzG.zgmvlfG1F6');

-- --------------------------------------------------------

--
-- Structure de la table `contrainte`
--

CREATE TABLE `contrainte` (
  `idContrainte` int(11) NOT NULL,
  `numEtablissement` char(7) NOT NULL,
  `numCategorie` int(11) NOT NULL,
  `contrainteStage` varchar(255) NOT NULL,
  `contrainteActivite1` varchar(12) NOT NULL,
  `contrainteActivite2` int(11) DEFAULT NULL,
  `contrainteCategorie1` varchar(5) DEFAULT NULL,
  `contrainteCategorie2` int(11) DEFAULT NULL,
  `contrainteParticipation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `contrainte`
--

INSERT INTO `contrainte` (`idContrainte`, `numEtablissement`, `numCategorie`, `contrainteStage`, `contrainteActivite1`, `contrainteActivite2`, `contrainteCategorie1`, `contrainteCategorie2`, `contrainteParticipation`) VALUES
(1, 'AS25129', 1, 'S51/S48', 'HB/VB', NULL, '', NULL, 'Athle Indoor'),
(2, 'AS25129', 2, 'S11/S15/S14', 'VB/HB', NULL, '', NULL, ''),
(3, 'AS25129', 3, '', 'Futsal/FB', NULL, '', NULL, ''),
(4, 'AS25129', 5, '', 'RG/FB', NULL, '', NULL, '');

-- --------------------------------------------------------

--
-- Structure de la table `equipe`
--

CREATE TABLE `equipe` (
  `idEquipe` int(11) NOT NULL,
  `numEtablissement` char(7) NOT NULL,
  `numCategorie` int(11) NOT NULL,
  `numSport` int(11) NOT NULL,
  `nbEquipe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `equipe`
--

INSERT INTO `equipe` (`idEquipe`, `numEtablissement`, `numCategorie`, `numSport`, `nbEquipe`) VALUES
(1, 'AS25129', 1, 1, 1),
(2, 'AS25129', 1, 2, 2),
(3, 'AS25129', 1, 3, 3),
(4, 'AS25129', 1, 4, 1),
(5, 'AS25129', 1, 5, 2),
(6, 'AS25129', 1, 6, 6),
(7, 'AS25129', 2, 1, 3),
(8, 'AS25129', 2, 2, 1),
(9, 'AS25129', 2, 3, 1),
(10, 'AS25129', 3, 4, 2),
(11, 'AS25129', 3, 5, 1),
(12, 'AS25129', 4, 1, 1),
(13, 'AS25129', 4, 2, 1),
(14, 'AS25129', 4, 3, 1),
(15, 'AS25129', 4, 4, 1),
(16, 'AS25129', 4, 5, 1),
(17, 'AS25129', 4, 6, 1),
(18, 'AS25129', 4, 7, 1),
(19, 'AS25129', 5, 1, 3),
(20, 'AS25129', 5, 2, 2),
(21, 'AS25129', 5, 3, 5),
(22, 'AS25129', 5, 4, 1),
(23, 'AS25129', 5, 5, 1),
(24, 'AS25129', 5, 6, 2);

-- --------------------------------------------------------

--
-- Structure de la table `etablissement`
--

CREATE TABLE `etablissement` (
  `codeAS` char(7) NOT NULL,
  `numTypeEtablissement` int(11) NOT NULL,
  `nomEtablissement` varchar(100) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `codePostal` char(5) NOT NULL,
  `ville` varchar(70) NOT NULL,
  `district` char(7) NOT NULL,
  `departement` varchar(50) NOT NULL,
  `academie` varchar(50) NOT NULL,
  `nomChefEtablissement` varchar(50) NOT NULL,
  `civiliteChefEtablissement` varchar(3) NOT NULL,
  `emailChefEtablissement` varchar(50) NOT NULL,
  `telChefEtablissement` char(10) NOT NULL,
  `nomSecretaire` varchar(50) NOT NULL,
  `civiliteSecretaire` varchar(3) NOT NULL,
  `emailSecretaire` varchar(50) NOT NULL,
  `telSecretaire` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `etablissement`
--

INSERT INTO `etablissement` (`codeAS`, `numTypeEtablissement`, `nomEtablissement`, `adresse`, `codePostal`, `ville`, `district`, `departement`, `academie`, `nomChefEtablissement`, `civiliteChefEtablissement`, `emailChefEtablissement`, `telChefEtablissement`, `nomSecretaire`, `civiliteSecretaire`, `emailSecretaire`, `telSecretaire`) VALUES
('AS25129', 1, 'AMANS JOSEPH FABRE', '2 BLD. BELLE-ISLE', '12000', 'RODEZ', '25cd122', 'Aveyron', 'Toulouse', 'LAURAS Christophe', 'M', '0120101v@ac-toulouse.fr', '565733050', 'POURCEL Damien', 'M', 'damien.pourcel@ac-toulouse.fr', '565733050');

-- --------------------------------------------------------

--
-- Structure de la table `sport`
--

CREATE TABLE `sport` (
  `idSport` int(11) NOT NULL,
  `nomSport` varchar(255) NOT NULL,
  `codeSport` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `sport`
--

INSERT INTO `sport` (`idSport`, `nomSport`, `codeSport`) VALUES
(1, 'Basket Ball', 'BB'),
(2, 'Handball', 'HB'),
(3, 'Volley Ball', 'VB'),
(4, 'Futsal', 'Futsal'),
(5, 'Football', 'FB'),
(6, 'Rugby', 'RG'),
(7, 'Basket Ball 3x3', 'BB3x3');

-- --------------------------------------------------------

--
-- Structure de la table `typeetablissement`
--

CREATE TABLE `typeetablissement` (
  `idType` int(11) NOT NULL,
  `typeEtablissement` varchar(50) DEFAULT NULL,
  `codeTypeEtablissement` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `typeetablissement`
--

INSERT INTO `typeetablissement` (`idType`, `typeEtablissement`, `codeTypeEtablissement`) VALUES
(1, NULL, 'COL');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`idCategorie`);

--
-- Index pour la table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`idCompte`);

--
-- Index pour la table `contrainte`
--
ALTER TABLE `contrainte`
  ADD PRIMARY KEY (`idContrainte`),
  ADD KEY `numEtablissement` (`numEtablissement`),
  ADD KEY `numCategorie` (`numCategorie`),
  ADD KEY `contrainteActivite1` (`contrainteActivite1`),
  ADD KEY `contrainteActivite2` (`contrainteActivite2`),
  ADD KEY `contrainteCategorie1` (`contrainteCategorie1`),
  ADD KEY `contrainteCategorie2` (`contrainteCategorie2`);

--
-- Index pour la table `equipe`
--
ALTER TABLE `equipe`
  ADD PRIMARY KEY (`idEquipe`),
  ADD KEY `numEtablissement` (`numEtablissement`),
  ADD KEY `numCategorie` (`numCategorie`),
  ADD KEY `numSport` (`numSport`);

--
-- Index pour la table `etablissement`
--
ALTER TABLE `etablissement`
  ADD PRIMARY KEY (`codeAS`),
  ADD KEY `FOREIGN_KEY` (`numTypeEtablissement`);

--
-- Index pour la table `sport`
--
ALTER TABLE `sport`
  ADD PRIMARY KEY (`idSport`);

--
-- Index pour la table `typeetablissement`
--
ALTER TABLE `typeetablissement`
  ADD PRIMARY KEY (`idType`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `idCategorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `compte`
--
ALTER TABLE `compte`
  MODIFY `idCompte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `contrainte`
--
ALTER TABLE `contrainte`
  MODIFY `idContrainte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `equipe`
--
ALTER TABLE `equipe`
  MODIFY `idEquipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT pour la table `sport`
--
ALTER TABLE `sport`
  MODIFY `idSport` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `typeetablissement`
--
ALTER TABLE `typeetablissement`
  MODIFY `idType` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `contrainte`
--
ALTER TABLE `contrainte`
  ADD CONSTRAINT `FK_contrainte_categorie` FOREIGN KEY (`numCategorie`) REFERENCES `categorie` (`idCategorie`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_contrainte_etab` FOREIGN KEY (`numEtablissement`) REFERENCES `etablissement` (`codeAS`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `equipe`
--
ALTER TABLE `equipe`
  ADD CONSTRAINT `FK_equipe_categorie` FOREIGN KEY (`numCategorie`) REFERENCES `categorie` (`idCategorie`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_equipe_etab` FOREIGN KEY (`numEtablissement`) REFERENCES `etablissement` (`codeAS`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_equipe_sport` FOREIGN KEY (`numSport`) REFERENCES `sport` (`idSport`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `etablissement`
--
ALTER TABLE `etablissement`
  ADD CONSTRAINT `FK_etab_typeEtab` FOREIGN KEY (`numTypeEtablissement`) REFERENCES `typeetablissement` (`idType`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
