<?php
include('connexion.php');
    class Achat 
{
        private  static $bdd;
        
/**
 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */				
	public function __construct()
       {
            Achat::$bdd=connexion_base($_SESSION['annee']);
            Achat::$bdd->query("SET CHARACTER SET utf8");
	}
        
        public function ListeFournisseurs()
        {
            try 
            {
                $requete = "SELECT Nom From fournisseurs;";
                $this->retour = Achat::$bdd->prepare($requete);
                $this->retour->execute();   
                foreach ($this->retour as $ligne)
                {
                    echo "<option>";
                    echo $ligne["Nom"];
                    echo "</option>";
                }
            } 
            catch (Exception $e) 
            {
                 echo 'Échec lors de la connexion : ' . $e->getMessage();
            }	
        }
        
        public function ListeUniteAchat()
        {
            try 
            {
                $requete = "SELECT Details From unite;";
                $this->retour = Achat::$bdd->prepare($requete);
                $this->retour->execute();   
                foreach ($this->retour as $ligne)
                {
                    echo "<option>";
                    echo $ligne["Details"];
                    echo "</option>";
                }
            } 
            catch (Exception $e) 
            {
                 echo 'Échec lors de la connexion : ' . $e->getMessage();
            }	
        }
        
        public function ListeTVA()
        {
            try 
            {
                $requete = "SELECT Taux From tva;";
                $this->retour = Achat::$bdd->prepare($requete);
                $this->retour->execute();   
                foreach ($this->retour as $ligne)
                {
                    echo "<option>";
                    echo $ligne["Taux"];
                    echo "</option>";
                }
            } 
            catch (Exception $e) 
            {
                 echo 'Échec lors de la connexion : ' . $e->getMessage();
            }	
        }
        
        public function ListeRefFournisseur()
        {
            try 
            {
                $requete = "SELECT RefFournisseur From produit where IdSection = 1;";
                $this->retour = Achat::$bdd->prepare($requete);
                $this->retour->execute();   
                foreach ($this->retour as $ligne)
                {
                    echo "<option>";
                    echo $ligne["RefFournisseur"];
                    echo "</option>";
                }
            } 
            catch (Exception $e) 
            {
                 echo 'Échec lors de la connexion : ' . $e->getMessage();
            }	
        }

        
}
?>
