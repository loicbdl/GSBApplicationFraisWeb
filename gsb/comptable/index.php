<?php
include('../header.php');
include('../parametre.php');
include('../pdo.php');

if($_SESSION['role'] != 2 or !$_SESSION['id_user'])
{
    header('Location: ../login.php');
    exit();
}







?>

<body>
        <div class="pos-f-t">
                <div class="collapse" id="navbarToggleExternalContent">
                  <div class="bg-dark p-4">
                    <h5 class="text-white h4">Espace Comptable</h5>
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

        <div class="container">
          <div class="col">
            <div class="col-md-10">
              <p></p>
            </div>
          </div>
        </div>


                <div class="container-fluid">
            <div class="row align-items-center">
                <div id="block1" class="col col-sm-12 col-md-12 col-lg-12 mt-12 mx-auto p-3 h-75  rounded" style="border : 1px solid grey; background: #dfe4ea;">
                    <h1>Fiches à valider</h1>
                    <table class="table table-striped">
                            <thead>
                              <tr>

                                <th scope="col">Mois</th> 
                                <th scope="col">Année</th>
                                <th scope="col">Status</th>     

                              </tr>
                            </thead>
                            <tbody>
                           <?php
                           $reponse1 = $connexion1->query("SELECT * FROM fiche_frais WHERE etat_id = '1' ORDER BY `annee` DESC ,`mois` DESC "); 

                                while ($fiche = $reponse1->fetch()){
                                ?>
                                <tr>
                                  <td><?php echo $fiche['mois'];?></td>
                                  <td><?php echo $fiche['annee'];?></td>
                                  <td>En attente</td>


                                  <tr>
                       
                                <?php
                                }

                                
                                
                                ?>
                             
                            </tbody>
                          </table>
                  </div>

              </div>
            
        </div>

<?php 
include('../footer.php');
?>
