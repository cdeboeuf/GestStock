<!DOCTYPE html>

<?php
include('bonjour.php'); 
include('produit.class.php');
$produit = new produit();
if(!isset($_SESSION['idVisiteur'])) 
{header('location: index.php');  }  
include('pagination.php');
$pagination=new Pagination();
 $resultat = $produit->GetValorisationStockOC();
                                        $Resultat=$resultat[0];
                                        $nbPages=$resultat[1];
                                        $pageCourante=$resultat[2];
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
                <table>
               <th> <td><?php logo() ?></td><td><?php annee()?><h1><small>Accueil</small></h1>
                <?php bonjour() ?></td></th></table>
            </div> 
            <?php include('Menu.php');?>
            <div class="span12">
                <ul class="nav nav-tabs" id="profileTabs">
                    <li><a href="./Accueil1.php">Mode</a></li>
                    <li><a href="./Accueil2.php">Esthétique</a></li>
                    <li class="active"><a href="./Accueil3.php">Objet Confectionné</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active">   
                        <div class="hero-unit" style="background-color: #FFECFF">
                        <div class="row-fluid">                                                              
                        <table class="table table-bordered table-striped table-condensed">
                                    <caption> Tableau des produits </caption>
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
                                      
                                     
                                        foreach ($Resultat as $value) 
                                       {?>
                                                <tr>
                                                    <td><?php
                                                    echo $value["Id"];
                                                   
                                                  
                                                    echo "</td>";
                                                    echo "</td>";
                                                    echo "<td>";
                                                    echo $value["Ref"];                       
                                                    echo "</td>";
                                                    echo "<td>";
                                                    echo $value["Designation"];
                                                    echo "</td>";
                                                    echo "<td>";
                                                  echo $value["Quantite"];
                                                
                                                    echo "</td>";
                                                    echo "<td>";
                                                    echo $value["PrixEleveUnitaire"];
                                                    echo "</td>";
                                                    echo "<td>";
                                                    echo $value["PrixUnitairePublic"];
                                                
                                                    echo "</td>";
                                                    echo "<td>";
                                                   echo number_format($value['TotalP'],2);                                                                                                                               
                                                    echo "</td>";
                                                echo "</tr>";
                                
                                            


                                        }  ?>
                                </tbody>
                                    <br>
                                </table>
                                <br><?php                 
                                        $pagination->affiche('Accueil3.php','idPage',$nbPages,$pageCourante,2);?>
                                <button type="submit" class="btn btn-primary" onClick="window.print()">Imprimer</button>
                             
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            
        </div>
        <!--Js -->
               <script type="text/javascript">
        function calcul(nb)
        {
            result = parseFloat(document.getElementById('QuantiteTotal'+nb).value*document.getElementById('PUTTCPondere'+nb).value);
            result1 = result*100;          
            result2 = Math.round(result1); 
            result3 = result2/100; 
            document.getElementById('Total'+nb).value = result3;
        }
        </script> 
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>

