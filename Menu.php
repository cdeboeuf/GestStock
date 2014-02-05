<!DOCTYPE html>
<?php 
include('menu.class.php');
?>

                <div class="span3">
                     <ul class="unstyleds"> 
                    <?php 
                    $menu=new Menu();
                    $lesMenus=$menu->affiche_menu();
                    foreach ($lesMenus as $UnMenu)                        
                     {
                        ?><li style='list-style-type: none;'><a href="<?php echo $UnMenu['Adresse']?>" class="btn btn-primary btn-block" ><?php echo $UnMenu['Details']?></a></li>
                    <br>
                        <?php    
                     }
                    ?>
                         </ul>
                </div>