<?php
include("parametre.php");
session_start(); // à mettre tout en haut du fichier .php, cette fonction propre à PHP servira à maintenir la $_SESSION
  if(isset($_POST['connexion'])) { // si le bouton "Connexion" est appuyé
      if(empty($_POST['pseudo'])) {
          echo "Le champ Pseudo est vide.";
      } else {
          if(empty($_POST['mdp'])) {
              echo "Le champ Mot de passe est vide.";
          } else {
              $Pseudo = $_POST['pseudo'];
              $MotDePasse = $_POST['mdp'];
              if(!$connexion){
                  echo "Erreur de connexion à la base de données.";
              } else {
                  // on fait maintenant la requête dans la base de données pour rechercher si ces données existe et correspondent:
                  $Requete = mysqli_query($connexion,"SELECT * FROM Utilisateur WHERE login = '".$Pseudo."' AND mdp = '". md5($MotDePasse) ."'");//si vous avez enregistré le mot de passe en md5() il vous suffira de faire la vérification en mettant mdp = '".md5($MotDePasse)."' au lieu de mdp = '".$MotDePasse."'
                  // si il y a un résultat, mysqli_num_rows() nous donnera alors 1
                  // si mysqli_num_rows() retourne 0 c'est qu'il a trouvé aucun résultat
                  if(mysqli_num_rows($Requete) == 0) {
                      echo "Le pseudo ou le mot de passe est incorrect, le compte n'a pas été trouvé.";
                  } else {
                    
                    
                    $ligne = mysqli_fetch_assoc($Requete);
                    $id_user = $ligne['id'];
                    $role = $ligne['id_role'];

                    $_SESSION['role'] = $role;
                    $_SESSION['id_user'] = $id_user;
                
                      if($role == 1)
                      {
                        header('Location: visiteur/index.php');
                        exit();
                      }
                      elseif($role == 2){
                        header('Location: comptable/index.php');
                        exit();
                    }
                      else{
                        header('Location: admin/index.php');
                        exit();
                      }
                  }
              }
          }
      }
      mysqli_close($connexion);
  }else{
    header('Location: login.php');
    exit();
  }

?>
