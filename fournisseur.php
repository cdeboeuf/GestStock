<?php include('connexion.php');
include('fournisseurs.class.php');

if(!isset($_SESSION['idVisiteur'])) 
{header('location: index.php');  }

$fournisseurP= new Fournisseurs();                

if(isset($_POST['four']))
{
   $rep= $fournisseurP->ajout_Fournisseurs($_POST['fournisseur']);

}
if(isset($_POST['fournisseurSup']))
{
   $rep= $fournisseurP->supprimer_Fournisseurs($_POST['fournisseurSup']);

}
$LesFournisseurs= $fournisseurP->affiche_Fournisseurs();

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
                <h1><small>Parametre</small></h1>
                </div>
            <?php include('Menu.php');
            $menu=new Menu();
               $page=pathinfo($_SERVER['PHP_SELF']);
           $menu->Verifdroit($page['basename']);
           ?><div class="span12">
                      <div class="hero-unit"> 
                      <div class="row-fluid">
                      
                             <?php if(isset($rep)){ 
                             if ($rep=="Le Fournisseur a été ajouté"){?>
                             <div class="alert alert-success "><?php echo $rep;} else{?></div>
                         <div class="alert alert-danger"><?php echo $rep;}?></div>
                         <?php } ?>
                        
                     <div class='span4'>
                         <label class="badge" for="fournisseurP">Les fournisseurs déjà enregistrés:</label>
                 <form class="span3" name="fournisseurSup" action="fournisseur.php" method="post">
                 <SELECT name="fournisseurSup" id="fournisseurP">
                  <?php
                 foreach ($LesFournisseurs as $unfournisseur)               
                     {
                 
                     ?>
                        <option value='<?php echo $unfournisseur['Nom'] ?>'><?php echo $unfournisseur['Nom']." (Utilisation:".$unfournisseur['utiliser'].")"?></option>
                     <?php }
                  ?>          
                 </SELECT>
                     <button type="submit" class="btn btn-danger">Supprimer</button>
                     </form>
                     </div>
                      <div class='span4'>
                <form class="span3" name="tvanew" action="fournisseur.php" method="post">
                    <label class="badge" for="tva">Nouveau fournisseur :</label> <input type="text" name="fournisseur" id="fournisseur"/>
                    <button type="submit" class="btn btn-success">Enregistrer</button>
                </form>
                </div>
                         
                         <br><br><br><br>
            </div><div class="alert alert-info">Vous ne pouvez pas suprimer un fournisseur utilisé</div>
        </div>
           </div>
        </div>
        <!--Js -->
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
