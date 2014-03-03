<?php
include('bonjour.php'); 
include('connexion.php');
include('objetConfectionne.class.php');
if(!isset($_SESSION['idVisiteur'])) 
{header('location: index.php');  }
//tadda
$LesOc=new ObjectConfectionne();
$OcNc=$LesOc->affiche_objetNC();
$OcC=$LesOc->affiche_objetC();
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
               <th> <td><?php logo() ?></td><td><?php annee()?><h1><small>Objets confectionnés</small></h1>
                <?php bonjour() ?></td></th></table>
            </div> 
            <?php include('Menu.php');
            $menu=new Menu();
            $page=pathinfo($_SERVER['PHP_SELF']);
            $menu->Verifdroit($page['basename']);
           ?><div class="span12">
                   <div class="hero-unit"> 
                       <div class="row-fluid">                      
                           <form name="OcNc" action="CreeobjetConfectionne.php" method="post">
                           <button type="submit" class="btn btn-success">Crée un nouvel objet confectionné</button>
                           </form>
                  
                  <form name="OcNc" action="voirOcNonCloturer.php" method="post">
                 <label for='OcNc'>Objets confectionnés non clôturés :</label>
                 <SELECT name="OcNc" id="OcNc">
                  <?php
                 foreach ($OcNc as $unOcNc)               
                     {
                 
                     ?>
                        <option value='<?php echo $unOcNc['Ref'] ?>'><?php echo $unOcNc['Ref']." ".$unOcNc['Designation']?></option>
                     <?php }
                  ?>          
                 </SELECT>
                     <button type="submit" class="btn btn-info">Voir</button>
                     </form>
                     
                           
                           
                    <form name="OcC" action="voirOcCloturer.php" method="post">
                         
                        <label for='OcC'>Objets confectionnés clôturés :</label>
                        <SELECT name="OcC" id="OcC">
                  <?php
                 foreach ($OcC as $unOcC)               
                     {
                 
                     ?>
                        <option value='<?php echo $unOcC['Ref'] ?>'><?php echo $unOcC['Ref']." ".$unOcC['Designation']?></option>
                     <?php }
                  ?>          
                 </SELECT>
                     <button type="submit" class="btn btn-info">Voir</button>
                     </form>
                       </div>                    
                   </div>
               <input type="button" value="Imprimer cette page" onClick="window.print()">
           </div>
        </div>
        <!--Js -->
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
