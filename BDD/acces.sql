CREATE TABLE IF NOT EXISTS `acces` (
  `Idtype` int(3) NOT NULL,
  `IdLien` int(3) NOT NULL,
  PRIMARY KEY (`Idtype`,`IdLien`),
  FOREIGN KEY (`Idtype`) REFERENCES `typeuser` (`Id`),
  FOREIGN KEY (`IdLien`) REFERENCES `lien` (`Id`)
)
