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
    

if(isset($_GET['trie']))
{
     $resultat = $produit->GetValorisationStockOCTrie($_GET['trie']);
                                        $Resultat=$resultat[0];
                                        $nbPages=$resultat[1];
                                        $pageCourante=$resultat[2];
}
if(isset($_GET['num'])){ header("location: historiqueOC.php?nom=".$_GET['num']."");}
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
               <th> <td><?php logo() ?></td><td><?php annee()?><h1><small>Sortir un produit</small></h1>
                <?php bonjour() ?></td></th></table>
            </div> 
            <?php include('Menu.php');
     
            $page=pathinfo($_SERVER['PHP_SELF']);
           $menu->Verifdroit($page['basename']);?>
            <div class="span12">
                 <div class="menu">  <ul class="nav nav-tabs" id="profileTabs">
                    <?php include('sortieProduit.php');?>                  
                                 
                </ul>
            </div>
                <div class="tab-content">
                    <div class="tab-pane active">   
                        <div class="hero-unit" style="background-color:#CEF6CE">
                            <div class="row-fluid">
                                
                                <form  method="GET" action="stockeProduitOC.php">
                                <table class="table table-bordered table-striped table-condensed">
                                    <caption> Tableau des produits </caption>
                                <thead>  
                                    <tr>
                              <th>
                                            ID
                                        </th>

                                          <th>
                                            Référence Lycée
                                            <div class="btn-group ">
                                            <button type="submit" class="btn btn-info btn-mini" name="trie" value="AscRLycee">A-Z</button>
                                            <button type="submit" class="btn btn-info btn-mini" name="trie" value="DescRLycee">Z-A</button>
                                            </div>
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
                                        $nb=0;
                                        foreach ($Resultat as $value) 
                                       {?>
                                                <tr>
                                                    <td> <?php $id = "id$nb"; $nb++;?>
                                                        <?php $idlien = $value["Ref"]; ?>
                                                        <?php $idid = $value['Id']; ?>
                                                        <?php $lien = "stockeProduit4.php?num=$idlien&id=$idid"; ?>
                                                        <input type="button" name="lien1" value="<?php echo $value["Id"] ?>" onclick="self.location.href='<?php echo $lien?>'"> 
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

