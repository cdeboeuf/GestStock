CREATE TABLE IF NOT EXISTS `sousmenu` (
  `menu` int(11) NOT NULL,
  `sousmenu` int(11) NOT NULL,
  PRIMARY KEY (`menu`,`sousmenu`),
  FOREIGN KEY (`menu`) REFERENCES `menu` (`Id`),
  FOREIGN KEY (`sousmenu`) REFERENCES `lien` (`Id`)
)