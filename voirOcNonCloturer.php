<?php include('bonjour.php'); 
include('connexion.php');
include('objetConfectionne.class.php');
include('parametre.class.php');
if(!isset($_SESSION['idVisiteur'])) 
{header('location: index.php');  }
$Parametre= new Parametre();
$LesOc=new ObjectConfectionne();
if(isset($_POST['OcNc']))
{
$OC=$LesOc->affiche_OC($_POST['OcNc']);
$ligne=$LesOc->affiche_ligne($_POST['OcNc']);
$Sum=$LesOc->SommeUnOc($_POST['OcNc']);
}
else{
    $ref="OC".$_POST['Id']."/".$_POST['Annee'];
    $OC=$LesOc->affiche_OC($_POST['Id']);
    $ligne=$LesOc->affiche_ligne($_POST['Id']);
    $Sum=$LesOc->SommeUnOc($_POST['Id']);
}
 $LesCoef=$Parametre->affiche_CoefCorrection();
               
$LesCout=$Parametre->affiche_CoutMachine();
foreach ($LesCoef as $unCoef)
{
  $Coef= $unCoef['Details'];
}     
foreach ($LesCout as $unCout)
 {
 $Cout=$unCout['Details'];
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
}

if(isset($_POST['action']))
{
       if($_POST['action']=="Cloturer")
    {
      if(!empty($_POST['Cloture'])) 
      {
          echo $ref="OC".$_POST['Id']."/".$_POST['Annee'];
          $oc=$_POST['Id'];
          $temp=(($_POST['heure']*60)+$_POST['minute'])/60;
          $LesOc->ClotureOc($temp,$_POST['ObjetRealise'],$_POST['DateFabriquation'],$_POST['TTMatiere'],$_POST['NombrePrevu'],$ref  );
           header("Location:VoirOcCloturer.php?id=$oc");
     }
      else{
          $erreur="Vous n'avez pas coché la case clôturer le bulletin.";
          
      }
    }
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
            $menu->Verifdroit('MenuObjetConfectionne.php');
           ?><div class="span12">
                   <div class="hero-unit" style="background-color:#CEF6CE"> 
                       <?php if(isset($erreur))
                       {?><div class="alert alert-danger"><?php echo $erreur?></div><?php }?>
                       <?php if(isset($rep))
                       {?><div class="alert alert-success"><?php echo $rep?></div><?php }?>
                       
                       <div class="row-fluid">   
                           <div class='span12'>
                            <form name="newOc" action="voirOcNonCloturer.php" method="post">
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
                              <input type='hidden' name='Annee' id='Id' value='<?php echo $oc['Annee']?>'>
                              <br>
                              N°ordre : <?php echo "OC".$oc['Ido'];?>
                                <input type='hidden' name='Id' id='Id' value='<?php echo $oc['Ido']?>'>
                              </div>
                                   </td>
                               </tr>
                           </table>
                                <div class='span12'>
                                    
                                    <div class='span3'> ORDRE DE SERVICE </div>
                                    <div class='span8'>
                               <em>Désignation : </em>
                               <small><?php echo $oc['Designation'];?></small>
                               </div>
                                </div>
                               <div class='span4'>
                               <em>Professeur : </em>
                               <small><?php echo $oc['Login'];?></small><br>
                              
                               <em>Destination : </em>
                               <small><?php echo $oc['Destination']; ?></small><br>
                               </div>
                               <div class='span4 offset3'>
                               <em>Nombre prévu : </em>
                              <small> <?php echo $oc['NbPrevision'];?></small><br>
                               <input type='hidden' name='NombrePrevu' id='NombrePrevu' value='<?php echo $oc['NbPrevision']?>'>

                               <em>Date de l'ordre de service : </em>
                              <small> <?php echo $oc['DateEmiF'];?></small><br>
                              <br>
                              <br>
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
                                    <TD> <?php echo number_format($uneligne['QuantiteLigne'],2,$dec_point = ',' ,$thousands_sep = ' ') ?> </TD> 
                                    <TD> <?php echo number_format($uneligne['PuTTCLigne'],2,$dec_point = ',' ,$thousands_sep = ' ')?></TD> 
                                     <TD> <?php echo number_format($res=$uneligne['QuantiteLigne']*$uneligne['PuTTCLigne'],2,$dec_point = ',' ,$thousands_sep = ' ')?></TD> 
                                     </TR> 
                                    <?php  }
                                    ?>
                                </table>
                                    <div class="span6">
                                        <br>
                                        <br>
                                        <br>
                                        Coefficient de correction : <?php echo number_format($Coef,2,$dec_point = ',' ,$thousands_sep = ' ')?> % du total matières.<br>
                                        Coût machine : <input type="text" name="heure" id="heure" placeholder="heure" OnKeyUp="javascript:calcul()" class="input-small"/>
                                        <select id="minute" name="minute" OnClick="javascript:calcul()" class="input-mini" id="minute">
    <?php  for($i=00;$i<60;$i++){?>
    <option value="<?php echo $i ?>">
        <?php echo $i ;?>
    </option> <?php } ?> </select>
<small>(<small id="temps">0 X <?php echo number_format($Cout,2,$dec_point = ',' ,$thousands_sep = ' ')?>€</small>)</small><br>
<br>
                                        
  <?php
                               $jour=date("d");
                               $mois=date("m");
                               $ans=date("Y");
                               $date=$ans."-".$mois."-".$jour;
                               ?>
                               <label for='DateFabriquation'><em>Date de fabrication : </em></label>
                               <input type="date" name="DateFabriquation" value="<?php echo $date;?>" id="DateFabriquation"/>
                               <label for='ObjetRealise'><em>Nombre d'objets réalisés : </em></label>
                               <input type="text" name="ObjetRealise" value="" class='input-small' id="ObjetRéalisé"/>
                               <br>  <input type="checkbox" name="Cloture" value="Cloture">
                                 <label for='Cloture'><em>Clôturer le bulletin de fabrication <?php echo $oc['Ref'];?></em></label>
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
                                                    <?php  foreach( $Sum as $unesomme)
                                    {echo number_format($unesomme['prix'],2,$dec_point = ',' ,$thousands_sep = ' '); 
                                 ?>
                                              <input type='hidden' name='TTMatiere' id='TTmatiere' value='<?php echo $unesomme['prix']?>'><?php }?>    
                                               </td>
                                           </tr>
                                            <tr>
                                               <td>
                                                   Total Frais
                                               </td>
                                                <td id="totalfrais">
                                                 
                                               </td>
                                           </tr>
                                            <tr>
                                               <th>
                                                 Total coût élève  
                                               </th>
                                                <td id="totalcouteleve">
                                                  
                                               </td>
                                           </tr>
                                            <tr>
                                               <td>
                                                   Coût machine
                                               </td >
                                                <td id=coutmachine>
                                                 
                                               </td>
                                           </tr>
                                            <tr>
                                               <th>
                                                 Total coût public  
                                               </th>
                                                <td id="totalcoutpublic">
                                                   
                                               </td>
                                           </tr>
                                            <tr>
                                               <th>
                                                  Prix unitaire public 
                                               </th>
                                                <td id="prixunitairepublic">
                                                   
                                               </td>
                                           </tr>
                                            <tr>
                                               <th>
                                                 Prix unitaire élève  
                                               </th>
                                                <td id="prixunitaireeleve">
                                                   
                                               </td>
                                           </tr>
                                       </table> 
                                    </div>
                                </div>
                                <div class="btn-group ">
                             
                              <button type="submit" class="btn btn-success" name="action" value="Cloturer">Terminer <br>l'objet confectionné</button>
                              </div>
                            </form>
                            </div>
                         
                       </div>                    
                   </div>
        </div>
        </div>
        <!--Js -->
        <script type="text/javascript">
            
            function lisibilite_nombre(nbr)
{
		var nombre = ''+nbr;
		var retour = '';
		var count=0;
		for(var i=nombre.length-1 ; i>=0 ; i--)
		{
			if(count!=0 && count % 3 == 0)
				retour = nombre[i]+' '+retour ;
			else
				retour = nombre[i]+retour ;
			count++;
		}
                retour=retour.replace(' \.',',');
		return retour;
}
        function calcul()
{
totalmatiere=<?php echo $unesomme['prix'] ?>;
coef=<?php echo $Coef?>;
cout=<?php echo $Cout?>;
prevision=<?php echo $oc['NbPrevision']?>;
        totalfrais=Math.round((parseFloat(totalmatiere)*(parseFloat(coef)/100))*100)/100;
        document.getElementById('totalfrais').innerHTML=lisibilite_nombre(totalfrais.toFixed(2));
        totalcouteleve=Math.round((parseFloat(totalmatiere))*100)/100;
        document.getElementById('totalcouteleve').innerHTML=lisibilite_nombre(totalcouteleve.toFixed(2));
if(document.getElementById('heure').value==="")
    {
        heure=0;
    }
    else
        {
            heure=document.getElementById('heure').value;
        }
if(document.getElementById('minute').value ==="")
    {
        minute=0;
    }
    else
        {
            minute=document.getElementById('minute').value;          
        }
temps=Math.round((((parseFloat(heure)*60)+parseFloat(minute))/60)*100)/100;
document.getElementById('temps').innerHTML=temps+" X <?php echo $Cout?>€";
 coutmachine= Math.round((parseFloat(temps)*parseFloat(cout))*100)/100;
 document.getElementById('coutmachine').innerHTML=lisibilite_nombre(coutmachine.toFixed(2));
totalcoutpublic=Math.round((parseFloat(totalcouteleve)+parseFloat(coutmachine))*100)/100;
document.getElementById('totalcoutpublic').innerHTML=lisibilite_nombre(totalcoutpublic.toFixed(2));
prixunitairepublic=Math.round((parseFloat(totalcoutpublic)/parseFloat(prevision))*100)/100;
document.getElementById('prixunitairepublic').innerHTML=lisibilite_nombre(prixunitairepublic.toFixed(2));
prixunitaireeleve=Math.round((parseFloat(totalcouteleve)/parseFloat(prevision))*100)/100;
document.getElementById('prixunitaireeleve').innerHTML=lisibilite_nombre(prixunitaireeleve.toFixed(2));
}
        </script>
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
