-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 20, 2014 at 09:28 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `2014`
--

-- --------------------------------------------------------

--
-- Table structure for table `detailsligneproduit`
--

CREATE TABLE IF NOT EXISTS `detailsligneproduit` (
  `RefLycee` char(30) NOT NULL,
  `Id` int(3) NOT NULL,
  `DateChangement` date NOT NULL,
  `IdTVA` int(10) NOT NULL,
  `Gratuit` tinyint(1) DEFAULT NULL,
  `PUHT` decimal(10,2) DEFAULT NULL,
  `SortieEntree` char(1) NOT NULL,
  `IdUsers` int(10) NOT NULL,
  `PUTTC` decimal(10,2) DEFAULT NULL,
  `Utilisation` int(10) NOT NULL,
  `OC` char(30) NOT NULL,
  `Quantite` int(3) NOT NULL,
  PRIMARY KEY (`RefLycee`,`Id`),
  KEY `IdTVA` (`IdTVA`),
  KEY `IdUsers` (`IdUsers`),
  KEY `OC` (`OC`),
  KEY `Utilisation` (`Utilisation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `detailsligneproduit`
--

INSERT INTO `detailsligneproduit` (`RefLycee`, `Id`, `DateChangement`, `IdTVA`, `Gratuit`, `PUHT`, `SortieEntree`, `IdUsers`, `PUTTC`, `Utilisation`, `OC`, `Quantite`) VALUES
('BOUT007*', 1, '2014-02-01', 1, 0, '64.00', 'S', 1, '78.00', 1, 'OC1/2014', 16);

-- --------------------------------------------------------

--
-- Table structure for table `fournisseurs`
--

CREATE TABLE IF NOT EXISTS `fournisseurs` (
  `Id` int(3) NOT NULL AUTO_INCREMENT,
  `Nom` char(30) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `fournisseurs`
--

INSERT INTO `fournisseurs` (`Id`, `Nom`) VALUES
(1, 'braamme'),
(2, 'MONDIAL TISSUS');

-- --------------------------------------------------------

--
-- Table structure for table `lien`
--

CREATE TABLE IF NOT EXISTS `lien` (
  `Id` int(3) NOT NULL AUTO_INCREMENT,
  `Adresse` char(30) NOT NULL,
  `Details` char(60) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `lien`
--

INSERT INTO `lien` (`Id`, `Adresse`, `Details`) VALUES
(1, 'fournisseur.php', 'Gestion des fournisseurs'),
(2, 'gererUtilisateur.php', 'Gestion des utilisateurs'),
(3, 'Inventaire1.php', 'Afficher l''inventaire'),
(4, 'newProduit.php', 'Ajouter un nouveau produit'),
(5, 'objetConfectionne.php', 'Gestion des objets confectionnés'),
(6, 'parametre.php', 'Gestion des parametres'),
(7, 'stockeProduit.php', 'Voir ou sortir des produits en stock'),
(8, 'monCompte.php', 'Mon Profil');

-- --------------------------------------------------------

--
-- Table structure for table `ligneoc`
--

CREATE TABLE IF NOT EXISTS `ligneoc` (
  `Id` int(3) NOT NULL AUTO_INCREMENT,
  `RefOc` char(30) NOT NULL,
  `RefLycee` char(30) NOT NULL,
  `Quantite` decimal(10,2) NOT NULL,
  `PuTTC` decimal(10,2) NOT NULL,
  PRIMARY KEY (`Id`,`RefOc`),
  KEY `RefOc` (`RefOc`),
  KEY `RefLycee` (`RefLycee`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ligneoc`
--

INSERT INTO `ligneoc` (`Id`, `RefOc`, `RefLycee`, `Quantite`, `PuTTC`) VALUES
(1, 'OC1/2014', 'BOUT007*', '3.00', '15.20');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `Idtype` int(3) NOT NULL,
  `IdLien` int(3) NOT NULL,
  PRIMARY KEY (`Idtype`,`IdLien`),
  KEY `IdLien` (`IdLien`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`Idtype`, `IdLien`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `objetconfectionne`
--

CREATE TABLE IF NOT EXISTS `objetconfectionne` (
  `Ref` varchar(20) NOT NULL,
  `Id` int(3) NOT NULL,
  `Annee` int(4) NOT NULL,
  `Designation` char(30) NOT NULL,
  `NbPrevision` int(2) NOT NULL,
  `Professeur` int(2) NOT NULL,
  `Destination` char(30) NOT NULL,
  `DateEmi` date NOT NULL,
  `DateFabri` date NOT NULL,
  `CoefCorrection` int(10) NOT NULL,
  `NbRealise` int(2) NOT NULL,
  `Temps` decimal(10,2) NOT NULL,
  `TotalMatiere` decimal(10,2) NOT NULL,
  `TotalFrais` decimal(10,2) NOT NULL,
  `TotalCoutEleve` decimal(10,2) NOT NULL,
  `CoutMachine` decimal(10,2) NOT NULL,
  `TotalCoutPublic` decimal(10,2) NOT NULL,
  `PrixUnitairePublic` decimal(10,2) NOT NULL,
  `PrixEleveUnitaire` decimal(10,2) NOT NULL,
  `CoutMachinePU` decimal(10,2) NOT NULL,
  PRIMARY KEY (`Ref`),
  KEY `Professeur` (`Professeur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `objetconfectionne`
--

INSERT INTO `objetconfectionne` (`Ref`, `Id`, `Annee`, `Designation`, `NbPrevision`, `Professeur`, `Destination`, `DateEmi`, `DateFabri`, `CoefCorrection`, `NbRealise`, `Temps`, `TotalMatiere`, `TotalFrais`, `TotalCoutEleve`, `CoutMachine`, `TotalCoutPublic`, `PrixUnitairePublic`, `PrixEleveUnitaire`, `CoutMachinePU`) VALUES
('OC1/2014', 1, 2014, 'Jupe', 5, 1, 'tout public', '2014-02-05', '2014-02-17', 20, 0, '2.20', '45.60', '9.12', '54.72', '6.82', '61.54', '12.31', '10.94', '3.10'),
('OC2/2014', 2, 2014, 'Robe', 75, 10, 'tous', '2014-02-12', '0000-00-00', 20, 0, '12.00', '45.60', '9.12', '54.72', '37.57', '92.29', '18.46', '10.94', '3.10'),
('OC3/2014', 3, 2014, 'jean', 45, 1, 'tout', '2014-02-14', '0000-00-00', 20, 2, '12.00', '45.60', '9.12', '54.72', '37.57', '92.29', '18.46', '10.94', '3.10'),
('OC4/2014', 4, 2014, 'td', 0, 1, 'dgb', '2014-02-14', '0000-00-00', 20, 2, '12.00', '45.60', '9.12', '54.72', '37.57', '92.29', '18.46', '10.94', '3.10'),
('OC5/2014', 5, 2014, 'bleu', 124, 1, 'bfee', '2014-02-14', '0000-00-00', 20, 2, '12.00', '45.60', '9.12', '54.72', '37.57', '92.29', '18.46', '10.94', '3.10'),
('OC6/2014', 6, 2014, 'Jupe', 5, 1, 'tout public', '2014-02-05', '0000-00-00', 20, 0, '12.00', '45.60', '9.12', '54.72', '37.57', '92.29', '18.46', '10.94', '3.10'),
('OC7/2014', 7, 2014, 'robezfnofan', 15, 1, 'tous', '2014-02-17', '0000-00-00', 0, 0, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
('OC8/2014', 8, 2014, 'znapfjop', 45, 1, 'nogr', '2014-02-17', '0000-00-00', 0, 0, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `parametre`
--

CREATE TABLE IF NOT EXISTS `parametre` (
  `Id` int(3) NOT NULL AUTO_INCREMENT,
  `Details` char(30) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `parametre`
--

INSERT INTO `parametre` (`Id`, `Details`) VALUES
(1, '20'),
(2, '3.10');

-- --------------------------------------------------------

--
-- Table structure for table `produit`
--

CREATE TABLE IF NOT EXISTS `produit` (
  `RefLycee` varchar(30) NOT NULL,
  `Id` int(3) NOT NULL,
  `RefFournisseur` varchar(30) NOT NULL,
  `Designation` varchar(100) NOT NULL,
  `IdUniteAchat` int(3) NOT NULL,
  `IdFournisseur` int(3) NOT NULL,
  `QuantiteTotal` decimal(10,2) NOT NULL,
  `Obselete` tinyint(1) NOT NULL,
  `StockAlerte` int(2) NOT NULL,
  `PUTTCPondere` decimal(10,2) NOT NULL,
  `Coloris` char(15) NOT NULL,
  `IdSection` int(3) NOT NULL,
  `StockInitial` int(2) NOT NULL,
  `PondereInitial` decimal(10,2) NOT NULL,
  PRIMARY KEY (`RefLycee`),
  KEY `IdFournisseur` (`IdFournisseur`),
  KEY `IdSection` (`IdSection`),
  KEY `IdUniteAchat` (`IdUniteAchat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `produit`
--

INSERT INTO `produit` (`RefLycee`, `Id`, `RefFournisseur`, `Designation`, `IdUniteAchat`, `IdFournisseur`, `QuantiteTotal`, `Obselete`, `StockAlerte`, `PUTTCPondere`, `Coloris`, `IdSection`, `StockInitial`, `PondereInitial`) VALUES
('BOUT007*', 1, 'BOU01260019B3PAT', 'BOUTON 2 TR 19MM BLANC - BLOUSE PERONNAS', 1, 1, '157.00', 0, 5, '456.00', 'Bleu', 2, 1, '15.00'),
('COT012', 2, '00087731', 'COTON LIN GARANCE', 2, 2, '458.00', 0, 5, '845.21', 'Rouge', 2, 2, '15.00');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE IF NOT EXISTS `section` (
  `Id` int(3) NOT NULL AUTO_INCREMENT,
  `Details` char(30) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`Id`, `Details`) VALUES
(1, 'Esthetique'),
(2, 'Mode'),
(3, 'Objet Confectionner');

-- --------------------------------------------------------

--
-- Table structure for table `tva`
--

CREATE TABLE IF NOT EXISTS `tva` (
  `Id` int(3) NOT NULL AUTO_INCREMENT,
  `Taux` decimal(10,2) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tva`
--

INSERT INTO `tva` (`Id`, `Taux`) VALUES
(0, '0.00'),
(1, '7.00'),
(2, '20.00'),
(3, '5.50');

-- --------------------------------------------------------

--
-- Table structure for table `typeuser`
--

CREATE TABLE IF NOT EXISTS `typeuser` (
  `Id` int(3) NOT NULL AUTO_INCREMENT,
  `Details` char(30) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `typeuser`
--

INSERT INTO `typeuser` (`Id`, `Details`) VALUES
(1, 'Administrateur'),
(2, 'Professeur de Mode'),
(3, 'Professeur d''esthetique');

-- --------------------------------------------------------

--
-- Table structure for table `unite`
--

CREATE TABLE IF NOT EXISTS `unite` (
  `Id` int(3) NOT NULL AUTO_INCREMENT,
  `Details` char(30) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `unite`
--

INSERT INTO `unite` (`Id`, `Details`) VALUES
(1, 'centimètre'),
(2, 'mètre');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `Id` int(3) NOT NULL AUTO_INCREMENT,
  `Login` char(30) NOT NULL,
  `Mdp` char(200) NOT NULL,
  `Type` int(30) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Type` (`Type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `Login`, `Mdp`, `Type`) VALUES
(1, 'toto', 'f71dbe52628a3f83a77ab494817525c6', 1),
(9, 'bubule', '3971079ea3e12e40c4bf04ed6089921a', 3),
(10, 'prince', '4ed6b93943904ae02e30282066a9a5fd', 3);

-- --------------------------------------------------------

--
-- Table structure for table `utilisation`
--

CREATE TABLE IF NOT EXISTS `utilisation` (
  `Id` int(2) NOT NULL AUTO_INCREMENT,
  `Details` char(30) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `utilisation`
--

INSERT INTO `utilisation` (`Id`, `Details`) VALUES
(1, 'Salon'),
(2, 'Pratique'),
(3, 'Projet');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detailsligneproduit`
--
ALTER TABLE `detailsligneproduit`
  ADD CONSTRAINT `detailsligneproduit_ibfk_1` FOREIGN KEY (`RefLycee`) REFERENCES `produit` (`RefLycee`),
  ADD CONSTRAINT `detailsligneproduit_ibfk_2` FOREIGN KEY (`IdTVA`) REFERENCES `tva` (`Id`),
  ADD CONSTRAINT `detailsligneproduit_ibfk_3` FOREIGN KEY (`IdUsers`) REFERENCES `users` (`Id`),
  ADD CONSTRAINT `detailsligneproduit_ibfk_4` FOREIGN KEY (`OC`) REFERENCES `objetconfectionne` (`Ref`),
  ADD CONSTRAINT `detailsligneproduit_ibfk_5` FOREIGN KEY (`Utilisation`) REFERENCES `utilisation` (`Id`);

--
-- Constraints for table `ligneoc`
--
ALTER TABLE `ligneoc`
  ADD CONSTRAINT `ligneoc_ibfk_1` FOREIGN KEY (`RefOc`) REFERENCES `objetconfectionne` (`Ref`),
  ADD CONSTRAINT `ligneoc_ibfk_2` FOREIGN KEY (`RefLycee`) REFERENCES `produit` (`RefLycee`);

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`Idtype`) REFERENCES `typeuser` (`Id`),
  ADD CONSTRAINT `menu_ibfk_2` FOREIGN KEY (`IdLien`) REFERENCES `lien` (`Id`);

--
-- Constraints for table `objetconfectionne`
--
ALTER TABLE `objetconfectionne`
  ADD CONSTRAINT `objetconfectionne_ibfk_1` FOREIGN KEY (`Professeur`) REFERENCES `users` (`Id`);

--
-- Constraints for table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`IdFournisseur`) REFERENCES `fournisseurs` (`Id`),
  ADD CONSTRAINT `produit_ibfk_2` FOREIGN KEY (`IdSection`) REFERENCES `section` (`Id`),
  ADD CONSTRAINT `produit_ibfk_3` FOREIGN KEY (`IdUniteAchat`) REFERENCES `unite` (`Id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`Type`) REFERENCES `typeuser` (`Id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
