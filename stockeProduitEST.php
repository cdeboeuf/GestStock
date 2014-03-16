<!DOCTYPE html>
<?php
include('bonjour.php'); 
include('produit.class.php');
include('fournisseurs.class.php');
$produit = new produit();
$fournisseur=new Fournisseurs();
if(!isset($_SESSION['idVisiteur'])) 
{header('location: index.php');  }
        include('pagination.php');
$pagination=new Pagination();
 $Lesfour=$fournisseur->affiche_Fournisseurs();
       
  if(isset($_GET['four'])){
 $resultat = $produit->GetValorisationStockESTFournisseur($_GET['four']);
                                        $Resultat=$resultat[0];
                                        $nbPages=$resultat[1];
                                        $pageCourante=$resultat[2];
  }  else {
    $resultat = $produit->GetValorisationStockEST();
                                        $Resultat=$resultat[0];
                                        $nbPages=$resultat[1];
                                        $pageCourante=$resultat[2];
    
}

if(isset($_GET['trie']))
{
     $resultat = $produit->GetValorisationStockESTFournisseurTrie($_GET['four'],$_GET['trie']);
                                        $Resultat=$resultat[0];
                                        $nbPages=$resultat[1];
                                        $pageCourante=$resultat[2];
}?>


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
                 <div class="menu"> 
                 <ul class="nav nav-tabs" id="profileTabs">
                    <?php include('sortieProduit.php');?>                  
                                 
                </ul>
                 </div>
                <div class="tab-content">
                    <div class="tab-pane active">   
                        <div class="hero-unit" style="background-color:#F6CECE">
                            <div class="row-fluid">
                                
                                <form  method="GET" action="stockeProduitEST.php">
                                     <SELECT name="four" id="four">
                                         <option value=''>Tous</option>
                  <?php
                 foreach ($Lesfour as $unfour)               
                     {
                     ?>
                        <option value='<?php echo $unfour['Id']?>' <?php if(isset($_GET['four'])&& ($unfour['Id']==$_GET['four'])){ echo "selected";} ?>><?php echo $unfour['Nom'];?></option>
                     <?php 
                   
                     }
                  ?>          
                 </SELECT> <button type="submit" class="btn btn-info" name="action" value="Valider">Rechercher</button>
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

                                        <th>Référence Fournisseur
                                            <div class="btn-group ">
                                            
                                            <button type="submit" class="btn btn-info btn-mini" name="trie" value="AscRFour">A-Z</button>
                                            <button type="submit" class="btn btn-info btn-mini" name="trie" value="DescRFour">Z-A</button>
                                            </div>
                                        </th>

                                        <th>
                                            Fournisseur
                                            <div class="btn-group ">
                                            <button type="submit" class="btn btn-info btn-mini" name="trie" value="AscFour">A-Z</button>
                                            <button type="submit" class="btn btn-info btn-mini" name="trie" value="DescFour">Z-A</button>
                                            </div>
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
                                                                                                       if($value['StockAlerte'] == $value['QuantiteTotal']) 
                                                   { 
                                                   ?>
                                                    <div class="controls">
                                                            <input type="text" name="QuantiteTotal[]" class="input-mini" <?php if($produit->QuantiteNonModifiable()>0) { ?> disabled="disabled" <?php } ?> id="QuantiteTotal<?php echo $nb ?>" value="<?php echo number_format($value['QuantiteTotal'],2,$dec_point = ',' ,$thousands_sep = ' ') ?>"
                                                            OnKeyUp="javascript:calcul(<?php echo $nb?>);" style="color:#FF0000;">
                                                    </div>
                                                   <?php
                                                   } 
                                                    else if($value['StockAlerte']< $value['QuantiteTotal']) 
                                                   { 
                                                   ?>
                                                    <div class="controls">
                                                            <input type="text" name="QuantiteTotal[]" class="input-mini" <?php if($produit->QuantiteNonModifiable()>0) { ?> disabled="disabled" <?php } ?> id="QuantiteTotal<?php echo $nb ?>" value="<?php echo number_format($value['QuantiteTotal'],2,$dec_point = ',' ,$thousands_sep = ' ') ?>"
                                                            OnKeyUp="javascript:calcul(<?php echo $nb?>);" style="color:#0055FF;">
                                                    </div>
                                                   <?php
                                                   } 
                                                    else 
                                                    {
                                                   ?>
                                                    <div class="controls">
                                                            <input type="text" name="QuantiteTotal[]" class="input-mini" <?php if($produit->QuantiteNonModifiable()>0) { ?> disabled="disabled" <?php } ?> id="QuantiteTotal<?php echo $nb ?>" value="<?php echo number_format($value['QuantiteTotal'],2,$dec_point = ',' ,$thousands_sep = ' ') ?>"
                                                            OnKeyUp="javascript:calcul(<?php echo $nb?>);" style="color:#C0C0C0;">
                                                    </div>
                                                   <?php
                                                    }
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

