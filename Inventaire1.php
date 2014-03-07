<!DOCTYPE html>

<?php
include('produit.class.php');
include ('Valorisation.class.php');
include('bonjour.php');
include('fournisseurs.class.php');
$fournisseur=new Fournisseurs();
$Lesfour=$fournisseur->affiche_Fournisseurs();
$produit = new produit();
if(!isset($_SESSION['idVisiteur'])) 
{header('location: index.php');  }
if(isset($_POST['action']))
    {
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
}
include ('pagination.php');
      $pagination=new Pagination();
  
      
  if(isset($_POST['four'])){
 $resultat = $produit->GetValorisationStockMODEFournisseur($_POST['four']);
                                        $Resultat=$resultat[0];
                                        $nbPages=$resultat[1];
                                        $pageCourante=$resultat[2];
  }  else {
    $resultat = $produit->GetValorisationStockMODE();
                                        $Resultat=$resultat[0];
                                        $nbPages=$resultat[1];
                                        $pageCourante=$resultat[2];
    
}

if(isset($_POST['trie']))
{
     $resultat = $produit->GetValorisationStockMODEFournisseurTrie($_POST['four'],$_POST['trie']);
                                        $Resultat=$resultat[0];
                                        $nbPages=$resultat[1];
                                        $pageCourante=$resultat[2];
}

if(isset($_POST['annee']))
    {
    $valorisation= new Valorisation();
    $valorisation->nouvelleBDD();
    }
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
               <th> <td><?php logo() ?></td><td><?php annee()?><h1><small>Inventaire</small></h1>
                <?php bonjour() ?></td></th></table>
            </div> 
            <?php include('Menu.php');
            $menu=new Menu();
            $page=pathinfo($_SERVER['PHP_SELF']);
           $menu->Verifdroit($page['basename']);?>
            <div class="span12">
                <ul class="nav nav-tabs" id="profileTabs">
                      <?php include('Inventaire.php') ?>
<!--                    <li  class="active"><a href="./Inventaire1.php">Mode</a></li>
                    <li><a href="./Inventaire2.php">Esthétique</a></li>
                    <li><a href="./Inventaire3.php">Objet Confectionné</a></li>-->
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active">   
                        <div class="hero-unit-tab" style="background-color: #EFFBEF">
                            <div class="row-fluid">   
                                <form method="POST" action="Inventaire1.php">
                                     <SELECT name="four" id="four">
                                         <option value=''>Tous</option>
                  <?php
                 foreach ($Lesfour as $unfour)               
                     {
                     ?>
                        <option value='<?php echo $unfour['Id']?>' <?php if(isset($_POST['four'])&& ($unfour['Id']==$_POST['four'])){ echo "selected";} ?>><?php echo $unfour['Nom'];?></option>
                     <?php 
                   
                     }
                  ?>          
                 </SELECT>
                                  <button type="submit" class="btn btn-info" name="action" value="Valider">Rechercher</button>
                    
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
                                                    echo "<td nowrap>";
                                                    echo $value["Designation"];
                                                    echo "</td>";
                                                    echo "<td>";
                                                    ?>
                                                            <div class="controls">
                                                                <input type="text" name="QuantiteTotal[]" class="input-mini" <?php if($value["RefLycee"] == $produit->QuantiteNonModifiable()) { ?> disabled="disabled" <?php } ?> id="QuantiteTotal<?php echo $nb ?>" value="<?php echo number_format($value['QuantiteTotal'],2,$dec_point = ',' ,$thousands_sep = ' ') ?>"
                                                                OnKeyUp="javascript:calcul(<?php echo $nb?>);">
                                                            </div>
                                                        <?php
                                                    echo "</td>";
                                                    echo "<td>";
                                                    echo $value["Coloris"];
                                                    echo "</td>";
                                                    echo "<td nowrap>";
                                                    echo number_format($value["PUTTCPondere"],2,$dec_point = ',' ,$thousands_sep = ' ');
                                                    ?><input type="hidden" name="PUTTCPondere[]" id="PUTTCPondere<?php echo $nb ?>" value="<?php echo $value["PUTTCPondere"] ?>">
                                                   <?php 
                                                    echo "</td>";
                                                    echo "<td nowrap>";
                                                    ?>  
                                                        <div class="controls">
                                                            <input type="text" name="Total" class="input-mini" disabled="disabled" id="Total<?php echo $nb ?>"  value="<?php echo number_format($value['Total'],2,$dec_point = ',' ,$thousands_sep = ' ') ?>">
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
                                 <div class="btn-group ">
                                <button type="submit" class="btn btn-success" value="envoyer" name="action" onClick="return confirm('Etes-vous sûr de vouloir modifier le tableau?');">Enregistrer</button>
                                <button type="submit" class="btn btn-primary" onClick="window.print()">Imprimer</button>
                                  <?php 
                                $annee=date('Y');
                               $annee1=(int)$annee+1;?>
                                <button type="submit" class="btn btn-danger" value="cloturer" name="annee" onClick="return confirm('Etes-vous sûr de vouloir clôturer l\'année <?php echo $annee ?>, et ouvrir l\'année <?php echo $annee1 ?> ?')">Clôturer l'année <?php echo $annee ?></button>
                            </div>
                                </form>
                                 <?php  $pagination->affiche('inventaire1.php','idPage',$nbPages,$pageCourante,2);?>
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
            qte=document.getElementById('QuantiteTotal'+nb).value;
            qte=qte.replace("\,","\.");
            result = parseFloat(qte*document.getElementById('PUTTCPondere'+nb).value);
            result1 = result*100;          
            result2 = Math.round(result1); 
            result3 = result2/100; 
            document.getElementById('Total'+nb).value = lisibilite_nombre(result3.toFixed(2));
        }
        function lisibilite_nombre(nbr)
{
		var nombre = ''+nbr;
		var retour = '';
		var count=0;
		for(var i=nombre.length-1 ; i>=0 ; i--)
		{
			if(count!=0 && count % 3 == 0)
				retour = nombre[i]+' '+retour ;
			else
				retour = nombre[i]+retour ;
			count++;
		}
                retour=retour.replace(' \.',',');
		return retour;
}
        </script> 
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>

