<?php 
include("../pdo.php");






if(isset($_POST['nom']) && isset($_POST['prenom'])&& isset($_POST['login'])&& isset($_POST['mdp'])&& isset($_POST['adresse'])&& isset($_POST['ville'])&& isset($_POST['cp'])&& isset($_POST['role'])){

	$nom = $_POST["nom"];
	$prenom = $_POST["prenom"];
	$login = $_POST["login"];
	$mdp = md5($_POST["mdp"]);
	$adresse = $_POST["adresse"];
	$ville = $_POST["ville"];
	$cp = $_POST["cp"];
	$role = $_POST["role"];
	$ddate = date("Y-m-d");


    $recup = $connexion1->prepare("INSERT INTO `utilisateur`(`id`, `nom`, `prenom`, `login`, `mdp`, `adresse`, `cp`, `ville`, `dateEmbauche`, `id_role`) VALUES (NULL,'".$nom."','".$prenom."','".$login."','".$mdp."','".$adresse."','".$cp."','".$ville."','".$ddate."','".$role."')");


	$recup->execute();

    }


    if($_SESSION['role'] != 1 or !$_SESSION['id_user'])
{
    header('Location: index.php');
    exit();
}




?>