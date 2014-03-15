INSERT INTO `menu` (`Id`, `Adresse`, `Detail`) VALUES
(1, 'Accueil.php', 'Accueil'),
(2, 'Inventaire.php', 'Afficher l''inventaire'),
(3, 'objetConfectione.php', 'Gestion des objets confectionnés'),
(4, 'ajoutProduit.php', 'Ajouter un nouveau produit'),
(5, 'fournisseur.php', 'Gestion des fournisseur'),
(6, 'gererUtilisateur.php', 'Gestion des utilisateurs'),
(7, 'parametre.php', 'Gestion des parametres'),
(8, 'sortieProduit.php', 'Sortir des produits'),
(9, 'monprofil.php', 'Mon Profil');

INSERT INTO `parametre` (`Id`, `Details`) VALUES
(1, '0'),
(2, '0.0');

INSERT INTO `section` (`Id`, `Details`) VALUES
(1, 'Esthetique'),
(2, 'Mode'),
(3, 'Objet Confectionné');

INSERT INTO `sousmenu` (`menu`, `sousmenu`) VALUES
(7, 1),
(7, 2),
(4, 3),
(8, 4),
(2, 5),
(5, 6),
(7, 7),
(7, 8),
(8, 9),
(4, 10),
(2, 11),
(9, 12),
(4, 13),
(8, 14),
(2, 15),
(3, 16),
(1, 17),
(1, 18),
(1, 19),
(7, 20),
(6, 21);

INSERT INTO `acces` (`Idtype`, `IdLien`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(2, 9),
(1, 10),
(2, 10),
(1, 11),
(2, 11),
(1, 12),
(2, 12),
(1, 13),
(1, 14),
(2, 14),
(1, 15),
(2, 15),
(1, 16),
(2, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21);

INSERT INTO `tva` (`Id`, `Taux`) VALUES
(1, '20.00'),
(2, '5.50'),
(3, '10.00'),

INSERT INTO `typeuser` (`Id`, `Details`) VALUES
(1, 'Administrateur'),
(2, 'Professeur de Mode'),
(3, 'Professeur d''esthetique');

INSERT INTO `unite` (`Id`, `Details`) VALUES
(1, 'centimètre'),
(2, 'mètre'),
(3, 'unite'),
(4, 'Pièce');

INSERT INTO `users` (`Id`, `Login`, `Mdp`, `Type`) VALUES
(1, 'toto', 'f71dbe52628a3f83a77ab494817525c6', 1),

INSERT INTO `utilisation` (`Id`, `Details`) VALUES
(1, 'Salon'),
(2, 'Pratique'),
(3, 'Projet'),
(4, 'Objet confectionné');