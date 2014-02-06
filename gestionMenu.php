<?php include('connexion.php')?> 
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
            <?php include('Menu.php');?>
           
                  <div class="span12"> 
                <ul class="nav nav-tabs" id="profileTabs">
                    <li><a href="./parametre.php">Modifier le taux de TVA</a></li>
                    <li><a href="./uniteAchat.php">Modifier une unitée d'achat</a></li>
                    <li><a href="./coutMachine.php">Modifier le coût machine</a></li>
                    <li class="active"><a href="./gestionMenu.php">Gerer les menus</a></li>                   
                    <li><a href="./coefCorrection.php">Modifier le coeficient de correction</a></li>               
                </ul><div class="hero-unit"> 
                
                </div>
        </div>
        </div>
        <!--Js -->
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>