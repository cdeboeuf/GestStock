<?php
include('annee.class.php');
    class Produit 
{
        private  static $bdd;
        
/**
 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */				
	public function __construct(){
            $annee= new annee();
            $nb=$annee->DerniereAnnee();
            Produit::$bdd=connexion_base($nb);
            Produit::$bdd->query("SET CHARACTER SET utf8");
	}
        
        public function GetValorisationStock()
        {
            try 
           {
            $requete = "SELECT Produit.Id, RefLycee, RefFournisseur, Fournisseurs.Nom, Designation, QuantiteTotal, PATTCPondere, Coloris, PondereInitial
                        From Produit inner join Fournisseurs on Produit.IdFournisseur = Fournisseurs.Id";
            $rs = Produit::$bdd->query($requete);
            return $laLigne = $rs->fetchAll();      
           } 
           catch (Exception $e) 
           {
                echo 'Échec lors de la connexion : ' . $e->getMessage();
           }
			
        }
        

        public function MajValorisationStock($QuantiteTotal, $Id)
        {
            $requete1 = "UPDATE Produit SET QuantiteTotal = '$QuantiteTotal' where Produit.Id = '$Id';";
            
            $this->retour = Produit::$bdd->prepare($requete1);
            $this->retour->execute(); 

            //$requete2 = "Select (SUM(PATTC * Quantite) / QuantiteTotal) as $PATTCPondere from detailsligneproduit inner join produit on detailsligneproduit.Id = produit.Id ;";
            //$rs2 = Produit::$monPdo->query($requete2);
            //$requete3 = "UPDATE Produit SET PATTCPondere = '$PATTCPondere where Produit.Id = $Id;";
            //$rs3 = Produit::$monPdo->query($requete3);
        }
}
?>
