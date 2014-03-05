<?php
class ObjectConfectionne
{
    private  static $bdd;

    function __construct() 
    {
        ObjectConfectionne::$bdd=connexion_base($_SESSION['annee']);
        ObjectConfectionne::$bdd->query("SET CHARACTER SET utf8"); 
    }     

    function affiche_objetNC()
    {
        $req="SELECT *,objetconfectionne.Id As Ido FROM objetconfectionne INNER JOIN users on objetconfectionne.professeur=users.Id where NbRealise = '0';";
        $rs = ObjectConfectionne::$bdd->query($req);
        $result = $rs->fetchAll();
        return $result;
    }
        function affiche_objetC()
    {
        $req="SELECT *,objetconfectionne.Id As Ido FROM objetconfectionne INNER JOIN users on objetconfectionne.professeur=users.Id where NbRealise != '0';";
        $rs = ObjectConfectionne::$bdd->query($req);
        $result = $rs->fetchAll();
        return $result;
    }
    
    function affiche_OC($ref)
    {
        $req="SELECT *,objetconfectionne.Id As Ido ,date_format(objetconfectionne.DateEmi, '%d/%m/%Y')As DateEmiF,date_format(objetconfectionne.DateFabri, '%d/%m/%Y')As DateFabriF  FROM objetconfectionne INNER JOIN users on objetconfectionne.professeur=users.Id where objetconfectionne.Id = '$ref';";
        $rs = ObjectConfectionne::$bdd->query($req);
        $result = $rs->fetchAll();
        return $result;
    }
    
    function affiche_ligne($Ref)
    {
        $req="SELECT ligneoc.Id, ligneoc.RefOc, ligneoc.RefLycee, ligneoc.Quantite as QuantiteLigne, ligneoc.PuTTC as PuTTCLigne ,objetconfectionne.Ref,objetconfectionne.Id,objetconfectionne.Annee,objetconfectionne.Designation,objetconfectionne.NbPrevision,objetconfectionne.Professeur,objetconfectionne.Destination,date_format(objetconfectionne.DateEmi, '%d/%m/%Y') as DateEmiF,objetconfectionne.CoefCorrection,objetconfectionne.NbRealise,objetconfectionne.Temps,objetconfectionne.TotalMatiere,objetconfectionne.TotalFrais,objetconfectionne.TotalCoutEleve,objetconfectionne.CoutMachine,objetconfectionne.TotalCoutPublic,objetconfectionne.PrixUnitairePublic,objetconfectionne.PrixEleveUnitaire,objetconfectionne.CoutMachinePU,produit.RefLycee as RefProduit,produit.Designation as DesiProduit FROM ligneoc INNER JOIN objetconfectionne on ligneoc.RefOC=objetconfectionne.Ref INNER JOIN Produit on ligneoc.RefLycee=produit.RefLycee where objetconfectionne.Id = '$Ref';";
        $rs = ObjectConfectionne::$bdd->query($req);
        $result = $rs->fetchAll();
        return $result;
    }
    
    function NumOrdre()
    {
        $req="SELECT max(Id)As ordre FROM objetconfectionne";
        $rs=ObjectConfectionne::$bdd->query($req);
        return $result=$rs->fetchAll();
    }
    
    function NewOc($designation,$destination,$DateOrdre,$NombrePrevu)
    {
        $idVisiteur=$_SESSION['idVisiteur'];
        $idT= $this->NumOrdre();
        foreach ($idT as $id)
{
   $id=1+$id['ordre'];
}
        $ans=date("Y");
        $ref="OC".$id."/".$ans;
        $req="Insert INTO objetconfectionne(Ref,Id,Annee,Designation,NbPrevision,Professeur,Destination,DateEmi) values('$ref','$id','$ans','$designation','$NombrePrevu','$idVisiteur','$destination','$DateOrdre')";
        ObjectConfectionne::$bdd->query($req);
        
    }
       function SommeUnOc($Ref)
    {
        $req="SELECT sum(ligneoc.quantite*ligneoc.PuTTC)As prix FROM ligneoc inner join objetconfectionne on ligneoc.RefOc=objetconfectionne.Ref WHERE objetconfectionne.Id= '$Ref' group by RefOc";
        $rs=ObjectConfectionne::$bdd->query($req);
        return $result=$rs->fetchAll();
    }
    
    function majOc($designation,$destination,$NombrePrevu,$DateOrdre,$ref)
    {
        $req="UPDATE objetconfectionne set Designation='$designation', Destination='$destination',NbPrevision='$NombrePrevu',DateEmi='$DateOrdre' where ref='$ref'";
        $rs=ObjectConfectionne::$bdd->query($req);
    }
    
    function ClotureOc($temp,$ObjetRealise,$DateFabriquation,$totalmatiere,$nbprevu,$ref)
    {
     $param=new Parametre();
     $LesCoef=$param->affiche_CoefCorrection();
     $LesCout=$param->affiche_CoutMachine();
     foreach ($LesCoef as $unCoef)
    {
     $Coef= $unCoef['Details'];
    }     
    foreach ($LesCout as $unCout)
    {
    $Cout=$unCout['Details'];}
    $totalfrais=$totalmatiere*$Coef/100;
    $totalCoutEleve=$totalmatiere;
    $coutmachine=$temp*$Cout;
    $totalCoutPublic=$totalCoutEleve+$coutmachine;
    $prixUnitairePublic=$totalCoutPublic/$nbprevu;
    $prixUnitaireEleve=$totalCoutEleve/$nbprevu;
    $req="UPDATE objetconfectionne set CoefCorrection='$Coef'  ,NbRealise='$ObjetRealise',Quantite='$ObjetRealise'  , Temps='$temp' ,TotalMatiere='$totalmatiere' ,TotalFrais='$totalfrais'  ,TotalCoutEleve='$totalCoutEleve'  ,CoutMachine='$coutmachine'  ,TotalCoutPublic='$totalCoutPublic' ,DateFabri='$DateFabriquation'  ,PrixUnitairePublic='$prixUnitairePublic'  ,PrixEleveUnitaire='$prixUnitaireEleve'  ,CoutMachinePU='$Cout' where ref='$ref'";
    ObjectConfectionne::$bdd->query($req);
    }
}
 ?>
