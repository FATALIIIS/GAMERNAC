-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 31-Jul-2026 às 21:43
-- Versão do servidor: 5.7.17
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamernac`
--
DROP DATABASE IF EXISTS `gamernac`;
CREATE DATABASE IF NOT EXISTS `gamernac` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `gamernac`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `admnistrador`
--

CREATE TABLE `admnistrador` (
  `cod_adm` int(11) NOT NULL,
  `Login` varchar(20) DEFAULT NULL,
  `Cpf` varchar(11) DEFAULT NULL,
  `Nome` varchar(40) DEFAULT NULL,
  `Senha` varchar(80) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `admnistrador`
--

INSERT INTO `admnistrador` (`cod_adm`, `Login`, `Cpf`, `Nome`, `Senha`) VALUES
(1, 'admin', '99842049904', 'João Button Silveira', '$2y$10$o4EmfvUs6F7b0bRf6Lvx2er1YjQCtooRRc6Zi0z8MwWaZ4JeXhZXK');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `sexo` varchar(1) DEFAULT NULL,
  `nome` varchar(40) DEFAULT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `telefone` varchar(14) DEFAULT NULL,
  `senha` varchar(80) DEFAULT NULL,
  `login` varchar(20) DEFAULT NULL,
  `endereco` varchar(50) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `data_nasci` date DEFAULT NULL,
  `cod_cli` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens`
--

CREATE TABLE `itens` (
  `cod_prod` int(11) NOT NULL,
  `cod_ped` int(11) NOT NULL,
  `cod_jogo` int(11) NOT NULL,
  `cod_item` varchar(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `jogo`
--

CREATE TABLE `jogo` (
  `capa` blob,
  `classificacao` varchar(1) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `nome` varchar(1) DEFAULT NULL,
  `genero` varchar(1) DEFAULT NULL,
  `descricao` text,
  `valor` decimal(5,2) DEFAULT NULL,
  `cod_jogo` int(11) NOT NULL,
  `data_lanc` varchar(1) DEFAULT NULL,
  `cod_adm` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE `pedido` (
  `valor` decimal(9,2) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `cod_ped` int(11) NOT NULL,
  `fechado` tinyint(1) DEFAULT NULL,
  `cod_cli` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `valor` decimal(6,2) DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `tipo` varchar(30) DEFAULT NULL,
  `descricao` text,
  `imagem` blob,
  `cod_prod` int(11) NOT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `cod_adm` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admnistrador`
--
ALTER TABLE `admnistrador`
  ADD PRIMARY KEY (`cod_adm`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cod_cli`);

--
-- Indexes for table `itens`
--
ALTER TABLE `itens`
  ADD PRIMARY KEY (`cod_prod`,`cod_ped`,`cod_jogo`,`cod_item`);

--
-- Indexes for table `jogo`
--
ALTER TABLE `jogo`
  ADD PRIMARY KEY (`cod_jogo`),
  ADD KEY `cod_adm` (`cod_adm`);

--
-- Indexes for table `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`cod_ped`),
  ADD KEY `cod_cli` (`cod_cli`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`cod_prod`),
  ADD KEY `cod_adm` (`cod_adm`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admnistrador`
--
ALTER TABLE `admnistrador`
  MODIFY `cod_adm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
