<?php
include("parametre.php");
session_start(); // à mettre tout en haut du fichier .php, cette fonction propre à PHP servira à maintenir la $_SESSION
session_destroy();

mysqli_close($connexion);
header('Location: index.php');

?>
