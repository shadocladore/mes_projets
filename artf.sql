-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 28 Novembre 2023 à 07:34
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `artf`
--

-- --------------------------------------------------------

--
-- Structure de la table `absence`
--

CREATE TABLE IF NOT EXISTS `absence` (
  `id_absence` int(11) NOT NULL AUTO_INCREMENT,
  `id_employe` int(11) NOT NULL,
  `motif` varchar(60) NOT NULL,
  `date_debut` varchar(12) NOT NULL,
  `date_fin` varchar(12) NOT NULL,
  `nbre_jour_absence` int(3) NOT NULL,
  `date_reprise_service` varchar(10) NOT NULL,
  PRIMARY KEY (`id_absence`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `absence`
--

INSERT INTO `absence` (`id_absence`, `id_employe`, `motif`, `date_debut`, `date_fin`, `nbre_jour_absence`, `date_reprise_service`) VALUES
(1, 5, 'Maladie', '03-11-2023', '03-11-2023', 5, '2023-03-25'),
(2, 12, 'Mariage', '06-11-2023', '2023-11-22', 89, '2023-11-23'),
(3, 3, 'Mariage', '13-11-2023', '2023-11-01', 9, '2023-11-02'),
(4, 5, 'IncompÃ©tence', '14-11-2023', '2023-11-04', 10, '2023-11-16'),
(5, 3, 'Mariage', '05-11-2023', '17-11-2023', 3, '23-11-2023');

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `nom` varchar(30) NOT NULL,
  `password` varchar(140) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_naissance` varchar(10) NOT NULL,
  `passion` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `admin`
--

INSERT INTO `admin` (`nom`, `password`, `photo`, `id`, `date_naissance`, `passion`) VALUES
('admin', 'ad8b41edb293c574d28c2a3af7bd29ed', 'admin.png', 1, '09-08-2000', 'FLORIDA');

-- --------------------------------------------------------

--
-- Structure de la table `affectation`
--

CREATE TABLE IF NOT EXISTS `affectation` (
  `id_affectation` int(11) NOT NULL AUTO_INCREMENT,
  `id_employe` int(11) NOT NULL,
  `motif` varchar(60) NOT NULL,
  `date_affectation` varchar(12) NOT NULL,
  `lieu_affectation` varchar(30) NOT NULL,
  PRIMARY KEY (`id_affectation`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `affectation`
--

INSERT INTO `affectation` (`id_affectation`, `id_employe`, `motif`, `date_affectation`, `lieu_affectation`) VALUES
(2, 8, 'Travail Briant', '21/03/2022', 'Yaounde'),
(5, 21, 'Fautes', '2023-01-01', 'Bambili');

-- --------------------------------------------------------

--
-- Structure de la table `avancement`
--

CREATE TABLE IF NOT EXISTS `avancement` (
  `id_avancement` int(11) NOT NULL AUTO_INCREMENT,
  `matricule` varchar(30) NOT NULL,
  `echelon` varchar(100) NOT NULL,
  `indice` varchar(11) NOT NULL,
  `grade` varchar(100) NOT NULL,
  `date_avancement` varchar(12) NOT NULL,
  PRIMARY KEY (`id_avancement`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `avancement`
--

INSERT INTO `avancement` (`id_avancement`, `matricule`, `echelon`, `indice`, `grade`, `date_avancement`) VALUES
(2, 'ARTF5', 'Niveau 10', '0', 'Superviseur', '2023-11-24'),
(5, 'ARTF10', 'Niveau 2&', 'AZE5D10&', 'Technicien en chef&', '2023-11-24'),
(6, 'ARTF10', 'Niveau 100', 'ABDGDVD', 'Proviseur', '2023-11-24'),
(7, 'ARTF29', 'Niveau 10', 'ABDGDVD', 'Personnel de service spÃ©ciali', '2023-11-24'),
(8, 'ARTF29', 'Niveau 10', 'ABDGDVD', 'Personnel de service spÃ©cialisÃ©', '2023-11-24');

-- --------------------------------------------------------

--
-- Structure de la table `conge`
--

CREATE TABLE IF NOT EXISTS `conge` (
  `id_conge` int(11) NOT NULL AUTO_INCREMENT,
  `id_employe` int(11) NOT NULL,
  `motif` varchar(60) NOT NULL,
  `date_debut` varchar(12) NOT NULL,
  `date_fin` varchar(12) NOT NULL,
  `date_reprise_service` varchar(10) NOT NULL,
  PRIMARY KEY (`id_conge`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `conge`
--

INSERT INTO `conge` (`id_conge`, `id_employe`, `motif`, `date_debut`, `date_fin`, `date_reprise_service`) VALUES
(1, 6, 'Maladie', '10-03-2023', '17/07/2023', ''),
(2, 5, 'Mariage', '15-03-2023', '2023-11-01', '2023-11-04');

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

CREATE TABLE IF NOT EXISTS `employe` (
  `id_employe` int(11) NOT NULL AUTO_INCREMENT,
  `matricule` varchar(30) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `sexe` varchar(1) NOT NULL,
  `date_naissance` varchar(12) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `adresse` varchar(60) NOT NULL,
  `diplome` varchar(30) NOT NULL,
  `grade` varchar(100) NOT NULL,
  `echelon` varchar(100) NOT NULL,
  `indice` varchar(30) NOT NULL,
  `date_prise_fonction` varchar(12) NOT NULL,
  `fonction` varchar(70) NOT NULL,
  `service` varchar(60) NOT NULL,
  `photo` varchar(100) NOT NULL,
  PRIMARY KEY (`id_employe`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Contenu de la table `employe`
--

INSERT INTO `employe` (`id_employe`, `matricule`, `nom`, `prenom`, `sexe`, `date_naissance`, `telephone`, `adresse`, `diplome`, `grade`, `echelon`, `indice`, `date_prise_fonction`, `fonction`, `service`, `photo`) VALUES
(1, 'ARTF4', 'TCHANDO NKINASSI', 'CLADORE', 'F', '09-08-1998', '653025600', 'Tradex Village', 'Licence ', 'Directeur GÃ©nÃ©rale', 'Niveau 2', 'AZE5D10', '2023-11-10', 'Depanner le reseau informatique', 'Informatique', 'cladore.jpg'),
(2, 'ARTF5', 'KEPNANG TOKUE', 'NINA', 'M', '09-08-1998', '653025600', 'Tradex Village', 'Licence ', 'Technicien en chef', 'Niveau 2', 'AZE5D10', '09-08-2023', 'Depanner le reseau informatique', 'Informatique', 'cladore.jpg'),
(3, 'ARTF6', 'ANOBANGO TONUE', 'ALFONCE', 'F', '09-08-1998', '653025600', 'Tradex Village', 'Licence ', 'Technicien en chef', 'Niveau 2', 'AZE5D10', '09-08-2023', 'Depanner le reseau informatique', 'Informatique', 'cladore.jpg'),
(4, 'ARTF7', 'MAMBO', 'ALEX', 'M', '09-08-1998', '653025600', 'Tradex Village', 'Licence ', 'Superviseur', 'Niveau 2', 'AZE5D10', '2023-11-02', 'Depanner le reseau informatique', 'Informatique', 'cladore.jpg'),
(5, 'ARTF8', 'KAMTO KUGUA', 'MITTERAN', 'M', '09-08-1998', '653025600', 'Tradex Village', 'Licence ', 'Technicien en chef', 'Niveau 2', 'AZE5D10', '09-08-2023', 'Depanner le reseau informatique', 'Informatique', 'cladore.jpg'),
(6, 'ARTF9', 'GOMBENA', 'STEPHANIE', 'F', '09-08-1998', '653025600', 'Tradex Village', 'Licence ', 'Technicien en chef', 'Niveau 2', 'AZE5D10', '09-08-2023', 'Depanner le reseau informatique', 'Informatique', 'cladore.jpg'),
(7, 'ARTF10', 'MBANKOUE TAKIDO', 'DORA', 'M', '09-08-1998', '653025600', 'Tradex Village', 'Licence ', 'Proviseur', 'Niveau 100', 'ABDGDVD', '2023-12-01', 'Depanner le reseau informatique', 'Informatique', 'cladore.jpg'),
(8, 'ARTF11', 'FODOP MANIOCO', 'BRYAND', 'F', '09-08-1998', '653025600', 'Tradex Village', 'Licence ', 'Technicien en chef', 'Niveau 2', 'AZE5D10', '09-08-2023', 'Depanner le reseau informatique', 'Informatique', 'cladore.jpg'),
(10, 'ARTF12', 'TCHANDO NKINASSI', 'CLADORE', 'M', '09-08-1998', '653025600', 'Tradex Village', 'Licence ', 'Technicien en chef', 'Niveau 2', 'AZE5D10', '09-08-2023', 'Depanner le reseau informatique', 'Informatique', 'cladore.jpg'),
(11, 'ARTF13', 'TCHEUTCHOUA', 'ANABELLE', 'F', '09-08-2000', '+242 699025600', 'Ngodi Bakoko', 'Master Professionnel', 'Administrateur rÃ©seau', 'Niveau 10', 'S0SR0R0R01', '2023-11-23', 'Adminstration du rÃ©seau', 'Service de maintenance rÃ©seau', '1700730022.jpg'),
(12, 'ARTF14', 'TCHANDO NKINASSI', 'CLADORE', 'M', '09-08-1998', '653025600', 'Tradex Village', 'Licence ', 'Technicien en chef', 'Niveau 2', 'AZE5D10', '09-08-2023', 'Depanner le reseau informatique', 'Informatique', 'cladore.jpg'),
(13, 'ARTF15', 'TCHANDO NKINASSI', 'CLADORE', 'M', '09-08-1998', '653025600', 'Tradex Village', 'Licence ', 'Technicien en chef', 'Niveau 2', 'AZE5D10', '09-08-2023', 'Depanner le reseau informatique', 'Informatique', 'cladore.jpg'),
(14, 'ARTF16', 'TCHANDO NKINASSI', 'CLADORE', 'M', '09-08-1998', '653025600', 'Tradex Village', 'Licence ', 'Technicien en chef', 'Niveau 2', 'AZE5D10', '09-08-2023', 'Depanner le reseau informatique', 'Informatique', 'cladore.jpg'),
(15, 'ARTF17', 'TCHANDO NKINASSI', 'CLADORE', 'M', '09-08-1998', '653025600', 'Tradex Village', 'Licence ', 'Technicien en chef', 'Niveau 2', 'AZE5D10', '09-08-2023', 'Depanner le reseau informatique', 'Informatique', 'cladore.jpg'),
(16, '', 'TCHANDO NKINASSI', 'CLADORE', 'M', '09-08-1998', '653025600', 'Tradex Village', 'Licence ', 'Technicien en chef', 'Niveau 2', 'AZE5D10', '09-08-2023', 'Depanner le reseau informatique', 'Informatique', 'cladore.jpg'),
(17, '', 'TCHANDO NKINASSI', 'CLADORE', 'M', '09-08-1998', '653025600', 'Tradex Village', 'Licence ', 'Technicien en chef', 'Niveau 2', 'AZE5D10', '09-08-2023', 'Depanner le reseau informatique', 'Informatique', 'cladore.jpg'),
(18, '', 'TCHANDO NKINASSI', 'CLADORE', 'M', '09-08-1998', '653025600', 'Tradex Village', 'Licence ', 'Technicien en chef', 'Niveau 2', 'AZE5D10', '09-08-2023', 'Depanner le reseau informatique', 'Informatique', 'cladore.jpg'),
(19, '', 'TCHANDO NKINASSI', 'CLADORE', 'M', '09-08-1998', '653025600', 'Tradex Village', 'Licence ', 'Technicien en chef', 'Niveau 2', 'AZE5D10', '09-08-2023', 'Depanner le reseau informatique', 'Informatique', 'cladore.jpg'),
(20, '', 'TCHANDO NKINASSI', 'CLADORE', 'M', '09-08-1998', '653025600', 'Tradex Village', 'Licence ', 'Technicien en chef', 'Niveau 2', 'AZE5D10', '09-08-2023', 'Depanner le reseau informatique', 'Informatique', 'cladore.jpg'),
(21, '', 'TCHANDO NKINASSI', 'CLADORE', 'M', '09-08-1998', '653025600', 'Tradex Village', 'Licence ', 'Technicien en chef', 'Niveau 2', 'AZE5D10', '09-08-2023', 'Depanner le reseau informatique', 'Informatique', 'cladore.jpg'),
(22, '', 'TCHANDO NKINASSI', 'CLADORE', 'M', '09-08-1998', '653025600', 'Tradex Village', 'Licence ', 'Technicien en chef', 'Niveau 2', 'AZE5D10', '09-08-2023', 'Depanner le reseau informatique', 'Informatique', 'cladore.jpg'),
(24, 'ARTF\nTextes complets	\nid_emplo', 'NGAMBOU PAKODI', 'HONORINE', 'F', '2023-11-01', '+242699025600', 'Ngodi Bakoko', 'Master Professionnel', 'Administrateur rÃ©seau', 'Niveau 10', 'S0SR0R0R01', '2023-03-23', 'Adminstration du rÃ©seau', 'Service de maintenance rÃ©seau', '1700732537.jpg'),
(25, 'ARTF2', 'PALAPALA', 'FLORIDA', 'F', '2023-11-07', '+242699025600', 'Ngodi Bakoko', 'Master Professionnel', 'DÃ©lÃ©guÃ© du personnel', 'Niveau 10', 'S0SR0R0R01', '2023-11-24', 'Adminstration du rÃ©seau', 'Service de maintenance rÃ©seau', '1700816759.jpg'),
(26, 'ARTF3', 'PAKODI', 'HONORINE', 'F', '2023-12-02', '+242699025600', 'Ngodi Bakoko', 'Master Professionnel', 'DÃ©lÃ©guÃ© du personnel', 'Niveau 10', 'S0SR0R0R01', '2023-11-24', 'Adminstration du rÃ©seau', 'Service de maintenance rÃ©seau', '1700833847.jpg'),
(27, 'ARTF21', 'PALAPALA', 'FLORIDA', 'F', '2023-11-10', '+242699025600', 'Ngodi Bakoko', 'Master Professionnel', 'Superviseur', 'Niveau 10', 'S0SR0R0R01', '2023-11-23', '', 'Service de maintenance rÃ©seau', '1700835131.jpg'),
(29, 'ARTF25', 'NGAMBOU PAKODI', 'PITOU', 'M', '2023-11-16', '+242699025600', 'Ngodi Bakoko', 'Master Professionnel', 'Directeur GÃ©nÃ©rale', 'Niveau 10', 'S0SR0RAAAA', '2023-11-22', 'Adminstration du rÃ©seau', 'Service de maintenance rÃ©seau', '1700835439.jpg'),
(30, 'ARTF29', 'MONTHE BABATACK', 'CHARLES', 'M', '2023-09-26', '+242699025600', 'Ngodi Bakoko', 'Licence', 'Personnel de service spÃ©cialisÃ©', 'Niveau 10', 'ABDGDVD', '2023-11-01', 'Adminstration du rÃ©seau', 'Service de maintenance rÃ©seau', '1700838280.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `pointage`
--

CREATE TABLE IF NOT EXISTS `pointage` (
  `id_pointage` int(11) NOT NULL AUTO_INCREMENT,
  `id_employe` int(11) NOT NULL,
  `date_pointage` varchar(10) NOT NULL,
  `heure_arrivee` varchar(50) NOT NULL,
  `heure_depart` varchar(50) NOT NULL,
  PRIMARY KEY (`id_pointage`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=124 ;

--
-- Contenu de la table `pointage`
--

INSERT INTO `pointage` (`id_pointage`, `id_employe`, `date_pointage`, `heure_arrivee`, `heure_depart`) VALUES
(2, 4, '2023-12-19', '07:10', '17:11'),
(4, 5, '2023-12-19', '07H16', '18H40'),
(5, 4, '2023-12-19', '07H18', '18H40'),
(6, 6, '2023-12-20', '07H20', '18H40'),
(8, 10, '2023-12-20', '07H15', '18H40'),
(9, 19, '2023-12-20', '07:16', '18H40'),
(11, 14, '2023-12-21', '07H20', '18H40'),
(14, 6, '2023-11-23', '11:50', '17:53'),
(15, 5, '2023-11-23', '19:03', '00:02'),
(16, 4, '2023-12-19', '07:10', '17:11'),
(17, 5, '2023-12-19', '07H16', '18H40'),
(18, 4, '2023-12-19', '07H18', '18H40'),
(19, 6, '2023-12-20', '07H20', '18H40'),
(20, 10, '2023-12-20', '07H15', '18H40'),
(21, 19, '2023-12-20', '07:16', '18H40'),
(22, 14, '2023-12-21', '07H20', '18H40'),
(23, 6, '2023-11-23', '11:50', '17:53'),
(24, 5, '2023-11-23', '19:03', '00:02'),
(25, 4, '2023-12-19', '07:10', '17:11'),
(26, 5, '2023-12-19', '07H16', '18H40'),
(27, 4, '2023-12-19', '07H18', '18H40'),
(28, 6, '2023-12-20', '07H20', '18H40'),
(29, 10, '2023-12-20', '07H15', '18H40'),
(30, 19, '2023-12-20', '07:16', '18H40'),
(31, 14, '2023-12-21', '07H20', '18H40'),
(32, 6, '2023-11-23', '11:50', '17:53'),
(33, 5, '2023-11-23', '19:03', '00:02'),
(34, 4, '2023-12-19', '07:10', '17:11'),
(35, 5, '2023-12-19', '07H16', '18H40'),
(36, 4, '2023-12-19', '07H18', '18H40'),
(37, 6, '2023-12-20', '07H20', '18H40'),
(38, 10, '2023-12-20', '07H15', '18H40'),
(39, 19, '2023-12-20', '07:16', '18H40'),
(40, 14, '2023-12-21', '07H20', '18H40'),
(41, 6, '2023-11-23', '11:50', '17:53'),
(42, 5, '2023-11-23', '19:03', '00:02'),
(43, 4, '2023-12-19', '07:10', '17:11'),
(44, 5, '2023-12-19', '07H16', '18H40'),
(45, 4, '2023-12-19', '07H18', '18H40'),
(46, 6, '2023-12-20', '07H20', '18H40'),
(47, 10, '2023-12-20', '07H15', '18H40'),
(48, 19, '2023-12-20', '07:16', '18H40'),
(49, 14, '2023-12-21', '07H20', '18H40'),
(50, 6, '2023-11-23', '11:50', '17:53'),
(51, 5, '2023-11-23', '19:03', '00:02'),
(52, 4, '2023-12-19', '07:10', '17:11'),
(53, 5, '2023-12-19', '07H16', '18H40'),
(54, 4, '2023-12-19', '07H18', '18H40'),
(55, 6, '2023-12-20', '07H20', '18H40'),
(56, 10, '2023-12-20', '07H15', '18H40'),
(57, 19, '2023-12-20', '07:16', '18H40'),
(58, 14, '2023-12-21', '07H20', '18H40'),
(59, 6, '2023-11-23', '11:50', '17:53'),
(60, 5, '2023-11-23', '19:03', '00:02'),
(61, 4, '2023-12-19', '07:10', '17:11'),
(62, 5, '2023-12-19', '07H16', '18H40'),
(63, 4, '2023-12-19', '07H18', '18H40'),
(64, 6, '2023-12-20', '07H20', '18H40'),
(65, 10, '2023-12-20', '07H15', '18H40'),
(66, 19, '2023-12-20', '07:16', '18H40'),
(67, 14, '2023-12-21', '07H20', '18H40'),
(68, 6, '2023-11-23', '11:50', '17:53'),
(69, 5, '2023-11-23', '19:03', '00:02'),
(70, 4, '2023-12-19', '07:10', '17:11'),
(71, 5, '2023-12-19', '07H16', '18H40'),
(72, 4, '2023-12-19', '07H18', '18H40'),
(73, 6, '2023-12-20', '07H20', '18H40'),
(74, 10, '2023-12-20', '07H15', '18H40'),
(75, 19, '2023-12-20', '07:16', '18H40'),
(76, 14, '2023-12-21', '07H20', '18H40'),
(77, 6, '2023-11-23', '11:50', '17:53'),
(78, 5, '2023-11-23', '19:03', '00:02'),
(79, 4, '2023-12-19', '07:10', '17:11'),
(80, 5, '2023-12-19', '07H16', '18H40'),
(81, 4, '2023-12-19', '07H18', '18H40'),
(82, 6, '2023-12-20', '07H20', '18H40'),
(83, 10, '2023-12-20', '07H15', '18H40'),
(84, 19, '2023-12-20', '07:16', '18H40'),
(85, 14, '2023-12-21', '07H20', '18H40'),
(86, 6, '2023-11-23', '11:50', '17:53'),
(87, 5, '2023-11-23', '19:03', '00:02'),
(88, 4, '2023-12-19', '07:10', '17:11'),
(89, 5, '2023-12-19', '07H16', '18H40'),
(90, 4, '2023-12-19', '07H18', '18H40'),
(91, 6, '2023-12-20', '07H20', '18H40'),
(92, 10, '2023-12-20', '07H15', '18H40'),
(93, 19, '2023-12-20', '07:16', '18H40'),
(94, 14, '2023-12-21', '07H20', '18H40'),
(95, 6, '2023-11-23', '11:50', '17:53'),
(96, 5, '2023-11-23', '19:03', '00:02'),
(97, 4, '2023-12-19', '07:10', '17:11'),
(98, 5, '2023-12-19', '07H16', '18H40'),
(99, 4, '2023-12-19', '07H18', '18H40'),
(100, 6, '2023-12-20', '07H20', '18H40'),
(101, 10, '2023-12-20', '07H15', '18H40'),
(102, 19, '2023-12-20', '07:16', '18H40'),
(103, 14, '2023-12-21', '07H20', '18H40'),
(104, 6, '2023-11-23', '11:50', '17:53'),
(105, 5, '2023-11-23', '19:03', '00:02'),
(106, 4, '2023-12-19', '07:10', '17:11'),
(107, 5, '2023-12-19', '07H16', '18H40'),
(108, 4, '2023-12-19', '07H18', '18H40'),
(109, 6, '2023-12-20', '07H20', '18H40'),
(110, 10, '2023-12-20', '07H15', '18H40'),
(111, 19, '2023-12-20', '07:16', '18H40'),
(112, 14, '2023-12-21', '07H20', '18H40'),
(113, 6, '2023-11-23', '11:50', '17:53'),
(114, 5, '2023-11-23', '19:03', '00:02'),
(115, 4, '2023-12-19', '07:10', '17:11'),
(116, 5, '2023-12-19', '07H16', '18H40'),
(117, 4, '2023-12-19', '07H18', '18H40'),
(118, 6, '2023-12-20', '07H20', '18H40'),
(119, 10, '2023-12-20', '07H15', '18H40'),
(120, 5, '2023-12-20', '07:16', '18H40'),
(121, 5, '2023-12-21', '07H20', '18H40'),
(122, 6, '2023-11-23', '11:50', '17:53'),
(123, 5, '2023-11-23', '19:03', '00:02');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
