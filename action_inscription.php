<?php

	include("config.php");
		
	if($_POST["password"] == $_POST["password_verif"]) {
		$req = $bdd->prepare("INSERT INTO utilisateur (nom,prenom,email,mdp,credits) VALUES (?,?,?,?,0);");
		$req->execute([$_POST["nom"],$_POST["prenom"], $_POST["email"], $_POST["password"]]);
		echo 'Inscription réussie! <a href="form_connexion.php">retour à la connexion</a>';
	} else {
		echo "Les mots de passes ne sont pas identiques.";
		echo "<a href='form_inscription.php'>retour à l'inscription</a>";
	}
	
?>