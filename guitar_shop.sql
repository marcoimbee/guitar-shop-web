-- Progettazione Web 
DROP DATABASE if exists guitar_shop; 
CREATE DATABASE guitar_shop; 
USE guitar_shop; 
-- MySQL dump 10.13  Distrib 5.6.20, for Win32 (x86)
--
-- Host: localhost    Database: guitar_shop
-- ------------------------------------------------------
-- Server version	5.6.20

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
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account` (
  `ID` int(7) NOT NULL AUTO_INCREMENT,
  `Name` varchar(30) NOT NULL,
  `Surname` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Address` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `credit_card`
--

DROP TABLE IF EXISTS `credit_card`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `credit_card` (
  `ID` int(7) NOT NULL AUTO_INCREMENT,
  `Account_FK` int(7) NOT NULL,
  `Number` int(30) DEFAULT NULL,
  `Owner` varchar(50) NOT NULL,
  `Expiration` date NOT NULL,
  `Security_code` int(7) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `account_credit` (`Account_FK`),
  CONSTRAINT `account_credit` FOREIGN KEY (`Account_FK`) REFERENCES `account` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `ID` int(5) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) DEFAULT NULL,
  `Type` varchar(1) DEFAULT NULL,
  `Price` float DEFAULT NULL,
  `Amount` int(4) DEFAULT NULL,
  `Description` varchar(500) DEFAULT NULL,
  `Image` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'X Series Concert Bass CBXNT DX IV','B',649.99,13,'The all-new Jackson X Series Concert Bass CBXNT DX IV is a highly versatile bass designed for one express purpose:bringing the thunder to your music. Upgraded electronics, classically brutal style and fast, efficient playability make this entry into the lineup a fundamental force to be reckoned with. Perfect for rock or metal:or other styles that demand low, punchy bass:this instrument is an unbelievable value.','../images/products/basses/bass1.png'),(3,'X SERIES SIGNATURE DAVID ELLEFSON KELLY BIRD IV B','B',499.99,15,'Bassist David Ellefson has reigned as a titan of thrash bass, garnering worldwide acclaim as a co-founding member of “Big Four” thrash innovator Megadeth and for his fleet-fingered, hard-hitting style and versatility. Simply put, nobody shreds a bass like Ellefson, and Jackson is proud to have his name on several formidable bass models, including this affordably priced X Series Signature David Ellefson Kelly Bird IV Bass.','../images/products/basses/bass3.png'),(4,'X SERIES SPECTRA BASS SBXQ V','B',799.99,15,'With modern style, flexible tone and incomparable value, the Jackson X Series Spectra Bass SBXQ V takes the adventurous player on a bold bass odyssey, launching a commanding all-new entry in Jackson’s formidable neck-through-body bass lineup.','../images/products/basses/bass4.png'),(5,'JS SERIES CONCERT BASS JS3','B',299.99,14,'The Concert Bass JS3 is a four-string, 34”-scale model featuring a lightweight and resonant poplar body, bolt-on maple neck with graphite reinforcement and a 12”-16” compound radius bound amaranth fingerboard with 24 jumbo frets and pearloid sharkfin inlays.','../images/products/basses/bass5.png'),(22,'X SERIES RHOADS RRX24 CAMO','G',799.99,15,'Jackson X Series Rhoads models continue the metal legacy pioneered by the immortal Randy Rhoads. Regal and proud, the all-new Jackson X Series Rhoads RRX24 Camo offers fantastic tone, ultra-fast playability and unbelievable value for 21st century guitarists.','../images/products/guitars/guitar4.png'),(23,'X SERIES SOLOIST SLX DX CAMO','G',849.99,14,'Distinctive and affordable, Jackson’s X Series Soloist models are built for speed and comfort! The Jackson X Series Soloist SLX DX Camo is a venerable double-cutaway workhorse that offers many fine features desired by today is shredders.','../images/products/guitars/guitar7.png'),(24,'X SERIES SOLOIST SLX DX','G',599.99,15,'Distinctive and affordable, Jackson’s X Series Soloist models are built for speed and comfort! The X Series Soloist SLX DX is a venerable double cutaway workhorse that offers many fine features desired by today is shredders.','../images/products/guitars/guitar12.png'),(25,'JS SERIES RR MINION JS1X','G',189.99,15,'With its 2/3 scale length (22.5”), the Jackson JS Series RR Minion JS1X is perfect for little shredders or grownup road dogs who need an easy-traveling instrument jam-packed with the features they love.','../images/products/guitars/guitar3.png'),(26,'USA SIGNATURE ADRIAN SMITH SAN DIMAS SDM','G',2699.99,14,'Iron Maiden is one of the most successful and influential metal bands ever, and Adrian Smith’s molten yet melodic guitar work has long been a driving force behind their distinctive and dynamic sound. With timeless songwriting and thrilling live performances, Maiden continues to record, tour internationally and rock stadiums everywhere with electrifying prowess and unwavering heavy metal passion.','../images/products/guitars/guitar14.png'),(27,'PRO SERIES SIGNATURE PHIL DEMMEL DEMMELITION FURY ','G',799.99,15,'For more than 15 years, lead guitarist Phil Demmel contributed his hard-hitting, lightning-fast licks to thrash-and-groove metal outfit Machine Head. As Demmel forges ahead to his next chapter, he’ll be well-armed with the all-new Pro Series Signature Demmelition Fury PD : an affordable no-holds-barred metal axe that can hang with everything Demmel throws its way.','../images/products/guitars/guitar6.png');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shopping_cart`
--

DROP TABLE IF EXISTS `shopping_cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shopping_cart` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `ID_user` int(7) NOT NULL,
  `ID_product` int(4) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `account_constraint` (`ID_user`),
  KEY `product_constraint` (`ID_product`),
  CONSTRAINT `account_constraint` FOREIGN KEY (`ID_user`) REFERENCES `account` (`ID`),
  CONSTRAINT `product_constraint` FOREIGN KEY (`ID_product`) REFERENCES `product` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shopping_cart`
--

LOCK TABLES `shopping_cart` WRITE;
/*!40000 ALTER TABLE `shopping_cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `shopping_cart` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-06-12 10:30:25
