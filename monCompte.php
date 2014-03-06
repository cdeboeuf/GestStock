<!DOCTYPE html>

<?php include('bonjour.php');  
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
        $oldMdp=$_POST['oldpsd'];
        
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
               <th> <td><?php logo() ?></td><td><?php annee()?><h1><small>Mon profil</small></h1>
                <?php bonjour() ?></td></th></table>
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
                                    <label class="control-label" for="NewMDP">Ancien mot de passe :</label>
                                    <div class="controls">
                                        <input name="oldpsd" placeholder="Ancien mot de passe" class="input-medium" required="" type="password" id="oldpsd">
                                    </div>
                                    </div>


                                    <!-- Text input-->
                                    <div class="control-group">
                                    <label class="control-label" for="NewMDP">Nouveau mot de passe :</label>
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
                                        if ($Mdp == $confirmMdp && $oldMdp == $rs )
                                        {
                                        ?>  <div class="alert alert-success">  
                                                <a class="close" data-dismiss="alert">×</a>  
                                                <strong>Merci</strong>, Votre mot de passe a été modifié.  
                                            </div>
                                        <?php 
                                        }
                                        else
                                        {
                                        ?>
                                            <div class="alert alert-error">  
                                                <a class="close" data-dismiss="alert">×</a>  
                                                <strong>Erreur</strong>, les mots de passe ne correspondent pas.  
                                            </div>
                                        <?php
                                        }
                                    }
                                    ?>
                                    
                                    <!-- Button -->
                                    <div class="controls">
                                        <button type="submit" value="submit" name="action" class="btn btn-success">Valider</button>
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

