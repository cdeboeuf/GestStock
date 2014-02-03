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
                <small>Produit</small></h1>
            </div>
            <div class="hero-unit"> 
                <div class="span6"></div>
                
                <form class="span3 ">
                        <button type="submit" class="btn btn-primary" onClick="window.print()">Imprimer</button>
                </form>
                
                <br>
                <br>
                <br>
                
                <?php 
                include('produit.class.php');

                $produit =new Produit();
                $Resultat = $produit->GetValorisationStock();
                
                foreach ($Resultat as $value) 
                    {
                        echo $value[0];
                        echo "<br>";
                        echo $value[1];
                        echo "<br>";
                        echo $value[2];
                        echo "<br>";
                        echo $value[3];
                        echo "<br>";
                        echo $value[4];
                        echo "<br>";
                        echo $value[5];
                        echo "<br>";
                        echo $value[6];
                    }

                $produit =new PdoParde();
                $produit->GetValorisationStock(); 
//               try{ foreach ($produit as $unFrais)
//                                {
//               echo $unFrais[0];}}
//               catch (PDOException $e) {
//    echo 'Échec lors de la connexion : ' . $e->getMessage();
//}

                ?>
                
                
            </div>
        </div>
        <!--Js -->
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>

