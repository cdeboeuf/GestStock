<?php
include('connexion.php');
include('objetConfectionne.class.php');
if(!isset($_SESSION['idVisiteur'])) 
{header('location: index.php');  }

$LesOc=new ObjectConfectionne();
$OcNc=$LesOc->affiche_objetNC();
$OcC=$LesOc->affiche_objetC();
?>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!--CSS -->
        <link rel="stylesheet"  href="css/bootstrap-responsive.min.css">
        <link rel="stylesheet"  href="css/bootstrap.min.css">
        <!--responsive -->
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
    </head>
    <body>
        <div class="container-fluid">
            <div class="page-header"> 
                <h1><small>Objets Confectionnés</small></h1>
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
                 <label for='OcNc'>Objets confectionnés non cloturés :</label>
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
                         
                        <label for='OcC'>Objets confectionnés cloturés :</label>
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
           </div>
        </div>
        <!--Js -->
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
