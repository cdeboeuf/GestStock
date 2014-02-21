<!DOCTYPE html>

<?php
include('Produit.class.php');
$Produit = new Produit();

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
        $rep = $Produit->AddNewProduit($_POST['RefLycee'],  $_POST['StockAlerte'], $_POST['obselete'], $_POST['Designation'], $_POST['Coloris'], $_POST['UniteAchat'],$_POST['Fournisseurs'],$_POST['RefFournisseurs']);
    }
}
 
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
    $Noma = $value['Nom'];
    $Colorisa = $value['Coloris'];
    
}
else
{
        $Id = trim($_SESSION['Get']['id']);
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
                <h1><small>Produit</small></h1>
            </div>
            <?php include('Menu.php');
            $menu=new Menu();
            $menu->Verifdroit('newProduit.php');?>
            <div class="span12">
                <ul class="nav nav-tabs" id="profileTabs">
                    <li><a href="./newProduit.php">Mode</a></li>
                    <li><a href="./newProduit2.php">Esthétique</a></li>
                    <li class="active"><a href="./newProduit4.php">Nouvelle ajout</a></li>
                </ul>
                
            <div class="span12">
                <div class="tab-content">
                    <div class="tab-pane active">   
                        <div class="hero-unit" style="background-color: #FFECFF">
                            <div class="row-fluid">
                                <legend>Produit Mode</legend> 
                                <form method="POST" action="newProduit4.php">
                                    <table style="border:none;">
                                        <thead>
                                            <tr>
                                                <td>
                                                    <label for="Fournisseurs"><b>Fournisseur :</b></label>                    
                                                    <input type="hidden" name="Nom" value="<?php $_POST['Nom'];?>">
                                                    <select name = "Fournisseurs" class="input-medium" id="Fournisseurs"> 
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
                                                    <input type="text" name="RefFournisseurs" id="RefFournisseurs" value='<?php $_POST['RefFournisseurs'];?>'>

                                                </td>

                                                <td>
                                                    <label for="Coloris"><b>Coloris :</b></label>
                                                    <input type="text" name="Coloris" id="Coloris" class="input-small" value='<?php $_POST['Coloris'];?>'>
                                                </td>
                                                
                                                

                                            <tr>
                                                <td>
                                                    <label for="Désignation"><b>Désignation :</b></label>
                                                    <input type="text" name="Designation" class="input-xxlarge" id="Designation" value='<?php $_POST['Designation'];?>'>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="RéfLycee" ><b>Référence Lycée :</b></label>
                                                 
                                                    <input type="text" name="RefLycee" id="RefLycee" value='<?php $Produit->ChampsRefLycee($Noma, $RefFournisseur, $Colorisa); ?>'>
                                                </td>   
                                            
                                            <td>
                                                <label for="UniteAchat"><b>Unité d'achat :</b></label>
                                                <input type="hidden" name="unite" value="<?php $_POST['unite']; ?>">
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
                                                    <label for="Obsolete"> <b>Obsolète </b> <input type="checkbox" name="obselete" id="obselete" <?php if( $val != 1){ echo "checked";} ?> </label> 
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
                                  
                                        }?>
                                            
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
                                <form method="POST" action="newProduit.php" name="form">
                                    <table style="border:none;">
                                        <thead>
                                            <tr>
                                                <td>
                                                    <label for="DateEntree"><b>Date d'entrée :</b></label>
                                                    <input type="hidden" name="RefLycee" id="RefLycee" value='<?php if(!empty($_GET)){echo $value['RefLycee'];} else {echo $_POST['RefLycee'];}?>'>
                                                    <input type="hidden" name="id" id="id" value='<?php if(!empty($_GET)){ echo $Id;} else {echo $Id;}?>'>
                                                    
                                                    <input type="date" name="DateEntree" id="DateEntree" required="" >
                                                </td>

                                                <td>
                                                    <label for="Quantite"><b>Quantité :</b></label>
                                                    <input type="text" name="Quantite" id="Quantite" required="">
                                                </td>
                                                
                                                <td> 
                                                   <label for="Gratuit"> <b>Gratuit</b> 
                                                    <input type="checkbox" name="chkb_1" id ="chkb_1"
                                                    onClick="GereControle('chkb_1', 'PUHT', 'PUTTC', 'CodeTVA', '0');">
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="PUHT"><b>PUHT Unitaire:</b></label>
                                                    <input type="text" name="PUHT" id="PUHT">
                                                </td>

                                                <td>
                                                    <label for="PUTTC"><b>PUTTC Unitaire:</b></label>
                                                    <input type="text" name="PUTTC" id="PUTTC">
                                                </td>
                                                
                                                <td>
                                                    <label for="CodeTVA"><b>Code TVA :</b></label>
                                                    <select name = "CodeTVA" class="input-small" id="CodeTVA" > 
                                                    <?php
                                                        
                                                        $tab1 = $Produit->ListeTVA();
                                                        foreach ($tab1 as $valeur1)
                                                        {
                                                          echo "<option value=".$valeur1['Id']." ";
                                                            
                                                          if(!empty($_GET)){$val =$value["dIdTVA"];}
                                                          
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
                                                <td>
                                                    <label for="PUTTCPondere"><b>PUTTC Pondéré :</b></label>
                                                    <input type="text" name="PUTTCPondere" id="PUTTCPondere" disabled>
                                                    
                                                </td>
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
                            objControle1.value = "0";
                            objControle2.style.visibility=(objControleur.checked==true)?'visible':'hidden';
                            objControle2.value = "0";
                            objControle3.style.visibility = "visible";
                            objControle3.value = "0";
                        }
                    else
                        {
                            objControle1.disabled=(objControleur.checked==false)?false:true;
                            objControle1.value = "0";
                            objControle2.disabled=(objControleur.checked==false)?false:true;
                            objControle2.value = "0";
                            objControle3.style.visibility=(objControleur.checked==false)?'visible':'hidden';
                            objControle3.value = "0";
                        }
                    return true;
            }
            function calcul()
            {
                result = parseFloat( (document.getElementById('QuantiteTotal').value + document.getElementById('PUTTCPondere').value) / document.getElementById('PUTTCPondere').value );
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

