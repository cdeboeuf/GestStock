CREATE TABLE IF NOT EXISTS `ligneoc` (
  `Id` int(3) NOT NULL AUTO_INCREMENT,
  `RefOc` char(30) NOT NULL,
  `RefLycee` char(30) NOT NULL,
  `Quantite` decimal(10,2) NOT NULL,
  `PuTTC` decimal(10,2) NOT NULL,
  PRIMARY KEY (`Id`,`RefOc`),
  FOREIGN KEY (`RefOc`) REFERENCES objetconfectionne(`Ref`),
  FOREIGN KEY (`RefLycee`) REFERENCES Produit(`RefLycee`)
) 
