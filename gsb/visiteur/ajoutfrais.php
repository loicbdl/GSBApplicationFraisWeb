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



$idFiche = $_GET['id'];



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

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
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
        <input type="number" class="form-control" aria-describedby="usernameHelp" placeholder="Nombre de repas midi" name ="repas_midi">
        <input type="number" class="form-control" aria-describedby="usernameHelp" placeholder="Nombre de repas soir" name ="repas_soir">
        <button type = "submit" class="btn btn-primary" name = "Fraisfix">Enregistrer</button>
      </div>
      <div id ="Transport" class="novue" >
        <select name="carburant" class="custom-select custom-select-sm" id ="liste2" onchange="carbu()" >
          <option selected>Selectionner votre carburant</option>
          <option value="1">Essence</option>
          <option value="2">Diesel</option>
        </select>
      </div>
      <div id ="Escence" class="novue">
        <input type="number" class="form-control" aria-describedby="usernameHelp" placeholder="Nombre de km " name ="transport_essence">
        <button type = "submit" class="btn btn-primary" name = "Fraisfix">Enregistrer</button>
      </div>
      <div id ="Diesel"class="novue">
        <input type="number" class="form-control" aria-describedby="usernameHelp" placeholder="Nombre de km" name ="transport_diesel">
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
        <form action ="fichesHorsForfait.php" method="post">
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




  if (isset($_POST['repas_midi'])) {

    $qte_midi = $_POST['repas_midi'] ;
    $prix_midi = $qte_midi* 15;

    $new2 = $connexion1->query("INSERT INTO details_frais_forfait VALUES (NULL ,'".$qte_midi."','".$prix_midi."',2,'".$idFiche."')");
    header('location = visiteur/details.php');
  }

  if (isset($_POST['repas_soir'])) {

    $qte_soir = $_POST['repas_soir']; 
    $prix_soir = $qte_soir*20; 


    $new3 = $connexion1->query("INSERT INTO details_frais_forfait VALUES (NULL, '".$qte_soir."','".$prix_soir."',2,'".$idFiche."' )");
    header('location = visiteur/details.php');
  
      
  }

  elseif (isset($_POST['nuitee'])) {

    $qte_nuit = $_POST['nuitee'] ;
    $prix_nuit = $qte_nuit * 20;

    $new4 = $connexion1->query("INSERT INTO details_frais_forfait VALUES (NULL, '".$qte_nuit."','".$prix_nuit."' ,1,'".$idFiche."' )");
    header('location = visiteur/details.php');
  
      
  }

  elseif (isset($_POST['transport_diesel'])) {

    $qte_diesel = $_POST['transport_diesel'] ;
    $prix_diesel = $qte_diesel *1.20;

    $new5 = $connexion1->query("INSERT INTO details_frais_forfait VALUES (NULL, '".$qte_diesel."','".$prix_diesel."',3,'".$idFiche."' )");
	header('location = visiteur/details.php');
      
      
  }

  elseif (isset($_POST['transport_essence'])) {

    $qte_essence = $_POST['transport_essence'] ;
    $prix_essence = $qte_essence * 1.40 ;

    $new6 = $connexion1->query("INSERT INTO details_frais_forfait VALUES (NULL, '".$qte_essence."','".$prix_essence."' ,4,'".$idFiche."')"); 
	header('location = visiteur/details.php');
      
  }

  if(isset($_POST['libelle']) && isset($_POST['montant'])) {
    $lib = $_POST['libelle'];
    $mont = $_POST['montant'];

    $new7 = $connexion1->query("INSERT INTO details_frais_non_forfait  VALUES ( '".$lib."','".$mont."', '".$idFiche."')");
    header('location = visiteur/details.php');

  }







include('../footer.php');

?>

