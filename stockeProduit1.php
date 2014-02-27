<!DOCTYPE html>

<?php
include('Produit.class.php');
$Produit = new Produit();
if(!isset($_SESSION['idVisiteur'])) 
{header('location: index.php');  }

if(isset($_POST['action']))
{
    if (isset($_POST['action'])=='envoyer')
    {    
        extract($_POST);
        if(!isset($_POST['obselete']))
        {
            $_POST['obselete']=1;
        }
        else
        {
            $_POST['obselete']=0;   
         }
        $rep = $Produit->MajProduit( $_POST['StockAlerte'], $_POST['obselete'], $_POST['RefFournisseurs']);
    }
}

if(isset($_GET)&&  !empty($_GET))
{ 
    extract($_GET);
    $_SESSION['Get'] = $_GET;
    $Id = trim($_SESSION['Get']['id']);
          
    $RefFournisseur= $_GET['num'];
    $Resultat = $Produit->GetRemplissageTableau($RefFournisseur);
    $nb=0;
        
    foreach ($Resultat as $value)
    {
        $value['Nom'];
        $value['Coloris'];
        $value['RefLycee'];
        $value['Designation'];
        $value['Details'];
        $value['IdFour'];
        $value['uniteId'];
        $value['StockAlerte'];
        $value['Obselete'];
        $value['dQuantite'];
        $value['dDateChangement'];
        $value['dGratuit'];
        $value['dPUHT'];
        $value['dPUTTC'];
        $value['dIdTVA'];
    }
    
}
else
{
        $Id = trim($_SESSION['Get']['id']);
}

if(isset($_POST['RefFournisseurs']))
{ 
     $RefFournisseur= $_POST['RefFournisseurs'];
    $Resultat = $Produit->GetRemplissageTableau($_POST['RefFournisseurs']);
    $nb=0;
        
    foreach ($Resultat as $value)
    {
        $value['Nom'];
        $value['Coloris'];
        $value['RefLycee'];
        $value['Designation'];
        $value['Details'];
        $value['IdFour'];
        $value['uniteId'];
        $value['StockAlerte'];
        $value['Obselete'];
        $value['dQuantite'];
        $value['dDateChangement'];
        $value['dGratuit'];
        $value['dPUHT'];
        $value['dPUTTC'];
        $value['dIdTVA'];
    }
}

if(isset($_POST['action']))
{
    
    if (isset($_POST['action'])=='envoyer')
    {  
        extract($_POST);
        if(isset($_POST['obselete']))
        {
            $_POST['obselete']=1;}
        else
        {$_POST['obselete']=0;}
      
        $rep = $Produit->MajProduit($_POST['RefLycee'],  $_POST['StockAlerte'], $_POST['obselete'], $_POST['Designation'], $_POST['Coloris'], $_POST['UniteAchat'],$_POST['Fournisseurs'],$_POST['RefFournisseurs']);
    }
}


 if(isset($_POST['envoyer1']))
{
    if ($_POST['envoyer1']=='valider')
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
        if(!isset($_POST['PUHT']) && !isset($_POST['PUTTC']))
        {
            $_POST['PUHT'] = 0;
            $_POST['PUTTC'] = 0;
        }
        if(!isset($_POST['CodeTVA']))
        {$Id_TVA=0;}else{
        $postData = explode( '|', $_POST['CodeTVA'] );
        $Id_TVA = $postData[0];}
        $rep = $Produit->AddProduit($_POST['RefLycee'], $_POST['DateEntree'], $Id_TVA, $_POST['chkb_1'],  $_POST['PUHT'], $_POST['PUTTC'], $_POST['Quantite'], $_SESSION['idVisiteur']);       
    }
    if ($_POST['envoyer1']=='calculer')
    { 
        $Pondere=$Produit->calculPondereEssai($_POST['RefLycee'],$_POST['PUTTC'],$_POST['Quantite']);
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
                <h1><small>Achat</small></h1>
            </div>
            <?php include('Menu.php');?>
            <div class="span12">
                <div class="tab-content">
                    <div class="tab-pane active">   
                        <div class="hero-unit" style="background-color: #FFECFF">
                            <div class="row-fluid">
                                <legend>Partie en consultation</legend> 
                                
                                <?php $idlien = $value["RefFournisseur"]; ?>
                                <?php $idid = $value['Id']; ?>
                                <?php $lien = "stockeProduit1.php?num=$idlien&id=$idid"; ?>
                                <form method="POST" action="<?php $lien ?>">
                                    <table class="table table-striped">

                                        <input type="hidden" name="RefFournisseurs" id="RefFournisseurs" value='<?php if(!empty($_GET)){ echo $RefFournisseur;} else {echo $_POST['RefFournisseurs'];}?>'>
                                        <thead>
                                            <tr>
                                                <th>Fournisseur</th>
                                                <th>Référence Fournisseur</th>
                                            </tr>
                                            <td>                
                                                    <?php if(!empty($_GET)){echo $value['Nom'];} else {echo $_POST['Nom'];}?>
                                                    
                                                </td>
                                                <td>
                                                    <?php if(!empty($_GET)){ echo $RefFournisseur;} else {echo $_POST['RefFournisseurs'];}?>
                                                    
                                                </td>
                                                
                                            <tr>
                                                <th>Désignation</th>
                                            </tr>
                                                <td>
                                                    <?php if(!empty($_GET)){echo $value['Designation'];} else {echo $_POST['Designation'];}?>                                                   
                                                </td>
                                            <tr>
                                                <th>Référence Lycée</th>
                                                <th>Unité d'achat</th>
                                            </tr>
                                                <td>
                                                    <?php 
                                                    if(isset($value['Nom']))
                                                    {
                                                    $Produit->ChampsRefLycee($value['Nom'], $RefFournisseur, $value['Coloris']); 
                                                    }
                                                    else
                                                    {
                                                    $Produit->ChampsRefLycee($_POST['Nom'], $_POST['RefFournisseurs'], $_POST['Coloris']);
                                                    }?>
                                                </td>
                                                <td>
                                                    <?php if(!empty($_GET)){echo $value['Details'];} else {echo $_POST['unite'];}?>
                                                </td>
                                            <tr>

                                                <th>Stock</th>
                                                <th>Prix TTC</th>
                                                
                                            </tr>
                                                <td>
                                                    <input type="text" name="StockAlerte" class="input-small" id="StockAlerte" value='<?php if(!empty($_GET)){echo $value['StockAlerte'];} else {echo $_POST['StockAlerte'];}?>'>
                                                </td>
                                                
                                                <td>
                                                    <input type="text" name="StockAlerte" class="input-small" id="StockAlerte" value='<?php if(!empty($_GET)){echo $value['StockAlerte'];} else {echo $_POST['StockAlerte'];}?>'>
                                                </td>  
                                            
                                            
                                             <?php if(isset($rep))
                                                   {
                                                        if ($rep=="Le produit à été modifié.")
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
                                                   
                                                   }
                                            ?>
                                        </thead>
                                    </table>
  
                                <legend>Partie en mise a jour</legend>                
                                    <table style="border:none;">
                                        <thead>
                                            <tr>
                                                <td>        
                                                    <input type="hidden" name="Designation" id="Designation" value="<?php if(!empty($_GET)){echo $value['Designation'];} else {echo $_POST['Designation'];} ?>">
                                                    <input type="hidden" name="Coloris" id="Coloris" value="<?php if(!empty($_GET)){echo $value['Coloris'];} else {echo $_POST['Coloris'];} ?>">
                                                    <input type="hidden" name="unite" id="unite" value="<?php if(!empty($_GET)){echo $value['Details'];} else {echo $_POST['unite'];} ?>">
                                                    <input type="hidden" name="Nom" id="Nom" value="<?php if(!empty($_GET)){echo $value['Nom'];} else {echo $_POST['Nom'];} ?>">
                                                    <input type="hidden" name="RefFournisseurs" id="RefFournisseurs" value="<?php if(!empty($_GET)){echo $RefFournisseur;} else {echo $_POST['RefFournisseurs'];} ?>">
                                                    <input type="hidden" name="StockAlerte" id="StockAlerte" value="<?php if(!empty($_GET)){echo $value['StockAlerte'];} else {echo $_POST['StockAlerte'];} ?>">
                                                    <input type="hidden" name="obselete" id="obselete" value="<?php if(!empty($_GET)){echo $value['Obselete'];} else {echo $_POST['obselete'];} ?>">
                                                    <input type="hidden" name="RefLycee" id="RefLycee" value='<?php if(!empty($_GET)){echo $value['RefLycee'];} else {echo $_POST['RefLycee'];}?>'>
                                                    <input type="hidden" name="id" id="id" value='<?php if(!empty($_GET)){ echo $Id;} else {echo $Id;}?>'>


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
                                                    <label for="Quantite"><b>Quantité :</b></label>
                                                    <input type="text" name="Quantite" id="Quantite" value="<?php if(isset($_POST['Quantite'])){echo $_POST['Quantite'];}?>" required="">
                                            
                                            </tr>

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

