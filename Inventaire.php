<!DOCTYPE html>

<?php
include('produit.class.php');
$produit = new produit();

if(isset($_POST['action']))
 if (isset($_POST['action'])=='envoyer')
 {
     if(isset($_POST['QuantiteTotal'])) 
     {
                extract($_POST);
                for ($i = 0; $i<= count($_POST["QuantiteTotal"])-1; $i++)
                {     
                    $QuantiteTotal1=$QuantiteTotal[$i];
                    $nb=$id[$i];            
                    $produit->MajValorisationStock($QuantiteTotal1, $nb);
                }
                
      }     
 }
        
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
            
                <ul class="nav nav-tabs" id="profileTabs">
                    <li class="active"><a href="./Inventaire.php">Mode</a></li>
                    <li><a href="./Inventaire2.php">Esthétique</a></li>
                    <li><a href="./Inventaire3.php">Objet Confectionné</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active">         
                        <div class="hero-unit" style="background-color: #FFECFF">
                            <div class="row-fluid">
                                <div class="span1"></div>                
                                <form class="span3" method="POST" action="Produit1.php">
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

                                            <th>
                                                Prix Pondéré
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $Resultat = $produit->GetValorisationStockMODE();
                                            foreach ($Resultat as $value) 
                                            {
                                                    echo "<tr>";
                                                        echo "<td>";
                                                        echo $value["Id"];
                                                        ?><input type="hidden" name="id[]" id="id" value="<?php echo $value["Id"] ?>">
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
                                                        echo "<td>";
                                                        echo $value["Designation"];
                                                        echo "</td>";
                                                        echo "<td>";
                                                        ?>  
                                                            <div class="controls">
                                                                <input type="text" name="QuantiteTotal[]" id="QuantiteTotal" value="<?php echo $value["QuantiteTotal"] ?>"/>
                                                            </div>
                                                        <?php
                                                        echo "</td>";
                                                        echo "<td>";
                                                        echo $value["Coloris"];
                                                        echo "</td>";
                                                        echo "<td>";
                                                        echo $value["PATTCPondere"];
                                                        echo "</td>";
                                                    echo "</tr>";
                                            }


                                        ?>
                                    <tbody>
                                    <br>
                                </table>
                                <br>
                                <button type="submit" class="btn btn-primary" value="envoyer" name="action" onClick="return confirm('Etes-vous sûr de vouloir modifier le tableau?');">Valider</button>
                                <button type="submit" class="btn btn-primary" onClick="window.print()">Imprimer</button>
                                </form>
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

