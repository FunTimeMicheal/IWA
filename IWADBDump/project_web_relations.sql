CREATE DATABASE  IF NOT EXISTS `project_web` ;
USE `project_web`;

DROP TABLE IF EXISTS `relations`;
CREATE TABLE `relations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `initials` varchar(12) DEFAULT NULL,
  `prefix` varchar(10) DEFAULT NULL,
  `company` int NOT NULL,
  `function` varchar(45) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `relation_company_idx` (`company`),
  CONSTRAINT `relation_company` FOREIGN KEY (`company`) REFERENCES `companies` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

LOCK TABLES `relations` WRITE;
INSERT INTO `relations` VALUES (1,'Fokker','Anthony','A.H.F.',NULL,10,'Oprichter','dhr.','had.geen@mail.nl','020-1029754'),(2,'Buten','Boertje','B.','van',11,'Grasmaaier','dhr.','b.van.buten@eeldeairport.nl','+31 6 84753920'),(3,'Zonneklaar','Anna','A.',NULL,12,'Weerspecialist','Mevr.','a.zonneklaar@eeldeairport.nl','0634671946'),(4,'Horst','Greta','G.M.',NULL,13,'Docent','Fraulein','g.horst@hsb.bremen.de','+49 6096378923'),(5,'Ploeg','Sake','S.','van der',14,'The Boss','dhr.','s.van.der.pleog@pl.hanze.nl','069876345'),(6,'Zernike','Frits','F.',NULL,15,'Legend','dhr.','f.zernike@rug.nl','0506783948'),(7,'Buren','Willem','W.A.','van',16,'Grootaandeelhouder','Z.M.','geheim','dito'),(8,'Tolkien','John','J.R.R.',NULL,17,'Scientist','Sir','ringmaster@oxforduni.co.uk','+44304872940'),(9,'Saint-Exupéry','Antoine','A.',NULL,18,'Piloot','M.','le.petit.prince@hplloyd.fr','+33 1078490348'),(10,'Boorsma','Petra','P.D.',NULL,16,'Geoloog','Mevr.','p.d.boorsma@shell.nl','0693847563');

UNLOCK TABLES;
