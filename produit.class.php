
<?php
    class produit 
{
        private static $serveur='mysql:host=localhost';
      	private static $bdd='dbname=parde';   		
      	private static $user='root' ;    		
      	private static $mdp='' ;	
	private static $monPdo;
	private static $monPdoParde=null;
                
/**
 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */				
	private function __construct(){
    	PdoGsb::$monPdo = new PDO(PdoParde::$serveur.';'.PdoParde::$bdd, PdoParde::$user, PdoParde::$mdp); 
		PdoParde::$monPdo->query("SET CHARACTER SET utf8");
	}
	public function _destruct(){
		PdoParde::$monPdo = null;
	}
        
 /* private $RefLycee;
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
    private $PondereInitial; */

    
    
    //L’administrateur pourra à chaque début d’année faire une valorisation du stock, 
    //une fiche avec la désignation des produits qui seront alors imprimés, 
    //le stock de l’année n-1 sera alors clôturé.
    Public function ValorisationStock()
    {
      
        
    }
    
    Public function Achat()
    {
        
    }
    
    Public function VoirUnProduit()
    {
        
    }
    
    Public function VoirTousProduit()
    {
        
    }
    
    Public function VoirProduitMode()
    {
        
    }
    
    Public function VoirProduitEsthetique()
    {
        
    }
    
    Public function SortieMode()
    {
        
    }
    
    Public function SortieEsthetique()
    {
        
    }
    
    
    

}
?>