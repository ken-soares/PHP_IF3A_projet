<?php

	include("config.php");
		
	if($_POST["password"] == $_POST["password_verif"]) {
		
		$result = $bdd->query("SELECT * FROM utilisateur WHERE email='".$_POST["email"]."';");
        $row = $result->fetch();

        if(isset($row)) {
            echo 'email déjà utilisé, veuillez en utiliser un autre <br><a href="form_inscription.php">retour aux inscription</a>';
        } else {
            $req = $bdd->prepare("INSERT INTO utilisateur (nom,prenom,email,mdp,credits) VALUES (?,?,?,?,0);");
            $req->execute([$_POST["nom"],$_POST["prenom"], $_POST["email"], $_POST["password"]]);
            $bdd->query("INSERT INTO roles (email, est_prof, est_admin) VALUES ('".$_POST["email"]."', FALSE, FALSE)");			
            echo 'Inscription réussie! <a href="form_connexion.php">retour à la connexion</a>';
        }
        
	} else {
		echo "Les mots de passes ne sont pas identiques.";
		echo "<a href='form_inscription.php'>retour à l'inscription</a>";
	}
	
?>
