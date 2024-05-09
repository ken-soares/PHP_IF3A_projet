<?php
	include("config.php");
	
	$req = $bdd->query("SELECT COUNT(*) FROM utilisateur WHERE email = '".$_POST["email"]."' AND mdp = '".$_POST["password"]."';");
	if($req == 1) {
		setcookie("c_email", $_POST["email"], 0);
		setcookie("c_password", $_POST["password"],0);
		
		echo "Connexion en tant que " . $_POST["email"] . " réussie";
		header("Location: index.php");
	} else{
		echo "email ou mot de passe incorrect<br>";
		echo "<a href='form_inscription.php'> retour à l'inscription </a>";
	}
?>