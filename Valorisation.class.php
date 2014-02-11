<?php
//include('connexion.php');
class Valorisation
{
    private  static $bdd;
    private  static $bddnew;

    function __construct() 
    {
        Valorisation::$bdd=connexion_base($_SESSION['annee']);
        Valorisation::$bdd->query("SET CHARACTER SET utf8"); 
    }  
    Function AjoutAnnee()
    {
        // ajoute de l'anner dans la base de donnee annee
    }
    
    function nouvelleBDD()
 {  
        $annee=date('Y');
        $annee=(int)$annee+1;
        $req="Create database if not exists `".$annee."` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;";
        Valorisation::$bdd->query($req);        
        echo "Création de la base de données $annee.";
//Connection
        Valorisation::$bddnew = new PDO('mysql:host=localhost;dbname='.$annee.'','root','') or die(print_r($bddnew->errorInfo()));
        Valorisation::$bddnew->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        Valorisation::$bddnew->exec('SET NAMES utf8');
       
        $this->tabletypeuser();
        $this->tabletva();
        $this->tablesection();
        $this->tableparametre();
        $this->tablefournisseurs();
        $this->tablelien();
        $this->tablemenu();
        $this->tableutilisation();
        $this->tableunite();
        $this->tableusers();
        $this->tableproduit();        
        $this->tableobjetconfectionne();
        $this->tableligneoc();
        $this->tabledetailsligneproduit();
    }

        Function tabledetailsligneproduit()
    {
           echo "création de la table détaile ligne produit ///";
        $req=file_get_contents('./BDD/detailsligneproduit.sql');
           Valorisation::$bddnew->query($req);
    }
        Function tablefournisseurs()
    {
           echo "création de la table fournisseurs";
           $req=file_get_contents('./BDD/fournisseur.sql');
           Valorisation::$bddnew->query($req);              
    }    
           
           Function tablelien()
    {
          echo "création de la table lien";
           $req=file_get_contents('./BDD/lien.sql');
           Valorisation::$bddnew->query($req);
    }    
    
    Function tableligneoc()
    {
          echo "création de la table ligneOC";
           $req=file_get_contents('./BDD/ligneoc.sql');
           Valorisation::$bddnew->query($req);
    }    
    
    Function tablemenu()
    { 
            echo "création de la table menu";
           $req=file_get_contents('./BDD/menu.sql');
           Valorisation::$bddnew->query($req);
    }   
    
    Function tableobjetconfectionne()
    {
         echo "création de la table Objet Confectionné";
           $req=file_get_contents('./BDD/objetconfectionne.sql');
           Valorisation::$bddnew->query($req);
    }    
    
    Function tableparametre()
    {
        echo "création de la table parametre";
           $req=file_get_contents('./BDD/parametre.sql');
           Valorisation::$bddnew->query($req);
    }    
    
    Function tableproduit()
    {
         echo "création de la table produit";
           $req=file_get_contents('./BDD/produit.sql');
           Valorisation::$bddnew->query($req);
    } 
    
    
    Function tablesection()
    {
         echo "création de la table section";
         $req=file_get_contents('./BDD/section.sql');
         Valorisation::$bddnew->query($req);
    } 
    
    
    Function tabletva()
    {
         echo "création de la table tva";
           $req=file_get_contents('./BDD/tva.sql');
           Valorisation::$bddnew->query($req);
    } 
    
    Function tabletypeuser()
    {
         echo "création de la table type user <br>";
         echo $req=file_get_contents('./BDD/typeuser.sql');
         Valorisation::$bddnew->query($req);
    } 
    
    Function tableunite()
    {
         echo "création de la table unite";
           $req=file_get_contents('./BDD/unite.sql');
           Valorisation::$bddnew->query($req);
    }
     
    Function tableusers()
    {
       echo "création de la table users";
           $req=file_get_contents('./BDD/users.sql');
           Valorisation::$bddnew->query($req);
    } 
    
    Function tableutilisation()
    {
        echo "création de la table utiliation";
           $req=file_get_contents('./BDD/utilisation.sql');
           Valorisation::$bddnew->query($req);
    }
    
    
    
}
?>
