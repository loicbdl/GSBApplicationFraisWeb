<?php
include('../header.php');
include('../parametre.php');
include('../pdo.php');


if($_SESSION['role'] != 1 or !$_SESSION['id_user'])
{
    header('Location: ../index.php');
    exit();
}

$id_user = $_SESSION['id_user'];


$requete=$connexion1->prepare("SELECT * FROM utilisateur WHERE id = '".$id_user."'");
$requete->execute();
$ligne= $requete->fetch();

$nom_user = $ligne['nom'];
$prenom_user = $ligne['prenom'];


$sql = $connexion1->query("SELECT * FROM fiche_frais WHERE utilisateur_id = '".$id_user."' ORDER BY `annee` DESC ,`mois` DESC LIMIT 1");


$donnees = $sql->fetch();

$leMois = date("m");
$currentM = date("n");
$currentY = date("Y");
$moisFiche = $donnees['mois'];
$anneeFiche = $donnees['annee'];
$idFiche = $donnees['id'];


  if($currentM != $moisFiche or $currentY != $anneeFiche){

    $new1 = $connexion1->query("INSERT INTO fiche_frais VALUES (NULL,'".$currentM."','".$currentY."',3,'".$id_user."')");

  }

// AJOUT FRAIS

  if (isset($_POST['nbrepas'])) {


    $qte = $_POST['nbrepas'];

    if ($qte != 0 ) 
    {

      $new2 = $connexion1->query("INSERT INTO detail_frais_forfait VALUES (NULL, '3', '".$qte."','".$idFiche."',3)");
      header('Location: index.php');
      
    }
      
  }

  if (isset($_POST['nuitee'])) {

    $qte_nuitee = $_POST['nuitee'] ;
    
    if ($qte_nuitee != 0 ) 
    {

      $new3 = $connexion1->query("INSERT INTO detail_frais_forfait VALUES (NULL, '1', '".$qte_nuitee."','".$idFiche."',3 )");
      header('Location: index.php');

    }

  }

  if (isset($_POST['transport'])) {

    $qte_transport = $_POST['transport'] ;

    if ($qte_transport != 0 ) 
    {

      $new4 = $connexion1->query("INSERT INTO detail_frais_forfait VALUES (NULL, '2', '".$qte_transport."','".$idFiche."',3 )");
      header('Location: index.php');
      
    }
      
      
  }

  if(isset($_POST['libelle']) && isset($_POST['montant'])) {
    $lib = $_POST['libelle'];
    $montant = $_POST['montant'];

    $new5 = $connexion1->query("INSERT INTO detail_frais_non_forfait  VALUES (NULL, '".$lib."','".$montant."', '".$idFiche."',3)");
    header('Location: index.php');
  }


?>

  <body>


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
        
                <div id="block1" class="col col-sm-6 col-md-5 col-lg-5 mt-5 mx-auto p-3 h-75  rounded" style="border : 1px solid grey; background: #dfe4ea;">
                    <h1>Mes activités</h1> 
                    <a href="lesfiches.php"><span class="text-muted">Consulter les mois précedents</span></a>
                    <p><span class="float-right text-muted">En cours : <?php echo "$leMois"; ?> / <?php echo "$currentY"; ?> </span></p>
                    <h1>Frais forfait</h1> 
                    <table class="table table-striped">
                            <thead>
                              <tr>
                                <th scope="col">Type</th>
                                <th scope="col">Quantité</th>
                                <th scope="col">Montant</th>
                                <th scope="col">Etat</th>
                                
                              </tr>
                            </thead>
                            <tbody>
                              <?php


                                $reponse = $connexion1->query("SELECT detail_frais_forfait.*, frais_forfait.libelle,montant FROM detail_frais_forfait INNER JOIN frais_forfait ON frais_forfait.id = detail_frais_forfait.id_frais WHERE fiche_frais_id = '".$idFiche."' ");

                                while ($test = $reponse->fetch()){

                                  $rqt = $connexion1->query("SELECT libelle FROM etat WHERE id='".$test['etat_id']."' ");
                                  $eta = $rqt->fetch();
                               ?>
                               <tr>
                                  <td><?php echo $test['libelle'];?></td>
                                  <td><?php echo $test['quantite'];?></td>     
                                  <td><?php echo $test['montant'] * $test['quantite'];?></td>
                                  <td><?php echo $eta['libelle'];?></td>


                                </tr>
                                <?php }

                                ?>


                            </tbody>
                          </table>

                                    <h1>Frais hors forfait</h1>
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th scope="col">Libellé</th>                               
                                <th scope="col">Montant</th>
                                <th scope="col">Etat</th>


                                
                              </tr>
                            </thead>
                            <tbody>
                              <?php


                                $reponse2 = $connexion1->query("SELECT detail_frais_non_forfait.*, etat.libelle AS libelle2 FROM detail_frais_non_forfait  INNER JOIN etat ON etat.id = detail_frais_non_forfait.etat_id WHERE fiche_frais_id = '".$idFiche."'"); 
                                while ($detail_ = $reponse2->fetch()){
                               ?>
                               <tr>

                                  <td><?php echo $detail_['libelle'];?></td>     
                                  <td><?php echo $detail_['montant'];?> € </td>
                                  <td><?php echo $detail_['libelle2']?></td>

                                </tr>
                                <?php                             

                              }

                                ?>


                            </tbody>
                          </table>

                      
                </div>
                <div id="block2" class="col col-sm-6 col-md-5 col-lg-5 mt-5 mx-auto p-3 h-75  rounded" style="border : 1px solid grey; background: #dfe4ea;">
                    <h1>Enregistrer des frais</h1><br>
                    <div class="d-flex flex-row">
                        <div class="col col-6 d-flex justify-content-center">
                           <h3>Frais forfaitisé</h3><br>
                           <button type="button" class="btn btn-primary mx-auto" data-toggle="modal" data-target="#exampleModal">Saisir</button>
                        </div>
                        <div class="col col-6 d-flex justify-content-center">
                           <h3>Frais hors forfait</h3><br>
                           <button type="button" class="btn btn-primary mx-auto" data-toggle="modal" data-target="#exampleModal2">Saisir</button>
                        </div>
                    </div>   
                </div>

<style>
.novue{
    display: none;
}

.vue{
    display: block;
}  
</style>

  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajout de votre frais</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="" method="post">
      <select name="fixe" class="custom-select custom-select-sm" id ="liste" onchange="fix()" >
        <option selected>Selectionner votre frais</option>
        <option value="1">Hotel</option>
        <option value="2">Restauration</option>
        <option value="3">Transport</option>
      </select>
      <div id ="hotel" class="novue">
        <input type="number" class="form-control"  placeholder="Nombre de nuit" name ="nuitee">
        <button type = "submit" class="btn btn-primary" name = "Fraisfix">Enregistrer</button>
      </div>
      <div id ="Restauration" class="novue" >
        <input type="number" class="form-control" aria-describedby="usernameHelp" placeholder="Nombre de repas" name ="nbrepas">
        <button type = "submit" class="btn btn-primary" name = "Fraisfix">Enregistrer</button>
      </div>
      <div id ="Transport" class="novue">
        <input type="number" class="form-control" aria-describedby="usernameHelp" placeholder="Nombre de km " name ="transport">
        <button type = "submit" class="btn btn-primary" name = "Fraisfix">Enregistrer</button>
      </div>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Enregistrer fiche de frais hors forfait</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action ="" method="post">
  <div class="form-group">
    <label for="exampleInputLibelle">Libelle</label>
    <input type="text" class="form-control" id="exampleInputtext1" aria-describedby="emailHelp" placeholder="Libelle" name ="libelle">
  </div>
  <div class="form-group">
    <label for="exampleInputQuantite">Montant</label>
    <input type="number" class="form-control" id="exampleInputtext2" aria-describedby="emailHelp" placeholder="Montant" name = "montant">
  </div>
  <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>

            </div>
            
        </div>




<script>
function fix(){
		
		if(document.getElementById('liste').value === '3'){
			document.getElementById('Transport').className = 'vue';
			document.getElementById('hotel').className = 'novue';
			document.getElementById('Restauration').className = 'novue';
		}
		if(document.getElementById('liste').value === '1'){
			document.getElementById('Transport').className = 'novue';
			document.getElementById('hotel').className = 'vue';
			document.getElementById('Restauration').className = 'novue';
			document.getElementById('Diesel').className = 'novue';
			document.getElementById('Escence').className = 'novue';
		}
		if(document.getElementById('liste').value === '2'){
			document.getElementById('Transport').className = 'novue';
			document.getElementById('Restauration').className = 'vue';
			document.getElementById('hotel').className = 'novue';
			document.getElementById('Diesel').className = 'novue';
			document.getElementById('Escence').className = 'novue';
		}
	}

  function carbu(){
		
		if(document.getElementById('liste2').value === '2'){
			document.getElementById('Diesel').className = 'vue';
			document.getElementById('Escence').className = 'novue';
		}
    if(document.getElementById('liste2').value === '1'){
			document.getElementById('Escence').className = 'vue';
			document.getElementById('Diesel').className = 'novue';
		}

		
	}

</script>



<?php 




include('../footer.php');



?>