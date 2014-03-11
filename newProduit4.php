<!DOCTYPE html>

<?php 
include('bonjour.php'); 
include('Produit.class.php');
$Produit = new Produit();

if(isset($_POST['action']))
{
    if (isset($_POST['action'])=='envoyer')
    {    
        extract($_POST);
        if($_POST['StockAlerte']=="")
        {
           $_POST['StockAlerte']=0; 
        }
        if(isset($_POST['obselete']))
        {
            $_POST['obselete']=1;}
        else
        {$_POST['obselete']=0;}
		  $postData = explode( '|', $_POST['Fournisseurs'] );
         $Fournisseurs = $postData[0];
        $rep = $Produit->AddNewProduit($_POST['RefLycee'], $_POST['RefFournisseurs'], $_POST['StockAlerte'], $_POST['obselete'], $_POST['Designation'], $_POST['Coloris'], $_POST['UniteAchat'],$_POST['Fournisseurs'], $_POST['Section']);
    }
}
 
if(!isset($_SESSION['idVisiteur'])) 
{header('location: index.php');  }




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
            <?php include('Menu.php');
            $menu=new Menu();
           $page=pathinfo($_SERVER['PHP_SELF']);
           $menu->Verifdroit($page['basename']);?>
            <div class="span12">
                 <ul class="nav nav-tabs" id="profileTabs">
                    <?php include('ajoutProduit.php');?>                  
                                 
                </ul>
<!--                <ul class="nav nav-tabs" id="profileTabs">
                    <li><a href="./newProduit.php">Mode</a></li>
                    <li><a href="./newProduit2.php">Esthétique</a></li>
                    <li class="active"><a href="./newProduit4.php">Nouvel ajout</a></li>
                </ul>-->
                
            <div class="span12">
                <div class="tab-content">
                    <div class="tab-pane active">   
                        <div class="hero-unit">
                            <div class="row-fluid">
                                <legend>Ajouter un Produit</legend> 
                                <form method="POST" action="newProduit4.php">
                                    <table style="border:none;">
                                        <thead>
                                            <tr>
                                                <td>
                                                    <label for="Fournisseurs"><b>Fournisseur :</b></label>                    
                                                    <input type="hidden" name="Nom" value="">
                                                    <select name = "Fournisseurs" class="input-medium" id="Fournisseurs" onchange="GenerationRefLycee(this)"> 
                                                    <?php	$nb=0;
                                                        $tab1 = $Produit->ListeFournisseurs();
                                                        foreach ($tab1 as $valeur1)
                                                        {
                                                           ?><option value="<?php echo $valeur1['Id']."|".$nb.""; ?>"> <?php echo $valeur1['Nom']; ?></option><?php
                                                        $nb=$nb+1;
                                                           }
                                                    ?>
                                                    </select>

                                                </td>

                                                <td>
                                                    <label for="RefFournisseur"><b>Référence Fournisseur:</b></label>
                                                    <input type="text" name="RefFournisseurs" id="RefFournisseurs" value="" OnKeyUp="javascript:GenerationRefLycee()">

                                                </td>

                                                <td>
                                                    <label for="Coloris"><b>Coloris :</b></label>
                                                    <input type="text" name="Coloris" id="Coloris" class="input-small" value="" OnKeyUp="javascript:GenerationRefLycee()">
                                                </td>                                              
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="Désignation"><b>Désignation :</b></label>
                                                    <input type="text" name="Designation" class="input-xxlarge" required ="" id="Designation" value="">
                                                </td>
                                                 <td>
                                                    <label for="Section"><b>Section :</b></label>
                                                    <input type="hidden" name="unite" value="">
                                                    <select name = "Section" id="Section" class="input-medium"> 
                                                        <?php
                                                            $tab1 = $Produit->ListeSection();
                                                            foreach ($tab1 as $valeur1)
                                                            {
                                                            ?><option value="<?php echo $valeur1['Id']; ?>"><?php echo $valeur1['Details']; ?></option><?php 
                                                            }
                                                    ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="RéfLycee" ><b>Référence Lycée :</b></label>
                                                 
                                                    <input type="text" name="RefLycee" id="RefLycee" value="" required ="">
                                                </td>   
                                            
                                                <td>
                                                    <label for="UniteAchat"><b>Unité d'achat :</b></label>
                                                    <input type="hidden" name="unite" value="">
                                                    <select name = "UniteAchat" id="UniteAchat" class="input-medium" > 
                                                        <?php	
														
                                                            $tab1 = $Produit->ListeUniteAchat();
                                                            
                                                            foreach ($tab1 as $valeur1)
                                                            {
                                                            ?><option value="<?php echo $valeur1['Id']; ?>"><?php echo $valeur1['Details']; ?> </option><?php 
                                                           
															}
                                                    ?>
                                                    </select>
                                                </td>
                                                
                                                
                                                <td>
                                                    <label for="StockAlerte"><b>Stock d'alerte:</b></label>
                                                    <input type="text" name="StockAlerte" class="input-small" id="StockAlerte" value="">
                                                </td>
                                            <tr>
                                                <td>
                                                    <label for="Obsolete"> <b>Obsolète </b> <input type="checkbox" name="obselete" id="obselete"</label> 
                                                </td>
                                            </tr>
                                            
                                             <?php if(isset($rep))
                                        {
                                                if ($rep=="Le produit à été ajouté.")
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
                                                    <button type="submit" class="btn btn-primary" value="envoyer" name="action" onClick="return confirm('Etes-vous sûr?');">Ajouter</button>
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
               <script language="Javascript">
            function GenerationRefLycee() 
            {  
             
             var x = document.getElementById('Fournisseurs').value;
          
             x=x.split('|');
             xx=x[1];
            var objControle1 = document.getElementsByTagName('select')[0].options[xx].text
            var objControle2 = document.getElementById('RefFournisseurs').value;
            var objControle3 = document.getElementById('Coloris').value;
            
            if(objControle3 == ''){ var objControle4 = '' }
            else { var objControle4 = '-' + objControle3 }

            
            document.getElementById('RefLycee').value = objControle1.substr(0,3)  + '-' + objControle2 + objControle4 ;
            
            }
        </script>
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
