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
                
        //Récupère le nombre total d'items
        $result = Produit::$bdd->query('SELECT COUNT(*) FROM Produit  Where IdSection = 2');
        $result1 = $result->fetchAll(); 
            foreach ($result1 as $unid)
            {
                $nbItems=$unid['0'];
            }
     
 
        $itemsParPage = 10 ;
 
        //Nombre de pages
        $nbPages = ceil($nbItems/$itemsParPage);
 
        //Numéro de Page courante
        if(!isset($_GET['idPage']))
            $pageCourante = 1;
        elseif(is_numeric($_GET['idPage']) && $_GET['idPage']<=$nbPages)
            $pageCourante = $_GET['idPage'];
        else
            $pageCourante = $nbPages;
 
        //Calcul de la clause LIMIT
        $limitstart = $pageCourante*$itemsParPage-$itemsParPage;
 
        $requete = 'SELECT Produit.Id, RefLycee, RefFournisseur, Fournisseurs.Nom, Designation, QuantiteTotal, PUTTCPondere, Coloris, PondereInitial,
                       (QuantiteTotal*PUTTCPondere) As Total From Produit inner join Fournisseurs on Produit.IdFournisseur = Fournisseurs.Id
                        Where IdSection = 2 ORDER BY id LIMIT '.$limitstart.','.$itemsParPage.'';
 
        $resul = Produit::$bdd->query($requete);
        $resul1 = $resul->fetchAll(); 
        //Système de pagination
        return array($resul1,$nbPages,$pageCourante);     
           } 
           catch (Exception $e) 
           {
                echo 'Échec lors de la connexion : ' . $e->getMessage();
           }	
        }
               public function GetValorisationStockESTFournisseur($fournisseur)
        { 
            try 
           {
                if($fournisseur != '')
                {
                    $fournisseur= "='$fournisseur'";
                }else {$fournisseur= "!=''";
 }
        //Récupère le nombre total d'items
        $result = Produit::$bdd->query("SELECT COUNT(*) FROM Produit  Where IdSection = 1 and IdFournisseur $fournisseur");
        $result1 = $result->fetchAll(); 
            foreach ($result1 as $unid)
            {
                $nbItems=$unid['0'];
            }
     
 
        $itemsParPage = 10 ;
 
        //Nombre de pages
        $nbPages = ceil($nbItems/$itemsParPage);
 
        //Numéro de Page courante
        if(!isset($_GET['idPage']))
            $pageCourante = 1;
        elseif(is_numeric($_GET['idPage']) && $_GET['idPage']<=$nbPages)
            $pageCourante = $_GET['idPage'];
        else
            $pageCourante = $nbPages;
 
        //Calcul de la clause LIMIT
        $limitstart = $pageCourante*$itemsParPage-$itemsParPage;
 
        $requete = 'SELECT Produit.Id, RefLycee, RefFournisseur, Fournisseurs.Nom, Designation, QuantiteTotal, PUTTCPondere, Coloris, PondereInitial,
                       (QuantiteTotal*PUTTCPondere) As Total From Produit inner join Fournisseurs on Produit.IdFournisseur = Fournisseurs.Id
                        Where IdSection = 1 and Idfournisseur'.$fournisseur.' ORDER BY id LIMIT '.$limitstart.','.$itemsParPage.'';
 
        $resul = Produit::$bdd->query($requete);
        $resul1 = $resul->fetchAll(); 
        //Système de pagination
        return array($resul1,$nbPages,$pageCourante);     
           } 
           catch (Exception $e) 
           {
                echo 'Échec lors de la connexion : ' . $e->getMessage();
           }	
        }
        public function GetValorisationStockMODEFournisseur($fournisseur)
        { 
            try 
           {
                if($fournisseur != '')
                {
                    $fournisseur= "='$fournisseur'";
                }else {$fournisseur= "!=''";
 }
        //Récupère le nombre total d'items
        $result = Produit::$bdd->query("SELECT COUNT(*) FROM Produit  Where IdSection = 2 and IdFournisseur $fournisseur");
        $result1 = $result->fetchAll(); 
            foreach ($result1 as $unid)
            {
                $nbItems=$unid['0'];
            }
     
 
        $itemsParPage = 10 ;
 
        //Nombre de pages
        $nbPages = ceil($nbItems/$itemsParPage);
 
        //Numéro de Page courante
        if(!isset($_GET['idPage']))
            $pageCourante = 1;
        elseif(is_numeric($_GET['idPage']) && $_GET['idPage']<=$nbPages)
            $pageCourante = $_GET['idPage'];
        else
            $pageCourante = $nbPages;
 
        //Calcul de la clause LIMIT
        $limitstart = $pageCourante*$itemsParPage-$itemsParPage;
 
        $requete = 'SELECT Produit.Id, RefLycee, RefFournisseur, Fournisseurs.Nom, Designation, QuantiteTotal, PUTTCPondere, Coloris, PondereInitial,
                       (QuantiteTotal*PUTTCPondere) As Total From Produit inner join Fournisseurs on Produit.IdFournisseur = Fournisseurs.Id
                        Where IdSection = 2 and Idfournisseur'.$fournisseur.' ORDER BY id LIMIT '.$limitstart.','.$itemsParPage.'';
 
        $resul = Produit::$bdd->query($requete);
        $resul1 = $resul->fetchAll(); 
        //Système de pagination
        return array($resul1,$nbPages,$pageCourante);     
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
  
 
        //Récupère le nombre total d'items
        $result = Produit::$bdd->query('SELECT COUNT(*) FROM objetconfectionne Where Quantite>0');
        $result1 = $result->fetchAll(); 
            foreach ($result1 as $unid)
            {
                $nbItems=$unid['0'];
            }
     
 
        $itemsParPage = 10 ;
 
        //Nombre de pages
        $nbPages = ceil($nbItems/$itemsParPage);
 
        //Numéro de Page courante
        if(!isset($_GET['idPage']))
            $pageCourante = 1;
        elseif(is_numeric($_GET['idPage']) && $_GET['idPage']<=$nbPages)
            $pageCourante = $_GET['idPage'];
        else
            $pageCourante = $nbPages;
 
        //Calcul de la clause LIMIT
        $limitstart = $pageCourante*$itemsParPage-$itemsParPage;
 
        $requete = 'SELECT Ref,Designation,Quantite, Id,PrixEleveUnitaire,PrixUnitairePublic, (Quantite*PrixEleveUnitaire)As TotalE,(Quantite*PrixUnitairePublic)As TotalP FROM objetconfectionne Where Quantite>0 ORDER BY id LIMIT '.$limitstart.','.$itemsParPage.'';
 
        $resul = Produit::$bdd->query($requete);
        $resul1 = $resul->fetchAll(); 
        //Système de pagination
        return array($resul1,$nbPages,$pageCourante); 
           } 
           catch (Exception $e) 
           {
                echo 'Échec lors de la connexion : ' . $e->getMessage();
           }	
        }
        public function GetValorisationStockMODEFournisseurTrie($fournisseur,$trie)
        { 
            try 
           {
                if($fournisseur != '')
                {
                    $fournisseur= "='$fournisseur'";
                }else {$fournisseur= "!=''";
 }
 if($trie=="AscRLycee")
 {
     $trie= "ORDER BY RefLycee ASC";
 }
 elseif($trie=="DescRLycee")
 {
     $trie= "ORDER BY RefLycee DESC";
 }
 elseif($trie=="AscRFour")
 {
     $trie= "ORDER BY RefFournisseur ASC";
 }
 elseif($trie=="DescRFour")
 {
     $trie= "ORDER BY RefFournisseur DESC";
 }
 elseif($trie=="AscFour")
 {
     $trie= "ORDER BY IdFournisseur ASC";
 }
 elseif($trie=="DescFour")
 {
     $trie= "ORDER BY IdFournisseur DESC";
 }
 else{$trie="ORDER BY id";}
 
        //Récupère le nombre total d'items
        $result = Produit::$bdd->query("SELECT COUNT(*) FROM Produit  Where IdSection = 2 and IdFournisseur $fournisseur");
        $result1 = $result->fetchAll(); 
            foreach ($result1 as $unid)
            {
                $nbItems=$unid['0'];
            }
     
 
        $itemsParPage = 10 ;
 
        //Nombre de pages
        $nbPages = ceil($nbItems/$itemsParPage);
 
        //Numéro de Page courante
        if(!isset($_GET['idPage']))
            $pageCourante = 1;
        elseif(is_numeric($_GET['idPage']) && $_GET['idPage']<=$nbPages)
            $pageCourante = $_GET['idPage'];
        else
            $pageCourante = $nbPages;
 
        //Calcul de la clause LIMIT
        $limitstart = $pageCourante*$itemsParPage-$itemsParPage;
 
        $requete = 'SELECT Produit.Id, RefLycee, RefFournisseur, Fournisseurs.Nom, Designation, QuantiteTotal, PUTTCPondere, Coloris, PondereInitial,
                       (QuantiteTotal*PUTTCPondere) As Total From Produit inner join Fournisseurs on Produit.IdFournisseur = Fournisseurs.Id
                        Where IdSection = 2 and Idfournisseur'.$fournisseur.' '.$trie.' LIMIT '.$limitstart.','.$itemsParPage.'';
 
        $resul = Produit::$bdd->query($requete);
        $resul1 = $resul->fetchAll(); 
        //Système de pagination
        return array($resul1,$nbPages,$pageCourante);     
           } 
           catch (Exception $e) 
           {
                echo 'Échec lors de la connexion : ' . $e->getMessage();
           }	
        }
        
        public function GetValorisationStockOCTrie($trie)
        { 
            try 
           {
                

 if($trie=="AscRLycee")
 {
     $trie= "ORDER BY Ref ASC";
 }
 elseif($trie=="DescRLycee")
 {
     $trie= "ORDER BY Ref DESC";
 }
 
        //Récupère le nombre total d'items
        $result = Produit::$bdd->query("SELECT COUNT(*) FROM ObjetConfectionne Where Quantite>0");
        $result1 = $result->fetchAll(); 
            foreach ($result1 as $unid)
            {
                $nbItems=$unid['0'];
            }
     
 
        $itemsParPage = 10 ;
 
        //Nombre de pages
        $nbPages = ceil($nbItems/$itemsParPage);
 
        //Numéro de Page courante
        if(!isset($_GET['idPage']))
            $pageCourante = 1;
        elseif(is_numeric($_GET['idPage']) && $_GET['idPage']<=$nbPages)
            $pageCourante = $_GET['idPage'];
        else
            $pageCourante = $nbPages;
 
        //Calcul de la clause LIMIT
        $limitstart = $pageCourante*$itemsParPage-$itemsParPage;
 
        $requete = 'SELECT Ref,Designation,Quantite, Id,PrixEleveUnitaire,PrixUnitairePublic, (Quantite*PrixEleveUnitaire)As TotalE,(Quantite*PrixUnitairePublic)As TotalP FROM objetconfectionne Where Quantite>0 '.$trie.' LIMIT '.$limitstart.','.$itemsParPage.'';
 
        $resul = Produit::$bdd->query($requete);
        $resul1 = $resul->fetchAll(); 
        //Système de pagination
        return array($resul1,$nbPages,$pageCourante);     
           } 
           catch (Exception $e) 
           {
                echo 'Échec lors de la connexion : ' . $e->getMessage();
           }	
        }
        
        
        
        
        
        public function GetValorisationStockESTFournisseurTrie($fournisseur,$trie)
        { 
            try 
           {
                if($fournisseur != '')
                {
                    $fournisseur= "='$fournisseur'";
                }else {$fournisseur= "!=''";
 }
 if($trie=="AscRLycee")
 {
     $trie= "ORDER BY RefLycee ASC";
 }
 elseif($trie=="DescRLycee")
 {
     $trie= "ORDER BY RefLycee DESC";
 }
 elseif($trie=="AscRFour")
 {
     $trie= "ORDER BY RefFournisseur ASC";
 }
 elseif($trie=="DescRFour")
 {
     $trie= "ORDER BY RefFournisseur DESC";
 }
 elseif($trie=="AscFour")
 {
     $trie= "ORDER BY IdFournisseur ASC";
 }
 elseif($trie=="DescFour")
 {
     $trie= "ORDER BY IdFournisseur DESC";
 }
 else{$trie="ORDER BY id";}
 
        //Récupère le nombre total d'items
        $result = Produit::$bdd->query("SELECT COUNT(*) FROM Produit  Where IdSection = 1 and IdFournisseur $fournisseur");
        $result1 = $result->fetchAll(); 
            foreach ($result1 as $unid)
            {
                $nbItems=$unid['0'];
            }
     
 
        $itemsParPage = 10 ;
 
        //Nombre de pages
        $nbPages = ceil($nbItems/$itemsParPage);
 
        //Numéro de Page courante
        if(!isset($_GET['idPage']))
            $pageCourante = 1;
        elseif(is_numeric($_GET['idPage']) && $_GET['idPage']<=$nbPages)
            $pageCourante = $_GET['idPage'];
        else
            $pageCourante = $nbPages;
 
        //Calcul de la clause LIMIT
        $limitstart = $pageCourante*$itemsParPage-$itemsParPage;
 
        $requete = 'SELECT Produit.Id, RefLycee, RefFournisseur, Fournisseurs.Nom, Designation, QuantiteTotal, PUTTCPondere, Coloris, PondereInitial,
                       (QuantiteTotal*PUTTCPondere) As Total From Produit inner join Fournisseurs on Produit.IdFournisseur = Fournisseurs.Id
                        Where IdSection = 1 and Idfournisseur'.$fournisseur.' '.$trie.' LIMIT '.$limitstart.','.$itemsParPage.'';
 
        $resul = Produit::$bdd->query($requete);
        $resul1 = $resul->fetchAll(); 
        //Système de pagination
        return array($resul1,$nbPages,$pageCourante);     
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
                 //Récupère le nombre total d'items
        $result = Produit::$bdd->query('SELECT COUNT(*) FROM Produit  Where IdSection = 1');
        $result1 = $result->fetchAll(); 
            foreach ($result1 as $unid)
            {
                $nbItems=$unid['0'];
            }
     
 
        $itemsParPage = 10 ;
 
        //Nombre de pages
        $nbPages = ceil($nbItems/$itemsParPage);
 
        //Numéro de Page courante
        if(!isset($_GET['idPage']))
            $pageCourante = 1;
        elseif(is_numeric($_GET['idPage']) && $_GET['idPage']<=$nbPages)
            $pageCourante = $_GET['idPage'];
        else
            $pageCourante = $nbPages;
 
        //Calcul de la clause LIMIT
        $limitstart = $pageCourante*$itemsParPage-$itemsParPage;
 
        $requete = 'SELECT Produit.Id, RefLycee, RefFournisseur, Fournisseurs.Nom, Designation, QuantiteTotal, PUTTCPondere, Coloris, PondereInitial,
                       (QuantiteTotal*PUTTCPondere) As Total From Produit inner join Fournisseurs on Produit.IdFournisseur = Fournisseurs.Id
                        Where IdSection = 1 ORDER BY id LIMIT '.$limitstart.','.$itemsParPage.'';
 
        $resul = Produit::$bdd->query($requete);
        $resul1 = $resul->fetchAll(); 
        //Système de pagination
        return array($resul1,$nbPages,$pageCourante);   
              
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
         public function MajValorisationStockOC($QuantiteTotal, $Id)
        {
            $requete1 = "UPDATE objetconfectionne SET Quantite = '$QuantiteTotal' where Id = '$Id';"; 
            
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
        
        public function ListeOC()
        {
            try 
            {
                $requete = "SELECT * From objetconfectionne;";
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
                SELECT Produit.IdSection, Produit.PUTTCPondere, Produit.Id, Produit.RefLycee, StockAlerte, Obselete, RefFournisseur, Fournisseurs.Id as IdFour, Fournisseurs.Nom, Designation, QuantiteTotal, Coloris, unite.Details, unite.Id as uniteId, 
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
         public function GetRemplissageTableauHistorique($RefLycee)
        {
            try 
           {
                                 //Récupère le nombre total d'items
        $result = Produit::$bdd->query("SELECT COUNT(*) FROM detailsligneproduit  Where RefLycee = '$RefLycee'");
        $result1 = $result->fetchAll(); 
            foreach ($result1 as $unid)
            {
                $nbItems=$unid['0'];
            }
     
 
        $itemsParPage = 10 ;
 
        //Nombre de pages
        $nbPages = ceil($nbItems/$itemsParPage);
 
        //Numéro de Page courante
        if(!isset($_GET['idPage']))
            $pageCourante = 1;
        elseif(is_numeric($_GET['idPage']) && $_GET['idPage']<=$nbPages)
            $pageCourante = $_GET['idPage'];
        else
            $pageCourante = $nbPages;
 
        //Calcul de la clause LIMIT
        $limitstart = $pageCourante*$itemsParPage-$itemsParPage;
            $requete = "
                SELECT *,detailsligneproduit.Id as IdP, utilisation.Details as DetailsU From detailsligneproduit inner join tva on tva.Id=Detailsligneproduit.IdTva inner join users on detailsligneproduit.IdUsers=users.Id left join utilisation on detailsligneproduit.Utilisation=utilisation.Id Where RefLycee = '$RefLycee' order by Detailsligneproduit.Id LIMIT $limitstart,$itemsParPage;"; 
                    $resul = Produit::$bdd->query($requete);
        $resul1 = $resul->fetchAll(); 
        //Système de pagination
        return array($resul1,$nbPages,$pageCourante);      
           } 
           catch (Exception $e) 
           {
                echo 'Échec lors de la connexion : ' . $e->getMessage();
           }	
        }
        public function GetRemplissageTableauHistoriqueOC($RefOC)
        {
            try 
           {
                                 //Récupère le nombre total d'items
        $result = Produit::$bdd->query("SELECT COUNT(*) FROM sortieoc  Where RefOC = '$RefOC'");
        $result1 = $result->fetchAll(); 
            foreach ($result1 as $unid)
            {
                $nbItems=$unid['0'];
            }
     
 
        $itemsParPage = 10 ;
 
        //Nombre de pages
        $nbPages = ceil($nbItems/$itemsParPage);
 
        //Numéro de Page courante
        if(!isset($_GET['idPage']))
            $pageCourante = 1;
        elseif(is_numeric($_GET['idPage']) && $_GET['idPage']<=$nbPages)
            $pageCourante = $_GET['idPage'];
        else
            $pageCourante = $nbPages;
 
        //Calcul de la clause LIMIT
        $limitstart = $pageCourante*$itemsParPage-$itemsParPage;
            $requete = "
                SELECT * FROM sortieoc Where RefOC = '$RefOC' order by Id LIMIT $limitstart,$itemsParPage;"; 
                    $resul = Produit::$bdd->query($requete);
        $resul1 = $resul->fetchAll(); 
        //Système de pagination
        return array($resul1,$nbPages,$pageCourante);      
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
            {   $requete1 = "UPDATE Produit SET StockAlerte = '$StockAlerte',Obselete = '$Obselete'  where Produit.RefFournisseur = '$RefLycee';";
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
        
        public function AddNewProduit($RefLycee, $RefFournisseur, $StockAlerte, $Obselete, $Designation, $Coloris, $unite, $four, $Section)
        {
              if($StockAlerte=="")
             {
                 $StockAlerte =0;
             }
             
             $lesId=$this->MaxId();
             foreach ($lesId as $Id)
             {
                 $Id=$Id[0]+1;
             }
            $StockAlerte=str_replace ( ',', '.', $StockAlerte);
            $Designation=mysql_real_escape_string($Designation);
            $Coloris=mysql_real_escape_string($Coloris);
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
        
 public function AddProduit($RefLycee, $DateEntree, $idTVA, $Gratuit, $PUHT, $PUTTC, $Quantite, $Users)
        {
     echo $idTVA;
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
           $newId=$idp+1;
 
                $requete1 = "INSERT INTO detailsligneproduit (RefLycee, DateChangement, IdTVA, Gratuit, PUHT, PUTTC, Id,Quantite, SortieEntree, IdUsers)
                VALUES ('$RefLycee', '$DateEntree', $idTVA, '$Gratuit', '$PUHT', '$PUTTC', '$newId','$Quantite',  'E', '$Users');";
                $this->retour = Produit::$bdd->prepare($requete1);
                $this->retour->execute();
                $rep = "Le produit à été ajouté.";
              
                $this->calculPondere($RefLycee,$newId);               
                
            header('location:newProduit.php?rep=LeProduitEstAjoute');
        }
        
                
        function obtenirstock($ref)
        {
            $result = Produit::$bdd->query(" Select QuantiteTotal from Produit where RefLycee = '$ref'; ");
            $result1 = $result->fetchAll(); 
            foreach ($result1 as $sto)
            {
                $stock =$sto['0'];                
            }
            return $stock;
        }
        
         public function AddProduit2($RefLycee, $DateEntree, $Quantite, $Users, $Utilisation, $OC = null)
        {
            $Quantite=str_replace ( ',', '.', $Quantite);
            if (is_numeric($Quantite))
            {
                $req1="SELECT Max(id)as id From detailsligneproduit WHERE RefLycee='$RefLycee'";
                $rs1 = Produit::$bdd->query($req1);
                $result1 = $rs1->fetchAll(); 
                foreach ($result1 as $unid)
                {
                    $idp=$unid['id'];
                }
                $newId=$idp+1;
                if($OC==null)    
                {
                    $requete2 = "INSERT INTO detailsligneproduit (RefLycee, DateChangement, Id ,Quantite, SortieEntree, IdUsers, Gratuit, Utilisation)
                    VALUES ('$RefLycee', '$DateEntree','$newId','$Quantite',  'S', '$Users', '1', '$Utilisation');";
                }
                else
                {
                    $requete2 = "INSERT INTO detailsligneproduit (RefLycee, DateChangement, Id ,Quantite, SortieEntree, IdUsers, Gratuit, Utilisation, OC)
                    VALUES ('$RefLycee', '$DateEntree','$newId','$Quantite',  'S', '$Users', '1', '$Utilisation', '$OC');";
                }
                $this->retour = Produit::$bdd->prepare($requete2);
                $this->retour->execute();
                $rep = "La sortie à été effectué.";
                               
                if(!empty($OC))
                {
                    $reqq = "SELECT PUTTCPondere FROM produit where RefLycee = '$RefLycee';";
                    $this->retour = Produit::$bdd->prepare($reqq);
                    $puTTC = $this->retour->execute();

                    $stockOCajouter = $Quantite;

                    $req1 = "INSERT INTO ligneoc (RefOC, RefLycee, Quantite, PuTTC) VALUES ('$OC','$RefLycee', '$stockOCajouter', '$puTTC'); ";
                    $this->retour = Produit::$bdd->prepare($req1);
                    $this->retour->execute();
                }
                else
                {
                    $stockaenlever = $Quantite;

                    $Stock = $this->obtenirstock($RefLycee);
                    $newstock = $Stock - $stockaenlever;

                    $req1 = "UPDATE Produit SET QuantiteTotal = '$newstock' where RefLycee = '$RefLycee'; ";
                    $this->retour = Produit::$bdd->prepare($req1);
                    $this->retour->execute();
                }
                
                
                
            }
            else
            {
                $rep = "Erreur, champs invalide.";
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
