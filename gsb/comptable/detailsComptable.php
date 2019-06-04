<?php 


include("../header.php");
include("../parametre.php");
include("../pdo.php");

if($_SESSION['role'] != 2 or !$_SESSION['id_user'])
{
    header('Location: ../index.php');

    exit();
}



$id_user = $_SESSION['id_user'];
$id = $_GET['id'];

$Requete = mysqli_query($connexion,"SELECT * FROM utilisateur WHERE id = '".$id_user."'");
$ligne = mysqli_fetch_assoc($Requete);

$nom_user = $ligne['nom'];
$prenom_user = $ligne['prenom'];


$sql = $connexion1->query("SELECT * FROM fiche_frais WHERE id = '".$id."' ");
$donnees = $sql->fetch();

$leMois = date("m");
$currentM = date("n");
$currentY = date("Y");
$moisFiche = $donnees['mois'];
$anneeFiche = $donnees['annee'];
$idFiche = $donnees['id'];





 ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<a href=javascript:history.go(-1)>Retour</a>
	         			<div id="block1" class="col col-sm-6 col-md-5 col-lg-5 mt-5 mx-auto p-3 h-75  rounded" style="border : 1px solid grey; background: #dfe4ea;">


                <h1>Frait forfait</h1>  



                    
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

                                $reponse1 = $connexion1->query("SELECT detail_frais_forfait.*, frais_forfait.libelle,montant FROM detail_frais_forfait INNER JOIN frais_forfait ON frais_forfait.id = detail_frais_forfait.id_frais WHERE fiche_frais_id = '".$id."' ");

                                while ($detail = $reponse1->fetch()){

                                  $rqt = $connexion1->query("SELECT libelle FROM etat WHERE id='".$detail['etat_id']."' ");
                                  $eta = $rqt->fetch();
                               ?>
                               <tr>

                               
                               <tr>
                                  <td><?php echo $detail['libelle'];?></td>
                                  <td><?php echo $detail['quantite'];?></td>     
                                  <td><?php echo $detail['montant'] * $detail['quantite'];?> € </td>
                                  <td><?php echo $eta['libelle'];?></td>
                                  <td>
                                  	<?php 
                                      echo "<a class='btn btn-danger' onClick= 'return confirmation();' href='valider.php?id=".$detail['id']."'> Valider</a>";
                                      echo "<a class='btn btn-warning' onClick= 'return confirmation();' href='refuser.php?id=".$detail['id']."'> Refuser</a>";
                                    ?>
                                    	
                                    </td>



                                </tr>
                                <?php                                

                            	}

                                ?>

                                <?php 
                                $reponse2 = $connexion1->query("SELECT detail_frais_non_forfait.*, etat.libelle AS libelle2 FROM detail_frais_non_forfait  INNER JOIN etat ON etat.id = detail_frais_non_forfait.etat_id WHERE fiche_frais_id = '".$id."'");
                                while ($detail_ = $reponse2->fetch()){
                               ?>
                               <tr>

                                  <td><?php echo $detail_['libelle'];?></td> 
                                  <td><?php echo "/" ?></td>    
                                  <td><?php echo $detail_['montant'];?> € </td>
                                  <td><?php echo $detail_['libelle2']?></td>
                                  <td>
                                  	<?php 
                                      echo "<a class='btn btn-danger' onClick= 'return confirmation();' href='valider_.php?id=".$detail_['id']."'> Valider</a>";
                                      echo "<a class='btn btn-warning' onClick= 'return confirmation();' href='refuser_.php?id=".$detail_['id']."'> Refuser</a>";
                                    ?>
                                    	
                                    </td>



                                </tr>
                                <?php   

                            	}

                                ?>





                                


                            </tbody>


                          </table>
                         <?php 
                         echo "<a class='btn btn-danger' onClick= 'return confirmation();' href='valider_fiche.php?id=".$id."'> Valider la fiche</a>";
                         echo "<a class='btn btn-warning' onClick= 'return confirmation();' href='refuser_fiche.php?id=".$id."'> Refuser la fiche</a>";


                          ?>

                          <br>


                          <br><br>


                          




                </div>

</body>
</html>

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

 include("../footer.php");
  ?>