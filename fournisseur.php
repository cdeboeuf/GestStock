if(!isset($_SESSION['idVisiteur'])) 
{header('location: index.php');  }
ajouter suprimer un fournisseur
<?php
$menu=new Menu();
               $page=pathinfo($_SERVER['PHP_SELF']);
           $menu->Verifdroit($page['basename']);
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
