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
        
        
        
        
}
?>
