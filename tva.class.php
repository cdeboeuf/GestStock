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
        $req="SELECT * From tva Order by taux;" ;  
        $rs = Tva::$bdd->query($req);
        return $result = $rs->fetchAll();
    }
    
    function supprimer_Tva($tva)
    {
        $req="Delete FROM tva Where Taux=$tva" ;  
        $rs = Tva::$bdd->query($req);
        return $reponce=" Le taux  de $tva % a été supprimé";
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
}
?>