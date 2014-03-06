<!DOCTYPE html>

<?php
include('Produit.class.php');
$Produit = new Produit();
if(!isset($_SESSION['idVisiteur'])) 
{header('location: index.php');  }

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
        $value['IdSection'];
        $value['Nom'];
        $value['PUTTCPondere'];
        $value['Coloris'];
        $value['RefLycee'];
        $value['Designation'];
        $value['Details'];
        $value['IdFour'];
        $value['uniteId'];
        $value['dQuantite'];
        $value['dDateChangement'];
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
        $value['IdSection'];
        $value['Nom'];
        $value['PUTTCPondere'];
        $value['Coloris'];
        $value['RefLycee'];
        $value['Designation'];
        $value['Details'];
        $value['IdFour'];
        $value['uniteId'];
        $value['dQuantite'];
        $value['dDateChangement'];
    }
}
    if (isset($_POST['envoyer1'])=='valider')
    { 

        
        if (!isset($_POST['OC'])|| $_POST['OC'] == '')
        {
            echo "if";
            extract($_POST);
            $rep = $Produit->AddProduit2($_POST['RefLycee'], $_POST['DateEntree'], $_POST['Quantite'], $_SESSION['idVisiteur'], implode($_POST['Choix']) );
        }
        else
        {
            echo "else";
            extract($_POST);
            $rep = $Produit->AddProduit2($_POST['RefLycee'], $_POST['DateEntree'], $_POST['Quantite'], $_SESSION['idVisiteur'], implode($_POST['Choix']), $_POST['OC']);
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
    <body onload="GereControle('3')">
        
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
                                            <tr>
                                                <td>
                                                    <?php if(!empty($_GET)){echo $value['QuantiteTotal'];} else {echo $_POST['QuantiteTotal'];}?>
                                                </td>
                                                
                                                <td>
                                                    <?php if(!empty($_GET)){echo $value['PUTTCPondere'];} else {echo $_POST['PUTTCPondere'];}?>
                                                </td>  
                                            </tr>
                                            
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
                                                    <!-- Multiple Radios (inline) -->
                                                    <div class="control-group">
                                                        <div class="controls">
                                                            <label class="radio inline" for="2">
                                                            <input name="Choix[]" id="Choix" value="2" type="radio" onClick="GereControle('2');" required="">
                                                            Pratique
                                                            </label>
                                                            <label class="radio inline" for="3">
                                                            <input name="Choix[]" id="Choix" value="3" type="radio" onClick="GereControle('3');" required="">
                                                            Projet
                                                            </label>
                                                            
                                                            <?php if($value['IdSection'] == 2){?>
                                                            <label class="radio inline" for="1">
                                                            <input name="Choix[]" id="Choix" value="1" type="radio" onClick="GereControle('1');" required="">
                                                            
                                                            Objet Confectionné
                                                            </label>
                                                            <?php } ?>
                                                            
                                                            <?php if($value['IdSection'] == 1){?>
                                                            <label class="radio inline" for="4">
                                                            <input name="Choix[]" id="Choix" value="4" type="radio" onClick="GereControle('4');" required="">
                                                            Salon
                                                            </label>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                <?php if($value['IdSection'] == 2){?>
                                                <td  style="padding-left: 20px">
                                                    
                                                    <label for="OC" id="OC2" style="visibility: hidden; "><b>Objet Confectionné:</b></label>
                                                    <select name = "OC" class="input-medium" id="OC" style="visibility: hidden; "> 
                                                        <option value=""> </option>
                                                        <?php
                                                        
                                                        $tab1 = $Produit->ListeOC();
                                                        foreach ($tab1 as $valeur1)
                                                        {
                                                            
                                                          echo "<option value=".$valeur1['Ref']."";
                                                          echo "> ".$valeur1["Ref"]."</option>";
                                                        }
                                                    ?>
                                                    </select>
                                                </td>
                                                <?php } else{?><input type="hidden" name="OC" id="OC" value=''> <?php }?>
                                                
                                            </tr>
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
                                                    <input type="hidden" name="PUTTCPondere" id="PUTTCPondere" value='<?php if(!empty($_GET)){echo $value['PUTTCPondere'];} else {echo $_POST['PUTTCPondere'];}?>'>
                                                    

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
                                                    <input type="text" name="Quantite" id="Quantite" value="" required="">
                                            
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
        <script language="Javascript">
            function GereControle(obj) 
            { 
               
            var objControle1 = document.getElementById('OC');
            var objControle2 = document.getElementById('OC2');
            var objControleur = document.getElementById('Choix').value;
            
                    if (obj == '1')
                        {
                            objControle1.style.visibility = "visible";
                            objControle1.disabled=(objControleur.checked==true);
                            objControle2.style.visibility = "visible";
                        }
                    else
                        {
                            objControle1.disabled=(objControleur.checked==false)?false:true;
                            objControle1.value = "";
                            objControle1.style.visibility = "hidden";
                            objControle2.style.visibility = "hidden";
                            document.getElementById('OC').value="";
                        }
                    return true;
            }
        </script>
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>

