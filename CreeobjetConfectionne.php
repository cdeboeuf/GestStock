<?php
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

if(isset($_POST['action']))
{
    if($_POST['designation']== null)       
    {
        if($_POST['destination']==null)
        {
            if(($_POST['DateOrdre'])==null)
            {
                
            }
            else
            {
                $erreur="Choisisser une date.";
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
                <h1><small>Objets Confectionnés</small></h1>
                </div>
            <?php include('Menu.php');
            $menu=new Menu();
            $menu->Verifdroit('objetConfectionne.php');
           ?><div class="span12">
                   <div class="hero-unit"> 
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
                              Exercice:<?php echo date('Y')?>
                              <br>
                              N°ordre:<?php echo $ordre;?>
                              </div>
                                   </td>
                               </tr>
                           </table>
                                <div class='span12'>
                                    
                                    <div class='span3'> ORDRE DE SERVICE </div>
                                    <div class='span8'>
                               <libel for='designation'><em>Désignation:</em></libel>
                               <input type="text" name="designation" class="input-xlarge" id="designation"/>
                               </div>
                                </div>
                               <div class='span4'>
                               <libel for='professeur'><em>Professeur:</em></libel>
                               <input type="text" name="professeur" id="professeur"/><br>
                               
                               <libel for='destination'><em>Destination:</em></libel>
                               <input type="text" name="destination" id="destination"/><br>
                               </div>
                               <div class='span4 offset3'>
                               <libel for='NombrePrevu'><em>Nombre prévu:</em></libel>
                               <input type="text" name="NombrePrevu" id="NombrePrevu"/><br>
                               
                               <libel for='DateOrdre'><em>Date de l'ordre de serivce:</em></libel>
                               <input type="date" name="DateOrdre" id="DateOrdre"/><br>
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
