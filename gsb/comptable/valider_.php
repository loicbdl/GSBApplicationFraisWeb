<?php 	
session_start();

include("../pdo.php");

if($_SESSION['role'] != 2 or !$_SESSION['id_user'])
{
    header('Location: ../index.php');
    exit();
}

	$id=$_GET['id'];


	$requete=$connexion1->prepare("UPDATE `detail_frais_non_forfait` SET `etat_id`='1' WHERE id = '".$id."' ");
	
	$requete->bindParam(':id', $id);
			
	$requete->execute();


	header("Location:".$_SERVER['HTTP_REFERER']);

	

?>