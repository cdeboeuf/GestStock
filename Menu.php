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
        <div class="menu">
<div class="span2 tabbable tabs-left full-height">
    <ul class='nav nav-tabs full-height' id="TabModal">
 
                    <?php 
                    $page= pathinfo($_SERVER['PHP_SELF']);
                    $menu=new Menu();
                    $lesMenus=$menu->affiche_menu();
                    foreach ($lesMenus as $UnMenu)                        
                     {
                        
                        ?><li <?php if($page['basename']==$UnMenu['Madresse']) {echo "class='active'";}?>><a href="<?php echo $UnMenu['Ladresse']?>"><?php echo $UnMenu['Mdetail']?></a></li>
                    
                        <?php    
                     }?>
                        <li><a href="deconnexion.php">Déconnexion</a></li>
                    
                        
    </ul>
</div>
        </div>