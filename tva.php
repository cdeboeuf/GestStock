<?php  include('bonjour.php');  include('connexion.php');
include('tva.class.php');

if(!isset($_SESSION['idVisiteur'])) 
{header('location: index.php');  }

$tvaP= new Tva();                

if(isset($_POST['tva']))
{
   $rep= $tvaP->ajout_Tva($_POST['tva']);

}
if(isset($_POST['tvaSup']))
{
   $rep= $tvaP->supprimer_Tva($_POST['tvaSup']);

}
$LesTva= $tvaP->affiche_Tva();

?> 

<html>
    <head>
        <?php echo $onglet=onglet();?>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!--CSS -->
             <link rel="stylesheet"   media="screen" href="css/bootstrap-responsive.min.css">
        <link rel="stylesheet"   media="screen" href="css/bootstrap.min.css">
        <link rel="stylesheet" media="print" href="css/print.css" type="text/css">
        <!--responsive -->
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
    </head>
    <body>
        <div class="container-fluid">
            
            <div class="page-header">
                <table>
               <th> <td><?php logo() ?></td><td><?php annee()?><h1><small>Parametre</small></h1>
                <?php bonjour() ?></td></th></table>
            </div> 
            <?php include('Menu.php');
            $menu=new Menu();
               $page=pathinfo($_SERVER['PHP_SELF']);
           $menu->Verifdroit($page['basename']);
           ?><div class="span12"> 
                <ul class="nav nav-tabs" id="profileTabs">
                    <?php include('parametre.php');?>                  
                                 
                </ul>
<!--                <ul class="nav nav-tabs" id="profileTabs">
                    <li  class="active"><a href="./parametre.php">Modifier le taux de TVA</a></li>
                    <li><a href="./uniteAchat.php">Modifier une unité d'achat</a></li>
                    <li><a href="./coutMachine.php">Modifier le coût machine</a></li>
                    <li><a href="./coefCorrection.php">Modifier le coefficient de correction</a></li>   
                    <li><a href="./gestionMenu.php">Gerer les menus</a></li>                   
                                
                </ul>-->
                      <div class="hero-unit"> 
                      <div class="row-fluid">
                      
                             <?php if(isset($rep)){ 
                             if ($rep=="Le taux de tva a été ajouté"){?>
                             <div class="alert alert-success "><?php echo $rep;} else{?></div>
                         <div class="alert alert-danger"><?php echo $rep;}?></div>
                         <?php } ?>
                        
                     <div class='span4'>
                         <label class="badge" for="tvaP">Les taux de TVA déjà enregistrés :</label>
                 <form name="tvaSup" action="tva.php" method="post">
                 <SELECT name="tvaSup" id="tvaP">
                  <?php
                 foreach ($LesTva as $unetva)               
                     {
                 
                     ?>
                        <option value='<?php echo $unetva['taux'] ?>'><?php echo number_format($unetva['taux'],2,$dec_point = ',' ,$thousands_sep = ' ')." (Utilisation:".$unetva['utiliser'].")"?></option>
                     <?php }
                  ?>          
                 </SELECT>
                     <button type="submit" class="btn btn-danger">Supprimer</button>
                     </form>
                     </div>
                      <div class='span4'>
                <form class="span3" name="tvanew" action="tva.php" method="post">
                    <label class="badge" for="tva">Nouveau taux de TVA :</label> <input type="text" name="tva" id="tva"/>
                    <button type="submit" class="btn btn-success">Envoyer</button>
                </form>
                </div>
                         
                         <br><br><br><br>
            </div><div class="alert alert-info">Vous ne pouvez pas supprimer un taux de TVA utilisé</div>
        </div>
        <!--Js -->
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
