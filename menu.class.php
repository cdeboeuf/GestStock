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
        function affiche_menu_user($type)
    {
        $req="SELECT * From typeuser INNER JOIN menu ON typeuser.Id=menu.Idtype INNER JOIN lien ON menu.IdLien=lien.Id WHERE typeuser.Id=".$type.";" ;  
        $rs = Menu::$bdd->query($req);
        return $result = $rs->fetchAll();
    }
    function affiche_pas_menu_user($type)
    {
         $req="SELECT * FROM lien  WHERE Id NOT IN ( SELECT idlien FROM menu WHERE idtype =$type)";
        $rs = Menu::$bdd->query($req);
        return $result = $rs->fetchAll();
    }
   
    function suprimer_menu_liste($idType,$IdMenu)
    {  
        if ($IdMenu!=null)
        {
        $req="Delete From menu where Idtype=$idType and IdLien=$IdMenu ";
        $rs = Menu::$bdd->query($req);
        }else
        {
            $reponce="Vous ne pouvz pas ajouter un menu qui n'existe pas.";
        }
    }
    function ajouter_menu_liste($idType,$IdMenu)
    {
        if ($IdMenu!=null)
        {
        $req="Insert Into menu(IdType,IdLien)values($idType,$IdMenu)";
        $rs = Menu::$bdd->query($req);
        }
        else
        {
            $reponce="Vous ne pouvez pas ajouter un menu qui n'existe pas.";
        }
    }
    
function Verifdroit($lien){
    $menuT=  $this->affiche_menu();
   $r=false;
    foreach ($menuT as $Unmenu)
    {

        if($lien==$Unmenu['Adresse'])
        {
            $r=true;
            break;
        }
    }
    if($r==false)
    {
       header('location:Accueil1.php');
    }
}

}
?>
