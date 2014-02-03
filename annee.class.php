<?php
include('connexion.php');
class annee 
{     
    private $id;
    private $details;
    
    Public function ListeAnnée()
    {
        $bdd=connexion_annee();
        $req="SELECT * FROM annee";
        $ligne= $bdd->query($req);
        return $ligne;
    }
        Public function AnnéePrécédente($annee)
    {
        $bdd=connexion_base($annee);
        //$req="SELECT * FROM annee where annee=".$annee.";";
        $ligne= $bdd->query($req);
        return $ligne;
    }
}
?>