<!DOCTYPE html>
<?php 
include('bonjour.php');  
include('produit.class.php');
$produit = new produit();
if(!isset($_SESSION['idVisiteur'])) 
{header('location: index.php');  }
$Oc=$produit->TOC();
$Mode=$produit->TMode();
$Esth=$produit->TEsthetique();
 
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
    <body onload="print();">
        <div class="container-fluid ">
          
            <div class="page-header">
                <table>
               <th> <td><?php logo() ?></td><td><?php annee()?><h1><small>Accueil</small></h1>
                <?php bonjour() ?></td></th></table>
            </div> 
            <?php include('Menu.php');?>
            <div class="span12">
                <div class="tab-content">
                    <div class="tab-pane active">   
                        <div class="hero-unit-tab" style="background-color:#CEF6CE" >
                           <div class="row-fluid "  >                                                                     
                                                 
                                   <table class="table table-bordered table-striped table-condensed" >
                                    <caption> Tableau des produits modes </caption>
                        <thead>  
                                    <tr>
                                        <th>
                                            ID
                                        </th>

                                                  <th>
                                            Référence Lycée
                                          
                                        </th>

                                        <th>Référence Fournisseur
                                           
                                        </th>

                                        <th>
                                            Fournisseur
                                         
                                            </th>

                                        <th>
                                            Désignation
                                        </th>

                                        <th>
                                            Quantité
                                        </th>
                                        
                                        <th>
                                            Coloris
                                        </th>

                                        <th>
                                            Prix Pondéré
                                        </th>
                                        
                                        <th>
                                            Total
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                                                      
                                        foreach ($Mode as $value) 
                                        {?>
                                                <tr>
                                                    <td>
                                                        <?php echo $value["Id"] ?> 
                                                        <?php 
                                                    echo "</td>";
                                                    echo "</td>";
                                                    echo "<td>";
                                                    echo $value["RefLycee"];
                                                    echo "</td>";
                                                    echo "<td>";
                                                    echo $value["RefFournisseur"];
                                                    echo "</td>";
                                                    echo "<td>";
                                                    echo $value["Nom"];
                                                    echo "</td>";
                                                    echo "<td nowrap>";
                                                    echo $value["Designation"];
                                                    echo "</td>";
                                                    echo "<td>";
                                                   echo number_format($value["QuantiteTotal"],2,$dec_point = ',' ,$thousands_sep = ' '); 
                                                    echo "</td>";
                                                    echo "<td>";
                                                    echo $value["Coloris"];
                                                    echo "</td>";
                                                    echo "<td nowrap>";
                                                    echo number_format($value["PUTTCPondere"],4,$dec_point = ',' ,$thousands_sep = ' ');
                                                  
                                                    echo "</td>";
                                                    echo "<td nowrap>";
                                                    echo number_format($value['Total'],2,$dec_point = ',' ,$thousands_sep = ' ') ;
                                                 
                                                    echo "</td>";
                                                echo "</tr>";
                                
                                                
                                        }


                                    ?>
                                </tbody>
                                    <br>
                                </table>
                               
                                <br>
                            </div>
                        </div>
                                               <div class="hero-unit-tab" style="background-color:#F6CECE" >
                           <div class="row-fluid "  >                                                                     
                                                 
                                   <table class="table table-bordered table-striped table-condensed" >
                                    <caption> Tableau des produits esthétique </caption>
                        <thead>  
                                    <tr>
                                        <th>
                                            ID
                                        </th>

                                                  <th>
                                            Référence Lycée
                                          
                                        </th>

                                        <th>Référence Fournisseur
                                           
                                        </th>

                                        <th>
                                            Fournisseur
                                         
                                            </th>

                                        <th>
                                            Désignation
                                        </th>

                                        <th>
                                            Quantité
                                        </th>
                                        
                                        <th>
                                            Coloris
                                        </th>

                                        <th>
                                            Prix Pondéré
                                        </th>
                                        
                                        <th>
                                            Total
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                                                      
                                        foreach ($Esth as $value) 
                                        {?>
                                                <tr>
                                                    <td>
                                                        <?php echo $value["Id"] ?> 
                                                        <?php 
                                                    echo "</td>";
                                                    echo "</td>";
                                                    echo "<td>";
                                                    echo $value["RefLycee"];
                                                    echo "</td>";
                                                    echo "<td>";
                                                    echo $value["RefFournisseur"];
                                                    echo "</td>";
                                                    echo "<td>";
                                                    echo $value["Nom"];
                                                    echo "</td>";
                                                    echo "<td nowrap>";
                                                    echo $value["Designation"];
                                                    echo "</td>";
                                                    echo "<td>";
                                                   echo number_format($value["QuantiteTotal"],2,$dec_point = ',' ,$thousands_sep = ' '); 
                                                    echo "</td>";
                                                    echo "<td>";
                                                    echo $value["Coloris"];
                                                    echo "</td>";
                                                    echo "<td nowrap>";
                                                    echo number_format($value["PUTTCPondere"],4,$dec_point = ',' ,$thousands_sep = ' ');
                                                  
                                                    echo "</td>";
                                                    echo "<td nowrap>";
                                                    echo number_format($value['Total'],2,$dec_point = ',' ,$thousands_sep = ' ') ;
                                                 
                                                    echo "</td>";
                                                echo "</tr>";
                                
                                                
                                        }


                                    ?>
                                </tbody>
                                    <br>
                                </table>
                               
                                <br>
                            </div>
                        </div>
                        <div class="hero-unit-tab" style="background-color:#CEF6CE">
                        <div class="row-fluid"> 
                            <form  method="GET" action="Accueil3.php">
                        <table class="table table-bordered table-striped table-condensed">
                                    <caption> Tableau des produits objets confectionnés</caption>
                        <thead>  
                                    <tr>
                                        <th>
                                            ID
                                        </th>

                                          <th>
                                            Référence Lycée
                                            
                                        </th>

                                        <th>
                                            Désignation
                                        </th>

                                        <th>
                                            Quantité
                                        </th>
                                        
                                        <th>
                                            Prix unitaire éleve
                                        </th>

                                        <th>
                                            Prix unitaire public
                                        </th>
                                        
                                        <th>
                                            Total public
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                                                        
                                        foreach ($Oc as $value) 
                                       {?>
                                                <tr>
                                                    <td><?php
                                                   
                                                       echo $value["Id"] ?>
                                                 <?php     
                                                  
                                                    echo "</td>";
                                                    echo "</td>";
                                                    echo "<td>";
                                                    echo $value["Ref"];                       
                                                    echo "</td>";
                                                    echo "<td nowrap>";
                                                    echo $value["Designation"];
                                                    echo "</td>";
                                                    echo "<td>";
                                                    echo number_format($value["Quantite"],2,$dec_point = ',' ,$thousands_sep = ' ');
                                                
                                                    echo "</td>";
                                                    echo "<td nowrap>";
                                                    echo number_format($value["PrixEleveUnitaire"],2,$dec_point = ',' ,$thousands_sep = ' ');
                                                    echo "</td>";
                                                    echo "<td nowrap>";
                                                    echo number_format($value["PrixUnitairePublic"],2,$dec_point = ',' ,$thousands_sep = ' ');
                                                
                                                    echo "</td>";
                                                    echo "<td nowrap>";
                                                   echo number_format($value['TotalP'],2,$dec_point = ',' ,$thousands_sep = ' ');                                                                                                                               
                                                    echo "</td>";
                                                echo "</tr>";
                                
                                            


                                        }  ?>
                                </tbody>
                                    <br>
                                </table>
                           
                                <br>
                            </div>
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