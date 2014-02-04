<?php

//Connexion à la base de donnée annee.
function connexion_annee()
{
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=annee','root','') or die(print_r($bdd->errorInfo()));
        $bdd->exec('SET NAMES utf8');
        return $bdd;
    }
    catch(Exception $e)
    {
        die('erreur: ' . $e->getMessage());
    }
}


//Connexion à la base de donnée de l'année passer en parametre
function connexion_base($annee)
{
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname='.$annee.'','root','') or die(print_r($bdd->errorInfo()));
        $bdd->exec('SET NAMES utf8');
        echo "Base de donnée ".$annee." connecté";
        $_SESSION['annee']=$annee;
        return $bdd;     
    }
    catch(Exception $e)
    {
        die('erreur: ' . $e->getMessage());
    }
}
function connecter($id,$nom,$type){
	$_SESSION['idVisiteur']= $id; 
	$_SESSION['nom']= $nom;
        $_SESSION['type']=$type;
}
function deconnecter(){
	session_destroy();
}
?>
