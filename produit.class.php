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
        
        
        public function GetRemplissageTableau($RefFournisseur)
        {
            try 
           {
            $requete = "
                SELECT Produit.Id, Produit.RefLycee, StockAlerte, Obselete, RefFournisseur, Fournisseurs.Id as IdFour, Fournisseurs.Nom, Designation, QuantiteTotal, Coloris, unite.Details, unite.Id as uniteId, 
                detailsligneproduit.DateChangement as dDateChangement, detailsligneproduit.Quantite as dQuantite, detailsligneproduit.Gratuit as dGratuit, detailsligneproduit.PUHT as dPUHT, detailsligneproduit.PUTTC as dPUTTC, detailsligneproduit.IdTVA as dIdTVA
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
        
       public function MajProduit($StockAlerte, $Obselete, $Id)
        {
            $StockAlerte=str_replace ( ',', '.', $StockAlerte);
            
            if (is_numeric($StockAlerte))
            { 
                
                $requete1 = "UPDATE Produit SET StockAlerte = '$StockAlerte', Obselete = '$Obselete' where Produit.RefFournisseur = '$Id';";
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
        
        public function AddNewProduit($RefLycee, $StockAlerte, $Obselete, $Designation, $Coloris, $unite, $four, $Id)
        {
            $StockAlerte=str_replace ( ',', '.', $StockAlerte);
            
            if (is_numeric($StockAlerte))
            { 
                $requete1 = "UPDATE Produit SET RefLycee = '$RefLycee', StockAlerte = '$StockAlerte', IdFournisseur='$four',Obselete = '$Obselete', Designation = '$Designation', Coloris = '$Coloris', idUniteAchat='$unite'  where Produit.RefFournisseur = '$Id';";
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
        
        public function AddProduitMode($RefLycee, $DateEntree, $idTVA, $Gratuit, $PUHT, $PUTTC, $Quantite, $Id, $Users)
        {
            $Quantite=str_replace ( ',', '.', $Quantite);
            $PUHT=str_replace ( ',', '.', $PUHT);
            $PUTTC=str_replace ( ',', '.', $PUTTC);
            
            $req1="SELECT Max(id)as id From detailsligneproduit WHERE RefLycee=$RefLycee";
            $rs1 = Produit::$bdd->query($req1);
            $result1 = $rs1->fetchAll(); 
            foreach ($result1 as $unid)
            {
                $idp=$unid['id'];
            }
            $newId=$idp+1;
            
            if (is_numeric($Quantite) && (is_numeric($PUHT) || empty($PUHT)) && (is_numeric($PUTTC) || empty($PUTTC)))
            {
                $requete1 = "INSERT INTO detailsligneproduit (RefLycee, DateChangement, IdTVA, Gratuit, PUHT, PUTTC, Quantite, Id, SortieEntree, IdUsers)
                VALUES ('$RefLycee', '$DateEntree', '$idTVA', '$Gratuit', '$PUHT', '$PUTTC', '$Quantite', '$newId', 'S', '$Users');";
                $this->retour = Produit::$bdd->prepare($requete1);
                $this->retour->execute();
                $rep = "Le produit à été ajouté.";
                if($Gratuit==0)
                {
                $this->calculPondere($RefLycee,$newId);               
                }
            }
            else
            {
                $rep = "Erreur, champs non valide.";
            }  
            return $rep;
            
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
$req="SELECT quantite,PUTTC From detailsligneproduit WHERE Reflycee='$ref' And SortieEntree='E' and Gratuit=0 and Id=$id";
$rs = Produit::$bdd->query($req);
$result = $rs->fetchAll();
foreach( $result as $ligne)
{
echo $ligne['quantite'];
echo $ligne['PUTTC'];
}

$req1="SELECT quantitetotal,PUTTCPondere From produit WHERE RefLycee='$ref'";
$rs1 = Produit::$bdd->query($req1);
$result1 = $rs1->fetchAll();

foreach( $result1 as $produit)
{
echo $produit['quantitetotal'];
echo $produit['PUTTCPondere'];
}

echo $stock=$ligne['quantite']+$produit['quantitetotal'];
echo $PUTTCPondere=(($ligne['quantite']*$ligne['PUTTC'])+($produit['quantitetotal']*$produit['PUTTCPondere']))/($stock);

$req2="UPDATE produit set quantitetotal=$stock,PUTTCPondere=$PUTTCPondere Where RefLycee='$ref'";
$rs2 = Produit::$bdd->query($req2);
}
}
?>
