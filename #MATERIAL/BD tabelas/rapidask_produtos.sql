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
-- Estrutura da tabela `rapidask_produtos`
--

CREATE TABLE `rapidask_produtos` (
  `id_produto` int(10) UNSIGNED NOT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `nome_produto` varchar(50) DEFAULT NULL,
  `descricao` varchar(200) DEFAULT NULL,
  `imagem` varchar(200) DEFAULT NULL,
  `preco` decimal(6,2) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `visivel` tinyint(4) DEFAULT NULL,
  `validade` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `rapidask_produtos`
--

INSERT INTO `rapidask_produtos` (`id_produto`, `categoria`, `nome_produto`, `descricao`, `imagem`, `preco`, `stock`, `visivel`, `validade`, `created_at`, `updated_at`, `deleted_at`) VALUES
(140, 'Smoothie and Bowls', 'Smooth Açai Frutas', 'Gelado de açai, banana, kiwi, granola, morango ou frutos vermelhos', 'smooth_acai_frutas.jpg', '6.90', 12, 1, NULL, '2023-07-06 19:17:26', '2023-07-06 19:17:26', NULL),
(141, 'Menu do dia', 'Panqueca Banana Nutela', '', 'cachorro.jpg', '4.50', 2, 1, NULL, '2023-07-06 19:29:29', '2023-07-06 19:29:29', NULL),
(142, 'Panquecas', 'Panqueca Mickey Mouse', 'Panqueca com pepitas de chocolate nutela', 'panqueca_mickey_mouse.jpg', '2.00', 5, 1, NULL, '2023-07-06 19:38:23', '2023-07-06 19:38:23', NULL),
(143, 'Menu do dia', 'Panqueca Frutos Vermelhos', 'Panqueca Frutos Vermelhos', 'panqueca_frutos_vermelhos.jpg', '5.50', 0, 1, NULL, '2023-07-06 19:43:02', '2023-07-06 19:43:02', NULL),
(144, 'Outros menus', 'Brunch 1', 'Sumo laranja, 1 compota, 1 manteiga, 1 panqueca, 1 ovo frito ou mexido, iogurte com granola e fruta.', 'cafe.jpg', '8.50', 1, 1, NULL, '2023-07-06 19:49:22', '2023-07-06 19:49:22', NULL),
(145, 'American Breakfast', 'Brunch 2', 'Sumo de laranja, 2 fatias de torrada, 1 compota, 1 manteiga, bacon, 2 ovos mexidos ou fritos, 2 panquecas c/ 3 frutas, iogurte com granola e fruta, 1 bebida quente.', 'Brunch_2.jpg', '14.50', 3, 1, NULL, '2023-07-06 19:51:53', '2023-07-06 19:51:53', NULL),
(146, 'Club Sandwiches', 'Chicken Club Sandwiches', 'Frango, bacon, queijo, fiambre, tomate, alface e maionese.', 'chicken_club_sandwiches.JPG', '8.50', 0, 1, NULL, '2023-07-06 20:02:32', '2023-07-06 20:02:32', NULL),
(148, 'Francesinhas', 'Francesinha de bacalhau', 'Francesinha de bacalhau', 'moelas.jpg', '8.50', 23, 1, NULL, '2023-07-06 20:11:44', '2023-07-06 20:11:44', NULL),
(149, 'Menu do dia', 'Ovo Bacon Benedict', 'Tomate, bacon, ovos escalfados e molho Holandês', 'ovo_bacon_benedict.JPG', '6.50', 234, 1, NULL, '2023-07-06 20:26:36', '2023-07-06 20:26:36', NULL),
(150, 'Menu do dia', 'Bacon Cheeseburguer', 'Hamburguer, queijo, fiambre, bacon, cebola caramelizada, alface, tomate e ovo frito.', 'bacon_cheesseburguer.jpg', '9.00', 0, 1, NULL, '2023-07-06 20:32:30', '2023-07-06 20:32:30', NULL),
(151, 'Salad Bowls', 'Bowl Salmão', 'Mix de alface, tomate cherry, abacate, nozes, queijo feta, ovo escalfado, salmão fumado e creme balsámico.', 'bowl_salmao.jpg', '8.50', 0, 1, NULL, '2023-07-06 20:37:34', '2023-07-06 20:37:34', NULL),
(152, 'Tostas Panini', 'Tosta M&R Avocado', 'Abacate laminado, rucúla,  queijo feta e ovo frito', 'tosta_m_r.jpg', '5.50', 0, 1, NULL, '2023-07-08 13:46:33', '2023-07-08 13:46:33', NULL),
(155, 'Ovos', 'panado', 'Abacate, tomate, rucúla, ovos escalfados e molho Holandês', 'ovo_avocado_benedict.jpg', '6.50', 123, 1, NULL, '2023-07-08 15:01:58', '2023-07-08 15:01:58', NULL),
(156, 'bebida', 'sumo kiwi', 'ssssssssssssssssssss', 'transferir.jfif', '3.00', 12, 1, '2025-02-12', '2025-04-18 20:25:35', '2025-04-18 20:25:35', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `rapidask_produtos`
--
ALTER TABLE `rapidask_produtos`
  ADD PRIMARY KEY (`id_produto`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `rapidask_produtos`
--
ALTER TABLE `rapidask_produtos`
  MODIFY `id_produto` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
