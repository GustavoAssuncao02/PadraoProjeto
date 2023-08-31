-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 31-Ago-2023 às 08:02
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projeto_final`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `trabalhofinal`
--

CREATE TABLE `trabalhofinal` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `dataNascimento` date NOT NULL,
  `cpf` varchar(45) NOT NULL,
  `administrador` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `trabalhofinal`
--

INSERT INTO `trabalhofinal` (`id`, `nome`, `senha`, `email`, `dataNascimento`, `cpf`, `administrador`) VALUES
(1, 'dasdas', 'dsadada', 'dsadasda', '1111-11-11', '111.111.111-11', 1),
(2, 'gustavo32131231', '321321', 'gu-gustavo02-gu@hotmail.com', '1111-11-11', '231.312.321-22', 0),
(3, 'Gustavo12121', '12038i19203', 'Gustavo@hotrmail.com', '1111-11-11', '123.123.123-12', 0),
(4, 'Gustavo1212132', 'dadasda', 'gu-gustavo02-gu@hotmail.com', '1111-11-11', '312.313.232-32', 0),
(5, 'Gustavo02', 'Gustavo02', 'Gustavo02', '1111-11-11', '111.111.111-13', 0),
(6, 'teste1', 'teste1', 'teste1', '1111-11-11', '111.111.111-22', 0),
(7, 'teste3', 'teste3', 'teste3', '1111-11-11', '333.333.333-33', 0),
(8, 'teste4', 'teste4', 'teste4', '1111-11-11', '444.444.444-44', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `trabalhofinal`
--
ALTER TABLE `trabalhofinal`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `trabalhofinal`
--
ALTER TABLE `trabalhofinal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
