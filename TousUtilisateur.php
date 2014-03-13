<?php 
include('bonjour.php'); 
include('user.class.php');
include('typeuser.class.php');
if(!isset($_SESSION['idVisiteur'])) 
{header('location: index.php');  }

$usersP= new Users();   
$utilisateur=$usersP->Tuser();

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
    <body onload="print()">
        <div class="container-fluid">
             
            <div class="page-header">
                <table>
               <th> <td><?php logo() ?></td><td><?php annee()?><h1><small>Gestion des utilisateurs</small></h1>
                <?php bonjour() ?></td></th></table>
            </div> 
            <?php include('Menu.php');
           ?><div class="span12">

                      <div class="hero-unit"> 
                          <div class="row-fluid">
                              <table class="table table-bordered table-striped table-condensed">
                                  <tr>
                                  <th>Id</th>
                                  <th>Login</th>
                                  <th>Type</th>
                                  </tr>
                                  <?php foreach ($utilisateur as $unUsers)
                                  {
                                      ?><tr>
                                          <td><?php echo $unUsers['Id'];?></td>
                                           <td><?php echo $unUsers['Login'];?></td>
                                           <td><?php echo $unUsers['Details'];?></td>
                                      </tr>                                    
                                  <?php }?>
                              </table>
                  </div>
           </div>
        </div>
        </div>
        <!--Js -->
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>