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
            $requete = "SELECT Produit.Id, Produit.RefLycee, StockAlerte, Obselete, RefFournisseur, Fournisseurs.Nom, Designation, QuantiteTotal, Coloris, unite.Details, tva.Taux
                        From Produit inner join Fournisseurs on Produit.IdFournisseur = Fournisseurs.Id inner join unite on Produit.IdUniteAchat = unite.Id inner join detailsligneproduit on Produit.Id = detailsligneproduit.Id inner join tva on detailsligneproduit.IdTVA = tva.Id
                Where RefFournisseur = '$RefFournisseur';";
            $rs = Produit::$bdd->query($requete);
            return $laLigne = $rs->fetchAll();      
           } 
           catch (Exception $e) 
           {
                echo 'Échec lors de la connexion : ' . $e->getMessage();
           }	
        }
        
       public function MajProduit($RefLycee, $StockAlerte, $Obselete, $RefFournisseur, $Nom, $Designation, $Coloris, $Details, $Taux, $Id)
        {
            $requete1 = "UPDATE Produit SET RefLycee = '$RefLycee' where Produit.Id = '$Id';";
            $requete2 = "UPDATE Produit SET StockAlerte = '$StockAlerte' where Produit.Id = '$Id';";
            $requete3 = "UPDATE Produit SET Obselete = '$Obselete' where Produit.Id = '$Id';";
            $requete4 = "UPDATE Produit inner join Fournisseurs on Produit.IdFournisseur = Fournisseurs.Id SET RefFournisseur = '$RefFournisseur' where Produit.Id = '$Id';";
            $requete5 = "UPDATE Produit inner join Fournisseurs on Produit.IdFournisseur = Fournisseurs.Id SET Nom = '$Nom' where Produit.Id = '$Id';";
            $requete6 = "UPDATE Produit SET Designation = '$Designation' where Produit.Id = '$Id';";
            $requete7 = "UPDATE Produit SET Coloris = '$Coloris' where Produit.Id = '$Id';";
            $requete8 = "UPDATE Produit inner join Unite on Produit.IdUniteAchat = unite.Id SET Details = '$Details' where Produit.Id = '$Id';";
            $requete9 = "UPDATE Produit inner join detailsligneproduit on Produit.Id = detailsligneproduit.Id inner join tva on detailsligneproduit.IdTVA = tva.Id SET tva = '$Taux' where Produit.Id ='$Id';";
            $this->retour = Produit::$bdd->prepare($requete1);
            $this->retour->execute();
            $this->retour = Produit::$bdd->prepare($requete2);
            $this->retour->execute(); 
            $this->retour = Produit::$bdd->prepare($requete3);
            $this->retour->execute(); 
            $this->retour = Produit::$bdd->prepare($requete4);
            $this->retour->execute(); 
            $this->retour = Produit::$bdd->prepare($requete5);
            $this->retour->execute(); 
            $this->retour = Produit::$bdd->prepare($requete6);
            $this->retour->execute(); 
            $this->retour = Produit::$bdd->prepare($requete7);
            $this->retour->execute(); 
            $this->retour = Produit::$bdd->prepare($requete8);
            $this->retour->execute(); 
            $this->retour = Produit::$bdd->prepare($requete9);
            $this->retour->execute(); 
        }
}
?>
