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
        $req="SELECT typeuser.Id,Details,count(Login) as utiliser
From typeuser left join users on  typeuser.Id=users.Type
group by Details" ;  
        $rs = Typeuser::$bdd->query($req);
        return $result = $rs->fetchAll();
    }
    
    function ajout_Type($type)
    {
        
             if( $this->Verif_Type($type)==0)
             {
             $type=mysql_real_escape_string($type);
        $req="INSERT INTO typeuser(Details) values('$type') ;" ;  
        $rs = Typeuser::$bdd->query($req);
        $rep= 'Le type a été ajouté';
             }
             else
             {
                 $rep='Le type existe déja';
             }
             return $rep;
    }
    
     function Supprimer_Type($type)
    { 
         if($this->Verif_TypeSup($type)==0)
         {
        $req="Delete From typeuser where Id ='$type' ;" ;  
        $rs = Typeuser::$bdd->query($req);
        $reponce=" Le type a été supprimé";
    }else
    {
          $type=stripslashes($type);
        $reponce=" Le type est utilisé par attribué a une ou plusieurs personnes il ne peut donc pas etre suprimé";
    }
    return$reponce;
    }
    
     function Verif_TypeSup($type)
    {
   $req="SELECT count(*) as utiliser
From typeuser Inner join users on  typeuser.Id=users.Type  Where typeuser.Id=$type
group by typeuser.Id";
     $rs = Typeuser::$bdd->query($req);
     $result = count($rs->fetchAll());
     return $result;
     
    }
       function Verif_Type($type)
    { 
        $type=mysql_real_escape_string($type);
       $req="SELECT Details From typeuser WHERE Details='$type';" ;  
        $rs = Typeuser::$bdd->query($req);
        return $result = count($rs->fetchAll());
    }
    }
?>
