<?php 
include('connexion.php');
include('typeuser.class.php');
//include('menu.class.php');
if(!isset($_SESSION['idVisiteur'])) 
{header('location: index.php');  }


$Typeuser= new Typeuser();                

if(isset($_POST['type']))
{
          $rep= $Typeuser->ajout_Type($_POST['type']);

}
if(isset($_POST['action'])&& $_POST['action']=="Modifier")
{
if(isset($_POST['typeSup']))
{
     
   $rep= $Typeuser->supprimer_Type($_POST['typeSup']);

}
}
$LesType= $Typeuser->affiche_Type();




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
           $menu->Verifdroit('parametre.php');
  
//$menu->Verifdroit();
            if(isset($rep)){echo $rep;}?>
                  <div class="span12"> 
                <ul class="nav nav-tabs" id="profileTabs">
                    <li><a href="./parametre.php">Modifier le taux de TVA</a></li>
                    <li><a href="./uniteAchat.php">Modifier une unitée d'achat</a></li>
                    <li><a href="./coutMachine.php">Modifier le coût machine</a></li>
                    <li><a href="./coefCorrection.php">Modifier le coefficient de correction</a></li>   
                    <li class="active"><a href="./gestionMenu.php">Gerer les menus</a></li>                             
                </ul>
                <div class="hero-unit"> 
                    
                           <div class="span3">
                    <form  name="newtype" action="gestionMenu.php" method="post">
                    <label class="badge" for="type">Nouveau Type :</label> <input type="text" name="type" id="type"/>
                    <button type="submit" class="btn btn-success">Envoyer</button>
                    </form>
                    </div>
                    <div class='span3'>
                 <form name="typeSup" action="gestionMenu.php" method="post">
                     <label class="badge" for="typeSup">Les types d'utilisateur déjà enregistré:</label>
                 <SELECT name="typeSup" id="tvaP">
                  <?php
                 foreach ($LesType as $untype)               
                     {
                $Details=stripslashes($untype['Details']);
                     ?>
                        <option value='<?php echo $untype['Id']?>'><?php echo $untype['Details']." (Utilisation:".$untype['utiliser'].")"?></option>
                     <?php 
                   
                     }
                  ?>          
                 </SELECT><br>
                     <button type="submit" class="btn btn-danger" name="action" value="Modifier">Supprimer</button>
                     <button type="submit" class="btn btn-success" name="action" value="Valider">Valider</button>
                     </form>
                    </div>
                     <div class='span3 offset1'>
                    <?php  
                    if(isset($_POST['action']))
                    {  
                   ?>
                   
    
                    <?php
                    if($_POST['action']=='Ajou')
                    { 
                        if (isset($_POST['ajout']))
                    {
                        $rep =$menu->ajouter_menu_liste($_POST['typeSup'],$_POST['ajout']);
                    }else
                    { $rep="Vous ne pouvez pas ajouter un menu vide";}
                    }
                    
                    
                     if($_POST['action']=='Sup')
                    {
                         if (isset($_POST['suprimer']))
                    {
                        $menu->suprimer_menu_liste($_POST['typeSup'],$_POST['suprimer']);
                    }else{
                        $rep="Vous ne pouvez pas ajouter un menu vide";
                    
                    }
                    
                     }
                     
                     
                       $manque=$menu->affiche_pas_menu_user($_POST['typeSup']);
                    $possede=$menu->affiche_menu_user($_POST['typeSup']);
                   
                    ?>
                         
                    <form method='POST'action="gestionMenu.php">
                    <input type='hidden' name='typeSup' id='typeSup' value='<?php echo $_POST['typeSup'] ?>'>
                    <SELECT name="ajout" id="Ajouter">                     
                     <?php foreach ($manque as $m)               
                     {
                     ?>
                        <option value='<?php echo $m['Id']?>'><?php echo $m['Details']?></option>
                     <?php 
                   
                     }    ?>       
                    </SELECT>
                         <button type="submit" class="btn btn-success" name="action" value="Ajou">Ajouter</button>
                    </form>
    
                    <form method='POST'action="gestionMenu.php">
                    <input type='hidden' name='typeSup' id='typeSup' value='<?php echo $_POST['typeSup'] ?>'>
                    <SELECT name="suprimer" id="Suprimer">
                    <?php foreach ($possede as $p)     
                                                  {
                     ?>
                        <option value='<?php echo $p['IdLien']?>'><?php echo $p['Details']?></option>
                     <?php 
                   
                     }   
                     ?>
                    </SELECT>
                         <button type="submit" class="btn btn-danger" name="action" value="Sup">Suprimer</button>
                    </form>
                    <?php
                    } ?>          
                   </div>
                    <br>
                    <br>
                    <br>
                    <br>                   
                    <br>
                     <div class="alert alert-info">Vous ne pouvez pas suprimer un type d'utilisateur utilisé <br> Valider un type pour modifier son menu</div>
                   <?php
                    if(isset($rep)){?><div class="alert alert-danger"> <?php echo  $rep;?></div><?php }
                    ?>
                </div>
        </div>
        </div>
        <!--Js -->
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>