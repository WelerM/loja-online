-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03-Jun-2024 às 21:40
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
  `img_file_name` varchar(200) DEFAULT NULL,
  `link` text NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `img_src`, `img_file_name`, `link`, `updated_at`, `created_at`) VALUES
(23, 'jaqueta', 200, 'boa', 'assets/images/products/jaqueta_1717443410563.png', 'jaqueta_1717443410563.png', 'http://localhost/loja/public/', '2024-06-03 19:36:50', '2024-06-03 19:36:50'),
(24, 'Boné', 100, 'novo', 'assets/images/products/Boné_1717443438482.png', 'Boné_1717443438482.png', 'http://localhost/loja/public/?a=home', '2024-06-03 19:37:18', '2024-06-03 19:37:18'),
(25, 'calça sarja', 150, 'usada', 'assets/images/products/calça sarja_1717443542018.png', 'calça sarja_1717443542018.png', 'http://localhost/loja/public/', '2024-06-03 19:39:02', '2024-06-03 19:39:02'),
(26, 'Botas', 210, 'lindas', 'assets/images/products/Botas_1717443587161.png', 'Botas_1717443587161.png', 'http://localhost/loja/public/', '2024-06-03 19:39:47', '2024-06-03 19:39:47'),
(27, 'Tênis branco', 290, 'originais', 'assets/images/products/Tênis branco_1717443619200.png', 'Tênis branco_1717443619200.png', 'http://localhost/loja/public/', '2024-06-03 19:40:19', '2024-06-03 19:40:19');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `product_answers`
--
ALTER TABLE `product_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `product_messages`
--
ALTER TABLE `product_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  ADD CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `product_messages`
--
ALTER TABLE `product_messages`
  ADD CONSTRAINT `product_messages_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `product_msg_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `user_chat_messages`
--
ALTER TABLE `user_chat_messages`
  ADD CONSTRAINT `user_chat_messages_ibfk_1` FOREIGN KEY (`admin_answer_id`) REFERENCES `admin_chat_messages` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
