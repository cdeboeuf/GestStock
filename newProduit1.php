<!DOCTYPE html>

<?php
include('Produit.class.php');
$Produit = new Produit();

if(!isset($_SESSION['idVisiteur'])) 
{header('location: index.php');  }

if(isset($_GET))
{ 
    $num = $_GET['num'];
    extract($_GET);
    $RefFournisseur = $num;
    $Resultat = $Produit->GetRemplissageTableau($RefFournisseur);
    $nb=0;
       
    foreach ($Resultat as $value)
    {
        $value['Nom'];
        $value['Coloris'];
        $value['RefLycee'];
        $value['Designation'];
        $value['Details'];
        $value['Taux'];
        $value['StockAlerte'];
        $value['Obselete'];
    }
}

if(isset($_POST['action']))
 if (isset($_POST['action'])=='envoyer')
 {    
     $produit->MajProduit();
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
                                <form method="POST" action="newProduit1.php">
                                    <table style="border:none;">
                                        <thead>
                                            <tr>
                                                <td>
                                                    <label for="ChoixFournisseur"><b>Fournisseur :</b></label>                    
                                                    <select name = "Fournisseur" class="input-small" id="Fournisseur"> 
                                                    <?php	
                                                        $tab1 = $Produit->ListeFournisseurs();
                                                        foreach ($tab1 as $valeur1)
                                                        {
                                                            echo "<option ";
                                                            if($value["Nom"] == $valeur1["Nom"])
                                                            {
                                                                echo "selected";
                                                            }
                                                            echo "> ".$valeur1["Nom"]."</option>";
                                                        }
                                                    ?>
                                                    </select>
                                                </td>

                                                <td>
                                                    <label for="RefFournisseur"><b>Référence Fournisseur:</b></label>
                                                    <input type="text" name="RefFournisseurs" id="RefFournisseurs" value='<?php echo $RefFournisseur;?>'>

                                                </td>

                                                <td>
                                                    <label for="Coloris"><b>Coloris :</b></label>
                                                    <input type="text" name="Coloris" id="Coloris" class="input-small" value='<?php echo $value['Coloris'];?>'>
                                                </td>

                                                <td>
                                                    <label for="RéfLycee"><b>Référence Lycée :</b></label>
                                                    <input type="text" name="RefLycee" id="RefLycee" value='<?php echo $value['RefLycee'];?>'>
                                                </td>

                                            <tr>
                                                <th>
                                                    <label for="Désignation"><b>Désignation :</b></label>
                                                    <input type="text" name="Designation" id="Designation" value='<?php echo $value['Designation'];?>'>
                                                </th>
                                            </tr>     
                                            
                                            <td>
                                                <label for="UniteAchat"><b>Unité d'achat :</b></label>
                                                <select name = "unite" id="uniteAchat" class="input-medium"> 
                                                            <?php	
                                                        $tab1 = $Produit->ListeUniteAchat();
                                                        foreach ($tab1 as $valeur1)
                                                        {
                                                            echo "<option ";
                                                            if($value["Details"] == $valeur1["Details"])
                                                            {
                                                                echo "selected";
                                                            }
                                                            echo "> ".$valeur1["Details"]."</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </td>

                                            <td>
                                                <label for="CodeTVA"><b>Code TVA :</b></label>
                                                <select name = "CodeTVA" class="input-small" id="CodeTVA"> 
                                                   <?php	
                                                        $tab1 = $Produit->ListeTVA();
                                                        foreach ($tab1 as $valeur1)
                                                        {
                                                            echo "<option ";
                                                            if($value["Taux"] == $valeur1["Taux"])
                                                            {
                                                                echo "selected";
                                                            }
                                                            echo "> ".$valeur1["Taux"]."</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </td>

                                            <td>
                                                <label for="StockAlerte"><b>Stock d'alerte:</b></label>
                                                <input type="text" name="StockAlerte" class="input-small" id="StockAlerte" value='<?php echo $value['StockAlerte'];?>'>
                                            </td>
                                            <tr>
                                                <td>
                                                    <?php if($value["Obselete"] == 0){?>
                                                    <label for="Obsolete"> <b>Obsolète </b> <input type="checkbox" name="Obselete" id="Obselete"> </label>
                                                    <?php }else{ ?>
                                                    <label for="Obsolete"> <b>Obsolète </b> <input type="checkbox" name="Obselete" id="Obselete" checked> </label>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>        
                                                    <button type="submit" class="btn btn-success" value="envoyer" name="action" onClick="return confirm('Etes-vous sûr?');">Validation</button>
                                                </td>
                                                <td>
                                                    <button type="reset" class="btn btn-danger" value="reset" name="reset">Annulation</button>
                                                </td>
                                                <td>
                                                    <button type="submit" class="btn btn-primary" value="modifier" name="modifier" onClick="return confirm('Etes-vous sûr?');">Modification</button>
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
                                               
                                <form method="POST" action="Achat.php" name="form">
                                    <table style="border:none;">
                                        <thead>
                                            <tr>
                                                <td>
                                                    <label for="DateEntree"><b>Date d'entrée :</b></label>
                                                    <input type="text" name="DateEntree" id="DateEntree">
                                                </td>

                                                <td>
                                                    <label for="Quantite"><b>Quantité :</b></label>
                                                    <input type="text" name="Quantite" id="Quantite">
                                                </td>
                                                
                                                <td>
                                                    <label for="Gratuit"> <b>Gratuit</b> <input type="checkbox" name="Gratuit" id ="chkb_1" 
                                                    onClick="GereControle('chkb_1', 'PAHT', 'PATTC', 'PATTCPondere', '0');">
                                                    </label> 
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="PAHT"><b>PAHT :</b></label>
                                                    <input type="text" name="PATHT" id="PAHT">
                                                </td>

                                                <td>
                                                    <label for="PATTC"><b>PATTC :</b></label>
                                                    <input type="text" name="PATTC" id="PATTC">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <label for="PATTCPondere"><b>PATTC Pondéré :</b></label>
                                                    <input type="text" name="PATTCPondere" id="PATTCPondere"
                                                    
                                                </th>
                                            </tr>     
                                          
                                            <tr>
                                                <td>        
                                                    <button type="submit" class="btn btn-success" value="envoyer" name="action" onClick="return confirm('Etes-vous sûr?');">Validation</button>
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
                            objControle2.style.visibility=(objControleur.checked==true)?'visible':'hidden';
                            objControle3.style.visibility=(objControleur.checked==true)?'visible':'hidden';
                        }

                    else
                        {
                            objControle1.disabled=(objControleur.checked==false)?false:true;
                            objControle2.disabled=(objControleur.checked==false)?false:true;
                            objControle3.disabled=(objControleur.checked==false)?false:true;
                        }
                            return true;
            }
        </script>
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>

