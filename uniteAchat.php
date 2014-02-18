<?php 
include('connexion.php');
include('unite.class.php');
$uniteP= new Unite();         
if(!isset($_SESSION['idVisiteur'])) 
{header('location: index.php');  }
if(isset($_POST['unite']))
{
   $rep= $uniteP->ajout_Unite($_POST['unite']);

}
if(isset($_POST['uniteSup']))
{
   $rep= $uniteP->supprimer_Unite($_POST['uniteSup']);

}
$LesUnite= $uniteP->affiche_Unite();
?> 

<html>
    <head>
        <title></title>
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
                <h1><small>Parametre</small></h1>
                </div>
            <?php include('Menu.php');
            $menu=new Menu();
           $menu->Verifdroit('parametre.php');?>
            
                  <div class="span12"> 
                <ul class="nav nav-tabs" id="profileTabs">
                    <li><a href="./parametre.php">Modifier le taux de TVA</a></li>
                    <li class="active"><a href="./uniteAchat.php">Modifier une unité d'achat</a></li>
                    <li><a href="./coutMachine.php">Modifier le coût machine</a></li>
                    <li><a href="./gestionMenu.php">Gerer les menus</a></li>                   
                    <li><a href="./coefCorrection.php">Modifier le coefficient de correction</a></li>               
                </ul>
                      <div class="hero-unit"> 
                      <div class="row-fluid">
                      
                             <?php if(isset($rep)){ 
                             if ($rep=="L'unité d'achat a été ajoutée"){?>
                             <div class="alert alert-success "><?php echo $rep;} else{?></div>
                         <div class="alert alert-danger"><?php echo $rep;}?></div>
                         <?php } ?>
                        
                     <div class='span4'>
                         <label class="badge" for="uniteP">Les unités d'achat déjà enregistrées:</label>
                 <form class="span3" name="uniteSup" action="uniteAchat.php" method="post">
                 <SELECT name="uniteSup" id="uniteP">
                  <?php
                 foreach ($LesUnite as $uneUnite)               
                     {
                     ?>
                        <option value='<?php echo $uneUnite['Details'] ?>'><?php echo $uneUnite['Details']." (Utilisation:".$uneUnite['utiliser'].")"?></option>
                    <?php }    
                  ?>          
                 </SELECT>
                     <button type="submit" class="btn btn-danger">Supprimer</button>
                     </form>
                     </div>
                      <div class='span4'>
                <form class="span3" name="unitenew" action="uniteAchat.php" method="post">
                    <label class="badge" for="unite">Nouvelle unitée :</label> <input type="text" name="unite" id="unite"/>
                    <button type="submit" class="btn btn-success">Envoyer</button>
                </form>
                </div>
                         
                         <br><br><br><br>
            </div>
                          <div class="alert alert-info">Vous ne pouvez pas supprimer une unité utilisée</div>
        </div>
        <!--Js -->
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
