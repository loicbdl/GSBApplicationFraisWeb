<?php 


include("../header.php");
include("../parametre.php");
include("../pdo.php");

if($_SESSION['role'] != 1 or !$_SESSION['id_user'])
{
    header('Location: ../login.php');
    exit();
}



$id_user = $_SESSION['id_user'];
$id = $_GET['id'];

$Requete = mysqli_query($connexion,"SELECT * FROM Utilisateur WHERE id = '".$id_user."'");
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

                <?php 

                


				  if($moisFiche == $currentM and $currentY == $anneeFiche){

				    echo"<a class='btn btn-danger' href='ajoutfrais.php?id=".$idFiche."'> Ajouter un frais </a>";

				  }else{
				  	echo "(Fiche cloturé, ajout impossible)";
				  }



                 ?>



                    
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

                               $id=$_GET['id'];
                               $total_frais = 0 ;

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



                                </tr>
                                <?php 

                                if ($detail['etat_id'] == 1){

                                  $total_frais = $total_frais + ($detail['montant'] * $detail['quantite']);

                                }
                                

                            	}

                                ?>

                                


                            </tbody>

                          </table>
                          <p><i><b><u>Remboursement validé </u> = </b></i><?php echo $total_frais ; ?> €</p>
                          <br>

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

                               $id=$_GET['id'];
                               $total_nonfrais = 0 ;


                                $reponse2 = $connexion1->query("SELECT detail_frais_non_forfait.*, etat.libelle AS libelle2 FROM detail_frais_non_forfait  INNER JOIN etat ON etat.id = detail_frais_non_forfait.etat_id WHERE fiche_frais_id = '".$id."'"); 
                                while ($detail_ = $reponse2->fetch()){
                               ?>
                               <tr>

                                  <td><?php echo $detail_['libelle'];?></td>     
                                  <td><?php echo $detail_['montant'];?> € </td>
                                  <td><?php echo $detail_['libelle2']?></td>

                                </tr>
                                <?php

                                if ($detail_['etat_id'] == 1){

                                  $total_nonfrais = $total_nonfrais + $detail_['montant'];

                                }                                

                            	}

                                ?>


                            </tbody>
                          </table>
                          <p><i><b><u>Remboursement validé </u> = </b></i><?php echo $total_nonfrais ; ?> €</p>
                          <br><br>

                          <div style = "text-align: right;">

                          	<p><b><u>Montant total remboursé de la fiche </u> = </b> <?php echo $total_nonfrais + $total_frais ; ?> € </p>

                          </div>
                          




                </div>

</body>
</html>


 ?>

 <?php 

 include("../footer.php");
  ?>