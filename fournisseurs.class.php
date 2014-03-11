<?php
//include('connexion.php');
class Fournisseurs
{
    private  static $bdd;

    function __construct() 
    {
        Fournisseurs::$bdd=connexion_base($_SESSION['annee']);
        Fournisseurs::$bdd->query("SET CHARACTER SET utf8"); 
    }    
 
    function affiche_Fournisseurs()
    {
        $req="SELECT Nom, Fournisseurs.Id, count( produit.Id ) as utiliser
From Fournisseurs left join produit on  Fournisseurs.Id=produit.IdFournisseur
group by Nom";  
        $rs = Fournisseurs::$bdd->query($req);
        return $result = $rs->fetchAll();
    }
    
    function supprimer_Fournisseurs($four)
    { 
        if($this->Verif_FournisseursSup($four)==0)
        {
            
      echo  $req="Delete FROM Fournisseurs WHERE Nom='$four'" ;  
        $rs = Fournisseurs::$bdd->query($req);
     $reponce=" Le Fournisseur $four a été supprimé";
    }else
    {
        $reponce=" Le Fournisseur $four est utilisé par plusieurs produits, il ne peux donc pas être supprimé";
    }
    return$reponce;
    }
    
    function Ajout_Fournisseurs($four)
    { 

             if( $this->Verif_Fournisseurs($four)==0)
             {
        $req="Insert Into Fournisseurs(Nom)values('$four')" ;  
        $rs = Fournisseurs::$bdd->query($req);
        $reponce = "Le Fournisseur a été ajouté";
        } 
        else{$reponce="Le Fournisseur existe déjà";}
        
             
    
    return $reponce;
    }
    
    function Verif_Fournisseurs($four)
    { 
       $req="SELECT Nom From Fournisseurs WHERE Nom='$four';" ;  
        $rs = Fournisseurs::$bdd->query($req);
        return $result = count($rs->fetchAll());
    }
    
     function Verif_FournisseursSup($four)
    {
   $req="SELECT count(*) as utiliser
From Fournisseurs Inner join produit on  fournisseurs.Id=produit.IdFournisseur  Where Fournisseurs.Nom='$four'
group by Nom";
     $rs = Fournisseurs::$bdd->query($req);
     $result = count($rs->fetchAll());
     return $result;
     
    }

    }
?>