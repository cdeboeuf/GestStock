<?php
include('connexion.php');
    class Produit
{
        public function GetValorisationStock()
        {
            $bdd=connexion_parde();
            $requete = "Select Produit.Id, RefLycee, RefFournisseur, Fournisseurs.Nom, Designation, QuantiteTotal, PATTCPondere From Produit inner join fournisseurs on Produit.IdFournisseur = Fournisseurs.Id";
            $rs = $bdd->query($requete);
            $LesLignes = $rs->fetchAll();
       	    return $LesLignes;
        }
        
        /*public function MajValorisationStock($QuantiteTotal, $PATTCPondere, $Id)
        {
            $requete1 = "UPDATE Produit set (QuantiteTotal)= '$QuantiteTotal' where Produit.Id = '$Id';";
            $rs1 = PdoParde::$monPdo->exec($requete1);
            $requete2 = "Select (SUM(PATTC * Quantite) / QuantiteTotal) as $PATTCPondere from detailsligneproduit inner join produit on detailsligneproduit.Id = produit.Id ;";
            $rs2 = PdoParde::$monPdo->query($requete2);
            $requete3 = "UPDATE Produit set (PATTCPondere) = '$PATTCPondere where Produit.Id = '$Id';";
            $rs3 = PdoParde::$monPdo->exec($requete3);
        }*/
    

}
?>
