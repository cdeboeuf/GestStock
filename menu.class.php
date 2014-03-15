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
        $req="SELECT DISTINCT menu.Detail as Mdetail, menu.adresse as Madresse, MIN( lien.Adresse )as Ladresse , lien.Details as Ldetail
FROM typeuser
INNER JOIN acces ON typeuser.Id = acces.IdType
INNER JOIN lien ON acces.IdLien = lien.Id
INNER JOIN sousmenu ON lien.Id = sousmenu.sousmenu
INNER JOIN menu ON sousmenu.menu = menu.Id
WHERE typeuser.Id =  ".$_SESSION['type']."
GROUP BY menu.Detail, menu.adresse" ;  
        $rs = Menu::$bdd->query($req);
        $result = $rs->fetchAll();
        $resulta = $rs->rowCount();
        return array($result,$resulta);
    }
    function affiche_sous_menu($menu)
    {
        $req="SELECT  lien.Details as Mdetail, lien.adresse as Madresse
FROM typeuser
INNER JOIN acces ON typeuser.Id = acces.IdType
INNER JOIN lien ON acces.IdLien = lien.Id
INNER JOIN sousmenu ON lien.Id = sousmenu.sousmenu
INNER JOIN menu ON sousmenu.menu = menu.Id
WHERE typeuser.Id =".$_SESSION['type']." and menu.adresse='".$menu."' ORDER BY Madresse ASC;";
                
        $rs = Menu::$bdd->query($req);
        return $result = $rs->fetchAll();
    }
       function affiche_ss_menu()
    {
        $req="SELECT  lien.Details as Mdetail, lien.adresse as Madresse,lien.Adresse as ladresse
FROM typeuser
INNER JOIN acces ON typeuser.Id = acces.IdType
INNER JOIN lien ON acces.IdLien = lien.Id
INNER JOIN sousmenu ON lien.Id = sousmenu.sousmenu
INNER JOIN menu ON sousmenu.menu = menu.Id
WHERE typeuser.Id =".$_SESSION['type']." ;";
                
        $rs = Menu::$bdd->query($req);
        return $result = $rs->fetchAll();
    }
    
           function affiche_page()
    {
        $req="SELECT  lien.Details as Mdetail, lien.adresse as Madresse
FROM typeuser
INNER JOIN acces ON typeuser.Id = acces.IdType
INNER JOIN lien ON acces.IdLien = lien.Id
INNER JOIN sousmenu ON lien.Id = sousmenu.sousmenu
INNER JOIN menu ON sousmenu.menu = menu.Id
WHERE typeuser.Id =".$_SESSION['type']." ORDER BY Madresse LIMIT 0,1;";
                
        $rs = Menu::$bdd->query($req);
        $result = $rs->fetchAll();
        foreach ($result as $lien)
        {
            $lien['Madresse'];
        }
        return  $lien['Madresse'];
    }
    
        function affiche_menu_user($type)
    {
        $req="SELECT * From typeuser INNER JOIN Acces ON typeuser.Id=Acces.Idtype INNER JOIN lien ON Acces.IdLien=lien.Id WHERE typeuser.Id=".$type.";" ;  
        $rs = Menu::$bdd->query($req);
        return $result = $rs->fetchAll();
    }
    function affiche_pas_menu_user($type)
    {
         $req="SELECT * FROM lien  WHERE Id NOT IN ( SELECT idlien FROM Acces WHERE idtype =$type)";
        $rs = Menu::$bdd->query($req);
        return $result = $rs->fetchAll();
    }
   
    function suprimer_menu_liste($idType,$IdMenu)
    {  
        if ($IdMenu!=null)
        {
        $req="Delete From Acces where Idtype=$idType and IdLien=$IdMenu ";
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
        $req="Insert Into Acces(IdType,IdLien)values($idType,$IdMenu)";
        $rs = Menu::$bdd->query($req);
        }
        else
        {
            $reponce="Vous ne pouvez pas ajouter un menu qui n'existe pas.";
        }
    }
    
function Verifdroit($lien){
    $menuT=  $this->affiche_ss_menu();
   $r=false;
    foreach ($menuT as $Unmenu)
    {
        if($lien==$Unmenu['ladresse'])
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
