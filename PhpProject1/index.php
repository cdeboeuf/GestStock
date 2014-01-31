<!DOCTYPE html>
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
                <div class="span6"></div>
                <form class="span3 ">
                    <input type="text" placeholder="login">
                    <input type="password" placeholder="mot de passe">
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>
                <br>
                <br>
                <br>
                <?php 
                include('annee.class.php');
                $annee=new annee();
                $annee=$annee->LireAnnée();
                foreach ($annee as $unMois)
		{
			    echo $unMois[1];
                            echo " ";
                }
                ?>
            </div>
        </div>
        <!--Js -->
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>

