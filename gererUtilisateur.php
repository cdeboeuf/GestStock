<?php include('connexion.php');
include('user.class.php');

if(!isset($_SESSION['idVisiteur'])) 
{header('location: index.php');  }

$usersP= new Users();                

if(isset($_POST['user'])& isset($_POST['type']))
{
   $rep= $usersP->ajout_user($_POST['user'],$_POST['type']);

}
if(isset($_POST['userSup']))
{
   $rep= $usersP->supprimer_user($_POST['usersSup']);

}
$LesUsers= $usersP->affiche_user();

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
                         <label class="badge" for="userSup">Les fournisseurs déjà enregistrés:</label>
                 <form class="span3" name="userSup" action="fournisseur.php" method="post">
                 <SELECT name="userSup" id="userSup">
                  <?php
                 foreach ($LesUsers as $unuser)               
                     {
                 
                     ?>
                        <option value='<?php echo $unuser['Login'] ?>'><?php echo $unuser['Login']." (Utilisation:".$unuser['utiliser'].")"?></option>
                     <?php }
                  ?>          
                 </SELECT>
                     <button type="submit" class="btn btn-danger">Supprimer</button>
                     </form>
                     </div>
                      <div class='span4'>
                <form class="span3" name="usernew" action="fournisseur.php" method="post">
                    <label class="badge" for="user">Nouveau fournisseur :</label> <input type="text" name="user" id="user"/>
                    <button type="submit" class="btn btn-success">Envoyer</button>
                </form>
                </div>
                         
                         <br><br><br><br>
            </div><div class="alert alert-info">Vous ne pouvez pas suprimer un utilisateur qui a créé un objet confectionné non cloturé</div>
        </div>
           </div>
        </div>
        <!--Js -->
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
