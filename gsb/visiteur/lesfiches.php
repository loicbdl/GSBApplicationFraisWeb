<?php 

include('../header.php');
include('../parametre.php');
include('../pdo.php');


if($_SESSION['role'] != 1 or !$_SESSION['id_user'])
{
    header('Location: ../login.php');
    exit();
}


$id_user = $_SESSION['id_user'];

$Requete = mysqli_query($connexion,"SELECT * FROM Utilisateur WHERE id = '".$id_user."'");
$ligne = mysqli_fetch_assoc($Requete);

$nom_user = $ligne['nom'];
$prenom_user = $ligne['prenom'];






 ?>

 <body>


 <style>
.novue{
    display: none;
}

.vue{
    display: block;
}  
</style>


<a href=javascript:history.go(-1)>Retour</a>

         <div class="pos-f-t">
                <div class="collapse" id="navbarToggleExternalContent">
                  <div class="bg-dark p-4">
                    <h5 class="text-white h4">Espace Visiteur</h5>
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

            <div class="container-fluid">
            <div class="row align-items-center">


            <div id="block1" class="col col-sm-6 col-md-5 col-lg-5 mt-5 mx-auto p-3 h-75  rounded" style="border : 1px solid grey; background: #dfe4ea; ">

              <h1>Toutes mes fiches</h1>            
 			<table class="table table-striped">
                            <thead>
                              <tr>
                                <th scope="col">Mois</th>
                                <th scope="col">Année</th>
                                <th scope="col">Etat</th>
                                
                              </tr>
                            </thead>
                            <tbody>
                              <?php

                                $reponse = $connexion1->query("SELECT fiche_frais.*, etat.libelle FROM fiche_frais  INNER JOIN etat ON etat.id = fiche_frais.etat_id WHERE utilisateur_id = '".$id_user."' ORDER BY `annee` DESC ,`mois` DESC"); 
                                while ($test = $reponse->fetch()){
                               ?>
                               <tr>

                                  <td><?php echo $test['mois'];?></td>     
                                  <td><?php echo $test['annee'];?></td>

                                  <td><?php echo $test['libelle'];?></td>

                                  <td> <?php echo"<a class='btn btn-danger' href='details.php?id=".$test['id']."'> Détails de la fiche </a>"; ?> </td>


                                </tr>
                                <?php }

                                ?>

                            </tbody>
                          </table>

                          </div>




 			
 			 </div>
 			</div>



<?php 
include('../footer.php');

 ?>