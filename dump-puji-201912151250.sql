-- MySQL dump 10.13  Distrib 5.7.28, for Linux (x86_64)
--
-- Host: localhost    Database: puji
-- ------------------------------------------------------
-- Server version	5.7.28-0ubuntu0.18.04.4

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `counter`
--

DROP TABLE IF EXISTS `counter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `counter` (
  `counter` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `counter`
--

LOCK TABLES `counter` WRITE;
/*!40000 ALTER TABLE `counter` DISABLE KEYS */;
INSERT INTO `counter` VALUES (67);
/*!40000 ALTER TABLE `counter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dropping`
--

DROP TABLE IF EXISTS `dropping`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dropping` (
  `id_dropping` int(5) NOT NULL AUTO_INCREMENT,
  `kode_m_kasir` int(5) DEFAULT NULL,
  `kode_barang` int(5) DEFAULT NULL,
  `stok` int(10) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_dropping`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dropping`
--

LOCK TABLES `dropping` WRITE;
/*!40000 ALTER TABLE `dropping` DISABLE KEYS */;
/*!40000 ALTER TABLE `dropping` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_group`
--

DROP TABLE IF EXISTS `master_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_group` (
  `kode_group` int(5) NOT NULL AUTO_INCREMENT,
  `nama_group` varchar(30) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `opsi1` varchar(255) DEFAULT NULL,
  `opsi2` varchar(255) DEFAULT NULL,
  `opsi3` varchar(255) DEFAULT NULL,
  `opsi4` varchar(255) DEFAULT NULL,
  `opsi5` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`kode_group`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_group`
--

LOCK TABLES `master_group` WRITE;
/*!40000 ALTER TABLE `master_group` DISABLE KEYS */;
INSERT INTO `master_group` VALUES (11,'Sosis','g__1575963593.jpg','sosis','2019-12-10 14:39:53',NULL,NULL,NULL,NULL,NULL),(12,'nugget','g__1575963634.jpg','nugget','2019-12-10 14:40:34',NULL,NULL,NULL,NULL,NULL),(19,'Daging','g_Daging_1575964282.jpg','daging','2019-12-10 14:51:22',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `master_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_kasir`
--

DROP TABLE IF EXISTS `master_kasir`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_kasir` (
  `kode_m_kasir` int(5) NOT NULL AUTO_INCREMENT,
  `kode_kasir` int(5) NOT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `telp` varchar(13) DEFAULT NULL,
  `PIC` varchar(30) DEFAULT NULL,
  `url` varchar(225) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `opsi1` varchar(255) DEFAULT NULL,
  `opsi2` varchar(255) DEFAULT NULL,
  `opsi3` varchar(255) DEFAULT NULL,
  `opsi4` varchar(255) DEFAULT NULL,
  `opsi5` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`kode_m_kasir`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_kasir`
--

LOCK TABLES `master_kasir` WRITE;
/*!40000 ALTER TABLE `master_kasir` DISABLE KEYS */;
INSERT INTO `master_kasir` VALUES (1,5,'TOKO INDAH','UNGARAN','KAB SEMARANG','024 7484998','INDAH','http://zonasosiscvpuji.com/kasbm','-','2019-12-13 16:13:07',NULL,NULL,NULL,NULL,NULL),(5,2,'Toko Mina Padi','Ungaran','Kab Semarang','024 7484998','Budi','http://zonasosiscvpuji.com/kastmp','-','2019-12-10 15:56:59',NULL,NULL,NULL,NULL,NULL),(6,3,'Warung Daging Lumayan','Bawen','Kab Semarang','024 9585098','Harto','http://zonasosiscvpuji.com/kaswdl','-','2019-12-10 15:57:34',NULL,NULL,NULL,NULL,NULL),(7,4,'Berkah Mart','Kaligawe','Semarang','024 7484998','Santi','http://zonasosiscvpuji.com/kasbm','-','2019-12-10 15:58:17',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `master_kasir` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_stok_kasir`
--

DROP TABLE IF EXISTS `master_stok_kasir`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_stok_kasir` (
  `id_s_kasir` int(5) NOT NULL AUTO_INCREMENT,
  `kode_m_kasir` int(5) DEFAULT NULL,
  `kode_barang` int(5) DEFAULT NULL,
  `stok` int(10) DEFAULT NULL,
  `min_stok` int(10) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_s_kasir`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_stok_kasir`
--

LOCK TABLES `master_stok_kasir` WRITE;
/*!40000 ALTER TABLE `master_stok_kasir` DISABLE KEYS */;
INSERT INTO `master_stok_kasir` VALUES (2,1,1,100,NULL,'2019-12-10 07:04:26'),(3,5,33,10,NULL,'2019-12-10 15:59:38'),(4,1,33,100,NULL,'2019-12-13 16:18:19'),(5,7,33,100,NULL,'2019-12-13 16:11:25'),(6,1,33,100,NULL,'2019-12-13 16:18:13'),(7,7,33,100,NULL,'2019-12-13 16:12:32'),(8,1,36,200,NULL,'2019-12-13 16:16:20'),(9,1,37,100,NULL,'2019-12-13 16:19:11'),(10,7,33,100,NULL,'2019-12-13 16:20:31'),(11,7,33,10,NULL,'2019-12-13 16:21:42'),(12,7,33,100,NULL,'2019-12-13 16:21:48'),(13,1,37,100,NULL,'2019-12-13 16:22:00');
/*!40000 ALTER TABLE `master_stok_kasir` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock_m_kasir`
--

DROP TABLE IF EXISTS `stock_m_kasir`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock_m_kasir` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kode_m_kasir` int(10) NOT NULL,
  `kode_barang` int(10) NOT NULL,
  `stok` int(10) NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_m_kasir`
--

LOCK TABLES `stock_m_kasir` WRITE;
/*!40000 ALTER TABLE `stock_m_kasir` DISABLE KEYS */;
INSERT INTO `stock_m_kasir` VALUES (1,1,1,100,'2019-12-10 07:04:26'),(2,5,33,10,'2019-12-10 15:59:38'),(3,8,33,200,'2019-12-13 16:11:13'),(4,1,33,149,'2019-12-13 16:11:25'),(5,1,36,200,'2019-12-13 16:16:20'),(6,1,37,178,'2019-12-13 16:19:11'),(7,7,33,210,'2019-12-13 16:20:31');
/*!40000 ALTER TABLE `stock_m_kasir` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock_opname`
--

DROP TABLE IF EXISTS `stock_opname`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock_opname` (
  `id_stock_opname` int(5) NOT NULL AUTO_INCREMENT,
  `kode_barang` int(5) DEFAULT NULL,
  `stok` int(10) DEFAULT NULL,
  `ket` varchar(50) NOT NULL,
  `datetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_stock_opname`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_opname`
--

LOCK TABLES `stock_opname` WRITE;
/*!40000 ALTER TABLE `stock_opname` DISABLE KEYS */;
INSERT INTO `stock_opname` VALUES (1,1,100,'ket','2019-12-10 06:20:59'),(3,36,200,'RCV 10/12/2019 15:11','2019-12-10 15:11:33'),(4,35,500,'RCV 10/12/2019 15:11','2019-12-10 15:11:54'),(5,33,100,'-','2019-12-11 10:13:44'),(6,37,1000,'RCV 11/12/19','2019-12-11 11:26:51');
/*!40000 ALTER TABLE `stock_opname` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tab_barang`
--

DROP TABLE IF EXISTS `tab_barang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tab_barang` (
  `kode_barang` int(5) NOT NULL AUTO_INCREMENT,
  `kode_group` int(5) DEFAULT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `ukuran` int(5) DEFAULT NULL,
  `merk` varchar(10) DEFAULT NULL,
  `gambar` varbinary(225) DEFAULT NULL,
  `harga` int(20) DEFAULT NULL,
  `stok` int(20) DEFAULT NULL,
  `keterangan` int(11) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `opsi1` varchar(255) DEFAULT NULL,
  `opsi2` varchar(255) DEFAULT NULL,
  `opsi3` varchar(255) DEFAULT NULL,
  `opsi4` varchar(255) DEFAULT NULL,
  `opsi5` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`kode_barang`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tab_barang`
--

LOCK TABLES `tab_barang` WRITE;
/*!40000 ALTER TABLE `tab_barang` DISABLE KEYS */;
INSERT INTO `tab_barang` VALUES (33,11,'SOSIS IKAN',1000,'ZONA',_binary 'b_SAPI_SLIE_1575964810.jpg',12000,-610,0,'2019-12-13 16:21:48',NULL,NULL,NULL,NULL,NULL),(35,19,'SAPI SLIE',500,'ZONA',_binary 'b_SAPI_SLIE_1575964810.jpg',34000,500,0,'2019-12-11 10:08:40',NULL,NULL,NULL,NULL,NULL),(36,12,'NUGGET SAPI',500,'ZONA',_binary 'b_NUGGET_SAPI_1575964845.jpg',23000,0,0,'2019-12-13 16:16:20',NULL,NULL,NULL,NULL,NULL),(37,11,'SOSIS FIESTA',500,'FIESTA',_binary 'b_1576038153.jpg',15000,800,0,'2019-12-13 16:22:00',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `tab_barang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tab_kasir`
--

DROP TABLE IF EXISTS `tab_kasir`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tab_kasir` (
  `kode_kasir` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `opsi1` varchar(255) DEFAULT NULL,
  `opsi2` varchar(255) DEFAULT NULL,
  `opsi3` varchar(255) DEFAULT NULL,
  `opsi4` varchar(255) DEFAULT NULL,
  `opsi5` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`kode_kasir`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tab_kasir`
--

LOCK TABLES `tab_kasir` WRITE;
/*!40000 ALTER TABLE `tab_kasir` DISABLE KEYS */;
INSERT INTO `tab_kasir` VALUES (2,'GROSIR','PEDAGANG GROSIR','2019-12-10 15:01:25',NULL,NULL,NULL,NULL,NULL),(3,'ECERAN','PEDAGANG ECERAN','2019-12-10 15:01:35',NULL,NULL,NULL,NULL,NULL),(4,'AGEN','KEAGENAN','2019-12-10 15:01:42',NULL,NULL,NULL,NULL,NULL),(5,'ALL','SEMUA TIPE','2019-12-11 11:19:33',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `tab_kasir` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tab_pricelist`
--

DROP TABLE IF EXISTS `tab_pricelist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tab_pricelist` (
  `id_pricelist` int(5) NOT NULL AUTO_INCREMENT,
  `kode_kasir` int(5) DEFAULT NULL,
  `kode_barang` int(5) DEFAULT NULL,
  `qty_a` int(10) DEFAULT NULL,
  `qty_b` int(10) DEFAULT NULL,
  `harga` int(20) DEFAULT NULL,
  `keterangan` varbinary(225) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `opsi1` varchar(255) DEFAULT NULL,
  `opsi2` varchar(255) DEFAULT NULL,
  `opsi3` varchar(255) DEFAULT NULL,
  `opsi4` varchar(255) DEFAULT NULL,
  `opsi5` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_pricelist`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tab_pricelist`
--

LOCK TABLES `tab_pricelist` WRITE;
/*!40000 ALTER TABLE `tab_pricelist` DISABLE KEYS */;
INSERT INTO `tab_pricelist` VALUES (1,1,1,1,5,1000,_binary '1','2019-12-10 06:11:16',NULL,NULL,NULL,NULL,NULL),(2,1,1,6,10,800,_binary 'ket','2019-12-10 06:11:25',NULL,NULL,NULL,NULL,NULL),(3,2,33,1,5,24000,_binary '-','2019-12-10 15:06:56',NULL,NULL,NULL,NULL,NULL),(4,2,33,6,10,22000,_binary '-','2019-12-10 15:07:11',NULL,NULL,NULL,NULL,NULL),(5,2,33,11,9999,20000,_binary '-','2019-12-10 15:07:30',NULL,NULL,NULL,NULL,NULL),(6,2,35,1,5,65000,_binary '-','2019-12-10 15:07:54',NULL,NULL,NULL,NULL,NULL),(7,2,35,6,10,63000,_binary '-','2019-12-10 15:08:06',NULL,NULL,NULL,NULL,NULL),(8,2,35,11,9999,56000,_binary '-','2019-12-10 15:08:28',NULL,NULL,NULL,NULL,NULL),(9,2,36,1,5,40000,_binary '-','2019-12-10 15:09:33',NULL,NULL,NULL,NULL,NULL),(10,2,36,6,10,38000,_binary '-','2019-12-10 15:10:22',NULL,NULL,NULL,NULL,NULL),(11,2,36,11,9999,30000,_binary '-','2019-12-10 15:10:14',NULL,NULL,NULL,NULL,NULL),(12,5,37,1,5,17000,_binary '500 GRAM 1-5','2019-12-11 11:24:40',NULL,NULL,NULL,NULL,NULL),(13,5,37,6,10,16000,_binary '500 GR 1-6','2019-12-11 11:25:12',NULL,NULL,NULL,NULL,NULL),(14,5,33,1,100,30000,_binary '-','2019-12-13 16:21:46',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `tab_pricelist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_hak_akses`
--

DROP TABLE IF EXISTS `tbl_hak_akses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_hak_akses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user_level` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_hak_akses`
--

LOCK TABLES `tbl_hak_akses` WRITE;
/*!40000 ALTER TABLE `tbl_hak_akses` DISABLE KEYS */;
INSERT INTO `tbl_hak_akses` VALUES (1,1,1),(2,1,3),(3,1,2),(4,2,4),(5,2,5),(6,2,6),(7,2,7),(8,2,8),(9,2,9),(10,2,10),(11,2,11);
/*!40000 ALTER TABLE `tbl_hak_akses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_menu`
--

DROP TABLE IF EXISTS `tbl_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `url` varchar(30) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `is_main_menu` int(11) NOT NULL,
  `is_aktif` enum('y','n') NOT NULL COMMENT 'y=yes,n=no',
  PRIMARY KEY (`id_menu`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_menu`
--

LOCK TABLES `tbl_menu` WRITE;
/*!40000 ALTER TABLE `tbl_menu` DISABLE KEYS */;
INSERT INTO `tbl_menu` VALUES (1,'KELOLA MENU','kelolamenu','fa fa-server',0,'y'),(2,'KELOLA PENGGUNA','user','fa fa-user-o',0,'y'),(3,'level PENGGUNA','userlevel','fa fa-users',0,'y'),(4,'Master Group','master_group','fa fa-database',0,'y'),(5,'Master Kasir','master_kasir','fa fa-users',0,'y'),(6,'Data Barang','tab_barang','fa fa-barcode',0,'y'),(7,'Tipe Kasir','tab_kasir','fa fa-id-card',0,'y'),(8,'Pricelist','tab_pricelist','fa fa-money',0,'y'),(9,'Stock Opname','stock_opname','fa fa-plus-square',0,'y'),(10,'Dropping Kasir','dropping','fa fa-angle-double-down',0,'n'),(11,'Master Stok Kasir','master_stok_kasir','fa fa-angle-double-down',0,'y');
/*!40000 ALTER TABLE `tbl_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_setting`
--

DROP TABLE IF EXISTS `tbl_setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_setting` (
  `id_setting` int(11) NOT NULL AUTO_INCREMENT,
  `nama_setting` varchar(50) NOT NULL,
  `value` varchar(40) NOT NULL,
  PRIMARY KEY (`id_setting`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_setting`
--

LOCK TABLES `tbl_setting` WRITE;
/*!40000 ALTER TABLE `tbl_setting` DISABLE KEYS */;
INSERT INTO `tbl_setting` VALUES (1,'Tampil Menu','ya');
/*!40000 ALTER TABLE `tbl_setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_user` (
  `id_users` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `images` text NOT NULL,
  `id_user_level` int(11) NOT NULL,
  `is_aktif` enum('y','n') NOT NULL,
  PRIMARY KEY (`id_users`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user`
--

LOCK TABLES `tbl_user` WRITE;
/*!40000 ALTER TABLE `tbl_user` DISABLE KEYS */;
INSERT INTO `tbl_user` VALUES (1,'super','super@super.com','$2y$04$Wbyfv4xwihb..POfhxY5Y.jHOJqEFIG3dLfBYwAmnOACpH0EWCCdq','atomix_user31.png',1,'y'),(2,'admin','admin@admin.com','$2y$10$73A3ZXTaPO0QHGTzE/zmX.648xupa1vy.bNDJT6lAOG.GpM7hLCWq','atomix_user31.png',2,'y'),(3,'user','user@user.com','$2y$04$Wbyfv4xwihb..POfhxY5Y.jHOJqEFIG3dLfBYwAmnOACpH0EWCCdq','atomix_user31.png',3,'y');
/*!40000 ALTER TABLE `tbl_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user_level`
--

DROP TABLE IF EXISTS `tbl_user_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_user_level` (
  `id_user_level` int(11) NOT NULL AUTO_INCREMENT,
  `nama_level` varchar(30) NOT NULL,
  PRIMARY KEY (`id_user_level`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user_level`
--

LOCK TABLES `tbl_user_level` WRITE;
/*!40000 ALTER TABLE `tbl_user_level` DISABLE KEYS */;
INSERT INTO `tbl_user_level` VALUES (1,'Super Admin'),(2,'Admin'),(3,'User');
/*!40000 ALTER TABLE `tbl_user_level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temp_trans`
--

DROP TABLE IF EXISTS `temp_trans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp_trans` (
  `id_trans` int(10) NOT NULL AUTO_INCREMENT,
  `notrans` varchar(11) NOT NULL,
  `kode_barang` int(5) NOT NULL,
  `kode_m_kasir` int(5) NOT NULL,
  `qty` int(5) NOT NULL,
  `harga` int(20) NOT NULL,
  `jumlah` int(20) DEFAULT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id_trans`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temp_trans`
--

LOCK TABLES `temp_trans` WRITE;
/*!40000 ALTER TABLE `temp_trans` DISABLE KEYS */;
INSERT INTO `temp_trans` VALUES (3,'2',2,2,2,2,2,'2019-12-19 00:00:00'),(14,'12019120068',37,1,1,17000,17000,'2019-12-14 17:09:46'),(15,'12019120068',37,1,8,16000,128000,'2019-12-15 06:17:54');
/*!40000 ALTER TABLE `temp_trans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trans`
--

DROP TABLE IF EXISTS `trans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans` (
  `id_trans` int(10) NOT NULL AUTO_INCREMENT,
  `notrans` varchar(11) NOT NULL,
  `kode_m_kasir` int(5) NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id_trans`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trans`
--

LOCK TABLES `trans` WRITE;
/*!40000 ALTER TABLE `trans` DISABLE KEYS */;
INSERT INTO `trans` VALUES (6,'12019120017',1,'2019-12-13 16:39:02'),(12,'12019120025',1,'2019-12-14 11:44:11'),(13,'12019120026',1,'2019-12-14 11:51:09'),(14,'12019120027',1,'2019-12-14 11:52:03'),(15,'12019120028',1,'2019-12-14 12:03:48'),(16,'12019120029',1,'2019-12-14 12:04:38'),(17,'12019120030',1,'2019-12-14 12:09:22'),(18,'12019120031',1,'2019-12-14 12:11:31'),(19,'12019120032',1,'2019-12-14 12:13:45'),(23,'12019120036',1,'2019-12-14 12:18:26'),(25,'12019120038',1,'2019-12-14 13:02:36'),(26,'12019120039',1,'2019-12-14 13:03:40'),(27,'12019120040',1,'2019-12-14 13:09:59'),(28,'12019120041',1,'2019-12-14 13:11:15'),(29,'12019120042',1,'2019-12-14 13:15:43'),(30,'12019120043',1,'2019-12-14 13:17:30'),(31,'12019120044',1,'2019-12-14 13:19:38'),(32,'12019120045',1,'2019-12-14 13:21:43'),(33,'12019120046',1,'2019-12-14 13:25:44'),(34,'12019120047',1,'2019-12-14 13:30:17'),(35,'12019120048',1,'2019-12-14 13:30:49'),(36,'12019120049',1,'2019-12-14 13:33:00'),(37,'12019120050',1,'2019-12-14 13:35:07'),(38,'12019120051',1,'2019-12-14 13:37:26'),(39,'12019120052',1,'2019-12-14 13:48:49'),(40,'12019120053',1,'2019-12-14 13:49:12'),(41,'12019120054',1,'2019-12-14 13:50:27'),(42,'12019120055',1,'2019-12-14 14:01:11'),(43,'12019120056',1,'2019-12-14 14:02:14'),(44,'12019120057',1,'2019-12-14 14:02:48'),(45,'12019120058',1,'2019-12-14 14:06:17'),(46,'12019120059',1,'2019-12-14 14:38:37'),(47,'12019120060',1,'2019-12-14 15:53:04'),(48,'12019120061',1,'2019-12-14 16:06:48'),(49,'',1,'0000-00-00 00:00:00'),(50,'12019120063',1,'2019-12-14 16:07:55'),(51,'12019120064',1,'2019-12-14 16:08:47'),(52,'12019120065',1,'2019-12-14 16:09:01'),(53,'12019120066',1,'2019-12-14 16:09:53'),(54,'12019120067',1,'2019-12-14 16:20:07');
/*!40000 ALTER TABLE `trans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trans_detail`
--

DROP TABLE IF EXISTS `trans_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_detail` (
  `id_trans` int(10) NOT NULL AUTO_INCREMENT,
  `notrans` varchar(11) NOT NULL,
  `kode_barang` int(5) NOT NULL,
  `kode_m_kasir` int(5) NOT NULL,
  `qty` int(5) NOT NULL,
  `harga` int(20) NOT NULL,
  `jumlah` int(20) NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id_trans`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trans_detail`
--

LOCK TABLES `trans_detail` WRITE;
/*!40000 ALTER TABLE `trans_detail` DISABLE KEYS */;
INSERT INTO `trans_detail` VALUES (1,'1',1,1,1,1,1,'2019-12-17 00:00:00'),(2,'1',1,1,1,1,1,'2019-12-17 00:00:00'),(3,'12019120017',33,1,10,30000,300000,'2019-12-13 16:37:48'),(4,'12019120017',37,1,10,16000,160000,'2019-12-13 16:39:02'),(5,'12019120025',37,1,1,17000,17000,'2019-12-14 11:43:25'),(6,'12019120025',37,1,1,17000,17000,'2019-12-14 11:44:11'),(8,'12019120026',37,1,2,17000,34000,'2019-12-14 11:50:44'),(9,'12019120026',33,1,2,30000,60000,'2019-12-14 11:51:09'),(11,'12019120027',33,1,2,30000,60000,'2019-12-14 11:51:44'),(12,'12019120027',37,1,2,17000,34000,'2019-12-14 11:52:03'),(14,'12019120028',33,1,2,30000,60000,'2019-12-14 12:03:48'),(15,'12019120029',33,1,2,30000,60000,'2019-12-14 12:04:38'),(16,'12019120030',33,1,2,30000,60000,'2019-12-14 12:09:22'),(17,'12019120031',33,1,2,30000,60000,'2019-12-14 12:11:22'),(18,'12019120031',33,1,1,30000,30000,'2019-12-14 12:11:31'),(20,'12019120032',33,1,2,30000,60000,'2019-12-14 12:13:45'),(21,'12019120036',33,1,1,30000,30000,'2019-12-14 12:18:26'),(22,'12019120038',33,1,1,30000,30000,'2019-12-14 13:02:36'),(23,'12019120039',33,1,1,30000,30000,'2019-12-14 13:03:40'),(24,'12019120040',33,1,1,30000,30000,'2019-12-14 13:09:59'),(25,'12019120041',33,1,1,30000,30000,'2019-12-14 13:11:15'),(26,'12019120042',33,1,1,30000,30000,'2019-12-14 13:15:43'),(27,'12019120043',33,1,1,30000,30000,'2019-12-14 13:17:30'),(28,'12019120044',37,1,1,17000,17000,'2019-12-14 13:19:38'),(29,'12019120045',33,1,1,30000,30000,'2019-12-14 13:21:43'),(30,'12019120046',37,1,2,17000,34000,'2019-12-14 13:25:44'),(31,'12019120047',33,1,1,30000,30000,'2019-12-14 13:30:17'),(32,'12019120048',33,1,1,30000,30000,'2019-12-14 13:30:49'),(33,'12019120049',33,1,1,30000,30000,'2019-12-14 13:33:00'),(34,'12019120050',33,1,1,30000,30000,'2019-12-14 13:35:07'),(35,'12019120051',37,1,1,17000,17000,'2019-12-14 13:37:26'),(36,'12019120052',33,1,1,30000,30000,'2019-12-14 13:48:49'),(37,'12019120053',33,1,1,30000,30000,'2019-12-14 13:49:12'),(38,'12019120054',37,1,1,17000,17000,'2019-12-14 13:50:27'),(39,'12019120055',33,1,1,30000,30000,'2019-12-14 14:01:11'),(40,'12019120056',33,1,1,30000,30000,'2019-12-14 14:02:14'),(41,'12019120057',33,1,1,30000,30000,'2019-12-14 14:02:48'),(42,'12019120058',33,1,1,30000,30000,'2019-12-14 14:06:06'),(43,'12019120058',33,1,1,30000,30000,'2019-12-14 14:06:17'),(44,'12019120059',33,1,1,30000,30000,'2019-12-14 14:38:37'),(45,'12019120060',33,1,1,30000,30000,'2019-12-14 15:53:04'),(46,'12019120061',33,1,1,30000,30000,'2019-12-14 16:06:48'),(47,'12019120063',33,1,1,30000,30000,'2019-12-14 16:07:55'),(48,'12019120064',33,1,1,30000,30000,'2019-12-14 16:08:47'),(49,'12019120065',37,1,1,17000,17000,'2019-12-14 16:09:01'),(50,'12019120066',33,1,1,30000,30000,'2019-12-14 16:09:53'),(51,'12019120067',33,1,1,30000,30000,'2019-12-14 16:20:07');
/*!40000 ALTER TABLE `trans_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `view_master_stok`
--

DROP TABLE IF EXISTS `view_master_stok`;
/*!50001 DROP VIEW IF EXISTS `view_master_stok`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `view_master_stok` AS SELECT 
 1 AS `kode_m_kasir`,
 1 AS `kode_barang`,
 1 AS `stok`*/;
SET character_set_client = @saved_cs_client;

--
-- Dumping routines for database 'puji'
--

--
-- Final view structure for view `view_master_stok`
--

/*!50001 DROP VIEW IF EXISTS `view_master_stok`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_master_stok` AS select `m`.`kode_m_kasir` AS `kode_m_kasir`,`m`.`kode_barang` AS `kode_barang`,(sum(`m`.`stok`) - ifnull(sum(`t`.`qty`),0)) AS `stok` from (`master_stok_kasir` `m` left join `trans_detail` `t` on((`m`.`kode_m_kasir` = `t`.`kode_m_kasir`))) group by `m`.`kode_barang` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-12-15 12:50:52
