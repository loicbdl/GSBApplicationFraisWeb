<?php

include("../pdo.php");


if(isset($_POST['libelle']) && isset($_POST['montant'])){
	$libelleHF = $_POST['libelle'];
	$montant = $_POST['montant'];

    $recup = $connexion1->prepare('INSERT INTO `details_frais_non_forfait`( `libelle`, `montant`) VALUES ( :libelle, :montant)');
	$recup->bindparam(':libelle',$libelleHF);
	$recup->bindparam(':montant',$montant);
	$recup->execute();

    }

    if($_SESSION['role'] != 3 or !$_SESSION['id_user'])
{
    header('Location: index.php');
    exit();
}
?>