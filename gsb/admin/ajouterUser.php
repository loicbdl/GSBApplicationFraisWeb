<?php
/*if($_SESSION['role'] != 1 or !$_SESSION['id_user'])
{
    header('Location: ../login.php');
    exit();
}
$id_user = $_SESSION['id_user'];*/
include("../header.php");
?>
<form action = "ajout.php" method = "post">

  <div class="col">
    <div class="col-md-4 mx-auto">
      <label for="validationTooltip01">Nom</label>
      <input type="text" class="form-control" id="validationTooltip01" placeholder="Nom"  name="nom" required>
      <div class="valid-tooltip">
        Looks good!
      </div>

    </div>
    <div class="col-md-4 mx-auto">
      <label for="validationTooltip02">Prénom</label>
      <input type="text" class="form-control" id="validationTooltip02" placeholder="Prénom" name="prenom" required>
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
        <input type="text" class="form-control" id="validationTooltipUsername" placeholder="Login" name="login" aria-describedby="validationTooltipUsernamePrepend" required>
        <div class="invalid-tooltip">
          Please choose a unique and valid username.
        </div>
      </div>
    </div>

    <div class="col-md-4 mx-auto">
      <label for="validationTooltip02">Mot de passe </label>
      <input type="password" class="form-control" id="validationTooltip02" placeholder="Mot de passe" name="mdp" required>
      <div class="valid-tooltip">
        Looks good!
      </div>
    </div>

        <div class="col-md-4 mx-auto">
      <label for="validationTooltip02">Adresse</label>
      <input type="text" class="form-control" id="validationTooltip02" placeholder="Adresse" name ="adresse" required>
      <div class="valid-tooltip">
        Looks good!
      </div>
    </div>
    

    <div class="col-md-4 mx-auto">
      <label for="validationTooltip03">Ville</label>
      <input type="text" class="form-control" id="validationTooltip03" placeholder="Ville" name="ville" required>
      <div class="invalid-tooltip">
        Please provide a valid city.
      </div>
    </div>


    <div class="col-md-4 mx-auto">
      <label for="validationTooltip04">Code Postal</label>
      <input type="text" class="form-control" id="validationTooltip04" placeholder="Code postal" name="cp" required>
      <div class="invalid-tooltip">
        Please provide a valid state.
      </div>
    </div>



    <div class="col-md-4 mx-auto">

      <label for="validationTooltip05">Role utilisateur</label>
        <select name="role" class="custom-select custom-select-sm">
      <option selected>Selectionner son role</option>
      <option value="1">Visiteur</option>
      <option value="2">Comptable</option>
      <option value="3">Admin</option>
    </select>

    </div>
  </div>

  <br>


     
  <div class="col text-center">
    <button class="btn btn-primary center-block" name="valider" type="submit">Ajouter utilisateur</button>
  </div>

</form>