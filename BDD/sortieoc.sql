CREATE TABLE IF NOT EXISTS `sortieoc` (
  `RefOC` varchar(20) NOT NULL,
  `Id` int(2) NOT NULL,
  `Quantite` int(3) NOT NULL,
  `PrixU` decimal(12,4) NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`RefOC`,`Id`),
  FOREIGN KEY (`RefOC`) REFERENCES `objetconfectionne` (`Ref`)
)
