<?php
class ObjectConfectionne
{
    private  static $bdd;

    function __construct() 
    {
        ObjectConfectionne::$bdd=connexion_base($_SESSION['annee']);
        ObjectConfectionne::$bdd->query("SET CHARACTER SET utf8"); 
    }     

    function affiche_objetNC()
    {
        $req="SELECT * FROM objetconfectionne INNER JOIN users on objetconfectionne.professeur=users.Id where NbRealise = '';";
        $rs = ObjectConfectionne::$bdd->query($req);
        $result = $rs->fetchAll();
        return $result;
    }
        function affiche_objetC()
    {
        $req="SELECT * FROM objetconfectionne INNER JOIN users on objetconfectionne.professeur=users.Id where NbRealise != '';";
        $rs = ObjectConfectionne::$bdd->query($req);
        $result = $rs->fetchAll();
        return $result;
    }
    
    function NumOrdre()
    {
        $req="SELECT max(Id)As ordre FROM objetconfectionne";
        $rs=ObjectConfectionne::$bdd->query($req);
        return $result=$rs->fetchAll();
    }
    
}
?>
