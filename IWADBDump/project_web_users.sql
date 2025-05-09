CREATE DATABASE  IF NOT EXISTS `project_web` ;
USE `project_web`;

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `initials` varchar(12) DEFAULT NULL,
  `prefix` varchar(10) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `employee_code` varchar(10) NOT NULL,
  `user_role` int NOT NULL,
  `password` varchar(256) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_for_user_idx` (`user_role`),
  CONSTRAINT `role_for_user` FOREIGN KEY (`user_role`) REFERENCES `userroles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

LOCK TABLES `users` WRITE;

INSERT INTO `users` VALUES (1,'Rietdijk','Harald','H.H.',NULL,'h.h.rietdijk@iwa.nl','A0001',6,'scrypt:32768:8:1$Wp86NbCNB55CDEuh$c7449811aef42b4baa9d99e0baaf3b57de09733f4e969dae4b86ab601ef6ff25b3c276340b20b5d971aecf310eb7799f48a15999a8df0a5a1706392d42e8c120'),(2,'Spek','Nienke','N.','van der','n.van.der.spek@iwa.nl','A0002',6,'scrypt:32768:8:1$cfltq6vfR5fq4poI$f34ebdebf59b225d9a151c59d5f643328ba10179c00358dd905ee554fcf9113c9a9d3d8d24a7828cd6c8672e02ca9f88df7bd7d6b7ec44c1967f83ae698bbebf'),(3,'Loermans','Arjan','A.A.M',NULL,'a.a.m.loermans@iwa.nl','A0003',6,'scrypt:32768:8:1$WtuByIUWcKCpkyts$e255a8fd4603c7dc69d416dae629c7f757df74e76f8eb05583d1ff2b7c157702c9dd980c18077dbd27ec019c57ca4bcf74a8c8ac775e578ffab09e4de2728e51'),(4,'Misja','Hoebe','M.N.',NULL,'m.n.hoebe@iwa.nl','A0004',6,'scrypt:32768:8:1$d6fe7GjgVmORd9kS$32dccfea6e0a3d92b72de2f3025df7825e315b6cd1701a88c7a62e3ac04452f43f651bcfd5511d3d2dc96614507c0e15895f407ec93f4f821b55eadb2add3b16'),(5,'Ilse','Stroeve','I.L.',NULL,'i.l.stroeve@iwa.nl','A0005',6,'scrypt:32768:8:1$SDvOs7hGsnBLzFkg$9adef1b3a31da95b3b12f9e8e41dc4654401dfce4df7bd7dd481b1a4a82116fc6f9c13b64ebe4510e19aee3c6dd8725f1ab83a3311e4290130b4949de85d609f'),(6,'Bas','Heijne','B.L.',NULL,'b.l.heijne@iwa.nl','A0006',2,'pbkdf2:sha256:150000$Hbw9ERGI$0b93464e514e7d7c5ca45acd0e508c3d5db081cea527a19e07ea784294655653'),(7,'Ralf','Broek','R.','van den','r.van.den.broek@iwa.nl','A0007',1,'pbkdf2:sha256:150000$YybvDDFH$effd2777eb22c5b810f995fdb452776ed56b5ae5fd1195cbebbdca9d6a71efce'),(8,'Natasha','Wieringa','N.M.',NULL,'n.m.wieringa@iwa.nl','A0008',3,'scrypt:32768:8:1$SDvOs7hGsnBLzFkg$9adef1b3a31da95b3b12f9e8e41dc4654401dfce4df7bd7dd481b1a4a82116fc6f9c13b64ebe4510e19aee3c6dd8725f1ab83a3311e4290130b4949de85d609f'),(9,'Serge','Janssen','S.',NULL,'s.janssen@iwa.nl','A0009',4,'scrypt:32768:8:1$WtuByIUWcKCpkyts$e255a8fd4603c7dc69d416dae629c7f757df74e76f8eb05583d1ff2b7c157702c9dd980c18077dbd27ec019c57ca4bcf74a8c8ac775e578ffab09e4de2728e51'),(10,'Rienko','Techneut','R.','de','r.de.techneut@iwa.nl','A0010',5,'pbkdf2:sha256:150000$Hbw9ERGI$0b93464e514e7d7c5ca45acd0e508c3d5db081cea527a19e07ea784294655653');

UNLOCK TABLES;
