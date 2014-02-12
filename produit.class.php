<?php
include('connexion.php');
    class Produit 
{
        private  static $bdd;
        
/**
 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */				
	public function __construct()
       {
            Produit::$bdd=connexion_base($_SESSION['annee']);
            Produit::$bdd->query("SET CHARACTER SET utf8");
	}
        
        public function GetValorisationStockMODE()
        {
            try 
           {
            $requete = "SELECT Produit.Id, RefLycee, RefFournisseur, Fournisseurs.Nom, Designation, QuantiteTotal, PATTCPondere, Coloris, PondereInitial,
                       (QuantiteTotal*PATTCPondere) As Total From Produit inner join Fournisseurs on Produit.IdFournisseur = Fournisseurs.Id
                        Where IdSection = 2";
            $rs = Produit::$bdd->query($requete);
            return $laLigne = $rs->fetchAll();      
           } 
           catch (Exception $e) 
           {
                echo 'Échec lors de la connexion : ' . $e->getMessage();
           }	
        }
        
        public function GetValorisationStockEST()
        {
            try 
           {
            $requete = "SELECT Produit.Id, RefLycee, RefFournisseur, Fournisseurs.Nom, Designation, QuantiteTotal, PATTCPondere, Coloris, PondereInitial
                        , (QuantiteTotal*PATTCPondere) As Total From Produit inner join Fournisseurs on Produit.IdFournisseur = Fournisseurs.Id
                        Where IdSection = 1";
            $rs = Produit::$bdd->query($requete);
            return $laLigne = $rs->fetchAll();
           } 
           catch (Exception $e) 
           {
                echo 'Échec lors de la connexion : ' . $e->getMessage();
           }	
        }
        
        public function GetValorisationStockOC()
        {
            try 
           {
            $requete = "SELECT Produit.Id, RefLycee, RefFournisseur, Fournisseurs.Nom, Designation, QuantiteTotal, PATTCPondere, Coloris, PondereInitial
                        , (QuantiteTotal*PATTCPondere) As Total From Produit inner join Fournisseurs on Produit.IdFournisseur = Fournisseurs.Id
                        Where IdSection = 3";
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
        }
        
        public function ListeFournisseurs()
        {
            try 
            {
                $requete = "SELECT Nom From Fournisseurs;";
                $tab = Produit::$bdd->query($requete);
                return $tab->fetchAll();
            } 
            catch (Exception $e) 
            {
                 echo 'Échec lors de la connexion : ' . $e->getMessage();
            }	
        }
        
        public function ListeUniteAchat()
        {
            try 
            {
                $requete = "SELECT Details From unite;";
                $tab = Produit::$bdd->query($requete);
                return $tab->fetchAll();
            } 
            catch (Exception $e) 
            {
                 echo 'Échec lors de la connexion : ' . $e->getMessage();
            }	
        }
        
        public function ListeTVA()
        {
            try 
            {
                $requete = "SELECT Taux From tva;";
                $tab = Produit::$bdd->query($requete);
                return $tab->fetchAll();
            } 
            catch (Exception $e) 
            {
                 echo 'Échec lors de la connexion : ' . $e->getMessage();
            }	
        }
        
        
        public function GetRemplissageTableau($RefFournisseur)
        {
            try 
           {
            $requete = "SELECT Produit.Id, Produit.RefLycee, StockAlerte, Obselete, RefFournisseur, Fournisseurs.Nom, Designation, QuantiteTotal, Coloris, unite.Details 
                        From Produit inner join Fournisseurs on Produit.IdFournisseur = Fournisseurs.Id inner join unite on Produit.IdUniteAchat = unite.Id
                Where RefFournisseur = '$RefFournisseur';";
            $rs = Produit::$bdd->query($requete);
            return $laLigne = $rs->fetchAll();      
           } 
           catch (Exception $e) 
           {
                echo 'Échec lors de la connexion : ' . $e->getMessage();
           }	
        }
        
       public function MajProduit($RefLycee, $StockAlerte, $Obselete, $Designation, $Coloris, $Id)
        {
            $requete1 = "UPDATE Produit
                         SET RefLycee = '$RefLycee', StockAlerte = '$StockAlerte', Obselete = '$Obselete', Designation = '$Designation', Coloris = '$Coloris'  where Produit.Id = '$Id';";
            $this->retour = Produit::$bdd->prepare($requete1);
            $this->retour->execute();
        }
        
        public function QuantiteNonModifiable()
        {
            $requete = "Select RefLycee from detailsligneproduit;";
            $rs = Produit::$bdd->query($requete);
            return $laLigne = $rs->fetchAll(); 
        }
}
?>
