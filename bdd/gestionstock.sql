-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 15 mars 2024 à 08:13
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestionstock`
--

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

DROP TABLE IF EXISTS `classe`;
CREATE TABLE IF NOT EXISTS `classe` (
  `id_classe` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL,
  PRIMARY KEY (`id_classe`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `classe`
--

INSERT INTO `classe` (`id_classe`, `libelle`) VALUES
(1, 'TU'),
(2, 'CPRP'),
(3, 'CQPM'),
(4, 'Fab Spé');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id_commande` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `etat` varchar(100) NOT NULL,
  `num_devis` int NOT NULL,
  `ref_classe` int NOT NULL,
  `ref_user` int NOT NULL,
  `ref_fournisseur` int NOT NULL,
  `ref_matiere` int NOT NULL,
  PRIMARY KEY (`id_commande`),
  KEY `fk_commande_user` (`ref_user`),
  KEY `fk_commande_fournisseur` (`ref_fournisseur`),
  KEY `fk_commande_classe` (`ref_classe`),
  KEY `fk_commande_matiere` (`ref_matiere`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `debit`
--

DROP TABLE IF EXISTS `debit`;
CREATE TABLE IF NOT EXISTS `debit` (
  `id_debit` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `quantite` int NOT NULL,
  `ref_piece` int NOT NULL,
  `ref_user` int NOT NULL,
  `ref_classe` int NOT NULL,
  `ref_matiere` int NOT NULL,
  PRIMARY KEY (`id_debit`),
  KEY `fk_debit_user` (`ref_user`),
  KEY `fk_debit_classe` (`ref_classe`),
  KEY `fk_debit_piece` (`ref_piece`),
  KEY `fk_debit_matiere` (`ref_matiere`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `debit`
--

INSERT INTO `debit` (`id_debit`, `date`, `quantite`, `ref_piece`, `ref_user`, `ref_classe`, `ref_matiere`) VALUES
(1, '2024-03-14', 5, 9, 1, 2, 1),
(2, '2024-03-16', 15, 7, 2, 3, 4),
(3, '2024-03-16', 15, 7, 2, 3, 4),
(4, '2024-03-05', 2, 4, 6, 1, 5);

-- --------------------------------------------------------

--
-- Structure de la table `fonction`
--

DROP TABLE IF EXISTS `fonction`;
CREATE TABLE IF NOT EXISTS `fonction` (
  `id_fonction` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) NOT NULL,
  PRIMARY KEY (`id_fonction`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `fonction`
--

INSERT INTO `fonction` (`id_fonction`, `libelle`) VALUES
(1, 'Professeur'),
(2, 'Elève'),
(3, 'DDFPT'),
(4, 'Comptabilité');

-- --------------------------------------------------------

--
-- Structure de la table `forme`
--

DROP TABLE IF EXISTS `forme`;
CREATE TABLE IF NOT EXISTS `forme` (
  `id_forme` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(99) NOT NULL,
  `img` varchar(200) NOT NULL,
  `longueur` tinyint(1) NOT NULL,
  `largeur` tinyint(1) NOT NULL,
  `epaisseur` tinyint(1) NOT NULL,
  `diametre` tinyint(1) NOT NULL,
  `hauteur` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_forme`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `forme`
--

INSERT INTO `forme` (`id_forme`, `libelle`, `img`, `longueur`, `largeur`, `epaisseur`, `diametre`, `hauteur`) VALUES
(1, 'Tube Rond', '', 1, 0, 1, 1, 0),
(2, 'Méplat\r\n', '', 1, 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

DROP TABLE IF EXISTS `fournisseur`;
CREATE TABLE IF NOT EXISTS `fournisseur` (
  `id_fournisseur` int NOT NULL AUTO_INCREMENT,
  `entreprise` varchar(200) NOT NULL,
  `mail` varchar(150) NOT NULL,
  `telephone` varchar(100) NOT NULL,
  PRIMARY KEY (`id_fournisseur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `materiau`
--

DROP TABLE IF EXISTS `materiau`;
CREATE TABLE IF NOT EXISTS `materiau` (
  `id_materiau` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_materiau`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `materiau`
--

INSERT INTO `materiau` (`id_materiau`, `libelle`) VALUES
(1, 'Acier'),
(2, 'Cuivre'),
(4, 'Bronze'),
(5, 'POM');

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

DROP TABLE IF EXISTS `matiere`;
CREATE TABLE IF NOT EXISTS `matiere` (
  `id_matiere` int NOT NULL AUTO_INCREMENT,
  `ref_materiau` int NOT NULL,
  `ref_forme` int NOT NULL,
  `longueur` int NOT NULL,
  `hauteur` int DEFAULT NULL,
  `epaisseur` int DEFAULT NULL,
  `largeur` int DEFAULT NULL,
  `diametre` int DEFAULT NULL,
  PRIMARY KEY (`id_matiere`),
  KEY `fk_piece_materiau` (`ref_materiau`),
  KEY `fk_piece_forme` (`ref_forme`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `matiere`
--

INSERT INTO `matiere` (`id_matiere`, `ref_materiau`, `ref_forme`, `longueur`, `hauteur`, `epaisseur`, `largeur`, `diametre`) VALUES
(1, 1, 2, 1983, 100, NULL, 50, NULL),
(4, 2, 2, 83, NULL, 2, NULL, 10),
(5, 1, 1, 133, NULL, 2, NULL, 8);

-- --------------------------------------------------------

--
-- Structure de la table `matierecommande`
--

DROP TABLE IF EXISTS `matierecommande`;
CREATE TABLE IF NOT EXISTS `matierecommande` (
  `ref_matiere` int NOT NULL,
  `ref_commande` int NOT NULL,
  `prix` float(8,2) NOT NULL,
  `quantite` int NOT NULL,
  PRIMARY KEY (`ref_matiere`,`ref_commande`),
  KEY `fk_piececommande_commande` (`ref_commande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `matierefournisseur`
--

DROP TABLE IF EXISTS `matierefournisseur`;
CREATE TABLE IF NOT EXISTS `matierefournisseur` (
  `ref_matiere` int NOT NULL,
  `ref_fournisseur` int NOT NULL,
  `prix` float NOT NULL,
  PRIMARY KEY (`ref_matiere`,`ref_fournisseur`),
  KEY `fk_matierefournisseur_fournisseur` (`ref_fournisseur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `matierepiece`
--

DROP TABLE IF EXISTS `matierepiece`;
CREATE TABLE IF NOT EXISTS `matierepiece` (
  `ref_matiere` int NOT NULL,
  `ref_piece` int NOT NULL,
  PRIMARY KEY (`ref_matiere`,`ref_piece`),
  KEY `fk_matierepiece_piece` (`ref_piece`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `piece`
--

DROP TABLE IF EXISTS `piece`;
CREATE TABLE IF NOT EXISTS `piece` (
  `id_piece` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `img` varchar(200) NOT NULL,
  PRIMARY KEY (`id_piece`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `piece`
--

INSERT INTO `piece` (`id_piece`, `nom`, `img`) VALUES
(3, 'Corps', '../../assets/images/Corps.jpg'),
(4, 'Test', '../../assets/images/Test.png'),
(5, 'GoPro Corps', '../../assets/images/GoPro Corps.jpg'),
(6, 'GoPro Corps', '../../assets/images/GoPro Corps.jpg'),
(7, 'GoPro Corps', '../../assets/images/GoPro Corps.jpg'),
(8, 'GoPro Corps', '../../assets/images/GoPro Corps.jpg'),
(9, 'GoPro Corps', '../../assets/images/GoPro Corps.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `pieceprojet`
--

DROP TABLE IF EXISTS `pieceprojet`;
CREATE TABLE IF NOT EXISTS `pieceprojet` (
  `ref_piece` int NOT NULL,
  `ref_projet` int NOT NULL,
  `longueur` int NOT NULL,
  PRIMARY KEY (`ref_piece`,`ref_projet`),
  KEY `fk_pieceprojet_projet` (`ref_projet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `pieceprojet`
--

INSERT INTO `pieceprojet` (`ref_piece`, `ref_projet`, `longueur`) VALUES
(9, 6, 0);

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

DROP TABLE IF EXISTS `projet`;
CREATE TABLE IF NOT EXISTS `projet` (
  `id_projet` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `img` varchar(100) NOT NULL,
  PRIMARY KEY (`id_projet`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `projet`
--

INSERT INTO `projet` (`id_projet`, `nom`, `img`) VALUES
(5, 'Char à voile', '../../assets/images/Char à voile.png'),
(6, 'Support GoPro', '../../assets/images/Support GoPro.png'),
(7, 'Commande reculée', '../../assets/images/Commande reculée.png'),
(8, 'Extracteur', '../../assets/images/Extracteur.png'),
(9, 'SreetCarver', '../../assets/images/SreetCarver.png'),
(10, 'Toupie de frappe', '../../assets/images/Toupie de frappe.png'),
(11, 'TrotSkate', '../../assets/images/TrotSkate.png'),
(12, 'Vanne rapide réservoir', '../../assets/images/Vanne rapide réservoir.png'),
(13, 'test', '../../assets/images/test.png');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `mail` varchar(100) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `ref_fonction` int NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  PRIMARY KEY (`id_user`),
  KEY `fk_user_fonction` (`ref_fonction`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `mail`, `mdp`, `ref_fonction`, `nom`, `prenom`) VALUES
(1, 'Hdidogs.pro@gmail.com', '$2y$10$n559AVXe/BSHpzHrKWPhjezu614JfRvTSWkPBs75NtctaTUN08SGe', 2, 'ROHEE', 'Alexis'),
(2, 't.san-juan@lprs.fr', '$2y$10$ojpmIj.VnKobUJcc.9l57.pMJTeGmA0Ol758Oy.HyDbgN0V8ENWue', 2, 'SAN-JUAN', 'Tristan'),
(6, 's.abdelmalek@lprs.fr', '$2y$10$lYue5l6CoApgmkj8J95p.Oe/xTvHXvOPyEHRITO1Eqp0td/uOB3Ji', 2, 'ABDELMALEK', 'Samy');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `fk_commande_classe` FOREIGN KEY (`ref_classe`) REFERENCES `classe` (`id_classe`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_commande_fournisseur` FOREIGN KEY (`ref_fournisseur`) REFERENCES `fournisseur` (`id_fournisseur`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_commande_matiere` FOREIGN KEY (`ref_matiere`) REFERENCES `matiere` (`id_matiere`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_commande_user` FOREIGN KEY (`ref_user`) REFERENCES `user` (`id_user`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `debit`
--
ALTER TABLE `debit`
  ADD CONSTRAINT `fk_debit_classe` FOREIGN KEY (`ref_classe`) REFERENCES `classe` (`id_classe`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_debit_matiere` FOREIGN KEY (`ref_matiere`) REFERENCES `matiere` (`id_matiere`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_debit_piece` FOREIGN KEY (`ref_piece`) REFERENCES `piece` (`id_piece`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_debit_user` FOREIGN KEY (`ref_user`) REFERENCES `user` (`id_user`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `matiere`
--
ALTER TABLE `matiere`
  ADD CONSTRAINT `fk_piece_forme` FOREIGN KEY (`ref_forme`) REFERENCES `forme` (`id_forme`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_piece_materiau` FOREIGN KEY (`ref_materiau`) REFERENCES `materiau` (`id_materiau`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `matierecommande`
--
ALTER TABLE `matierecommande`
  ADD CONSTRAINT `fk_piececommande_commande` FOREIGN KEY (`ref_commande`) REFERENCES `commande` (`id_commande`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_piececommande_piece` FOREIGN KEY (`ref_matiere`) REFERENCES `matiere` (`id_matiere`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `matierefournisseur`
--
ALTER TABLE `matierefournisseur`
  ADD CONSTRAINT `fk_matierefournisseur_fournisseur` FOREIGN KEY (`ref_fournisseur`) REFERENCES `fournisseur` (`id_fournisseur`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_matierefournisseur_matiere` FOREIGN KEY (`ref_matiere`) REFERENCES `matiere` (`id_matiere`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `matierepiece`
--
ALTER TABLE `matierepiece`
  ADD CONSTRAINT `fk_matierepiece_matiere` FOREIGN KEY (`ref_matiere`) REFERENCES `matiere` (`id_matiere`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_matierepiece_piece` FOREIGN KEY (`ref_piece`) REFERENCES `piece` (`id_piece`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `pieceprojet`
--
ALTER TABLE `pieceprojet`
  ADD CONSTRAINT `fk_pieceprojet_piece` FOREIGN KEY (`ref_piece`) REFERENCES `piece` (`id_piece`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_pieceprojet_projet` FOREIGN KEY (`ref_projet`) REFERENCES `projet` (`id_projet`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_fonction` FOREIGN KEY (`ref_fonction`) REFERENCES `fonction` (`id_fonction`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
