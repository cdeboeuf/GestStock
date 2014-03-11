<!DOCTYPE html>
<?php 
//include('menu.class.php');
//include ('connexion.php');
?>
           <script type="text/javascript">
            $(document).ready(function(){
 
                $('.modal').addClass('in');
 
                $('#TabModal a:first').tab('show');
 
            });
        </script>
 
 
                    <?php 
                    $page= pathinfo($_SERVER['PHP_SELF']);
                    $menu=new Menu();
                    $lesMenus=$menu->affiche_sous_menu('Accueil.php');
                    foreach ($lesMenus as $UnMenu)                        
                     {
                      
                        ?><li <?php if($page['basename']==$UnMenu['Madresse']) {echo "class='active'";}?>><a href="<?php echo $UnMenu['Madresse']?>"><?php echo $UnMenu['Mdetail']?></a></li>
                    
                        <?php    
                     }?>                         
  