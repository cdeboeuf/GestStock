CREATE TABLE IF NOT EXISTS `lien` (
  `Id` int(3) NOT NULL AUTO_INCREMENT,
  `Adresse` char(30) NOT NULL,
  `Details` char(60) NOT NULL,
  PRIMARY KEY (`Id`)
) ;