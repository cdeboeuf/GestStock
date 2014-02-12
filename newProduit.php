<!DOCTYPE html>

<?php

include('produit.class.php');
$produit = new produit();

if(!isset($_SESSION['idVisiteur'])) 
{header('location: index.php');  }


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
                <h1><small>Produit</small></h1>
            </div>
            <?php include('Menu.php');
            $menu=new Menu();
            $page=pathinfo($_SERVER['PHP_SELF']);
            $menu->Verifdroit($page['basename']);?>
            <div class="span12">
                <ul class="nav nav-tabs" id="profileTabs">
                    <li  class="active"><a href="./stockeProduit1.php">Mode</a></li>
                    <li><a href="./stockeProduit2.php">Esthétique</a></li>
                    <li><a href="./stockeProduit3.php">Objet Confectionné</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active">   
                        <div class="hero-unit" style="background-color: #FFECFF">
                            <div class="row-fluid">
                                
                                <form  method="GET" action="newProduit1.php">
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
                                            Référence Fournisseur
                                        </th>

                                        <th>
                                            Fournisseur
                                        </th>

                                        <th>
                                            Désignation
                                        </th>

                                        <th>
                                            Quantité Totale
                                        </th>
                                        
                                        <th>
                                            Coloris
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $Resultat = $produit->GetValorisationStockMODE();
                                        $nb=0;
                                        foreach ($Resultat as $value) 
                                        {?>
                                                <tr>
                                                    <td>
                                                        <?php $id = "id$nb"; $nb++;?>
                                                        <?php $idlien = $value["RefFournisseur"]; ?>
                                                        <?php $lien = "newProduit1.php?num=$idlien"; ?> 
                                                        <input type="button" name="lien1" value="<?php echo $value["Id"] ?>" onclick="self.location.href='<?php echo $lien?>'"> 
                                                        <?php 
                                                    echo "</td>";
                                                    echo "</td>";
                                                    echo "<td>";
                                                    echo $value["RefLycee"];
                                                    ?>
                                                    <input type="hidden" name="RefLycee<?php echo $nb ?>" id="RefLycee<?php echo $nb ?>" value="<?php echo $value["RefLycee"] ?>">
                                                    <?php
                                                    echo "</td>";
                                                    echo "<td>";
                                                    echo $value["RefFournisseur"];
                                                    ?>
                                                    <input type="hidden" name="RefFournisseur<?php echo $nb ?>" id="RefFournisseur<?php echo $nb ?>" value='<?php echo $value["RefFournisseur"]; ?>'>
                                                    <?php
                                                    echo "</td>";
                                                    echo "<td>";
                                                    echo $value["Nom"];
                                                    echo "</td>";
                                                    echo "<td>";
                                                    echo $value["Designation"];
                                                    echo "</td>";
                                                    echo "<td>";
                                                    echo $value["QuantiteTotal"];
                                                    echo "</td>";
                                                    echo "<td>";
                                                    echo $value["Coloris"];
                                                    echo "</td>";
                                                echo "</tr>";
                                        }


                                    ?>
                                </tbody>
                                    <br>
                                </table>
                                <br>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            
        </div>
        <!--Js -->
        </script> 
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>

