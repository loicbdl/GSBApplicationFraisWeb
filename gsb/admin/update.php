<?php 

include ('../parametre.php');
include("../pdo.php");

session_start();


if($_SESSION['role'] != 1 or !$_SESSION['id_user'])
{
    header('Location: ../login.php');
    exit();
}


$nom_user = $_POST['nom'];
$prenom_user = $_POST['prenom'];
$login = $_POST['login'];
$mdp = $_POST['mdp'];
$adresse = $_POST['adresse'];
$cp = $_POST['cp'];
$ville = $_POST['ville'];
$id_role = $_POST['id_role'];

	


	$requete=$connexion->prepare ("UPDATE utilisateur SET nom = '".$nom_user."', prenom = '".$prenom_user."', login = '".$login."', mdp = '".$mdp."', adresse = '".$adresse."', cp = '".$cp."', ville = '".$ville."', id_role = '".$id_role."' WHERE id = '".$id_user."' ");
	
			
	header('Location: index.php');
			
	$requete->execute();

?>


 ?>