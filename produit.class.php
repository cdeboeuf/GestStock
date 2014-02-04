<?php
include('annee.class.php');
    class Produit 
{
        private  static $bdd;

//Connexion a la base de donnée de la dernière année.
        // Si l'année est choisie par l'administrateur faire if ($_SESSION['type']= admin){ }
	public function __construct($nb = null){
            $annee= new annee();
            $nb=$annee->DerniereAnnee();
            Produit::$bdd=connexion_base($nb);
            Produit::$bdd->query("SET CHARACTER SET utf8");
	}
        
        //Affichage des produits en stocke
        public function GetValorisationStock()
        {
            
            $requete = "SELECT Produit.Id, RefLycee, RefFournisseur, Fournisseurs.Nom, Designation, QuantiteTotal, PATTCPondere
                        From Produit inner join Fournisseurs on Produit.IdFournisseur = Fournisseurs.Id";
            $rs = Produit::$bdd->query($requete);
           return $laLigne = $rs->fetchAll();
            
			
        }
        
        /*public function MajValorisationStock($QuantiteTotal, $PATTCPondere, $Id)
        {
            $requete1 = "INSERT INTO Produit(QuantiteTotal) VALUES('$QuantiteTotal');";
            $rs1 = Produit::$monPdo->query($requete1);
            $requete2 = "Select (SUM(PATTC * Quantite) / QuantiteTotal) as $PATTCPondere from detailsligneproduit inner join produit on detailsligneproduit.Id = produit.Id ;";
            $rs2 = Produit::$monPdo->query($requete2);
            $requete3 = "INSERT INTO Produit(PATTCPondere) VALUES('$PATTCPondere);";
            $rs3 = Produit::$monPdo->query($requete3);
        }*/
    

}
?>
