<!DOCTYPE html> 
    <?php include('user.class.php');
        if(!empty($_POST))
        {
              extract($_POST);
              if(isset($_POST['nom']) && isset($_POST['mdp']))
              {
              $user=new Users();
              echo $user->verification($_POST['nom'],$_POST['mdp']);
              }
              else{
                  echo "pas de nom ou de mdp";
              }
        }?>
             
                     
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
                <h1>
                <small>Connexion</small></h1>
            </div>
            <div class="hero-unit"> 
                <div class="row-fluid">
                <div class="span4"></div>
                <form class="span3" name="connexion" action="connexionProf.php" method="post">
                    <label for="nom">Pseudo de connexion :</label>  <input type="text" name="nom" id="nom"/>
                    <label for="nom">Mot de passe :</label><input type="password" name="mdp" id="mdp"/>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                    <!--<button type="submit" class="btn btn-primary" onClick="window.print()">Imprimer</button> -->
                </form>
                </div>
            </div>
        </div>
        <!--Js -->
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>

