<?php include('bonjour.php');  include('connexion.php');
include('parametre.class.php');
$Parametre= new Parametre();
if(!isset($_SESSION['idVisiteur'])) 
{header('location: index.php');  }
if(isset($_POST['cout']))
{
   $rep= $Parametre->modif_CoutMachine($_POST['cout']);

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
          $page=pathinfo($_SERVER['PHP_SELF']);
           $menu->Verifdroit($page['basename']);?>
           
                  <div class="span12"> 
               <div class="menu"> <ul class="nav nav-tabs" id="profileTabs">
                    <?php include('parametre.php');?>     
                </ul></div><div class="hero-unit"> 
                    <?php if (isset($_POST['cout'])){
                      
                   ?>
                    <div class='alert alert-success'>
                      <?php echo $rep; ?>
                    </div> <?php } ?>
                    <div class='alert alert-info'>
                       Coût Machine actuel :
                    <?php $LesCout=$Parametre->affiche_CoutMachine();
                    foreach ($LesCout as $unCout)
                    {
                    echo number_format($unCout['Details'],2,$dec_point = ',' ,$thousands_sep = ' ')." €";
                    }                  ?>
                </div>
                    <form  name="ModifCout" action="coutMachine.php" method="post">
                    <label class="badge" for="cout">Modifier le coût :</label> <input type="text" name="cout" id="cout"/>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </form>
                    <br><br><br><br>
                </div>
                </div>
        </div>
        <!--Js -->
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
