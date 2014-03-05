<?php  include('bonjour.php');  include('connexion.php');
include('parametre.class.php');
$Parametre= new Parametre();
if(!isset($_SESSION['idVisiteur'])) 
{header('location: index.php');  }
if(isset($_POST['coef']))
{
   $rep= $Parametre->modif_CoefCorrection($_POST['coef']);

}
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
           $menu->Verifdroit('parametre.php');?>
           
                  <div class="span12"> 
                <ul class="nav nav-tabs" id="profileTabs">
                    <li ><a href="./parametre.php">Modifier le taux de TVA</a></li>
                    <li><a href="./uniteAchat.php">Modifier une unité d'achat</a></li>
                    <li><a href="./coutMachine.php">Modifier le coût machine</a></li>
                    <li class="active"><a href="./coefCorrection.php">Modifier le coefficient de correction</a></li>   
                    <li><a href="./gestionMenu.php">Gérer les menus</a></li>                   
                             
                </ul><div class="hero-unit"> 
                    <?php if (isset($_POST['coef'])){
                      
                   ?>
                    <div class='alert alert-success'>
                      <?php echo $rep; ?>
                    </div> <?php } ?>
                    <div class='alert alert-info'>
                       Coefficient de correction actuel :
                    <?php $LesCout=$Parametre->affiche_CoefCorrection();
                    foreach ($LesCout as $unCout)
                    {
                    echo number_format($unCout['Details'],2,$dec_point = ',' ,$thousands_sep = ' ')." %";
                    }                  ?>
                </div>
                    <form class="span3" name="ModifCout" action="coefCorrection.php" method="post">
                    <label class="badge" for="coef">Modifier le coefficient :</label> <input type="text" name="coef" id="coef"/>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>
                    <br><br><br><br>
                </div>
                </div>
        </div>
        </div>
        <!--Js -->
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
