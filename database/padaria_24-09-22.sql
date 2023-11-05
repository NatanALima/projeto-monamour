-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24-Set-2022 às 03:03
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `padaria`
--
CREATE DATABASE IF NOT EXISTS `padaria` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `padaria`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_categoria`
--

CREATE TABLE `tb_categoria` (
  `ID` int(11) NOT NULL,
  `CATEGORIA` varchar(50) NOT NULL,
  `CREATED` datetime NOT NULL,
  `MODIFIED` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_categoria`
--

INSERT INTO `tb_categoria` (`ID`, `CATEGORIA`, `CREATED`, `MODIFIED`) VALUES
(1, 'Pães', '2022-08-07 17:32:51', '2022-09-18 00:52:32'),
(2, 'Bolos e Tortas', '2022-08-07 17:32:52', NULL),
(3, 'Salgados', '2022-08-07 17:32:52', NULL),
(4, 'Bebidas', '2022-08-07 17:32:52', NULL),
(8, 'Doces', '2022-08-15 18:30:48', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_compra`
--

CREATE TABLE `tb_compra` (
  `ID` int(11) NOT NULL,
  `ID_ENDERECO` int(11) NOT NULL,
  `TIPO_PAG` varchar(50) NOT NULL,
  `TOTAL` decimal(10,2) DEFAULT NULL,
  `STATUS_PEDIDO` varchar(50) DEFAULT NULL,
  `DATA_COMPRA` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_compra`
--

INSERT INTO `tb_compra` (`ID`, `ID_ENDERECO`, `TIPO_PAG`, `TOTAL`, `STATUS_PEDIDO`, `DATA_COMPRA`) VALUES
(18, 2, 'CREDITO', '62.50', 'ABERTO', '2022-02-20 18:57:42'),
(19, 2, 'CREDITO', '14.50', 'A CAMINHO', '2022-02-20 18:59:01'),
(20, 3, 'CREDITO', '30.50', 'ABERTO', '2022-02-20 20:34:49'),
(21, 2, 'CREDITO', '60.79', 'ABERTO', '2022-02-20 21:12:46'),
(22, 2, 'CREDITO', '9.75', 'A CAMINHO', '2022-03-05 23:25:14'),
(23, 2, 'CREDITO', '12.25', 'ABERTO', '2022-08-08 22:07:27'),
(24, 2, 'CREDITO', '22.75', 'ABERTO', '2022-08-15 22:36:46'),
(25, 2, 'PIX', '19.86', 'ABERTO', '2022-08-15 23:32:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_endereco`
--

CREATE TABLE `tb_endereco` (
  `ID` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `CEP` varchar(20) NOT NULL,
  `CIDADE` varchar(50) NOT NULL,
  `ESTADO` varchar(2) NOT NULL,
  `BAIRRO` varchar(100) NOT NULL,
  `RUA` varchar(100) NOT NULL,
  `NUMERO` int(11) NOT NULL,
  `COMPLEMENTO` varchar(50) NOT NULL,
  `CREATED` datetime NOT NULL,
  `MODIFIED` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_endereco`
--

INSERT INTO `tb_endereco` (`ID`, `ID_USER`, `CEP`, `CIDADE`, `ESTADO`, `BAIRRO`, `RUA`, `NUMERO`, `COMPLEMENTO`, `CREATED`, `MODIFIED`) VALUES
(1, 1, '18730-005', 'ITAÍ', 'SP', 'CENTRO', 'RUA PROFESSOR JOSÉ DE OLIVEIRA', 21, 'ESTABELECIMENTO', '2021-12-24 21:23:29', NULL),
(2, 2, '18730-009', 'Itaí', 'SP', 'Centro', 'Rua Salustiano Soares de Oliveira', 87, 'CASA', '2021-12-24 22:08:15', '2021-12-26 16:43:28'),
(3, 3, '18730-015', 'Itaí', 'SP', 'Centro', 'Rua Nove de Julho', 120, 'CASA', '2021-12-25 16:47:56', NULL),
(4, 4, '18730-019', 'Itaí', 'SP', 'Centro', 'Rua Aristides Pires', 752, 'CASA', '2022-03-01 19:13:41', NULL),
(5, 5, '18730-025', 'ItaÃ­', 'SP', 'Centro', 'Via CapitÃ£o CezÃ¡rio', 41, 'CASA', '2022-08-22 08:19:01', NULL),
(6, 6, '18730-142', 'Itaí', 'SP', 'Jardim Planalto', 'Rua Hamad Musa Ali', 150, 'CASA', '2022-08-28 22:09:43', NULL),
(7, 7, '18730-005', 'ITAÍ', 'SP', 'CENTRO', 'RUA PROFESSOR JOSÉ DE OLIVEIRA', 21, 'ESTABELECIMENTO', '2022-08-28 22:25:23', NULL),
(8, 8, '18730-005', 'ITAÍ', 'SP', 'CENTRO', 'RUA PROFESSOR JOSÉ DE OLIVEIRA', 21, 'ESTABELECIMENTO', '2022-09-18 17:00:06', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_itens_compra`
--

CREATE TABLE `tb_itens_compra` (
  `ID` int(11) NOT NULL,
  `ID_COMPRA` int(11) NOT NULL,
  `ID_PRODUTO` int(11) NOT NULL,
  `QTD` int(11) NOT NULL,
  `SUBTOTAL` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_itens_compra`
--

INSERT INTO `tb_itens_compra` (`ID`, `ID_COMPRA`, `ID_PRODUTO`, `QTD`, `SUBTOTAL`) VALUES
(1, 18, 1, 2, '25.00'),
(2, 18, 7, 1, '12.50'),
(3, 18, 9, 1, '25.00'),
(4, 19, 10, 3, '12.00'),
(5, 19, 8, 1, '2.50'),
(6, 20, 1, 1, '12.50'),
(7, 20, 10, 1, '4.00'),
(8, 20, 13, 4, '14.00'),
(9, 21, 17, 1, '10.50'),
(10, 21, 20, 10, '5.00'),
(11, 21, 24, 1, '41.34'),
(12, 21, 26, 1, '3.95'),
(13, 22, 1, 1, '9.75'),
(14, 23, 7, 1, '12.25'),
(15, 24, 58, 1, '10.50'),
(16, 24, 7, 1, '12.25'),
(17, 25, 58, 1, '10.50'),
(18, 25, 49, 2, '10.40');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_produtos`
--

CREATE TABLE `tb_produtos` (
  `ID` int(11) NOT NULL,
  `IMG` varchar(50) NOT NULL,
  `CATEG` int(11) NOT NULL,
  `NOME_PROD` varchar(50) NOT NULL,
  `DESCRICAO` varchar(220) NOT NULL,
  `PRECO` decimal(10,2) NOT NULL,
  `CREATED` datetime NOT NULL,
  `MODIFIED` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_produtos`
--

INSERT INTO `tb_produtos` (`ID`, `IMG`, `CATEG`, `NOME_PROD`, `DESCRICAO`, `PRECO`, `CREATED`, `MODIFIED`) VALUES
(1, '7eb1e4e1ad68f76f98adca3f1da86f87.png', 1, 'Pão Baguete', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '9.75', '2021-12-24 22:36:29', '2022-02-20 20:48:49'),
(7, '6518922bade80e10cb648f520e4afb37.png', 1, 'Pão Francês (10U)', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '12.25', '2021-12-25 00:14:45', '2022-02-20 21:08:07'),
(8, '849b8e207fb6be8554c9dc3711325f8f.png', 4, 'Sprite (350ml)', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '2.50', '2021-12-25 15:13:31', '2022-02-20 21:09:52'),
(9, '0e77f5e360a85e8c1c843029c6076613.png', 2, 'Bolo de Chocolate', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '25.00', '2021-12-25 15:22:06', NULL),
(10, '411e66a69346f14ceae23c4f0d71479d.png', 3, 'Empada de Frango', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '4.00', '2021-12-25 15:22:28', NULL),
(11, '3917b10d1e92bf666ceb9154a39e8c58.png', 1, 'Pão Doce com Frutas', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '8.50', '2021-12-26 16:55:54', '2022-02-20 21:08:12'),
(12, '15f82088c2bbfe2a79fffaca2622a587.png', 2, 'Bolo KitKat (completo)', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '30.00', '2021-12-26 16:57:07', '2022-02-20 21:08:38'),
(13, '295ddde05d3e8bfdc0c5b929daec1360.png', 3, 'Esfiha de Frango Aberta', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '3.50', '2021-12-26 16:59:06', '2022-02-20 21:09:11'),
(17, '2de789ac9f54d95106cbb80df9607cc4.png', 1, 'Croissant', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '10.50', '2022-02-20 20:42:16', '2022-02-20 21:08:15'),
(18, 'a11567ebb3f1b9ed8602e06754dd929a.png', 1, 'Pão Rústico', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '8.78', '2022-02-20 20:43:28', '2022-02-20 21:08:20'),
(19, '6d69723a61c42c4a1b498b2444b1be4f.png', 1, 'Rosca Doce (500g)', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '12.75', '2022-02-20 20:47:50', '2022-02-20 21:08:25'),
(20, '3539c09211ff0e9d822d4b03d212261a.png', 1, 'Pão de Queijo', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '0.50', '2022-02-20 20:51:00', '2022-02-20 21:08:30'),
(21, '529d3abc7b2e1dbde9069cf820a19f2f.png', 2, 'Bolo de Morango', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '26.99', '2022-02-20 20:52:42', '2022-02-20 21:08:43'),
(22, '699fc58537a46a436321c647e67b8e51.png', 2, 'Torta Holandesa', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '38.95', '2022-02-20 20:53:46', '2022-02-20 21:08:47'),
(23, 'b38a09e2da2e02fc66705645479745ea.png', 2, 'Torta de Limão', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '37.58', '2022-02-20 20:54:18', '2022-02-20 21:08:52'),
(24, '17bd57a7244346273052fdf90aae01f4.png', 2, 'Torta de Maçã', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '41.34', '2022-02-20 20:54:46', '2022-02-20 21:08:59'),
(25, '83d09a6fd5d0f4141b4dc75a311c0758.png', 2, 'Torta de Nozes', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '23.99', '2022-02-20 20:55:21', '2022-02-20 21:09:03'),
(26, '391dbfe56f5a2d795bcef978e4b60695.png', 3, 'Enroladinho de Salsicha', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '3.95', '2022-02-20 20:56:34', '2022-02-20 21:09:17'),
(27, 'e21c1b5e0e7d133f5b3420d501dd2800.png', 3, 'Esfiha de Bacon com Milho', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '3.50', '2022-02-20 20:57:28', '2022-02-20 21:09:24'),
(28, 'c29f963d1f23e69f5c98694d56d17a93.png', 3, 'Kibe', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '2.99', '2022-02-20 20:58:05', '2022-02-20 21:09:30'),
(29, 'db2668201cc579f9a656bdba88c783bc.png', 3, 'Pastel de Palmito', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '3.99', '2022-02-20 20:58:35', '2022-02-20 21:09:37'),
(30, 'b354336f3c9a25227721f8e4930e9f20.png', 3, 'Coxinha Média', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '3.95', '2022-02-20 20:59:03', '2022-02-20 21:09:44'),
(31, 'edb141514164f3b17e092d1dd17002ba.png', 4, 'Coca Cola 350ml', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '2.75', '2022-02-20 21:00:17', '2022-02-20 21:09:57'),
(32, 'f2aeb4c159eaef3f356f8fd4dc5c0cd7.png', 4, 'Fanta Guaraná (350ml)', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '2.29', '2022-02-20 21:01:05', '2022-02-20 21:10:03'),
(33, 'fddccab7a6d72fbff196a3a2a338065d.png', 4, 'Fanta Laranja (350ml)', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '3.20', '2022-02-20 21:01:47', '2022-02-20 21:10:09'),
(34, 'da4257645ed9927d61589f8f0d8d2ac6.png', 4, 'Fanta Uva (350ml)', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '3.18', '2022-02-20 21:02:17', '2022-02-20 21:10:16'),
(35, 'e31a860bc830ff3992778f7663c69feb.png', 4, 'Del Valle Pêssego (290ml)', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '3.58', '2022-02-20 21:03:39', '2022-02-20 21:10:21'),
(36, '7adae37f377a34e49702373577071820.png', 4, 'Del Valle Manga (290ml)', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '3.58', '2022-02-20 21:04:12', '2022-02-20 21:10:27'),
(37, '2578a7d86c4296fdfb775f205c8195d2.png', 4, 'Del Valle Uva (290ml)', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '3.58', '2022-02-20 21:04:46', '2022-02-20 21:10:32'),
(38, '41edaabf208d6bf1a083525537c473e5.png', 4, 'Coca Cola (600ml)', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '5.00', '2022-02-20 21:05:24', '2022-02-20 21:10:39'),
(39, '4d8935b81d3d392e480d0d67f42d09cd.png', 4, 'Fanta Laranja (600ml)', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '4.50', '2022-02-20 21:05:46', '2022-02-20 21:10:45'),
(40, '84ef89a552c45d4a739053ccc595a2df.png', 4, 'Fanta Uva (600ml)', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '4.50', '2022-02-20 21:06:04', '2022-02-20 21:10:54'),
(41, 'a840400f77a1fcaa4665c93fe226a08d.png', 4, 'Sprite (600ml)', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '4.30', '2022-02-20 21:06:27', '2022-02-20 21:11:02'),
(42, '1faf12154c133fe0b7807a0678f3c7a0.png', 4, 'Suco Laranja (500ml)', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '5.00', '2022-02-20 21:07:02', '2022-02-20 21:11:09'),
(49, '027029b4d21c41b080612c7efc331930.png', 8, 'Bomba de Chocolate', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '5.20', '2022-08-15 18:34:47', '2022-08-15 18:34:55'),
(51, '1744f6214609a451faae01a47b91a047.png', 8, 'Carolina (chocolate Branco)', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '2.50', '2022-08-15 18:35:58', NULL),
(52, 'c481ed8a14bae5140de9b57c81950e29.png', 8, 'Brownie de Chocolate', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '8.75', '2022-08-15 18:36:25', NULL),
(53, '566df40e58b1cd982420058f9bd23248.png', 8, 'Mil folhas (creme)', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '8.90', '2022-08-15 18:36:53', NULL),
(54, 'f4dc694752688a0bdc52635bc741e797.png', 8, 'Sonho (1 Unid.)', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '5.20', '2022-08-15 18:38:00', '2022-08-15 18:38:58'),
(55, '03cdd00b25091209b6b092741e159649.png', 8, 'Quindim(1 Un.)', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '3.20', '2022-08-15 18:39:37', '2022-08-15 18:40:31'),
(56, 'a14de5289bbb6889d0f6d16754e7d054.png', 8, 'Cupcake (chocolate)', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '9.90', '2022-08-15 18:41:20', NULL),
(57, 'f2918f48212f3f51312843c6f4cbd4c5.png', 8, 'Cupcake (morango)', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '9.90', '2022-08-15 18:41:43', NULL),
(58, '4f117ebb27e3ce8ed1f362d043149555.png', 8, 'Cupcake Especial', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, quaerat dignissimos. Accusantium nisi quod dolores, facere voluptate ducimus ipsum libero sit, beatae ipsam, ut in. Laboriosam ducimus earum rem qui', '10.50', '2022-08-15 18:42:07', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_user`
--

CREATE TABLE `tb_user` (
  `ID` int(11) NOT NULL,
  `ACESSO` int(11) NOT NULL,
  `NOME` varchar(220) NOT NULL,
  `SOBRENOME` varchar(220) NOT NULL,
  `EMAIL` varchar(220) NOT NULL,
  `DATANASC` date NOT NULL,
  `SENHA` varchar(220) NOT NULL,
  `CREATED` datetime NOT NULL,
  `MODIFIED` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_user`
--

INSERT INTO `tb_user` (`ID`, `ACESSO`, `NOME`, `SOBRENOME`, `EMAIL`, `DATANASC`, `SENHA`, `CREATED`, `MODIFIED`) VALUES
(1, 3, 'ADMIN', 'ADMIN111', 'monamourpadaria@gmail.com', '1999-01-01', '3f7caa3d471688b704b73e9a77b1107f', '2021-12-24 21:18:53', NULL),
(2, 1, 'claudio', 'pereira', 'pereiraclaudio123@gmail.com', '1995-02-01', '14af0fd9322ea4a8815d86f0aa13c566', '2021-12-24 22:08:00', '2022-08-07 16:54:41'),
(3, 1, 'claudio', 'oliveira', 'claudiooliveira002@gmail.com', '1995-04-01', 'd3a3881c252dc21a141084bf52fa446b', '2021-12-25 16:47:40', NULL),
(4, 1, 'Arnaldo', 'Silva', 'arnaldosilva2022@outlook.com', '1995-05-05', 'd025cd3608a5d2db78726e3fb5b4f71d', '2022-03-01 19:12:21', NULL),
(5, 1, 'Robson', 'Henrique', 'robson123@gmail.com', '1995-01-01', '832afa4b80d27500686c14f0566fcec9', '2022-08-22 08:19:01', NULL),
(6, 1, 'Rafael', 'Gomes', 'gomesrafael123@gmail.com', '1995-01-01', '4311a3b1bfd11e5892eded8505ff460d', '2022-08-28 22:09:43', NULL),
(7, 2, 'ADMIN2', 'ADMIN222', 'adminpadaria2022@gmail.com', '1991-01-01', '8ee03b6b48e30df1c5779acb360bedae', '2022-08-28 22:25:23', '2022-08-29 00:03:13'),
(8, 1, 'Giovani', 'Souza', 'souzaGiovani123@gmail.com', '1991-02-01', '5acc5f31e975731a8bc4c3061835a487', '2022-09-18 17:00:06', '2022-09-18 17:05:59');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_categoria`
--
ALTER TABLE `tb_categoria`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `tb_compra`
--
ALTER TABLE `tb_compra`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_ENDERECO` (`ID_ENDERECO`);

--
-- Índices para tabela `tb_endereco`
--
ALTER TABLE `tb_endereco`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_USER` (`ID_USER`);

--
-- Índices para tabela `tb_itens_compra`
--
ALTER TABLE `tb_itens_compra`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_COMPRA` (`ID_COMPRA`),
  ADD KEY `ID_PRODUTO` (`ID_PRODUTO`);

--
-- Índices para tabela `tb_produtos`
--
ALTER TABLE `tb_produtos`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CATEG` (`CATEG`);

--
-- Índices para tabela `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_categoria`
--
ALTER TABLE `tb_categoria`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `tb_compra`
--
ALTER TABLE `tb_compra`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `tb_endereco`
--
ALTER TABLE `tb_endereco`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `tb_itens_compra`
--
ALTER TABLE `tb_itens_compra`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `tb_produtos`
--
ALTER TABLE `tb_produtos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de tabela `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tb_compra`
--
ALTER TABLE `tb_compra`
  ADD CONSTRAINT `tb_compra_ibfk_1` FOREIGN KEY (`ID_ENDERECO`) REFERENCES `tb_endereco` (`ID`);

--
-- Limitadores para a tabela `tb_endereco`
--
ALTER TABLE `tb_endereco`
  ADD CONSTRAINT `tb_endereco_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `tb_user` (`ID`);

--
-- Limitadores para a tabela `tb_itens_compra`
--
ALTER TABLE `tb_itens_compra`
  ADD CONSTRAINT `tb_itens_compra_ibfk_1` FOREIGN KEY (`ID_COMPRA`) REFERENCES `tb_compra` (`ID`),
  ADD CONSTRAINT `tb_itens_compra_ibfk_2` FOREIGN KEY (`ID_PRODUTO`) REFERENCES `tb_produtos` (`ID`);

--
-- Limitadores para a tabela `tb_produtos`
--
ALTER TABLE `tb_produtos`
  ADD CONSTRAINT `tb_produtos_ibfk_1` FOREIGN KEY (`CATEG`) REFERENCES `tb_categoria` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
