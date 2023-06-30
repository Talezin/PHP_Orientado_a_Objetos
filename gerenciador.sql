-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30-Jun-2023 às 16:28
-- Versão do servidor: 10.4.25-MariaDB
-- versão do PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `gerenciador`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `transportadoras`
--

CREATE TABLE `transportadoras` (
  `codigo` int(5) UNSIGNED ZEROFILL NOT NULL,
  `razaoSocial` text NOT NULL,
  `estadoTransp` text NOT NULL,
  `nomeFantasia` text NOT NULL,
  `cnpjTransp` varchar(18) NOT NULL,
  `apoliceTransp` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `transportadoras`
--

INSERT INTO `transportadoras` (`codigo`, `razaoSocial`, `estadoTransp`, `nomeFantasia`, `cnpjTransp`, `apoliceTransp`) VALUES
(00020, 'Lorem Ipsum', 'SP', 'Lorem Ipsum LTDA', '11.111.111/1111-11', 2),
(00022, 'A & Cia', 'TO', 'A', '11.111.111/1111-12', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `transportadoras`
--
ALTER TABLE `transportadoras`
  ADD PRIMARY KEY (`codigo`),
  ADD UNIQUE KEY `cnpjTransp` (`cnpjTransp`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `transportadoras`
--
ALTER TABLE `transportadoras`
  MODIFY `codigo` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
