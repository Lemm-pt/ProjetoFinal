-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 21-Abr-2025 às 17:52
-- Versão do servidor: 5.7.44-cll-lve
-- versão do PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `vl2tjdok_spacet`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `rapidask_users`
--

CREATE TABLE `rapidask_users` (
  `id_user` int(10) UNSIGNED NOT NULL,
  `user` varchar(77) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `senha` varchar(250) DEFAULT NULL,
  `telemovel` varchar(50) DEFAULT NULL,
  `localidade` varchar(250) DEFAULT NULL,
  `purl` varchar(50) DEFAULT NULL,
  `activo` tinyint(4) DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `rapidask_users`
--

INSERT INTO `rapidask_users` (`id_user`, `user`, `email`, `senha`, `telemovel`, `localidade`, `purl`, `activo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(121, 'Bigossos', 'lemm.pt@gmail.com', '$2y$10$gckwjYccUhJXL7ONOayMrOVC.JXrF/J1CteDmKQizSjyV6wazQva.', '1234567', 'Esposende', NULL, 1, '2022-09-03 00:19:37', '2023-03-23 00:18:58', NULL),
(122, 'cafe', 'lubiomarona@gmail.com', '$2y$10$KTTLM2JhZ9Yjc1bF3PolVegSYiK6m996O8mUNhks6EpWscXktJcAa', '237777777', 'Barcelos', NULL, 1, '2022-09-10 22:01:47', '2023-01-23 16:53:57', NULL),
(125, 'Cafe Mar', 'lemm777@gmail.com', '$2y$10$XNsefXJ44GKE4hiVSmC/3udFxQdnJKOEDwwxqpjJa9ctLjL/cagX.', '234 555 77', 'Esposende', NULL, 1, '2023-04-23 15:03:09', '2023-04-23 15:03:32', NULL),
(126, 'Luciano teste', '2003730@estudante.uab.pt', '$2y$10$ZEHNox.ppSJQ8t5qRjdUT.whcIuUa1DA3NJD2L0WVZ6fPz5lZUR/q', '12345678', 'Porto', NULL, 1, '2025-04-18 20:08:56', '2025-04-18 20:09:12', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `rapidask_users`
--
ALTER TABLE `rapidask_users`
  ADD PRIMARY KEY (`id_user`) USING BTREE;

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `rapidask_users`
--
ALTER TABLE `rapidask_users`
  MODIFY `id_user` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
