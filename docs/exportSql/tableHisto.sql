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
  `raw` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
