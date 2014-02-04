<!DOCTYPE html>

<?php
include('produit.class.php');
include("annee.class.php");
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

                    $nb=$i+1;

                    $produit->MajValorisationStock($QuantiteTotal1, $nb);
                    echo'Votre Quantite Total n°'.$nb.' à été modifiée.';
                    echo"<br>";
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
                <h1>
                <small>Produit</small></h1>
            </div>
            <div class="hero-unit">
                <div class="row-fluid">
                <div class="span1"></div>
                
                <form class="span3" method="POST" action="">
                <table border="1">
                    <caption> Tableau des produits </caption>
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
                            Coloris
                        </th>
                        
                        <th>
                            Quantité Total
                        </th>
                        
                        <th>
                            Prix Pondéré
                        </th>
                    </tr>
                        <?php
                            $Resultat = $produit->GetValorisationStock();
                            foreach ($Resultat as $value) 
                            {
                                echo "<tr>";
                                echo "<th>";
                                echo $Id = $value["Id"];
                                echo "</th>";
                                echo "<th>";
                                echo $value["RefLycee"];
                                echo "</th>";
                                echo "<th>";
                                echo $value["RefFournisseur"];
                                echo "</th>";
                                echo "<th>";
                                echo $value["Nom"];
                                echo "</th>";
                                echo "<th>";
                                echo $value["Designation"];
                                echo "</th>";
                                echo "<th>";
                                echo $value["Coloris"];
                                echo "</th>";
                                echo "<th>";
                                
                                ?>  
                                    <div class="controls">
                                        <input type="text" name="QuantiteTotal[]" id="QuantiteTotal" value="<?php echo $value["QuantiteTotal"] ?>"/>
                                    </div>
                                <?php
                                echo "</th>";
                                echo "<th>";
                                echo $value["PATTCPondere"];
                                echo "</th>";
                                echo "</tr>";
                            }
                            
		
                        ?>
                    </tr>
                    <br>
                </table>
                <br>
                <button type="submit" class="btn btn-primary" value="envoyer" name="action" onClick="return confirm('Etes-vous sûr de vouloir modifier le tableau?');">Valider</button>
                <button type="submit" class="btn btn-primary" onClick="window.print()">Imprimer</button>
                </form>
                
                </div>
            </div>
        </div>
        <!--Js -->
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>

