-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04/07/2024 às 16:03
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `loja`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `message` text NOT NULL,
  `answer` text DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `message_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `answer_created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `chat`
--

INSERT INTO `chat` (`id`, `user_id`, `product_id`, `message`, `answer`, `active`, `message_created_at`, `answer_created_at`, `deleted_at`) VALUES
(86, 20, 63, 'oi', 'ola', 0, '2024-07-04 13:57:50', '2024-07-04 13:58:57', '2024-07-04 13:59:06'),
(87, 20, 62, 'tenho interesse', 'ok', 0, '2024-07-04 13:58:04', '2024-07-04 13:58:46', NULL),
(88, 20, 61, 'nova?', NULL, 0, '2024-07-04 13:58:18', NULL, '2024-07-04 13:58:40'),
(89, 20, 63, 'ooo', 'ff', 0, '2024-07-04 13:59:16', '2024-07-04 14:00:04', NULL),
(90, 20, 62, 'gfg', NULL, 0, '2024-07-04 13:59:27', NULL, '2024-07-04 13:59:49'),
(91, 20, 62, 't', NULL, 1, '2024-07-04 14:00:26', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` double(8,2) DEFAULT NULL,
  `description` varchar(250) NOT NULL,
  `img_src` varchar(150) NOT NULL,
  `img_file_name` varchar(200) DEFAULT NULL,
  `link` text NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `img_src`, `img_file_name`, `link`, `updated_at`, `created_at`, `deleted_at`) VALUES
(56, 'blusa preta', 200.00, 'wwfwef', 'assets/images/blank-image.jpg', 'blusa preta_1719248970602.png', 'f', '2024-06-24 17:09:30', '2024-06-24 17:09:30', '2024-06-24 18:12:14'),
(58, 'jaquet', 200.00, '2', 'assets/images/blank-image.jpg', 'jaquet_1719249029720.png', '2', '2024-06-24 17:10:29', '2024-06-24 17:10:29', '2024-06-24 17:39:08'),
(59, 'oculos', 100.00, 'dsdgsgsd', 'assets/images/blank-image.jpg', 'oculos_1719249063231.png', '2424\'', '2024-06-24 17:11:03', '2024-06-24 17:11:03', '2024-06-25 12:51:54'),
(60, 'jaqueta', 200.00, 'a jaqueta laranja é uma peça vibrante e estilosa, perfeita para quem deseja adicionar um toque de cor e personalidade ao seu guarda-roupa. feita com materiais de alta qualidade, essa jaqueta combina conforto e durabilidade, sendo ideal para diversas ', 'assets/images/blank-image.jpg', 'jaqueta_1719252266388.png', 'www.google.com', '2024-06-24 18:04:26', '2024-06-24 18:04:26', '2024-06-25 12:51:48'),
(61, 'Blusa branca', 93.45, '1', 'assets/images/products/Blusa branca_1719319222130.png', 'Blusa branca_1719319222130.png', '1', '2024-06-25 13:06:26', '2024-06-25 12:40:22', NULL),
(62, 'botas', 112.34, 'r', 'assets/images/products/botas_1719319250322.png', 'botas_1719319250322.png', 'r', '2024-06-25 12:40:50', '2024-06-25 12:40:50', NULL),
(63, 'sneakers', 1234.56, '1', 'assets/images/products/sneakers_1719319271396.png', 'sneakers_1719319271396.png', '1', '2024-06-25 12:41:11', '2024-06-25 12:41:11', NULL),
(64, 'Jaqueta', 250.00, 'Jaqueta estilosa e versátil, perfeita para todas as estações. Confortável, durável e moderna, ideal para qualquer ocasião.', 'assets/images/blank-image.jpg', 'Jaqueta_1719945454452.png', 'www.googl.com', '2024-07-02 18:39:20', '2024-06-25 12:52:15', '2024-07-04 13:21:14'),
(65, 'Touca', 0.00, 'boa', 'assets/images/blank-image.jpg', 'Touca_1719320844948.png', '1', '2024-06-27 19:10:36', '2024-06-25 13:07:24', '2024-07-01 17:04:19'),
(66, 'Touca', 120.33, 'boa', 'assets/images/blank-image.jpg', 'Touca_1720034446206.png', 'www', '2024-07-03 19:20:46', '2024-07-03 19:20:46', '2024-07-04 13:21:09'),
(67, 'jeans', 90.00, 'boa', 'assets/images/blank-image.jpg', 'jeans_1720093378198.png', 'www', '2024-07-04 11:42:58', '2024-07-04 11:42:58', '2024-07-04 13:12:26'),
(68, 'boné', 0.00, 'ng', 'assets/images/blank-image.jpg', 'boné_1720094068481.png', '222', '2024-07-04 12:45:30', '2024-07-04 11:43:42', '2024-07-04 13:10:49');

-- --------------------------------------------------------

--
-- Estrutura para tabela `product_messages`
--

CREATE TABLE `product_messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `message` varchar(300) DEFAULT NULL,
  `answer` text DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `message_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `answer_created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `product_messages`
--

INSERT INTO `product_messages` (`id`, `user_id`, `product_id`, `message`, `answer`, `active`, `message_created_at`, `answer_created_at`, `deleted_at`) VALUES
(88, 20, 65, 'disponível?', 'sim', 0, '2024-06-26 18:43:36', '2024-06-26 18:43:49', '2024-06-26 18:45:05'),
(89, 20, 65, 'Como faço para comprar?', 'Clica no botão \"entrar em contato\"', 0, '2024-06-26 18:44:07', '2024-06-26 18:44:45', NULL),
(90, 20, 64, 'kkkkk', NULL, 0, '2024-06-26 18:44:18', NULL, '2024-06-26 18:44:25'),
(91, 20, 64, 'oi', NULL, 1, '2024-06-26 18:44:53', NULL, NULL),
(92, 20, 62, 'quero', 'Ok', 0, '2024-06-27 12:34:20', '2024-07-01 16:53:55', NULL),
(93, 20, 67, 'oi', NULL, 1, '2024-07-04 12:56:16', NULL, NULL),
(94, 20, 62, 'oi', NULL, 0, '2024-07-04 13:24:34', NULL, '2024-07-04 13:24:47'),
(95, 20, 62, 'oi', NULL, 1, '2024-07-04 13:24:54', NULL, NULL),
(96, 20, 61, 'oi', NULL, 1, '2024-07-04 13:24:58', NULL, NULL),
(97, 20, 63, 'oi', NULL, 1, '2024-07-04 14:01:03', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT '''client''',
  `password` text NOT NULL,
  `password_reset_token` varchar(250) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `purl` varchar(300) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `user_type`, `password`, `password_reset_token`, `active`, `purl`, `updated_at`, `created_at`, `deleted_at`) VALUES
(1, 'welerr', 'welerson194@gmail.com', 'admin', '$2y$10$2hYbGyzKLh/cEgyGqC587eN1yUEuJaIE/qp81n7DUp6MCz1UKEtzO', 'dfe8e8b2f438329867b50f2fbc6380fef511cce67e93a28afae36c1697190d70', 1, '', '2024-07-02 18:16:32', '2024-05-28 14:11:17', NULL),
(20, 'ana', 'welerson25@yahoo.com', 'client', '$2y$10$eLn4tAL5vDVO0t2Q0tK63ua5WiS4gADsaHSDAIXyLzCeWkuYMr4KK', NULL, 1, '', '2024-06-26 18:42:32', '2024-06-26 18:42:07', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`user_id`);

--
-- Índices de tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `product_messages`
--
ALTER TABLE `product_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_msg_product_id` (`product_id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de tabela `product_messages`
--
ALTER TABLE `product_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `product_messages`
--
ALTER TABLE `product_messages`
  ADD CONSTRAINT `product_msg_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
