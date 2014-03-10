<?php include('bonjour.php'); 
include('connexion.php');
include('objetConfectionne.class.php');
if(!isset($_SESSION['idVisiteur'])) 
{header('location: index.php');  }

$LesOc=new ObjectConfectionne();
$ordre=$LesOc->NumOrdre();
foreach ($ordre as $unOrdre)
{
   $ordre=1+$unOrdre['ordre'];
}
$ans=date('Y');
if(isset($_POST['action']))
{
    if($_POST['designation']!= null)       
    {
        if($_POST['destination']!=null)
        {
            if($_POST['DateOrdre'] !=null)
            {
                if($_POST['NombrePrevu']!=null)
                {
                    if(is_numeric($_POST['NombrePrevu']))
                    {
                    $LesOc->NewOc($_POST['designation'],$_POST['destination'],$_POST['DateOrdre'],$_POST['NombrePrevu']);
                    $rep="L'objet confectionner OC$ordre/$ans a été crée.";
                }
                else $erreur="Entrer un nombre valide.";
                    }
                
                else
                    {
                    $erreur="Entrer un nombre prévu.";
                    }
                
            }
            else
            {
                $erreur="Choisir une date.";
            }
        }
        else
        {
            $erreur="Entrer une destination.";
        }
    }
 else {
        
 $erreur="Entrer une designation.";
         
 }
    $ordre=$LesOc->NumOrdre();
foreach ($ordre as $unOrdre)
{
   $ordre=1+$unOrdre['ordre'];
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
                   <div class="hero-unit"> 
                       <?php if(isset($erreur))
                       {?><div class="alert alert-danger"><?php echo $erreur?></div><?php }?>
                       <?php if(isset($rep))
                       {?><div class="alert alert-success"><?php echo $rep?></div><?php }?>
                       
                       <div class="row-fluid">   
                           <div class='span12'>
                            <form name="newOc" action="CreeobjetConfectionne.php" method="post">
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
                              Exercice : <?php echo date('Y')?>
                              <br>
                              N°ordre : <?php echo "OC".$ordre;?>
                              </div>
                                   </td>
                               </tr>
                           </table>
                                <div class='span12'>
                                    
                                    <div class='span3'> ORDRE DE SERVICE </div>
                                    <div class='span8'>
                               <label for='designation'><em>Désignation : </em></label>
                               <input type="text" name="designation" class="input-xlarge" id="designation"/>
                               </div>
                                </div>
                               <div class='span4'>
                               <em>Professeur : </em>
                               <?php echo$_SESSION['nom']?><br>
                              
                               <label for='destination'><em>Destination : </em></label>
                               <input type="text" name="destination" id="destination"/><br>
                               </div>
                               <div class='span4 offset3'>
                               <label for='NombrePrevu'><em>Nombre prévu : </em></label>
                               <input type="text" name="NombrePrevu" id="NombrePrevu"/><br>
                               <?php
                               $jour=date("d");
                               $mois=date("m");
                               $ans=date("Y");
                               $date=$ans."-".$mois."-".$jour;
                               ?>
                               <label for='DateOrdre'><em>Date de l'ordre de service : </em></label>
                               <input type="date" name="DateOrdre" value="<?php echo $date;?>" id="DateOrdre"/><br>
                               </div>   
                              <button type="submit" class="btn btn-success" name="action" value="Valider">Enregistrer</button>
                            </form>
                            </div>
                         
                       </div>                    
                   </div>
        </div>
        </div>
        <!--Js -->
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
