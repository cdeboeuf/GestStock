<?php

//Connexion à la base de donnée année.
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
        echo"go";
        return $bdd;
        
    }
    catch(Exception $e)
    {
        die('erreur: ' . $e->getMessage());
    }
}
?>