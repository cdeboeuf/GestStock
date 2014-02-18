<!DOCTYPE html>

<?php

include('produit.class.php');
$produit = new produit();

if(!isset($_SESSION['idVisiteur'])) 
{header('location: index.php');  }

if(isset($_POST['action1']))
{
    if (isset($_POST['action1'])=='envoyer1')
    {    
        extract($_POST);
        if(isset($_POST['chkb_1']))
        {
            $_POST['chkb_1']=1;
        }
        else
        {
            $_POST['chkb_1']=0;
        }
        if(!isset($_POST['PAHT']) && !isset($_POST['PATTC']))
        {
            $_POST['PAHT'] = 0;
            $_POST['PATTC'] = 0;
        }
        $rep = $produit->AddProduitMode($_POST['RefLycee'], $_POST['DateEntree'], $_POST['CodeTVA'], $_POST['chkb_1'],  $_POST['PAHT'], $_POST['PATTC'], $_POST['Quantite'], $_POST['id'], $_SESSION['idVisiteur']);
        
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
            <?php include('Menu.php');
            $menu=new Menu();
            $page=pathinfo($_SERVER['PHP_SELF']);
            $menu->Verifdroit($page['basename']);?>
            <div class="span12">
                <ul class="nav nav-tabs" id="profileTabs">
                    <li  class="active"><a href="./newProduit.php">Mode</a></li>
                    <li><a href="./newProduit2.php">Esthétique</a></li>
                    <li><a href="./newProduit4.php">Nouvelle ajout</a></li>
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
                                                        <?php $idid = $value['Id']; ?>
                                                        <?php $lien = "newProduit1.php?num=$idlien&id=$idid"; ?> 
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
                                        
                                        <?php if(isset($rep))
                                        {
                                                if ($rep=="Le produit à été ajouté.")
                                                    {?>
                                                        <div class="alert alert-success "><?php echo $rep;
                                                    } 
                                                else
                                                    {?>
                                                        </div>
                                                        <div class="alert alert-danger"><?php echo $rep;
                                                    }?>
                                                        </div>
                                    <?php
                                  
                                        }?>
                                                    
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

