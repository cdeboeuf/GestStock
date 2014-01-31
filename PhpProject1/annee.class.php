
<?php
    class annee {
    private $id;
    private $details;
    
    Public function LireAnnée()
    {
        include('connexion.php');
$bdd = new PDO('mysql:host=localhost;dbname=annee','root','') or die(print_r($bdd->errorInfo()));
        $bdd->exec('SET NAMES utf8');        
//connexion_annee();
        //$connexion=new connexion();
       // $connexion->connexion_annee();
        $req="SELECT * FROM annee";
       $ligne= $bdd->query($req);
       // foreach($bdd->query($req) as $row){
        //echo $row['0']." ".$row['1'];}

//$bdd->prepare($req);
        //$bdd->exec($bdd);
        //$ligne=$bdd->fletchAll();
        return $ligne;
    }
}
?>