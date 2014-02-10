<!DOCTYPE html>

<?php
include('Produit.class.php');
$Produit = new Produit();
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
                <ul class="nav nav-tabs" id="profileTabs">
                    <li class="active"><a href="./newProduit.php">Mode</a></li>
                    <li><a href="./newProduit2.php">Esthétique</a></li>
                </ul>
            
                <div class="tab-content">
                    <div class="tab-pane active">   
                        <div class="hero-unit" style="background-color: #FFECFF">
                            <div class="row-fluid">
                                                
                                <form name="MonForm" id="MonForm">
                                    <legend>Partie en consultation</legend>
                                    <table style="border:none;">
                                        <thead>
                                            <tr>
                                                <td>
                                                    <label for="ChoixFournisseur"><b>Fournisseur :</b></label>
                                                    <select name = "Nom" id="Fournisseur"> 
                                                    <?php	
                                                        echo $Produit->ListeFournisseurs();
                                                    ?>
                                                    </select> 
                                                </td>

                                                <td>
                                                    <label for="ChoixRefFournisseur"><b>Référence Fournisseur :</b></label>
                                                    <select name = "RefFournisseur" id="RefFournisseur" 
                                                            OnChange="javascript:envoyerRequete('getNbProduits.php?RefFournisseur='+escape(this.value))">
                                                    <?php	
                                                        echo $Produit->ListeRefFournisseur();
                                                    ?>
                                                    </select> 
                                                </td>

                                                <td>
                                                    <label for="Coloris"><b>Coloris :</b></label>
                                                    <input type="text" name="Coloris" id="Coloris" class="input-small">
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
                                                <select name = "unite" id="uniteAchat"> 
                                                <?php	
                                                    echo $Produit->ListeUniteAchat();
                                                ?>
                                                </select>
                                            </td>

                                            <td>
                                                <label for="CodeTVA""><b>Code TVA :</b></label>
                                                <select name = "CodeTA" class="input-small" id="CodeTVA"> 
                                                <?php	
                                                    echo $Produit->ListeTVA();
                                                ?>
                                                </select>
                                            </td>

                                            <td>
                                                <label for="StockAlerte"><b>Stock d'alerte:</b></label>
                                                <input type="text" name="StockAlerte" id="StockAlerte" class="input-small">
                                            </td>
                                            <tr>
                                                <td>
                                                    <label for="Obsolete"> <b>Obsolète </b> <input type="checkbox" name="Obsolete" id="Obsolete" value="1"> </label> 
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
                                               
                                <form method="POST" action="Achat.php" name="form">
                                    <legend>Partie en mise à jour</legend>
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
        <script language="Javascript">
            function getRequeteHttp()
            { // idem
                    var requeteHttp;
                    if (window.XMLHttpRequest)
                    {	// Mozilla
                            requeteHttp=new XMLHttpRequest();
                            if (requeteHttp.overrideMimeType)
                            { // problème firefox
                                    requeteHttp.overrideMimeType('text/xml');
                            }
                    }
                    else
                    {
                            if (window.ActiveXObject)
                            {	// C'est Internet explorer < IE7
                                    try
                                    {
                                            requeteHttp=new ActiveXObject("Msxml2.XMLHTTP");
                                    }
                                    catch(e)
                                    {
                                            try
                                            {
                                                    requeteHttp=new ActiveXObject("Microsoft.XMLHTTP");
                                            }
                                            catch(e)
                                            {
                                                    requeteHttp=null;
                                            }
                                    }
                            }
                    }
                    return requeteHttp;
            }
        </script>
        <script language="Javascript">
            function envoyerRequete(url, idRefFournisseur)
            {
                    var requeteHttp=getRequeteHttp();
                    if (requeteHttp==null)
                    {
                            alert("Impossible d'utiliser Ajax sur ce navigateur");
                    }
                    else
                    {
                            requeteHttp.open('GET',url + '?RefFournisseur=' + escape(idRefFournisseur),true);
                            requeteHttp.open('GET',url ,true);
                            requeteHttp.onreadystatechange=function() {recevoirReponse(requeteHttp);};
                            requeteHttp.send(null);
                    }
                    return;
            }
        </script>
        <script language="Javascript">
            function recevoirReponse(requeteHttp)
            { // idem
                if (requeteHttp.readyState==4)
                            {	// la requête est achevée, le résultat a été transmis
                                    if (requeteHttp.status==200)
                                    {	// la requête s'est correctement déroulée (pourrait être 404 pour non trouvé par exemple)
                                            traiterReponse(requeteHttp.responseText);
                                    }
                                    else
                                    {
                                            alert("La requête ne s'est pas correctement exécutée");
                                    }
                            }
            }
        </script>
        <script language="Javascript">
            function traiterReponse(reponse1, reponse2, reponse3, reponse4, reponse5, reponse6, reponse7)
            {
                    document.getElementById("Fournisseur").innerHTML=reponse1;
                    document.getElementById("Coloris").innerHTML=reponse2;
                    document.getElementById("RefLycee").innerHTML=reponse3;
                    document.getElementById("Designation").innerHTML=reponse4;
                    document.getElementById("uniteAchat").innerHTML=reponse5;
                    document.getElementById("CodeTVA").innerHTML=reponse6;
                    document.getElementById("StockAlerte").innerHTML=reponse7;
                    
            }
        </script>
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>

