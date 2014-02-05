<!DOCTYPE html> 
    <?php 
    include('user.class.php');
        if(!empty($_POST))
        {
              extract($_POST);
              if(isset($_POST['nom']) && isset($_POST['mdp']))
              {
              $user=new Users($_POST['ans']);
              $resultat= $user->verification($_POST['nom'],$_POST['mdp']);
              $resultatAnnee="Année ".$_SESSION['annee'];
              }
              else{
                  $erreur= "pas de nom ou de mdp";
              }
        } ?>                    
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
                <h1><?php if(isset($resultatAnnee)) {echo $resultatAnnee;}?>
                <small>Connexion</small></h1>
                   
            </div> <h5><?php If(isset($resultat)){echo $resultat;}?></h5>
            <div class="hero-unit"> 
                <div class="row-fluid"> 
                <div class="span4"></div>
                <form class="span3" name="connexion" action="index.php" method="post">
                    <label class="badge" for="nom">Pseudo de connexion :</label> <input type="text" name="nom" id="nom"/>
                    <br>
                    <label class="badge" for="mdp">Mot de passe :</label> <br> <input type="password" name="mdp" id="mdp"/>   
                    <br>
                    <span class="badge">Pour les administrateurs :</span>
                    <SELECT name="ans" id="ans">
                  <?php
                  
                $cannee= new annee();
                
                $Lesannees= $cannee->ListeAnnee();
                 foreach ($Lesannees as $valeur)               
                     {
                 
                     ?>
                        <option value="<?php echo $valeur[1]?>" <?php if($valeur[1]== date("Y")){?>selected<?php } ?>><?php echo $valeur[1]?></option>
                    <?php }    
                  //blupppp
                  ?>          
                 </SELECT>
                    <br>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>
                </div>
            </div>
        </div>
        <!--Js -->
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
