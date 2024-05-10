<?php
	include("config.php");
	$email = $_POST["email"];
	$mdp = $_POST["password"];
	$req = $bdd->query("SELECT * FROM utilisateur WHERE email = '$email' AND mdp = '$mdp';");
	if($req->rowCount() == 1) {
		setcookie("c_email", $email, 0);
		setcookie("c_password", $mdp,0);
		
		echo "Connexion en tant que $email réussie";
		header("Location: index.php");
	} else{
		echo "email ou mot de passe incorrect<br>";
		echo "<a href='form_connexion.php'> retour à la connexion </a>";
	}
?>