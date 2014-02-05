<!DOCTYPE html>
<?php 
include('menu.class.php');
?>
   
<div class="span2">
 
                    <?php 
                    $menu=new Menu();
                    $lesMenus=$menu->affiche_menu();
                    foreach ($lesMenus as $UnMenu)                        
                     {
                        ?><a href="<?php echo $UnMenu['Adresse']?>" class="btn btn-primary btn-block" ><?php echo $UnMenu['Details']?></a>
                    
                        <?php    
                     }
                    ?>
                        
             
</div>