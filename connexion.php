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
//Connexion à la base de donnée Parde.
function connexion_parde()
{
    try
    {
                    // Variable qui ajoutera l'attribut selected de la liste déroulante
                    $selected = '';
                    // Parcours du tableau
                    echo '<select name="annees">',"\n";
                    for($i=1992; $i<=2030; $i++)
                    {
                        // L'année est-elle l'année courante ?
                        if($i == date('Y'))
                        {
                        $selected = ' selected="selected"';
                        }
                        // Affichage de la ligne
                        echo "\t",'<option value="', $i ,'"', $selected ,'>', $i ,'</option>',"\n";
                        // Remise à zéro de $selected
                        $selected='';
                    }
                    
        $bdd = new PDO('mysql:host=localhost;dbname='.$selected.'','root','') or die(print_r($bdd->errorInfo()));
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
