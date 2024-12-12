-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 11, 2024 at 05:42 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ok`
--

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `director` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `actors` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `release_year` year DEFAULT NULL,
  `genre` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `poster_image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `trailer_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `director`, `actors`, `release_year`, `genre`, `poster_image`, `trailer_url`) VALUES
(1, 'SpiderMan : Homecoming', 'Jon Watts', 'Tom Holland, Robert Downey Jr.', '2017', 'Action | Superhero | Adventure', '1.spidermanhomecoming.jpg', 'https://www.youtube.com/watch?v=rk-dF1lIbIg'),
(2, 'Spider-Man 2 (2004)', 'Sam Raimi', 'Tobey Maguire, Kirsten Dunst', '2004', 'Action | Superhero | Adventure', '2-spiderman2.jpg', 'https://www.youtube.com/watch?v=3jBFwltrxJw'),
(4, 'Spider-Man: Far From Home', 'Jon Watts', 'Tom Holland, Zendaya', '2019', 'Action | Superhero | Adventure', '4-spiderfarfromhome.jpg', 'https://www.youtube.com/watch?v=DYYtuKyMtY8'),
(5, 'Your Name.', 'Makoto Shinkai', 'Ryunosuke Kamiki, Mone Kamishiraishi', '2016', 'Anime | Romance | Fantasy', '5-kimi-no-na-wa.jpg', 'https://www.youtube.com/watch?v=s0wTdCQoc2k'),
(6, 'Venom: Let There Be Carnage', 'Andy Serkis', 'Tom Hardy, Woody Harrelson', '2021', 'Action | Superhero | Sci-Fi', '7-venom2.jpg', 'https://www.youtube.com/watch?v=-FmWuCgJmxo'),
(7, 'Venom: The Last Dance', 'Andy Serkis', 'Tom Hardy, Michelle Williams', '2024', 'Action | Superhero | Sci-Fi', '8-venom3.jpg', 'https://www.youtube.com/watch?v=zlTKpqybQTA'),
(9, 'Moana', 'Ron Clements, John Musker', 'Auli’i Cravalho, Dwayne Johnson', '2016', 'Animation | Family | Adventure', '11-moana.jpg', 'https://www.youtube.com/watch?v=LKFuXETZUsI'),
(10, 'Agatha: All Along', 'Gail Lerner', 'Kathryn Hahn, Paul Bettany', '2024', 'Action | Superhero | Fantasy', '10-agatha.jpg', 'https://www.youtube.com/watch?v=R9pXbNz6Vbw'),
(11, 'The Dark Knight (2008)', 'Christopher Nolan', 'Christian Bale, Heath Ledger', '2008', 'Action | Crime | Drama', '12-The_Dark_Knight_(2008_film).jpg', 'https://www.youtube.com/watch?v=EXeTwQWrcwY'),
(12, 'Deadpool & Wolverine', 'Tim Miller', 'Ryan Reynolds, Hugh Jackman', '2024', 'Action | Comedy | Superhero', '13-deadpool_wolverine.jpg', 'https://www.youtube.com/watch?v=paHN0mKXB6Y'),
(13, 'Dune: Part Two', 'Denis Villeneuve', 'Timothée Chalamet, Zendaya', '2024', 'Sci-Fi | Adventure | Drama', '14-dune_part_two.jpg', 'https://www.youtube.com/watch?v=_YUzQa_1RCE'),
(14, 'Godzilla x Kong: The New Empire', 'Adam Wingard', 'Alexander Skarsgård, Millie Bobby Brown', '2024', 'Action | Sci-Fi | Monster', '15-godzilla_x_kong.jpg', 'https://www.youtube.com/watch?v=qqrpMRDuPfc'),
(15, 'Furiosa: A Mad Max Saga', 'George Miller', 'Anya Taylor-Joy, Tom Burke', '2024', 'Action | Adventure | Post-Apocalyptic', '16-furiosa.jpg', 'https://www.youtube.com/watch?v=FVswuip0-co'),
(16, 'Transformers: The One', 'Steven Caple Jr.', 'Anthony Ramos, Dominique Fishback', '2024', 'Animation | Sci-Fi | Action', '17-transformers_the_one.jpg', 'https://www.youtube.com/watch?v=jaVcDaozGgc'),
(17, 'Harry Potter and the Sorcerer\'s Stone', 'Chris Columbus', 'Daniel Radcliffe, Rupert Grint', '2001', 'Fantasy | Adventure | Family', '18-harry_potter_sorcerers_stone.jpg', 'https://www.youtube.com/watch?v=VyHV0BRtdxo'),
(18, 'Harry Potter and the Chamber of Secrets', 'Chris Columbus', 'Daniel Radcliffe, Rupert Grint', '2002', 'Fantasy | Adventure | Family', '19-harry_potter_chamber_secrets.jpg', 'https://www.youtube.com/watch?v=nE11U5iBnH0'),
(19, 'Harry Potter and the Prisoner of Azkaban', 'Alfonso Cuarón', 'Daniel Radcliffe, Gary Oldman', '2004', 'Fantasy | Adventure | Family', '20-harry_potter_prisoner_azkaban.jpg', 'https://www.youtube.com/watch?v=lAxgztbYDbs'),
(20, 'Harry Potter and the Goblet of Fire', 'Mike Newell', 'Daniel Radcliffe, Rupert Grint', '2005', 'Fantasy | Adventure | Family', '21-harry_potter_goblet_fire.jpg', 'https://www.youtube.com/watch?v=iw0RWnC28Gs'),
(21, 'Harry Potter and the Order of the Phoenix', 'David Yates', 'Daniel Radcliffe, Emma Watson', '2007', 'Fantasy | Adventure | Family', '22-harry_potter_order_phoenix.jpg', 'https://www.youtube.com/watch?v=LLAaW1EgyY8'),
(22, 'Harry Potter and the Half-Blood Prince', 'David Yates', 'Daniel Radcliffe, Rupert Grint', '2009', 'Fantasy | Adventure | Family', '23-harry_potter_half_blood_prince.jpg', 'https://www.youtube.com/watch?v=RiAmoT8R4Ic'),
(23, 'Harry Potter and the Deathly Hallows: Part 1', 'David Yates', 'Daniel Radcliffe, Rupert Grint', '2010', 'Fantasy | Adventure | Family', '24-harry_potter_deathly_hallows_part1.jpg', 'https://www.youtube.com/watch?v=MxqsmsA8y5k'),
(24, 'Harry Potter and the Deathly Hallows: Part 2', 'David Yates', 'Daniel Radcliffe, Rupert Grint', '2011', 'Fantasy | Adventure | Family', '25-harry_potter_deathly_hallows_part2.jpg', 'https://www.youtube.com/watch?v=kwM3kN8PNOc'),
(25, 'Venom', 'Ruben Fleischer', 'Tom Hardy, Michelle Williams', '2018', 'Action | Sci-Fi | Thriller', '26-venom.jpg', 'https://www.youtube.com/watch?v=u9Mv98Gr5pY'),
(26, 'Spider-Man', 'Sam Raimi', 'Tobey Maguire, Willem Dafoe', '2002', 'Action | Adventure | Sci-Fi', '27-spiderman.jpg', 'https://www.youtube.com/watch?v=_yhFofFZGcc'),
(27, 'Spider-Man 3', 'Sam Raimi', 'Tobey Maguire, Kirsten Dunst', '2007', 'Action | Adventure | Sci-Fi', '28-spiderman_3.jpg', 'https://www.youtube.com/watch?v=e5wUilOeOmg'),
(28, 'The Amazing Spider-Man 2', 'Marc Webb', 'Andrew Garfield, Jamie Foxx', '2014', 'Action | Adventure | Sci-Fi', '29-the_amazing_spiderman_2.jpg', 'https://www.youtube.com/watch?v=DlM2CWNTQ84'),
(29, 'Spider-Man: No Way Home', 'Jon Watts', 'Tom Holland, Zendaya', '2021', 'Action | Adventure | Sci-Fi', '30-spiderman_no_way_home.jpg', 'https://www.youtube.com/watch?v=JfVOs4VSpmA'),
(30, 'Dead Dead Demon’s Dededede Destruction', 'Shinya Kawai', 'Miku Nakashima, Ryo Kato', '2024', 'Sci-Fi | Comedy | Drama', '32-dead_dead_demon.jpg', 'https://www.youtube.com/watch?v=tm6NNq4SQbc');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'user', '$2y$10$KRBmvYT4xz2tqj83o5xlp.twr44rMM4F4xT3uH4Eres4pHa8mqvB6', 'user'),
(2, 'admin', '$2y$10$FM.ftUoKqlKfkDw9MDqiFegZoT9bXg8e060HHFkg2fZLQ579SL6DG', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `watchlist`
--

CREATE TABLE `watchlist` (
  `id` int NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `movie_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `watchlist`
--

INSERT INTO `watchlist` (`id`, `username`, `movie_id`) VALUES
(18, 'admin', 1),
(19, 'admin', 4),
(20, 'admin', 6),
(24, 'admin', 7),
(25, 'admin', 11),
(22, 'admin', 19),
(23, 'user', 1),
(21, 'user', 2),
(11, 'user', 4),
(10, 'user', 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `watchlist`
--
ALTER TABLE `watchlist`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_watchlist` (`username`,`movie_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `watchlist`
--
ALTER TABLE `watchlist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `watchlist`
--
ALTER TABLE `watchlist`
  ADD CONSTRAINT `watchlist_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
