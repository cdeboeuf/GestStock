<!DOCTYPE html>

<?php
include('Produit.class.php');
$Produit = new Produit();

if(!isset($_SESSION['idVisiteur'])) 
{header('location: index.php');  }

if(isset($_GET)&&  !empty($_GET))
{ 
    extract($_GET);
    $RefFournisseur= $_GET['num'];
    $Id = $_GET['id'];
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
        $value['dPAHT'];
        $value['dPaTTC'];
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
        $Produit->MajProduit($_POST['RefLycee'],  $_POST['StockAlerte'], $_POST['obselete'], $_POST['Designation'], $_POST['Coloris'], $_POST['UniteAchat'],$_POST['Fournisseurs'],$_POST['RefFournisseurs']);
    }
}

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
        {$_POST['chkb_1']=0;}
        $Produit->AddProduitMode($_POST['RefLycee'], $_POST['DateEntree'], $_POST['CodeTVA'], $_POST['chkb_1'], $_POST['PAHT'], $_POST['PATTC'], $_POST['Quantite'], $_POST['id'], $_SESSION['idVisiteur']);
    }
    {header('location: newProduit.php');  }
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
                <h1><small>Achat</small></h1>
            </div>
            <?php include('Menu.php');?>
            <div class="span12">
            
                <div class="tab-content">
                    <div class="tab-pane active">   
                        <div class="hero-unit" style="background-color: #FFECFF">
                            <div class="row-fluid">
                                <legend>Produit Mode</legend> 
                                <form method="POST" action="newProduit1.php">
                                    <table style="border:none;">
                                        <thead>
                                            <tr>
                                                <td>
                                                    <label for="Fournisseurs"><b>Fournisseur :</b></label>                    
                                                    <input type="hidden" name="Nom" value="<?php if(!empty($_GET)){echo $value['Nom'];} else {echo $_POST['Nom'];}?>">
                                                    <select name = "Fournisseurs" class="input-small" id="Fournisseurs"> 
                                                    <?php	
                                                        $tab1 = $Produit->ListeFournisseurs();
                                                        foreach ($tab1 as $valeur1)
                                                        {
                                                            
                                                            echo "<option value=".$valeur1['Id']." ";
                                                            if(!empty($_GET)){$val=$value['IdFour'];} 
                                                            else {$val= $_POST['Fournisseurs'];}
                                                            if(  $val== $valeur1['Id'])
                                                            {
                                                                echo "selected";
                                                            }
                                                            echo "> ".$valeur1['Nom']."</option>";
                                                        }
                                                    ?>
                                                    </select>
                                                </td>

                                                <td>
                                                    <label for="RefFournisseur"><b>Référence Fournisseur:</b></label>
                                                    <input type="text" name="RefFournisseurs" id="RefFournisseurs" value='<?php if(!empty($_GET)){ echo $RefFournisseur;} else {echo $_POST['RefFournisseurs'];}?>'>

                                                </td>

                                                <td>
                                                    <label for="Coloris"><b>Coloris :</b></label>
                                                    <input type="text" name="Coloris" id="Coloris" class="input-small" value='<?php if(!empty($_GET)){echo $value['Coloris'];;} else {echo $_POST['Coloris'];}?>'>
                                                </td>

                                                <td>
                                                    <label for="RéfLycee"><b>Référence Lycée :</b></label>
                                                    <input type="text" name="RefLycee" id="RefLycee" value='<?php if(!empty($_GET)){echo $value['RefLycee'];} else {echo $_POST['RefLycee'];}?>'>
                                                </td>

                                            <tr>
                                                <th>
                                                    <label for="Désignation"><b>Désignation :</b></label>
                                                    <input type="text" name="Designation" id="Designation" value='<?php if(!empty($_GET)){echo $value['Designation'];} else {echo $_POST['Designation'];}?>'>
                                                </th>
                                            </tr>     
                                            
                                            <td>
                                                <label for="UniteAchat"><b>Unité d'achat :</b></label>
                                                <input type="hidden" name="unite" value="<?php if(!empty($_GET)){echo $value['Details'];} else {echo $_POST['unite'];}?>">
                                                <select name = "UniteAchat" id="UniteAchat" class="input-medium"> 
                                                            <?php	
                                                        $tab1 = $Produit->ListeUniteAchat();
                                                        foreach ($tab1 as $valeur1)
                                                        {                                                      
                                                            echo "<option value=".$valeur1['Id']." ";
                                                            if(!empty($_GET)){$val =$value["uniteId"];} else {$val= $_POST['UniteAchat'];}
                                                            if($val == $valeur1["Id"])
                                                            {
                                                                echo "selected";
                                                            }
                                                            echo "> ".$valeur1["Details"]."</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </td>


                                            <td>
                                                <label for="StockAlerte"><b>Stock d'alerte:</b></label>
                                                <input type="text" name="StockAlerte" class="input-small" id="StockAlerte" value='<?php if(!empty($_GET)){echo $value['StockAlerte'];} else {echo $_POST['StockAlerte'];}?>'>
                                            </td>
                                            <tr>
                                                <td>
                                                    <?php 
                                                    if(!empty($_GET)){$val=$value["Obselete"];} else {$val= $_POST['obselete'];}
                                                   ?>
                                                    <label for="Obsolete"> <b>Obsolète </b> <input type="checkbox" name="obselete" id="obselete" <?php if( $val == 1){ echo "checked";} ?> </label>
                                                   
                                                   
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <button type="submit" class="btn btn-primary" value="envoyer" name="action" onClick="return confirm('Etes-vous sûr?');">Modification</button>
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
            
                <div class="tab-content">
                    <div class="tab-pane active">   
                        <div class="hero-unit" style="background-color: #FFECFF">
                            <div class="row-fluid">
                                <legend>Nouvelle Entrée</legend>                
                                <form method="POST" action="newProduit1.php" name="form">
                                    <table style="border:none;">
                                        <thead>
                                            <tr>
                                                <td>
                                                    <label for="DateEntree"><b>Date d'entrée :</b></label>
                                                    <input type="hidden" name="RefLycee" id="RefLycee" value='<?php if(!empty($_GET)){echo $value['RefLycee'];} else {echo $_POST['RefLycee'];}?>'>
                                                    <input type="hidden" name="id" id="id" value='<?php if(!empty($_GET)){ echo $Id;} else {echo $_POST['id'];}?>'>
                                                    
                                                    <input type="date" name="DateEntree" id="DateEntree" required="" >
                                                </td>

                                                <td>
                                                    <label for="Quantite"><b>Quantité :</b></label>
                                                    <input type="text" name="Quantite" id="Quantite" required="">
                                                </td>
                                                
                                                <td>
                                                    <label for="Gratuit"> <b>Gratuit</b> <input type="checkbox" name="Gratuit" id ="chkb_1" value="<?php if(!empty($_GET)){echo $value['dGratuit'];;} else {echo $_POST['Gratuit'];}?>" 
                                                    onClick="GereControle('chkb_1', 'PAHT', 'PATTC', 'CodeTVA', '0');">
                                                    </label> 
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="PAHT"><b>PAHT :</b></label>
                                                    <input type="text" name="PAHT" id="PAHT">
                                                </td>

                                                <td>
                                                    <label for="PATTC"><b>PATTC :</b></label>
                                                    <input type="text" name="PATTC" id="PATTC">
                                                </td>
                                                
                                                <td>
                                                    <label for="CodeTVA"><b>Code TVA :</b></label>
                                                    <select name = "CodeTVA" class="input-small" id="CodeTVA"> 
                                                    <?php	
                                                        $tab1 = $Produit->ListeTVA();
                                                        foreach ($tab1 as $valeur1)
                                                        {                                                      
                                                          echo "<option value=".$valeur1['Id']." ";
                                                          if(!empty($_GET)){$val =$value["dIdTVA"];} else {$val= $_POST['CodeTVA'];}
                                                          if($val == $valeur1["Id"])
                                                          {
                                                              echo "selected";
                                                          }
                                                          echo "> ".$valeur1["Taux"]."</option>";
                                                        }
                                                    ?>
                                                    </select>
                                                </td>
                                            
                                            </tr>
                                            <tr>
                                                <th>
                                                    <label for="PATTCPondere"><b>PATTC Pondéré :</b></label>
                                                    <input type="text" name="PATTCPondere" id="PATTCPondere" disabled>
                                                    
                                                </th>
                                            </tr>     
                                          
                                            <tr>
                                                <td>        
                                                    <button type="submit" class="btn btn-success" value="envoyer1" name="action1" onClick="return confirm('Etes-vous sûr?');">Validation</button>
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
            function GereControle(Controleur, Controle1, Controle2, Controle3, Masquer) 
            {

            var objControleur = document.getElementById(Controleur);
            var objControle1 = document.getElementById(Controle1);
            var objControle2 = document.getElementById(Controle2);
            var objControle3 = document.getElementById(Controle3);
                    if (Masquer =='1')
                        {
                            objControle1.style.visibility=(objControleur.checked==true)?'visible':'hidden';
                            objControle1.value = "";
                            objControle2.style.visibility=(objControleur.checked==true)?'visible':'hidden';
                            objControle2.value = "";
                            objControle3.style.visibility=(objControleur.checked==true)?'visible':'hidden';
                            objControle3.value = "";
                        }

                    else
                        {
                            objControle1.disabled=(objControleur.checked==false)?false:true;
                            objControle1.value = "";
                            objControle2.disabled=(objControleur.checked==false)?false:true;
                            objControle2.value = "";
                            objControle3.disabled=(objControleur.checked==false)?false:true;
                            objControle3.value = "";
                        }
                            return true;
            }
            
        function calcul(nb)
        {
            result = parseFloat( (document.getElementById('QuantiteTotal').value + document.getElementById('PATTCPondere').value) / document.getElementById('PATTCPondere').value );
            result1 = result*100;          
            result2 = Math.round(result1); 
            result3 = result2/100; 
            document.getElementById('Total').value = result3;
        }
        </script>
       
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>

