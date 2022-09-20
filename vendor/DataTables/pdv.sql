-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: pdv
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `caixa`
--

DROP TABLE IF EXISTS `caixa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caixa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_ab` date NOT NULL,
  `hora_ab` time NOT NULL,
  `valor_ab` decimal(8,2) NOT NULL,
  `gerente_ab` int(11) NOT NULL,
  `data_fec` date DEFAULT NULL,
  `hora_fec` time DEFAULT NULL,
  `valor_fec` decimal(8,2) DEFAULT NULL,
  `valor_vendido` decimal(8,2) DEFAULT NULL,
  `valor_quebra` decimal(8,2) DEFAULT NULL,
  `gerente_fec` int(11) DEFAULT NULL,
  `caixa` int(11) NOT NULL,
  `operador` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `valor_sangrias` decimal(8,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caixa`
--

LOCK TABLES `caixa` WRITE;
/*!40000 ALTER TABLE `caixa` DISABLE KEYS */;
INSERT INTO `caixa` VALUES (20,'2022-04-09','21:48:56',200.00,21,'2022-04-09','23:44:34',4476.44,4276.44,0.00,21,3,31,'Fechado',0.00),(49,'2022-04-24','22:01:52',0.00,27,'2022-04-24','22:04:16',75.90,75.90,0.00,27,1,31,'Fechado',0.00),(50,'2022-04-26','21:48:09',0.00,27,'2022-04-26','22:52:12',1.35,1.35,0.00,27,1,31,'Fechado',0.00),(51,'2022-04-27','23:14:16',50.00,27,'2022-04-27','23:17:44',54.05,4.05,0.00,27,1,31,'Fechado',0.00),(52,'2022-04-28','15:32:00',0.00,27,'2022-04-28','15:34:08',148.50,148.50,0.00,27,1,31,'Fechado',0.00),(53,'2022-04-28','19:44:08',0.00,27,'2022-04-28','19:47:07',151.20,151.20,0.00,27,1,31,'Fechado',0.00),(54,'2022-05-01','15:31:04',0.00,27,'2022-05-05','21:07:35',160.95,160.95,0.00,27,1,31,'Fechado',0.00),(55,'2022-05-05','21:08:45',0.00,27,'2022-05-06','21:48:08',6.90,6.90,0.00,27,1,31,'Fechado',0.00),(56,'2022-05-06','21:48:20',50.00,27,'2022-05-06','21:53:44',922.00,972.00,0.00,27,1,31,'Fechado',100.00),(58,'2022-05-06','22:00:53',100.00,27,'2022-05-06','22:06:04',-135.00,65.00,0.00,27,2,31,'Fechado',300.00),(59,'2022-05-07','18:49:56',100.00,22,'2022-05-07','18:52:55',764.25,764.25,0.00,27,1,31,'Fechado',100.00),(60,'2022-05-07','18:53:12',100.00,27,'2022-05-07','19:30:35',613.00,513.00,0.00,27,1,31,'Fechado',0.00),(61,'2022-05-07','19:30:50',50.00,27,'2022-05-07','19:33:01',609.05,559.05,0.00,27,1,31,'Fechado',0.00),(62,'2022-05-07','19:33:19',100.00,27,'2022-05-07','19:35:06',736.30,636.30,0.00,27,1,31,'Fechado',0.00),(63,'2022-05-07','19:35:49',100.00,22,'2022-05-07','19:37:44',673.00,673.00,0.00,27,2,31,'Fechado',100.00),(65,'2022-05-07','19:50:04',100.00,27,'2022-05-07','19:52:46',953.25,953.25,0.00,27,3,31,'Fechado',100.00),(67,'2022-05-07','19:58:08',0.00,27,'2022-05-07','20:01:24',70.35,170.35,0.00,27,2,31,'Fechado',100.00),(68,'2022-05-07','20:13:10',0.00,27,'2022-05-07','20:16:25',14070.75,14170.75,0.00,27,4,31,'Fechado',100.00),(69,'2022-05-07','20:41:45',100.00,27,'2022-05-07','20:43:34',301.45,301.45,0.00,27,1,31,'Fechado',100.00),(70,'2022-05-07','20:59:25',50.00,22,'2022-05-07','21:02:11',1784.50,1784.50,0.00,27,1,31,'Fechado',50.00),(71,'2022-05-07','21:15:04',0.00,27,'2022-05-07','21:16:46',3052.35,3052.35,0.00,27,1,34,'Fechado',0.00),(72,'2022-05-08','10:18:27',0.00,27,'2022-05-08','10:19:46',179.60,179.60,0.00,27,1,34,'Fechado',0.00),(73,'2022-05-08','10:29:08',0.00,27,'2022-05-08','10:32:05',840.00,840.00,0.00,27,1,34,'Fechado',0.00),(75,'2022-05-08','11:19:10',0.00,27,'2022-05-08','11:20:54',351.75,351.75,0.00,27,2,31,'Fechado',0.00),(76,'2022-05-10','21:47:36',2.00,27,'2022-05-10','21:54:20',1575.00,1573.00,0.00,27,2,31,'Fechado',0.00),(77,'2022-05-11','20:39:57',100.00,27,'2022-05-11','20:41:47',125.75,125.75,0.00,27,3,31,'Fechado',100.00),(78,'2022-05-12','00:31:10',0.00,27,'2022-05-12','09:19:44',34.20,134.20,0.00,27,2,31,'Fechado',100.00),(79,'2022-05-12','12:49:42',0.00,27,'2022-05-12','12:51:43',141.75,141.75,0.00,27,1,31,'Fechado',0.00),(80,'2022-05-12','13:46:29',0.00,27,'2022-05-12','13:48:30',141.75,141.75,0.00,27,1,31,'Fechado',0.00),(81,'2022-05-12','19:37:35',0.00,27,'2022-05-12','19:45:40',81.00,81.00,0.00,27,1,31,'Fechado',0.00),(82,'2022-05-13','12:08:26',0.00,27,'2022-05-13','12:20:33',141.75,141.75,0.00,27,1,31,'Fechado',0.00),(83,'2022-05-28','11:05:23',100.00,27,'2022-05-28','11:10:19',125.20,125.20,0.00,27,1,31,'Fechado',100.00),(84,'2022-05-28','11:12:01',50.00,27,'2022-05-28','11:14:15',61.10,61.10,0.00,27,2,31,'Fechado',50.00),(85,'2022-05-28','11:37:01',0.00,27,'2022-05-28','11:39:21',138.20,138.20,0.00,27,3,31,'Fechado',0.00),(86,'2022-05-28','11:41:53',100.00,27,'2022-05-28','11:43:56',0.00,0.00,0.00,27,1,31,'Fechado',100.00),(87,'2022-05-28','11:55:41',0.00,27,'2022-05-28','11:58:17',260.00,260.00,0.00,27,1,31,'Fechado',0.00),(88,'2022-05-29','17:21:27',0.00,27,'2022-05-29','17:23:14',28.60,28.60,0.00,27,2,31,'Fechado',0.00),(89,'2022-05-29','17:29:41',0.00,22,'2022-05-29','17:36:15',28.60,28.60,0.00,22,1,31,'Fechado',0.00),(90,'2022-05-29','17:42:00',0.00,27,'2022-05-29','18:16:58',0.00,0.00,0.00,27,1,31,'Fechado',0.00),(91,'2022-05-29','18:29:05',0.00,27,'2022-05-29','18:42:19',32.50,32.50,0.00,27,1,31,'Fechado',0.00),(92,'2022-06-01','18:54:47',0.00,27,'2022-06-01','18:56:26',28.60,28.60,0.00,27,1,31,'Fechado',0.00),(93,'2022-06-02','22:42:35',50.00,27,'2022-06-02','22:45:31',328.20,328.20,0.00,27,1,31,'Fechado',50.00),(94,'2022-06-04','16:32:15',0.00,27,'2022-06-04','16:38:31',648.00,648.00,0.00,27,1,31,'Fechado',0.00),(95,'2022-06-04','16:38:47',0.00,27,'2022-06-04','16:39:20',0.00,0.00,0.00,27,1,31,'Fechado',0.00),(96,'2022-06-04','16:41:15',50.00,27,'2022-06-04','16:43:51',399.00,399.00,0.00,27,2,31,'Fechado',50.00),(97,'2022-06-04','20:00:12',0.00,27,'2022-06-04','20:07:29',269.88,269.88,0.00,27,1,31,'Fechado',0.00),(98,'2022-06-04','20:26:12',0.00,27,'2022-06-04','20:29:11',8400.00,8400.00,0.00,27,1,31,'Fechado',0.00),(99,'2022-06-11','10:24:52',50.00,27,'2022-06-11','10:30:22',2264.60,2214.60,0.00,27,1,31,'Fechado',0.00),(100,'2022-08-03','19:41:44',40.00,27,'2022-08-03','19:47:44',977.10,977.10,0.00,27,4,31,'Fechado',40.00),(101,'2022-08-18','23:41:13',0.00,27,'2022-08-18','23:50:17',2734.20,2734.20,0.00,27,1,31,'Fechado',0.00);
/*!40000 ALTER TABLE `caixa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caixas`
--

DROP TABLE IF EXISTS `caixas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caixas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caixas`
--

LOCK TABLES `caixas` WRITE;
/*!40000 ALTER TABLE `caixas` DISABLE KEYS */;
INSERT INTO `caixas` VALUES (1,'Caixa 1'),(2,'Caixa 2'),(3,'Caixa 3'),(4,'Caixa 4'),(5,'Caixa 5');
/*!40000 ALTER TABLE `caixas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `foto` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (9,'Material Basico','09-04-2022-20-49-23-categoria_material_basico.jpg'),(10,'Ferragem','09-04-2022-20-48-15-Categoria_ferragem.jpg'),(11,'Tintas','09-04-2022-20-57-09-categoria_tintas.jpg'),(12,'Madeireira','10-04-2022-14-44-54-categoria_madeireira.jpg'),(13,'Bricolagem e Ferramentas','10-04-2022-14-45-27-categoria_bricolagem.jpg'),(14,'Portas e Janelas','10-04-2022-14-48-20-categoria_portas_eJanelas.jpg'),(15,'Esquadria de Aluninio','10-04-2022-14-48-59-categoria_esquadria_aluminio.jpg'),(16,'Tubo e Conexoes','11-04-2022-22-02-29-tubo.jpg'),(17,'Pisos e Azulejos','06-05-2022-21-39-31-pisos_azulej.jpg');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compras`
--

DROP TABLE IF EXISTS `compras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `total` decimal(8,2) NOT NULL,
  `data` date NOT NULL,
  `usuario` int(11) NOT NULL,
  `fornecedor` int(11) NOT NULL,
  `pago` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compras`
--

LOCK TABLES `compras` WRITE;
/*!40000 ALTER TABLE `compras` DISABLE KEYS */;
INSERT INTO `compras` VALUES (12,36000.00,'2022-04-09',21,5,'Não'),(14,20000.00,'2022-04-10',21,5,'Não'),(15,20000.00,'2022-04-10',21,5,'Não'),(16,3850.00,'2022-04-10',21,5,'Não'),(17,8640.00,'2022-04-10',21,5,'Não'),(18,1000.00,'2022-04-10',21,5,'Não'),(19,12000.00,'2022-04-10',21,5,'Não'),(20,625.00,'2022-04-10',21,5,'Não'),(21,1100.00,'2022-04-10',21,7,'Não'),(22,1200.00,'2022-04-11',21,5,'Sim'),(23,1500.00,'2022-04-11',21,5,'Sim'),(24,5000.00,'2022-04-11',21,8,'Sim'),(25,3600.00,'2022-04-11',21,5,'Sim'),(26,2250.00,'2022-05-06',21,8,'Sim'),(27,6000.00,'2022-05-06',21,7,'Sim'),(28,2500.00,'2022-05-06',21,8,'Sim'),(30,1500.00,'2022-05-06',21,7,'Sim'),(31,1500.00,'2022-05-06',21,7,'Sim'),(32,1500.00,'2022-05-06',21,7,'Sim'),(33,1500.00,'2022-05-06',21,7,'Sim'),(34,1500.00,'2022-05-06',21,7,'Sim'),(35,1500.00,'2022-05-06',21,7,'Sim'),(36,500.00,'2022-05-06',21,5,'Sim'),(37,2000.00,'2022-05-07',21,9,'Sim'),(38,1760.00,'2022-05-07',21,9,'Sim'),(39,1760.00,'2022-05-07',21,9,'Sim'),(40,1650.00,'2022-05-07',21,5,'Sim'),(41,1800.00,'2022-05-07',21,5,'Sim'),(42,200.00,'2022-05-07',21,8,'Sim'),(43,1500.00,'2022-05-07',21,8,'Sim'),(44,2200.00,'2022-05-07',21,5,'Sim'),(45,0.00,'2022-05-08',21,5,'Sim'),(47,800.00,'2022-05-28',35,8,'Sim'),(48,2400.00,'2022-06-02',21,10,'Sim'),(49,3000.00,'2022-06-11',21,9,'Sim');
/*!40000 ALTER TABLE `compras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contas_pagar`
--

DROP TABLE IF EXISTS `contas_pagar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contas_pagar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) DEFAULT NULL,
  `valor` decimal(8,2) NOT NULL,
  `usuario` int(11) NOT NULL,
  `pago` varchar(5) NOT NULL,
  `data` date NOT NULL,
  `vencimento` date NOT NULL,
  `arquivo` varchar(150) DEFAULT NULL,
  `id_compra` int(11) NOT NULL,
  `data_pgto` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contas_pagar`
--

LOCK TABLES `contas_pagar` WRITE;
/*!40000 ALTER TABLE `contas_pagar` DISABLE KEYS */;
INSERT INTO `contas_pagar` VALUES (40,'Compra de Produtos',2250.00,21,'Sim','2022-05-06','2022-05-06','sem-foto.jpg',26,'2022-05-07'),(41,'Compra de Produtos',6000.00,21,'Sim','2022-05-06','2022-05-06','sem-foto.jpg',27,'2022-05-12'),(42,'Compra de Produtos',2500.00,21,'Sim','2022-05-06','2022-05-06','sem-foto.jpg',28,'2022-06-04'),(44,'Compra de Produtos',1500.00,21,'Sim','2022-05-06','2022-05-06','sem-foto.jpg',30,'2022-05-12'),(45,'Compra de Produtos',1500.00,21,'Sim','2022-05-06','2022-05-06','sem-foto.jpg',31,'2022-06-04'),(46,'Compra de Produtos',1500.00,21,'Sim','2022-05-06','2022-05-06','sem-foto.jpg',32,'2022-07-08'),(47,'Compra de Produtos',1500.00,21,'Sim','2022-05-06','2022-05-06','sem-foto.jpg',33,'2022-07-08'),(48,'Compra de Produtos',1500.00,21,'Sim','2022-05-06','2022-05-06','sem-foto.jpg',34,'2022-07-08'),(49,'Compra de Produtos',1500.00,21,'Sim','2022-05-06','2022-05-06','sem-foto.jpg',35,'2022-05-06'),(50,'Compra de Produtos',500.00,21,'Sim','2022-05-06','2022-05-06','sem-foto.jpg',36,'2022-05-06'),(51,'Compra de Produtos',2000.00,21,'Sim','2022-05-07','2022-05-07','sem-foto.jpg',37,'2022-07-08'),(52,'Compra de Produtos',1760.00,21,'Sim','2022-05-07','2022-05-07','sem-foto.jpg',38,'2022-07-08'),(53,'Compra de Produtos',1760.00,21,'Sim','2022-05-07','2022-05-07','sem-foto.jpg',39,'2022-05-07'),(54,'Compra de Produtos',1650.00,21,'Sim','2022-05-07','2022-05-07','sem-foto.jpg',40,'2022-05-07'),(55,'Compra de Produtos',1800.00,21,'Sim','2022-05-07','2022-05-07','sem-foto.jpg',41,'2022-05-07'),(56,'Compra de Produtos',200.00,21,'Sim','2022-05-07','2022-05-07','sem-foto.jpg',42,'2022-05-07'),(57,'Compra de Produtos',1500.00,21,'Sim','2022-05-07','2022-05-07','sem-foto.jpg',43,'2022-05-07'),(58,'Compra de Produtos',2200.00,21,'Sim','2022-05-07','2022-05-07','sem-foto.jpg',44,'2022-05-28'),(59,'Compra de Produtos',0.00,21,'Sim','2022-05-08','2022-05-08','sem-foto.jpg',45,'2022-05-08'),(61,'Compra de Produtos',800.00,21,'Sim','2022-05-28','2022-05-28','sem-foto.jpg',47,'2022-06-04'),(62,'Compra de Produtos',2400.00,21,'Sim','2022-06-02','2022-06-02','sem-foto.jpg',48,'2022-06-02'),(63,'Compra de Produtos',3000.00,21,'Sim','2022-06-11','2022-06-11','sem-foto.jpg',49,'2022-07-08');
/*!40000 ALTER TABLE `contas_pagar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contas_receber`
--

DROP TABLE IF EXISTS `contas_receber`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contas_receber` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `usuario` int(11) NOT NULL,
  `pago` varchar(5) NOT NULL,
  `data` date NOT NULL,
  `vencimento` date NOT NULL,
  `arquivo` varchar(100) DEFAULT NULL,
  `data_pgto` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contas_receber`
--

LOCK TABLES `contas_receber` WRITE;
/*!40000 ALTER TABLE `contas_receber` DISABLE KEYS */;
INSERT INTO `contas_receber` VALUES (15,'Promissora 000205',30.00,21,'Sim','2022-04-27','2022-05-06','sem-foto.jpg','2022-05-07'),(16,'Receita do dia',2500.00,21,'Sim','2022-05-07','2022-05-07','sem-foto.jpg','2022-05-07'),(17,'Receita fechamento 07/05/2022',21073.00,21,'Sim','2022-05-07','2022-05-07','sem-foto.jpg','2022-05-07'),(18,'Período da Apuração 11/05/2022 Total de Vendas R$ ',125.00,21,'Sim','2022-05-12','2022-05-12','12-05-2022-13-09-07-vendas11052222.pdf','2022-05-12'),(19,'Recebimento de boletos',10000.00,21,'Sim','2022-05-12','2022-05-12','12-05-2022-13-11-32-comprovante.pdf','2022-05-12'),(20,'Receita02052022',1.32,21,'Sim','2022-06-04','2022-06-04','04-06-2022-20-22-29-vendas02052022.pdf','2022-06-04'),(21,'Receita02052022_final',8400.00,36,'Sim','2022-06-04','2022-06-04','sem-foto.jpg','2022-06-04'),(22,'faturamento mes',11260.00,21,'Sim','2022-07-08','2022-07-08','sem-foto.jpg','2022-07-08');
/*!40000 ALTER TABLE `contas_receber` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forma_pgtos`
--

DROP TABLE IF EXISTS `forma_pgtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forma_pgtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forma_pgtos`
--

LOCK TABLES `forma_pgtos` WRITE;
/*!40000 ALTER TABLE `forma_pgtos` DISABLE KEYS */;
INSERT INTO `forma_pgtos` VALUES (1,1,'Dinheiro'),(2,2,'Cartão de Crédito'),(3,3,'Cartão de Débito'),(4,4,'Pix');
/*!40000 ALTER TABLE `forma_pgtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fornecedores`
--

DROP TABLE IF EXISTS `fornecedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fornecedores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `tipo_pessoa` varchar(10) NOT NULL,
  `cpf` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `endereco` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fornecedores`
--

LOCK TABLES `fornecedores` WRITE;
/*!40000 ALTER TABLE `fornecedores` DISABLE KEYS */;
INSERT INTO `fornecedores` VALUES (5,'Bloco Jardim','Júridica','48868860000161','pereiravenancio@hotmail.com','(11) 96246-2369','Rua Artur Azevedo'),(6,'Lazuril Tintas','Física','0000000000000','Lazuril@gmail.com','(11) 96246-2369','Rua Artur Azevedo'),(7,'Madereira Madealves','Júridica','0005556666666','madealves@gmail.com','(11) 96246-2369','Rodovia Raposo Tavares 5000'),(8,'Tigre do Brasil','Júridica','000.000.000-00','pereiravenancio@hotmail','(11) 96246-2369','Rua Artur Azevedo'),(9,'Gerdau do Brazil','Júridica','5415490666101','gerdau@outlook.com','(11) 98514-7777','Avenida inocencio Serafico 600'),(10,'Otto Bougart','Júridica','555555555555','otogarta@gmail.com','(22) 22222-2222','rua 19');
/*!40000 ALTER TABLE `fornecedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `itens_venda`
--

DROP TABLE IF EXISTS `itens_venda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `itens_venda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produto` int(11) NOT NULL,
  `valor_unitario` decimal(8,2) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor_total` decimal(8,2) NOT NULL,
  `usuario` int(11) NOT NULL,
  `venda` int(11) NOT NULL,
  `data` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=579 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `itens_venda`
--

LOCK TABLES `itens_venda` WRITE;
/*!40000 ALTER TABLE `itens_venda` DISABLE KEYS */;
INSERT INTO `itens_venda` VALUES (403,12,2.52,1,2.52,31,193,'2022-04-09'),(444,11,4.20,1,4.20,31,224,'2022-04-24'),(445,11,4.20,1,4.20,31,224,'2022-04-24'),(446,12,1.35,50,67.50,31,224,'2022-04-24'),(447,12,1.35,1,1.35,31,225,'2022-04-26'),(448,12,1.35,3,4.05,31,226,'2022-04-27'),(449,13,148.50,1,148.50,31,227,'2022-04-28'),(450,13,148.50,1,148.50,31,228,'2022-04-28'),(451,12,1.35,1,1.35,31,228,'2022-04-28'),(452,12,1.35,1,1.35,31,228,'2022-04-28'),(453,12,1.35,1,1.35,31,229,'2022-05-01'),(454,12,1.35,1,1.35,31,229,'2022-05-05'),(455,12,1.35,1,1.35,31,229,'2022-05-05'),(456,13,148.50,1,148.50,31,229,'2022-05-05'),(457,11,4.20,1,4.20,31,229,'2022-05-05'),(458,11,4.20,1,4.20,31,229,'2022-05-05'),(459,12,1.35,1,1.35,31,230,'2022-05-05'),(460,11,4.20,1,4.20,31,230,'2022-05-05'),(461,12,1.35,1,1.35,31,230,'2022-05-05'),(462,21,81.00,10,810.00,31,231,'2022-05-06'),(463,21,81.00,2,162.00,31,232,'2022-05-06'),(464,16,0.00,6,0.00,31,233,'2022-05-06'),(465,16,65.00,1,65.00,31,233,'2022-05-06'),(466,21,81.00,5,405.00,31,234,'2022-05-07'),(467,22,60.75,5,303.75,31,234,'2022-05-07'),(468,11,4.20,10,42.00,31,234,'2022-05-07'),(469,12,1.35,10,13.50,31,234,'2022-05-07'),(470,21,81.00,4,324.00,31,235,'2022-05-07'),(471,12,1.35,50,67.50,31,235,'2022-05-07'),(472,22,60.75,2,121.50,31,235,'2022-05-07'),(473,21,81.00,1,81.00,31,236,'2022-05-07'),(474,22,60.75,3,182.25,31,236,'2022-05-07'),(475,18,70.00,3,210.00,31,236,'2022-05-07'),(476,23,28.60,3,85.80,31,236,'2022-05-07'),(477,21,81.00,3,243.00,31,237,'2022-05-07'),(478,25,32.50,3,97.50,31,237,'2022-05-07'),(479,24,28.60,3,85.80,31,237,'2022-05-07'),(480,18,70.00,3,210.00,31,237,'2022-05-07'),(481,26,156.00,1,156.00,31,238,'2022-05-07'),(482,26,156.00,2,312.00,31,238,'2022-05-07'),(483,25,32.50,2,65.00,31,238,'2022-05-07'),(484,18,70.00,2,140.00,31,238,'2022-05-07'),(485,21,81.00,1,81.00,31,239,'2022-05-07'),(486,22,60.75,3,182.25,31,239,'2022-05-07'),(487,12,1.35,100,135.00,31,239,'2022-05-07'),(488,12,1.35,100,135.00,31,239,'2022-05-07'),(489,11,4.20,100,420.00,31,239,'2022-05-07'),(490,22,60.75,1,60.75,31,240,'2022-05-07'),(491,21,81.00,1,81.00,31,240,'2022-05-07'),(492,23,28.60,1,28.60,31,240,'2022-05-07'),(493,22,60.75,1,60.75,31,241,'2022-05-07'),(494,12,1.35,200,270.00,31,241,'2022-05-07'),(495,11,4.20,200,840.00,31,241,'2022-05-07'),(496,16,65.00,200,13000.00,31,241,'2022-05-07'),(497,21,81.00,1,81.00,31,242,'2022-05-07'),(498,22,60.75,1,60.75,31,242,'2022-05-07'),(499,18,70.00,1,70.00,31,242,'2022-05-07'),(500,23,28.60,1,28.60,31,242,'2022-05-07'),(501,24,28.60,1,28.60,31,242,'2022-05-07'),(502,25,32.50,1,32.50,31,242,'2022-05-07'),(503,21,81.00,1,81.00,31,243,'2022-05-07'),(504,21,81.00,10,810.00,31,243,'2022-05-07'),(505,22,60.75,10,607.50,31,243,'2022-05-07'),(506,24,28.60,10,286.00,31,243,'2022-05-07'),(507,21,81.00,1,81.00,34,244,'2022-05-07'),(508,12,1.35,1,1.35,34,244,'2022-05-07'),(509,13,148.50,10,1485.00,34,244,'2022-05-07'),(510,13,148.50,10,1485.00,34,244,'2022-05-07'),(511,21,81.00,1,81.00,34,245,'2022-05-08'),(512,18,70.00,1,70.00,34,245,'2022-05-08'),(513,23,28.60,1,28.60,34,245,'2022-05-08'),(514,11,4.20,200,840.00,34,246,'2022-05-08'),(516,30,0.00,1,0.00,34,246,'2022-05-08'),(517,21,81.00,1,81.00,31,247,'2022-05-08'),(518,22,60.75,1,60.75,31,247,'2022-05-08'),(519,11,4.20,50,210.00,31,247,'2022-05-08'),(520,27,143.00,11,1573.00,31,248,'2022-05-10'),(521,16,65.00,1,65.00,31,249,'2022-05-11'),(522,22,60.75,1,60.75,31,249,'2022-05-11'),(523,11,4.20,1,4.20,31,250,'2022-05-12'),(524,16,65.00,1,65.00,31,250,'2022-05-12'),(525,16,65.00,1,65.00,31,250,'2022-05-12'),(526,21,81.00,1,81.00,31,251,'2022-05-12'),(527,22,60.75,1,60.75,31,251,'2022-05-12'),(528,30,0.00,1,0.00,31,251,'2022-05-12'),(529,21,81.00,1,81.00,31,252,'2022-05-12'),(530,22,60.75,1,60.75,31,252,'2022-05-12'),(531,30,0.00,1,0.00,31,252,'2022-05-12'),(532,21,81.00,1,81.00,31,253,'2022-05-12'),(533,21,81.00,1,81.00,21,0,'2022-05-13'),(534,22,60.75,1,60.75,21,0,'2022-05-13'),(535,21,81.00,1,81.00,31,254,'2022-05-13'),(536,22,60.75,1,60.75,31,254,'2022-05-13'),(537,12,1.35,1,1.35,31,255,'2022-05-28'),(538,11,4.20,1,4.20,31,255,'2022-05-28'),(539,12,1.35,1,1.35,31,255,'2022-05-28'),(540,23,28.60,1,28.60,31,255,'2022-05-28'),(541,23,28.60,1,28.60,31,255,'2022-05-28'),(542,24,28.60,1,28.60,31,255,'2022-05-28'),(543,25,32.50,1,32.50,31,255,'2022-05-28'),(544,23,28.60,1,28.60,31,256,'2022-05-28'),(545,25,32.50,1,32.50,31,256,'2022-05-28'),(546,23,28.60,1,28.60,31,257,'2022-05-28'),(547,23,28.60,1,28.60,31,257,'2022-05-28'),(548,21,81.00,1,81.00,31,257,'2022-05-28'),(551,31,130.00,1,130.00,31,258,'2022-05-28'),(552,23,28.60,1,28.60,31,260,'2022-05-29'),(554,24,28.60,1,28.60,31,261,'2022-05-29'),(555,25,32.50,1,32.50,31,262,'2022-05-29'),(556,23,28.60,1,28.60,31,263,'2022-06-01'),(557,32,162.00,1,162.00,31,264,'2022-06-02'),(558,32,162.00,1,162.00,31,264,'2022-06-02'),(559,11,4.20,1,4.20,31,264,'2022-06-02'),(560,32,162.00,1,162.00,31,265,'2022-06-04'),(562,32,162.00,3,486.00,31,265,'2022-06-04'),(563,11,4.20,100,420.00,31,266,'2022-06-04'),(564,32,162.00,1,162.00,31,267,'2022-06-04'),(566,11,4.20,28,117.60,31,268,'2022-06-04'),(567,11,4.20,2000,8400.00,31,269,'2022-06-04'),(568,21,81.00,1,81.00,31,270,'2022-06-11'),(569,32,162.00,1,162.00,31,270,'2022-06-11'),(570,11,4.20,400,1680.00,31,270,'2022-06-11'),(571,21,81.00,4,324.00,31,271,'2022-06-11'),(572,11,4.20,1,4.20,31,272,'2022-08-03'),(573,12,1.35,1,1.35,31,272,'2022-08-03'),(574,21,84.00,1,84.00,31,272,'2022-08-03'),(575,21,84.00,10,840.00,31,274,'2022-08-03'),(576,11,4.20,1,4.20,31,275,'2022-08-18'),(577,11,4.20,200,840.00,31,275,'2022-08-18'),(578,11,4.20,500,2100.00,31,276,'2022-08-18');
/*!40000 ALTER TABLE `itens_venda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movimentacoes`
--

DROP TABLE IF EXISTS `movimentacoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `movimentacoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(15) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `usuario` int(11) NOT NULL,
  `data` date NOT NULL,
  `id_mov` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movimentacoes`
--

LOCK TABLES `movimentacoes` WRITE;
/*!40000 ALTER TABLE `movimentacoes` DISABLE KEYS */;
INSERT INTO `movimentacoes` VALUES (28,'','Compra de Produto',20.00,2,'2022-04-16',11),(29,'Saída','Compra de Produtos',500.00,21,'2022-05-06',50),(30,'Saída','Compra de Produtos',1500.00,21,'2022-05-06',49),(31,'Saída','Compra de Produtos',1800.00,21,'2022-05-07',55),(32,'Saída','Compra de Produtos',1650.00,21,'2022-05-07',54),(33,'Saída','Compra de Produtos',2250.00,21,'2022-05-07',40),(34,'Entrada','Promissora 000205',30.00,21,'2022-05-07',15),(35,'Entrada','Receita do dia',2500.00,21,'2022-05-07',16),(36,'Entrada','Receita fechamento 07/05/2022',21073.00,21,'2022-05-07',17),(37,'Saída','Compra de Produtos',1500.00,21,'2022-05-07',57),(38,'Saída','Compra de Produtos',200.00,21,'2022-05-07',56),(39,'Saída','Compra de Produtos',1760.00,21,'2022-05-07',53),(40,'Saída','Compra de Produtos',0.00,21,'2022-05-08',59),(41,'Saída','Compra de Produtos',6000.00,21,'2022-05-12',41),(42,'Saída','Compra de Produtos',1500.00,21,'2022-05-12',44),(43,'Entrada','Período da Apuração 11/05/2022 Total de Vendas R$ ',125.00,21,'2022-05-12',18),(44,'Entrada','Recebimento de boletos',10000.00,21,'2022-05-12',19),(45,'Saída','Compra de Produtos',600.00,21,'2022-05-28',60),(46,'Saída','Compra de Produtos',2200.00,21,'2022-05-28',58),(47,'Saída','Compra de Produtos',2400.00,21,'2022-06-02',62),(48,'Saída','Compra de Produtos',800.00,21,'2022-06-04',61),(49,'Entrada','Receita02052022',1.32,21,'2022-06-04',20),(50,'Saída','Compra de Produtos',2500.00,21,'2022-06-04',42),(51,'Saída','Compra de Produtos',1500.00,21,'2022-06-04',45),(52,'Entrada','Receita02052022_final',8400.00,36,'2022-06-04',21),(53,'Saída','Compra de Produtos',1500.00,21,'2022-07-08',46),(54,'Saída','Compra de Produtos',1500.00,21,'2022-07-08',47),(55,'Saída','Compra de Produtos',1500.00,21,'2022-07-08',48),(56,'Saída','Compra de Produtos',2000.00,21,'2022-07-08',51),(57,'Saída','Compra de Produtos',1760.00,21,'2022-07-08',52),(58,'Saída','Compra de Produtos',3000.00,21,'2022-07-08',63),(59,'Entrada','faturamento mes',11260.00,21,'2022-07-08',22);
/*!40000 ALTER TABLE `movimentacoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(30) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `estoque` int(11) NOT NULL,
  `valor_compra` decimal(8,2) NOT NULL,
  `valor_venda` decimal(8,2) NOT NULL,
  `fornecedor` int(11) NOT NULL,
  `categoria` int(11) NOT NULL,
  `foto` varchar(120) DEFAULT NULL,
  `lucro` decimal(8,2) NOT NULL,
  `estoque_min` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (11,'0000000001','Bloco de Cimento','Bloco de Cimento 10X19X39',18699,3.00,4.20,5,9,'09-04-2022-20-51-24-bloco_cimento.jpg',40.00,5000),(12,'0000000002','Bloco Ceramico','Bloco Ceramico 6 Furos',47542,1.00,1.35,5,9,'09-04-2022-20-53-28-bloco_ceramico.jpg',35.00,1000),(13,'0000000003','Areia Media','Areia Media',26,110.00,148.50,5,9,'10-04-2022-09-19-35-areia_media.jpg',35.00,8),(14,'0000000004','Pedra Brita 1','Pedra Brita 1',70,120.00,168.00,5,9,'10-04-2022-09-46-22-pedra_brita.jpg',40.00,8),(15,'0000000006','Areia Saco 20Kg','Areia em Saco 20 KG',50,12.50,16.25,5,9,'10-04-2022-14-02-50-areia_em_saco.jpg',30.00,8),(16,'00000000010','Folha de Porta Lisa 82X2.10','Folha de Porta Lisa 82X210',15,50.00,65.00,5,14,'10-04-2022-14-52-33-folha_porta_lisa.jpg',30.00,15),(17,'0000000015','Areia Fina','Areia Fina',100,15.00,19.50,5,9,'11-04-2022-21-35-08-areia_em_saco.jpg',30.00,8),(18,'0000005','Tubo PVC Esgoto 150m 6Mm','Tubo PVC Esgoto 150m 6M',90,50.00,70.00,8,13,'11-04-2022-22-05-52-tubopvc.jpg',40.00,20),(19,'00000020','Areia Grossa','Areia Grossa',30,120.00,180.00,5,9,'11-04-2022-22-43-55-areia_media.jpg',50.00,10),(20,'0001','Tubo de PVC Tigre 100MM','Tubo de PVC Tigre 100MM',50,50.00,65.00,8,16,'06-05-2022-21-40-34-tubopvc.jpg',30.00,10),(21,'0000001','Ferro 8MM Gerdau','Ferro 8MM Gerdau Barra 12M',86,60.00,84.00,9,10,'06-05-2022-21-37-53-ferro.jpg',40.00,50),(22,'0000002','Tubo PVC Esgoto 75MM ','Tubo PVC Esgoto 75MM Tigre',18,45.00,60.75,8,16,'06-05-2022-21-42-58-tubopvc.jpg',35.00,10),(23,'0000007','Prego 18X27 Gerdau','',69,22.00,28.60,9,10,'07-05-2022-18-59-03-prego.jpg',30.00,30),(24,'0000008','Prego 17X21 Gerdau','Prego 17X21 Gerdau',64,22.00,28.60,9,13,'07-05-2022-19-00-42-prego.jpg',30.00,30),(25,'0000009','Arame ','Arame trançado rolo 1KG',71,25.00,32.50,9,13,'07-05-2022-19-03-22-arame.jpg',30.00,30),(26,'00000010','Vaso Sanitario Deca Branco','',12,120.00,156.00,5,9,'07-05-2022-19-13-32-vaso_sanitario_branco.jpg',30.00,5),(28,'00000012','Tubo PVC Tigre 75MM','Tubo PVC Tigre 75MM',30,50.00,65.00,8,16,'07-05-2022-20-47-46-tubo_marron.jpg',30.00,10),(29,'00000013','Cotovelo Esgoto Tigre 100MM','Cotovelo Esgoto Tigre 100MM',20,10.00,13.00,8,16,'07-05-2022-20-50-33-cotovelo-esgoto.jpg',30.00,5),(30,'0000003','Frete','frete',4997,0.00,0.00,5,13,'08-05-2022-10-28-12-frete.jpg',0.00,1),(31,'00000011','Vaso Sanitario Deca Preto','Vaso Sanitario Deca Preto',7,100.00,130.00,8,9,'28-05-2022-11-51-44-vaso_santario_preto.jpg',30.00,5),(32,'000001','Bianco 18L','Bianco 18 L',12,120.00,162.00,10,11,'02-06-2022-22-39-35-vedacit.jpg',35.00,5);
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sangrias`
--

DROP TABLE IF EXISTS `sangrias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sangrias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor` decimal(8,2) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `usuario` int(11) NOT NULL,
  `caixa` int(11) NOT NULL,
  `id_caixa` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sangrias`
--

LOCK TABLES `sangrias` WRITE;
/*!40000 ALTER TABLE `sangrias` DISABLE KEYS */;
INSERT INTO `sangrias` VALUES (24,200.00,'2022-04-09','23:53:07',21,2,21),(25,200.00,'2022-04-10','00:18:42',21,2,22),(26,50.00,'2022-04-10','00:23:10',27,5,23),(27,200.00,'2022-04-10','09:54:50',27,2,24),(28,50.00,'2022-04-10','09:56:58',27,2,25),(29,300.00,'2022-04-10','14:05:06',27,3,27),(30,100.00,'2022-04-11','21:30:14',27,4,29),(31,0.00,'2022-04-11','22:24:37',27,4,30),(32,200.00,'2022-04-11','22:54:20',27,8,32),(33,0.00,'2022-04-11','22:54:43',27,8,32),(34,200.00,'2022-04-11','23:09:31',27,5,34),(35,0.00,'2022-04-15','16:15:39',27,2,35),(36,50.00,'2022-04-15','17:16:44',27,2,36),(37,0.00,'2022-04-15','17:32:34',27,3,38),(38,0.00,'2022-04-15','17:34:05',27,5,39),(39,0.00,'2022-04-15','23:13:13',27,2,40),(40,0.00,'2022-04-16','01:29:47',27,2,41),(41,200.00,'2022-04-16','01:34:32',27,3,43),(42,0.00,'2022-04-16','01:58:33',27,4,44),(43,100.00,'2022-04-16','18:48:50',27,3,46),(44,200.00,'2022-04-16','19:06:13',27,2,48),(45,0.00,'2022-04-24','22:04:02',27,1,49),(46,0.00,'2022-04-26','22:51:46',27,1,50),(47,0.00,'2022-04-27','23:17:28',27,1,51),(48,0.00,'2022-04-28','15:33:59',27,1,52),(49,0.00,'2022-04-28','19:46:41',27,1,53),(50,0.00,'2022-05-05','21:05:11',27,1,54),(51,0.00,'2022-05-05','21:07:30',27,1,54),(52,100.00,'2022-05-06','21:53:35',27,1,56),(53,100.00,'2022-05-06','22:01:39',27,2,58),(54,0.00,'2022-05-06','22:02:00',27,2,58),(55,100.00,'2022-05-06','22:04:07',27,2,58),(56,100.00,'2022-05-06','22:05:52',27,2,58),(57,100.00,'2022-05-07','18:52:46',27,1,59),(58,0.00,'2022-05-07','19:34:54',27,1,62),(59,100.00,'2022-05-07','19:37:32',27,2,63),(60,100.00,'2022-05-07','19:52:35',27,3,65),(61,100.00,'2022-05-07','20:01:13',27,2,67),(62,100.00,'2022-05-07','20:16:01',27,4,68),(63,100.00,'2022-05-07','20:43:21',27,1,69),(64,50.00,'2022-05-07','21:01:57',27,1,70),(65,0.00,'2022-05-07','21:16:32',27,1,71),(66,0.00,'2022-05-08','10:19:36',27,1,72),(67,0.00,'2022-05-08','10:31:51',27,1,73),(68,0.00,'2022-05-08','11:20:38',27,2,75),(69,0.00,'2022-05-10','21:54:15',27,2,76),(70,100.00,'2022-05-11','20:41:39',27,3,77),(71,100.00,'2022-05-12','09:19:35',27,2,78),(72,0.00,'2022-05-12','12:51:34',27,1,79),(73,0.00,'2022-05-12','13:48:19',27,1,80),(74,0.00,'2022-05-12','19:44:57',27,1,81),(75,0.00,'2022-05-12','19:45:32',27,1,81),(76,0.00,'2022-05-13','12:20:26',27,1,82),(77,100.00,'2022-05-28','11:10:04',27,1,83),(78,50.00,'2022-05-28','11:14:02',27,2,84),(79,0.00,'2022-05-28','11:39:15',27,3,85),(80,100.00,'2022-05-28','11:43:47',27,1,86),(81,0.00,'2022-05-28','11:58:07',27,1,87),(82,0.00,'2022-05-29','17:23:05',27,2,88),(83,0.00,'2022-05-29','17:36:05',22,1,89),(84,0.00,'2022-05-29','18:16:50',27,1,90),(85,0.00,'2022-05-29','18:42:10',27,1,91),(86,0.00,'2022-06-01','18:56:18',27,1,92),(87,50.00,'2022-06-02','22:45:24',27,1,93),(88,0.00,'2022-06-04','16:39:12',27,1,95),(89,50.00,'2022-06-04','16:43:38',27,2,96),(90,0.00,'2022-06-04','20:03:13',27,1,97),(91,0.00,'2022-06-04','20:07:18',27,1,97),(92,0.00,'2022-06-04','20:29:02',27,1,98),(93,0.00,'2022-06-11','10:30:14',27,1,99),(94,40.00,'2022-08-03','19:47:28',27,4,100),(95,0.00,'2022-08-18','23:50:04',27,1,101);
/*!40000 ALTER TABLE `sangrias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `nivel` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (21,'EVANDRO VENANCIO PEREIRA','pereiravenancio@hotmail.com','020.308.304-02','128124','Administrador'),(22,'Gisele Jesus Aquino','gisele@hotmail.com','000.000.000-10','123456','Administrador'),(25,'Egberto','egberto@gmail.com','000.000.000-50','123456','Operador'),(27,'Eder Lima','eder@gmail.com','000.000.000-70','123456','Administrador'),(28,'Helia Costa','helia@gmail.com','000.000.000-80','123456','Tesoureiro'),(29,'Paulo Marcotti','marcotti@gmail.com','000.000.000-90','1234565','Administrador'),(31,'Milena Costa','milena@gmail.com','000.000.002-10','123456','Operador'),(33,'Willina Bi','willian@gmail.com','000.000.000-08','123456','Operador'),(34,'Larissa Chuluc','larissa@gmail.com','000.000.000-21','123456','Operador'),(35,'Renato Coelho ','renatocoelho@gmail.com','299.933.294-00','128124','Administrador'),(36,'Helia Costa','heliacosta@gmail.com','234.455.555-43','123456','Tesoureiro'),(37,'matheus','matheus@gmail.com','888.888.888-88','123456','Administrador'),(38,'gustavo','gustavo@gmail.com','777.777.777-77','123456','Tesoureiro'),(39,'matheus s','matheus@gmail.comdd','444.444.444-44','333','Operador');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendas`
--

DROP TABLE IF EXISTS `vendas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vendas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor` decimal(8,2) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `operador` int(11) NOT NULL,
  `valor_recebido` decimal(8,2) NOT NULL,
  `desconto` varchar(20) NOT NULL,
  `troco` decimal(8,2) NOT NULL,
  `forma_pgto` int(11) NOT NULL,
  `abertura` int(11) NOT NULL,
  `status` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=277 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendas`
--

LOCK TABLES `vendas` WRITE;
/*!40000 ALTER TABLE `vendas` DISABLE KEYS */;
INSERT INTO `vendas` VALUES (193,2.52,'2022-04-09','21:50:20',31,2.52,'R$ 0,00',0.00,1,20,'Concluída'),(224,75.90,'2022-04-24','22:02:58',31,75.90,'R$ 0,00',0.00,1,49,'Concluída'),(225,1.35,'2022-04-26','22:29:20',31,4.00,'R$ 0,00',2.65,1,50,'Concluída'),(226,4.05,'2022-04-27','23:15:18',31,5.00,'R$ 0,00',0.95,4,51,'Concluída'),(227,148.50,'2022-04-28','15:32:51',31,148.50,'R$ 0,00',0.00,1,52,'Concluída'),(228,151.20,'2022-04-28','19:46:07',31,151.20,'R$ 0,00',0.00,1,53,'Concluída'),(229,160.95,'2022-05-05','21:07:01',31,200.00,'R$ 0,00',39.05,1,54,'Concluída'),(230,6.90,'2022-05-05','21:10:01',31,10.00,'R$ 0,00',3.10,2,55,'Concluída'),(231,810.00,'2022-05-06','21:49:07',31,850.00,'R$ 0,00',40.00,1,56,'Concluída'),(232,162.00,'2022-05-06','21:53:06',31,172.00,'R$ 0,00',10.00,2,56,'Concluída'),(233,65.00,'2022-05-06','22:05:14',31,70.00,'R$ 0,00',5.00,1,58,'Concluída'),(234,764.25,'2022-05-07','18:51:39',31,764.25,'R$ 0,00',0.00,2,59,'Concluída'),(235,513.00,'2022-05-07','18:54:26',31,513.00,'R$ 0,00',0.00,4,60,'Concluída'),(236,559.05,'2022-05-07','19:32:20',31,559.05,'R$ 0,00',0.00,2,61,'Concluída'),(237,636.30,'2022-05-07','19:34:26',31,636.30,'R$ 0,00',0.00,4,62,'Concluída'),(238,673.00,'2022-05-07','19:36:59',31,700.00,'R$ 0,00',27.00,1,63,'Concluída'),(239,953.25,'2022-05-07','19:51:57',31,953.25,'R$ 0,00',0.00,3,65,'Concluída'),(240,170.35,'2022-05-07','20:00:39',31,200.00,'R$ 0,00',29.65,1,67,'Concluída'),(241,14170.75,'2022-05-07','20:15:20',31,14170.75,'R$ 0,00',0.00,4,68,'Concluída'),(242,301.45,'2022-05-07','20:42:54',31,310.00,'R$ 0,00',8.55,1,69,'Concluída'),(243,1784.50,'2022-05-07','21:00:50',31,1784.50,'R$ 0,00',0.00,2,70,'Concluída'),(244,3052.35,'2022-05-07','21:16:07',34,3052.35,'R$ 0,00',0.00,2,71,'Concluída'),(245,179.60,'2022-05-08','10:19:10',34,179.60,'R$ 0,00',0.00,3,72,'Concluída'),(246,840.00,'2022-05-08','10:31:21',34,840.00,'R$ 0,00',0.00,4,73,'Concluída'),(247,351.75,'2022-05-08','11:19:55',31,351.75,'R$ 0,00',0.00,4,75,'Concluída'),(248,1573.00,'2022-05-10','21:53:35',31,1573.00,'R$ 0,00',0.00,2,76,'Concluída'),(249,125.75,'2022-05-11','20:41:01',31,125.75,'R$ 0,00',0.00,4,77,'Concluída'),(250,134.20,'2022-05-12','09:18:42',31,134.20,'R$ 0,00',0.00,2,78,'Concluída'),(251,141.75,'2022-05-12','12:50:59',31,141.75,'R$ 0,00',0.00,1,79,'Concluída'),(252,141.75,'2022-05-12','13:47:43',31,150.00,'R$ 0,00',8.25,1,80,'Concluída'),(253,81.00,'2022-05-12','19:45:14',31,81.00,'R$ 0,00',0.00,1,81,'Concluída'),(254,141.75,'2022-05-13','12:19:54',31,141.75,'R$ 0,00',0.00,1,82,'Concluída'),(255,125.20,'2022-05-28','11:07:37',31,150.00,'R$ 0,00',24.80,1,83,'Concluída'),(256,61.10,'2022-05-28','11:12:48',31,61.10,'R$ 0,00',0.00,2,84,'Concluída'),(257,138.20,'2022-05-28','11:38:27',31,150.00,'R$ 0,00',11.80,1,85,'Concluída'),(258,130.00,'2022-05-28','11:56:40',31,130.00,'R$ 0,00',0.00,3,87,'Concluída'),(259,130.00,'2022-05-28','11:57:43',31,130.00,'R$ 0,00',0.00,3,87,'Concluída'),(260,28.60,'2022-05-29','17:21:46',31,28.60,'R$ 0,00',0.00,1,88,'Concluída'),(261,28.60,'2022-05-29','17:31:33',31,28.60,'R$ 0,00',0.00,2,89,'Concluída'),(262,32.50,'2022-05-29','18:41:06',31,32.50,'R$ 0,00',0.00,3,91,'Concluída'),(263,28.60,'2022-06-01','18:55:40',31,28.60,'R$ 0,00',0.00,3,92,'Concluída'),(264,328.20,'2022-06-02','22:43:32',31,328.20,'R$ 0,00',0.00,4,93,'Concluída'),(265,648.00,'2022-06-04','16:37:13',31,648.00,'R$ 0,00',0.00,3,94,'Concluída'),(266,399.00,'2022-06-04','16:42:49',31,399.00,'5%',0.00,3,96,'Concluída'),(267,152.28,'2022-06-04','20:01:40',31,160.00,'6%',7.72,1,97,'Concluída'),(268,117.60,'2022-06-04','20:06:24',31,120.00,'R$ 0,00',2.40,1,97,'Concluída'),(269,8400.00,'2022-06-04','20:26:51',31,8400.00,'R$ 0,00',0.00,3,98,'Concluída'),(270,1923.00,'2022-06-11','10:26:43',31,2000.00,'R$ 0,00',77.00,1,99,'Concluída'),(271,291.60,'2022-06-11','10:29:28',31,291.60,'10%',0.00,2,99,'Concluída'),(272,89.55,'2022-08-03','19:44:24',31,100.00,'R$ 0,00',10.45,1,100,'Concluída'),(273,89.55,'2022-08-03','19:45:04',31,100.00,'R$ 0,00',10.45,1,100,'Concluída'),(274,798.00,'2022-08-03','19:46:16',31,800.00,'5%',2.00,1,100,'Concluída'),(275,844.20,'2022-08-18','23:46:18',31,900.00,'R$ 0,00',55.80,1,101,'Concluída'),(276,1890.00,'2022-08-18','23:48:20',31,1900.00,'10%',10.00,1,101,'Concluída');
/*!40000 ALTER TABLE `vendas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-09-18 22:34:01
