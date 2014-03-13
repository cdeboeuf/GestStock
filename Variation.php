<?php

include ('produit.class.php');
$var=new Produit();
include('bonjour.php');  
if(!isset($_SESSION['idVisiteur'])) 
{header('location: index.php');  }
$esth=$var-> variationMS("esthetique");
$SIE=$esth[0];
$SFE=$esth[1];
$totalE=$esth[2];
$mode=$var-> variationMS("mode");
$SIM=$mode[0];
$SFM=$mode[1];
$totalM=$mode[2];
$oc=$var->variationO();
$SIO=$oc[0];
$SFO=$oc[1];
$totalO=$oc[2];
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
               <th> <td><?php logo() ?></td><td><?php annee()?><h1><small>Variation de stock</small></h1>
                <?php bonjour() ?></td></th></table>
            </div> 
            <?php include('Menu.php');
           ?>
            <div class="span12">
                <div class="menu">
 <ul class="nav nav-tabs" id="profileTabs">
                    <?php include('Inventaire.php');?>                  
                                 
                </ul></div>
                <div class="tab-content">
                    <div class="tab-pane active">   
                        <div class="hero-unit-tab">
<table class="table table-bordered table-striped table-condensed">
    <td>
Compte financier annee <?php echo $_SESSION['annee'] ?>
<br>Filiere ECP
<br>Variation de stock = <br><?php echo $SFE?> - <?php echo $SIE?> = <?php echo $totalE?> €
</td>
    <td>
Compte financier annee <?php echo $_SESSION['annee'] ?>
<br>Filiere MMM consommable
<br>Variation de stock = <br><?php echo $SFM?> - <?php echo $SIM?> = <?php echo $totalM?>  €
</td>
    <td>
Compte financier annee <?php echo $_SESSION['annee'] ?>
<br>Filiere MMM OC
<br>Variation de stock = <br><?php echo $SFO?> - <?php echo $SIO?> = <?php echo $totalO?> €
</td>
<td>
<?php $total= $totalO+$totalM+$totalE;?>
Compte financier annee <?php echo $_SESSION['annee'] ?>
<br>Variation de stock general = <br> <?php echo $totalO ?> + <?php echo $totalM ?> + <?php echo $totalE ?> = <?php echo number_format($total,2); ?>€
</td>
</table>
                            <form method="POST">
                            <input type="button" value="Imprimer cette page" onClick="window.print()"></form>
                        </div>
                    </div>
                </div>
            </div>       
        </div>
        <!--Js -->
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
