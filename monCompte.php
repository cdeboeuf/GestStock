<!DOCTYPE html>

<?php
include('user.class.php');
$user = new Users();
if(!isset($_SESSION['idVisiteur'])) 
{header('location: index.php');  }

if(isset($_POST['action']))
if (isset($_POST['action'])=='submit')
{
        $Login = $_SESSION['nom'];
        $Mdp =$_POST['psd'];
        $confirmMdp =$_POST['confirmpsd'];
        
        //on compare si le nouveau passe correspond à la confirmation
        if ($Mdp == $confirmMdp)
        {
            //si oui on update le nouveau mot de passe dans la bdd
            $user->MajMdp($Mdp, $Login);

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
                <h1><small>Mon Profil</small></h1>
            </div>
            <?php include('Menu.php');
            $menu=new Menu();
            $page=pathinfo($_SERVER['PHP_SELF']);
           $menu->Verifdroit($page['basename']);
           ?>
            <div class="span12">

                <div class="tab-content">
                    <div class="tab-pane active">   
                        <div class="hero-unit">
                            <form class="form-horizontal" action="monCompte.php" method="POST">
                                <fieldset>

                                    <!-- Form Name -->
                                    <legend>Votre Mot de passe</legend>


                                    <!-- Text input-->
                                    <div class="control-group">
                                    <label class="control-label" for="NewMDP">Nouveau votre mot de passe :</label>
                                    <div class="controls">
                                        <input name="psd" placeholder="Nouveau mot de passe" class="input-medium" required="" type="password" id="psd">
                                    </div>
                                    </div>

                                    <!-- Text input-->
                                    <div class="control-group">
                                    <label class="control-label" for="CMDP">Confirmer nouveau mot de passe :</label>
                                    <div class="controls">
                                        <input name="confirmpsd" placeholder="Confirmer nouveau mot de passe" class="input-large" required="" type="password" id="confirmpsd">
                                    </div>
                                    </div>
                                    
                                    <?php 
                                    if(isset($_POST['action']))
                                    if (isset($_POST['action'])=='submit')
                                    {
                                        if ($Mdp == $confirmMdp)
                                        {
                                        ?>  <div class="alert alert-success">  
                                                <a class="close" data-dismiss="alert">×</a>  
                                                <strong>Merci</strong>, Votre mot de passe à été modifié.  
                                            </div>
                                        <?php 
                                        }
                                        else
                                        {
                                        ?>
                                            <div class="alert alert-error">  
                                                <a class="close" data-dismiss="alert">×</a>  
                                                <strong>Erreur</strong>, les mot de passe ne correspondent pas.  
                                            </div>
                                        <?php
                                        }
                                    }
                                    ?>
                                    
                                    <!-- Button -->
                                    <div class="controls">
                                        <button type="submit" value="submit" name="action" class="btn btn-primary">Valider</button>
                                    </div>
                                </fieldset>
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

