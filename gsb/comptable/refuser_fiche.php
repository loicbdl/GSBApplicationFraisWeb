<?php 	
session_start();

include("../pdo.php");

if($_SESSION['role'] != 2 or !$_SESSION['id_user'])
{
    header('Location: ../index.php');
    exit();
}

	$id=$_GET['id'];


	$requete=$connexion1->prepare("UPDATE `fiche_frais` SET `etat_id`='2' WHERE id = '".$id."' ");
	
	$requete->bindParam(':id', $id);
			
	$requete->execute();

	header('Location: index.php');
?>