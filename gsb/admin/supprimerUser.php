<?php 	
session_start();

include("../pdo.php");

if($_SESSION['role'] != 1 or !$_SESSION['id_user'])
{
    header('Location: ../login.php');
    exit();
}

	$id=$_GET['id'];
	


	$requete=$connexion1->prepare('DELETE FROM utilisateur WHERE id = :id');
	
	$requete->bindParam(':id', $id);
			
	header('Location: index.php');
			
	$requete->execute();

?>