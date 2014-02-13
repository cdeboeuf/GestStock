<?php
include('annee.class.php');
class Users
{
    private  static $bdd;

function __construct($nb = null) 
{
    if($nb==null)
    {
    $annee= new annee();
    $nb=$annee->DerniereAnnee();
    }
    Users::$bdd=connexion_base($nb);
    Users::$bdd->query("SET CHARACTER SET utf8"); 
}    


function verification($nom,$mdp) 
{
    $req="SELECT * FROM users Where Login='".$nom."';";
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
                    connecter($value['Id'], $value['Login'], $value['Type']);

                }
                else
                {
                    $reponse="<br>Bienvenue ".$value['Login']."";
                    connecter($value['Id'], $value['Login'], $value['Type']);
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
            $req = "UPDATE users SET Mdp = (md5('$Mdp')) where Login = '$Login';";
            $this->retour = Users::$bdd->prepare($req);
            $this->retour->execute(); 
}
        
         function affiche_user()
    {
        $req="SELECT Login, count( detailsligneproduit.Id ) as utiliser
From users left join produit on users.Id=detailsligneproduit.IdUsers
group by Login";  
        $rs = Users::$bdd->query($req);
        return $result = $rs->fetchAll();
    }
    
    function supprimer_user($user)
    { 
        if($this->Verif_userSup($user)==0)
        {
            
      echo  $req="Delete FROM users WHERE Nom='$user'" ;  
        $rs = Users::$bdd->query($req);
     $reponce=" L'utilisateur $user a été supprimé";
    }else
    {
        $reponce=" Le l'utilisateur $user est utilisé par plusieurs produit et/ou objet confectionné il ne peut donc pas etre suprimé";
    }
    return$reponce;
    }
    
    function Ajout_user($user,$type)
    { 

             if( $this->Verif_user($user)==0)
             {
                 $mdp=  $this->NewMDP();
        $req="Insert Into user(Nom,Mdp,Type)values('$four','$mdp','$type')" ;  
        $rs = Fournisseurs::$bdd->query($req);
        $reponce = "Le Fournisseur a été ajouté";
        } 
        else{$reponce="Le Fournisseur existe déjà";}
    return $reponce;
    }
    
    function Verif_Fournisseurs($four)
    { 
       $req="SELECT Nom From Fournisseurs WHERE Nom='$four';" ;  
        $rs = Fournisseurs::$bdd->query($req);
        return $result = count($rs->fetchAll());
    }
    
     function Verif_FournisseursSup($four)
    {
   $req="SELECT count(*) as utiliser
From Fournisseurs Inner join produit on  fournisseurs.Id=produit.IdFournisseur  Where Fournisseurs.Nom='$four'
group by Nom";
     $rs = Fournisseurs::$bdd->query($req);
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
// APPEL
// Génère une chaine de longueur 20
 
        
}
?>
