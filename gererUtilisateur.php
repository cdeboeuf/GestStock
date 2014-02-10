if(!isset($_SESSION['idVisiteur'])) 
{header('location: index.php');  }
Ajouter suprimer un utilisateur
  Mots de pass a 0 
    <?php
$menu=new Menu();
               $page=pathinfo($_SERVER['PHP_SELF']);
           $menu->Verifdroit($page['basename']);
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
