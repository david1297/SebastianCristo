-- MySQL dump 10.13  Distrib 8.0.18, for macos10.14 (x86_64)
--
-- Host: 127.0.0.1    Database: sebastian
-- ------------------------------------------------------
-- Server version	8.0.18

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `citas`
--

DROP TABLE IF EXISTS `citas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `citas` (
  `Numero` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time DEFAULT NULL,
  `Cliente` varchar(50) DEFAULT NULL,
  `Usuario` varchar(30) DEFAULT NULL,
  `Descripcion` varchar(10000) DEFAULT NULL,
  `Direccion` varchar(100) DEFAULT NULL,
  `Estado` varchar(45) DEFAULT NULL,
  `FechaCreacion` date DEFAULT NULL,
  `Respuesta` varchar(1000) DEFAULT NULL,
  `Asignado` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`Numero`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citas`
--

LOCK TABLES `citas` WRITE;
/*!40000 ALTER TABLE `citas` DISABLE KEYS */;
INSERT INTO `citas` VALUES (1,'2019-12-15','08:30:00','1234','1112492933','Cita','Ddd','Programada','2019-12-15','','123456789'),(2,'2019-12-16','14:30:00','1234','1112492933','Cita redes sociales','Ddd','Realizada','2019-12-16','','123456789'),(3,'2019-12-09','10:00:00','321654','1112492933','Cita para consulta de Marketing','carrera 95 # 2b 13','Programada','2019-12-06','','123456789');
/*!40000 ALTER TABLE `citas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ciudades`
--

DROP TABLE IF EXISTS `ciudades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ciudades` (
  `Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `Departamento` int(11) NOT NULL,
  `Nombre` varchar(200) NOT NULL,
  PRIMARY KEY (`Codigo`),
  KEY `Departamento` (`Departamento`),
  CONSTRAINT `ciudades_ibfk_1` FOREIGN KEY (`Departamento`) REFERENCES `departamentos` (`Codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=1128 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ciudades`
--

LOCK TABLES `ciudades` WRITE;
/*!40000 ALTER TABLE `ciudades` DISABLE KEYS */;
INSERT INTO `ciudades` VALUES (4,1,'El Encanto'),(5,1,'La Chorrera'),(6,1,'La Pedrera'),(7,1,'La Victoria'),(8,1,'Leticia'),(9,1,'Mirití-Paraná'),(10,1,'Puerto Alegría'),(11,1,'Puerto Arica'),(12,1,'Puerto Nariño'),(13,1,'Puerto Santander'),(14,1,'Tarapacá'),(15,2,'Cáceres'),(16,2,'Caucasia'),(17,2,'El Bagre'),(18,2,'Nechí'),(19,2,'Tarazá'),(20,2,'Zaragoza'),(21,2,'Caracolí'),(22,2,'Maceo'),(23,2,'Puerto Berrío'),(24,2,'Puerto Nare'),(25,2,'Puerto Triunfo'),(26,2,'Yondó'),(27,2,'Amalfi'),(28,2,'Anorí'),(29,2,'Cisneros'),(30,2,'Remedios'),(31,2,'San Roque'),(32,2,'Santo Domingo'),(33,2,'Segovia'),(34,2,'Vegachí'),(35,2,'Yalí'),(36,2,'Yolombó'),(37,2,'Angostura'),(38,2,'Belmira'),(39,2,'Briceño'),(40,2,'Campamento'),(41,2,'Carolina del Príncipe'),(42,2,'Donmatías'),(43,2,'Entrerríos'),(44,2,'Gómez Plata'),(45,2,'Guadalupe'),(46,2,'Ituango'),(47,2,'San Andrés de Cuerquia'),(48,2,'San José de la Montaña'),(49,2,'San Pedro de los Milagros'),(50,2,'Santa Rosa de Osos'),(51,2,'Toledo'),(52,2,'Valdivia'),(53,2,'Yarumal'),(54,2,'Abriaquí'),(55,2,'Antioquia'),(56,2,'Anzá'),(57,2,'Armenia'),(58,2,'Buriticá'),(59,2,'Caicedo'),(60,2,'Cañasgordas'),(61,2,'Dabeiba'),(62,2,'Ebéjico'),(63,2,'Frontino'),(64,2,'Giraldo'),(65,2,'Heliconia'),(66,2,'Liborina'),(67,2,'Olaya'),(68,2,'Peque'),(69,2,'Sabanalarga'),(70,2,'San Jerónimo'),(71,2,'Sopetrán'),(72,2,'Uramita'),(73,2,'Abejorral'),(74,2,'Alejandría'),(75,2,'Argelia'),(76,2,'El Carmen de Viboral'),(77,2,'Cocorná'),(78,2,'Concepción'),(79,2,'El Peñol'),(80,2,'El Retiro'),(81,2,'El Santuario'),(82,2,'Granada'),(83,2,'Guarne'),(84,2,'Guatapé'),(85,2,'La Ceja'),(86,2,'La Unión'),(87,2,'Marinilla'),(88,2,'Nariño'),(89,2,'Rionegro'),(90,2,'San Carlos'),(91,2,'San Francisco'),(92,2,'San Luis'),(93,2,'San Rafael'),(94,2,'San Vicente'),(95,2,'Sonsón'),(96,2,'Amagá'),(97,2,'Andes'),(98,2,'Angelópolis'),(99,2,'Betania'),(100,2,'Betulia'),(101,2,'Caramanta'),(102,2,'Ciudad Bolívar'),(103,2,'Concordia'),(104,2,'Fredonia'),(105,2,'Hispania'),(106,2,'Jardín'),(107,2,'Jericó'),(108,2,'La Pintada'),(109,2,'Montebello'),(110,2,'Pueblorrico'),(111,2,'Salgar'),(112,2,'Santa Bárbara'),(113,2,'Támesis'),(114,2,'Tarso'),(115,2,'Titiribí'),(116,2,'Urrao'),(117,2,'Valparaíso'),(118,2,'Venecia'),(119,2,'Apartadó'),(120,2,'Arboletes'),(121,2,'Carepa'),(122,2,'Chigorodó'),(123,2,'Murindó'),(124,2,'Mutatá'),(125,2,'Necoclí'),(126,2,'San Juan de Urabá'),(127,2,'San Pedro de Urabá'),(128,2,'Turbo'),(129,2,'Vigía del Fuerte'),(130,2,'Barbosa'),(131,2,'Bello'),(132,2,'Caldas'),(133,2,'Copacabana'),(134,2,'Envigado'),(135,2,'Girardota'),(136,2,'Itagüí'),(137,2,'La Estrella'),(138,2,'Medellín'),(139,2,'Sabaneta'),(140,3,'Arauca'),(141,3,'Arauquita'),(142,3,'Cravo Norte'),(143,3,'Fortul'),(144,3,'Puerto Rondón'),(145,3,'Saravena'),(146,3,'Tame'),(147,4,'Barranquilla'),(148,4,'Barranquilla'),(149,4,'Baranoa'),(150,4,'Campo de la Cruz'),(151,4,'Candelaria'),(152,4,'Galapa'),(153,4,'Juan de Acosta'),(154,4,'Luruaco'),(155,4,'Malambo'),(156,4,'Manatí'),(157,4,'Palmar de Varela'),(158,4,'Piojó'),(159,4,'Polonuevo'),(160,4,'Ponedera'),(161,4,'Puerto Colombia'),(162,4,'Repelón'),(163,4,'Sabanagrande'),(164,4,'Sabanalarga'),(165,4,'Santa Lucía'),(166,4,'Santo Tomás'),(167,4,'Soledad'),(168,4,'Suán'),(169,4,'Tubará'),(170,4,'Usiacurí'),(171,5,'Achí'),(172,5,'Altos del Rosario'),(173,5,'Arenal'),(174,5,'Arjona'),(175,5,'Arroyohondo'),(176,5,'Barranco de Loba'),(177,5,'Calamar'),(178,5,'Cantagallo'),(179,5,'El Carmen de Bolívar'),(180,5,'Cartagena de Indias'),(181,5,'Cicuco'),(182,5,'Clemencia'),(183,5,'Córdoba'),(184,5,'El Guamo'),(185,5,'El Peñón'),(186,5,'Hatillo de Loba'),(187,5,'Magangué'),(188,5,'Mahates'),(189,5,'Margarita'),(190,5,'María La Baja'),(191,5,'Montecristo'),(192,5,'Morales'),(193,5,'Norosí'),(194,5,'Pinillos'),(195,5,'Regidor'),(196,5,'Río Viejo'),(197,5,'San Cristóbal'),(198,5,'San Estanislao'),(199,5,'San Fernando'),(200,5,'San Jacinto'),(201,5,'San Jacinto del Cauca'),(202,5,'San Juan Nepomuceno'),(203,5,'San Martín de Loba'),(204,5,'San Pablo'),(205,5,'Santa Catalina'),(206,5,'Santa Cruz de Mompox'),(207,5,'Santa Rosa'),(208,5,'Santa Rosa del Sur'),(209,5,'Simití'),(210,5,'Soplaviento'),(211,5,'Talaigua Nuevo'),(212,5,'Tiquisio'),(213,5,'Turbaco'),(214,5,'Turbaná'),(215,5,'Villanueva'),(216,5,'Zambrano'),(217,6,'Chíquiza'),(218,6,'Chivatá'),(219,6,'Cómbita'),(220,6,'Cucaita'),(221,6,'Motavita'),(222,6,'Oicatá'),(223,6,'Samacá'),(224,6,'Siachoque'),(225,6,'Sora'),(226,6,'Soracá'),(227,6,'Sotaquirá'),(228,6,'Toca'),(229,6,'Tunja'),(230,6,'Tuta'),(231,6,'Ventaquemada'),(232,6,'Chiscas'),(233,6,'El Cocuy'),(234,6,'El Espino'),(235,6,'Guacamayas'),(236,6,'Güicán'),(237,6,'Panqueba'),(238,6,'Labranzagrande'),(239,6,'Pajarito'),(240,6,'Paya'),(241,6,'Pisba'),(242,6,'Berbeo'),(243,6,'Campohermoso'),(244,6,'Miraflores'),(245,6,'Páez'),(246,6,'San Eduardo'),(247,6,'Zetaquira'),(248,6,'Boyacá'),(249,6,'Ciénega'),(250,6,'Jenesano'),(251,6,'Nuevo Colón'),(252,6,'Ramiriquí'),(253,6,'Rondón'),(254,6,'Tibaná'),(255,6,'Turmequé'),(256,6,'Úmbita'),(257,6,'Viracachá'),(258,6,'Chinavita'),(259,6,'Garagoa'),(260,6,'Macanal'),(261,6,'Pachavita'),(262,6,'San Luis de Gaceno'),(263,6,'Santa María'),(264,6,'Boavita'),(265,6,'Covarachía'),(266,6,'La Uvita'),(267,6,'San Mateo'),(268,6,'Sativanorte'),(269,6,'Sativasur'),(270,6,'Soatá'),(271,6,'Susacón'),(272,6,'Tipacoque'),(273,6,'Briceño'),(274,6,'Buenavista'),(275,6,'Caldas'),(276,6,'Chiquinquirá'),(277,6,'Coper'),(278,6,'La Victoria'),(279,6,'Maripí'),(280,6,'Muzo'),(281,6,'Otanche'),(282,6,'Pauna'),(283,6,'Quípama'),(284,6,'Saboyá'),(285,6,'San Miguel de Sema'),(286,6,'San Pablo de Borbur'),(287,6,'Tununguá'),(288,6,'Almeida'),(289,6,'Chivor'),(290,6,'Guateque'),(291,6,'Guayatá'),(292,6,'La Capilla'),(293,6,'Somondoco'),(294,6,'Sutatenza'),(295,6,'Tenza'),(296,6,'Arcabuco'),(297,6,'Chitaraque'),(298,6,'Gachantivá'),(299,6,'Moniquirá'),(300,6,'Ráquira'),(301,6,'Sáchica'),(302,6,'San José de Pare'),(303,6,'Santa Sofía'),(304,6,'Santana'),(305,6,'Sutamarchán'),(306,6,'Tinjacá'),(307,6,'Togüí'),(308,6,'Villa de Leyva'),(309,6,'Aquitania'),(310,6,'Cuítiva'),(311,6,'Firavitoba'),(312,6,'Gámeza'),(313,6,'Iza'),(314,6,'Mongua'),(315,6,'Monguí'),(316,6,'Nobsa'),(317,6,'Pesca'),(318,6,'Sogamoso'),(319,6,'Tibasosa'),(320,6,'Tópaga'),(321,6,'Tota'),(322,6,'Belén'),(323,6,'Busbanzá'),(324,6,'Cerinza'),(325,6,'Corrales'),(326,6,'Duitama'),(327,6,'Floresta'),(328,6,'Paipa'),(329,6,'Santa Rosa de Viterbo'),(330,6,'Tutazá'),(331,6,'Betéitiva'),(332,6,'Chita'),(333,6,'Jericó'),(334,6,'Paz de Río'),(335,6,'Socha'),(336,6,'Socotá'),(337,6,'Tasco'),(338,6,'Cubará'),(339,6,'Puerto Boyacá'),(340,7,'Filadelfia'),(341,7,'La Merced'),(342,7,'Marmato'),(343,7,'Riosucio'),(344,7,'Supía'),(345,7,'Manzanares'),(346,7,'Marquetalia'),(347,7,'Marulanda'),(348,7,'Pensilvania'),(349,7,'Anserma'),(350,7,'Belalcázar'),(351,7,'Risaralda'),(352,7,'San José'),(353,7,'Viterbo'),(354,7,'Chinchiná'),(355,7,'Manizales'),(356,7,'Neira'),(357,7,'Palestina'),(358,7,'Villamaría'),(359,7,'La Dorada'),(360,7,'Norcasia'),(361,7,'Samaná'),(362,7,'Victoria'),(363,7,'Aguadas'),(364,7,'Aranzazu'),(365,7,'Pácora'),(366,7,'Salamina'),(367,8,'Albania'),(368,8,'Belén de los Andaquies'),(369,8,'Cartagena del Chairá'),(370,8,'Curillo'),(371,8,'El Doncello'),(372,8,'El Paujil'),(373,8,'Florencia'),(374,8,'La Montañita'),(375,8,'Morelia'),(376,8,'Puerto Milán'),(377,8,'Puerto Rico'),(378,8,'San José del Fragua'),(379,8,'San Vicente del Caguán'),(380,8,'Solano'),(381,8,'Solita'),(382,8,'Valparaíso'),(383,9,'Aguazul'),(384,9,'Chámeza'),(385,9,'Hato Corozal'),(386,9,'La Salina'),(387,9,'Maní'),(388,9,'Monterrey'),(389,9,'Nunchía'),(390,9,'Orocué'),(391,9,'Paz de Ariporo'),(392,9,'Pore'),(393,9,'Recetor'),(394,9,'Sabanalarga'),(395,9,'Sácama'),(396,9,'San Luis de Palenque'),(397,9,'Támara'),(398,9,'Tauramena'),(399,9,'Trinidad'),(400,9,'Villanueva'),(401,9,'Yopal'),(402,10,'Buenos Aires'),(403,10,'Caloto'),(404,10,'Corinto'),(405,10,'Guachené'),(406,10,'Miranda'),(407,10,'Padilla'),(408,10,'Puerto Tejada'),(409,10,'Santander de Quilichao'),(410,10,'Suárez'),(411,10,'Villa Rica'),(412,10,'Cajibío'),(413,10,'El Tambo'),(414,10,'La Sierra'),(415,10,'Morales'),(416,10,'Piendamó'),(417,10,'Popayán'),(418,10,'Rosas'),(419,10,'Sotará'),(420,10,'Timbío'),(421,10,'Almaguer'),(422,10,'Argelia'),(423,10,'Balboa'),(424,10,'Bolívar'),(425,10,'Florencia'),(426,10,'La Vega'),(427,10,'Mercaderes'),(428,10,'Patía'),(429,10,'Piamonte'),(430,10,'San Sebastián'),(431,10,'Santa Rosa'),(432,10,'Sucre'),(433,10,'Guapí'),(434,10,'López de Micay'),(435,10,'Timbiquí'),(436,10,'Caldono'),(437,10,'Inzá'),(438,10,'Jambaló'),(439,10,'Páez'),(440,10,'Puracé'),(441,10,'Silvia'),(442,10,'Toribío'),(443,10,'Totoró'),(444,11,'Valledupar'),(445,11,'Aguachica'),(446,11,'Agustín Codazzi'),(447,11,'Bosconia'),(448,11,'Chimichagua'),(449,11,'El Copey'),(450,11,'San Alberto'),(451,11,'Curumaní'),(452,11,'El Paso'),(453,11,'La Paz'),(454,11,'Pueblo Bello'),(455,11,'La Jagua de Ibirico'),(456,11,'Chiriguaná'),(457,11,'Astrea'),(458,11,'San Martín'),(459,11,'Pelaya'),(460,11,'Pailitas'),(461,11,'Gamarra'),(462,11,'Manaure Balcón del Cesar'),(463,11,'Río de Oro'),(464,11,'Tamalameque'),(465,11,'Becerril'),(466,11,'San Diego'),(467,11,'La Gloria'),(468,11,'González'),(469,12,'Acandí'),(470,12,'Alto Baudó'),(471,12,'Atrato'),(472,12,'Bagadó'),(473,12,'Bahía Solano'),(474,12,'Bajo Baudó'),(475,12,'Bojayá'),(476,12,'Cértegui'),(477,12,'Condoto'),(478,12,'El Cantón de San Pablo'),(479,12,'El Carmen de Atrato'),(480,12,'El Carmen del Darién'),(481,12,'El Litoral de San Juan'),(482,12,'Istmina'),(483,12,'Juradó'),(484,12,'Lloró'),(485,12,'Medio Atrato'),(486,12,'Medio Baudó'),(487,12,'Medio San Juan'),(488,12,'Nóvita'),(489,12,'Nuquí'),(490,12,'Quibdó'),(491,12,'Río Iró'),(492,12,'Río Quito'),(493,12,'Riosucio'),(494,12,'San José del Palmar'),(495,12,'Sipí'),(496,12,'Tadó'),(497,12,'Unguía'),(498,12,'Unión Panamericana'),(499,13,'Ayapel'),(500,13,'Buenavista'),(501,13,'Canalete'),(502,13,'Cereté'),(503,13,'Chimá'),(504,13,'Chinú'),(505,13,'Ciénaga de Oro'),(506,13,'Cotorra'),(507,13,'La Apartada'),(508,13,'Los Córdobas'),(509,13,'Momil'),(510,13,'Montelíbano'),(511,13,'Montería'),(512,13,'Moñitos'),(513,13,'Planeta Rica'),(514,13,'Pueblo Nuevo'),(515,13,'Puerto Escondido'),(516,13,'Puerto Libertador'),(517,13,'Purísima'),(518,13,'Sahagún'),(519,13,'San Andrés de Sotavento'),(520,13,'San Antero'),(521,13,'San Bernardo del Viento'),(522,13,'San Carlos'),(523,13,'San José de Uré'),(524,13,'San Pelayo'),(525,13,'Santa Cruz de Lorica'),(526,13,'Tierralta'),(527,13,'Tuchín'),(528,13,'Valencia'),(529,14,'Chocontá'),(530,14,'Machetá'),(531,14,'Manta'),(532,14,'Sesquilé'),(533,14,'Suesca'),(534,14,'Tibirita'),(535,14,'Villapinzón'),(536,14,'Agua de Dios'),(537,14,'Girardot'),(538,14,'Guataquí'),(539,14,'Jerusalén'),(540,14,'Nariño'),(541,14,'Nilo'),(542,14,'Ricaurte'),(543,14,'Tocaima'),(544,14,'Caparrapí'),(545,14,'Guaduas'),(546,14,'Puerto Salgar'),(547,14,'Albán'),(548,14,'La Peña'),(549,14,'La Vega'),(550,14,'Nimaima'),(551,14,'Nocaima'),(552,14,'Quebradanegra'),(553,14,'San Francisco'),(554,14,'Sasaima'),(555,14,'Supatá'),(556,14,'Útica'),(557,14,'Vergara'),(558,14,'Villeta'),(559,14,'Gachalá'),(560,14,'Gachetá'),(561,14,'Gama'),(562,14,'Guasca'),(563,14,'Guatavita'),(564,14,'Junín'),(565,14,'La Calera'),(566,14,'Ubalá'),(567,14,'Beltrán'),(568,14,'Bituima'),(569,14,'Chaguaní'),(570,14,'Guayabal de Síquima'),(571,14,'Pulí'),(572,14,'San Juan de Rioseco'),(573,14,'Vianí'),(574,14,'Medina'),(575,14,'Paratebueno'),(576,14,'Cáqueza'),(577,14,'Chipaque'),(578,14,'Choachí'),(579,14,'Fómeque'),(580,14,'Fosca'),(581,14,'Guayabetal'),(582,14,'Gutiérrez'),(583,14,'Quetame'),(584,14,'Ubaque'),(585,14,'Une'),(586,14,'El Peñón'),(587,14,'La Palma'),(588,14,'Pacho'),(589,14,'Paime'),(590,14,'San Cayetano'),(591,14,'Topaipí'),(592,14,'Villagómez'),(593,14,'Yacopí'),(594,14,'Cajicá'),(595,14,'Chía'),(596,14,'Cogua'),(597,14,'Cota'),(598,14,'Gachancipá'),(599,14,'Nemocón'),(600,14,'Sopó'),(601,14,'Tabio'),(602,14,'Tenjo'),(603,14,'Tocancipá'),(604,14,'Zipaquirá'),(605,14,'Bojacá'),(606,14,'El Rosal'),(607,14,'Facatativá'),(608,14,'Funza'),(609,14,'Madrid'),(610,14,'Mosquera'),(611,14,'Subachoque'),(612,14,'Zipacón'),(613,14,'Sibaté'),(614,14,'Soacha'),(615,14,'Arbeláez'),(616,14,'Cabrera'),(617,14,'Fusagasugá'),(618,14,'Granada'),(619,14,'Pandi'),(620,14,'Pasca'),(621,14,'San Bernardo'),(622,14,'Silvania'),(623,14,'Tibacuy'),(624,14,'Venecia'),(625,14,'Anapoima'),(626,14,'Anolaima'),(627,14,'Apulo'),(628,14,'Cachipay'),(629,14,'El Colegio'),(630,14,'La Mesa'),(631,14,'Quipile'),(632,14,'San Antonio del Tequendama'),(633,14,'Tena'),(634,14,'Viotá'),(635,14,'Carmen de Carupa'),(636,14,'Cucunubá'),(637,14,'Fúquene'),(638,14,'Guachetá'),(639,14,'Lenguazaque'),(640,14,'Simijaca'),(641,14,'Susa'),(642,14,'Sutatausa'),(643,14,'Tausa'),(644,14,'Ubaté'),(645,15,'Barrancominas'),(646,15,'Cacahual'),(647,15,'Inírida'),(648,15,'La Guadalupe'),(649,15,'Mapiripana'),(650,15,'Morichal Nuevo'),(651,15,'Pana Pana'),(652,15,'Puerto Colombia'),(653,15,'San Felipe'),(654,16,'Calamar'),(655,16,'El Retorno'),(656,16,'Miraflores'),(657,16,'La San José del Guaviare'),(658,17,'Aipe'),(659,17,'Algeciras'),(660,17,'Baraya'),(661,17,'Campoalegre'),(662,17,'Colombia'),(663,17,'Hobo'),(664,17,'Íquira'),(665,17,'Neiva'),(666,17,'Palermo'),(667,17,'Rivera'),(668,17,'Santa María'),(669,17,'Tello'),(670,17,'Teruel'),(671,17,'Villavieja'),(672,17,'Yaguará'),(673,17,'Agrado'),(674,17,'Altamira'),(675,17,'Garzón'),(676,17,'Gigante'),(677,17,'Guadalupe'),(678,17,'Pital'),(679,17,'Suaza'),(680,17,'Tarqui'),(681,17,'La Argentina'),(682,17,'La Plata'),(683,17,'Nátaga'),(684,17,'Paicol'),(685,17,'Tesalia'),(686,17,'Acevedo'),(687,17,'Elías'),(688,17,'Isnos'),(689,17,'Oporapa'),(690,17,'Palestina'),(691,17,'Pitalito'),(692,17,'Saladoblanco'),(693,17,'San Agustín'),(694,17,'Timaná'),(695,18,'Albania'),(696,18,'Barrancas'),(697,18,'Dibulla'),(698,18,'Distracción'),(699,18,'El Molino'),(700,18,'Fonseca'),(701,18,'Hatonuevo'),(702,18,'La Jagua del Pilar'),(703,18,'Maicao'),(704,18,'Manaure'),(705,18,'Riohacha'),(706,18,'San Juan del Cesar'),(707,18,'Uribia'),(708,18,'Urumita'),(709,18,'Villanueva'),(710,19,'Algarrobo'),(711,19,'Aracataca'),(712,19,'Ariguaní'),(713,19,'Cerro de San Antonio'),(714,19,'Chibolo'),(715,19,'Ciénaga'),(716,19,'Concordia'),(717,19,'El Banco'),(718,19,'El Piñón'),(719,19,'El Retén'),(720,19,'Fundación'),(721,19,'Guamal'),(722,19,'Nueva Granada'),(723,19,'Pedraza'),(724,19,'Pijiño del Carmen'),(725,19,'Pivijay'),(726,19,'Plato'),(727,19,'Pueblo Viejo'),(728,19,'Remolino'),(729,19,'Sabanas de San Ángel'),(730,19,'Salamina'),(731,19,'San Sebastián de Buenavista'),(732,19,'Santa Ana'),(733,19,'Santa Bárbara de Pinto'),(734,19,'Santa Marta'),(735,19,'San Zenón'),(736,19,'Sitionuevo'),(737,19,'Tenerife'),(738,19,'Zapayán'),(739,19,'Zona Bananera'),(740,20,'Acacías'),(741,20,'Barranca de Upía'),(742,20,'Cabuyaro'),(743,20,'Castilla La Nueva'),(744,20,'Cubarral'),(745,20,'Cumaral'),(746,20,'El Calvario'),(747,20,'El Castillo'),(748,20,'El Dorado'),(749,20,'Fuente de Oro'),(750,20,'Granada'),(751,20,'Guamal'),(752,20,'La Macarena'),(753,20,'La Uribe'),(754,20,'Lejanías'),(755,20,'Mapiripán'),(756,20,'Mesetas'),(757,20,'Puerto Concordia'),(758,20,'Puerto Gaitán'),(759,20,'Puerto Lleras'),(760,20,'Puerto López'),(761,20,'Puerto Rico'),(762,20,'Restrepo'),(763,20,'San Carlos de Guaroa'),(764,20,'San Juan de Arama'),(765,20,'San Juanito'),(766,20,'San Martín'),(767,20,'Villavicencio'),(768,20,'Vista Hermosa'),(769,21,'Barbacoas'),(770,21,'El Charco'),(771,21,'Francisco Pizarro'),(772,21,'La Tola'),(773,21,'Magüí Payán'),(774,21,'Mosquera'),(775,21,'Olaya Herrera'),(776,21,'Roberto Payán'),(777,21,'Santa Bárbara'),(778,21,'Tumaco'),(779,21,'Aldana'),(780,21,'Contadero'),(781,21,'Córdoba'),(782,21,'Cuaspud'),(783,21,'Cumbal'),(784,21,'Funes'),(785,21,'Guachucal'),(786,21,'Gualmatán'),(787,21,'Iles'),(788,21,'Ipiales'),(789,21,'Potosí'),(790,21,'Puerres'),(791,21,'Pupiales'),(792,21,'Albán'),(793,21,'Arboleda'),(794,21,'Belén'),(795,21,'Colón'),(796,21,'El Rosario'),(797,21,'El Tablón de Gómez'),(798,21,'La Cruz'),(799,21,'La Unión'),(800,21,'Leiva'),(801,21,'Policarpa'),(802,21,'San Bernardo'),(803,21,'San Lorenzo'),(804,21,'San Pablo'),(805,21,'San Pedro de Cartago'),(806,21,'Taminango'),(807,21,'Buesaco'),(808,21,'Chachagüí'),(809,21,'Consacá'),(810,21,'El Peñol'),(811,21,'El Tambo'),(812,21,'La Florida'),(813,21,'Nariño'),(814,21,'Pasto'),(815,21,'Sandoná'),(816,21,'Tangua'),(817,21,'Yacuanquer'),(818,21,'Ancuya'),(819,21,'Cumbitara'),(820,21,'Guaitarilla'),(821,21,'Imués'),(822,21,'La Llanada'),(823,21,'Linares'),(824,21,'Los Andes'),(825,21,'Mallama'),(826,21,'Ospina'),(827,21,'Providencia'),(828,21,'Ricaurte'),(829,21,'Samaniego'),(830,21,'Santacruz'),(831,21,'Sapuyes'),(832,21,'Túquerres'),(833,22,'Arboledas'),(834,22,'Cucutilla'),(835,22,'Gramalote'),(836,22,'Lourdes'),(837,22,'Salazar de Las Palmas'),(838,22,'Santiago'),(839,22,'Villa Caro'),(840,22,'Cúcuta'),(841,22,'El Zulia'),(842,22,'Los Patios'),(843,22,'Puerto Santander'),(844,22,'San Cayetano'),(845,22,'Villa del Rosario'),(846,22,'Bucarasica'),(847,22,'El Tarra'),(848,22,'Sardinata'),(849,22,'Tibú'),(850,22,'Ábrego'),(851,22,'Cáchira'),(852,22,'Convención'),(853,22,'El Carmen'),(854,22,'Hacarí'),(855,22,'La Esperanza'),(856,22,'La Playa de Belén'),(857,22,'Ocaña'),(858,22,'San Calixto'),(859,22,'Teorama'),(860,22,'Cácota'),(861,22,'Chitagá'),(862,22,'Mutiscua'),(863,22,'Pamplona'),(864,22,'Pamplonita'),(865,22,'Santo Domingo de Silos'),(866,22,'Bochalema'),(867,22,'Chinácota'),(868,22,'Durania'),(869,22,'Herrán'),(870,22,'Labateca'),(871,22,'Ragonvalia'),(872,22,'Toledo'),(873,23,'Colón'),(874,23,'Mocoa'),(875,23,'Orito'),(876,23,'Puerto Asís'),(877,23,'Puerto Caicedo'),(878,23,'Puerto Guzmán'),(879,23,'Puerto Leguízamo'),(880,23,'San Francisco'),(881,23,'San Miguel'),(882,23,'Santiago'),(883,23,'Sibundoy'),(884,23,'Valle del Guamuez'),(885,23,'Villagarzón'),(886,24,'Armenia'),(887,24,'Buenavista'),(888,24,'Calarcá'),(889,24,'Circasia'),(890,24,'Córdoba'),(891,24,'Filandia'),(892,24,'Génova'),(893,24,'La Tebaida'),(894,24,'Montenegro'),(895,24,'Pijao'),(896,24,'Quimbaya'),(897,24,'Salento'),(898,25,'Apía'),(899,25,'Balboa'),(900,25,'Belén de Umbría'),(901,25,'Dosquebradas'),(902,25,'Guática'),(903,25,'La Celia'),(904,25,'La Virginia'),(905,25,'Marsella'),(906,25,'Mistrató'),(907,25,'Pereira'),(908,25,'Pueblo Rico'),(909,25,'Quinchía'),(910,25,'Santa Rosa de Cabal'),(911,25,'Santuario'),(912,26,'San Andrés'),(913,26,'Providencia'),(914,26,'Santa Catalina'),(915,27,'Aguada'),(916,27,'Albania'),(917,27,'Aratoca'),(918,27,'Barbosa'),(919,27,'Barichara'),(920,27,'Barrancabermeja'),(921,27,'Betulia'),(922,27,'Bolívar'),(923,27,'Bucaramanga'),(924,27,'Cabrera'),(925,27,'California'),(926,27,'Capitanejo'),(927,27,'Carcasí'),(928,27,'Cepitá'),(929,27,'Cerrito'),(930,27,'Charalá'),(931,27,'Charta'),(932,27,'Chima'),(933,27,'Chipatá'),(934,27,'Cimitarra'),(935,27,'Concepción'),(936,27,'Confines'),(937,27,'Contratación'),(938,27,'Coromoro'),(939,27,'Curití'),(940,27,'El Carmen de Chucurí'),(941,27,'El Guacamayo'),(942,27,'El Peñón'),(943,27,'El Playón'),(944,27,'Encino'),(945,27,'Enciso'),(946,27,'Florián'),(947,27,'Floridablanca'),(948,27,'Galán'),(949,27,'Gámbita'),(950,27,'Girón'),(951,27,'Guaca'),(952,27,'Guadalupe'),(953,27,'Guapotá'),(954,27,'Guavatá'),(955,27,'Güepsa'),(956,27,'Hato'),(957,27,'Jesús María'),(958,27,'Jordán'),(959,27,'La Belleza'),(960,27,'La Paz'),(961,27,'Landázuri'),(962,27,'Lebrija'),(963,27,'Los Santos'),(964,27,'Macaravita'),(965,27,'Málaga'),(966,27,'Matanza'),(967,27,'Mogotes'),(968,27,'Molagavita'),(969,27,'Ocamonte'),(970,27,'Oiba'),(971,27,'Onzaga'),(972,27,'Palmar'),(973,27,'Palmas del Socorro'),(974,27,'Páramo'),(975,27,'Piedecuesta'),(976,27,'Pinchote'),(977,27,'Puente Nacional'),(978,27,'Puerto Parra'),(979,27,'Puerto Wilches'),(980,27,'Rionegro'),(981,27,'Sabana de Torres'),(982,27,'San Andrés'),(983,27,'San Benito'),(984,27,'San Gil'),(985,27,'San Joaquín'),(986,27,'San José de Miranda'),(987,27,'San Miguel'),(988,27,'San Vicente de Chucurí'),(989,27,'Santa Bárbara'),(990,27,'Santa Helena del Opón'),(991,27,'Simacota'),(992,27,'Socorro'),(993,27,'Suaita'),(994,27,'Sucre'),(995,27,'Suratá'),(996,27,'Tona'),(997,27,'Valle de San José'),(998,27,'Vélez'),(999,27,'Vetas'),(1000,27,'Villanueva'),(1001,27,'Zapatoca'),(1002,28,'Guaranda'),(1003,28,'Majagual'),(1004,28,'Sucre'),(1005,28,'Chalán'),(1006,28,'Colosó'),(1007,28,'Morroa'),(1008,28,'Ovejas'),(1009,28,'Sincelejo'),(1010,28,'Coveñas'),(1011,28,'Palmito'),(1012,28,'San Onofre'),(1013,28,'Santiago de Tolú'),(1014,28,'Tolúviejo'),(1015,28,'Buenavista'),(1016,28,'Corozal'),(1017,28,'El Roble'),(1018,28,'Galeras'),(1019,28,'Los Palmitos'),(1020,28,'Sampués'),(1021,28,'San Juan de Betulia'),(1022,28,'San Pedro'),(1023,28,'Sincé'),(1024,28,'Caimito'),(1025,28,'La Unión'),(1026,28,'San Benito Abad'),(1027,28,'San Marcos'),(1028,29,'Alvarado'),(1029,29,'Anzoátegui'),(1030,29,'Cajamarca'),(1031,29,'Coello'),(1032,29,'Espinal'),(1033,29,'Flandes'),(1034,29,'Ibagué'),(1035,29,'Piedras'),(1036,29,'Rovira'),(1037,29,'San Luis'),(1038,29,'Valle de San Juan'),(1039,29,'Casabianca'),(1040,29,'Herveo'),(1041,29,'Lérida'),(1042,29,'Líbano'),(1043,29,'Murillo'),(1044,29,'Santa Isabel'),(1045,29,'Venadillo'),(1046,29,'Villahermosa'),(1047,29,'Ambalema'),(1048,29,'Armero'),(1049,29,'Falan'),(1050,29,'Fresno'),(1051,29,'Honda'),(1052,29,'San Sebastián de Mariquita'),(1053,29,'Palocabildo'),(1054,29,'Carmen de Apicalá'),(1055,29,'Cunday'),(1056,29,'Icononzo'),(1057,29,'Melgar'),(1058,29,'Villarrica'),(1059,29,'Ataco'),(1060,29,'Chaparral'),(1061,29,'Coyaima'),(1062,29,'Natagaima'),(1063,29,'Ortega'),(1064,29,'Planadas'),(1065,29,'Rioblanco'),(1066,29,'Roncesvalles'),(1067,29,'San Antonio'),(1068,29,'Alpujarra'),(1069,29,'Dolores'),(1070,29,'Guamo'),(1071,29,'Prado'),(1072,29,'Purificación'),(1073,29,'Saldaña'),(1074,29,'Suárez'),(1075,30,'Alcalá'),(1076,30,'Andalucía'),(1077,30,'Ansermanuevo'),(1078,30,'Argelia'),(1079,30,'Bolívar'),(1080,30,'Buenaventura'),(1081,30,'Buga'),(1082,30,'Bugalagrande'),(1083,30,'Caicedonia'),(1084,30,'Cali'),(1085,30,'Calima - El Darién'),(1086,30,'Candelaria'),(1087,30,'Cartago'),(1088,30,'Dagua'),(1089,30,'El Águila'),(1090,30,'El Cairo'),(1091,30,'El Cerrito'),(1092,30,'El Dovio'),(1093,30,'Florida'),(1094,30,'Ginebra'),(1095,30,'Guacarí'),(1096,30,'Jamundí'),(1097,30,'La Cumbre'),(1098,30,'La Unión'),(1099,30,'La Victoria'),(1100,30,'Obando'),(1101,30,'Palmira'),(1102,30,'Pradera'),(1103,30,'Restrepo'),(1104,30,'Riofrío'),(1105,30,'Roldanillo'),(1106,30,'San Pedro'),(1107,30,'Sevilla'),(1108,30,'Toro'),(1109,30,'Trujillo'),(1110,30,'Tuluá'),(1111,30,'Ulloa'),(1112,30,'Versalles'),(1113,30,'Vijes'),(1114,30,'Yotoco'),(1115,30,'Yumbo'),(1116,30,'Zarzal'),(1117,31,'Carurú'),(1118,31,'Mitú'),(1119,31,'Pacoa'),(1120,31,'Papunaua'),(1121,31,'Taraira'),(1122,31,'Yavaraté'),(1123,32,'Cumaribo'),(1124,32,'La Primavera'),(1125,32,'Puerto Carreño'),(1126,32,'Santa Rosalía'),(1127,33,'Bogota,D.C.');
/*!40000 ALTER TABLE `ciudades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes` (
  `Documento` varchar(50) NOT NULL,
  `Tipo_Documento` varchar(45) DEFAULT NULL,
  `Tipo_Persona` varchar(45) DEFAULT NULL,
  `Nombre` varchar(200) DEFAULT NULL,
  `Telefono` varchar(45) DEFAULT NULL,
  `Correo` varchar(45) DEFAULT NULL,
  `FechaCreacion` date DEFAULT NULL,
  `Estado` varchar(45) DEFAULT NULL,
  `Ciudad` int(11) DEFAULT NULL,
  `Direccion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Documento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES ('1234','Cedula','Natural','jodo','4567','juandavid.andrade1997@gmail.com','2019-12-06','Activo',1084,'jom'),('123456789','Cedula','Natural','ejemplo ','36925814','ejemplo@gmail.com','2019-12-02','Activo',1096,'ddd'),('321654','Cedula','Natural','el bromas','032164','Ejemplo@gmail.com','2019-12-02','Activo',138,'carrera 95 # 2b 13'),('987654321','Cedula','Natural','Pepito','3230','hio','2019-12-02','Activo',1096,'ffff');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departamentos`
--

DROP TABLE IF EXISTS `departamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departamentos` (
  `Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(200) NOT NULL,
  PRIMARY KEY (`Codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamentos`
--

LOCK TABLES `departamentos` WRITE;
/*!40000 ALTER TABLE `departamentos` DISABLE KEYS */;
INSERT INTO `departamentos` VALUES (1,'Amazonas'),(2,'Antioquia'),(3,'Arauca'),(4,'Atlantico'),(5,'Bolivar'),(6,'Boyaca'),(7,'Caldas'),(8,'Caqueta'),(9,'Casanare'),(10,'Cauca'),(11,'Cesar'),(12,'Choco'),(13,'Cordoba'),(14,'Cundinamarca'),(15,'Guainia'),(16,'Guaviare'),(17,'Huila'),(18,'La Guajira'),(19,'Magdalena'),(20,'Meta'),(21,'Nariño'),(22,'Norte de Santander'),(23,'Putumayo'),(24,'Quindio'),(25,'Risaralda'),(26,'San Andres y Providencia'),(27,'Santander'),(28,'Sucre'),(29,'Tolima'),(30,'Valle del Cauca'),(31,'Vaupes'),(32,'Vichada'),(33,'Bogota');
/*!40000 ALTER TABLE `departamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Productos`
--

DROP TABLE IF EXISTS `Productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Productos` (
  `Codigo` varchar(30) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Descripcion` varchar(1000) DEFAULT NULL,
  `Precio` double DEFAULT NULL,
  PRIMARY KEY (`Codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Productos`
--

LOCK TABLES `Productos` WRITE;
/*!40000 ALTER TABLE `Productos` DISABLE KEYS */;
INSERT INTO `Productos` VALUES ('1','Pagina Web','Pagina Web Interactiva con imagenes y Colores Segun la Marca',1000000),('2','Redes Sociales','Manejo de Redes Sociales ',700000);
/*!40000 ALTER TABLE `Productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `Numero` int(11) NOT NULL,
  `Tipo` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`Numero`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Administrador'),(2,'CallCenter'),(3,'Vendedor'),(4,'JefeVentas'),(5,'Creativos'),(6,'Contador');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `Identificacion` varchar(30) NOT NULL,
  `Tipo_Documento` varchar(20) DEFAULT NULL,
  `Primer_Nombre` varchar(50) NOT NULL,
  `Segundo_Nombre` varchar(50) NOT NULL,
  `Primer_Apellido` varchar(50) NOT NULL,
  `Segundo_Apellido` varchar(50) NOT NULL,
  `Nombre_Completo` varchar(200) NOT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Direccion` varchar(120) DEFAULT NULL,
  `Correo` varchar(80) DEFAULT NULL,
  `Celular` varchar(20) DEFAULT NULL,
  `Rol` int(11) DEFAULT NULL,
  `Clave` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '$2y$10$QTAFO8CodSKEVi94BbHsyed1r/rC4RxTd8PVhhdHZwb9kLAETB.rS',
  `Estado` varchar(20) NOT NULL,
  PRIMARY KEY (`Identificacion`),
  KEY `Rol` (`Rol`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`Rol`) REFERENCES `roles` (`Numero`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES ('1112492933','Cedula','Juan','','Andrade','','Juan David Andrade Valencia','4852040','Carrera 95 #2b-21','juandavid.andrade1997@gmail.com','3004885454',1,'$2y$10$QTAFO8CodSKEVi94BbHsyed1r/rC4RxTd8PVhhdHZwb9kLAETB.rS','Activo'),('123456789','Cedula','Vendero','','1','','Vendedor 1','963852741','0000','Vetnas1@gmail.com','123456',3,'$2y$10$QTAFO8CodSKEVi94BbHsyed1r/rC4RxTd8PVhhdHZwb9kLAETB.rS','Activo');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Ventas`
--

DROP TABLE IF EXISTS `Ventas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Ventas` (
  `Numero` int(11) NOT NULL,
  `Fecha` date DEFAULT NULL,
  `Cliente` varchar(50) DEFAULT NULL,
  `Usuario` varchar(30) DEFAULT NULL,
  `FechaCobro` int(11) DEFAULT NULL,
  `Total` double DEFAULT NULL,
  PRIMARY KEY (`Numero`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Ventas`
--

LOCK TABLES `Ventas` WRITE;
/*!40000 ALTER TABLE `Ventas` DISABLE KEYS */;
/*!40000 ALTER TABLE `Ventas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `VentasD`
--

DROP TABLE IF EXISTS `VentasD`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `VentasD` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Venta` int(11) DEFAULT NULL,
  `Producto` int(11) DEFAULT NULL,
  `Valor` double DEFAULT NULL,
  `Observacion` varchar(1000) DEFAULT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `VentasD`
--

LOCK TABLES `VentasD` WRITE;
/*!40000 ALTER TABLE `VentasD` DISABLE KEYS */;
/*!40000 ALTER TABLE `VentasD` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `VentasDT`
--

DROP TABLE IF EXISTS `VentasDT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `VentasDT` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Cliente` varchar(50) DEFAULT NULL,
  `Usuario` varchar(30) DEFAULT NULL,
  `Venta` int(11) DEFAULT NULL,
  `Producto` int(11) DEFAULT NULL,
  `Valor` double DEFAULT NULL,
  `Observacion` varchar(1000) DEFAULT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `VentasDT`
--

LOCK TABLES `VentasDT` WRITE;
/*!40000 ALTER TABLE `VentasDT` DISABLE KEYS */;
/*!40000 ALTER TABLE `VentasDT` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-12-06 17:17:45
