<!DOCTYPE html>

<?php
include('bonjour.php'); 
include('connexion.php');
include('objetconfectionne.class.php');
$ObjetConfectionne = new ObjectConfectionne();
if(!isset($_SESSION['idVisiteur'])) 
{header('location: index.php');  }


if(isset($_GET)&&  !empty($_GET))
{ 
    extract($_GET);
    $_SESSION['Get'] = $_GET;
    $Id = trim($_SESSION['Get']['id']);
          
    $Ref= $_GET['num'];
}

If(isset($_POST['envoyer1']))
{ 
    If($_POST['Quantite']>=$_POST['QuantiteS'])
    {
        $ObjetConfectionne->sortieOc($Ref, $_POST['DateEntree'], $_POST['QuantiteS'], $_POST['Choix']);   
    }
    else
    { $rep="Il n'y a pas assez de stock";}
}
    

  if(isset($_GET)&&  !empty($_GET))
{   
    $OC = $ObjetConfectionne->affiche_OC($Id);
    $nb=0;
        
   foreach($OC as $oc)
{
  $oc['Ref'];
  $oc['Id'];
  $oc['Annee'];
  $oc['Designation'];
  $oc['NbPrevision'];
  $oc['Login'];
  $oc['Destination'];
  $oc['DateEmi'];
  $oc['DateEmiF'];
  $oc['DateFabri'];
  $oc['DateFabriF'];
  $oc['CoefCorrection'];
  $oc['NbRealise'];
  $oc['Temps'];
  $oc['TotalMatiere'];
  $oc['TotalFrais'];
  $oc['TotalCoutEleve'];
  $oc['CoutMachine'];
  $oc['TotalCoutPublic'];
  $oc['PrixUnitairePublic'];
  $oc['PrixEleveUnitaire'];
  $oc['CoutMachinePU'];
}
}

if(isset($_POST['RefFournisseurs']))
{ 
     $Ref= $_POST['RefFournisseurs'];
    $OC = $ObjetConfectionne->affiche_OC($_POST['RefFournisseurs']);
    $nb=0;
        
   foreach($OC as $oc)
{
  $oc['Ref'];
  $oc['Id'];
  $oc['Annee'];
  $oc['Designation'];
  $oc['NbPrevision'];
  $oc['Login'];
  $oc['Destination'];
  $oc['DateEmi'];
  $oc['DateEmiF'];
  $oc['DateFabri'];
  $oc['DateFabriF'];
  $oc['CoefCorrection'];
  $oc['NbRealise'];
  $oc['Temps'];
  $oc['TotalMatiere'];
  $oc['TotalFrais'];
  $oc['TotalCoutEleve'];
  $oc['CoutMachine'];
  $oc['TotalCoutPublic'];
  $oc['PrixUnitairePublic'];
  $oc['PrixEleveUnitaire'];
  $oc['CoutMachinePU'];
}
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
    <body >
        
        <div class="container-fluid">
           <div class="page-header">
                <table>
               <th> <td><?php logo() ?></td><td><?php annee()?><h1><small>Sortir un produit</small></h1>
                <?php bonjour() ?></td></th></table>
            </div> 
              <?php include('Menu.php');
     ?>
            
            <div class="span12">
                <div class="tab-content">
                    <div class="tab-pane active">   
                        <div class="hero-unit">
                            <div class="row-fluid">
                                <legend>Partie en consultation</legend> 
                                
                                <?php $idlien = $oc['Ref']; 
                                $idid = $oc['Id']; 
                                 $lien = "stockeProduit1.php?num=$idlien&id=$idid"; ?>
                                <form method="POST" action="<?php $lien ?>">
                                    <table class="table table-striped">
<input type="hidden" name="Quantite" id="Quantite" value='<?php if(!empty($_GET)){ echo $oc['Quantite'];} else {echo $_POST['Quantite'];}?>'>
                                       
                                        <input type="hidden" name="Ref" id="Ref" value='<?php if(!empty($_GET)){ echo $Ref;} else {echo $_POST['Ref'];}?>'>
                                        <thead>
                                            <tr>
                                           
                                                <th>Référence </th>
                                            </tr>
                                           
                                                <td>
                                                    <?php if(!empty($_GET)){ echo $Ref;} else {echo $_POST['Ref'];}?>
                                                    
                                                </td>
                                                
                                            <tr>
                                                <th>Désignation</th>
                                            </tr>
                                                <td>
                                                    <?php if(!empty($_GET)){echo $oc['Designation'];} else {echo $_POST['Designation'];}?>                                                   
                                                </td>
                                       
                                              
                                            <tr>
                                                <th>Stock:</th>
                                                <th>Prix élève :</th>
                                                <th>Prix  Public</th>
                                                
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php if(!empty($_GET)){echo $oc['Quantite'];} else {echo $_POST['Quantite'];}?>
                                                </td>
                                                <td>
                                                    <?php if(!empty($_GET)){echo $oc['PrixEleveUnitaire']." €";} else {echo $_POST['PrixEleveUnitaire']." €";}?>
                                                </td>
                                                <td>
                                                    <?php if(!empty($_GET)){echo $oc['PrixUnitairePublic']." €";} else {echo $_POST['PrixUnitairePublic']." €";}?>
                                                </td>  
                                            </tr>

                                        </thead>
                                    </table>
  
                                <legend>Partie en mise a jour</legend>                
                                    <table style="border:none;">
                                        <thead>
                                            <tr>
                                                <td>
                                                    <!-- Multiple Radios (inline) -->
                                                    <div class="control-group">
                                                        <div class="controls">
                                                            <label class="radio inline" for="2">
                                                            <input name="Choix" id="Choix" value="<?php echo $oc['PrixEleveUnitaire'] ?>" type="radio" required="">
                                                            Prix Eleve: <?php echo $oc['PrixEleveUnitaire'];?> €
                                                            </label>
                                                            <label class="radio inline" for="3">
                                                            <input name="Choix" id="Choix" value="<?php echo $oc['PrixUnitairePublic'] ?>" type="radio" required="">
                                                            Prix Public <?php echo $oc['PrixUnitairePublic'];  ?> €
                                                            </label>                                                                                                                                                                            
                                                        </div>
                                                    </div>
                                                </td>
                                           
                                                
                                            </tr>
                                            <tr>
                                                <td>        
            
                                                    <label for="DateEntree"><b>Date de sortie:</b></label>   
                                                                <?php
                                                                $jour=date("d");
                                                                $mois=date("m");
                                                                $ans=date("Y");
                                                                $date=$ans."-".$mois."-".$jour;
                                                                ?>
                                                    <input type="date" name="DateEntree" id="DateEntree" required="" value="<?php echo $date; ?>" >
                                                </td>

                                                <td>
                                                    <label for="QuantiteS"><b>Quantité :</b></label>
                                                    <input type="text" name="QuantiteS" id="QuantiteS" value="" required="">
                                            
                                            </tr>
                                                <?php if(isset($rep) && isset($_POST))
                                                        {
                                                            if ($rep=="La sortie à été effectué.")
                                                                {?><div class="alert alert-success"><?php echo $rep;?></div><?php } 
                                                            else
                                                                {?><div class="alert alert-danger"><?php echo $rep; ?></div><?php }          
                                                        }?>
                                            <tr>
                                                <td>        
                                                    <button type="submit" class="btn btn-success" value="valider" name="envoyer1" onClick="return confirm('Etes-vous sûr?');">Validation</button>
                                                </td>
                                                <td>
                                                    <button type="reset" class="btn btn-danger" value="reset" name="reset">Annulation</button>
                                                </td>
                                            </tr>
                                            
                                            
                                        </thead>
                                    </table>
                                </form>
                            </div>
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

