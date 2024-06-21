-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21/06/2024 às 21:57
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
  `answer_created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `chat`
--

INSERT INTO `chat` (`id`, `user_id`, `product_id`, `message`, `answer`, `active`, `message_created_at`, `answer_created_at`) VALUES
(54, 17, 48, 'oi', 'dd', 0, '2024-06-19 13:46:11', '2024-06-19 15:11:57'),
(56, 17, 47, 'fff', 'sim', 0, '2024-06-19 14:08:31', '2024-06-19 15:15:07'),
(58, 17, 48, 'tenho interesse', NULL, 1, '2024-06-21 16:29:41', NULL);

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
(47, 'jaqueta', 200, 'boa', 'assets/images/products/jaqueta_1718721663135.png', 'jaqueta_1718721663135.png', '111', '2024-06-18 14:41:03', '2024-06-18 14:41:03'),
(48, 'boné', 50, 'bom', 'assets/images/products/boné_1718721713927.png', 'boné_1718721713927.png', '2w', '2024-06-18 14:41:53', '2024-06-18 14:41:53'),
(49, 'sneakers', 222, 'bons', 'assets/images/products/sneakers_1718824209488.png', 'sneakers_1718824209488.png', 'w', '2024-06-19 19:10:09', '2024-06-19 19:10:09');

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
(54, 17, 48, 'Novo?', 'sim', 0, '2024-06-18 18:13:01', '2024-06-19 13:00:26', '2024-06-21 12:46:10'),
(55, 17, 48, 'olá?', 'oi', 0, '2024-06-18 18:13:07', '2024-06-19 13:01:08', '2024-06-21 13:12:34'),
(59, 17, 47, 'quero', 'ok', 0, '2024-06-19 13:07:58', '2024-06-19 13:22:40', '2024-06-21 13:13:03'),
(60, 1, 47, 'olá', 'oi', 0, '2024-06-19 17:51:44', '2024-06-19 17:52:37', NULL),
(61, 17, 48, 'oi', NULL, 0, '2024-06-19 17:56:02', NULL, '2024-06-20 19:12:32'),
(62, 17, 48, 'oi', NULL, 0, '2024-06-19 17:56:10', NULL, '2024-06-20 19:14:55'),
(63, 1, 48, 'oi', NULL, 0, '2024-06-19 17:56:22', NULL, '2024-06-20 19:12:04'),
(64, 17, 47, 'tenho interesse', 'ok', 0, '2024-06-20 19:39:12', '2024-06-20 19:40:12', NULL),
(65, 17, 47, 'quero', NULL, 0, '2024-06-20 19:52:16', NULL, '2024-06-21 13:13:25'),
(66, 17, 48, 'eu quero', NULL, 1, '2024-06-21 16:23:28', NULL, NULL);

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
(1, 'welerr', 'welerson194@gmail.com', 'admin', '$2y$10$12v4jesZPI3z9EZ2.5/YSezmCjiUYJuXKRGehh6IiUyGM2XdmppOK', 'dfe8e8b2f438329867b50f2fbc6380fef511cce67e93a28afae36c1697190d70', 1, '', '2024-06-21 16:17:44', '2024-05-28 14:11:17'),
(17, 'ana', 'welerson25@yahoo.com', 'client', '$2y$10$RG3sPMMdozghCo2jtfY1tOZqKMA4u7mPaHNKraPwSx6tcaYScKCtW', NULL, 1, '', '2024-06-14 18:34:12', '2024-06-14 18:33:47');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de tabela `product_messages`
--
ALTER TABLE `product_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
