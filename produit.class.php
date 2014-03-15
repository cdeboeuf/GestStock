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
        $result = Produit::$bdd->query('SELECT COUNT(*) FROM objetconfectionne Where NbRealise>0');
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
 
        $requete = 'SELECT Ref,Designation,Quantite, Id,PrixEleveUnitaire,PrixUnitairePublic, (Quantite*PrixEleveUnitaire)As TotalE,(Quantite*PrixUnitairePublic)As TotalP FROM objetconfectionne Where NbRealise>0 ORDER BY id LIMIT '.$limitstart.','.$itemsParPage.'';
 
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
        $result = Produit::$bdd->query("SELECT COUNT(*) FROM ObjetConfectionne Where NbRealise>0");
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
 
        $requete = 'SELECT Ref,Designation,Quantite, Id,PrixEleveUnitaire,PrixUnitairePublic, (Quantite*PrixEleveUnitaire)As TotalE,(Quantite*PrixUnitairePublic)As TotalP FROM objetconfectionne Where NbRealise>0 '.$trie.' LIMIT '.$limitstart.','.$itemsParPage.'';
 
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
            $requete1 = "UPDATE Produit SET QuantiteTotal = '$QuantiteTotal',StockInitial='$QuantiteTotal' where Produit.Id = '$Id';"; 
            
            $this->retour = Produit::$bdd->prepare($requete1);
            $this->retour->execute(); 
        }
         public function MajValorisationStockOC($QuantiteTotal, $Id)
        {
            $requete1 = "UPDATE objetconfectionne SET Quantite = '$QuantiteTotal',StockInitial='$QuantiteTotal' where Id = '$Id';"; 
            
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
              public function ListeOCSortie()
        {
            try 
            {
                $requete = "SELECT * From objetconfectionne WHERE NbRealise >0;";
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
    if($idTVA==0){$idTVA='null';};
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
            $requete = "Select count(*) from detailsligneproduit;";
            $rs = Produit::$bdd->query($requete);
            $rs1=$rs->fetchAll(); 
            foreach ($rs1 as $nb)
            { 
                echo $nombre=$nb[0];
            }
            return $nombre;
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

function variationMS($type)
{
    if($type=="mode")
    {$val=2;}
    elseif ($type=="esthetique"){$val=1;}
    $req="SELECT SUM(QuantiteTotal*PUTTCPondere) as variation FROM produit WHERE IdSection=$val";
    $req1="SELECT SUM(StockInitial*PondereInitial) as variation FROM produit WHERE IdSection=$val";
    $rs1 = Produit::$bdd->query($req);
    $result1 = $rs1->fetchAll();
    $rs2 = Produit::$bdd->query($req1);
    $result2 = $rs2->fetchAll();
     foreach ($result1 as $res1)
    {
     $SF=$res1[0];
    }
    foreach ($result2 as $res2)
    {
     $SI=$res2[0];
    }
    $total=$SF-$SI;
    return array($SI,$SF,$total);
}
function variationO()
{  
    $req="SELECT SUM(StockInitial*PrixUnitairePublic) as variation FROM objetconfectionne";
    $req1="SELECT SUM(Quantite*PrixUnitairePublic) as variation FROM objetconfectionne";
    $rs1 = Produit::$bdd->query($req);
    $result1 = $rs1->fetchAll();
    $rs2 = Produit::$bdd->query($req1);
    $result2 = $rs2->fetchAll();
    foreach ($result1 as $res1)
    {
      $SI=($res1[0]);
    }
    foreach ($result2 as $res2)
    {
     $SF=$res2[0];
    }
    $total=$SF-$SI;
    return array($SI,$SF,$total);
}
 public function GetValorisationStockESTDate($date,$trie,$fournisseur)
        { 
            try 
           {
                   if($trie == '')
                {
                    $trie= "";
                }
                if($date != '')
                {
                    $date= "<='$date'";
                }else {$date= "<= '".date("Y-m-d")."'";}
                
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
 else{$trie="ORDER BY Produit.id";}
 
        //Récupère le nombre total d'items
        $result0 = Produit::$bdd->query('SELECT COUNT(*) FROM Produit  Where IdSection = 1 and  IdFournisseur '.$fournisseur.' '.$trie.'');
        $result01 = $result0->fetchAll(); 
            foreach ($result01 as $unid)
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
        $requete = 'SELECT Produit.Id as idp, RefLycee, RefFournisseur, Fournisseurs.Nom as nom1, Designation, Coloris, StockInitial, PondereInitial From Produit inner join Fournisseurs on Produit.IdFournisseur = Fournisseurs.Id Where IdSection = 1 and  IdFournisseur '.$fournisseur.' '.$trie.' LIMIT '.$limitstart.','.$itemsParPage.'';
        $resul = Produit::$bdd->query($requete);
        $resultl = $resul->rowCount();
        $result = $resul->fetchAll();      
        $i=0;
        if($resultl!=0)
        {
        foreach ($result as $res)
        {
        $pondereinital=  $res['PondereInitial'];
        $quantite=$res['StockInitial'];
        $ref= $res['RefLycee'];
        $requete1 = "SELECT RefLycee,DateChangement,SortieEntree,PUTTC,Quantite,detailsligneproduit.Id From detailsligneproduit Where RefLycee='$ref' and DateChangement $date ORDER BY DateChangement";
        $resul1 = Produit::$bdd->query($requete1);
        $resultl1 = $resul1->rowCount();
        $resultt1 = $resul1->fetchAll(); 
        if($resultl1!=0)
        {
        foreach ($resultt1 as $res1)
        {
          if($res1['SortieEntree']=="E")
              {
                $stock=$quantite+$res1['Quantite'];
                $PUTTCPondere=(($quantite* $pondereinital)+($res1['Quantite']*$res1['PUTTC']))/($stock);
                $pondereinital= $PUTTCPondere;                          
          }  elseif ($res1['SortieEntree']=="S") {
       $stock=$quantite-$res1['Quantite']; 
}       $quantite=$stock;         
           }
           $Total=$quantite*$pondereinital;
     $tab1=array('RefLycee'=>$ref,'Id'=>$res['idp'],'Designation'=>$res['Designation'],'RefFournisseur'=>$res['RefFournisseur'],'Coloris'=>$res['Coloris'], 'Nom'=>$res['nom1'],'PUTTCPondere'=>$pondereinital,'Total'=>$Total,'QuantiteTotal'=>$quantite);     
        }
        else {
            $Total=$quantite*$pondereinital;
            $tab1=array('RefLycee'=>$ref,'Designation'=>$res['Designation'],'Id'=>$res['idp'],'RefFournisseur'=>$res['RefFournisseur'],'Coloris'=>$res['Coloris'], 'Nom'=>$res['nom1'],'PUTTCPondere'=> $res['PondereInitial'],'Total'=>$Total,'QuantiteTotal'=>$res['StockInitial']);     
        }
        $tab[$i]=$tab1;  
        $i=$i+1;    
        
          
        }}else{$tab[0]=array('RefLycee'=>null,'Id'=>null,'Designation'=>null,'RefFournisseur'=>null,'Coloris'=>null, 'Nom'=>null,'PUTTCPondere'=>null,'Total'=>null,'QuantiteTotal'=>null);}

        return array($tab,$nbPages,$pageCourante); 
           } 
           catch (Exception $e) 
           {
                echo 'Échec lors de la connexion : ' . $e->getMessage();
           }	
        }
        
 public function GetValorisationStockMODEDate($date,$trie,$fournisseur)
        { 
            try 
           {
                   if($trie == '')
                {
                    $trie= "";
                }
                if($date != '')
                {
                    $date= "<='$date'";
                }else {$date= "<= '".date("Y-m-d")."'";}
                
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
 else{$trie="ORDER BY Produit.id";}
 
        //Récupère le nombre total d'items
        $result0 = Produit::$bdd->query('SELECT COUNT(*) FROM Produit  Where IdSection = 2 and  IdFournisseur '.$fournisseur.' '.$trie.'');
        $result01 = $result0->fetchAll(); 
            foreach ($result01 as $unid)
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
        $requete = 'SELECT Produit.Id as idp, RefLycee, RefFournisseur, Fournisseurs.Nom as nom1, Designation, Coloris, StockInitial, PondereInitial From Produit inner join Fournisseurs on Produit.IdFournisseur = Fournisseurs.Id Where IdSection = 2 and  IdFournisseur '.$fournisseur.' '.$trie.' LIMIT '.$limitstart.','.$itemsParPage.'';
        $resul = Produit::$bdd->query($requete);
        $resultl = $resul->rowCount();
        $result = $resul->fetchAll();      
        $i=0;
        if($resultl!=0)
        {
        foreach ($result as $res)
        {
        $pondereinital=  $res['PondereInitial'];
        $quantite=$res['StockInitial'];
        $ref= $res['RefLycee'];
        $requete1 = "SELECT RefLycee,DateChangement,SortieEntree,PUTTC,Quantite,detailsligneproduit.Id From detailsligneproduit Where RefLycee='$ref' and DateChangement $date ORDER BY DateChangement";
        $resul1 = Produit::$bdd->query($requete1);
        $resultl1 = $resul1->rowCount();
        $resultt1 = $resul1->fetchAll(); 
        if($resultl1!=0)
        {
        foreach ($resultt1 as $res1)
        {
          if($res1['SortieEntree']=="E")
              {
                $stock=$quantite+$res1['Quantite'];
                $PUTTCPondere=(($quantite* $pondereinital)+($res1['Quantite']*$res1['PUTTC']))/($stock);
                $pondereinital= $PUTTCPondere;                          
          }  elseif ($res1['SortieEntree']=="S") {
       $stock=$quantite-$res1['Quantite']; 
}       $quantite=$stock;         
           }
           $Total=$quantite*$pondereinital;
     $tab1=array('RefLycee'=>$ref,'Id'=>$res['idp'],'Designation'=>$res['Designation'],'RefFournisseur'=>$res['RefFournisseur'],'Coloris'=>$res['Coloris'], 'Nom'=>$res['nom1'],'PUTTCPondere'=>$pondereinital,'Total'=>$Total,'QuantiteTotal'=>$quantite);     
        }
        else {
            $Total=$quantite*$pondereinital;
            $tab1=array('RefLycee'=>$ref,'Designation'=>$res['Designation'],'Id'=>$res['idp'],'RefFournisseur'=>$res['RefFournisseur'],'Coloris'=>$res['Coloris'], 'Nom'=>$res['nom1'],'PUTTCPondere'=> $res['PondereInitial'],'Total'=>$Total,'QuantiteTotal'=>$res['StockInitial']);     
        }
        $tab[$i]=$tab1;  
        $i=$i+1;    
        
          
        }}else{$tab[0]=array('RefLycee'=>null,'Id'=>null,'Designation'=>null,'RefFournisseur'=>null,'Coloris'=>null, 'Nom'=>null,'PUTTCPondere'=>null,'Total'=>null,'QuantiteTotal'=>null);}

        return array($tab,$nbPages,$pageCourante); 
           } 
           catch (Exception $e) 
           {
                echo 'Échec lors de la connexion : ' . $e->getMessage();
           }	
        }
        public function GetValorisationStockOCDate($date,$trie)
        { 
            try 
           {
                   if($trie == '')
                {
                    $trie= "";
                }
                if($date != '')
                {
                    $date= "<='$date'";
                }else {$date= "<= '".date("Y-m-d")."'";}

 
 if($trie=="AscRLycee")
 {
     $trie= "ORDER BY Ref ASC";
 }
 elseif($trie=="DescRLycee")
 {
     $trie= "ORDER BY Ref DESC";
 }
 
        //Récupère le nombre total d'items
        $result = Produit::$bdd->query("SELECT COUNT(*) FROM ObjetConfectionne Where NbRealise>0");
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
 
        $requete = 'SELECT Ref,Designation,Quantite,NbRealise, StockInitial,Id,PrixEleveUnitaire,PrixUnitairePublic, (Quantite*PrixEleveUnitaire)As TotalE,(Quantite*PrixUnitairePublic)As TotalP FROM objetconfectionne Where NbRealise>0 '.$trie.' LIMIT '.$limitstart.','.$itemsParPage.'';
        $resul = Produit::$bdd->query($requete);
        $resultl = $resul->rowCount();
        $result = $resul->fetchAll();      
        $i=0;
        if($resultl!=0)
        {
        foreach ($result as $res)
        {
        $quantite=$res['StockInitial'];
        $ref= $res['Ref'];
        $requete1 = "SELECT * From sortieoc Where RefOC='$ref' and Date $date ORDER BY Date";
        $resul1 = Produit::$bdd->query($requete1);
        $resultl1 = $resul1->rowCount();
        $resultt1 = $resul1->fetchAll(); 
        if($resultl1!=0)
        {
        foreach ($resultt1 as $res1)
        {

            $quantite= $quantite-$res1['Quantite'] ;
           }
           $Total=$quantite*$res['PrixUnitairePublic'];
     $tab1=array('Ref'=>$ref,'Id'=>$res['Id'],'Designation'=>$res['Designation'],'TotalP'=>$Total,'Quantite'=>$quantite,'PrixEleveUnitaire'=>$res["PrixEleveUnitaire"],'PrixUnitairePublic'=>$res["PrixUnitairePublic"]);     
        }
        else {
             $Total=$quantite*$res['PrixUnitairePublic'];
            $tab1=array('Ref'=>$ref,'Designation'=>$res['Designation'],'Id'=>$res['Id'],'TotalP'=>$Total,'Quantite'=>$res['NbRealise'],'PrixEleveUnitaire'=>$res["PrixEleveUnitaire"],'PrixUnitairePublic'=>$res["PrixUnitairePublic"]);     
        }
        $tab[$i]=$tab1;  
        $i=$i+1;    
        
          
        }}else{$tab[0]=array('Ref'=>Null,'Designation'=>null,'Id'=>null,'Total'=>null,'QuantiteTotal'=>null,'PrixEleveUnitaire'=>null,'PrixUnitairePublic'=>null);}

        return array($tab,$nbPages,$pageCourante); 
           } 
           catch (Exception $e) 
           {
                echo 'Échec lors de la connexion : ' . $e->getMessage();
           }	
        }
        
        function TMode()
        {
        $requete1 = "SELECT Produit.Id, RefLycee, RefFournisseur, Fournisseurs.Nom, Designation, QuantiteTotal, PUTTCPondere, Coloris, PondereInitial,
                       (QuantiteTotal*PUTTCPondere) As Total From Produit inner join Fournisseurs on Produit.IdFournisseur = Fournisseurs.Id
                        Where IdSection = 2 ORDER BY id";
        $resul1 = Produit::$bdd->query($requete1);
        return  $resultt1 = $resul1->fetchAll(); 
        }
        function TEsthetique()
        {
        $requete1 = "SELECT Produit.Id, RefLycee, RefFournisseur, Fournisseurs.Nom, Designation, QuantiteTotal, PUTTCPondere, Coloris, PondereInitial,
                       (QuantiteTotal*PUTTCPondere) As Total From Produit inner join Fournisseurs on Produit.IdFournisseur = Fournisseurs.Id
                        Where IdSection = 1 ORDER BY id";
        $resul1 = Produit::$bdd->query($requete1);
        return  $resultt1 = $resul1->fetchAll(); 
        }
        function TOC()
        {
        $requete1 = "SELECT Ref,Designation,Quantite, Id,PrixEleveUnitaire,PrixUnitairePublic, (Quantite*PrixEleveUnitaire)As TotalE,(Quantite*PrixUnitairePublic)As TotalP FROM objetconfectionne Where NbRealise>0";
        $resul1 = Produit::$bdd->query($requete1);
        return  $resultt1 = $resul1->fetchAll(); 
        }
                Public function DerniereAnnee()
    {
        $bdd1=connexion_annee();
        $req="SELECT Max(Ans) FROM annee;";
        $ligne= $bdd1->query($req);
        while ($donnees = $ligne->fetch()) 
        {
        return $donnees[0];
        }
    }
}
?>
