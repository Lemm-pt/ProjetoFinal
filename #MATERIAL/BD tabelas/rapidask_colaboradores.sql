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
-- Estrutura da tabela `rapidask_colaboradores`
--

CREATE TABLE `rapidask_colaboradores` (
  `id_user` int(10) UNSIGNED NOT NULL,
  `user` varchar(77) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `senha` varchar(250) DEFAULT NULL,
  `nome_completo` varchar(250) DEFAULT NULL,
  `morada` varchar(250) DEFAULT NULL,
  `telemovel` varchar(50) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `purl` varchar(50) DEFAULT NULL,
  `activo` tinyint(4) DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `rapidask_colaboradores`
--

INSERT INTO `rapidask_colaboradores` (`id_user`, `user`, `email`, `senha`, `nome_completo`, `morada`, `telemovel`, `data_nascimento`, `purl`, `activo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(77, '', 'lubiomarona@gmail.com', '$2y$10$81wR0cK.qJNGvXkz6NyXTe8eyCZZCVBP9MZwkc6PYQFN8NsGJgWc2', 'Luciano Marafona', 'espo', '', NULL, NULL, 1, '2022-03-16 20:40:29', '2022-03-16 20:40:41', NULL),
(78, '', 'lemm.pt@gmail.com', '$2y$10$Fl1QbV7G1VRIhs3TgiYUHea9hJHsiT1a6yN1LMRA.6d7zOGdJCBl6', 'lucas', 'espo', '', NULL, NULL, 1, '2022-03-18 12:26:02', '2022-03-18 12:26:36', NULL),
(80, '', 'lemm777@gmail.com', '$2y$10$fCtMXLxah9SQE.HeUjqNKOIkGBrwvsEFd3RDWXsgwq2KP7TtfjGA6', 'Luciano', 'Ffff', '566555', NULL, 'doIsT2x30MdK', 0, '2022-08-10 07:45:59', '2022-08-10 07:45:59', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `rapidask_colaboradores`
--
ALTER TABLE `rapidask_colaboradores`
  ADD PRIMARY KEY (`id_user`) USING BTREE;

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `rapidask_colaboradores`
--
ALTER TABLE `rapidask_colaboradores`
  MODIFY `id_user` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
