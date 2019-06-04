<?php
include('../header.php');

if($_SESSION['role'] != 3 or !$_SESSION['id_user'])
{
    header('Location: ../index.php');
    exit();
}

$id_user = $_SESSION['id_user'];

$Requete = mysqli_query($connexion,"SELECT * FROM utilisateur WHERE id = '".$id_user."'");
$ligne = mysqli_fetch_assoc($Requete);

$nom_user = $ligne['nom'];
$prenom_user = $ligne['prenom'];


?>

<body>
        <div class="pos-f-t">
                <div class="collapse" id="navbarToggleExternalContent">
                  <div class="bg-dark p-4">
                    <h5 class="text-white h4">Espace Admin</h5>
                    <a href=""><span class="text-muted"><?php echo $nom_user . " ". $prenom_user; ?> </span></a>
                    <a href="../deconnexion.php"><span class="text-muted">Déconnexion</span></a>
                  </div>
                </div>
                <nav class="navbar navbar-dark bg-dark">
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                </nav>
        </div>

        <?php
        $requete = "SELECT utilisateur.*, role.libelle FROM utilisateur
                    INNER JOIN role ON role.id = utilisateur.id_role";
           $resultat = mysqli_query($connexion,$requete);
/*            $ligne = mysqli_fetch_assoc($resultat);
            echo '<pre>',print_r($ligne),'</pre>';
            die();
  */
        ?>
        <div class="container-fluid">
            <div class="row align-items-center">
                <div id="block1" class="col col-sm-12 col-md-12 col-lg-12 mt-12 mx-auto p-3 h-75  rounded" style="border : 1px solid grey; background: #dfe4ea;">
                    <h1>Liste utilisateurs</h1>
                    <a href="ajouterUser.php"><span class="btn btn-success">Ajouter un Utilisateur</span></a>
                    <table class="table table-striped">
                            <thead>
                              <tr>
                                <th scope="col">Login</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Prénom</th>
                                <th scope="col">Role</th>
                                <th scope="col">Ville</th>
                                <th scope="col">Actions</th>        
                              </tr>
                            </thead>
                            <tbody>
                           <?php // si mysqli_num_rows() retourne 0 c'est qu'il a trouvé aucun résultat
                                if(mysqli_num_rows($resultat) == 0) {
                                  ?>
                                  <tr>
                                    <td colspan="6" class='text-center'>Aucun utilisateur</td>
                                  </tr>
                                <?php
                                } else {
                                while($ligne = mysqli_fetch_assoc($resultat)){
                                ?>
                                <tr>
                                  <td><?php echo $ligne['login'];?></td>
                                  <td><?php echo $ligne['nom'];?></td>
                                  <td><?php echo $ligne['prenom'];?></td>
                                  <td><?php echo $ligne['libelle'];?></td>
                                  <td><?php echo $ligne['ville'];?></td>
                                  <td>
                                    <?php 
                                      echo "<a class='btn btn-danger' onClick= 'return confirmation();' href='supprimerUser.php?id=".$ligne['id']."'> Supprimer</a>";
                                      echo "<a class='btn btn-warning' href='modifierUser1.php?id=".$ligne['id']."'> Modifier</a>";
                                    ?>
                                  </td>
                                  <tr>
                       
                                <?php
                                }

                                }
                                
                                ?>
                             
                            </tbody>
                          </table>
                  </div>

              </div>
            
        </div>

  <script>
    
  function confirmation()
  {
    var x = confirm("Appuyer sur 'OK' pour valider");
    if (x==true)
    {
      return true;
    }else
    {
      return false;
    }
  }
</script>

<?php 
include('../footer.php');
?>
