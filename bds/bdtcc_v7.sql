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

-- Copiando estrutura para tabela database_portal.anexos_cotacoes
CREATE TABLE IF NOT EXISTS `anexos_cotacoes` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `cotacao` int(11) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  PRIMARY KEY (`cod`),
  KEY `FK__cotacoes` (`cotacao`),
  CONSTRAINT `FK__cotacoes` FOREIGN KEY (`cotacao`) REFERENCES `cotacoes` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.anexos_cotacoes: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `anexos_cotacoes` DISABLE KEYS */;
/*!40000 ALTER TABLE `anexos_cotacoes` ENABLE KEYS */;

-- Copiando estrutura para tabela database_portal.anexos_pedido
CREATE TABLE IF NOT EXISTS `anexos_pedido` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) DEFAULT NULL,
  `pedido` int(11) DEFAULT NULL,
  PRIMARY KEY (`cod`),
  KEY `FK__pedido` (`pedido`),
  CONSTRAINT `FK__pedido` FOREIGN KEY (`pedido`) REFERENCES `pedido` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.anexos_pedido: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `anexos_pedido` DISABLE KEYS */;
/*!40000 ALTER TABLE `anexos_pedido` ENABLE KEYS */;

-- Copiando estrutura para tabela database_portal.categoria
CREATE TABLE IF NOT EXISTS `categoria` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.categoria: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` (`cod`, `categoria`) VALUES
	(1, 'Itens de informática'),
	(2, 'Eletrônicos'),
	(3, 'Softwares'),
	(4, 'NA'),
	(6, 'Ferramentas'),
	(7, 'Impressoras'),
	(8, 'Manutenção de Impressoras'),
	(9, 'Cartuchos');
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.categoria_empresa_privada: ~14 rows (aproximadamente)
/*!40000 ALTER TABLE `categoria_empresa_privada` DISABLE KEYS */;
INSERT INTO `categoria_empresa_privada` (`cod`, `categoria`, `cnpj`) VALUES
	(7, 2, '72381189000110'),
	(8, 1, '72381189000110'),
	(9, 1, '24846428000118'),
	(10, 2, '24846428000118'),
	(11, 7, '04911191000102'),
	(12, 9, '04911191000102'),
	(13, 8, '10176707000107'),
	(14, 7, '10176707000107'),
	(15, 9, '10176707000107'),
	(16, 1, '08914106000102'),
	(17, 6, '08914106000102'),
	(18, 2, '08914106000102'),
	(19, 9, '08914106000102'),
	(20, 3, '25072293000143');
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.categoria_pedido: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `categoria_pedido` DISABLE KEYS */;
INSERT INTO `categoria_pedido` (`cod`, `pedido`, `categoria`) VALUES
	(6, 18, 1),
	(7, 18, 2),
	(8, 18, 9);
/*!40000 ALTER TABLE `categoria_pedido` ENABLE KEYS */;

-- Copiando estrutura para tabela database_portal.cotacoes
CREATE TABLE IF NOT EXISTS `cotacoes` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `pedido` int(11) DEFAULT NULL,
  `empresa` char(14) DEFAULT NULL,
  `observacao` text DEFAULT NULL,
  PRIMARY KEY (`cod`),
  KEY `FK_cotacoes_pedido` (`pedido`),
  KEY `FK_cotacoes_empresa_privada` (`empresa`),
  CONSTRAINT `FK_cotacoes_empresa_privada` FOREIGN KEY (`empresa`) REFERENCES `empresa_privada` (`cnpj`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_cotacoes_pedido` FOREIGN KEY (`pedido`) REFERENCES `pedido` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.cotacoes: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cotacoes` DISABLE KEYS */;
/*!40000 ALTER TABLE `cotacoes` ENABLE KEYS */;

-- Copiando estrutura para tabela database_portal.cotacoes_itens
CREATE TABLE IF NOT EXISTS `cotacoes_itens` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `valor_un` varchar(20) DEFAULT NULL,
  `item_ref` int(11) DEFAULT NULL,
  `descricao_modelo` text DEFAULT NULL,
  PRIMARY KEY (`cod`),
  KEY `FK_cotacoes_itens_item_pedido` (`item_ref`),
  CONSTRAINT `FK_cotacoes_itens_item_pedido` FOREIGN KEY (`item_ref`) REFERENCES `item_pedido` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.cotacoes_itens: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cotacoes_itens` DISABLE KEYS */;
/*!40000 ALTER TABLE `cotacoes_itens` ENABLE KEYS */;

-- Copiando estrutura para tabela database_portal.documento_empresa_privada
CREATE TABLE IF NOT EXISTS `documento_empresa_privada` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` int(11) DEFAULT NULL,
  `cnpj` char(14) DEFAULT NULL,
  `data_upload` datetime DEFAULT NULL,
  `descricao_doc` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cod`),
  KEY `FK__documento_tipo` (`tipo`),
  KEY `FK__empresa_privada` (`cnpj`),
  CONSTRAINT `FK__documento_tipo` FOREIGN KEY (`tipo`) REFERENCES `documento_tipo` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK__empresa_privada` FOREIGN KEY (`cnpj`) REFERENCES `empresa_privada` (`cnpj`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.documento_empresa_privada: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `documento_empresa_privada` DISABLE KEYS */;
/*!40000 ALTER TABLE `documento_empresa_privada` ENABLE KEYS */;

-- Copiando estrutura para tabela database_portal.documento_tipo
CREATE TABLE IF NOT EXISTS `documento_tipo` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.documento_tipo: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `documento_tipo` DISABLE KEYS */;
INSERT INTO `documento_tipo` (`cod`, `descricao`) VALUES
	(1, 'Cartão da Cadastro Nacional da Pessoa Jurídica (CNPJ)'),
	(2, 'Certidão Conjunta Negativa de Débito referente a Tributos Federais e Dívida Ativa da União'),
	(4, 'Certidão Negativa de Débitos Tributários Não Inscritos na Dívida Ativa do Estado'),
	(5, 'Certidão Negativa de Débitos referentes a Tributos Mobiliários'),
	(6, 'Certidão negativa de Débitos Trabalhistas'),
	(7, 'Certificado de Regularidade do FGTS - CRF'),
	(8, 'Outro documento');
/*!40000 ALTER TABLE `documento_tipo` ENABLE KEYS */;

-- Copiando estrutura para tabela database_portal.empresa_privada
CREATE TABLE IF NOT EXISTS `empresa_privada` (
  `cnpj` char(14) NOT NULL,
  `razao_social` varchar(150) DEFAULT NULL,
  `nome_fantasia` varchar(150) DEFAULT NULL,
  `efr` varchar(50) DEFAULT NULL,
  `telefone` varchar(30) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `natureza` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cnpj`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.empresa_privada: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `empresa_privada` DISABLE KEYS */;
INSERT INTO `empresa_privada` (`cnpj`, `razao_social`, `nome_fantasia`, `efr`, `telefone`, `email`, `natureza`) VALUES
	('04911191000102', 'XEROGRAFIA INFORMATICA LTDA', 'XEROGRAFIA COPIADORAS E INFORMATICA', 'NA', '(19) 3869-7047', 'sac@xerografia.com.br', '206-2 - Sociedade Empresária Limitada'),
	('08914106000102', 'C. A. GASPAR INFORMATICA', 'ASM INFO', 'NA', '(11) 4012-7937/ (11) 4012-7124', 'beraldocontabil@bjpnet.com.br', '213-5 - Empresário (Individual)'),
	('10176707000107', 'TATIANA VENTICINCO CARTUCHOS', 'H9 CARTUCHOS', 'NA', '(11) 3402-0599/ (11) 9484-7736', 'vetor.org@vetorcontabil.com', '213-5 - Empresário (Individual)'),
	('24846428000118', 'ATHOMOZ - COMERCIO DE PRODUTOS ELETRONICOS - EIRELI', 'NA', 'NA', '(19) 3441-8946', 'financeiro@athomoz.com.br', '230-5 - Empresa Individual de Responsabilidade Limitada (de Natureza Empresária)'),
	('25072293000143', 'JHONATAN TABAJARA DE OLIVEIRA 39628061801', 'PROTEGIDOS', 'NA', '(11) 95554-6146', 'jhonatanjt.9@gmail.com', '213-5 - Empresário (Individual)'),
	('72381189000110', 'DELL COMPUTADORES DO BRASIL LTDA', 'NA', 'NA', '(51) 3274-5500', 'br_tax@dell.com', '206-2 - Sociedade Empresária Limitada');
/*!40000 ALTER TABLE `empresa_privada` ENABLE KEYS */;

-- Copiando estrutura para tabela database_portal.endereco_empresa_privada
CREATE TABLE IF NOT EXISTS `endereco_empresa_privada` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `logradouro` varchar(100) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `bairro` varchar(80) DEFAULT NULL,
  `cep` char(8) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `uf` char(2) DEFAULT NULL,
  `cnpj` char(14) DEFAULT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cod`),
  KEY `FK_endereco_empresa_privada-empresa_privada` (`cnpj`),
  CONSTRAINT `FK_endereco_empresa_privada-empresa_privada` FOREIGN KEY (`cnpj`) REFERENCES `empresa_privada` (`cnpj`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.endereco_empresa_privada: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `endereco_empresa_privada` DISABLE KEYS */;
INSERT INTO `endereco_empresa_privada` (`cod`, `logradouro`, `numero`, `bairro`, `cep`, `cidade`, `uf`, `cnpj`, `descricao`) VALUES
	(1, 'AV INDUSTRIAL BELGRAF', '400', 'INDUSTRIAL', '92990000', 'ELDORADO DO SUL', 'RS', '72381189000110', NULL),
	(5, 'RUA INDEPENDENCIA', '10', 'VILA SAO JOAO', '13480739', 'LIMEIRA', 'SP', '24846428000118', NULL),
	(6, 'R CEARA', '298', 'PARQUE MONTE VERDE', '13274090', 'VALINHOS', 'SP', '04911191000102', NULL),
	(7, 'AVENIDA SAO JOAO', '610', 'CENTRO', '12940260', 'ATIBAIA', 'SP', '10176707000107', NULL),
	(8, 'AV SAO JOAO', '235', 'CIDADE NOVA', '12955000', 'BOM JESUS DOS PERDOES', 'SP', '08914106000102', NULL),
	(9, 'R CAPELA DO DIVINO', '40', 'MASCATE', '12960000', 'NAZARE PAULISTA', 'SP', '25072293000143', NULL);
/*!40000 ALTER TABLE `endereco_empresa_privada` ENABLE KEYS */;

-- Copiando estrutura para tabela database_portal.endereco_instituicao_publica
CREATE TABLE IF NOT EXISTS `endereco_instituicao_publica` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `logradouro` varchar(100) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `bairro` varchar(80) DEFAULT NULL,
  `cep` char(8) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `uf` char(2) DEFAULT NULL,
  `cnpj` char(14) DEFAULT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cod`),
  KEY `FK_endereco_instituicao_publica-instituicao_publica` (`cnpj`),
  CONSTRAINT `FK_endereco_instituicao_publica-instituicao_publica` FOREIGN KEY (`cnpj`) REFERENCES `instituicao_publica` (`cnpj`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.endereco_instituicao_publica: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `endereco_instituicao_publica` DISABLE KEYS */;
INSERT INTO `endereco_instituicao_publica` (`cod`, `logradouro`, `numero`, `bairro`, `cep`, `cidade`, `uf`, `cnpj`, `descricao`) VALUES
	(1, 'RUA DOM DUARTE LEOPOLDO', '83', 'CENTRO', '12955000', 'BOM JESUS DOS PERDOES', 'SP', '52359692000162', NULL),
	(2, 'AV SAUDADE', '252', 'NA', '12940560', 'ATIBAIA', 'SP', '45279635000108', NULL),
	(5, 'RUA SÃO GERALDO', '279', 'CENTRO', '12955000', 'BOM JESUS DOS PERDÕES', 'SP', '52359692000162', 'SECRETARIA DE SAÚDE'),
	(6, 'PRACA ANTONIO R DOS SANTOS', '16', 'NA', '12960000', 'NAZARE PAULISTA', 'SP', '45279643000154', NULL);
/*!40000 ALTER TABLE `endereco_instituicao_publica` ENABLE KEYS */;

-- Copiando estrutura para tabela database_portal.instituicao_publica
CREATE TABLE IF NOT EXISTS `instituicao_publica` (
  `cnpj` char(14) NOT NULL,
  `razao_social` varchar(150) DEFAULT NULL,
  `nome_fantasia` varchar(150) DEFAULT NULL,
  `efr` varchar(50) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `natureza` varchar(80) DEFAULT NULL,
  `telefone` varchar(30) DEFAULT NULL,
  `status_cadastro` int(11) DEFAULT NULL,
  PRIMARY KEY (`cnpj`),
  KEY `FK_instituicao_publica-status-cadastro` (`status_cadastro`),
  CONSTRAINT `FK_instituicao_publica-status-cadastro` FOREIGN KEY (`status_cadastro`) REFERENCES `status_cadastro` (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.instituicao_publica: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `instituicao_publica` DISABLE KEYS */;
INSERT INTO `instituicao_publica` (`cnpj`, `razao_social`, `nome_fantasia`, `efr`, `email`, `natureza`, `telefone`, `status_cadastro`) VALUES
	('45279635000108', 'MUNICIPIO DE ATIBAIA', 'PREFEITURA DA ESTANCIA DE ATIBAIA', 'MUNICÍPIO DE ATIBAIA', 'cpd@prefeituradeatibaia.com.br', '124-4 - Município', '(11) 4413-0974', 3),
	('45279643000154', 'MUNICIPIO DE NAZARE PAULISTA', 'NAZARE PAULISTA GABINETE PREFEITO', 'NAZARE PAULISTA - SP', 'nazare@nazare.sp.gov.br', '124-4 - Município', '11 97875756', 3),
	('52359692000162', 'MUNICIPIO DE BOM JESUS DOS PERDOES', 'BOM JESUS DOS PERDOES GABINETE PREFEITO', 'BOM JESUS DOS PERDOES - SP', 'cpd@bjperdoes.sp.gov.br', '124-4 - Município', '(11) 997645981', 3);
/*!40000 ALTER TABLE `instituicao_publica` ENABLE KEYS */;

-- Copiando estrutura para tabela database_portal.item_pedido
CREATE TABLE IF NOT EXISTS `item_pedido` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `item` varchar(100) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `unidade` varchar(5) DEFAULT NULL,
  `pedido_cod` int(11) DEFAULT NULL,
  PRIMARY KEY (`cod`),
  KEY `FK_item_pedido-pedido` (`pedido_cod`),
  CONSTRAINT `FK_item_pedido-pedido` FOREIGN KEY (`pedido_cod`) REFERENCES `pedido` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.item_pedido: ~21 rows (aproximadamente)
/*!40000 ALTER TABLE `item_pedido` DISABLE KEYS */;
INSERT INTO `item_pedido` (`cod`, `item`, `descricao`, `quantidade`, `unidade`, `pedido_cod`) VALUES
	(11, 'CABO DE IMPRESSORA', 'CABOS DE IMPRESSORA USB Cabos de \r\nImpressora USB A macho x USB 2.0 de 3 metros', 25, 'un', 18),
	(12, 'CARTUCHO HP 662XL', 'CARTUCHO HP 662 XL - COLORIDO', 12, 'un', 18),
	(13, 'CARTUCHO HP 662XL', 'CARTUCHO HP 662 XL - PRETO', 12, 'un', 18),
	(14, 'SWITCH 24 PORTAS', 'Switch Gigabit de 24 portas 10/100/1000Mbps não\r\ngerenciáve', 10, 'un', 18),
	(15, 'SWITCH 8 PORTAS', 'Switch 8 Portas 10/100 Mbps não gerenciáve', 30, 'un', 18),
	(16, 'MEMÓRIA RAM DDR4@2666MHz', 'Memórias Adata XPG Flame de 8GB,\r\nCL15DDR4 e 2666Mhz', 30, 'un', 18),
	(17, 'PASTA TÉRMICA COM PRATA', 'Pasta térmica com prata 20g (bisnaga ou pote) ', 15, 'un', 18),
	(18, 'SCANNER', 'Scanners com as seguintes \r\nconfigurações: Digitalização Frente e Verso \r\n(Duplex), PDF Pesquisável, Velocidade de \r\nDigitalização: Até 50/100 ppm (simplex/duplex), \r\nSensor de Imagem: CIS Duplo, Resolução Óptica: \r\n600 x 600 dpi, Fonte de Alimentação Utilizada: \r\nmodo pronto = 4,17W / modo sleep = 2,9W / \r\ndigitalizando = 30W, Interface USB Direta, Interface \r\nPadrão: Ethernet Gigabit 10/100/1000', 20, 'un', 18),
	(19, 'CAIXA DE CABO UTP', 'Caixas de cabo UTP de 305m com as seguintes \r\ncaracterísticas: Azul, Bitola:Diâmetro nominal \r\n5.1mmImpedância: Resistência elétrica CC máxima \r\ndo condutor em 20ºC:93,8ohms/km; Impedância \r\nCaracterística Nom. de 1 MHz a 250 Mhz: 100 +ou15% ohms; Revestimento:PVC retardante a chama; \r\nCategoria: CAT.5e; Construção: U/UTP, 4 pares \r\ntrançados compostos de condutores sólidos de \r\ncobre nu, 24 AWG', 15, 'un', 18),
	(20, 'NOTEBOOKS', 'Notebook Intel Core i5 7º Geração, 8Gb Memória \r\nRAM DDR4, Disco Rígido de até 1TB (5400rpm), Tela \r\n15.6, 2 Conexões USB 2.0, 1 Conexão USB 3.0, 1 \r\nSaída HDMI com suporte HDCP, 1 Leitor de Cartão, 1 \r\nPorta de rede no padrão RJ-45 com Sistema \r\nOperacional Windows 10 Home, 64Bits em Português \r\n(Brasil)', 180, 'un', 18),
	(21, 'TONNER ES5112', 'TONNER PRETO COMPATÍVEL COM IMPRESSORA OKI ES5112 ', 20, 'un', 18),
	(22, 'ROTEADOR DUAL BAND', 'Roteador Dual Band (2.4GHz e 5GHz) compatível \r\ncom padrões IEEE 802.11ac/n/a e 802.11n/b/g, \r\ncom um total de até 1.2Gbps de largura de banda \r\ndisponível, com 4 ou mais antenas, 1 porta WAN e \r\n4 portas LAN;', 20, 'un', 18),
	(23, 'PLACA DE VÍDEO DEDICADA', 'Placas de Vídeo com as seguintes \r\nconfigurações: Memória: 4GB GDDR6; Dual \r\nFan; Largura de Interface: 128 bits; Entradas: \r\n1x DVI-D, 1x HDMI 2.0, 1x DisplayPort 1.4; \r\nVelocidade de memória: 12Gbps; Clock: \r\n1725Mhz;', 5, 'un', 18),
	(24, 'SSD SATA', ' SSD SATA 250GB, Leitura: 500MB/s, Gravação: \r\n350MB/s', 20, 'un', 18),
	(25, 'PEN-DRIVE DE 32GB', ' HD externo de 1tb de porta USB 3.0 Super Speed, \r\ncom as seguintes características: Cachê:64 MB; \r\nConexões: USB 3.0; Capacidade de \r\nArmazenamento:1TB; Velocidade de Transferência de \r\nDados:4,8GB/S; Conteúdo da Embalagem: HD \r\nExterno, Cabo USB 3.0 de 46 cm; Dimensões da \r\nembalagem - cm (AxLxP): 14,5x10x3cm;Dimensões do \r\nproduto - cm (AxLxP): 11,5x8x1,5cm; Peso liq. \r\naproximado do produto (K', 100, 'un', 18),
	(26, 'HD EXTERNO 1TB', ' HD externo de 1tb de porta USB 3.0 Super Speed, \r\ncom as seguintes características: Cachê:64 MB; \r\nConexões: USB 3.0; Capacidade de \r\nArmazenamento:1TB; Velocidade de Transferência de \r\nDados:4,8GB/S; Conteúdo da Embalagem: HD \r\nExterno, Cabo USB 3.0 de 46 cm; Dimensões da \r\nembalagem - cm (AxLxP): 14,5x10x3cm;Dimensões do \r\nproduto - cm (AxLxP): 11,5x8x1,5cm; Peso liq. \r\naproximado do produto (K', 50, 'un', 18);
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

-- Copiando dados para a tabela database_portal.login_empresa_privada: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `login_empresa_privada` DISABLE KEYS */;
INSERT INTO `login_empresa_privada` (`login`, `cnpj`, `senha`) VALUES
	('beraldocontabil@bjpnet.com.br', '08914106000102', '123'),
	('br_tax@dell.com', '72381189000110', '123'),
	('financeiro@athomoz.com.br', '24846428000118', '123'),
	('jhonatanjt.9@gmail.com', '25072293000143', '123'),
	('sac@xerografia.com.br', '04911191000102', '123'),
	('vetor.org@vetorcontabil.com', '10176707000107', '123');
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

-- Copiando dados para a tabela database_portal.login_instituicao_publica: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `login_instituicao_publica` DISABLE KEYS */;
INSERT INTO `login_instituicao_publica` (`login`, `cnpj`, `senha`) VALUES
	('cpd@bjperdoes.sp.gov.br', '52359692000162', '123'),
	('cpd@prefeituradeatibaia.com.br', '45279635000108', '123'),
	('nazare@nazare.sp.gov.br', '45279643000154', '123');
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

-- Copiando estrutura para tabela database_portal.notificacao_pedido
CREATE TABLE IF NOT EXISTS `notificacao_pedido` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `pedido` int(11) DEFAULT NULL,
  `empresa` char(14) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`cod`),
  KEY `FK_notificacao_pedido_empresa_privada` (`empresa`),
  KEY `FK_notificacao_pedido_pedido` (`pedido`),
  KEY `FK_notificacao_pedido_status_notificacao` (`status`),
  CONSTRAINT `FK_notificacao_pedido_empresa_privada` FOREIGN KEY (`empresa`) REFERENCES `empresa_privada` (`cnpj`),
  CONSTRAINT `FK_notificacao_pedido_pedido` FOREIGN KEY (`pedido`) REFERENCES `pedido` (`cod`),
  CONSTRAINT `FK_notificacao_pedido_status_notificacao` FOREIGN KEY (`status`) REFERENCES `status_notificacao` (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.notificacao_pedido: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `notificacao_pedido` DISABLE KEYS */;
/*!40000 ALTER TABLE `notificacao_pedido` ENABLE KEYS */;

-- Copiando estrutura para tabela database_portal.pedido
CREATE TABLE IF NOT EXISTS `pedido` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `data_abertura` datetime DEFAULT NULL,
  `data_fechamento` datetime DEFAULT NULL,
  `distancia` int(6) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `modo` int(11) DEFAULT NULL,
  `cnpj` char(14) DEFAULT NULL,
  `endereco_entrega` int(11) DEFAULT NULL,
  PRIMARY KEY (`cod`),
  KEY `FK_pedido-instituicao_publica` (`cnpj`),
  KEY `FK_pedido-modo_pedido` (`modo`),
  KEY `FK_pedido-status_pedido` (`status`),
  KEY `FK_pedido_endereco_instituicao_publica` (`endereco_entrega`),
  CONSTRAINT `FK_pedido-instituicao_publica` FOREIGN KEY (`cnpj`) REFERENCES `instituicao_publica` (`cnpj`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_pedido-modo_pedido` FOREIGN KEY (`modo`) REFERENCES `modo_pedido` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_pedido-status_pedido` FOREIGN KEY (`status`) REFERENCES `status_pedido` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_pedido_endereco_instituicao_publica` FOREIGN KEY (`endereco_entrega`) REFERENCES `endereco_instituicao_publica` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.pedido: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `pedido` DISABLE KEYS */;
INSERT INTO `pedido` (`cod`, `titulo`, `descricao`, `data_abertura`, `data_fechamento`, `distancia`, `status`, `modo`, `cnpj`, `endereco_entrega`) VALUES
	(18, 'AQUISIÇÃO DE EQUIPAMENTOS ESSENCIAIS INFORMÁTICA', 'Aquisição de Equipamentos Essenciais Trabalhos CPD de informáticas para \r\nvários setores e secretarias na prefeitura de Bom Jesus dos Perdões pelo Sistema \r\nRegistro de Preços:', '2021-11-14 23:42:44', NULL, 100, 1, 2, '52359692000162', 1);
/*!40000 ALTER TABLE `pedido` ENABLE KEYS */;

-- Copiando estrutura para tabela database_portal.status_cadastro
CREATE TABLE IF NOT EXISTS `status_cadastro` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(15) DEFAULT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.status_cadastro: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `status_cadastro` DISABLE KEYS */;
INSERT INTO `status_cadastro` (`cod`, `status`, `descricao`) VALUES
	(1, 'Solicitado', 'A solicitação foi realizada'),
	(2, 'Em análise', 'A solicitação de cadastro está sendo analisada!'),
	(3, 'Aprovado', 'A solicitação de cadastro foi aprovada!');
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.status_cadastro_hist: ~9 rows (aproximadamente)
/*!40000 ALTER TABLE `status_cadastro_hist` DISABLE KEYS */;
INSERT INTO `status_cadastro_hist` (`cod`, `cnpj`, `status`, `data`) VALUES
	(1, '52359692000162', 1, '2021-09-14 22:32:29'),
	(2, '52359692000162', 2, '2021-09-28 19:23:09'),
	(3, '52359692000162', 3, '2021-09-28 19:27:22'),
	(6, '45279635000108', 1, '2021-11-05 13:47:54'),
	(7, '45279635000108', 2, '2021-11-05 13:48:50'),
	(8, '45279635000108', 3, '2021-11-05 13:48:58'),
	(9, '45279643000154', 1, '2021-11-12 01:02:13'),
	(10, '45279643000154', 3, '2021-11-12 01:02:47');
/*!40000 ALTER TABLE `status_cadastro_hist` ENABLE KEYS */;

-- Copiando estrutura para tabela database_portal.status_notificacao
CREATE TABLE IF NOT EXISTS `status_notificacao` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.status_notificacao: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `status_notificacao` DISABLE KEYS */;
INSERT INTO `status_notificacao` (`cod`, `status`) VALUES
	(1, 'Enviado'),
	(2, 'Visto');
/*!40000 ALTER TABLE `status_notificacao` ENABLE KEYS */;

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
