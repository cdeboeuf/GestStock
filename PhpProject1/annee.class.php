
<?php
include('connexion.php');
class annee 
{     
    private $id;
    private $details;
    
    Public function LireAnnée()
    {
        $bdd=connexion_annee();
        $req="SELECT * FROM annee";
        $ligne= $bdd->query($req);
        return $ligne;
    }
 
}
?>