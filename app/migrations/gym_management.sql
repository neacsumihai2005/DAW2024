-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: dec. 20, 2024 la 04:03 PM
-- Versiune server: 10.4.32-MariaDB
-- Versiune PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `gym_management`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `exercises`
--

CREATE TABLE `exercises` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `category` varchar(50) NOT NULL,
  `youtube_video_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `exercises`
--

INSERT INTO `exercises` (`id`, `name`, `description`, `category`, `youtube_video_id`) VALUES
(1, 'Squat', 'Exercitiu pentru picioare care lucreaza coapsele si fesierii', 'Strength', 'l83R5PblSMA'),
(2, 'Push-up', 'Exercitiu pentru piept, umeri si triceps', 'Strength', '3qCnU1TZboY'),
(3, 'Running', 'Exercitiu cardio pentru imbunatatirea rezistentei', 'Cardio', 'N9C88z3g0Es'),
(4, 'Deadlift', 'Exercitiu de forta pentru spate si picioare', 'Strength', '2SJ9HkKaxwU');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `group_classes`
--

CREATE TABLE `group_classes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `instructor_id` int(11) DEFAULT NULL,
  `schedule` datetime DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `group_classes`
--

INSERT INTO `group_classes` (`id`, `name`, `description`, `instructor_id`, `schedule`, `capacity`) VALUES
(1, 'Yoga', 'Clasa de yoga pentru toate nivelele, cu focus pe relaxare si flexibilitate.', 2, '2024-11-12 18:00:00', 20),
(2, 'Pilates', 'Clasa de Pilates pentru tonifiere si imbunatatirea posturii.', 3, '2024-11-13 10:00:00', 15),
(3, 'das', 'asd', 2, '2024-12-18 16:24:00', 213),
(4, 'dsadsa', 'dsadas', 2, '2024-12-12 16:24:00', 123);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role_id`, `date_of_birth`, `phone_number`) VALUES
(2, 'Maria', 'Ionescu', 'maria.ionescu@example.com', '$2y$10$Dcv55ZBljOjmO0S5n3FEO8W5dC6YX6VgJr2llT/lt4Zc9gnxCwHsq', 1, '1985-04-20', '0723456789'),
(3, 'Andrei', 'Vasilescu', 'andrei.vasilescu@example.com', '$2y$10$Dcv55ZBljOjmO0S5n3FEO8W5dC6YX6VgJr2llT/lt4Zc9gnxCwHsq', 3, '1980-03-10', '0734567892'),
(8, 'mihai', 'neacsu', 'mihai.neacsu@yahoo.com', 'abcdefgh', 2, '1983-03-12', '0722222222');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `workouts`
--

CREATE TABLE `workouts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `exercise_id` int(11) NOT NULL,
  `sets` int(11) NOT NULL,
  `reps` int(11) NOT NULL,
  `weight` decimal(10,2) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `workouts`
--

INSERT INTO `workouts` (`id`, `user_id`, `exercise_id`, `sets`, `reps`, `weight`, `date`) VALUES
(2, 8, 1, 1, 1, NULL, '2024-12-20 13:43:01'),
(3, 8, 1, 1, 1, NULL, '2024-12-20 13:44:43'),
(4, 8, 1, 1, 1, NULL, '2024-12-20 13:47:45'),
(5, 8, 1, 1, 11, NULL, '2024-12-20 13:49:26'),
(6, 8, 1, 1, 11, NULL, '2024-12-20 13:49:47'),
(7, 8, 1, 1, 11, NULL, '2024-12-20 13:50:18'),
(8, 8, 1, 321, 312, NULL, '2024-12-20 13:56:49'),
(9, 8, 1, 132, 132, 213.00, '2024-12-20 13:59:31'),
(10, 2, 1, 2, 1, 0.20, '2024-12-20 14:38:12');

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `group_classes`
--
ALTER TABLE `group_classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instructor_id` (`instructor_id`);

--
-- Indexuri pentru tabele `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexuri pentru tabele `workouts`
--
ALTER TABLE `workouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `exercise_id` (`exercise_id`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `exercises`
--
ALTER TABLE `exercises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pentru tabele `group_classes`
--
ALTER TABLE `group_classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pentru tabele `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pentru tabele `workouts`
--
ALTER TABLE `workouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constrângeri pentru tabele eliminate
--

--
-- Constrângeri pentru tabele `group_classes`
--
ALTER TABLE `group_classes`
  ADD CONSTRAINT `group_classes_ibfk_1` FOREIGN KEY (`instructor_id`) REFERENCES `users` (`id`);

--
-- Constrângeri pentru tabele `workouts`
--
ALTER TABLE `workouts`
  ADD CONSTRAINT `workouts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `workouts_ibfk_2` FOREIGN KEY (`exercise_id`) REFERENCES `exercises` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
