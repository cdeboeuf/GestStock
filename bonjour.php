<?php 
include('menu.class.php');
function annee(){
    $nomlogiciel=nomlogiciel();?>
<h1><?php echo $nomlogiciel." ".$_SESSION['annee']; ?></h1><?php }

function nomlogiciel()
{
    return "PardéStock";
}

function bonjour(){
    echo "Bienvenue ".$_SESSION['nom']." (".$_SESSION['nomtype'].")";
}

function onglet()
{
    return '<link rel="icon" type="image/x-icon" href="img/favicon.ico" />
<!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" /><![endif]-->
        <title>PardeStock</title>';
            
}

function logoP()
{
                    
                      echo '<img src="img/logo.png" width="75px" height="33px"></img>';
                                          
}

function logo()
{
                    $menu=new Menu();
                    $lesMenus=$menu->affiche_sous_menu('Accueil.php');
                    foreach ($lesMenus as $UnMenu)                        
                     {                    
                     $UnMenu['Madresse'];
                     }            
                     if(isset($UnMenu['Madresse']))
                         {
                     echo '<a href="'.$UnMenu['Madresse'].'"><img src="img/logo.png" width="75px" height="33px"></img></a>';
                         }else {  echo '<img src="img/logo.png" width="75px" height="33px"></img>';}
}
?>