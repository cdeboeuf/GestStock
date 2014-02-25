<?php
//include('connexion.php');
class Tva
{
    private  static $bdd;

    function __construct() 
    {
        Tva::$bdd=connexion_base($_SESSION['annee']);
        Tva::$bdd->query("SET CHARACTER SET utf8"); 
    }    
 
    function affiche_Tva()
    {
        $req="SELECT taux, tva.Id, count( detailsligneproduit.Id ) as utiliser
From Tva left join detailsligneproduit on  tva.Id=detailsligneproduit.Idtva
group by taux";  
        $rs = Tva::$bdd->query($req);
        return $result = $rs->fetchAll();
    }
    
    function supprimer_Tva($tva)
    { 
        if($this->Verif_TvaSup($tva)==0)
        {
        $req="Delete FROM tva Where Taux=$tva" ;  
        $rs = Tva::$bdd->query($req);
     $reponce=" Le taux  de $tva % a été supprimé";
    }else
    {
        $reponce=" Le taux  de $tva % est utilisé par plusieurs produit il ne peut donc pas etre supprimé";
    }
    return$reponce;
    }
    
    function Ajout_Tva($tva)
    { 
         $tva=str_replace ( ',', '.', $tva); 
         if (is_numeric($tva)) 
         { 
             if( $this->Verif_Tva($tva)==0)
             {
        $req="Insert Into tva(Taux)values($tva)" ;  
        $rs = Tva::$bdd->query($req);
        $reponce = "Le taux de tva a été ajouté";
        } 
        else{$reponce="Le taux existe déjà";}
        
             }
        else
        {
     $reponce = "Merci de rentrer un nombre valide";
    }
    return $reponce;
    }
    
    function Verif_Tva($tva)
    { 
       $req="SELECT Taux From tva WHERE Taux=$tva;" ;  
        $rs = Tva::$bdd->query($req);
        return $result = count($rs->fetchAll());
    }
    
     function Verif_TvaSup($tva)
    {
   $req="SELECT count(*) as utiliser
From Tva Inner join detailsligneproduit on  tva.Id=detailsligneproduit.Idtva  Where tva.taux='$tva'
group by taux";
     $rs = Tva::$bdd->query($req);
     echo $result = count($rs->fetchAll());
     return $result;
     
    }

    }
?>