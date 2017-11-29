-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 27-Nov-2017 às 18:13
-- Versão do servidor: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `estec`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `agendamento`
--

CREATE TABLE `agendamento` (
  `id_agendamento` int(11) NOT NULL,
  `data_agendamento` date DEFAULT NULL,
  `hora` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `agendamento`
--

INSERT INTO `agendamento` (`id_agendamento`, `data_agendamento`, `hora`) VALUES
(1, '2017-12-05', '10:30:00'),
(2, '2017-12-06', '08:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `id_aluno` int(11) NOT NULL,
  `nome` varchar(150) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `telefone` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `fk_cliente` int(11) DEFAULT NULL,
  `fk_turma` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`id_aluno`, `nome`, `telefone`, `email`, `fk_cliente`, `fk_turma`) VALUES
(1, 'João Neto', '33333333', 'joao@estec.com.br', NULL, 1),
(2, 'Mariana Noaves', '44444444', 'mariana@estec.com.br', NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `atendimento`
--

CREATE TABLE `atendimento` (
  `id_atendimento` int(11) NOT NULL,
  `status_atendimento` enum('ok','dependente') CHARACTER SET latin1 DEFAULT NULL,
  `feedback` int(11) DEFAULT NULL,
  `observacao` text CHARACTER SET latin1,
  `fk_agendamento` int(11) DEFAULT NULL,
  `fk_servico` int(11) DEFAULT NULL,
  `fk_cliente` int(11) DEFAULT NULL,
  `fk_aluno` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `atendimento`
--

INSERT INTO `atendimento` (`id_atendimento`, `status_atendimento`, `feedback`, `observacao`, `fk_agendamento`, `fk_servico`, `fk_cliente`, `fk_aluno`) VALUES
(1, 'ok', NULL, NULL, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nome_cliente` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `telefone` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `email` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `fk_endereco` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nome_cliente`, `telefone`, `email`, `fk_endereco`) VALUES
(1, 'Rose', '1111111', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE `endereco` (
  `id_endereco` int(11) NOT NULL,
  `logradouro` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `complemento` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `bairro` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `cidade` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `estado` char(2) CHARACTER SET latin1 DEFAULT 'MG'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

CREATE TABLE `professor` (
  `id_professor` int(11) NOT NULL,
  `nome` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `telefone` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `email` varchar(100) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `professor`
--

INSERT INTO `professor` (`id_professor`, `nome`, `telefone`, `email`) VALUES
(1, 'Administrador', '31999999999', 'admin@estec.com.br');

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor_turma`
--

CREATE TABLE `professor_turma` (
  `id_professor_turma` int(11) NOT NULL,
  `fk_professor` int(11) DEFAULT NULL,
  `fk_turma` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `professor_turma`
--

INSERT INTO `professor_turma` (`id_professor_turma`, `fk_professor`, `fk_turma`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico`
--

CREATE TABLE `servico` (
  `id_servico` int(11) NOT NULL,
  `nome_servico` varchar(50) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `servico`
--

INSERT INTO `servico` (`id_servico`, `nome_servico`) VALUES
(1, 'Tratamento facial'),
(2, 'Sobrancelha'),
(3, 'Massagem'),
(4, 'Tratamento corporal'),
(5, 'Tratamento capilar'),
(6, 'Massagem relaxante'),
(7, 'Escova'),
(8, 'Corte de cabelo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE `turma` (
  `id_turma` int(11) NOT NULL,
  `nome_turma` varchar(50) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `turma`
--

INSERT INTO `turma` (`id_turma`, `nome_turma`) VALUES
(1, '1A'),
(2, '2A');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `senha` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `fk_professor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `usuario`, `senha`, `fk_professor`) VALUES
(1, 'admin', 'admin', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agendamento`
--
ALTER TABLE `agendamento`
  ADD PRIMARY KEY (`id_agendamento`);

--
-- Indexes for table `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`id_aluno`),
  ADD KEY `fk_cliente` (`fk_cliente`),
  ADD KEY `fk_turma` (`fk_turma`);

--
-- Indexes for table `atendimento`
--
ALTER TABLE `atendimento`
  ADD PRIMARY KEY (`id_atendimento`),
  ADD KEY `fk_agendamento` (`fk_agendamento`),
  ADD KEY `fk_servico` (`fk_servico`),
  ADD KEY `fk_aluno` (`fk_aluno`),
  ADD KEY `fk_cliente` (`fk_cliente`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `fk_endereco` (`fk_endereco`);

--
-- Indexes for table `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`id_endereco`);

--
-- Indexes for table `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`id_professor`);

--
-- Indexes for table `professor_turma`
--
ALTER TABLE `professor_turma`
  ADD PRIMARY KEY (`id_professor_turma`),
  ADD KEY `fk_professor` (`fk_professor`),
  ADD KEY `fk_turma` (`fk_turma`);

--
-- Indexes for table `servico`
--
ALTER TABLE `servico`
  ADD PRIMARY KEY (`id_servico`);

--
-- Indexes for table `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`id_turma`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `fk_professor` (`fk_professor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agendamento`
--
ALTER TABLE `agendamento`
  MODIFY `id_agendamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `aluno`
--
ALTER TABLE `aluno`
  MODIFY `id_aluno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `atendimento`
--
ALTER TABLE `atendimento`
  MODIFY `id_atendimento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `endereco`
--
ALTER TABLE `endereco`
  MODIFY `id_endereco` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `professor`
--
ALTER TABLE `professor`
  MODIFY `id_professor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `professor_turma`
--
ALTER TABLE `professor_turma`
  MODIFY `id_professor_turma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `servico`
--
ALTER TABLE `servico`
  MODIFY `id_servico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `turma`
--
ALTER TABLE `turma`
  MODIFY `id_turma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `aluno_ibfk_1` FOREIGN KEY (`fk_cliente`) REFERENCES `cliente` (`id_cliente`),
  ADD CONSTRAINT `aluno_ibfk_2` FOREIGN KEY (`fk_turma`) REFERENCES `turma` (`id_turma`);

--
-- Limitadores para a tabela `atendimento`
--
ALTER TABLE `atendimento`
  ADD CONSTRAINT `atendimento_ibfk_1` FOREIGN KEY (`fk_agendamento`) REFERENCES `agendamento` (`id_agendamento`),
  ADD CONSTRAINT `atendimento_ibfk_2` FOREIGN KEY (`fk_servico`) REFERENCES `servico` (`id_servico`),
  ADD CONSTRAINT `atendimento_ibfk_3` FOREIGN KEY (`fk_aluno`) REFERENCES `aluno` (`id_aluno`),
  ADD CONSTRAINT `atendimento_ibfk_4` FOREIGN KEY (`fk_cliente`) REFERENCES `cliente` (`id_cliente`);

--
-- Limitadores para a tabela `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`fk_endereco`) REFERENCES `endereco` (`id_endereco`);

--
-- Limitadores para a tabela `professor_turma`
--
ALTER TABLE `professor_turma`
  ADD CONSTRAINT `professor_turma_ibfk_1` FOREIGN KEY (`fk_professor`) REFERENCES `professor` (`id_professor`),
  ADD CONSTRAINT `professor_turma_ibfk_2` FOREIGN KEY (`fk_turma`) REFERENCES `turma` (`id_turma`);

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`fk_professor`) REFERENCES `professor` (`id_professor`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
