<?php
class Typeuser
{
    private  static $bdd;

    function __construct() 
    {
        Typeuser::$bdd=connexion_base($_SESSION['annee']);
        Typeuser::$bdd->query("SET CHARACTER SET utf8"); 
    }     
    
    function affiche_Type()
    {
        $req="SELECT * From typeuser ;" ;  
        $rs = Typeuser::$bdd->query($req);
        return $result = $rs->fetchAll();
    }
    
    function ajout_Type($type)
    {
        $req="INSERT INTO(Details) typeuser values('$type') ;" ;  
        $rs = Typeuser::$bdd->query($req);
        
    }
    
     function Supprimer_Type($type)
    {  
         if($this->Verif_Type($type)==0)
        {
        $req="Delete INTO(Details) typeuser values('$type') ;" ;  
        $rs = Typeuser::$bdd->query($type);
        $reponce=" Le type $type a été supprimé";
    }else
    {
        $reponce=" Le type $type est utilisé par attribué a une ou plusieurs personnes il ne peut donc pas etre suprimé";
    }
    return$reponce;
    }
    
     function Verif_TvaSup($type)
    {
   $req="SELECT count(*) as utiliser
From typeuser Inner join user on  typeuser.Id=users.Type  Where typeuser.Details='$type'
group by Dettails";
     $rs = Typeuser::$bdd->query($req);
     echo $result = count($rs->fetchAll());
     return $result;
     
    }
    }
?>
