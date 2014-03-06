<?php
include('annee.class.php');
class Users
{
    private  static $bdd;

function __construct($nb = null) 
{
    if(!isset($_SESSION['annee']))
    {    
    if($nb==null)
    {
    $annee= new annee();
    $nb=$annee->DerniereAnnee();
    }
    Users::$bdd=connexion_base($nb);
    Users::$bdd->query("SET CHARACTER SET utf8"); 
    }
    else
    {
    Users::$bdd=connexion_base($_SESSION['annee']);
    Users::$bdd->query("SET CHARACTER SET utf8");  
    }
}    


function verification($nom,$mdp) 
{
    $req="SELECT * FROM users inner join typeuser on typeuser.Id=users.Type Where Login='".$nom."';";
    $rs = Users::$bdd->query($req);
    $result = $rs->fetchAll();
    if(count($result)==0)
    {
        $reponse="<br>Il n'existe pas d'utilisateur avec ce pseudo";
    }
    elseif (count($result)==1) 
        {  
            foreach ($result as $value) 
            {
                if ($value['Mdp']== (md5($mdp)))
                {
                    if($value['Type']!=1)
                {
                    $annee=new annee();
                    $nb=$annee->DerniereAnnee();
                    Users::$bdd=connexion_base($nb);
                    $reponse="<br>Bienvenue ".$value['Login']."";
                    connecter($value['Id'], $value['Login'], $value['Type'],$value['Details']);

                }
                else
                {
                    $reponse="<br>Bienvenue ".$value['Login']."";
                    connecter($value['Id'], $value['Login'], $value['Type'],$value['Details']);
                }
                header("location: Accueil1.php");
                }
                else
                {
                    $reponse="<br>Mauvais mot de passe";
                }
            }
        }
        else
        {
            $reponse="<br>Erreur";
        }
            return  $reponse ;                 
}

function MajMdp($Mdp, $Login)
{
            $req = "SELECT Mdp from users where Login = '$Login';";
            $this->retour = Users::$bdd->prepare($req);
            $rs = $this->retour->execute(); 

            $req1 = "UPDATE users SET Mdp = (md5('$Mdp')) where Login = '$Login';";
            $this->retour = Users::$bdd->prepare($req1);
            $this->retour->execute(); 
}
      
         function affiche_unuser($id)
    {
        $req="SELECT * From users where Id=$id";  
        $rs = Users::$bdd->query($req);
        return $result = $rs->fetchAll();
    }
         function affiche_user()
    {
        $req="SELECT users.Id, Login, count( detailsligneproduit.Id ) as utiliser
From users left join detailsligneproduit on users.Id=detailsligneproduit.IdUsers
group by Login,Id";  
        $rs = Users::$bdd->query($req);
        return $result = $rs->fetchAll();
    }
    
    function supprimer_user($Iduser)
    { 
        if($this->Verif_userSup($Iduser)==0)
        {
            
       $req="Delete FROM users WHERE Id='$Iduser'" ;  
        $rs = Users::$bdd->query($req);
     $reponce=" L'utilisateur a été supprimé.";
    }else
    {
        $reponce=" L'utilisateur $user est utilisé par plusieurs produit et/ou objet confectionné il ne peut donc pas être supprimé";
    }
    return$reponce;
    }
    
    function Ajout_user($user,$type)
    { 

             if( $this->Verif_user($user)==0)
             {
                 $mdp=$this->random();
                 $mdpmd5=md5($mdp);
            $req="Insert Into users(Login,Mdp,Type)values('$user','$mdpmd5','$type')" ;  
            Users::$bdd->query($req);
        $reponce = "L'utilisteur $user a été ajouté. Son Mot de passe est $mdp";
        } 
        else{$reponce="L'utilisateur existe déjà";}
    return $reponce;
    }
    
    function Verif_user($user)
    { 
       $req="SELECT Login From Users WHERE Login='$user';" ;  
        $rs = Users::$bdd->query($req);
        return $result = count($rs->fetchAll());
    }
       
    function Modifier_user($Id,$user,$type)
    { 
       $req="UPDATE users SET Login='$user',type='$type' WHERE Id='$Id';" ;  
       Users::$bdd->query($req);
     
    }
    
    function Remise_zero($Id,$login)
    {
         $mdp=$this->random();
         $mdpmd5=md5($mdp);
         $req="UPDATE users SET Mdp='$mdpmd5' WHERE Id='$Id';" ; 
         Users::$bdd->query($req);
         return $rep ="Le nouveau mot de passe de l'utilisateur $login est $mdp.";
        
    }
    
     function Verif_userSup($Iduser)
    {
   $req="SELECT count(*) as utiliser From users Inner join detailsligneproduit on  users.Id=detailsligneproduit.IdUsers  Where users.Id='$Iduser' group by Login";
     $rs = Users::$bdd->query($req);
     $result = count($rs->fetchAll());
     return $result;   
    }
    
function random() 
{
$string = "";
$chaine = "abcdefghijklmnpqrstuvwxy0123456789";
srand((double)microtime()*1000000);
for($i=0; $i<6; $i++) {
$string .= $chaine[rand()%strlen($chaine)];
}
return $string;
}
        
}
?>
