<?php
include('header.php');
?>
<body>
<!-- Image and text -->
<div class="pos-f-t">
                <div class="collapse" id="navbarToggleExternalContent">
                  <div class="bg-dark p-4">
                    <h5 class="text-white h4">Connexion</h5>
                    <!--<a href="../deconnexion.php"><span class="text-muted">Déconnexion</span></a>-->
                  </div>
                </div>
                <nav class="navbar navbar-dark bg-dark">
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                </nav>
            </div>
<div class="container-fluid col-md-6" id="formulaire">
<form action = "co.php" method = "post">
  <div class="form-group">
    <label for="exampleInputUsername1">Pseudo</label>
    <input type="text" class="form-control" id="exampleInputUsername1" aria-describedby="usernameHelp" placeholder="Username" name="pseudo">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Mot de passe</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="mdp" >
  </div>
  <button type="submit" class="btn btn-secondary" name ="connexion" value = "connexion">Connexion</button>
</form>
</div>
<?php 
include('footer.php');
?>
