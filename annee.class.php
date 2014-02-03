<?php
include('connexion.php');
class annee 
{     
        Public function ListeAnnee()
    {
        $bdd1=connexion_annee();
        $req="SELECT * FROM annee";
        $ligne= $bdd->query($req);
        return $ligne;
    }
        Public function AnneePrecedente($annee)
    {
        $bdd1=connexion_base($annee);
    }
        Public function DerniereAnnee()
    {
        $bdd1=connexion_annee();
        $req="SELECT Max(Details) FROM annee;";
        $ligne= $bdd1->query($req);
        while ($donnees = $ligne->fetch()) 
        {
        $bdd=connexion_base($donnees[0]);
        }
    }
}
?>