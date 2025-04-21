-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 21-Abr-2025 às 18:04
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
-- Estrutura da tabela `rapidask_admins`
--

CREATE TABLE `rapidask_admins` (
  `id_admin` int(11) NOT NULL,
  `utilizador` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `rapidask_admins`
--

INSERT INTO `rapidask_admins` (`id_admin`, `utilizador`, `password`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'lemm.pt@gmail.com', '$2y$10$0jX6kiQ8Y6CPXH8WMO0yz.fo8ro/ttLt8i9jpQ4POZ0HvlAXOdTHq', '2023-03-04 15:46:05', '2025-04-21 15:41:10', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `rapidask_admins`
--
ALTER TABLE `rapidask_admins`
  ADD PRIMARY KEY (`id_admin`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `rapidask_admins`
--
ALTER TABLE `rapidask_admins`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
