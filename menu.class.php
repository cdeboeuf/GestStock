<?php
//include('connexion.php');
class Menu
{
    private  static $bdd;

    function __construct() 
    {
        Menu::$bdd=connexion_base($_SESSION['annee']);
        Menu::$bdd->query("SET CHARACTER SET utf8"); 
    }    
 
    function affiche_menu()
    {
        $req="SELECT * From typeuser INNER JOIN menu ON typeuser.Id=menu.Idtype INNER JOIN lien ON menu.IdLien=lien.Id WHERE typeuser.Id=".$_SESSION['type'].";" ;  
        $rs = Menu::$bdd->query($req);
        return $result = $rs->fetchAll();
    }


}
?>
