<?php
//include('connexion.php');
class Unite
{
    private  static $bdd;

    function __construct() 
    {
        Unite::$bdd=connexion_base($_SESSION['annee']);
        Unite::$bdd->query("SET CHARACTER SET utf8"); 
    }    
 
    function affiche_Unite()
    {
        $req="SELECT unite.Id,Details, count(Produit.Id ) as utiliser
From unite left join produit on unite.Id=produit.IdUniteAchat
group by unite.Id;" ;  
        $rs = Unite::$bdd->query($req);
        return $result = $rs->fetchAll();
    }
    
    function supprimer_Unite($Unite)
            {
        if($this->Verif_UniteSup($Unite)==0)
        {
        $req="Delete FROM unite Where Details='$Unite'" ;  
        $rs = Unite::$bdd->query($req);
        return $reponce=" Le $Unite % a été supprimé";}
    }
    
    function Ajout_Unite($Unite)
    { 
             if( $this->Verif_Unite($Unite)==0)
             {
        $req="Insert Into unite(Details)values('$Unite')" ;  
        $rs = Unite::$bdd->query($req);
        $reponce = "L'unitée d'achat a été ajouté";
        } 
        else{
            $reponce="L'unitée d'achat existe déjà";
            
        }
    return $reponce;
    }
    
    function Verif_Unite($Unite)
    {
       $req="SELECT Details From unite WHERE Details='$Unite';" ;  
        $rs = Unite::$bdd->query($req);
        return $result = count($rs->fetchAll());
    }
     function Verif_UniteSup($tva)
    {
   $req="SELECT count(*) as utiliser
From unite Inner join produit on  unite.Id=produit.IdUniteAchat  Where unite.Details='$tva'
group by details";
     $rs = Unite::$bdd->query($req);
     echo $result = count($rs->fetchAll());
     return $result;
     
    }
}
?>