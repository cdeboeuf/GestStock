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
                                <legend>Produit Mode</legend> 
                                
                                <form method="POST" action="">
                                    <table class="table table-striped">
                                        <input type="hidden" name="RefLycee" id="RefLycee">
                                        <input type="hidden" name="Designation" id="Designation">
                                        <input type="hidden" name="Coloris" id="Coloris">
                                        <input type="hidden" name="UniteAchat" id="UniteAchat">
                                        <input type="hidden" name="Fournisseurs" id="Fournisseurs">
                                        <input type="hidden" name="RefFournisseurs" id="RefFournisseurs" value="<?php if(!empty($_GET)){ echo $RefFournisseur;} else {echo $_POST['RefFournisseurs'];}?>">
                                        <thead>
                                            <tr>
                                                <th>Fournisseur</th>
                                                <th>Référence Fournisseur</th>
                                                <th>Coloris</th>
                                            </tr>
                                            <td>                
                                                    <?php if(!empty($_GET)){echo $value['Nom'];} else {echo $_POST['Nom'];}?>
                                                    
                                                </td>
                                                <td>
                                                    <?php if(!empty($_GET)){ echo $RefFournisseur;} else {echo $_POST['RefFournisseurs'];}?>
                                                    
                                                </td>
                                                <td>
                                                    <?php if(!empty($_GET)){echo $value['Coloris'];;} else {echo $_POST['Coloris'];}?>
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

                                                <th>Stock d'alerte</th>
                                                <th>Obsolète</th>
                                                
                                            </tr>
                                                <td>
                                                    <input type="text" name="StockAlerte" class="input-small" id="StockAlerte" value='<?php if(!empty($_GET)){echo $value['StockAlerte'];} else {echo $_POST['StockAlerte'];}?>'>
                                                </td>  
                                                <td>
                                                    <?php 
                                                    if(!empty($_GET)){$val=$value["Obselete"];} else {$val= $_POST['obselete'];}
                                                   ?>
                                                    <label for="Obsolete"> <b>Obsolète </b> <input type="checkbox" name="obselete" id="obselete" <?php if( $val != 1){ echo "checked";} ?> </label> 
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
                                <form method="POST" action="newProduit1.php" name="form">
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
                                        <label for="DateEntree"><b>Date d'entrée :</b></label>
                                                    <input type="hidden" name="RefLycee" id="RefLycee" value='<?php if(!empty($_GET)){echo $value['RefLycee'];} else {echo $_POST['RefLycee'];}?>'>
                                                    <input type="hidden" name="id" id="id" value='<?php if(!empty($_GET)){ echo $Id;} else {echo $Id;}?>'>
                                                      <?php
                                                      $jour=date("d");
                                                      $mois=date("m");
                                                      $ans=date("Y");
                                                      $date=$ans."-".$mois."-".$jour;
                                                      ?>
                                                    <input type="date" name="DateEntree" id="DateEntree" required="" value="<?php echo $date;?>" >
                                                </td>

                                                <td>
                                                    <label for="Quantite"><b>Quantité :</b></label>
                                                    <input type="text" name="Quantite" id="Quantite" value="<?php if(isset($_POST['Quantite'])){echo $_POST['Quantite'];}?>" required="">
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
                                                    <label for="PUHT"><b>PUHT:</b></label>
                                                    <input type="text" name="PUHT" id="PUHT" value="<?php if(isset($_POST['PUHT'])){echo $_POST['PUHT'];}?>" OnKeyUp="javascript:calculTTC()">
                                                </td>

                                                <td>
                                                    <label for="PUTTC"><b>PUTTC:</b></label>
                                                    <input type="text" name="PUTTC" id="PUTTC" value="<?php if(isset($_POST['PUTTC'])){echo $_POST['PUTTC'];}?>" OnKeyUp="javascript:calculHT()">
                                                </td>
                                                
                                                <td>
                                                    <label for="CodeTVA"><b>TVA :</b></label>
                                                    <select name = "CodeTVA" class="input-small" id="CodeTVA" OnChange="javascripte:efface()"> 
                                                    <?php
                                                        
                                                        $tab1 = $Produit->ListeTVA();
                                                        foreach ($tab1 as $valeur1)
                                                        {
                                                          echo "<option value=".$valeur1['Id']."|".$valeur1['Taux']." ";
                                                            
                                                          if(!empty($_GET)|| !empty($_POST)){$val =$value["dIdTVA"];}
                                                          
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
                                                    <input type="text" name="PUTTCPondere" id="PUTTCPondere" value="<?php if(isset($Pondere)){echo round($Pondere,4); } ?>" disabled>
                                                    <button type="submit" class="btn btn-primary" value="calculer" name="envoyer1">calculer</button>
                                                </td>
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
            
            function calculHT()
            {
               
                ttc=document.getElementById('PUTTC').value;
                TVA=document.getElementById('CodeTVA').value;             
                Taux=TVA.split('|');
                PUHT=parseFloat(ttc)/(1+parseFloat(Taux[1])/100);  
                document.getElementById('PUHT').value=Math.round(PUHT*10000)/10000;
            }
            function calculTTC()
            {
                ht=document.getElementById('PUHT').value;
                TVA=document.getElementById('CodeTVA').value;             
                Taux=TVA.split('|');
                PUTTC=parseFloat(ht)*(1+parseFloat(Taux[1])/100);
                document.getElementById('PUTTC').value=Math.round(PUTTC*10000)/10000;
            }         
            
            function efface()
            {
                document.getElementById('PUTTC').value="";
                document.getElementById('PUHT').value="";
            }
            
        </script>
       
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>

