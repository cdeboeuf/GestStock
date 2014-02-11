CREATE TABLE IF NOT EXISTS `users` (
  `Id` int(3) NOT NULL AUTO_INCREMENT,
  `Login` char(30) NOT NULL,
  `Mdp` char(200) NOT NULL,
  `Type` int(30) NOT NULL,
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`Type`) REFERENCES typeuser(`Id`)
 );
