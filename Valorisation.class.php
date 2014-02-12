<?php
//include('connexion.php');
class Valorisation
{
    private  static $bdd;
    private  static $bddnew;
    private  static $bddans;
    private static $anneenouvelle;
    private static $anneeancienne;
    
                function __construct() 
    {
             
        Valorisation::$anneeancienne=$_SESSION['annee'];
        Valorisation::$bdd=connexion_base(Valorisation::$anneeancienne);
        Valorisation::$bdd->query("SET CHARACTER SET utf8"); 
    }  
    Function AjoutAnnee()
    {
        Valorisation::$bddans = new PDO('mysql:host=localhost;dbname=annee','root','') or die(print_r($bddnew->errorInfo()));
        Valorisation::$bddans->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        Valorisation::$bddans->exec('SET NAMES utf8');
        $req="INSERT IGNORE INTO annee(Ans) Value('".Valorisation::$anneenouvelle."')";
        Valorisation::$bddans->query($req);        
        echo "Création de ".Valorisation::$anneenouvelle.".<br>";
    }
    
    function nouvelleBDD()
 {  
        Valorisation::$anneenouvelle=(int)  Valorisation::$anneeancienne+1;
        $req="Create database if not exists `".Valorisation::$anneenouvelle."` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;";
        $this->AjoutAnnee();
        Valorisation::$bdd->query($req);        
        echo "Création de la base de données ".Valorisation::$anneenouvelle.".<br>";
        
        //Connection
        Valorisation::$bddnew = new PDO('mysql:host=localhost;dbname='.Valorisation::$anneenouvelle.'','root','') or die(print_r(Valorisation::$bddnew->errorInfo()));
        Valorisation::$bddnew->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        Valorisation::$bddnew->exec('SET NAMES utf8');
       
        $this->tabletypeuser();
        $this->donneetypeuser();
        $this->tabletva();
        $this->donneetva();
        $this->tablesection();
        $this->donneesection();
        $this->tableparametre();
        $this->donneeparametre();
        $this->tablefournisseurs();
        $this->donneefournisseurs();
        $this->tablelien();
        $this->donneelien();
        $this->tablemenu();
        $this->donneemenu();
        $this->tableutilisation();
        $this->donneeutilisation();
        $this->tableunite();
        $this->donneeunite();
        $this->tableusers();
        $this->donneeusers();
        $this->tableproduit(); 
        $this->donneeproduit();
        $this->tableobjetconfectionne();
        $this->donneeobjetconfectionne();
        $this->tableligneoc();
        $this->donneeligneoc();
        $this->tabledetailsligneproduit();
        $this->donneedetailsligneproduit();
    }

        Function tabledetailsligneproduit()
    {
           echo "création de la table détaile ligne produit <br>";
        $req=file_get_contents('./BDD/detailsligneproduit.sql');
           Valorisation::$bddnew->query($req);
    }
        Function tablefournisseurs()
    {
           echo "création de la table fournisseurs <br>";
           $req=file_get_contents('./BDD/fournisseur.sql');
           Valorisation::$bddnew->query($req);              
    }    
           
           Function tablelien()
    {
          echo "création de la table lien <br>";
           $req=file_get_contents('./BDD/lien.sql');
           Valorisation::$bddnew->query($req);
    }    
    
    Function tableligneoc()
    {
          echo "création de la table ligneOC <br>";
           $req=file_get_contents('./BDD/ligneoc.sql');
           Valorisation::$bddnew->query($req);
    }    
    
    Function tablemenu()
    { 
            echo "création de la table menu <br>";
           $req=file_get_contents('./BDD/menu.sql');
           Valorisation::$bddnew->query($req);
    }   
    
    Function tableobjetconfectionne()
    {
         echo "création de la table Objet Confectionné <br>";
           $req=file_get_contents('./BDD/objetconfectionne.sql');
           Valorisation::$bddnew->query($req);
    }    
    
    Function tableparametre()
    {
        echo "création de la table parametre <br>";
           $req=file_get_contents('./BDD/parametre.sql');
           Valorisation::$bddnew->query($req);
    }    
    
    Function tableproduit()
    {
         echo "création de la table produit <br>";
           $req=file_get_contents('./BDD/produit.sql');
           Valorisation::$bddnew->query($req);
    } 
    
    
    Function tablesection()
    {
         echo "création de la table section <br>";
         $req=file_get_contents('./BDD/section.sql');
         Valorisation::$bddnew->query($req);
    } 
    
    
    Function tabletva()
    {
         echo "création de la table tva <br>";
           $req=file_get_contents('./BDD/tva.sql');
           Valorisation::$bddnew->query($req);
    } 
    
    Function tabletypeuser()
    {
         echo "création de la table type user <br>";
        $req=file_get_contents('./BDD/typeuser.sql');
         Valorisation::$bddnew->query($req);
    } 
    
    Function tableunite()
    {
         echo "création de la table unite <br>";
           $req=file_get_contents('./BDD/unite.sql');
           Valorisation::$bddnew->query($req);
    }
     
    Function tableusers()
    {
       echo "création de la table users <br>";
           $req=file_get_contents('./BDD/users.sql');
           Valorisation::$bddnew->query($req);
    } 
    
    Function tableutilisation()
    {
        echo "création de la table utiliation <br>";
           $req=file_get_contents('./BDD/utilisation.sql');
           Valorisation::$bddnew->query($req);
    }
    ///////////////////////////////////////////////////////////////////////////
    //////// DONNEES //////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////
        Function donneefournisseurs()
    {
           echo "copie des données de la table fournisseurs";
           $req="INSERT INTO `".Valorisation::$anneenouvelle."`.`fournisseurs` SELECT * FROM  `".Valorisation::$anneeancienne."`.`fournisseurs`";
           Valorisation::$bddnew->query($req);              
    }    
           
           Function donneelien()
    {
          echo "copie des données de la table lien";
         $req="INSERT INTO `".Valorisation::$anneenouvelle."`.`lien` SELECT * FROM  `".Valorisation::$anneeancienne."`.`lien`";
           Valorisation::$bddnew->query($req);
    }    
    
    Function donneeligneoc()
    {
          echo "copie des données de la table ligneOC";
           $req="INSERT INTO `".Valorisation::$anneenouvelle."`.`ligneoc` SELECT * FROM  `".Valorisation::$anneeancienne."`.`ligneoc` INNER JOINE `".Valorisation::$anneeancienne."`.`objetconfectionne WHERE `".Valorisation::$anneeancienne."`.`objectconfectionne.NbRealise=Null``";
           Valorisation::$bddnew->query($req);
    }    
    
    Function donneemenu()
    { 
           echo "Copie des données de la table menu";
           $req="INSERT INTO `".Valorisation::$anneenouvelle."`.`menu` SELECT * FROM  `".Valorisation::$anneeancienne."`.`menu`";
           Valorisation::$bddnew->query($req);
    }   
    
    Function donneeobjetconfectionne()
    {
         echo "Copie des donnees de la table Objet Confectionné";
         $req="INSERT INTO `".Valorisation::$anneenouvelle."`.`objetconfectionne` SELECT * FROM  `".Valorisation::$anneeancienne."`.`objetconefectionne` WHERE NbRealise=NULL";
         Valorisation::$bddnew->query($req);
    }    
    
    Function donneeparametre()
    {
           echo "Copie des données de la table parametre";
           $req="INSERT INTO `".Valorisation::$anneenouvelle."`.`parametre` SELECT * FROM  `".Valorisation::$anneeancienne."`.`parametre`";
           Valorisation::$bddnew->query($req);
    }    
    
    Function donneeproduit()
    {
         echo "Copie des données de la table produit";
         $req="INSERT INTO `".Valorisation::$anneenouvelle."`.`produit` SELECT * FROM  `".Valorisation::$anneeancienne."`.`produit`";
         Valorisation::$bddnew->query($req);
    } 
    
    
    Function donneesection()
    {
         echo "Copie des données de la table section";
         $req="INSERT INTO `".Valorisation::$anneenouvelle."`.`section` SELECT * FROM  `".Valorisation::$anneeancienne."`.`section`";
         Valorisation::$bddnew->query($req);
    } 
    
    
    Function donneetva()
    {
         echo "Copie des données de la table tva";
           $req="INSERT INTO `".Valorisation::$anneenouvelle."`.`tva` SELECT * FROM  `".Valorisation::$anneeancienne."`.`tva`";
           Valorisation::$bddnew->query($req);
    } 
    
    Function donneetypeuser()
    {
         echo "Copie des données de la table type user <br>";
          $req="INSERT INTO `".Valorisation::$anneenouvelle."`.`typeuser` SELECT * FROM  `".Valorisation::$anneeancienne."`.`typeuser`";
         Valorisation::$bddnew->query($req);
    } 
    
    Function donneeunite()
    {
         echo "Copie des données de la table unite";
         $req="INSERT INTO `".Valorisation::$anneenouvelle."`.`unite` SELECT * FROM  `".Valorisation::$anneeancienne."`.`unite`";
           Valorisation::$bddnew->query($req);
    }
     
    Function donneeusers()
    {
       echo "Copie des données de la table users";
       $req="INSERT INTO `".Valorisation::$anneenouvelle."`.`users` SELECT * FROM  `".Valorisation::$anneeancienne."`.`users`";
           Valorisation::$bddnew->query($req);
    } 
    
    Function donneeutilisation()
    {
        echo "Copie des données de la table utiliation";
        $req="INSERT INTO `".Valorisation::$anneenouvelle."`.`utilisation` SELECT * FROM  `".Valorisation::$anneeancienne."`.`utilisation`";
        Valorisation::$bddnew->query($req);
    }
    
    
}
?>
