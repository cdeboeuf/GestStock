<!DOCTYPE html>

<?php
include('Achat.class.php');
$Achat = new Achat();
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
            
                <ul class="nav nav-tabs" id="profileTabs">
                    <li class="active"><a href="./Achat.php">Mode</a></li>
                    <li><a href="./Achat2.php">Esthétique</a></li>
                </ul>
            
                <div class="tab-content">
                    <div class="tab-pane active">   
                        <div class="hero-unit" style="background-color: #FFECFF">
                            <div class="row-fluid">
                                <div class="span1"></div>                
                                <form class="span3" method="POST" action="Achat.php">
                                    <table class="table table-bordered table-striped table-condensed" style="border:none;">
                                        <thead>
                                            <tr>
                                                <td>
                                                    <label for="ChoixFournisseur"><b>Fournisseur :</b></label>
                                                    <select name = "Nom"> 
                                                    <?php	
                                                        echo $Achat->ListeFournisseurs();
                                                    ?>
                                                    </select> 
                                                </td>

                                                <td>
                                                    <label for="RefFournisseur"><b>Référence Fournisseur :</b></label>
                                                    <input type="text" name="RefFournisseur" id="RefFournisseur">
                                                </td>

                                                <td>
                                                    <label for="Coloris"><b>Coloris :</b></label>
                                                    <input type="text" name="Coloris" id="Coloris">
                                                </td>

                                                <td>
                                                    <label for="RéfLycee"><b>Référence Lycée :</b></label>
                                                    <input type="text" name="RefLycee" id="RefLycee">
                                                </td>

                                            <tr>
                                                <th>
                                                    <label for="Désignation"><b>Désignation :</b></label>
                                                    <input type="text" name="Designation" id="Designation">
                                                </th>
                                            </tr>     
                                            
                                            <td>
                                                <label for="UniteAchat"><b>Unité d'achat :</b></label>
                                                <select name = "unite"> 
                                                <?php	
                                                    echo $Achat->ListeUniteAchat();
                                                ?>
                                                </select>
                                            </td>

                                            <td>
                                                <label for="CodeTVA""><b>Code TVA :</b></label>
                                                <select name = "CodeTA" class="input-small"> 
                                                <?php	
                                                    echo $Achat->ListeTVA();
                                                ?>
                                                </select>
                                            </td>

                                            <td>
                                                <label for="StockAlerte"><b>Stock d'alerte :</b></label>
                                                <input type="text" name="StockAlerte" id="StockAlerte">
                                            </td>
                                            <tr>
                                                <td>
                                                    <label for="Obsolete"> <b>Obsolète </b> <input type="checkbox" name="Obsolete" value="1"> </label> 
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>        
                                                    <button type="submit" class="btn btn-primary" value="envoyer" name="action" onClick="return confirm('Etes-vous sûr?');">Validation</button>
                                                </td>
                                                <td>
                                                    <button type="reset" class="btn btn-primary" value="reset" name="reset">Annulation</button>
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
                                <div class="span1"></div>                
                                <form class="span3" method="POST" action="Achat.php" name="form">
                                    <table class="table table-bordered table-striped table-condensed" style="border:none;">
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
                                                    <button type="submit" class="btn btn-primary" value="envoyer" name="action" onClick="return confirm('Etes-vous sûr?');">Validation</button>
                                                </td>
                                                <td>
                                                    <button type="reset" class="btn btn-primary" value="reset" name="reset">Annulation</button>
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

