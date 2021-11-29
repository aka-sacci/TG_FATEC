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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.anexos_cotacoes: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `anexos_cotacoes` DISABLE KEYS */;
INSERT INTO `anexos_cotacoes` (`cod`, `cotacao`, `descricao`) VALUES
	(1, 4, 'CATÁLOGO CARTUCHO PLOTTER'),
	(2, 6, 'catálogo SSD PATRIOT'),
	(3, 7, 'catalogo');
/*!40000 ALTER TABLE `anexos_cotacoes` ENABLE KEYS */;

-- Copiando estrutura para tabela database_portal.anexos_pedido
CREATE TABLE IF NOT EXISTS `anexos_pedido` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) DEFAULT NULL,
  `pedido` int(11) DEFAULT NULL,
  PRIMARY KEY (`cod`),
  KEY `FK__pedido` (`pedido`),
  CONSTRAINT `FK__pedido` FOREIGN KEY (`pedido`) REFERENCES `pedido` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.anexos_pedido: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `anexos_pedido` DISABLE KEYS */;
INSERT INTO `anexos_pedido` (`cod`, `descricao`, `pedido`) VALUES
	(2, 'anexo', 6);
/*!40000 ALTER TABLE `anexos_pedido` ENABLE KEYS */;

-- Copiando estrutura para tabela database_portal.categoria
CREATE TABLE IF NOT EXISTS `categoria` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.categoria: ~19 rows (aproximadamente)
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` (`cod`, `categoria`) VALUES
	(1, 'Itens de informática'),
	(2, 'Eletrônicos'),
	(3, 'Softwares'),
	(4, 'NA'),
	(6, 'Ferramentas'),
	(7, 'Impressoras'),
	(8, 'Manutenção de Impressoras'),
	(9, 'Cartuchos'),
	(10, 'Tintas'),
	(11, 'Máquinas de contrução'),
	(12, 'Insulmos médicos'),
	(13, 'Materiais de construção'),
	(14, 'Materias esportivos'),
	(15, 'Eletrodomésticos'),
	(17, 'Insulmos alimentícios'),
	(18, 'Itens de escritório'),
	(19, 'Móveis'),
	(20, 'Automóveis'),
	(21, 'Servidores (T.I)');
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
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.categoria_empresa_privada: ~41 rows (aproximadamente)
/*!40000 ALTER TABLE `categoria_empresa_privada` DISABLE KEYS */;
INSERT INTO `categoria_empresa_privada` (`cod`, `categoria`, `cnpj`) VALUES
	(11, 7, '04911191000102'),
	(12, 9, '04911191000102'),
	(16, 1, '08914106000102'),
	(17, 6, '08914106000102'),
	(18, 2, '08914106000102'),
	(19, 9, '08914106000102'),
	(20, 3, '25072293000143'),
	(24, 1, '24846428000118'),
	(25, 2, '24846428000118'),
	(29, 6, '17750569000177'),
	(30, 13, '17750569000177'),
	(31, 10, '17750569000177'),
	(32, 10, '05140584000114'),
	(33, 13, '05140584000114'),
	(34, 6, '05140584000114'),
	(36, 11, '03376962000138'),
	(37, 13, '03376962000138'),
	(38, 6, '03376962000138'),
	(39, 11, '16579679000155'),
	(40, 6, '16579679000155'),
	(41, 6, '12982965000106'),
	(42, 11, '12982965000106'),
	(43, 1, '11340562000109'),
	(44, 3, '11340562000109'),
	(45, 21, '11340562000109'),
	(46, 3, '57142978000458'),
	(47, 1, '00258246000168'),
	(48, 2, '00258246000168'),
	(49, 7, '00258246000168'),
	(50, 21, '00258246000168'),
	(51, 3, '00258246000168'),
	(52, 3, '10242721000161'),
	(53, 20, '25063214000138'),
	(54, 21, '56097645000149'),
	(55, 1, '56097645000149'),
	(60, 20, '10918425000138'),
	(61, 7, '10176707000107'),
	(62, 8, '10176707000107'),
	(63, 2, '10176707000107'),
	(64, 10, '28751831000114'),
	(65, 13, '28751831000114'),
	(69, 1, '72381189000110'),
	(70, 2, '72381189000110'),
	(71, 18, '71684377000406');
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.categoria_pedido: ~9 rows (aproximadamente)
/*!40000 ALTER TABLE `categoria_pedido` DISABLE KEYS */;
INSERT INTO `categoria_pedido` (`cod`, `pedido`, `categoria`) VALUES
	(1, 1, 2),
	(2, 1, 1),
	(3, 2, 10),
	(4, 2, 13),
	(5, 3, 2),
	(6, 3, 21),
	(7, 3, 1),
	(8, 4, 9),
	(9, 4, 7),
	(11, 6, 18);
/*!40000 ALTER TABLE `categoria_pedido` ENABLE KEYS */;

-- Copiando estrutura para tabela database_portal.cotacoes
CREATE TABLE IF NOT EXISTS `cotacoes` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `pedido` int(11) DEFAULT NULL,
  `empresa` char(14) DEFAULT NULL,
  `observacao` text DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  PRIMARY KEY (`cod`),
  KEY `FK_cotacoes_pedido` (`pedido`),
  KEY `FK_cotacoes_empresa_privada` (`empresa`),
  CONSTRAINT `FK_cotacoes_empresa_privada` FOREIGN KEY (`empresa`) REFERENCES `empresa_privada` (`cnpj`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_cotacoes_pedido` FOREIGN KEY (`pedido`) REFERENCES `pedido` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.cotacoes: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `cotacoes` DISABLE KEYS */;
INSERT INTO `cotacoes` (`cod`, `pedido`, `empresa`, `observacao`, `last_update`) VALUES
	(3, 2, '28751831000114', '', '2021-11-25 18:36:01'),
	(4, 4, '04911191000102', '', '2021-11-25 18:36:01'),
	(6, 3, '10176707000107', '', '2021-11-25 18:36:01'),
	(7, 6, '71684377000406', '', '2021-11-25 20:39:42');
/*!40000 ALTER TABLE `cotacoes` ENABLE KEYS */;

-- Copiando estrutura para tabela database_portal.cotacoes_itens
CREATE TABLE IF NOT EXISTS `cotacoes_itens` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `valor_un` varchar(30) DEFAULT NULL,
  `item_ref` int(11) DEFAULT NULL,
  `descricao_modelo` text DEFAULT NULL,
  `cotacao` int(11) DEFAULT NULL,
  PRIMARY KEY (`cod`),
  KEY `FK_cotacoes_itens_item_pedido` (`item_ref`),
  KEY `FK_cotacoes_itens_cotacoes` (`cotacao`),
  CONSTRAINT `FK_cotacoes_itens_cotacoes` FOREIGN KEY (`cotacao`) REFERENCES `cotacoes` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_cotacoes_itens_item_pedido` FOREIGN KEY (`item_ref`) REFERENCES `item_pedido` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.cotacoes_itens: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `cotacoes_itens` DISABLE KEYS */;
INSERT INTO `cotacoes_itens` (`cod`, `valor_un`, `item_ref`, `descricao_modelo`, `cotacao`) VALUES
	(7, '0.50', 8, 'COTACAO ITEM 1', 3),
	(8, '19.90', 7, 'COTACAO ITEM 2', 3),
	(9, '1.50', 6, 'COTAÇÃO ITEM 3', 3),
	(12, '4599.90', 16, 'Multifuncional A3 Bulk Original Brother Mfc-t4500dw T4500', 4),
	(13, '399.90', 15, 'CARTUCHO DE TINTA HP 711 compatível', 4),
	(24, '699.90', 11, 'SSD SATA PATRIOT 512GB', 6),
	(25, '299.90', 12, 'SSD SATA PATRIOT 256GB', 6),
	(26, '10.00', 19, 'Caneta Esferográfica BIC Cristal Original Dura Mais, Azul Ponta Média de 1.0mm, 835205 \r\nCANETA PRETA', 7),
	(27, '32.00', 18, 'Grampeador 20/6 20fl O-200 Easy Office', 7);
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.documento_empresa_privada: ~12 rows (aproximadamente)
/*!40000 ALTER TABLE `documento_empresa_privada` DISABLE KEYS */;
INSERT INTO `documento_empresa_privada` (`cod`, `tipo`, `cnpj`, `data_upload`, `descricao_doc`) VALUES
	(3, 1, '24846428000118', '2021-11-20 13:14:04', 'Meu CNPJ'),
	(4, 1, '24846428000118', '2021-11-20 13:14:17', 'Certidão de Negativa da União'),
	(5, 1, '17750569000177', '2021-11-22 13:39:15', 'FICHA CNPJ'),
	(6, 2, '17750569000177', '2021-11-22 13:41:43', 'CERTIDAO NEGATIVA UNIÃO'),
	(7, 1, '05140584000114', '2021-11-22 13:46:32', 'FICHA CNPJ'),
	(8, 2, '05140584000114', '2021-11-22 13:48:12', 'CERTIDAO NEGATIVA UNIÃO'),
	(9, 1, '28751831000114', '2021-11-22 13:56:06', 'FICHA CNPJ'),
	(10, 1, '03376962000138', '2021-11-22 14:02:18', 'FICHA CNPJ'),
	(11, 1, '16579679000155', '2021-11-22 14:09:35', 'FICHA CNPJ'),
	(12, 1, '00258246000168', '2021-11-22 15:16:47', 'Meu CNPJ'),
	(13, 1, '10242721000161', '2021-11-22 15:20:38', 'FICHA CNPJ'),
	(14, 1, '56097645000149', '2021-11-22 15:26:38', 'cnpj'),
	(16, 1, '71684377000406', '2021-11-25 20:37:41', 'CNPJ');
/*!40000 ALTER TABLE `documento_empresa_privada` ENABLE KEYS */;

-- Copiando estrutura para tabela database_portal.documento_tipo
CREATE TABLE IF NOT EXISTS `documento_tipo` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.documento_tipo: ~7 rows (aproximadamente)
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

-- Copiando dados para a tabela database_portal.empresa_privada: ~19 rows (aproximadamente)
/*!40000 ALTER TABLE `empresa_privada` DISABLE KEYS */;
INSERT INTO `empresa_privada` (`cnpj`, `razao_social`, `nome_fantasia`, `efr`, `telefone`, `email`, `natureza`) VALUES
	('00258246000168', 'SOLO NETWORK BRASIL S.A.', 'SOLO NETWORK', 'NA', '(41) 3051-7521', 'financeiro@solonetwork.com.br', '205-4 - Sociedade Anônima Fechada'),
	('03376962000138', 'JM TRANSMORAES COMERCIO DE MATERIAIS DE CONSTRUCAO LTDA', 'NA', 'NA', '(11) 4411-1633/ (11) 4402-7656', 'jmtransmoraes@hotmail.com', '206-2 - Sociedade Empresária Limitada'),
	('04911191000102', 'XEROGRAFIA INFORMATICA LTDA', 'XEROGRAFIA COPIADORAS E INFORMATICA', 'NA', '(19) 3869-7047', 'sac@xerografia.com.br', '206-2 - Sociedade Empresária Limitada'),
	('05140584000114', 'DEPOSITO DO ANDRE MATERIAIS PARA CONSTRUCAO LTDA', 'NA', 'NA', '(11) 4295-0202', 'admcuiabadeposito@gmail.com', '206-2 - Sociedade Empresária Limitada'),
	('08914106000102', 'C. A. GASPAR INFORMATICA', 'ASM INFO', 'NA', '(11) 4012-7937/ (11) 4012-7124', 'beraldocontabil@bjpnet.com.br', '213-5 - Empresário (Individual)'),
	('10176707000107', 'TATIANA VENTICINCO CARTUCHOS', 'H9 CARTUCHOS', 'NA', '(11) 3402-0599/ (11) 9484-7736', 'vetor.org@vetorcontabil.com', '213-5 - Empresário (Individual)'),
	('10242721000161', 'BUYSOFT DO BRASIL LTDA', 'BUYSOFT', 'NA', '(44) 3041-8888/ (44) 3220-3300', 'administrativo@buysoft.com.br', '206-2 - Sociedade Empresária Limitada'),
	('10918425000138', 'VOLVO CAR BRASIL IMPORTACAO E COMERCIO DE VEICULOS LTDA.', 'VOLVO CAR BRASIL', 'NA', '(11) 4174-5678/ (11) 4174-8746', 'maria.silva@volvocars.com', '206-2 - Sociedade Empresária Limitada'),
	('11340562000109', 'SOFTWARE.COM.BR INFORMATICA LTDA', 'NA', 'NA', '(11) 3665-8550 / (11) 2143-443', 'financeiro@software.com.br', '206-2 - Sociedade Empresária Limitada'),
	('12982965000106', 'CASA DO SERRALHEIRO LTDA', 'CASA DO SERRALHEIRO', 'NA', '(27) 3226-8045 / (27) 3343-033', 'brendo@casaserralheiro.com.br', '206-2 - Sociedade Empresária Limitada'),
	('16579679000155', 'ATIBAIA MAQUINAS E FERRAMENTAS LTDA', 'ATIBAIA MAQUINAS E FERRAMENTAS', 'NA', '(11) 4412-1662', 'dep.legal@contabildoni.com.br', '206-2 - Sociedade Empresária Limitada'),
	('17750569000177', 'MOREIRA MATERIAIS PARA CONSTRUCAO EIRELI', 'NA', 'NA', '(11) 4597-4139/ (11) 4597-1378', 'jm-pinheiro@uol.com.br', '230-5 - Empresa Individual de Responsabilidade Limitada (de Natureza Empresária)'),
	('24846428000118', 'ATHOMOZ - COMERCIO DE PRODUTOS ELETRONICOS - EIRELI', 'NA', 'NA', '(19) 3441-8946', 'financeiro@athomoz.com.br', '230-5 - Empresa Individual de Responsabilidade Limitada (de Natureza Empresária)'),
	('25063214000138', 'INFORPRO SERVIDORES LTDA', 'NA', 'NA', '(15) 3281-4991', 'contato@inforpro.com', '206-2 - Sociedade Empresária Limitada'),
	('25072293000143', 'JHONATAN TABAJARA DE OLIVEIRA 39628061801', 'PROTEGIDOS', 'NA', '(11) 95554-6146', 'jhonatanjt.9@gmail.com', '213-5 - Empresário (Individual)'),
	('28751831000114', 'BARBOSA E MENDES MATERIAIS PARA CONSTRUCAO LTDA', 'DEPOSITO DOIS IRMAOS', 'NA', '(11) 4597-4139', 'jm-pinheiro123@uol.com.br', '206-2 - Sociedade Empresária Limitada'),
	('56097645000149', 'MW MICROWARE COMERCIO DE INFORMATICA LTDA', 'MW', 'NA', '(11) 9567-7029', 'contato@mwmicroware.com.br', '206-2 - Sociedade Empresária Limitada'),
	('57142978000458', 'BRASOFTWARE INFORMATICA LTDA', 'BRASOFTWARE INFORMATICA LTDA', 'NA', '(11) 3179-6700 / (11) 3179-699', 'contabilidade@brasoftware.com.br', '206-2 - Sociedade Empresária Limitada'),
	('71684377000406', 'LOJAS GLOBAL ATIBAIA LTDA', 'PAPELARIA GLOBAL', 'NA', '(11) 4411-1833 / (11) 3402-808', 'contabil@escritoriothomaz.com.br', '206-2 - Sociedade Empresária Limitada'),
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
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.endereco_empresa_privada: ~23 rows (aproximadamente)
/*!40000 ALTER TABLE `endereco_empresa_privada` DISABLE KEYS */;
INSERT INTO `endereco_empresa_privada` (`cod`, `logradouro`, `numero`, `bairro`, `cep`, `cidade`, `uf`, `cnpj`, `descricao`) VALUES
	(1, 'AV INDUSTRIAL BELGRAF', '400', 'INDUSTRIAL', '92990000', 'ELDORADO DO SUL', 'RS', '72381189000110', NULL),
	(5, 'RUA INDEPENDENCIA', '10', 'VILA SAO JOAO', '13480739', 'LIMEIRA', 'SP', '24846428000118', NULL),
	(6, 'R CEARA', '298', 'PARQUE MONTE VERDE', '13274090', 'VALINHOS', 'SP', '04911191000102', NULL),
	(7, 'AVENIDA SAO JOAO', '610', 'CENTRO', '12940260', 'ATIBAIA', 'SP', '10176707000107', NULL),
	(8, 'AV SAO JOAO', '235', 'CIDADE NOVA', '12955000', 'BOM JESUS DOS PERDOES', 'SP', '08914106000102', NULL),
	(9, 'R CAPELA DO DIVINO', '40', 'MASCATE', '12960000', 'NAZARE PAULISTA', 'SP', '25072293000143', NULL),
	(17, 'AV JOAQUIM AVELINO PINHEIRO', '1165', 'VICENTE NUNES', '12960000', 'NAZARE PAULISTA', 'SP', '17750569000177', NULL),
	(18, 'R. Augusto Mariano', '210', 'Jardim Sao Paulo', '12950000', 'Bom Jesus dos Perdões', 'SP', '17750569000177', 'Filial em Bom Jesus dos Perdões'),
	(19, 'R. Clemente de Almeida Passos', '529', 'Mascate', '12960000', 'Nazaré Paulista', 'SP', '17750569000177', 'Loja 2 Nazaré PTA'),
	(20, 'ESTM JOAO FABIANO BARBOSA', '3628', 'CUIABA', '12960000', 'NAZARE PAULISTA', 'SP', '05140584000114', NULL),
	(21, 'ESTRADA MUNICIPAL GALDINO FABIANO', 'S/N', 'CUIABA', '12960000', 'NAZARE PAULISTA', 'SP', '28751831000114', NULL),
	(22, 'AV JERONIMO DE CAMARGO', '2040', 'LOTEAMENTO LOANDA', '12945206', 'ATIBAIA', 'SP', '03376962000138', NULL),
	(23, 'RUA GUARACI', '560', 'PARQUE DAS NACOES', '12944410', 'ATIBAIA', 'SP', '16579679000155', NULL),
	(24, 'AVENIDA MARIO GURGEL', '3671', 'CAMPO GRANDE', '29146012', 'CARIACICA', 'ES', '12982965000106', NULL),
	(25, 'AVENIDA FRANCISCO MATARAZZO', '404', 'AGUA BRANCA', '05001000', 'SAO PAULO', 'SP', '11340562000109', NULL),
	(26, 'RUA GEORGE OHM', '230', 'CIDADE MONCOES', '04576020', 'SAO PAULO', 'SP', '57142978000458', NULL),
	(27, 'ROD JOAO LEOPOLDO JACOMEL', '12162', 'CENTRO', '83323410', 'PINHAIS', 'PR', '00258246000168', NULL),
	(28, 'Av. das Nações Unidas', '12901', 'ITAIM BIBI', '04795100', 'SÃO PAULO', 'SP', '00258246000168', 'FILIAL EM SP'),
	(29, 'Av. Francisco Sá', '1000', 'Gutierrez', '30441018', 'BELO HORIZONTE', 'MG', '00258246000168', 'FILIAL MG'),
	(30, 'AV ADVOGADO HORACIO RACCANELLO FILHO', '5145', 'ZONA 07', '87020035', 'MARINGA', 'PR', '10242721000161', NULL),
	(31, 'AV IRENO DA SILVA VENANCIO', '199', 'PROTESTANTES', '18111100', 'VOTORANTIM', 'SP', '25063214000138', NULL),
	(32, 'R VOLUNTARIOS DA PATRIA', '4857', 'SANTANA', '02401400', 'SAO PAULO', 'SP', '56097645000149', NULL),
	(33, 'R SURUBIM', '577', 'CIDADE MONCOES', '04571050', 'SAO PAULO', 'SP', '10918425000138', NULL),
	(39, 'RUA JOSE ALVIM', '189', 'CENTRO', '12940750', 'ATIBAIA', 'SP', '71684377000406', NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.endereco_instituicao_publica: ~16 rows (aproximadamente)
/*!40000 ALTER TABLE `endereco_instituicao_publica` DISABLE KEYS */;
INSERT INTO `endereco_instituicao_publica` (`cod`, `logradouro`, `numero`, `bairro`, `cep`, `cidade`, `uf`, `cnpj`, `descricao`) VALUES
	(1, 'RUA DOM DUARTE LEOPOLDO', '83', 'CENTRO', '12955000', 'BOM JESUS DOS PERDOES', 'SP', '52359692000162', NULL),
	(5, 'RUA SÃO GERALDO', '279', 'CENTRO', '12955000', 'BOM JESUS DOS PERDÕES', 'SP', '52359692000162', 'SECRETARIA DE SAÚDE'),
	(6, 'PRACA ANTONIO R DOS SANTOS', '16', 'NA', '12960000', 'NAZARE PAULISTA', 'SP', '45279643000154', NULL),
	(11, 'AVDA ANTONIO PIRES PIMENTEL', '2015', 'B SANTO AGOSTINHO', '12900011', 'BRAGANCA PAULISTA', 'SP', '46352746000165', NULL),
	(12, 'R CRUZEIRO DO SUL', '225', 'CENTRO', '12995000', 'PINHALZINHO', 'SP', '45623600000144', NULL),
	(13, 'AV ANCHIETA', '200', 'CENTRO', '13015904', 'CAMPINAS', 'SP', '51885242000140', NULL),
	(14, 'AV REPUBLICA', '530', 'CENTRO', '07500000', 'SANTA ISABEL', 'SP', '56900848000121', NULL),
	(15, 'Av. Ruy Rodriguez', '3900', 'Recanto do Sol II', '13060192', 'Campinas', 'SP', '51885242000140', 'Sub Prefeitura de Ouro Verde'),
	(16, 'Rua Natale Bertucci', '1', 'Parque Valenca I', '13058525', 'Campinas', 'SP', '51885242000140', 'Sub Prefeitura Do Campo Grande'),
	(17, 'Rua Luiz Vicentin', '177', 'Jardim Santa Genebra', '13084754', 'Campinas', 'SP', '51885242000140', 'Sub Prefeitura de Barão Geraldo'),
	(18, 'Av. Cardeal Dom Agnello Rossi', '532', 'Conj. Hab. Padre Anchieta', '13068211', 'Campinas', 'SP', '51885242000140', 'Sub Prefeitura de Nova Aparecida'),
	(19, 'R. Maneco Rosa', '52', 'Sousas', '13106000', 'Campinas', 'SP', '51885242000140', 'Subprefeitura Do Distrito De Sousas'),
	(20, 'R. José Inácio', '14', 'Joaquim Egídio', '13108006', 'Campinas', 'SP', '51885242000140', 'Subprefeitura de Joaquim Egídio'),
	(21, 'Tv. da Liberdade', 's/n', 'Jardim Santa Rita de Cassia', '12914060', 'Bragança Paulista', 'SP', '46352746000165', 'Secretaria Municipal de Educação'),
	(28, 'AV CULA MANGABEIRA', '211', 'STO EXPEDITO', '39401002', 'MONTES CLAROS', 'MG', '22678874000135', NULL),
	(30, 'AV SAUDADE', '252', 'NA', '12940560', 'ATIBAIA', 'SP', '45279635000108', NULL);
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

-- Copiando dados para a tabela database_portal.instituicao_publica: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `instituicao_publica` DISABLE KEYS */;
INSERT INTO `instituicao_publica` (`cnpj`, `razao_social`, `nome_fantasia`, `efr`, `email`, `natureza`, `telefone`, `status_cadastro`) VALUES
	('22678874000135', 'MUNICIPIO DE MONTES CLAROS', 'MONTES CLAROS PREFEITURA GABINETE PREFEITO', 'MUNICÍPIO DE MONTES CLAROS', 'compras@montesclaros.mg.gov.br', '124-4 - Município', '(38) 3215-7693', 3),
	('45279635000108', 'MUNICIPIO DE ATIBAIA', 'PREFEITURA DA ESTANCIA DE ATIBAIA', 'MUNICÍPIO DE ATIBAIA', 'compras@prefeituradeatibaia.com.br', '124-4 - Município', '11 997645981', 3),
	('45279643000154', 'MUNICIPIO DE NAZARE PAULISTA', 'NAZARE PAULISTA GABINETE PREFEITO', 'NAZARE PAULISTA - SP', 'nazare@nazare.sp.gov.br', '124-4 - Município', '11 97875756', 3),
	('45623600000144', 'MUNICIPIO DE PINHALZINHO', 'NA', 'MUNICÍPIO DE PINHALZINHO', 'contato@pinhalzinho.sp.gov.br', '124-4 - Município', '11 4589 7997', 3),
	('46352746000165', 'MUNICIPIO DE BRAGANCA PAULISTA', 'NA', 'MUNICÍPIO DE BRAGANCA PAULISTA', 'falecom@braganca.sp.gov.br', '124-4 - Município', '(11) 95554-6146', 3),
	('51885242000140', 'MUNICIPIO DE CAMPINAS', 'PREFEITURA MUNICIPAL DE CAMPINAS', 'MUNICÍPIO DE CAMPINAS', 'sac@campinas.sp.gov.br', '124-4 - Município', '11 4578 8745', 3),
	('52359692000162', 'MUNICIPIO DE BOM JESUS DOS PERDOES', 'BOM JESUS DOS PERDOES GABINETE PREFEITO', 'MUNICÍPIO DE BOM JESUS DOS PERDOES', 'cpd@bjperdoes.sp.gov.br', '124-4 - Município', '(11) 997645981', 3),
	('56900848000121', 'MUNICIPIO DE SANTA ISABEL', 'PREFEITURA DE SANTA ISABEL', 'MUNICÍPIO DE SANTA ISABEL', 'contabilidade@santaisabel.sp.br', '124-4 - Município', '(11) 4656-8700', 3);
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.item_pedido: ~17 rows (aproximadamente)
/*!40000 ALTER TABLE `item_pedido` DISABLE KEYS */;
INSERT INTO `item_pedido` (`cod`, `item`, `descricao`, `quantidade`, `unidade`, `pedido_cod`) VALUES
	(1, 'CABO EXTENSOR DE REDE RJ45 (PATCH CORD)', '- CABO COM NO MÍNIMO 2 METROS DE\r\nCOMPRIMENTO.', 1200, 'un', 1),
	(2, 'CABO EXTENSOR USB MACHO-MACHO', '- CABO COM NO MÍNIMO 2 METROS DE\r\nCOMPRIMENTO.\r\n- COMPATIBILIDADE MÍNIMA USB 2.0.', 1200, 'un', 1),
	(3, 'SISTEMA PARA VÍDEO CONFERÊNCIA CORPORATIVO', '- SISTEMA MODULAR OU ALL-IN-ONE;\r\n- O SISTEMA DEVERÁ SE CONECTAR COM O\r\nCOMPUTADOR ATRAVÉS DE SOMENTE UM CABO\r\nUSB;\r\n- ENTENDE-SE POR SISTEMA MODULAR\r\nEQUIPAMENTOS DA MESMA FABRICANTE, MARCA E\r\nMODELO, UNIDOS AO CONSOLE CENTRAL POR\r\nFIOS, E CONECTADOS AO COMPUTADOR ATRAVÉS\r\nDO CONSOLE CENTRAL UTILIZANDO SOMENTE UM\r\nCABO USB;\r\n- CONEXÃO COM PC VIA UM ÚNICO CABO USB\r\nPLUG-AND-PLAY COM NO MÍNIMO 2 (DOIS)\r\nMETROS', 900, 'un', 1),
	(4, 'ROTEADOR WI-FI', '- TENSÃO 127V;\r\n- POSSUIR NO MÍNIMO 1 (UMA) PORTA WAN E 3\r\nPORTAS LAN;\r\n- OPERAR EM FREQUÊNCIA MÍNIMA DE 2,4 GHZ\r\nNOS PADRÕES WIRELESS IEEE 802.11B, IEEE\r\n802.11G, IEEE 802.11N;\r\n- VELOCIDADE DO WI-FI DE NO MÍNIMO 300MBPS;\r\n- PROTOCOLOS DE SEGURANÇA DE WIRELESS WEB\r\nDE 64/128 BITS, WPA/PSK/WPA2-PSK, FILTRAGEM\r\nMAC WIRELESS;\r\n- CONTROLE DE ACESSO: CONTROLE DOS PAIS,\r\nGERENCIAMENTO DE CONTROLE LOCAL', 900, 'un', 1),
	(5, 'ESTABILIZADOR ELETRÔNICO 500VA', '- MONOVOLT 127V OU BIVOLT 127V/220V.\r\n- POTÊNCIA NOMINAL DE 300W OU 500VA.\r\n- NO MÍNIMO QUATRO TOMADAS DE SAÍDA\r\nPADRÃO NBR14136\r\n- TOMADA DE 10A PADRÃO TRIPOLAR, COM CABO\r\nDE NO MÍNIMO 1M.\r\n- FREQUÊNCIA DE 60HZ.\r\n- CHAVE LIGA E DESLIGA COM LED INDICADOR DE\r\nFUNCIONAMENTO.\r\n- PORTA FUSÍVEL EXTERNO COM 1 UNIDADE\r\nRESERVA DE 10A.\r\n- DEVERÁ ACOMPANHAR UM ADAPTADOR DE\r\nTOMADA PARA 3 PINOS CHATOS.', 900, 'un', 1),
	(6, 'ITEM TESTE 3', 'DESCRIÇÃO DO ITEM TESTE 3', 2400, 'mt', 2),
	(7, 'ITEM TESTE 2', 'DESCRIÇÃO DO ITEM TESTE 2', 1200, 'un', 2),
	(8, 'ITEM TESTE 1', 'DESCRIÇÃO DO ITEM TESTE 1', 2600, 'lt', 2),
	(9, 'CABO HDMI', 'Cabos HDMI de 2 metros', 25, 'un', 3),
	(10, 'EXTENSÃO', 'Extensões com filtro de linha de 4 tomadas com padrão 10A', 20, 'un', 3),
	(11, 'SSD SATA 500GB', 'SSD SATA 250GB, Leitura: 500MB/s, Gravação: 350MB/s;\r\n', 50, 'un', 3),
	(12, 'SSD SATA 250GB', 'SSD SATA 500GB, Leitura: 500MB/s, Gravação: 350MB/s; 2.5POL', 40, 'un', 3),
	(13, 'PEN DRIVE 32GB', 'Pen drive de 32gb de USB 3.0 com as seguintes características: Leitura:40MB/s; Gravação:10MB/s;Dimensões:60x21,2x10mm; Temperatura de Operação:0°C a 60°C; Temperatura de Armazenamento: - 20°C a 85°C; Compatibilidade Dupla:Conectividade com USB 3.0 e compatível com a versão anterior do USB 2.0; Compatibilidade:Windows 8/ 7 / Vista / XP / Mac OS X v.1', 100, 'un', 3),
	(14, 'HD EXTERNO 1TB', 'HD externo de 1tb de porta USB 3.0 Super Speed, com as seguintes características: Cachê:64 MB; Conexões:USB 3.0; Capacidade de Armazenamento:1TB; Velocidade de Transferência de Dados:4,8GB/S; Conteúdo da Embalagem: HD Externo, Cabo USB 3.0 de 46 cm; Dimensões da embalagem - cm (AxLxP): 14,5x10x3cm;Dimensões do produto - cm (AxLxP): 11,5x8x1,5cm; Peso liq. aproximado do produto (Kg):170g; Material/Composição:Plástico; Peso da embalagem c/ produto (kg):260g', 50, 'un', 3),
	(15, 'CARTUCHO PLOTTER', 'CARTUCHO DE TINTA HP 711 CZ133A PRETO | PLOTTER T120 T520 T130 CQ891A CQ890A CQ893A | ORIGINAL 80ML', 30, 'un', 4),
	(16, 'IMPRESSORA BULK INK', 'Tipo de impressora Jato de tinta Cabeça de impressão Mono Piezo com 420 bocais x 1 Cor Piezo com 420 bicos x 3 Capacidade de memória 128 MB LCD (visor de cristal líquido) * 1 Ecrã LCD táctil a cores de 2,7 pol. (67,5 mm) Fonte de energia CA 100 a 120 V 50/60 Hz (Taiwan)', 30, 'un', 4),
	(18, 'GRAMPEADOR', 'Grampeador de 20cm;\r\n', 500, 'un', 6),
	(19, 'CANETA AZUL', 'Caneta esferográfica azul com corpo transparente;', 1200, 'un', 6);
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

-- Copiando dados para a tabela database_portal.login_empresa_privada: ~19 rows (aproximadamente)
/*!40000 ALTER TABLE `login_empresa_privada` DISABLE KEYS */;
INSERT INTO `login_empresa_privada` (`login`, `cnpj`, `senha`) VALUES
	('admcuiabadeposito@gmail.com', '05140584000114', '123'),
	('administrativo@buysoft.com.br', '10242721000161', '123'),
	('beraldocontabil@bjpnet.com.br', '08914106000102', '123'),
	('brendo@casaserralheiro.com.br', '12982965000106', '123'),
	('br_tax@dell.com', '72381189000110', '123'),
	('contabil@escritoriothomaz.com.br', '71684377000406', '123'),
	('contabilidade@brasoftware.com.br', '57142978000458', '123'),
	('contato@inforpro.com', '25063214000138', '123'),
	('contato@mwmicroware.com.br', '56097645000149', '123'),
	('dep.legal@contabildoni.com.br', '16579679000155', '123'),
	('financeiro@athomoz.com.br', '24846428000118', '123'),
	('financeiro@software.com.br', '11340562000109', '123'),
	('financeiro@solonetwork.com.br', '00258246000168', '123'),
	('jhonatanjt.9@gmail.com', '25072293000143', '123'),
	('jm-pinheiro123@uol.com.br', '28751831000114', '123'),
	('jm-pinheiro@uol.com.br', '17750569000177', '123'),
	('jmtransmoraes@hotmail.com', '03376962000138', '123'),
	('maria.silva@volvocars.com', '10918425000138', '123'),
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

-- Copiando dados para a tabela database_portal.login_instituicao_publica: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `login_instituicao_publica` DISABLE KEYS */;
INSERT INTO `login_instituicao_publica` (`login`, `cnpj`, `senha`) VALUES
	('compras@montesclaros.mg.gov.br', '22678874000135', '123'),
	('compras@prefeituradeatibaia.com.br', '45279635000108', '123'),
	('contabilidade@santaisabel.sp.br', '56900848000121', '123'),
	('contato@pinhalzinho.sp.gov.br', '45623600000144', '123'),
	('cpd@bjperdoes.sp.gov.br', '52359692000162', '123'),
	('falecom@braganca.sp.gov.br', '46352746000165', '123'),
	('nazare@nazare.sp.gov.br', '45279643000154', '123'),
	('sac@campinas.sp.gov.br', '51885242000140', '123');
/*!40000 ALTER TABLE `login_instituicao_publica` ENABLE KEYS */;

-- Copiando estrutura para tabela database_portal.mensagem
CREATE TABLE IF NOT EXISTS `mensagem` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(70) DEFAULT NULL,
  `mensagem` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`cod`),
  KEY `FK_mensagem_status_notificacao` (`status`),
  CONSTRAINT `FK_mensagem_status_notificacao` FOREIGN KEY (`status`) REFERENCES `status_notificacao` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.mensagem: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `mensagem` DISABLE KEYS */;
INSERT INTO `mensagem` (`cod`, `nome`, `email`, `mensagem`, `status`) VALUES
	(1, 'Lucas', 'saccilucas@gmail.com', 'Site muito bom!', 1),
	(2, 'Lucas Sacci', 'saccilucas@gmail.com', 'Olá! Ótimo portal!', 1);
/*!40000 ALTER TABLE `mensagem` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.notificacao_pedido: ~17 rows (aproximadamente)
/*!40000 ALTER TABLE `notificacao_pedido` DISABLE KEYS */;
INSERT INTO `notificacao_pedido` (`cod`, `pedido`, `empresa`, `status`) VALUES
	(1, 1, '00258246000168', 2),
	(2, 1, '08914106000102', 1),
	(3, 1, '11340562000109', 1),
	(4, 1, '24846428000118', 1),
	(5, 1, '56097645000149', 1),
	(6, 2, '03376962000138', 1),
	(7, 2, '05140584000114', 1),
	(8, 2, '17750569000177', 1),
	(9, 3, '08914106000102', 1),
	(10, 3, '10176707000107', 1),
	(11, 3, '11340562000109', 1),
	(12, 3, '56097645000149', 1),
	(13, 4, '00258246000168', 1),
	(14, 4, '04911191000102', 2),
	(15, 4, '08914106000102', 1),
	(16, 4, '10176707000107', 1);
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.pedido: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `pedido` DISABLE KEYS */;
INSERT INTO `pedido` (`cod`, `titulo`, `descricao`, `data_abertura`, `data_fechamento`, `distancia`, `status`, `modo`, `cnpj`, `endereco_entrega`) VALUES
	(1, 'Registro de Preços de itens de informática', 'Pregão nº 076/2021 - Eletrônico - Processo Administrativo: PMC.2020.00056837-29 - Interessado: Secretaria Municipal de Educação - Objeto: Registro de Preços de itens de informática - Recebimento das Propostas dos itens 01 a 08: das 08h do dia 26/11/2', '2021-11-22 15:40:17', NULL, 100, 1, 2, '51885242000140', 13),
	(2, 'AQUISIÇÃO DE ITENS TESTE', 'Pedido aberto para fins de teste', '2021-11-23 23:20:08', NULL, 0, 1, 1, '22678874000135', 28),
	(3, 'AQUISIÇÃO DE ITENS DE INFORMÁTICA', 'COMPRA DE ITENS ESSENCIAIS DE INFORMÁTICA', '2021-11-24 23:23:23', NULL, 100, 1, 2, '52359692000162', 1),
	(4, 'COMPRA DE NOVAS IMPRESSORAS', 'AQUISIÇÃO DE IMPRESSORAS NOVAS E PEÇAS DE REPOSIÇÃO', '2021-11-24 23:28:13', NULL, 200, 2, 1, '52359692000162', 1),
	(6, 'AQUISIÇÃO DE MATERIAS DE ESCRITÓRIO', 'Este pedido tem como objetivo a compra dos materias de escritório descritos abaixo', '2021-11-25 20:33:05', '2021-11-25 20:43:19', 50, 2, 1, '45279635000108', 30);
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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela database_portal.status_cadastro_hist: ~22 rows (aproximadamente)
/*!40000 ALTER TABLE `status_cadastro_hist` DISABLE KEYS */;
INSERT INTO `status_cadastro_hist` (`cod`, `cnpj`, `status`, `data`) VALUES
	(1, '52359692000162', 1, '2021-09-14 22:32:29'),
	(2, '52359692000162', 2, '2021-09-28 19:23:09'),
	(3, '52359692000162', 3, '2021-09-28 19:27:22'),
	(9, '45279643000154', 1, '2021-11-12 01:02:13'),
	(10, '45279643000154', 3, '2021-11-12 01:02:47'),
	(11, '46352746000165', 1, '2021-11-22 10:15:48'),
	(12, '46352746000165', 2, '2021-11-22 10:17:09'),
	(13, '46352746000165', 3, '2021-11-22 10:17:18'),
	(14, '45623600000144', 1, '2021-11-22 12:44:00'),
	(15, '51885242000140', 1, '2021-11-22 12:46:18'),
	(16, '56900848000121', 1, '2021-11-22 12:48:21'),
	(17, '45623600000144', 2, '2021-11-22 13:00:44'),
	(18, '51885242000140', 2, '2021-11-22 13:00:47'),
	(19, '56900848000121', 2, '2021-11-22 13:00:49'),
	(20, '56900848000121', 3, '2021-11-22 13:00:51'),
	(21, '51885242000140', 3, '2021-11-22 13:00:54'),
	(22, '45623600000144', 3, '2021-11-22 13:00:56'),
	(25, '22678874000135', 1, '2021-11-23 23:08:34'),
	(26, '22678874000135', 2, '2021-11-23 23:10:49'),
	(30, '45279635000108', 1, '2021-11-25 20:27:48'),
	(31, '45279635000108', 2, '2021-11-25 20:28:34'),
	(32, '45279635000108', 3, '2021-11-25 20:28:47');
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
