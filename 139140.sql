-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  jeu. 30 juil. 2020 à 20:45
-- Version du serveur :  10.3.22-MariaDB-log
-- Version de PHP :  7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `139140`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Structure de la table `exercice`
--

CREATE TABLE `exercice` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `parametre` varchar(255) NOT NULL,
  `amenitie` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `exercice`
--

INSERT INTO `exercice` (`id`, `description`, `address`, `image`, `parametre`, `amenitie`) VALUES
(1, 'Однакомнатная квартира', 'Ул. шоссе 18', '1.png', 'возможность проживать с детьми и с животными', 'наличие холодильника, телевизора, балкона, стиральной машины'),
(2, 'Однакомнатная квартира', 'Г. Москва , М. курская', '2.png', 'возможность проживать с детьми и с животными', 'наличие холодильника, телевизора, балкона, стиральной машины'),
(3, 'Двухкомнатная квартира', 'Проспект Мира', '3.jpg', 'возможность проживать с детьми и с животными', 'наличие холодильника, телевизора, балкона, стиральной машины'),
(4, 'Двухкомнатная квартира', 'Рядом с метро менделеевская', '4.jpg', 'возможность проживать с детьми и с животными', 'наличие холодильника, телевизора, балкона, стиральной машины'),
(5, 'Аппартамент ', 'Ул Новый арбат', '5.jpg', 'возможность проживать с детьми и с животными', 'наличие холодильника, телевизора, балкона, стиральной машины'),
(6, 'Аппартамент люкс', 'Москва сити ,', '6.jpg', 'возможность проживать с детьми и с животными', 'наличие холодильника, телевизора, балкона, стиральной машины'),
(7, 'Аппартамент', 'Ул старый арбат', '7.jpg', 'возможность проживать с детьми и с животными', 'наличие холодильника, телевизора, балкона, стиральной машины'),
(9, 'Gdgsjhfgsj', 'ashgdjah', 'no_image.png', 'asjhdj hakjshd kjashdjk ahsd', 'asjdkhasdhajksdhk shd kjashdjk ash kjahsdk asd'),
(10, 'dedae', 'dada', '11.2.png', 'dawdaw', 'daw daw');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `exercice`
--
ALTER TABLE `exercice`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `exercice`
--
ALTER TABLE `exercice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
