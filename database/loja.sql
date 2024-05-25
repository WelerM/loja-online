-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26/05/2024 às 01:40
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
-- Estrutura para tabela `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `answer` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `client_questions`
--

CREATE TABLE `client_questions` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `answer_id` int(11) DEFAULT NULL,
  `question` varchar(200) DEFAULT NULL,
  `answer` text DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `client_questions`
--

INSERT INTO `client_questions` (`id`, `product_id`, `client_id`, `answer_id`, `question`, `answer`, `active`, `created_at`) VALUES
(2, 4, 8, NULL, 'dfsdfds', '', 1, '2024-05-22 01:52:02'),
(3, 4, 8, NULL, 'fsdfdsfdf', '', 1, '2024-05-22 02:09:39'),
(4, 4, 8, NULL, 'fdsfd', '', 1, '2024-05-22 02:10:00'),
(5, 4, 8, NULL, 'opa', '', 1, '2024-05-22 03:24:14'),
(8, 4, 8, NULL, 'ola', '', 1, '2024-05-25 16:19:05'),
(9, 4, 8, NULL, 'ddddddd', '', 0, '2024-05-25 19:46:59'),
(10, 3, 8, NULL, 'eu', '', 1, '2024-05-25 18:56:23'),
(11, 3, 8, NULL, 'entao', '', 1, '2024-05-25 18:58:11');

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
  `link` text NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `img_src`, `link`, `updated_at`, `created_at`) VALUES
(3, 'camisa vermelha', 0, 'boa', 'assets/images/camisa vermelha_1716240877330.jpg', 'wwww', '2024-05-20 21:34:37', '2024-05-20 21:34:37'),
(4, 'camisa', 0, 'show', 'assets/images/camisa_1716240894802.jpg', 'w', '2024-05-20 21:34:54', '2024-05-20 21:34:54'),
(5, 'iphone', 20, '54f', 'assets/images/iphone_1716341103409.png', 'dfsdf', '2024-05-22 01:25:03', '2024-05-22 01:25:03');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` text NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `purl` varchar(300) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'client',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `active`, `purl`, `user_type`, `updated_at`, `created_at`) VALUES
(8, 'weler', 'welerson194@gmail.com', '$2y$10$aGKV9EMDmRWNP/et3oK1D.6/PJLtbAP523jw6LwDftsst1H19gopK', 1, '', 'admin', '2024-05-20 17:31:08', '2024-05-20 17:31:00'),
(9, 'ana', 'ana2fgmail.com', '2432244', 0, '', 'client', '2024-05-25 18:02:36', '2024-05-25 18:02:36');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`client_id`);

--
-- Índices de tabela `client_questions`
--
ALTER TABLE `client_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `fk_answer_id` (`answer_id`);

--
-- Índices de tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `client_questions`
--
ALTER TABLE `client_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client_questions` (`product_id`);

--
-- Restrições para tabelas `client_questions`
--
ALTER TABLE `client_questions`
  ADD CONSTRAINT `client_questions_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `client_questions_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_answer_id` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
