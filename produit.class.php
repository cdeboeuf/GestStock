
<?php
    class PdoParde 
{
        private static $serveur='mysql:host=localhost';
      	private static $bdd='dbname=2014';   		
      	private static $user='root' ;    		
      	private static $mdp='' ;	
	private static $monPdo;
                
/**
 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */				
	public function __construct(){
    	PdoParde::$monPdo = new PDO(PdoParde::$serveur.';'.PdoParde::$bdd, PdoParde::$user, PdoParde::$mdp); 
		PdoParde::$monPdo->query("SET CHARACTER SET utf8");
	}
	public function _destruct(){
		PdoParde::$monPdo = null;
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
            $requete = "Select Id, RefLycee, RefFournisseur, Fournisseurs.Nom, Designation, QuantiteTotal, PATTCPondere
                        From Produit inner join Fournisseurs on Produit.IdFournisseur = Fournisseurs.Id";
            $rs = PdoParde::$monPdo->query($requete);
            while($laLigne = $rs->fetch())	
            {
                echo $rs;
            }
			
        }
        
        public function MajValorisationStock($QuantiteTotal, $PATTCPondere)
        {
            $requete1 = "INSERT INTO Produit(QuantiteTotal) VALUES('$QuantiteTotal');";
            $rs1 = PdoParde::$monPdo->query($requete1);
            $requete2 = "Select (SUM(PATTC * Quantite) / QuantiteTotal) as $PATTCPondere from detailsligneproduit inner join produit on detailsligneproduit.Id = produit.Id ;";
            $rs2 = PdoParde::$monPdo->query($requete2);
            $requete3 = "INSERT INTO Produit(PATTCPondere) VALUES('$PATTCPondere);";
            $rs3 = PdoParde::$monPdo->query($requete3);
        }
    

}
?>
