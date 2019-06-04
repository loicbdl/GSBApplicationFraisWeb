<?php
include('../header.php');
include('../parametre.php');
include('../pdo.php');

if($_SESSION['role'] != 2 or !$_SESSION['id_user'])
{
    header('Location: ../index.php');
    exit();
}

$id_user = $_SESSION['id_user'];
$leMois = date("n");
$Requete = mysqli_query($connexion,"SELECT * FROM utilisateur WHERE id = '".$id_user."'");
$ligne = mysqli_fetch_assoc($Requete);

$nom_user = $ligne['nom'];
$prenom_user = $ligne['prenom'];






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
                                <th scope="col">Nom</th> 
                                <th scope="col">Prénom</th>
                                <th scope="col">Status</th>      

                              </tr>
                            </thead>
                            <tbody>
                           <?php
                           $reponse1 = $connexion1->query("SELECT fiche_frais.*, etat.libelle FROM fiche_frais INNER JOIN etat ON etat.id = fiche_frais.etat_id WHERE etat.id = 3 AND mois != $leMois ORDER BY `annee` DESC ,`mois` DESC "); 



                                while ($fiche = $reponse1->fetch()){

                                  $rqt = $connexion1->query("SELECT nom, prenom FROM utilisateur WHERE id='".$fiche['utilisateur_id']."' ");
                                  $uti = $rqt->fetch();
                                ?>
                                <tr>
                                  <td><?php echo $fiche['mois'];?></td>
                                  <td><?php echo $fiche['annee'];?></td>                                  
                                  <td><?php echo $uti['nom'];?></td>
                                  <td><?php echo $uti['prenom'];?></td>
                                  <td><?php echo $fiche['libelle'];?></td>
                                  <td>
                                    <?php 
                                      echo "<a class='btn btn-danger' href='detailsComptable.php?id=".$fiche['id']."'> Verifier le détail </a>";
                                    ?>
                                  </td>
                                  


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
