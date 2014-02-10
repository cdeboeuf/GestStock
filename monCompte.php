if(!isset($_SESSION['idVisiteur'])) 
{header('location: index.php'); 
$menu=new Menu();
              $page=pathinfo($_SERVER['PHP_SELF']);
           $menu->Verifdroit($page['basename']);}
Changer le mot de passe de l'utilisateur courent<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
