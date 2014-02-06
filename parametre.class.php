<?php
//include('connexion.php');
class Parametre
{
    private  static $bdd;

    function __construct() 
    {
        Parametre::$bdd=connexion_base($_SESSION['annee']);
        Parametre::$bdd->query("SET CHARACTER SET utf8"); 
    }    
 
    function affiche_CoefCorrection()
    {
        $req="SELECT * from parametre where Id=1" ;  
        $rs = Parametre::$bdd->query($req);
        return $result = $rs->fetchAll();
    }
    
    function affiche_CoutMachine()
    {   $req="SELECT Details from parametre where Id=2" ;  
        $rs = Parametre::$bdd->query($req);
        return $result = $rs->fetchAll();
    }
    
    function modif_CoefCorrection($coef)
    {  $coef=str_replace ( ',', '.', $coef); 
         if (is_numeric($coef)) 
         { 
         $req="Update parametre set Details = $coef where Id=1";
         $rs = Parametre::$bdd->query($req);
         $rep="Le coeficient de correction a été changé";
         }  else {
         $rep = "Merci de rentrer un nombre valide";
             
         }
         return $rep;
    }
    
    function modif_CoutMachine($coef)
    {
         $coef=str_replace ( ',', '.', $coef); 
         if (is_numeric($coef)) 
         { 
         $req="Update parametre set Details = $coef where Id=2";
         $rs = Parametre::$bdd->query($req);
         $rep="Le coût machine a été changé";
         }else
         {
         $rep = "Merci de rentrer un nombre valide";
         } 
         return $rep;
    }

}
?>