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
        $reponce="<br>Il n'existe pas d'utilisateur avec ce pseudo";
    }
    elseif (count($result)==1) 
        {  
        foreach ($result as $value) 
        {
            if ($value['Mdp']== (md5($mdp)))
            {
            $reponce="Bienvenu ".$value['Login']."";
            connecter($value['Id'], $value['Login'], $value['Type']);
            }else
            {
            $reponce="<br>Mauvais mot de passe";}
        }
}
else
{
    $reponce="<br>Erreur";
}
   
     return  $reponce ;                
                    

    
}
}
?>
