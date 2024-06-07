-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07-Jun-2024 às 22:43
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
-- Estrutura da tabela `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `message` text NOT NULL,
  `is_responded` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `chat`
--

INSERT INTO `chat` (`id`, `sender_id`, `receiver_id`, `product_id`, `message`, `is_responded`, `created_at`) VALUES
(12, 4, 1, 42, 'fff', 1, '2024-06-06 17:03:48'),
(38, 1, 4, 42, 'sim', 0, '2024-06-07 17:01:16'),
(39, 4, 1, 42, 'quero', 1, '2024-06-07 17:07:20'),
(41, 1, 4, 42, 'ta', 0, '2024-06-07 17:16:53'),
(42, 4, 1, 42, 'ola?', 1, '2024-06-07 18:27:21'),
(43, 1, 4, 42, 'Opa', 0, '2024-06-07 18:27:49'),
(44, 4, 1, 42, 'disponível?', 1, '2024-06-07 18:35:27'),
(45, 4, 1, 41, 'tenho interesse', 1, '2024-06-07 18:39:36'),
(46, 1, 4, 42, 'sim', 0, '2024-06-07 18:40:31'),
(47, 4, 1, 43, 'nova?', 1, '2024-06-07 18:41:04'),
(48, 1, 4, 43, 'sim', 0, '2024-06-07 18:41:39'),
(49, 4, 1, 43, 'vou querer', 0, '2024-06-07 18:42:07'),
(50, 1, 4, 41, 'ok', 0, '2024-06-07 18:42:30');

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
  `img_file_name` varchar(200) DEFAULT NULL,
  `link` text NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `img_src`, `img_file_name`, `link`, `updated_at`, `created_at`) VALUES
(41, 'jaqueta', 2000, 'ee', 'assets/images/products/jaqueta_1717676327624.png', 'jaqueta_1717676327624.png', 'e', '2024-06-06 12:18:47', '2024-06-06 12:18:47'),
(42, 'boné', 200, 'f', 'assets/images/products/boné_1717676380961.png', 'boné_1717676380961.png', 'f', '2024-06-06 12:19:40', '2024-06-06 12:19:40'),
(43, 'blusa', 200, '2fsdf', 'assets/images/products/blusa_1717690605759.png', 'blusa_1717690605759.png', '222', '2024-06-06 16:16:45', '2024-06-06 16:16:45');

-- --------------------------------------------------------

--
-- Estrutura da tabela `product_answers`
--

CREATE TABLE `product_answers` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `answer` varchar(300) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `product_answers`
--

INSERT INTO `product_answers` (`id`, `product_id`, `answer`, `created_at`) VALUES
(26, 41, 'sim amigo\r\n', '2024-06-06 14:02:08'),
(27, 41, 'sim, é original', '2024-06-06 14:02:17');

-- --------------------------------------------------------

--
-- Estrutura da tabela `product_messages`
--

CREATE TABLE `product_messages` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `answer_id` int(11) DEFAULT NULL,
  `message` varchar(300) DEFAULT NULL,
  `active` tinyint(4) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `product_messages`
--

INSERT INTO `product_messages` (`id`, `product_id`, `user_id`, `answer_id`, `message`, `active`, `created_at`) VALUES
(28, 41, 1, 26, 'disponível?', 0, '2024-06-06 12:20:16'),
(29, 41, 4, 27, 'original?', 0, '2024-06-06 13:50:56'),
(30, 42, 1, NULL, 'ola?', 1, '2024-06-06 19:01:06'),
(31, 41, 4, NULL, 'gostei', 1, '2024-06-07 14:06:27'),
(32, 43, 4, NULL, 'oi', 1, '2024-06-07 18:58:31');

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

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

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
  ADD KEY `product_id` (`product_id`);

--
-- Índices para tabela `product_messages`
--
ALTER TABLE `product_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_msg_product_id` (`product_id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de tabela `product_answers`
--
ALTER TABLE `product_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `product_messages`
--
ALTER TABLE `product_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `product_answers`
--
ALTER TABLE `product_answers`
  ADD CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `product_messages`
--
ALTER TABLE `product_messages`
  ADD CONSTRAINT `product_messages_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `product_msg_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
