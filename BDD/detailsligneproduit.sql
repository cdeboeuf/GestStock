CREATE TABLE IF NOT EXISTS `detailsligneproduit` (
  `RefLycee` char(30) NOT NULL,
  `Id` int(3) NOT NULL ,
  `DateChangement` date NOT NULL,
  `IdTVA` int(10) NOT NULL,
  `Gratuit` tinyint(1),
  `PUHT` decimal(10,2),
  `SortieEntree` tinyint(1) NOT NULL,
  `IdUsers` int(10) NOT NULL,
  `PUTTC` decimal(10,2),
  `Utilisation` int(10) NOT NULL,
  `OC` char(30) NOT NULL,
  `Quantite` int(3) NOT NULL,
  PRIMARY KEY (`RefLycee`,`Id`),
  FOREIGN KEY (`RefLycee`) REFERENCES produit(`RefLycee`),
  FOREIGN KEY (`IdTVA`) REFERENCES tva(`Id`),
  FOREIGN KEY (`IdUsers`) REFERENCES users(`Id`),
  FOREIGN KEY (`OC`) REFERENCES objetconfectionne(`ref`),
  FOREIGN KEY (`Utilisation`) REFERENCES utilisation(`Id`)
);