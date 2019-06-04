<?php
include('../header.php');
include("../pdo.php");
include("../parametre.php");


if($_SESSION['role'] != 3 or !$_SESSION['id_user'])
{
    header('Location: ../index.php');

    exit();
}

$id = $_GET['id'];

$Requete = $connexion1->query("SELECT utilisateur.* , role.libelle FROM utilisateur INNER JOIN role ON role.id = utilisateur.id_role WHERE utilisateur.id = '".$id."'");
$ligne = $Requete->fetch();



$nom_user = $ligne['nom'];
$prenom_user = $ligne['prenom'];
$login = $ligne['login'];
$mdp = $ligne['mdp'];
$adresse = $ligne['adresse'];
$cp = $ligne['cp'];
$ville = $ligne['ville'];
$role = $ligne['libelle'];
$id_role = $ligne['id_role'];




?>

<form  method="post"> 


  <div class="col">
    <div class="col-md-4 mx-auto">
      <label for="validationTooltip01">Nom</label>
      <input type="text" class="form-control" id="validationTooltip01" placeholder="Nom"  name="nom" value = " <?php echo $ligne['nom'] ?>" required>


    </div>
    <div class="col-md-4 mx-auto">
      <label for="validationTooltip02">Prénom</label>
      <input type="text" class="form-control" id="validationTooltip02" placeholder="Prénom" name="prenom" value =" <?php echo $ligne['prenom'] ?>" required>
      <div class="valid-tooltip">
        Looks good!
      </div>
    </div>   


    <div class="col-md-4 mx-auto">
      <label for="validationTooltipUsername">Login</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
        </div>
        <input type="text" class="form-control" id="validationTooltipUsername" placeholder="Login" name="login" value =" <?php echo $ligne['login'] ?>" aria-describedby="validationTooltipUsernamePrepend" required>
        <div class="invalid-tooltip">
          Please choose a unique and valid username.
        </div>
      </div>
    </div>

    <div class="col-md-4 mx-auto">
      <label for="validationTooltip02">Mot de passe </label>
      <input type="password" class="form-control" id="validationTooltip02" placeholder="Mot de passe" name="mdp" value = " <?php echo $ligne['mdp'] ?>"required>
      <div class="valid-tooltip">
        Looks good!
      </div>
    </div>

        <div class="col-md-4 mx-auto">
      <label for="validationTooltip02">Adresse</label>
      <input type="text" class="form-control" id="validationTooltip02" placeholder="Adresse" name ="adresse" value = " <?php echo $ligne['adresse'] ?>"required>
      <div class="valid-tooltip">
        Looks good!
      </div>
    </div>
    

    <div class="col-md-4 mx-auto">
      <label for="validationTooltip03">Ville</label>
      <input type="text" class="form-control" id="validationTooltip03" placeholder="Ville" name="ville" value = " <?php echo $ligne['ville'] ?>"required>
      <div class="invalid-tooltip">
        Please provide a valid city.
      </div>
    </div>


    <div class="col-md-4 mx-auto">
      <label for="validationTooltip04">Code Postal</label>
      <input type="text" class="form-control" id="validationTooltip04" placeholder="Code postal" name="cp" value = " <?php echo $ligne['cp'] ?>" required>
      <div class="invalid-tooltip">
        Please provide a valid state.
      </div>
    </div>



    <div class="col-md-4 mx-auto">

      <label for="validationTooltip05">Role utilisateur</label>
        <select name="role" class="custom-select custom-select-sm">
      <option selected> <?php echo $role ?> </option>
      <option value="1">Administateur</option>
      <option value="2">Comptable</option>
      <option value="3">Visiteur</option>
    </select>

    </div>
  </div>

    <div class="col text-center">
    <button class="btn btn-primary center-block" name="valider" type="submit">Update</button>
  </div>

 </form> 






<?php

if (isset($_POST['valider'])){

  $nom_user = $_POST['nom'];
  $prenom_user = $_POST['prenom'];
  $login = $_POST['login'];
  $mdp = $_POST['mdp'];
  $adresse = $_POST['adresse'];
  $cp = $_POST['cp'];
  $ville = $_POST['ville'];
  $id_role = $_POST['role'];

  $requete = $connexion1->prepare("UPDATE `utilisateur` SET `nom`='".$nom_user."',`prenom`='".$prenom_user."', `adresse`='".$adresse."', `ville`='".$ville."', `cp`='".$cp."',`login`='".$login."',`mdp`='".$mdp."', `id_role`='".$id_role."' WHERE id = '".$id."' ");

$requete->bindparam(':nom',$nom_pelo);
$requete->bindparam(':prenom',$prenom_user);
$requete->bindparam(':adresse',$adresse);
$requete->bindparam(':ville',$ville);
$requete->bindparam(':cp',$cp);
$requete->bindparam(':login',$login);
$requete->bindparam(':mdp',$mdp);
$requete->bindparam(':role',$id_role);
$requete->bindparam(':id',$id);
$requete->execute();

  header('Location: index.php');

}




include('../footer.php');
?>