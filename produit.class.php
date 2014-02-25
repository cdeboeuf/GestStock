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
            $requete = "SELECT Produit.Id, RefLycee, RefFournisseur, Fournisseurs.Nom, Designation, QuantiteTotal, PUTTCPondere, Coloris, PondereInitial,
                       (QuantiteTotal*PUTTCPondere) As Total From Produit inner join Fournisseurs on Produit.IdFournisseur = Fournisseurs.Id
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
            $requete = "SELECT Produit.Id, RefLycee, RefFournisseur, Fournisseurs.Nom, Designation, QuantiteTotal, PUTTCPondere, Coloris, PondereInitial,
                       (QuantiteTotal*PUTTCPondere) As Total From Produit inner join Fournisseurs on Produit.IdFournisseur = Fournisseurs.Id
                        Where IdSection = 1";
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
        
        public function ListeSection()
        {
            try 
            {
                $requete = "SELECT * From section;";
                $tab = Produit::$bdd->query($requete);
                return $tab->fetchAll();
            } 
            catch (Exception $e) 
            {
                 echo 'Échec lors de la connexion : ' . $e->getMessage();
            }	
        }
        
        public function MaxId()
        {
            try 
            {
                $requete = "SELECT Max(Id) From produit;";
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
                detailsligneproduit.DateChangement as dDateChangement, detailsligneproduit.Quantite as dQuantite, detailsligneproduit.Gratuit as dGratuit, detailsligneproduit.PUHT as dPUHT, detailsligneproduit.PUTTC as dPUTTC, detailsligneproduit.IdTVA as dIdTVA
                From Produit Produit inner join Fournisseurs on Produit.IdFournisseur = Fournisseurs.Id inner join unite on Produit.IdUniteAchat = unite.Id 
                Left join detailsligneproduit on Produit.Id = detailsligneproduit.Id
                Where RefFournisseur = '$RefFournisseur';"; 
            $rs = Produit::$bdd->query($requete);
            return $laLigne = $rs->fetchAll();      
           } 
           catch (Exception $e) 
           {
                echo 'Échec lors de la connexion : ' . $e->getMessage();
           }	
        }
        
       public function MajProduit($RefLycee, $StockAlerte, $Obselete)
        {
            $StockAlerte=str_replace ( ',', '.', $StockAlerte);
            
            if (is_numeric($StockAlerte))
            {
                $requete1 = "UPDATE Produit SET StockAlerte = '$StockAlerte',Obselete = '$Obselete'  where Produit.RefLycee = '$RefLycee';";
                $this->retour = Produit::$bdd->prepare($requete1);
                $this->retour->execute();
                $rep = "Le produit à été modifié.";
            }
            else
            {
                $rep = "Erreur, champs invalide.";
            }
            return $rep;

        }
        
        public function AddNewProduit($RefLycee, $RefFournisseur, $StockAlerte, $Obselete, $Designation, $Coloris, $unite, $four, $Section, $Id)
        {
            $StockAlerte=str_replace ( ',', '.', $StockAlerte);
            
            if (is_numeric($StockAlerte))
            { 
                $requete1 = "INSERT INTO Produit (Id, RefLycee, RefFournisseur, StockAlerte, IdFournisseur,Obselete, Designation, Coloris, idUniteAchat, IdSection) VALUES ('$Id', '$RefLycee', '$RefFournisseur', '$StockAlerte', '$four', '$Obselete', '$Designation', '$Coloris', '$unite', '$Section')";
                $this->retour = Produit::$bdd->prepare($requete1);
                $this->retour->execute();
                $rep = "Le produit à été ajouté.";
            }
            else
            {
                $rep = "Erreur, champs invalide.";
            }
            return $rep;

        }
        
        public function AddProduitMode($RefLycee, $DateEntree, $idTVA, $Gratuit, $PUHT, $PUTTC, $Quantite, $Id, $Users)
        {
            $Quantite=str_replace ( ',', '.', $Quantite);
            $PUHT=str_replace ( ',', '.', $PUHT);
            $PUTTC=str_replace ( ',', '.', $PUTTC);
            
            $req1="SELECT Max(id)as id From detailsligneproduit WHERE RefLycee='$RefLycee'";
            $rs1 = Produit::$bdd->query($req1);
            $result1 = $rs1->fetchAll(); 
            foreach ($result1 as $unid)
            {
                $idp=$unid['id'];
            }
         echo   $newId=$idp+1;
 
                $requete1 = "INSERT INTO detailsligneproduit (RefLycee, DateChangement, IdTVA, Gratuit, PUHT, PUTTC, Id,Quantite, SortieEntree, IdUsers)
                VALUES ('$RefLycee', '$DateEntree', '$idTVA', '$Gratuit', '$PUHT', '$PUTTC', '$newId','$Quantite',  'E', '$Users');";
                $this->retour = Produit::$bdd->prepare($requete1);
                $this->retour->execute();
                $rep = "Le produit à été ajouté.";
              
                $this->calculPondere($RefLycee,$newId);               
                
            header('location:newProduit.php?rep=LeProduitEstAjoute');
        }
        
        public function QuantiteNonModifiable()
        {
            $requete = "Select RefLycee from detailsligneproduit;";
            $rs = Produit::$bdd->query($requete);
            return $laLigne = $rs->fetchAll(); 
        }
        
        public function ChampsRefLycee($Nom, $RefFournisseur, $Coloris)
        {
            $requete = "Select Nom from fournisseurs where Nom = '$Nom';";
            $this->retour = Produit::$bdd->prepare($requete);
            $this->retour->execute(); 
            
            
            $start = 0;
            $length = 3;
            echo $Nom = substr($Nom, $start, $length);
            echo "-";
            
            $requete1 = "Select RefFournisseur from produit where RefFournisseur = '$RefFournisseur';";
            $this->retour = Produit::$bdd->prepare($requete1);
            $this->retour->execute();
            
            echo $RefFournisseur;
            echo"-";
            
            $requete2 = "Select Coloris from produit where Coloris = '$Coloris';";
            $this->retour = Produit::$bdd->prepare($requete2);
            $this->retour->execute();
            
            echo $Coloris;
            
        }
        
        function calculPondere($ref,$id)
        {
$req="SELECT quantite,PUTTC From detailsligneproduit WHERE Reflycee='$ref' And SortieEntree='E' and Id=$id";
$rs = Produit::$bdd->query($req);
$result = $rs->fetchAll();
foreach( $result as $ligne)
{
$ligne['quantite'];
$ligne['PUTTC'];
}

$req1="SELECT quantitetotal,PUTTCPondere From produit WHERE RefLycee='$ref'";
$rs1 = Produit::$bdd->query($req1);
$result1 = $rs1->fetchAll();

foreach( $result1 as $produit)
{
$produit['quantitetotal'];
$produit['PUTTCPondere'];
}
$stock=$ligne['quantite']+$produit['quantitetotal'];
$PUTTCPondere=(($ligne['quantite']*$ligne['PUTTC'])+($produit['quantitetotal']*$produit['PUTTCPondere']))/($stock);

$req2="UPDATE produit set quantitetotal=$stock,PUTTCPondere=$PUTTCPondere Where RefLycee='$ref'";
Produit::$bdd->query($req2);
}

function calculPondereEssai($ref,$PUTTC,$Qte)
{
$req1="SELECT quantitetotal,PUTTCPondere From produit WHERE RefLycee='$ref'";
$rs1 = Produit::$bdd->query($req1);
$result1 = $rs1->fetchAll();

foreach( $result1 as $produit)
{
$produit['quantitetotal'];
$produit['PUTTCPondere'];
}
$stock=$Qte+$produit['quantitetotal'];
 return $PUTTCPondere=(($Qte*$PUTTC)+($produit['quantitetotal']*$produit['PUTTCPondere']))/($stock);
}
}
?>
