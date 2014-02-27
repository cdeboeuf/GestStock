<?php function annee(){
    $nomlogiciel=nomlogiciel();?>
<h1><?php echo $nomlogiciel." ".$_SESSION['annee']; ?></h1><?php }

function nomlogiciel()
{
    return "PardeStock";
}

function bonjour(){
    echo "Bienvenu ".$_SESSION['nom']." (".$_SESSION['nomtype'].")";
}

function logo()
{
    echo '<a href="Accueil1.php"><img src="img/logo.jpg" width="75px" height="33px"></img></a>';
}
?>