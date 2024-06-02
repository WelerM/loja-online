-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02/06/2024 às 23:19
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
-- Estrutura para tabela `admin_chat_messages`
--

CREATE TABLE `admin_chat_messages` (
  `id` int(11) NOT NULL,
  `message` varchar(300) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `description` varchar(250) NOT NULL,
  `img_src` varchar(150) NOT NULL,
  `img_file_name` varchar(200) DEFAULT NULL,
  `link` text NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `img_src`, `img_file_name`, `link`, `updated_at`, `created_at`) VALUES
(13, 'jaqueta', 200, 'cor laranja', 'assets/images/products/jaqueta_1716919630880.png', 'jaqueta_1716919630880.png', 'www.google.com', '2024-06-02 20:43:43', '2024-05-28 18:07:10'),
(14, 'óculos', 200, 'cor preto', 'assets/images/products/óculos_1716919737530.png', 'óculos_1716919737530.png', 'www.google.com', '2024-05-28 18:08:57', '2024-05-28 18:08:57'),
(15, 'cargo pants used', 90, 'second hand', 'assets/images/products/cargo pants_1717003367482.png', 'cargo pants_1717003367482.png', 'www.google.com', '2024-06-02 20:31:03', '2024-05-29 17:22:47'),
(16, 'snears', 240, 'beautiful', 'assets/images/products/snears_1717249708812.png', 'snears_1717249708812.png', 'wwww.google.com', '2024-06-01 13:48:28', '2024-06-01 13:48:28'),
(17, 'hat', 100, 'warm', 'assets/images/products/hat_1717257861158.png', 'hat_1717257861158.png', 'www.google.com', '2024-06-01 16:04:21', '2024-06-01 16:04:21');

-- --------------------------------------------------------

--
-- Estrutura para tabela `product_answers`
--

CREATE TABLE `product_answers` (
  `id` int(11) NOT NULL,
  `answer` varchar(300) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `product_answers`
--

INSERT INTO `product_answers` (`id`, `answer`, `created_at`) VALUES
(1, 'oii', '2024-06-02 20:11:42'),
(2, 'cdfgdf', '2024-06-02 20:14:15'),
(3, 'fdfdf', '2024-06-02 20:15:23'),
(4, 'fdfd', '2024-06-02 20:27:12'),
(5, 'fdfd', '2024-06-02 20:27:23');

-- --------------------------------------------------------

--
-- Estrutura para tabela `product_messages`
--

CREATE TABLE `product_messages` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `answer_id` int(11) DEFAULT NULL,
  `message` varchar(300) DEFAULT NULL,
  `active` tinyint(4) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `product_messages`
--

INSERT INTO `product_messages` (`id`, `product_id`, `user_id`, `answer_id`, `message`, `active`, `created_at`) VALUES
(1, 13, 1, 1, 'ola', 0, '2024-06-02 20:11:42'),
(7, 15, 1, 7, 'oi', 0, '2024-06-02 20:14:15'),
(8, 14, 1, 8, 'ola', 0, '2024-06-02 20:15:23'),
(9, 13, 1, 9, 'sdsdsd', 0, '2024-06-02 20:27:12'),
(10, 13, 1, 10, 'sdsdsd', 0, '2024-06-02 20:27:23');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `user_type`, `password`, `password_reset_token`, `active`, `purl`, `updated_at`, `created_at`) VALUES
(1, 'weler', 'welerson194@gmail.com', 'admin', '$2y$10$yK3ynBNhbLt8GEYWl1VlreXWzePgZ2PjdB7Ujy9KwQBWdPMOVwKGi', 'dfe8e8b2f438329867b50f2fbc6380fef511cce67e93a28afae36c1697190d70', 1, '', '2024-05-28 14:15:46', '2024-05-28 14:11:17'),
(4, 'ana', 'welerson25@yahoo.com', 'client', '$2y$10$ghrNbrjpN/THAKVFZOpJwe.gfre4/fBj43QhYItrnO2RawDgMwq.C', NULL, 1, '', '2024-05-29 14:25:01', '2024-05-29 14:24:44');

-- --------------------------------------------------------

--
-- Estrutura para tabela `user_chat_messages`
--

CREATE TABLE `user_chat_messages` (
  `id` int(11) NOT NULL,
  `admin_answer_id` int(11) NOT NULL,
  `message` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `admin_chat_messages`
--
ALTER TABLE `admin_chat_messages`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `product_answers`
--
ALTER TABLE `product_answers`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `product_messages`
--
ALTER TABLE `product_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `user_chat_messages`
--
ALTER TABLE `user_chat_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_answer_id` (`admin_answer_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `admin_chat_messages`
--
ALTER TABLE `admin_chat_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `product_answers`
--
ALTER TABLE `product_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `product_messages`
--
ALTER TABLE `product_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `user_chat_messages`
--
ALTER TABLE `user_chat_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `product_messages`
--
ALTER TABLE `product_messages`
  ADD CONSTRAINT `product_messages_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_messages_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Restrições para tabelas `user_chat_messages`
--
ALTER TABLE `user_chat_messages`
  ADD CONSTRAINT `user_chat_messages_ibfk_1` FOREIGN KEY (`admin_answer_id`) REFERENCES `admin_chat_messages` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
