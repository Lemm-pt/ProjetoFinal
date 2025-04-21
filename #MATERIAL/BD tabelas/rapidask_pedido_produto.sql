-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 21-Abr-2025 às 17:53
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
-- Estrutura da tabela `rapidask_pedido_produto`
--

CREATE TABLE `rapidask_pedido_produto` (
  `id_pedido_produto` int(10) UNSIGNED NOT NULL,
  `id_pedido` int(10) UNSIGNED DEFAULT NULL,
  `id_produto` int(10) DEFAULT NULL,
  `designacao_produto` varchar(200) DEFAULT NULL,
  `imagem` varchar(200) DEFAULT NULL,
  `preco_unidade` decimal(6,2) UNSIGNED DEFAULT NULL,
  `quantidade` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `rapidask_pedido_produto`
--

INSERT INTO `rapidask_pedido_produto` (`id_pedido_produto`, `id_pedido`, `id_produto`, `designacao_produto`, `imagem`, `preco_unidade`, `quantidade`, `created_at`) VALUES
(1, 2, NULL, 'Panado', NULL, '4.00', 2, '2022-10-11 14:38:16'),
(2, 2, NULL, 'Caneca de cerveja', NULL, '1.50', 2, '2022-10-11 14:38:16'),
(3, 3, 13, 'cafe', NULL, '0.80', 1, '2022-10-18 14:44:32'),
(4, 3, NULL, 'Galão', NULL, '1.20', 1, '2022-10-18 14:44:32'),
(5, 3, NULL, 'Caiirinha', NULL, '6.00', 1, '2022-10-18 14:44:32'),
(6, 4, 13, 'cafe', NULL, '0.80', 5, '2022-11-09 18:18:22'),
(7, 5, 13, 'cafe', NULL, '0.80', 1, '2022-11-14 16:02:26'),
(8, 5, 16, 'Wisky', NULL, '4.00', 1, '2022-11-14 16:02:26'),
(9, 5, NULL, 'Panado', NULL, '4.00', 1, '2022-11-14 16:02:26'),
(10, 5, NULL, 'Caneca de cerveja', NULL, '1.50', 1, '2022-11-14 16:02:26'),
(11, 6, NULL, 'Cocacola', NULL, '1.30', 1, '2022-11-14 16:03:25'),
(12, 6, NULL, 'Coktail', NULL, '6.00', 1, '2022-11-14 16:03:25'),
(13, 7, NULL, 'Sandes de leitão', NULL, '7.00', 1, '2023-01-18 22:06:21'),
(14, 7, NULL, 'Cocacola', NULL, '1.30', 1, '2023-01-18 22:06:21'),
(15, 8, NULL, 'Panado', NULL, '4.00', 1, '2023-02-27 09:51:55'),
(16, 8, NULL, 'Caneca de cerveja', NULL, '1.50', 1, '2023-02-27 09:51:55'),
(17, 8, NULL, 'Sandes de leitão', NULL, '7.00', 1, '2023-02-27 09:51:55'),
(18, 8, NULL, 'Cocacola', NULL, '1.30', 1, '2023-02-27 09:51:55'),
(19, 9, 13, 'cafe', NULL, '0.80', 1, '2023-02-27 09:56:20'),
(20, 9, NULL, 'Caiirinha', NULL, '6.00', 1, '2023-02-27 09:56:20'),
(21, 9, NULL, 'Sandes de leitão', NULL, '7.00', 1, '2023-02-27 09:56:20'),
(22, 10, NULL, 'cafe', NULL, '0.80', 1, '2023-02-27 19:08:56'),
(23, 10, 16, 'Wisky', NULL, '4.00', 1, '2023-02-27 19:08:56'),
(24, 11, 13, 'cafe', NULL, '0.80', 1, '2023-02-27 19:47:16'),
(25, 11, 16, 'Wisky', NULL, '4.00', 1, '2023-02-27 19:47:16'),
(26, 11, NULL, 'Panado', NULL, '4.00', 1, '2023-02-27 19:47:16'),
(27, 11, NULL, 'Galão', NULL, '1.20', 1, '2023-02-27 19:47:16'),
(28, 12, 13, 'cafe', NULL, '0.80', 1, '2023-03-02 20:10:23'),
(29, 12, 16, 'Wisky', NULL, '4.00', 1, '2023-03-02 20:10:23'),
(30, 13, 13, 'cafe', NULL, '0.80', 1, '2023-03-02 22:11:40'),
(31, 13, 16, 'Wisky', NULL, '4.00', 1, '2023-03-02 22:11:40'),
(32, 13, NULL, 'Panado', NULL, '4.00', 1, '2023-03-02 22:11:40'),
(33, 13, NULL, 'Sandes de leitão', NULL, '7.00', 1, '2023-03-02 22:11:40'),
(34, 13, NULL, 'Cocacola', NULL, '1.30', 1, '2023-03-02 22:11:40'),
(35, 13, NULL, 'Sumo de laranja natural', NULL, '2.00', 1, '2023-03-02 22:11:40'),
(36, 14, NULL, 'Caiirinha', NULL, '6.00', 1, '2023-03-03 16:30:39'),
(37, 14, NULL, 'Sandes de leitão', NULL, '7.00', 1, '2023-03-03 16:30:39'),
(38, 14, NULL, 'Coktail', NULL, '6.00', 1, '2023-03-03 16:30:39'),
(39, 15, 13, 'cafe', NULL, '0.80', 1, '2023-03-03 16:37:15'),
(40, 15, 16, 'Wisky', NULL, '4.00', 1, '2023-03-03 16:37:15'),
(41, 16, NULL, 'Panado', NULL, '4.00', 2, '2023-03-03 20:16:34'),
(42, 16, NULL, 'Caneca de cerveja', NULL, '1.50', 2, '2023-03-03 20:16:34'),
(43, 16, NULL, 'Sandes de leitão', NULL, '7.00', 1, '2023-03-03 20:16:34'),
(44, 17, NULL, 'Sandes de leitão', NULL, '7.00', 1, '2023-03-03 20:55:54'),
(45, 17, NULL, 'Cocacola', NULL, '1.30', 1, '2023-03-03 20:55:54'),
(46, 18, NULL, 'Panado', NULL, '4.00', 2, '2023-03-03 20:59:29'),
(47, 19, 13, 'cafe', NULL, '0.80', 1, '2023-03-03 21:22:40'),
(48, 20, NULL, 'Panado', NULL, '4.00', 1, '2023-03-03 21:24:37'),
(49, 21, 16, 'Wisky', NULL, '4.00', 2, '2023-03-03 21:26:03'),
(50, 22, 13, 'cafe', NULL, '0.80', 2, '2023-03-03 21:27:37'),
(51, 23, 13, 'cafe', NULL, '0.80', 4, '2023-03-03 21:29:11'),
(52, 24, NULL, 'Sandes de leitão', NULL, '7.00', 3, '2023-03-03 21:30:34'),
(53, 24, NULL, 'Cocacola', NULL, '1.30', 1, '2023-03-03 21:30:34'),
(54, 25, NULL, 'Sandes de leitão', NULL, '7.00', 1, '2023-03-03 21:48:57'),
(55, 25, 22, 'Cocacola', NULL, '1.30', 1, '2023-03-03 21:48:57'),
(56, 26, NULL, 'Panado', NULL, '4.00', 1, '2023-03-03 21:55:00'),
(57, 26, 20, 'Caiirinha', NULL, '6.00', 2, '2023-03-03 21:55:00'),
(58, 26, NULL, 'Sandes de leitão', NULL, '7.00', 1, '2023-03-03 21:55:00'),
(59, 26, NULL, 'Coktail', NULL, '6.00', 1, '2023-03-03 21:55:00'),
(60, 27, 13, 'cafe', NULL, '0.80', 2, '2023-03-04 15:12:18'),
(61, 27, 16, 'Wisky', NULL, '4.00', 1, '2023-03-04 15:12:18'),
(62, 28, 13, 'cafe', NULL, '0.80', 1, '2023-03-04 21:45:55'),
(63, 31, 22, 'Cocacola', 'cocacola.jpg', '1.30', 1, '2023-03-04 22:01:59'),
(64, 31, 23, 'Coktail', 'coktail.jpg', '6.00', 1, '2023-03-04 22:01:59'),
(65, 31, 24, 'Sumo de laranja natural', 'sumo_laranja_natural.jpg', '2.00', 1, '2023-03-04 22:01:59'),
(66, 32, 13, 'cafe', 'cafe.jpg', '0.80', 1, '2023-03-04 22:22:11'),
(67, 32, 16, 'Wisky', 'wiskie.jpg', '4.00', 1, '2023-03-04 22:22:11'),
(68, 32, 20, 'Caiirinha', 'caipirinha.jpg', '6.00', 1, '2023-03-04 22:22:11'),
(69, 32, 21, 'Sandes de leitão', 'leitao.jpg', '7.00', 1, '2023-03-04 22:22:11'),
(70, 33, 13, 'cafe', 'cafe.jpg', '0.80', 1, '2023-03-05 11:35:46'),
(71, 33, 17, 'Panado', 'panado.jpg', '4.00', 1, '2023-03-05 11:35:46'),
(72, 34, 47, 'Carioca', 'carioca.jpg', '0.70', 1, '2023-03-06 17:31:17'),
(73, 34, 48, 'moelas', 'moelas.jpg', '2.70', 1, '2023-03-06 17:31:17'),
(74, 35, 13, 'cafe', 'cafe.jpg', '0.80', 1, '2023-03-06 18:09:15'),
(75, 36, 13, 'cafe', 'cafe.jpg', '0.80', 1, '2023-03-06 21:42:04'),
(76, 36, 16, 'Wisky', 'wiskie.jpg', '4.00', 1, '2023-03-06 21:42:04'),
(77, 37, 20, 'Caiirinha', 'caipirinha.jpg', '6.00', 1, '2023-03-08 09:06:03'),
(78, 37, 25, 'Hamburguer', '', '3.00', 1, '2023-03-08 09:06:03'),
(79, 37, 47, 'Carioca', 'carioca.jpg', '0.70', 1, '2023-03-08 09:06:03'),
(80, 37, 48, 'moelas', 'moelas.jpg', '2.70', 1, '2023-03-08 09:06:03'),
(81, 38, 27, 'Bolo', '', '1.40', 1, '2023-03-08 09:07:35'),
(82, 39, 13, 'cafe', 'cafe.jpg', '0.80', 1, '2023-03-22 16:45:57'),
(83, 39, 16, 'Wisky', 'wiskie.jpg', '4.00', 2, '2023-03-22 16:45:57'),
(84, 40, 13, 'cafe', 'cafe.jpg', '0.80', 1, '2023-03-22 18:42:00'),
(85, 40, 16, 'Wisky', 'wiskie.jpg', '4.00', 1, '2023-03-22 18:42:00'),
(86, 41, 20, 'Caiirinha', 'caipirinha.jpg', '6.00', 1, '2023-03-22 23:20:03'),
(87, 41, 21, 'Sandes de leitão', 'leitao.jpg', '7.00', 1, '2023-03-22 23:20:03'),
(88, 41, 22, 'Cocacola', 'cocacola.jpg', '1.30', 1, '2023-03-22 23:20:03'),
(89, 41, 23, 'Coktail', 'coktail.jpg', '6.00', 1, '2023-03-22 23:20:03'),
(90, 42, 13, 'cafe', 'cafe.jpg', '0.80', 1, '2023-03-23 09:57:46'),
(91, 42, 18, 'Galão', 'galao.jpg', '1.20', 1, '2023-03-23 09:57:46'),
(92, 42, 27, 'Bolo', '', '1.40', 1, '2023-03-23 09:57:46'),
(93, 43, 17, 'Panado', 'panado.jpg', '4.00', 1, '2023-03-23 09:58:17'),
(94, 43, 19, 'Caneca de cerveja', 'caneca_cerveja.jpg', '1.50', 1, '2023-03-23 09:58:17'),
(95, 44, 24, 'Sumo de laranja natural', 'sumo_laranja_natural.jpg', '2.00', 4, '2023-03-23 09:58:42'),
(96, 44, 48, 'moelas', 'moelas.jpg', '2.70', 2, '2023-03-23 09:58:42'),
(97, 45, 13, 'cafe', 'cafe.jpg', '0.80', 1, '2023-03-23 10:21:53'),
(98, 45, 17, 'Panado', 'panado.jpg', '4.00', 1, '2023-03-23 10:21:53'),
(99, 45, 19, 'Caneca de cerveja', 'caneca_cerveja.jpg', '1.50', 1, '2023-03-23 10:21:53'),
(100, 45, 22, 'Cocacola', 'cocacola.jpg', '1.30', 1, '2023-03-23 10:21:53'),
(101, 46, 13, 'cafe', 'cafe.jpg', '0.80', 1, '2023-03-23 12:48:46'),
(102, 47, 17, 'Panado', 'panado.jpg', '4.00', 1, '2023-03-23 18:13:45'),
(103, 47, 19, 'Caneca de cerveja', 'caneca_cerveja.jpg', '1.50', 1, '2023-03-23 18:13:45'),
(104, 47, 47, 'Carioca', 'carioca.jpg', '0.70', 1, '2023-03-23 18:13:45'),
(105, 48, 19, 'Caneca de cerveja', 'caneca_cerveja.jpg', '1.50', 2, '2023-04-08 17:15:23'),
(106, 48, 21, 'Sandes de leitão', 'leitao.jpg', '7.00', 1, '2023-04-08 17:15:23'),
(107, 48, 22, 'Cocacola', 'cocacola.jpg', '1.30', 1, '2023-04-08 17:15:23'),
(108, 48, 48, 'moelas', 'moelas.jpg', '2.70', 1, '2023-04-08 17:15:23'),
(109, 49, 16, 'Wisky', 'wiskie.jpg', '4.00', 1, '2023-04-23 16:20:05'),
(110, 49, 18, 'Galão', 'galao.jpg', '1.20', 1, '2023-04-23 16:20:05'),
(111, 49, 22, 'Cocacola', 'cocacola.jpg', '1.30', 1, '2023-04-23 16:20:05'),
(112, 50, 140, 'Smooth Açai Frutas', 'smooth_acai_frutas.jpg', '6.90', 1, '2025-04-18 17:52:16'),
(113, 50, 141, 'Panqueca Banana Nutela', 'cachorro.jpg', '4.50', 1, '2025-04-18 17:52:16'),
(114, 50, 142, 'Panqueca Mickey Mouse', 'panqueca_mickey_mouse.jpg', '2.00', 1, '2025-04-18 17:52:16'),
(115, 50, 144, 'Brunch 1', 'cafe.jpg', '8.50', 1, '2025-04-18 17:52:16'),
(116, 50, 148, 'Francesinha de bacalhau', 'moelas.jpg', '8.50', 1, '2025-04-18 17:52:16'),
(117, 51, 140, 'Smooth Açai Frutas', 'smooth_acai_frutas.jpg', '6.90', 3, '2025-04-18 17:56:03'),
(118, 51, 141, 'Panqueca Banana Nutela', 'cachorro.jpg', '4.50', 1, '2025-04-18 17:56:03'),
(119, 51, 148, 'Francesinha de bacalhau', 'moelas.jpg', '8.50', 1, '2025-04-18 17:56:03'),
(120, 51, 155, 'panado', 'ovo_avocado_benedict.jpg', '6.50', 1, '2025-04-18 17:56:03'),
(121, 52, 148, 'Francesinha de bacalhau', 'moelas.jpg', '8.50', 5, '2025-04-18 18:27:41'),
(122, 52, 156, 'sumo kiwi', 'transferir.jfif', '3.00', 5, '2025-04-18 18:27:41');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `rapidask_pedido_produto`
--
ALTER TABLE `rapidask_pedido_produto`
  ADD PRIMARY KEY (`id_pedido_produto`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `rapidask_pedido_produto`
--
ALTER TABLE `rapidask_pedido_produto`
  MODIFY `id_pedido_produto` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
