-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 26, 2018 at 05:30 PM
-- Server version: 5.7.19
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sandi-puzzles`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_02_08_124903_create_posts_table', 2),
(4, '2018_02_08_141557_create_likes_table', 3),
(5, '2018_02_08_142102_create_comments_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE `pictures` (
  `id` int(10) UNSIGNED NOT NULL,
  `author_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `image_main` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `image_main_mini` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `number_zone` int(10) UNSIGNED DEFAULT NULL,
  `wh_cut` int(11) DEFAULT NULL,
  `w_mini` int(11) DEFAULT NULL,
  `h_mini` int(11) DEFAULT NULL,
  `game_visible` int(1) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`id`, `author_id`, `title`, `image_main`, `image_main_mini`, `number_zone`, `wh_cut`, `w_mini`, `h_mini`, `game_visible`, `created_at`, `updated_at`) VALUES
(1, 21, 'game_1', 'c21f969b5f03d33d43e04f8f136e7682.jpg', 'mini_c21f969b5f03d33d43e04f8f136e7682.jpg', 3, 150, 936, 700, 1, '2018-06-25 12:02:34', '2018-06-25 17:43:44'),
(2, 21, 'game_1', '10c2cd8f4eccf824fe8ae90f93eb34dc.jpg', 'mini_10c2cd8f4eccf824fe8ae90f93eb34dc.jpg', 3, 150, 933, 700, 1, '2018-06-25 17:29:57', '2018-06-25 17:43:47'),
(3, 21, 'game_1', 'a0e4037946433791ebcb07a9e317dc95.jpg', 'mini_a0e4037946433791ebcb07a9e317dc95.jpg', 10, 150, 1000, 563, 1, '2018-06-26 08:40:50', '2018-06-26 05:40:50'),
(4, 21, 'game_1', 'a3ca08a97a2e8bee72ee8ceafd19a80e.jpg', 'mini_a3ca08a97a2e8bee72ee8ceafd19a80e.jpg', 5, 100, 1000, 666, 1, '2018-06-26 15:48:40', '2018-06-26 12:48:40'),
(5, 21, 'game_1', 'fdfa16c13b9f1a245ba709442f041cee.jpg', 'mini_fdfa16c13b9f1a245ba709442f041cee.jpg', 3, 150, 700, 700, 1, '2018-06-26 16:24:24', '2018-06-26 13:24:24'),
(6, 21, 'game_1', '145dfc21e38cb7d5cdf7bcc7ca777562.jpg', 'mini_145dfc21e38cb7d5cdf7bcc7ca777562.jpg', 3, 150, 700, 700, 1, '2018-06-26 16:43:06', '2018-06-26 13:43:06'),
(7, 21, 'game_1', 'cf9ff0223e6c6ec6d59483ab5a6c3b60.jpg', 'mini_cf9ff0223e6c6ec6d59483ab5a6c3b60.jpg', 3, 150, 1000, 666, 1, '2018-06-26 17:28:10', '2018-06-26 14:28:10');

-- --------------------------------------------------------

--
-- Table structure for table `picture_1s`
--

CREATE TABLE `picture_1s` (
  `id` int(10) UNSIGNED NOT NULL,
  `pic_id` int(10) UNSIGNED DEFAULT NULL,
  `path_part` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `x1` float DEFAULT NULL,
  `y1` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `picture_1s`
--

INSERT INTO `picture_1s` (`id`, `pic_id`, `path_part`, `x1`, `y1`, `created_at`, `updated_at`) VALUES
(1, 1, 'ecd019b361046fd08f137a46d328f7ea', 0.153846, 0.0528571, '2018-06-25 09:02:37', '2018-06-25 09:02:37'),
(2, 2, '953206f82d514e4fc2940432cc63e4f6', 0.126474, 0.102857, '2018-06-25 14:30:03', '2018-06-25 14:30:03'),
(3, 3, '937e845709d73787c8ef873dd4f95cc6', 0.088, 0.017762, '2018-06-26 05:47:31', '2018-06-26 05:47:31'),
(4, 4, '4fd2d72e71fba88f42fa9ec79a0b5317', 0.125, 0.193694, '2018-06-26 12:48:43', '2018-06-26 12:48:43'),
(5, 5, 'fed64d76d9d3dfb605de689f8887c0f3', 0.128571, 0.1, '2018-06-26 13:24:26', '2018-06-26 13:24:26'),
(6, 6, '4b4366ff3ab408e43181256b54653aae', 0.0614286, 0.05, '2018-06-26 13:43:09', '2018-06-26 13:43:09'),
(7, 7, '9353d4f41da60fcbf135fa2d1dde82b9', 0.096, 0.166667, '2018-06-26 14:28:12', '2018-06-26 14:28:12');

-- --------------------------------------------------------

--
-- Table structure for table `picture_2s`
--

CREATE TABLE `picture_2s` (
  `id` int(10) UNSIGNED NOT NULL,
  `pic_id` int(10) UNSIGNED DEFAULT NULL,
  `path_part` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `x1` float DEFAULT NULL,
  `y1` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `picture_2s`
--

INSERT INTO `picture_2s` (`id`, `pic_id`, `path_part`, `x1`, `y1`, `created_at`, `updated_at`) VALUES
(1, 1, '85bebcc26a93decb429ae26d80819074', 0.41453, 0.07, '2018-06-25 09:02:38', '2018-06-25 09:02:38'),
(2, 2, '727dd1d1b07f29e798fd041f94aca0c4', 0.375134, 0.105714, '2018-06-25 14:30:04', '2018-06-25 14:30:04'),
(3, 3, 'a36294f323dc208a9ffba34aa69fe6ab', 0.092, 0.314387, '2018-06-26 05:47:34', '2018-06-26 05:47:34'),
(4, 4, '685b062c9e4401bde1ff6f4f604877b4', 0.426, 0.033033, '2018-06-26 12:48:45', '2018-06-26 12:48:45'),
(5, 5, 'fe87af607c230b349012821bad9ca7a4', 0.394286, 0.104286, '2018-06-26 13:24:27', '2018-06-26 13:24:27'),
(6, 6, 'dbcf7b402aee25724dd5ceb4e6835667', 0.331429, 0.0542857, '2018-06-26 13:43:10', '2018-06-26 13:43:10'),
(7, 7, '4b4f2aa9536c2a76792cb96795970df2', 0.282, 0.166667, '2018-06-26 14:28:14', '2018-06-26 14:28:14');

-- --------------------------------------------------------

--
-- Table structure for table `picture_3s`
--

CREATE TABLE `picture_3s` (
  `id` int(10) UNSIGNED NOT NULL,
  `pic_id` int(10) UNSIGNED DEFAULT NULL,
  `path_part` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `x1` float DEFAULT NULL,
  `y1` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `picture_3s`
--

INSERT INTO `picture_3s` (`id`, `pic_id`, `path_part`, `x1`, `y1`, `created_at`, `updated_at`) VALUES
(1, 1, '0d40ac324cc3bc5bb08a1b652512141c', 0.78312, 0.0657143, '2018-06-25 09:02:40', '2018-06-25 09:02:40'),
(2, 2, '41cc1eb7710ddba1d207f945ad88becd', 0.606645, 0.102857, '2018-06-25 14:30:05', '2018-06-25 14:30:05'),
(3, 3, 'd21651dea6296fe8d120f43034709623', 0.255, 0.127886, '2018-06-26 05:47:36', '2018-06-26 05:47:36'),
(4, 4, 'e88c754c4a4fb438a41d2dfa642cacc9', 0.574, 0.042042, '2018-06-26 12:48:46', '2018-06-26 12:48:46'),
(5, 5, 'e8abb41779358b487b7f33b71fc27ceb', 0.687143, 0.104286, '2018-06-26 13:24:28', '2018-06-26 13:24:28'),
(6, 6, '5ce579766a1e3436da5e3f30c3b89fc5', 0.577143, 0.0542857, '2018-06-26 13:43:13', '2018-06-26 13:43:13'),
(7, 7, '6c0ebeee3e645a10c49e29ebf6547df1', 0.491, 0.159159, '2018-06-26 14:28:15', '2018-06-26 14:28:15');

-- --------------------------------------------------------

--
-- Table structure for table `picture_4s`
--

CREATE TABLE `picture_4s` (
  `id` int(10) UNSIGNED NOT NULL,
  `pic_id` int(10) UNSIGNED DEFAULT NULL,
  `path_part` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `x1` float DEFAULT NULL,
  `y1` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `picture_4s`
--

INSERT INTO `picture_4s` (`id`, `pic_id`, `path_part`, `x1`, `y1`, `created_at`, `updated_at`) VALUES
(1, 3, '73fd6b07e4dbbd87003333695e261b92', 0.417, 0.30373, '2018-06-26 05:47:38', '2018-06-26 05:47:38'),
(2, 4, '46cf73bac47a5d6b97c366e838b02a8c', 0.871, 0.136637, '2018-06-26 12:48:47', '2018-06-26 12:48:47');

-- --------------------------------------------------------

--
-- Table structure for table `picture_5s`
--

CREATE TABLE `picture_5s` (
  `id` int(10) UNSIGNED NOT NULL,
  `pic_id` int(10) UNSIGNED DEFAULT NULL,
  `path_part` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `x1` float DEFAULT NULL,
  `y1` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `picture_5s`
--

INSERT INTO `picture_5s` (`id`, `pic_id`, `path_part`, `x1`, `y1`, `created_at`, `updated_at`) VALUES
(1, 3, 'fb783f98a26d5a7408c1a14ab2e53c91', 0.643, 0.0568384, '2018-06-26 05:47:40', '2018-06-26 05:47:40'),
(2, 4, 'b5dbc718690d7559ec8e0234d54644f7', 0.29, 0.225225, '2018-06-26 12:48:58', '2018-06-26 12:48:58');

-- --------------------------------------------------------

--
-- Table structure for table `picture_6s`
--

CREATE TABLE `picture_6s` (
  `id` int(10) UNSIGNED NOT NULL,
  `pic_id` int(10) UNSIGNED DEFAULT NULL,
  `path_part` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `x1` float DEFAULT NULL,
  `y1` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `picture_6s`
--

INSERT INTO `picture_6s` (`id`, `pic_id`, `path_part`, `x1`, `y1`, `created_at`, `updated_at`) VALUES
(1, 3, 'edf3b8379bfe9e91daad956716ebf8a3', 0.641, 0.332149, '2018-06-26 05:47:42', '2018-06-26 05:47:42');

-- --------------------------------------------------------

--
-- Table structure for table `picture_7s`
--

CREATE TABLE `picture_7s` (
  `id` int(10) UNSIGNED NOT NULL,
  `pic_id` int(10) UNSIGNED DEFAULT NULL,
  `path_part` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `x1` float DEFAULT NULL,
  `y1` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `picture_7s`
--

INSERT INTO `picture_7s` (`id`, `pic_id`, `path_part`, `x1`, `y1`, `created_at`, `updated_at`) VALUES
(1, 3, '3a624d44623a2b1a1b934a11c244e311', 0.83, 0, '2018-06-26 05:47:44', '2018-06-26 05:47:44');

-- --------------------------------------------------------

--
-- Table structure for table `picture_8s`
--

CREATE TABLE `picture_8s` (
  `id` int(10) UNSIGNED NOT NULL,
  `pic_id` int(10) UNSIGNED DEFAULT NULL,
  `path_part` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `x1` float DEFAULT NULL,
  `y1` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `picture_8s`
--

INSERT INTO `picture_8s` (`id`, `pic_id`, `path_part`, `x1`, `y1`, `created_at`, `updated_at`) VALUES
(1, 3, 'e1fc6d99acb8163563302ea7dd91103b', 0.818, 0.291297, '2018-06-26 05:47:46', '2018-06-26 05:47:46');

-- --------------------------------------------------------

--
-- Table structure for table `picture_9s`
--

CREATE TABLE `picture_9s` (
  `id` int(10) UNSIGNED NOT NULL,
  `pic_id` int(10) UNSIGNED DEFAULT NULL,
  `path_part` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `x1` float DEFAULT NULL,
  `y1` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `picture_9s`
--

INSERT INTO `picture_9s` (`id`, `pic_id`, `path_part`, `x1`, `y1`, `created_at`, `updated_at`) VALUES
(1, 3, 'd59b62b212df60e61cffb98a4f8bc414', 0.648, 0.612789, '2018-06-26 05:47:50', '2018-06-26 05:47:50');

-- --------------------------------------------------------

--
-- Table structure for table `picture_10s`
--

CREATE TABLE `picture_10s` (
  `id` int(10) UNSIGNED NOT NULL,
  `pic_id` int(10) UNSIGNED DEFAULT NULL,
  `path_part` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `x1` float DEFAULT NULL,
  `y1` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `picture_10s`
--

INSERT INTO `picture_10s` (`id`, `pic_id`, `path_part`, `x1`, `y1`, `created_at`, `updated_at`) VALUES
(1, 3, '9a0eff7017abf8589d94965d7cacc64d', 0.428, 0.596803, '2018-06-26 05:47:52', '2018-06-26 05:47:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `avatar` varchar(256) NOT NULL DEFAULT 'default.jpg',
  `email` varchar(191) NOT NULL,
  `password` varchar(191) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `access` tinyint(1) NOT NULL DEFAULT '0',
  `admin_role` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `avatar`, `email`, `password`, `remember_token`, `access`, `admin_role`, `created_at`, `updated_at`) VALUES
(1, 'Карцев Денис', 'default03.jpg', 'kartsev@sandiplus.com.ua', '$2y$10$96ME2/3Jt10BAE//qtJsFejE7UjHFkwrsYY3Jz1qwVReZLx4gRXBW', 'gJuZo2m4xX6632jSI9Pvd62t8bpEJyxKYW3qmqNqVYS4UvSD5AQRBAcYKbel', 1, 1, '2018-02-28 22:00:00', '2018-04-10 09:56:33'),
(2, 'Пирог Андрей', '4fb940531bf511b52b86cb45ed0d1e2b.jpg', 'pirog.andrej@gmail.com', '$2a$04$sdAaam6lOCPXvejQ0YRykOEEt5GifIPWCsFjvtmBIg0iUEWci./wm', 'zvEqcDR6wUIx9sZnHHfw6X3YSh0eATYQsoIIP9eNb1l2a6cSeQV7Tf6BwNzA', 1, 1, '2018-02-28 22:00:00', '2018-04-10 09:56:14'),
(21, 'Золотарев Александр', '37b81bc0f19e30d7be5b8545a1553c4b.jpg', '111111', '$2y$10$w2WHV9l2921xKutL5etj1ewXPwDnxYYJstVM4taXv5jxM39AA6zIS', 'VZ30vthU1u74i4CEYsboUVl3rXSG6Glv27fwozAbfoL6ldP6rAWMDIU4Edm3', 1, 1, '2018-04-12 06:42:08', '2018-06-13 10:12:23'),
(29, '88', 'd30d692d44a84c83f6348a438d42857b.png', '88', '$2y$10$fBrjO3kZ0Vb5cDvNUY2tE.o7i.W9/JGsRmKOUnD3mR5IoiENqGpde', NULL, 1, 0, '2018-05-17 13:39:46', '2018-05-17 13:39:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `picture_1s`
--
ALTER TABLE `picture_1s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `picture_2s`
--
ALTER TABLE `picture_2s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `picture_3s`
--
ALTER TABLE `picture_3s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `picture_4s`
--
ALTER TABLE `picture_4s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `picture_5s`
--
ALTER TABLE `picture_5s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `picture_6s`
--
ALTER TABLE `picture_6s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `picture_7s`
--
ALTER TABLE `picture_7s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `picture_8s`
--
ALTER TABLE `picture_8s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `picture_9s`
--
ALTER TABLE `picture_9s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `picture_10s`
--
ALTER TABLE `picture_10s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `picture_1s`
--
ALTER TABLE `picture_1s`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `picture_2s`
--
ALTER TABLE `picture_2s`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `picture_3s`
--
ALTER TABLE `picture_3s`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `picture_4s`
--
ALTER TABLE `picture_4s`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `picture_5s`
--
ALTER TABLE `picture_5s`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `picture_6s`
--
ALTER TABLE `picture_6s`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `picture_7s`
--
ALTER TABLE `picture_7s`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `picture_8s`
--
ALTER TABLE `picture_8s`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `picture_9s`
--
ALTER TABLE `picture_9s`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `picture_10s`
--
ALTER TABLE `picture_10s`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
