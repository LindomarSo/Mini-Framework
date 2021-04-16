-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10-Abr-2021 às 14:46
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bootstrap_projeto`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_equipe`
--

CREATE TABLE `tb_equipe` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_equipe`
--

INSERT INTO `tb_equipe` (`id`, `nome`, `descricao`) VALUES
(39, 'Usuário 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ac lorem elit. In hac habitasse platea dictumst. Cras et egestas erat, vel condimentum neque. Etiam maximus placerat lorem sit amet accumsan.'),
(42, 'Usuário 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ac lorem elit. In hac habitasse platea dictumst. Cras et egestas erat, vel condimentum neque. Etiam maximus placerat lorem sit amet accumsan.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_painel.usuarios`
--

CREATE TABLE `tb_painel.usuarios` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_painel.usuarios`
--

INSERT INTO `tb_painel.usuarios` (`id`, `user`, `password`) VALUES
(1, 'admin', '1234');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_sobre`
--

CREATE TABLE `tb_sobre` (
  `id` int(11) NOT NULL,
  `sobre` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_sobre`
--

INSERT INTO `tb_sobre` (`id`, `sobre`) VALUES
(15, '<div class=\"col-md-4\">\r\n              <h3 class=\"text-center\"><span class=\"glyphicon glyphicon-education\"></span></h3>\r\n              <h2 class=\"text-center\">Difrencial #1</h2>\r\n              <p class=\"text-justify\">Que nos consola em toda a nossa tribulação, para que também possamos consolar os que estiverem em alguma tribulação, com a consolação com que nós mesmos somos consolados por Deus.</p>\r\n            </div>\r\n            <div class=\"col-md-4\">\r\n              <h3 class=\"text-center\"><span class=\"glyphicon glyphicon-tasks\"></span></h3>\r\n              <h2 class=\"text-center\">Difrencial #1</h2>\r\n              <p class=\"text-justify\">Que nos consola em toda a nossa tribulação, para que também possamos consolar os que estiverem em alguma tribulação, com a consolação com que nós mesmos somos consolados por Deus.</p>\r\n            </div>\r\n            <div class=\"col-md-4\">\r\n              <h3 class=\"text-center\"><span class=\"glyphicon glyphicon-check\"></span></h3>\r\n              <h2 class=\"text-center\">Difrencial #1</h2>\r\n              <p class=\"text-justify\">Que nos consola em toda a nossa tribulação, para que também possamos consolar os que estiverem em alguma tribulação, com a consolação com que nós mesmos somos consolados por Deus.</p>\r\n            </div>');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_equipe`
--
ALTER TABLE `tb_equipe`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_painel.usuarios`
--
ALTER TABLE `tb_painel.usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_sobre`
--
ALTER TABLE `tb_sobre`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_equipe`
--
ALTER TABLE `tb_equipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de tabela `tb_painel.usuarios`
--
ALTER TABLE `tb_painel.usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tb_sobre`
--
ALTER TABLE `tb_sobre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
