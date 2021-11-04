-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.14-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para database_portal
CREATE DATABASE IF NOT EXISTS `database_portal` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `database_portal`;

-- Copiando estrutura para tabela database_portal.categoria
CREATE TABLE IF NOT EXISTS `categoria` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.categoria: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` (`cod`, `categoria`) VALUES
	(1, 'Itens de informática'),
	(2, 'Eletrônicos'),
	(3, 'Softwares'),
	(4, 'NA');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;

-- Copiando estrutura para tabela database_portal.categoria_empresa_privada
CREATE TABLE IF NOT EXISTS `categoria_empresa_privada` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` int(11) DEFAULT NULL,
  `cnpj` char(14) DEFAULT NULL,
  PRIMARY KEY (`cod`),
  KEY `FK_categoria_empresa_privada-categoria` (`categoria`),
  KEY `FK_categoria_empresa_privada-empresa_privada` (`cnpj`),
  CONSTRAINT `FK_categoria_empresa_privada-categoria` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_categoria_empresa_privada-empresa_privada` FOREIGN KEY (`cnpj`) REFERENCES `empresa_privada` (`cnpj`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.categoria_empresa_privada: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `categoria_empresa_privada` DISABLE KEYS */;
INSERT INTO `categoria_empresa_privada` (`cod`, `categoria`, `cnpj`) VALUES
	(1, 2, '72381189000110'),
	(2, 3, '72381189000110'),
	(3, 1, '25072293000143'),
	(4, 2, '25072293000143');
/*!40000 ALTER TABLE `categoria_empresa_privada` ENABLE KEYS */;

-- Copiando estrutura para tabela database_portal.categoria_pedido
CREATE TABLE IF NOT EXISTS `categoria_pedido` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `pedido` int(11) DEFAULT NULL,
  `categoria` int(11) DEFAULT NULL,
  PRIMARY KEY (`cod`),
  KEY `FK_categoria_pedido-pedido` (`pedido`),
  KEY `FK_categoria_pedido-categoria` (`categoria`),
  CONSTRAINT `FK_categoria_pedido-categoria` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_categoria_pedido-pedido` FOREIGN KEY (`pedido`) REFERENCES `pedido` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.categoria_pedido: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `categoria_pedido` DISABLE KEYS */;
/*!40000 ALTER TABLE `categoria_pedido` ENABLE KEYS */;

-- Copiando estrutura para tabela database_portal.empresa_privada
CREATE TABLE IF NOT EXISTS `empresa_privada` (
  `cnpj` char(14) NOT NULL,
  `razao_social` varchar(50) DEFAULT NULL,
  `nome_fantasia` varchar(80) DEFAULT NULL,
  `efr` varchar(50) DEFAULT NULL,
  `telefone` varchar(30) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `natureza` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cnpj`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.empresa_privada: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `empresa_privada` DISABLE KEYS */;
INSERT INTO `empresa_privada` (`cnpj`, `razao_social`, `nome_fantasia`, `efr`, `telefone`, `email`, `natureza`) VALUES
	('25072293000143', 'JHONATAN TABAJARA DE OLIVEIRA 39628061801', 'PROTEGIDOS', 'NA', '(11) 95554-6146', 'jhonatanjt.9@gmail.com', '213-5 - Empresário (Individual)'),
	('72381189000110', 'DELL COMPUTADORES DO BRASIL LTDA', 'NA', 'NA', '(51) 3274-5500', 'br_tax@dell.com', '206-2 - Sociedade Empresária Limitada');
/*!40000 ALTER TABLE `empresa_privada` ENABLE KEYS */;

-- Copiando estrutura para tabela database_portal.endereco_empresa_privada
CREATE TABLE IF NOT EXISTS `endereco_empresa_privada` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `logradouro` varchar(80) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `cep` char(8) DEFAULT NULL,
  `cidade` varchar(30) DEFAULT NULL,
  `uf` char(2) DEFAULT NULL,
  `cnpj` char(14) DEFAULT NULL,
  PRIMARY KEY (`cod`),
  KEY `FK_endereco_empresa_privada-empresa_privada` (`cnpj`),
  CONSTRAINT `FK_endereco_empresa_privada-empresa_privada` FOREIGN KEY (`cnpj`) REFERENCES `empresa_privada` (`cnpj`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.endereco_empresa_privada: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `endereco_empresa_privada` DISABLE KEYS */;
INSERT INTO `endereco_empresa_privada` (`cod`, `logradouro`, `numero`, `bairro`, `cep`, `cidade`, `uf`, `cnpj`) VALUES
	(1, 'AV INDUSTRIAL BELGRAF', '400', 'INDUSTRIAL', '92990000', 'ELDORADO DO SUL', 'RS', '72381189000110'),
	(2, 'R CAPELA DO DIVINO', '40', 'MASCATE', '12960000', 'NAZARE PAULISTA', 'SP', '25072293000143');
/*!40000 ALTER TABLE `endereco_empresa_privada` ENABLE KEYS */;

-- Copiando estrutura para tabela database_portal.endereco_instituicao_publica
CREATE TABLE IF NOT EXISTS `endereco_instituicao_publica` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `logradouro` varchar(80) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `cep` char(8) DEFAULT NULL,
  `cidade` varchar(30) DEFAULT NULL,
  `uf` char(2) DEFAULT NULL,
  `cnpj` char(14) DEFAULT NULL,
  PRIMARY KEY (`cod`),
  KEY `FK_endereco_instituicao_publica-instituicao_publica` (`cnpj`),
  CONSTRAINT `FK_endereco_instituicao_publica-instituicao_publica` FOREIGN KEY (`cnpj`) REFERENCES `instituicao_publica` (`cnpj`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.endereco_instituicao_publica: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `endereco_instituicao_publica` DISABLE KEYS */;
INSERT INTO `endereco_instituicao_publica` (`cod`, `logradouro`, `numero`, `bairro`, `cep`, `cidade`, `uf`, `cnpj`) VALUES
	(1, 'R DOM DUARTE LEOPOLDO', '83', 'CENTRO', '12955000', 'BOM JESUS DOS PERDOES', 'SP', '52359692000162');
/*!40000 ALTER TABLE `endereco_instituicao_publica` ENABLE KEYS */;

-- Copiando estrutura para tabela database_portal.instituicao_publica
CREATE TABLE IF NOT EXISTS `instituicao_publica` (
  `cnpj` char(14) NOT NULL,
  `razao_social` varchar(50) DEFAULT NULL,
  `nome_fantasia` varchar(80) DEFAULT NULL,
  `efr` varchar(50) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `natureza` varchar(50) DEFAULT NULL,
  `telefone` varchar(30) DEFAULT NULL,
  `status_cadastro` int(11) DEFAULT NULL,
  PRIMARY KEY (`cnpj`),
  KEY `FK_instituicao_publica-status-cadastro` (`status_cadastro`),
  CONSTRAINT `FK_instituicao_publica-status-cadastro` FOREIGN KEY (`status_cadastro`) REFERENCES `status_cadastro` (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.instituicao_publica: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `instituicao_publica` DISABLE KEYS */;
INSERT INTO `instituicao_publica` (`cnpj`, `razao_social`, `nome_fantasia`, `efr`, `email`, `natureza`, `telefone`, `status_cadastro`) VALUES
	('52359692000162', 'MUNICIPIO DE BOM JESUS DOS PERDOES', 'BOM JESUS DOS PERDOES GABINETE PREFEITO', 'MUNICÍPIO DE BOM JESUS DOS PERDOES', 'cpd@bjperdoes.sp.gov.br', '124-4 - Município', '11 997645981', 3);
/*!40000 ALTER TABLE `instituicao_publica` ENABLE KEYS */;

-- Copiando estrutura para tabela database_portal.item_pedido
CREATE TABLE IF NOT EXISTS `item_pedido` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `item` varchar(50) DEFAULT NULL,
  `descricao` varchar(400) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `unidade` varchar(5) DEFAULT NULL,
  `pedido_cod` int(11) DEFAULT NULL,
  PRIMARY KEY (`cod`),
  KEY `FK_item_pedido-pedido` (`pedido_cod`),
  CONSTRAINT `FK_item_pedido-pedido` FOREIGN KEY (`pedido_cod`) REFERENCES `pedido` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.item_pedido: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `item_pedido` DISABLE KEYS */;
/*!40000 ALTER TABLE `item_pedido` ENABLE KEYS */;

-- Copiando estrutura para tabela database_portal.login_empresa_privada
CREATE TABLE IF NOT EXISTS `login_empresa_privada` (
  `login` varchar(50) NOT NULL,
  `cnpj` char(14) DEFAULT NULL,
  `senha` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`login`),
  KEY `FK_login_empresa_privada-empresa_privada` (`cnpj`),
  CONSTRAINT `FK_login_empresa_privada-empresa_privada` FOREIGN KEY (`cnpj`) REFERENCES `empresa_privada` (`cnpj`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.login_empresa_privada: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `login_empresa_privada` DISABLE KEYS */;
INSERT INTO `login_empresa_privada` (`login`, `cnpj`, `senha`) VALUES
	('br_tax@dell.com', '72381189000110', '123'),
	('jhonatanjt.9@gmail.com', '25072293000143', '123');
/*!40000 ALTER TABLE `login_empresa_privada` ENABLE KEYS */;

-- Copiando estrutura para tabela database_portal.login_instituicao_publica
CREATE TABLE IF NOT EXISTS `login_instituicao_publica` (
  `login` varchar(50) NOT NULL,
  `cnpj` char(14) DEFAULT NULL,
  `senha` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`login`),
  KEY `FK_login_instituicao_publica-instituicao_publica` (`cnpj`),
  CONSTRAINT `FK_login_instituicao_publica-instituicao_publica` FOREIGN KEY (`cnpj`) REFERENCES `instituicao_publica` (`cnpj`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.login_instituicao_publica: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `login_instituicao_publica` DISABLE KEYS */;
INSERT INTO `login_instituicao_publica` (`login`, `cnpj`, `senha`) VALUES
	('cpd@bjperdoes.sp.gov.br', '52359692000162', 'pref2020');
/*!40000 ALTER TABLE `login_instituicao_publica` ENABLE KEYS */;

-- Copiando estrutura para tabela database_portal.modo_pedido
CREATE TABLE IF NOT EXISTS `modo_pedido` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `modo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.modo_pedido: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `modo_pedido` DISABLE KEYS */;
INSERT INTO `modo_pedido` (`cod`, `modo`) VALUES
	(1, 'Compra direta'),
	(2, 'Licitação');
/*!40000 ALTER TABLE `modo_pedido` ENABLE KEYS */;

-- Copiando estrutura para tabela database_portal.pedido
CREATE TABLE IF NOT EXISTS `pedido` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `data_abertura` datetime DEFAULT NULL,
  `data_fechamento` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `modo` int(11) DEFAULT NULL,
  `cnpj` char(14) DEFAULT NULL,
  `distancia` int(6) DEFAULT NULL,
  PRIMARY KEY (`cod`),
  KEY `FK_pedido-instituicao_publica` (`cnpj`),
  KEY `FK_pedido-modo_pedido` (`modo`),
  KEY `FK_pedido-status_pedido` (`status`),
  CONSTRAINT `FK_pedido-instituicao_publica` FOREIGN KEY (`cnpj`) REFERENCES `instituicao_publica` (`cnpj`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_pedido-modo_pedido` FOREIGN KEY (`modo`) REFERENCES `modo_pedido` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_pedido-status_pedido` FOREIGN KEY (`status`) REFERENCES `status_pedido` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.pedido: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `pedido` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedido` ENABLE KEYS */;

-- Copiando estrutura para tabela database_portal.status_cadastro
CREATE TABLE IF NOT EXISTS `status_cadastro` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(15) DEFAULT NULL,
  `descricao` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.status_cadastro: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `status_cadastro` DISABLE KEYS */;
INSERT INTO `status_cadastro` (`cod`, `status`, `descricao`) VALUES
	(1, 'Solicitado', 'A solicitação foi realizada'),
	(2, 'Em análise', 'A solicitação de cadastro está'),
	(3, 'Aprovado', 'A solicitação de cadastro foi ');
/*!40000 ALTER TABLE `status_cadastro` ENABLE KEYS */;

-- Copiando estrutura para tabela database_portal.status_cadastro_hist
CREATE TABLE IF NOT EXISTS `status_cadastro_hist` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `cnpj` char(14) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  PRIMARY KEY (`cod`),
  KEY `FK_status_cadastro_hist-instituicao_publica` (`cnpj`),
  KEY `FK_status_cadastro_hist-status_cadastro` (`status`),
  CONSTRAINT `FK_status_cadastro_hist-instituicao_publica` FOREIGN KEY (`cnpj`) REFERENCES `instituicao_publica` (`cnpj`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_status_cadastro_hist-status_cadastro` FOREIGN KEY (`status`) REFERENCES `status_cadastro` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.status_cadastro_hist: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `status_cadastro_hist` DISABLE KEYS */;
INSERT INTO `status_cadastro_hist` (`cod`, `cnpj`, `status`, `data`) VALUES
	(1, '52359692000162', 1, '2021-09-14 22:32:29'),
	(2, '52359692000162', 2, '2021-09-28 19:23:09'),
	(3, '52359692000162', 3, '2021-09-28 19:27:22'),
	(4, '52359692000162', 2, '2021-11-01 16:36:34'),
	(5, '52359692000162', 3, '2021-11-01 16:36:45');
/*!40000 ALTER TABLE `status_cadastro_hist` ENABLE KEYS */;

-- Copiando estrutura para tabela database_portal.status_pedido
CREATE TABLE IF NOT EXISTS `status_pedido` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(20) DEFAULT NULL,
  `desc` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.status_pedido: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `status_pedido` DISABLE KEYS */;
INSERT INTO `status_pedido` (`cod`, `status`, `desc`) VALUES
	(1, 'Aberto', 'O pedido está disponível para receber cotações'),
	(2, 'Finalizado', 'O pedido está indisponível para receber cotações p'),
	(3, 'Cancelado', 'O pedido foi cancelado pelo órgão publico responsá');
/*!40000 ALTER TABLE `status_pedido` ENABLE KEYS */;

-- Copiando estrutura para trigger database_portal.historico_status_cad
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `historico_status_cad` BEFORE UPDATE ON `instituicao_publica` FOR EACH ROW BEGIN
IF  old.status_cadastro <> new.status_cadastro then
INSERT INTO status_cadastro_hist (cnpj, status, data) VALUES (NEW.cnpj, NEW.status_cadastro, NOW());
END if;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
