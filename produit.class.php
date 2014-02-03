<?php
include('annee.class.php');
    class Produit 
{
      //  private static $serveur='mysql:host=localhost';
     // 	private static $bdd='dbname=2014';   		
      //	private static $user='root' ;    		
      //	private static $mdp='' ;	
	//private static $monPdo;
        private  static $bdd;
                
/**
 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */				
	public function __construct(){
            $annee= new annee();
            $nb=$annee->DerniereAnnee();
            Produit::$bdd=connexion_base($nb);
            Produit::$bdd->query("SET CHARACTER SET utf8");
	}
	public function _destruct(){
		
	}
        
    /*private $RefLycee;
    private $Id;
    private $RefFournisseur;
    private $Designation;
    private $IdUniteAchat;
    private $IdFournisseur;
    private $QuantiteTotal;
    private $Obselete;
    private $StockAlerte;
    private $PATTCPondere;
    private $Coloris;
    private $IdSection;
    private $StockInitial;
    private $PondereInitial;*/
        
        public function GetValorisationStock()
        {
            try {
            $requete = "SELECT Produit.Id, RefLycee, RefFournisseur, Fournisseurs.Nom, Designation, QuantiteTotal, PATTCPondere
                        From Produit inner join Fournisseurs on Produit.IdFournisseur = Fournisseurs.Id";
            $rs = Produit::$bdd->query($requete);
           while($laLigne = $rs->fetch())	
            {
                 echo $laLigne[0];
            }
           echo "bubulle;";
           } catch (Exception $e) {
    echo 'Échec lors de la connexion : ' . $e->getMessage();
}
			
        }
        
        /*public function MajValorisationStock($QuantiteTotal, $PATTCPondere, $Id)
        {
            $requete1 = "INSERT INTO Produit(QuantiteTotal) VALUES('$QuantiteTotal');";
            $rs1 = Produit::$monPdo->query($requete1);
            $requete2 = "Select (SUM(PATTC * Quantite) / QuantiteTotal) as $PATTCPondere from detailsligneproduit inner join produit on detailsligneproduit.Id = produit.Id ;";
            $rs2 = Produit::$monPdo->query($requete2);
            $requete3 = "INSERT INTO Produit(PATTCPondere) VALUES('$PATTCPondere);";
            $rs3 = Produit::$monPdo->query($requete3);
        }*/
    

}
?>
