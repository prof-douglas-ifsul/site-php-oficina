-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 11-Jul-2022 às 04:35
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oficina`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `idcliente` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `idusuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`idcliente`, `nome`, `email`, `idusuario`) VALUES
(1, 'nome teste', 'teste@servidordeemail.com.br', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `fabricantes`
--

CREATE TABLE `fabricantes` (
  `idfabricante` int(11) NOT NULL,
  `nome_curto` varchar(50) NOT NULL,
  `nome` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `fabricantes`
--

INSERT INTO `fabricantes` (`idfabricante`, `nome_curto`, `nome`) VALUES
(1, 'Fiat', 'Fiat'),
(2, 'VW', 'Volkswagen'),
(3, 'GM', 'General Motors'),
(4, 'Hyundai', 'Hyundai'),
(5, 'Honda', 'Honda');

-- --------------------------------------------------------

--
-- Estrutura da tabela `modelos`
--

CREATE TABLE `modelos` (
  `idmodelo` int(11) NOT NULL,
  `idfabricante` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `modelos`
--

INSERT INTO `modelos` (`idmodelo`, `idfabricante`, `nome`) VALUES
(1, 2, 'Fusca');

-- --------------------------------------------------------

--
-- Estrutura da tabela `servicos`
--

CREATE TABLE `servicos` (
  `idservico` int(11) NOT NULL,
  `data` date NOT NULL,
  `idcliente` int(11) NOT NULL,
  `idveiculo` int(11) NOT NULL,
  `quilometragem` int(11) NOT NULL,
  `resumo` text NOT NULL,
  `valor` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `nome` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `senha` varchar(64) NOT NULL,
  `admin` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `nome`, `email`, `senha`, `admin`) VALUES
(1, 'oficina', 'oficina@oficina.com.br', '0aec0b5b861e5c3185b91ac349c3348c076044bfff2f7f8a33a67b144d7f8f7e', 0),
(3, 'Douglas Kellermann', 'douglaskellermann@ifsul.edu.br', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `veiculos`
--

CREATE TABLE `veiculos` (
  `idveiculo` int(11) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `placa` varchar(15) DEFAULT NULL,
  `idfabricante` int(11) NOT NULL,
  `idmodelo` int(11) NOT NULL,
  `ano_fabricacao` smallint(6) DEFAULT NULL,
  `descricao` varchar(100) NOT NULL
) ;

--
-- Extraindo dados da tabela `veiculos`
--

INSERT INTO `veiculos` (`idveiculo`, `idcliente`, `placa`, `idfabricante`, `idmodelo`, `ano_fabricacao`, `descricao`) VALUES
(1, 1, 'xxx0987', 2, 1, 1901, 'Fusca 1982 Vermelho');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idcliente`),
  ADD KEY `fk_clientes_idusuario_usuarios` (`idusuario`);

--
-- Indexes for table `fabricantes`
--
ALTER TABLE `fabricantes`
  ADD PRIMARY KEY (`idfabricante`);

--
-- Indexes for table `modelos`
--
ALTER TABLE `modelos`
  ADD PRIMARY KEY (`idmodelo`),
  ADD KEY `fk_modelos_idfabricante_fabricantes` (`idfabricante`);

--
-- Indexes for table `servicos`
--
ALTER TABLE `servicos`
  ADD PRIMARY KEY (`idservico`),
  ADD KEY `fk_servicos_idcliente_clientes` (`idcliente`),
  ADD KEY `fk_servicos_idveiculo_veiculos` (`idveiculo`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `uk_email_usuario` (`email`);

--
-- Indexes for table `veiculos`
--
ALTER TABLE `veiculos`
  ADD PRIMARY KEY (`idveiculo`),
  ADD KEY `fk_idcliente_clientes` (`idcliente`),
  ADD KEY `fk_idfabricante_fabricantes` (`idfabricante`),
  ADD KEY `fk_idmodelo_modelos` (`idmodelo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fabricantes`
--
ALTER TABLE `fabricantes`
  MODIFY `idfabricante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `modelos`
--
ALTER TABLE `modelos`
  MODIFY `idmodelo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `servicos`
--
ALTER TABLE `servicos`
  MODIFY `idservico` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `veiculos`
--
ALTER TABLE `veiculos`
  MODIFY `idveiculo` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `fk_clientes_idusuario_usuarios` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`);

--
-- Limitadores para a tabela `modelos`
--
ALTER TABLE `modelos`
  ADD CONSTRAINT `fk_modelos_idfabricante_fabricantes` FOREIGN KEY (`idfabricante`) REFERENCES `fabricantes` (`idfabricante`);

--
-- Limitadores para a tabela `servicos`
--
ALTER TABLE `servicos`
  ADD CONSTRAINT `fk_servicos_idcliente_clientes` FOREIGN KEY (`idcliente`) REFERENCES `clientes` (`idcliente`),
  ADD CONSTRAINT `fk_servicos_idveiculo_veiculos` FOREIGN KEY (`idveiculo`) REFERENCES `veiculos` (`idveiculo`);

--
-- Limitadores para a tabela `veiculos`
--
ALTER TABLE `veiculos`
  ADD CONSTRAINT `fk_idcliente_clientes` FOREIGN KEY (`idcliente`) REFERENCES `clientes` (`idcliente`),
  ADD CONSTRAINT `fk_idfabricante_fabricantes` FOREIGN KEY (`idfabricante`) REFERENCES `fabricantes` (`idfabricante`),
  ADD CONSTRAINT `fk_idmodelo_modelos` FOREIGN KEY (`idmodelo`) REFERENCES `modelos` (`idmodelo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
