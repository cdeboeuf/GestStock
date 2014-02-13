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
                $requete = "SELECT * From Fournisseurs;";
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
                $requete = "SELECT * From unite;";
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
                $requete = "SELECT * From tva;";
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
            $requete = "
                SELECT Produit.Id, Produit.RefLycee, StockAlerte, Obselete, RefFournisseur, Fournisseurs.Id as IdFour, Fournisseurs.Nom, Designation, QuantiteTotal, Coloris, unite.Details, unite.Id as uniteId, 
                detailsligneproduit.DateChangement as dDateChangement, detailsligneproduit.Quantite as dQuantite, detailsligneproduit.Gratuit as dGratuit, detailsligneproduit.PAHT as dPAHT, detailsligneproduit.PaTTC as dPaTTC, detailsligneproduit.IdTVA as dIdTVA
                From Produit Produit inner join Fournisseurs on Produit.IdFournisseur = Fournisseurs.Id inner join unite on Produit.IdUniteAchat = unite.Id 
                inner join detailsligneproduit on Produit.Id = detailsligneproduit.Id
                Where RefFournisseur = '$RefFournisseur';";
            $rs = Produit::$bdd->query($requete);
            return $laLigne = $rs->fetchAll();      
           } 
           catch (Exception $e) 
           {
                echo 'Échec lors de la connexion : ' . $e->getMessage();
           }	
        }
        
       public function MajProduit($RefLycee, $StockAlerte, $Obselete, $Designation, $Coloris, $unite, $four, $Id)
        {
            $requete1 = "UPDATE Produit SET RefLycee = '$RefLycee', StockAlerte = '$StockAlerte', IdFournisseur='$four',Obselete = '$Obselete', Designation = '$Designation', Coloris = '$Coloris', idUniteAchat='$unite'  where Produit.RefFournisseur = '$Id';";
            $this->retour = Produit::$bdd->prepare($requete1);
            $this->retour->execute();
            
        }
        
        public function AddProduitMode($RefLycee, $DateEntree, $idTVA, $Gratuit, $PAHT, $PATTC, $Quantite, $Id, $Users)
        {
            $requete1 = "INSERT INTO detailsligneproduit (RefLycee, DateChangement, IdTVA, Gratuit, PAHT, PaTTC, Quantite, Id, SortieEntree, IdUsers)
            VALUES ('$RefLycee', '$DateEntree', '$idTVA', '$Gratuit', '$PAHT', '$PATTC', '$Quantite', '$Id', 'S', '$Users');";
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
