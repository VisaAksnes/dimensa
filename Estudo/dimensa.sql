-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3312
-- Tempo de geração: 30/09/2023 às 04:49
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `dimensa`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `contatos`
--

CREATE TABLE `contatos` (
  `id` int(11) NOT NULL,
  `numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `contatos`
--

INSERT INTO `contatos` (`id`, `numero`) VALUES
(1, 2147483647),
(2, 2147483647),
(3, 2147483647);

-- --------------------------------------------------------

--
-- Estrutura para tabela `dadosclientes`
--

CREATE TABLE `dadosclientes` (
  `id_cliente` int(11) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `dataNascimento` date NOT NULL,
  `sexo` char(1) DEFAULT NULL,
  `estadoCivil` varchar(15) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `numeroCasa` int(11) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `contato_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `dadosclientes`
--

INSERT INTO `dadosclientes` (`id_cliente`, `cpf`, `nome`, `dataNascimento`, `sexo`, `estadoCivil`, `email`, `endereco`, `numeroCasa`, `cidade`, `bairro`, `contato_id`) VALUES
(1, '1125444455', 'Tereza Almeida Lopez', '1990-07-10', 'F', 'Casado', 'terezinha_al@gmail.com', 'Avenida Paulista', 789, 'Cataguases', 'Jardim Colorado', NULL),
(2, '77785423458', 'Pedro Paulo Moreira', '1988-03-06', 'M', 'solteiro', NULL, 'Avenida Atlântica', 456, 'Leopoldina', 'Centro', NULL),
(3, '77845699825', 'Lucio Rodrigues Lopez', '1984-10-27', 'M', 'solteiro', 'lucio@gmail.com', 'Cataguases', 6, 'Vila Velha', 'Jardim Colorado', NULL),
(4, '77745865241', 'Lucas Silveira', '1998-05-04', 'M', 'solteiro', 'lucas@gmail.com', 'Rua da Bahia', 789, 'Belo Horizonte', 'Savassi', NULL),
(5, '12248755568', 'Eduarda Medeiros de Souza', '1999-10-15', 'F', 'solteiro', 'duda@gmail.com', 'Rua Padre Chagas', 34, 'Leopoldina', 'Moinhos de Vento', NULL),
(8, '125525545', 'Vini', '1998-09-28', 'M', 'solteiro', 'viniciussouzaavila@hotmail.com', 'leopoldina', 0, '1001', 'Vale das Árvores', NULL),
(83, '1255255452', 'Vini', '1998-09-28', 'M', 'solteiro', 'viniciussouzaavila@hotmail.com', 'rua das pedras 32', 1001, 'leopoldina', 'Vale das Árvores2', NULL),
(84, '12552554523', 'Visconde', '1991-09-01', 'M', 'divorciado', 'viscondi@hotmail.com', 'Rua das luzes', 12, 'Cataguases', 'Vale dourado22', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `contatos`
--
ALTER TABLE `contatos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `dadosclientes`
--
ALTER TABLE `dadosclientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD KEY `fk_contato_id` (`contato_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `contatos`
--
ALTER TABLE `contatos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `dadosclientes`
--
ALTER TABLE `dadosclientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `dadosclientes`
--
ALTER TABLE `dadosclientes`
  ADD CONSTRAINT `fk_contato_id` FOREIGN KEY (`contato_id`) REFERENCES `contatos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
