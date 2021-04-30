-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 21 avr. 2021 à 15:36
-- Version du serveur :  10.4.18-MariaDB
-- Version de PHP : 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `movieproject`
--

-- --------------------------------------------------------

--
-- Structure de la table `actors`
--

CREATE TABLE `actors` (
  `id` int(11) NOT NULL,
  `firstName` varchar(30) COLLATE utf8_bin NOT NULL,
  `lastName` varchar(30) COLLATE utf8_bin NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('male','female','other','') COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `actors`
--

INSERT INTO `actors` (`id`, `firstName`, `lastName`, `date_of_birth`, `gender`) VALUES
(1, 'Bruce', 'Willis', '1961-04-12', 'male'),
(2, 'Bruce', 'Willis', '1961-04-12', 'male'),
(3, 'Tim', 'Robbins', '1958-10-16', 'male'),
(4, 'Morgan', 'Freeman', '1937-06-01', 'male'),
(5, 'Uma', 'Thurman', '1970-04-29', 'female'),
(6, 'Scarlett', 'Johansson', '1984-11-22', 'female'),
(7, 'Bradley', 'Cooper', '1975-01-05', 'male');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `title` varchar(30) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `title`) VALUES
(1, 'Action'),
(3, 'Comedy'),
(4, 'Drama'),
(5, 'Horror'),
(12, 'Thriller'),
(15, 'Political'),
(16, 'War');

-- --------------------------------------------------------

--
-- Structure de la table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title` varchar(30) COLLATE utf8_bin NOT NULL,
  `poster` text COLLATE utf8_bin NOT NULL,
  `synopsis` text COLLATE utf8_bin NOT NULL,
  `category_id` int(11) NOT NULL,
  `actor_id` int(11) NOT NULL,
  `date_of_release` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `movies`
--

INSERT INTO `movies` (`id`, `title`, `poster`, `synopsis`, `category_id`, `actor_id`, `date_of_release`) VALUES
(1, 'Die Soft', 'https://m.media-amazon.com/images/M/MV5BZjRlNDUxZjAtOGQ4OC00OTNlLTgxNmQtYTBmMDgwZmNmNjkxXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_.jpg', 'this fil is noce', 1, 1, '2021-04-01'),
(3, 'The Shawshank Redemption', 'https://images-na.ssl-images-amazon.com/images/I/519NBNHX5BL._SY445_.jpg', 'Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency. ', 4, 4, '2021-04-04'),
(4, 'Avengers : Infinity War', 'https://images-na.ssl-images-amazon.com/images/I/81%2Bmjs3iJ-L._SL1310_.jpg', 'The Avengers and their allies must be willing to sacrifice all in an attempt to defeat the powerful Thanos before his blitz of devastation and ruin puts an end to the universe. ', 1, 6, '2012-04-17'),
(5, 'Pulp Fiction', 'https://upload.wikimedia.org/wikipedia/en/3/3b/Pulp_Fiction_%281994%29_poster.jpg', 'The lives of two mob hitmen, a boxer, a gangster and his wife, and a pair of diner bandits intertwine in four tales of violence and redemption. ', 1, 5, '2001-01-09'),
(6, 'The hangover', 'https://upload.wikimedia.org/wikipedia/en/b/b9/Hangoverposter09.jpg', 'Three buddies wake up from a bachelor party in Las Vegas, with no memory of the previous night and the bachelor missing. They make their way around the city in order to find their friend before his wedding. ', 3, 7, '1975-06-19'),
(10, 'Kill Bill Vol 2', 'https://upload.wikimedia.org/wikipedia/en/thumb/c/c4/Kill_Bill_Volume_2.png/220px-Kill_Bill_Volume_2.png', 'Bill is back again and this time he really needs to be killed', 1, 5, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `playlists`
--

CREATE TABLE `playlists` (
  `id` int(11) NOT NULL,
  `title` varchar(30) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL,
  `creation_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `playlists`
--

INSERT INTO `playlists` (`id`, `title`, `user_id`, `creation_date`) VALUES
(5, 'Tests playlist', 4, '2021-04-21'),
(7, 'Domiens Playlist', 4, '2021-04-21'),
(10, 'Liora\'s Films', 4, '2021-04-21');

-- --------------------------------------------------------

--
-- Structure de la table `playlist_content`
--

CREATE TABLE `playlist_content` (
  `playlist_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `playlist_content`
--

INSERT INTO `playlist_content` (`playlist_id`, `movie_id`) VALUES
(5, 3),
(5, 4),
(7, 3),
(7, 1),
(7, 4),
(7, 5),
(5, 1),
(5, 3),
(5, 1),
(5, 3),
(10, 1),
(10, 3),
(10, 5),
(10, 10),
(10, 4);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstName` varchar(30) COLLATE utf8_bin NOT NULL,
  `lastName` varchar(30) COLLATE utf8_bin NOT NULL,
  `mail` varchar(30) COLLATE utf8_bin NOT NULL,
  `password` varchar(70) COLLATE utf8_bin NOT NULL,
  `isAdmin` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `firstName`, `lastName`, `mail`, `password`, `isAdmin`) VALUES
(1, 'David', 'Ferns ', 'david@gmail.com', '$2y$10$X2MWNyXR/ScVZexBXgb8huP3OCoGH6sr.lK.YX6waJvd.iZJJR/UC', 1),
(2, 'Admin', 'Admin ', 'admin@a.a', '$2y$10$FxOTO7oRGDBvwi49RzHxWeXjYIBUc69eyLBxF4vZGYOvQXxEGWo2e', 1),
(3, 'David', 'Ferns ', 'Thebigman@gmail.com', '$2y$10$3wqharzx/8qQmWwcFn1dO.xvbVV.WdXvJfDepq4g/7xiXGM0xf7hq', 0),
(4, 'Test', 'Test ', 'TestAccount@test.com', '$2y$10$/FeykPfoq0utgw5hQu0fM.QXY8Xt9yB7kgJ27s7QWd7VyfgYcipa2', 1),
(5, 'notAdmin', 'notAdmin ', 'notAdmin@gmail.com', '$2y$10$z4BchRo0MjQP.5S6s3MhxuvY1RRaB94QAYHwCDBA456WYA0ZlZVTu', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `actors`
--
ALTER TABLE `actors`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `actor_id` (`actor_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Index pour la table `playlists`
--
ALTER TABLE `playlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `playlist_content`
--
ALTER TABLE `playlist_content`
  ADD KEY `playlist_id` (`playlist_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `actors`
--
ALTER TABLE `actors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `playlists`
--
ALTER TABLE `playlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_ibfk_1` FOREIGN KEY (`actor_id`) REFERENCES `actors` (`id`),
  ADD CONSTRAINT `movies_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Contraintes pour la table `playlists`
--
ALTER TABLE `playlists`
  ADD CONSTRAINT `playlists_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `playlist_content`
--
ALTER TABLE `playlist_content`
  ADD CONSTRAINT `playlist_content_ibfk_1` FOREIGN KEY (`playlist_id`) REFERENCES `playlists` (`id`),
  ADD CONSTRAINT `playlist_content_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
