<!DOCTYPE html>

<?php
include('produit.class.php');
$produit = new produit();
if(!isset($_SESSION['idVisiteur'])) 
{header('location: index.php');  }
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
           $menu->Verifdroit('Inventaire1.php');?>
            <div class="span12">
                <ul class="nav nav-tabs" id="profileTabs">
                    <li><a href="./Inventaire1.php">Mode</a></li>
                    <li class="active"><a href="./Inventaire2.php">Esthétique</a></li>
                    <li><a href="./Inventaire3.php">Objet Confectionné</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active">   
                        <div class="hero-unit" style="background-color: #FFECFF">
                            <div class="row-fluid">                                         
                                <form  method="POST" action="Inventaire2.php">
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
                                        
                                        <th>
                                            Total
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $Resultat = $produit->GetValorisationStockEST();
                                        $nb=0;
                                        foreach ($Resultat as $value) 
                                        {?>
                                                <tr>
                                                    <td><?php
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
                                                            <input type="text" name="QuantiteTotal[]" class="input-mini" id="QuantiteTotal<?php echo $nb ?>" value="<?php echo $value["QuantiteTotal"] ?>"
                                                             OnKeyUp="javascript:calcul(<?php echo $nb?>);">
                                                        </div>
                                                    <?php
                                                    echo "</td>";
                                                    echo "<td>";
                                                    echo $value["Coloris"];
                                                    echo "</td>";
                                                    echo "<td>";
                                                    echo $value["PUTTCPondere"];
                                                    ?><input type="hidden" name="PUTTCPondere[]" id="PUTTCPondere<?php echo $nb ?>" value="<?php echo $value["PUTTCPondere"] ?>">
                                                   <?php 
                                                    echo "</td>";
                                                    echo "<td>";
                                                    ?>  
                                                        <div class="controls">
                                                            <input type="text" name="Total" class="input-small" disabled="disabled" id="Total<?php echo $nb ?>"  value="<?php echo number_format($value['Total'],2) ?>">
                                                        </div>
                                  
                                                    <?php
                                                    
                                                    echo "</td>";
                                                echo "</tr>";
                                
                                                $nb=$nb+1;
                                        }


                                    ?>
                                </tbody>
                                    <br>
                                </table>
                                <br>
                                <button type="submit" class="btn btn-success" value="envoyer" name="action" onClick="return confirm('Etes-vous sûr de vouloir modifier le tableau?');">Valider</button>
                                <button type="submit" class="btn btn-primary" onClick="window.print()">Imprimer</button>
                                </form>
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

