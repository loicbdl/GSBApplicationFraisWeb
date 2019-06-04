<?php

        
    include("pdo.php");
    session_start();

    if(isset($_POST['pseudo']) && isset($_POST['mdp'])){

        $identifiant = $_POST['pseudo'];
        $mdp = $_POST['mdp'];


        $requete=$connexion1->prepare('SELECT count(*) as compteur FROM utilisateur WHERE login=:pseudo AND mdp =:mdp');

        $requete->bindParam(':pseudo', $identifiant);
        $requete->bindParam(':mdp', md5($mdp));

        $requete->execute();

        $donnees = $requete->fetch();


        if ($donnees['compteur'] < 1)
        { ?>
        <div text-center style="position: relative; top: -10px">
            <p> <?php echo 'Compte ou Mot de passe faux ou inexistant !';?> </p>
        </div>

        <?php } 

        if ($donnees['compteur'] > 0)
        { 
            $reponse=$connexion1->prepare('SELECT id_role, id FROM utilisateur WHERE login=:pseudo AND mdp=:mdp');

            $reponse->bindParam(':pseudo', $identifiant);
            $reponse->bindParam(':mdp', md5($mdp));

            $reponse->execute();

            $donnees = $reponse->fetch();

            $_SESSION['role'] = $donnees['id_role'];
            $_SESSION['id_user'] = $donnees['id'];
        

            if($donnees['id_role'] == 1){
            header('location: visiteur/index.php');
            }

            if($donnees['id_role'] == 2){
            header('location: comptable/index.php');
            }

            if($donnees['id_role'] == 3){
            header('location: admin/index.php');
            }
        } 

}
?>