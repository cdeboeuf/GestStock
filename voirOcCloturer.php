<?php include('bonjour.php');  
include('connexion.php');
include('objetConfectionne.class.php');
if(!isset($_SESSION['idVisiteur'])) 
{header('location: index.php');  }

$LesOc=new ObjectConfectionne();

if(isset($_POST['OcC']))
{
$OC=$LesOc->affiche_OC($_POST['OcC']);
$ligne=$LesOc->affiche_ligne($_POST['OcC']);
}else
{
$OC=$LesOc->affiche_OC($_GET['id']);
$ligne=$LesOc->affiche_ligne($_GET['id']);
}


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
               <th> <td><?php logo() ?></td><td><?php annee()?><h1><small>Objets confectionnés</small></h1>
                <?php bonjour() ?></td></th></table>
            </div> 
            
            <?php include('Menu.php');
            $menu=new Menu();
            $menu->Verifdroit('objetConfectionne.php');
            
           ?><div class="span12">
                   <div class="hero-unit"> 
                       <?php if(isset($erreur))
                       {?><div class="alert alert-danger"><?php echo $erreur?></div><?php }?>
                       <?php if(isset($rep))
                       {?><div class="alert alert-success"><?php echo $rep?></div><?php }?>
                       
                       <div class="row-fluid">   
                           <div class='span12'>                              
                            <table class="table table-bordered">  
                               <tr>            
                                   <td>
                              <div class='span3'>
                              M.PARDE<br>
                              Lycée des Métiers<br>
                              BOURG EN BRESSE
                              </div>
                              <div class='span4 offset1'>
                                  <strong> OBJETS CONFECTIONNES<br>
                              BULLETIN DE FABRICATION </strong>
                              </div>
                              <div class='span3 offset1'>
                              Exercice : <?php echo $oc['Annee'];?>
                             
                              <br>
                              N°ordre : <?php echo $oc['Id'];?>
                              
                              </div>
                                   </td>
                               </tr>
                           </table>
                                <div class='span12'>
                                    
                                    <div class='span3'> ORDRE DE SERVICE </div>
                                    <div class='span8'>
                             <em>Désignation : </em><?php echo $oc['Designation'];?><br>
                               </div>
                                </div>
                               <div class='span4'>
                               <em>Professeur : </em>
                               <?php echo $oc['Login'];?><br>
                              
                               <em>Destination : </em>
                               <?php echo $oc['Destination']; ?><br>
                               </div>
                               <div class='span4 offset3'>
                               <em>Nombre prévu : </em>
                               <?php echo $oc['NbPrevision'];?><br>

                               <em>Date de l'ordre de service : </em><?php echo $oc['DateEmiF'];?><br>
                               </div>   
                                
                                <div class="span12">
                                    
                                     <table class="table table-striped">
                                         <caption style="text-align: left;"> <em>MATIERE UTILISEE : </em> </caption>
                                        <TR> 
                                    <TH> DESIGNATION </TH> 
                                    <TH> REFERENCE </TH> 
                                    <TH> QUANTITE </TH> 
                                    <TH> PUTTC </TH> 
                                    <TH> MONTANT </TH> 
                                     </TR> 
                                    <?php
                                    
                                    foreach( $ligne as $uneligne)
                                    {
                                     ?>    <TR> 
                                    <TD> <?php echo $uneligne['DesiProduit']?> </TD> 
                                    <TD> <?php echo $uneligne['RefProduit'] ?></TD> 
                                    <TD> <?php echo $uneligne['QuantiteLigne']?> </TD> 
                                    <TD> <?php echo $uneligne['PuTTCLigne']?></TD> 
                                     <TD> <?php echo $res=$uneligne['QuantiteLigne']*$uneligne['PuTTCLigne']?></TD> 
                                     </TR> 
                                  <?php  }
                                    ?>
                                </table>
                                     <div class="span6">
                                        <br>
                                        <br>
                                        <br>
                                        Coefficient de correction : <?php echo $oc['CoefCorrection'];?> % du total matières.<br>
                                        Coût machine : <?php echo $oc['Temps'] ?> X <?php echo $oc['CoutMachinePU'];?>€.
                               <br>
                               <br>
                               <?php
                               $jour=date("d");
                               $mois=date("m");
                               $ans=date("Y");
                               $date=$ans."-".$mois."-".$jour;
                               ?>
                               <em>Date de fabrication : </em><?php echo $oc['DateFabriF'] ?> <br>
                              <em>Nombre d'objets réalisés : </em><?php echo $oc['NbRealise'] ?> <br>
                              <br>
                              <br>
                              <em>Référence : </em><?php echo $oc['Ref'] ?>
                                    </div>
                                    <div class="span5">
                                       <table class="table table-striped">  
                                           <tr>
                                               <th>
                                                   Euros
                                               </th>
                                               <th>
                                               </th>
                                           </tr>
                                           <tr>
                                               <th>
                                                   
                                               </th>
                                                <th>
                                                 TTC  
                                               </th>
                                           </tr>
                                            <tr>
                                               <td>
                                                   Total Matières
                                               </td>
                                                <td ID="totalmatiere">   
                                                  <?php echo $oc['TotalMatiere'] ?>
                                               </td>
                                           </tr>
                                            <tr>
                                               <td>
                                                   Total Frais
                                               </td>
                                                <td id="totalfrais">
                                                 <?php echo $oc['TotalFrais']; ?>
                                               </td>
                                           </tr>
                                            <tr>
                                               <th>
                                                 Total coût élève  
                                               </th>
                                                <td id="totalcouteleve">
                                                  <?php echo $oc['TotalCoutEleve']; ?>
                                               </td>
                                           </tr>
                                            <tr>
                                               <td>
                                                   Coût machine
                                               </td >
                                                <td id=coutmachine>
                                                  <?php echo $oc['CoutMachine']; ?>
                                               </td>
                                           </tr>
                                            <tr>
                                               <th>
                                                 Total coût public  
                                               </th>
                                                <td id="totalcoutpublic">
                                                    <?php echo $oc['TotalCoutPublic']; ?>
                                               </td>
                                           </tr>
                                            <tr>
                                               <th>
                                                  Prix unitaire public 
                                               </th>
                                                <td id="prixunitairepublic">
                                                    <?php echo
                                                  $oc['PrixUnitairePublic']; ?>
                                               </td>
                                           </tr>
                                            <tr>
                                               <th>
                                                 Prix unitaire élève  
                                               </th>
                                                <td id="prixunitaireeleve">
                                                   <?php echo
  $oc['PrixEleveUnitaire']; ?>
                                               </td>
                                           </tr>
                                       </table> 
                                                  <br>
                                    </div>
                              
                                </div> 
                           
                               <div class="span12">
                                   <div class="span4">Le responsable de fabrication</div>
                                   <div class="span4">Le chef d'établissement</div>
                                   <div class="span4">L'agent comptable</div>
                               </div>
                            </div>
                               <input type="button" value="Imprimer cette page" onClick="window.print()">
                       </div>                    
                   </div>
        </div>
        </div>
        <!--Js -->
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
