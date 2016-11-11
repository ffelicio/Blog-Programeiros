-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 09/11/2016 às 01:58
-- Versão do servidor: 5.5.53-0+deb8u1
-- Versão do PHP: 5.6.27-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `programeiros`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `login`
--

CREATE TABLE IF NOT EXISTS `login` (
`id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `senha` varchar(255) NOT NULL,
  `thumb` varchar(55) NOT NULL,
  `data` date NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `login`
--

INSERT INTO `login` (`id`, `nome`, `email`, `usuario`, `descricao`, `senha`, `thumb`, `data`) VALUES
(15, 'Administrador', 'admin@admin.com', 'admin', 'Programador Back-End, Jedi, Pai, Coder, usuário Debian', 'ee10c315eba2c75b403ea99136f5b48d', 'foto.png', '2016-11-01');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_postagens`
--

CREATE TABLE IF NOT EXISTS `tb_postagens` (
`id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `conteudo` text NOT NULL,
  `categoria` varchar(55) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `usuario` varchar(255) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `tb_postagens`
--

-- Null
-- --------------------------------------------------------

--
-- Estrutura para tabela `vagas`
--

CREATE TABLE IF NOT EXISTS `vagas` (
`id_vaga` int(11) NOT NULL,
  `titulo_vaga` varchar(255) NOT NULL,
  `descricao_vaga` text NOT NULL,
  `divulgador` varchar(255) NOT NULL,
  `local` varchar(255) NOT NULL,
  `nivel` varchar(255) NOT NULL,
  `data_inc` date NOT NULL,
  `data_exp` date NOT NULL,
  `aprovada` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `vagas`
--

INSERT INTO `vagas` (`id_vaga`, `titulo_vaga`, `descricao_vaga`, `divulgador`, `local`, `nivel`, `data_inc`, `data_exp`, `aprovada`) VALUES
(2, 'teste', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'Administrador', 'local', 'Analista Pleno', '2016-11-09', '2017-02-07', 0);

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `login`
--
ALTER TABLE `login`
 ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_postagens`
--
ALTER TABLE `tb_postagens`
 ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `vagas`
--
ALTER TABLE `vagas`
 ADD PRIMARY KEY (`id_vaga`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `login`
--
ALTER TABLE `login`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de tabela `tb_postagens`
--
ALTER TABLE `tb_postagens`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT de tabela `vagas`
--
ALTER TABLE `vagas`
MODIFY `id_vaga` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
