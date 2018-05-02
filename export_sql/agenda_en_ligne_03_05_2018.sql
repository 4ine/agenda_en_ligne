-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: agenda_en_ligne_v2
-- ------------------------------------------------------
-- Server version	5.7.19

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
-- Table structure for table `adresse`
--

DROP TABLE IF EXISTS `adresse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adresse` (
  `id_adresse` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `clients_id_client` int(10) unsigned NOT NULL,
  `rue` varchar(100) DEFAULT NULL,
  `code_postal` varchar(10) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `ville` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_adresse`),
  KEY `fk_adresse_clients_idx` (`clients_id_client`),
  CONSTRAINT `fk_adresse_clients` FOREIGN KEY (`clients_id_client`) REFERENCES `clients` (`id_client`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adresse`
--

LOCK TABLES `adresse` WRITE;
/*!40000 ALTER TABLE `adresse` DISABLE KEYS */;
INSERT INTO `adresse` VALUES (2,13,'chemin Duhem','7782','14','Ploegsteert'),(3,13,'rangÃ©e Dumez','7782','19','Bizet');
/*!40000 ALTER TABLE `adresse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id_client` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  `prenom` varchar(45) NOT NULL,
  `genre` int(11) NOT NULL,
  `date_de_naissance` date DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `date_creation` datetime DEFAULT NULL,
  `date_maj` datetime DEFAULT NULL,
  PRIMARY KEY (`id_client`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (13,'Thomass','Gillian',0,'1988-10-19','non.leo.Vivamus@congue.co.uk','06 82 46 29 52','1988-10-18 00:00:00','1988-10-18 00:00:00'),(14,'Magee','Libby',7,'1944-03-23','mauris.a@facilisis.com','05 29 63 34 95',NULL,NULL),(15,'Kylee','Heidi',1,'1954-08-07','eleifend.nec.malesuada@molestiedapibusligula.co.uk','03 59 81 56 85',NULL,NULL),(16,'Lewis','Faith',1,'1940-11-18','neque@malesuadaaugueut.edu','06 93 68 59 82',NULL,NULL),(17,'May','Shad',9,'1932-07-27','pede.malesuada@sodales.co.uk','06 42 69 26 70',NULL,NULL),(18,'Damian','Miriam',2,'1975-11-19','in.magna@eratSed.edu','09 47 04 69 49',NULL,NULL),(19,'Nathaniel','Charity',2,'1938-10-05','orci@ullamcorpermagnaSed.com','09 67 16 99 20',NULL,NULL),(20,'Mari','Yoko',2,'1972-01-27','elit.erat.vitae@inceptoshymenaeosMauris.edu','04 05 58 10 48',NULL,NULL),(21,'Brooke','Chanda',1,'1954-05-10','Nullam.nisl.Maecenas@Pellentesqueultriciesdignissim.net','05 88 84 87 58',NULL,NULL),(22,'Jared','Kane',1,'1942-01-20','urna.nec.luctus@vellectus.net','04 63 63 03 51',NULL,NULL),(23,'Quon','Dacey',2,'1945-03-19','facilisis.non.bibendum@at.co.uk','05 17 09 52 92',NULL,NULL),(24,'Kylan','Arsenio',1,'1978-12-31','vulputate.dui.nec@dictum.net','01 25 47 43 51',NULL,NULL),(25,'Walker','Deirdre',2,'1945-07-27','sapien@nibhQuisque.co.uk','06 08 23 31 54',NULL,NULL),(26,'Rosalyn','Hermione',2,'1955-05-24','amet.orci.Ut@imperdietnecleo.com','09 81 24 59 12',NULL,NULL),(27,'Nathaniel','Nero',1,'1975-01-09','eget.magna.Suspendisse@dui.net','05 41 38 93 25',NULL,NULL),(28,'Abdul','Elijah',1,'1979-06-14','ultrices@sodalesnisimagna.ca','06 11 89 84 50',NULL,NULL),(29,'Darius','Hermione',2,'1950-06-27','aptent@sit.org','07 35 26 61 57',NULL,NULL),(30,'Alisa','Eliana',2,'1941-12-20','Donec@sociisnatoque.net','05 80 70 82 88',NULL,NULL),(31,'Aidan','Vielka',1,'1993-07-18','lectus.quis.massa@temporbibendum.com','04 75 94 49 46',NULL,NULL),(32,'Gretchen','Oleg',2,'1967-01-01','facilisis.eget.ipsum@est.co.uk','08 35 37 89 41',NULL,NULL),(33,'Damian','Meghan',2,'1976-09-05','tellus.sem.mollis@Nullafacilisi.net','01 84 56 80 41',NULL,NULL),(34,'Shaine','Byron',1,'1967-01-15','nibh@nequeNullam.com','06 45 90 79 67',NULL,NULL),(35,'Tara','Ezekiel',1,'1935-03-23','litora.torquent@nonummyac.co.uk','05 46 53 60 10',NULL,NULL),(36,'Kirby','Amanda',1,'1936-09-12','sodales.Mauris.blandit@ultrices.com','03 93 51 40 39',NULL,NULL),(37,'Quintessa','Imani',2,'1956-06-23','Nunc@nectempusmauris.net','04 26 83 54 72',NULL,NULL),(38,'Irma','Brielle',1,'1988-06-08','elit.sed.consequat@at.com','03 10 13 59 68',NULL,NULL),(39,'Ginger','Wang',1,'1960-02-18','natoque.penatibus@ProinmiAliquam.ca','02 43 36 91 48',NULL,NULL),(40,'Perry','Chloe',2,'1994-12-28','euismod.est@turpisegestasAliquam.co.uk','03 99 20 55 57',NULL,NULL),(41,'Damian','India',1,'1946-11-22','vel.est.tempor@mauris.com','09 85 48 44 09',NULL,NULL),(42,'Kirk','Vaughan',1,'1975-02-05','non.feugiat.nec@liberomauris.edu','01 09 70 17 00',NULL,NULL),(43,'Owen','Keely',2,'1939-12-06','id@arcu.edu','03 09 82 58 67',NULL,NULL),(44,'Zachery','Lee',1,'1967-04-23','convallis@dapibusquamquis.co.uk','01 13 25 82 94',NULL,NULL),(45,'Quin','Shay',2,'1984-01-27','vitae@consectetueradipiscingelit.org','06 10 46 25 64',NULL,NULL),(46,'Galvin','Castor',2,'1937-12-03','vehicula.et@ametfaucibusut.org','09 21 03 99 99',NULL,NULL),(47,'Cherokee','Zachary',2,'1979-01-27','luctus.ut@vestibulumloremsit.ca','02 79 55 54 68',NULL,NULL),(48,'Sonia','Walter',1,'1932-01-20','urna.Nunc.quis@egestas.ca','06 41 13 30 65',NULL,NULL),(49,'Hamilton','Jael',2,'1997-05-06','ligula.elit.pretium@sapien.edu','09 44 39 40 17',NULL,NULL),(50,'Kristen','Cedric',1,'1945-09-27','lacus.Mauris.non@etrutrumeu.edu','09 70 98 12 69',NULL,NULL),(51,'Lunea','Cynthia',1,'1965-08-27','euismod.est@purus.edu','08 35 70 17 30',NULL,NULL),(52,'Guy','Graiden',2,'1976-05-05','justo.faucibus.lectus@miloremvehicula.co.uk','08 94 58 11 72',NULL,NULL),(53,'Serina','Naida',2,'1990-12-05','mi@eleifendnuncrisus.edu','04 92 95 97 79',NULL,NULL),(54,'Cara','Danielle',2,'1951-03-04','Nunc.laoreet@ligula.ca','05 53 80 24 07',NULL,NULL),(55,'Gabriel','Jael',2,'1982-09-26','Mauris.blandit.enim@lobortisquam.edu','02 01 43 01 12',NULL,NULL),(56,'Vera','Charles',2,'1956-04-09','diam.Proin@convallisest.co.uk','09 75 16 76 18',NULL,NULL),(57,'Josephine','Casey',2,'1950-12-31','penatibus.et@elitpretium.org','01 08 76 04 20',NULL,NULL),(58,'Bevis','MacKensie',1,'1992-12-28','montes.nascetur@sem.com','09 93 49 16 46',NULL,NULL),(59,'Erin','Kim',1,'1972-11-21','egestas.Duis@Nullam.com','06 20 00 20 78',NULL,NULL),(60,'Irene','Georgia',2,'1965-01-15','eu@vehiculaPellentesquetincidunt.co.uk','01 12 71 20 49',NULL,NULL),(61,'Branden','Logan',2,'1987-03-14','taciti.sociosqu.ad@sed.org','05 85 09 64 45',NULL,NULL),(62,'Alice','Lawrence',2,'1994-12-22','blandit@tortor.edu','07 63 08 44 59',NULL,NULL),(63,'Kitra','Maris',1,'1974-06-21','Pellentesque.tincidunt@Donecegestas.edu','08 37 07 54 87',NULL,NULL),(64,'Cally','Marah',1,'1949-02-24','Maecenas@necorciDonec.co.uk','01 28 57 24 48',NULL,NULL),(65,'Bruce','Mannix',1,'1935-01-26','fringilla@interdumlibero.edu','05 75 70 75 43',NULL,NULL),(66,'Linus','Kevin',1,'1939-09-18','tempus.risus.Donec@augueid.com','01 17 21 95 73',NULL,NULL),(67,'Kathleen','Kimberley',2,'1994-01-19','mi.lorem@volutpatNullafacilisis.edu','04 18 77 22 79',NULL,NULL),(68,'Kasper','Brian',2,'1967-12-14','dolor.dolor@vehiculaaliquet.co.uk','04 87 00 44 19',NULL,NULL),(69,'Garrett','Henry',2,'1943-06-12','lacus@nuncsitamet.co.uk','03 86 20 57 92',NULL,NULL),(70,'Tatiana','Peter',2,'1937-08-09','ac.mattis.ornare@lobortisquam.com','08 02 09 56 65',NULL,NULL),(71,'Dean','Macey',1,'1994-12-29','ac.metus@Crasvehiculaaliquet.ca','04 04 37 64 78',NULL,NULL),(72,'Laura','Tasha',1,'1981-01-05','eros.Nam@aptenttaciti.com','03 43 27 89 06',NULL,NULL),(73,'Baxter','Dawn',1,'1972-05-10','bibendum.sed.est@vitaepurus.net','07 66 72 65 61',NULL,NULL),(74,'Brenda','Murphy',2,'1968-03-21','ipsum.dolor@adipiscingenim.com','08 80 92 25 70',NULL,NULL),(75,'Jameson','Kirsten',1,'1970-02-03','ornare@metusurna.net','01 39 94 23 03',NULL,NULL),(76,'Rose','Daryl',1,'1942-03-25','congue.a@et.edu','07 90 05 83 13',NULL,NULL),(77,'Maxine','Sierra',1,'1950-02-24','ac@Classaptenttaciti.com','06 96 20 07 51',NULL,NULL),(78,'Dorothy','Rebekah',2,'1950-08-06','dolor.tempus@vestibulumneque.edu','07 15 23 19 63',NULL,NULL),(79,'Karly','Melvin',1,'1971-01-19','Cum.sociis.natoque@pellentesque.net','09 87 88 61 61',NULL,NULL),(80,'Macon','Margaret',2,'1998-07-28','nulla.Integer@neque.org','05 81 52 73 60',NULL,NULL),(81,'Kylan','Sawyer',2,'1975-08-19','magnis.dis@lectusNullamsuscipit.ca','02 10 84 35 77',NULL,NULL),(82,'Venus','Hadassah',2,'1954-02-11','magnis.dis@sedtortor.com','04 40 71 19 19',NULL,NULL),(83,'Alea','Abel',2,'1959-12-23','elit.Etiam@Namacnulla.com','07 69 74 44 24',NULL,NULL),(84,'Brenden','Adena',2,'1971-01-13','pharetra.Quisque.ac@Donec.ca','09 36 09 98 66',NULL,NULL),(85,'Remedios','Martin',1,'1970-04-15','id.sapien@arcuSedet.net','05 70 64 84 95',NULL,NULL),(86,'Kyra','Craig',2,'1991-07-22','neque.pellentesque@maurisanunc.ca','01 90 32 63 55',NULL,NULL),(87,'Phillip','Helen',2,'1950-03-01','Quisque.libero.lacus@nuncest.edu','08 48 54 93 86',NULL,NULL),(88,'Cameron','Craig',1,'1967-08-08','iaculis@Pellentesque.co.uk','08 90 64 44 47',NULL,NULL),(89,'Indigo','Lilah',1,'1953-09-15','et.nunc.Quisque@elementumpurus.com','04 46 70 31 21',NULL,NULL),(90,'Andrew','Destiny',2,'1949-04-03','dui.nec@vulputatenisi.net','08 11 10 69 90',NULL,NULL),(91,'Sheila','Yoshio',2,'1966-02-13','Donec.sollicitudin@ametmassa.edu','03 85 86 48 63',NULL,NULL),(92,'Jenette','Jada',2,'1954-06-05','mi@Donecluctusaliquet.ca','03 43 73 64 56',NULL,NULL),(93,'Mara','Daphne',2,'1944-09-30','luctus.ipsum.leo@mattisvelitjusto.org','03 57 96 23 98',NULL,NULL),(94,'Jamalia','Neville',1,'1953-12-06','augue@Aliquamvulputate.com','04 42 60 58 73',NULL,NULL),(95,'Keith','Iona',1,'1961-10-08','ultrices.sit@hendrerit.ca','04 52 78 42 83',NULL,NULL),(96,'Lawrence','Yolanda',2,'1967-12-10','Fusce.fermentum@tellusnon.net','01 56 36 22 74',NULL,NULL),(97,'Daphne','Julian',2,'1992-08-26','mauris.rhoncus@tellusnonmagna.net','03 95 44 66 51',NULL,NULL),(98,'Clare','Barrett',2,'1998-12-02','elit@luctuslobortisClass.org','03 98 92 56 25',NULL,NULL),(99,'Berk','Kasimir',1,'1961-06-01','enim.sit.amet@Class.ca','02 92 57 44 12',NULL,NULL),(100,'Libby','Carolyn',1,'1934-01-05','dignissim.lacus.Aliquam@eget.co.uk','06 74 14 01 31',NULL,NULL),(112,'Romain','Bernad',2,'1989-02-24','romain.bernad@gmail.com','0565065065',NULL,NULL);
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 trigger histo_insert_client
	after insert on `clients` for each row
    begin
		insert into histo (date_action, haction, htable, raw) values
        (now(), 'add', 'clients', 
        JSON_OBJECT(
        'id_client', NEW.id_client,
        'nom', NEW.nom,
        'prenom', NEW.prenom,
        'genre', NEW.genre,
        'date_de_naissance', NEW.date_de_naissance, 
		'email', NEW.email,
        'telephone', NEW.telephone
        ));
    end */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 trigger histo_update_client
	after update on `clients` for each row
    begin
		insert into histo (date_action, haction, htable, raw) values
        (now(), 'update', 'clients',
        JSON_OBJECT(
        'id_client', NEW.id_client,
        'nom', NEW.nom,
        'prenom', NEW.prenom,
        'genre', NEW.genre,
        'date_de_naissance', NEW.date_de_naissance,
		'email', NEW.email,
        'telephone', NEW.telephone
        ));
    end */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `histo`
--

DROP TABLE IF EXISTS `histo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `histo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_action` datetime NOT NULL,
  `haction` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `htable` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_client` int(10) unsigned DEFAULT NULL,
  `raw` json DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ref_client_histo_idx` (`id_client`),
  CONSTRAINT `dffdfd` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id_client`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `histo`
--

LOCK TABLES `histo` WRITE;
/*!40000 ALTER TABLE `histo` DISABLE KEYS */;
/*!40000 ALTER TABLE `histo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rdv`
--

DROP TABLE IF EXISTS `rdv`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rdv` (
  `id_rdv` int(11) NOT NULL AUTO_INCREMENT,
  `clients_id_client` int(10) unsigned NOT NULL,
  `date_rdv` datetime DEFAULT NULL,
  `commentaire` text,
  PRIMARY KEY (`id_rdv`),
  KEY `fk_rdv_clients1_idx` (`clients_id_client`),
  CONSTRAINT `fk_rdv_clients1` FOREIGN KEY (`clients_id_client`) REFERENCES `clients` (`id_client`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rdv`
--

LOCK TABLES `rdv` WRITE;
/*!40000 ALTER TABLE `rdv` DISABLE KEYS */;
/*!40000 ALTER TABLE `rdv` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type_prestation`
--

DROP TABLE IF EXISTS `type_prestation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type_prestation` (
  `id_type_prestation` int(11) NOT NULL AUTO_INCREMENT,
  `rdv_id_rdv` int(11) NOT NULL,
  `temps_prestation` time NOT NULL,
  `description` varchar(45) NOT NULL,
  `prix` float NOT NULL,
  PRIMARY KEY (`id_type_prestation`),
  KEY `fk_type_prestation_rdv1_idx` (`rdv_id_rdv`),
  CONSTRAINT `fk_type_prestation_rdv1` FOREIGN KEY (`rdv_id_rdv`) REFERENCES `rdv` (`id_rdv`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type_prestation`
--

LOCK TABLES `type_prestation` WRITE;
/*!40000 ALTER TABLE `type_prestation` DISABLE KEYS */;
/*!40000 ALTER TABLE `type_prestation` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-02 22:51:58
