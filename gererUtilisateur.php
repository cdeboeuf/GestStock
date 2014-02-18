<?php 

include('user.class.php');
include('typeuser.class.php');
if(!isset($_SESSION['idVisiteur'])) 
{header('location: index.php');  }

$usersP= new Users();   
$destype=new Typeuser();
$LesTypes=$destype->affiche_Type();

if(isset($_POST['user'])& isset($_POST['type']))
{
   $rep= $usersP->ajout_user($_POST['user'],$_POST['type']);

}
 if(isset($_POST['action']))                    
{
                    if($_POST['action']=='Valider')
                    { 
                        if (isset($_POST['Mtype'])&& ($_POST['Muser']))
                    {
                        $rep =$usersP->Modifier_user($_POST['Mid'],$_POST['Muser'],$_POST['Mtype']);
                    }
                  
                    }
                    
                    
                          if(isset($_POST['Mid']))
                        {
                            $unuser=$usersP->affiche_unuser($_POST['Mid']);
                        }
                        else
                        {
                        $unuser=$usersP->affiche_unuser($_POST['userSup']);                    
                        }
                     
                   
                    if($_POST['action']=='Zero')
                    {
                      $reponse= $usersP->Remise_zero($_POST['Mid'],$_POST['Muser']);
                     
                    }
                    }
if(isset($_POST['userSup']))
{
    if($_POST['userSup']=="")
    {
        $reponce="Il n'y a pas d'utilisateur a supprimer";
    }
    else{
        if(isset($_POST['action1']))
        {
 if($_POST['action1']=="Supprimer")
    {

   $rep= $usersP->supprimer_user($_POST['userSup']);
    }
        }
    }
}
$LesUsers= $usersP->affiche_user();

?> 

<html>
    <head>
        <title></title>
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
                <h1><small>Parametre</small></h1>
                </div>
            <?php include('Menu.php');
            $menu=new Menu();
               $page=pathinfo($_SERVER['PHP_SELF']);
           $menu->Verifdroit($page['basename']);
           ?><div class="span12">
                      <div class="hero-unit"> 
                          <div class="row-fluid">
                             <?php
                             if(isset($reponse))
                             {
                                 ?><div class="alert alert-warning"><?php echo $reponse?></div><?php
                             }
                             if(isset($rep)){ 
                                 if ($rep=="L'utilisateur a été ajouté"){?>
                                 
                             <div class="alert alert-success "><?php echo $rep;} else{?></div>
                         <div class="alert alert-error"><?php echo $rep;}?></div>
                         <?php } ?>
                        
                      <div class='<?php if(isset($_POST['action'])){echo 'span3';}else{echo 'span3';}?>'>
                <form name="usernew" action="gererUtilisateur.php" method="post">
                    <label class="badge" for="user">Nouveau Utilisateur :</label> <input type="text" name="user" id="user">
                       <SELECT name="type" id="userSup">
                  <?php
                 foreach ($LesTypes as $untype)               
                     {
                 
                     ?>
                        <option value='<?php echo $untype['Id'] ?>'><?php echo $untype['Details']?></option>
                     <?php }
                  ?>          
                 </SELECT>
                    
                     <button type="submit" class="btn btn-success" name="action2" value="Valider">Enregistrer</button>
                </form>
                </div>
                         <div class='span4 offset1'>
                         <label class="badge" for="userSup">Les utilisateurs déjà enregistrés:</label>
                 <form class="span3" name="userSup" action="gererUtilisateur.php" method="post">
                 <SELECT name="userSup" id="userSup">
                  <?php
                 foreach ($LesUsers as $uNuser)               
                     {
                 
                     ?>
                        <option value='<?php echo $uNuser['Id'] ?>'><?php echo $uNuser['Login']." (Utilisation:".$uNuser['utiliser'].")"?></option>
                     <?php }
                  ?>          
                 </SELECT>
                      <div class="btn-group ">
                     <button type="submit" class="btn btn-info" name="action" value="Modifier">Modifier</button>
                     <button type="submit" class="btn btn-danger" name="action1" value="Supprimer">Supprimer</button>
                      </div> 
                 </form>
                     </div>
                          <div class="span4">
                         <?php  
                         
                    if(isset($_POST['action']))
                    {  
                
                    ?>
                         
                           
                <form  name="usermodif" action="gererUtilisateur.php" method="post">
                    <label class="badge" for="Muser">Utilisateur :</label> <input type="text" name="Muser" value="<?php foreach ($unuser as $UnUser)               
                    {echo $UnUser['Login']; $letype=$UnUser['Type'] ; }?>" id="Muser"/>
                    <input type="hidden" name="Mid" value="<?php foreach ($unuser as $UnUseR) {echo $UnUseR['Id']; }?>" id="Mid"/>                   
                    <SELECT name="Mtype" id="MuserSup">
                  <?php
                 foreach ($LesTypes as $untype)               
                     {
                 
                     ?>
                        <option value='<?php echo $untype['Id'] ?>' <?php if($untype['Id']==$letype){echo "selected";} ?>><?php echo $untype['Details']. "."?></option>
                     <?php }
                  ?>          
                 </SELECT>
                    <div class="btn-group ">
                     <button type="submit" class="btn btn-success" name="action" value="Valider">Enregister<br>la modification</button>
                      <button type="submit" class="btn btn-info" name="action" value="Zero">Réinitialiser<br>le mot de passe</button>
                      
                    </div>
                </form> 
                    <?php
                    }
                    ?>          
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
