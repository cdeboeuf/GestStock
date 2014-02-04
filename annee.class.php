<?php
include('connexion.php');
class annee 
{    
    //Liste des années présentes dans la base de données
        Public function ListeAnnee()
    {
        $bdd1=connexion_annee();
        $req="SELECT * FROM annee";
        $ligne= $bdd1->query($req);
       return $ligne->fetchAll();
         
    }
    
    // Connexion a une année passé en parametre /!\A revoire
        Public function AnneePrecedente($annee)
    {
        $bdd=connexion_base($annee);
    }
    
    //Renvois la dernière année préente dans la base de données
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
