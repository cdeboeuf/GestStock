<?php 
include('Produit.class.php');include('bonjour.php'); 
$Produit = new Produit();
if(!isset($_SESSION['idVisiteur'])) 
{header('location: index.php');  }
if(isset($_GET)&&  !empty($_GET))
{ 
   extract($_GET);
    $_SESSION['Get'] = $_GET;       
    $RefLycee= $_GET['num'];
     include('pagination.php');
$pagination=new Pagination();
    $resultat = $Produit->GetRemplissageTableauHistoriqueOC($RefLycee);
     $Resultat=$resultat[0];
                                        $nbPages=$resultat[1];
                                        $pageCourante=$resultat[2];
    $nb=0;
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
               <th> <td><?php logo() ?></td><td><?php annee()?><h1><small>Ajouter un produit</small></h1>
                <?php bonjour() ?></td></th></table>
            </div> 
            <?php include('Menu.php');?>
            <div class="span12">
                <div class="tab-content">
                    <div class="tab-pane active">   
                        <div class="hero-unit" style="background-color: #FFECFF">
                            <div class="row-fluid">
                                <table  class="table table-bordered table-striped table-condensed">
                                    <caption>Tableau produit <?php echo $RefLycee?></caption>
                                    <thead>
                                        <tr>
                                        <th>N°</th>
                                        <th>Date</th>
                                        <th>PU</th>
                                        <th>Quantité</th>
                                        <th>Total</th>
                                        </tr> </thead>
                                    <tbody>
                                               <?php  foreach ($Resultat as $value)
                                        {

                                         ?> <tr> 
                                             <td>
                                             <?php echo$value['Id']; ?>
                                             </td>
                                             <td> 
                                                 <?php echo $value['Date'];?>
                                             </td>
                                         
                                             <td nowrap> 
                                                 <?php echo number_format($value['PrixU'],2,$dec_point = ',' ,$thousands_sep = ' ');?>
                                             </td>
                                             <td nowrap> 
                                                 <?php echo number_format($value['Quantite'],2,$dec_point = ',' ,$thousands_sep = ' ');?>
                                             </td>
                                             <td nowrap> 
                                                 <?php echo number_format($value['PrixU']*$value['Quantite'],2,$dec_point = ',' ,$thousands_sep = ' ')?>
                                             </td>
                                          
                                         </tr> 
                                             <?php } ?>
                                    </tbody>
                                   
                                </table>
                                   <?php                 
                                        $pagination->affiche('historique.php?num='.$RefLycee.'','idPage',$nbPages,$pageCourante,2);?>
                         <button class="btn btn-info btn-mini"><a href="<?php echo $_SERVER['HTTP_REFERER'] ?>">Retour</a></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>