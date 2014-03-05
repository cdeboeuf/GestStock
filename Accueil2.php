<!DOCTYPE html>
<?php
include('bonjour.php'); 
include('produit.class.php');
$produit = new produit();
if(!isset($_SESSION['idVisiteur'])) 
{header('location: index.php');  }
        include('pagination.php');
$pagination=new Pagination();
if(isset($_POST['trie']))
{
     $resultat = $produit->GetValorisationStockMODEFournisseurTrie($_POST['four'],$_POST['trie']);
                                        $Resultat=$resultat[0];
                                        $nbPages=$resultat[1];
                                        $pageCourante=$resultat[2];
}
 $resultat = $produit->GetValorisationStockEST();
                                        $Resultat=$resultat[0];
                                        $nbPages=$resultat[1];
                                        $pageCourante=$resultat[2];
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
               <th> <td><?php logo() ?></td><td><?php annee()?><h1><small>Accueil</small></h1>
                <?php bonjour() ?></td></th></table>
            </div> 
            <?php include('Menu.php');?>
            <div class="span12">
                <ul class="nav nav-tabs" id="profileTabs">
                    <li><a href="./Accueil1.php">Mode</a></li>
                    <li class="active"><a href="./Accueil2.php">Esthétique</a></li>
                    <li><a href="./Accueil3.php">Objet Confectionné</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active">   
                        <div class="hero-unit-tab" style="background-color: #FFECFF">
                            <div class="row-fluid">                                                                        
                                                <form  method="GET" action="historique.php"> <table class="table table-bordered table-striped table-condensed">
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
                                           $nb=0;                            
                                        foreach ($Resultat as $value) 
                                        {?>
                                                <tr>
                                                    <td> <?php $id = "id$nb"; $nb++;?>
                                                        <?php $idlien = $value["RefLycee"]; ?>
                                                       
                                                        <?php $lien = "historique.php?num=$idlien"; ?> 
                                                        <input type="button" name="lien1" value="<?php echo $value["Id"] ?>" onclick="self.location.href='<?php echo $lien?>'"> 
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
                                                    echo number_format($value["PUTTCPondere"],2,$dec_point = ',' ,$thousands_sep = ' ');
                                                  
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
                                   </form>
                                <br>
                                <?php                 
                                        $pagination->affiche('Accueil2.php','idPage',$nbPages,$pageCourante,2);?>
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

