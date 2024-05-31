-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 31-Maio-2024 às 22:57
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

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
-- Estrutura da tabela `admin_chat_messages`
--

CREATE TABLE `admin_chat_messages` (
  `id` int(11) NOT NULL,
  `message` varchar(300) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `description` varchar(250) NOT NULL,
  `img_src` varchar(150) NOT NULL,
  `link` text NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `img_src`, `link`, `updated_at`, `created_at`) VALUES
(13, 'jaqueta', 200, 'cor laranja', 'assets/images/products/jaqueta_1716919630880.png', 'www.google.com', '2024-05-28 18:07:10', '2024-05-28 18:07:10'),
(14, 'óculos', 200, 'cor preto', 'assets/images/products/óculos_1716919737530.png', 'www.google.com', '2024-05-28 18:08:57', '2024-05-28 18:08:57'),
(15, 'cargo pants', 90, 'second hand', 'assets/images/products/cargo pants_1717003367482.png', 'www.google.com', '2024-05-29 17:22:47', '2024-05-29 17:22:47');

-- --------------------------------------------------------

--
-- Estrutura da tabela `product_answers`
--

CREATE TABLE `product_answers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `answer` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `product_messages`
--

CREATE TABLE `product_messages` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `answer_id` int(11) DEFAULT NULL,
  `question` varchar(200) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `product_messages`
--

INSERT INTO `product_messages` (`id`, `product_id`, `user_id`, `answer_id`, `question`, `active`, `created_at`) VALUES
(1, 13, 1, NULL, 'gg', 1, '2024-05-28 19:09:53'),
(2, 13, 4, NULL, 'disponivel?', 1, '2024-05-29 14:25:35'),
(3, 13, 4, NULL, 'ola?', 1, '2024-05-29 14:27:32'),
(4, 13, 4, NULL, 'kk', 1, '2024-05-29 14:29:57'),
(5, 13, 4, NULL, 'entao', 1, '2024-05-29 14:30:17');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
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
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `user_type`, `password`, `password_reset_token`, `active`, `purl`, `updated_at`, `created_at`) VALUES
(1, 'weler', 'welerson194@gmail.com', 'admin', '$2y$10$yK3ynBNhbLt8GEYWl1VlreXWzePgZ2PjdB7Ujy9KwQBWdPMOVwKGi', 'dfe8e8b2f438329867b50f2fbc6380fef511cce67e93a28afae36c1697190d70', 1, '', '2024-05-28 14:15:46', '2024-05-28 14:11:17'),
(4, 'ana', 'welerson25@yahoo.com', 'client', '$2y$10$ghrNbrjpN/THAKVFZOpJwe.gfre4/fBj43QhYItrnO2RawDgMwq.C', NULL, 1, '', '2024-05-29 14:25:01', '2024-05-29 14:24:44');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_chat_messages`
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
-- Índices para tabela `admin_chat_messages`
--
ALTER TABLE `admin_chat_messages`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `product_answers`
--
ALTER TABLE `product_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`user_id`);

--
-- Índices para tabela `product_messages`
--
ALTER TABLE `product_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `client_id` (`user_id`),
  ADD KEY `fk_answer_id` (`answer_id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `user_chat_messages`
--
ALTER TABLE `user_chat_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_answer_id` (`admin_answer_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `product_answers`
--
ALTER TABLE `product_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `product_messages`
--
ALTER TABLE `product_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `product_answers`
--
ALTER TABLE `product_answers`
  ADD CONSTRAINT `product_answers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `product_messages` (`product_id`);

--
-- Limitadores para a tabela `product_messages`
--
ALTER TABLE `product_messages`
  ADD CONSTRAINT `product_messages_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Limitadores para a tabela `user_chat_messages`
--
ALTER TABLE `user_chat_messages`
  ADD CONSTRAINT `user_chat_messages_ibfk_1` FOREIGN KEY (`admin_answer_id`) REFERENCES `admin_chat_messages` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
