
<?php
    class produit 
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
	private function __construct(){
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
        }
        
        public function MajValorisationStock($QuantiteTotal, $PATTCPondere)
        {
            $requete = "INSERT INTO Produit(QuantiteTotal, PATTCPondere) VALUES('$QuantiteTotal', '$PATTCPondere');";
            $rs = PdoParde::$monPdo->query($requete);
        }
    

}
?>