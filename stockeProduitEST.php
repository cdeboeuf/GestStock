<!DOCTYPE html>

<?php

include('produit.class.php');
$produit = new produit();
if(!isset($_SESSION['idVisiteur'])) 
{header('location: index.php');  }

        include('pagination.php');
$pagination=new Pagination();
 $resultat = $produit->GetValorisationStockEST();
                                        $Resultat=$resultat[0];
                                        $nbPages=$resultat[1];
                                        $pageCourante=$resultat[2];
?>



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
                <h1><small>Produit</small></h1>
            </div>
            <?php include('Menu.php');
            $menu=new Menu();
            $menu->Verifdroit('stockeProduit.php');?>

            <div class="span12">
                <ul class="nav nav-tabs" id="profileTabs">
                    <li><a href="./stockeProduit.php">Mode</a></li>
                    <li class="active"><a href="./stockeProduitEST.php">Esthétique</a></li>
                        <li><a href="./stockeProduitOC.php">Objet Confectionné</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active">   
                        <div class="hero-unit" style="background-color: #FFECFF">
                            <div class="row-fluid">
                                
                                <form  method="GET" action="stockeProduit1.php">
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
                                        $nb=0;
                                        foreach ($Resultat as $value) 
                                        {?>
                                                <tr>
                                                    <td>
                                                        <?php $id = "id$nb"; $nb++;?>
                                                        <?php $idlien = $value["RefFournisseur"]; ?>
                                                        <?php $idid = $value['Id']; ?>
                                                        <?php $lien = "stockeProduit1.php?num=$idlien&id=$idid"; ?> 
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
                                        
                                        <?php if(isset($_GET['rep']))
                                        {?>
                                            <div class="alert alert-success ">Le produit a été ajouté</div>
                                        <?php }?>
                                                    
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

