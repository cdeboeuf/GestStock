<!DOCTYPE html>
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
                    $leMenus=$menu->affiche_menu();
                     $TotalMenus=$leMenus[1];
                     if($TotalMenus==0){header("location: probleme.php");}
                    $lesMenus=$leMenus[0];
                    foreach ($lesMenus as $UnMenu)                        
                     {
                        
                        ?><li <?php if($page['basename']==$UnMenu['Madresse']) {echo "class='active'";}?>><a href="<?php echo $UnMenu['Ladresse']?>"><?php echo $UnMenu['Mdetail']?></a></li>
                    
                        <?php    
                     }
                     ?>
                        <li><a href="deconnexion.php">Déconnexion</a></li>
                    
                        
    </ul>
</div>
        </div>