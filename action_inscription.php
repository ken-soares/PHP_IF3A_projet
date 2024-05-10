<?php

	include("config.php");
		
	if($_POST["password"] == $_POST["password_verif"]) {
		$presence_email = $bdd->query("SELECT email FROM utilisateur WHERE email ='".$_POST["email"]."';");
		if($presence_email->rowCount() == 0){
		$req = $bdd->prepare("INSERT INTO utilisateur (nom,prenom,email,mdp,credits) VALUES (?,?,?,?,0);");
		$req->execute([$_POST["nom"],$_POST["prenom"], $_POST["email"], $_POST["password"]]);
		
		$bdd->query("INSERT INTO roles (email, est_prof, est_admin) VALUES ('".$_POST["email"]."', FALSE, FALSE)");			

		
		echo 'Inscription réussie! <a href="form_connexion.php">retour à la connexion</a>';
		}else {
			echo "un compte existe déjà avec cet email<br>";
			echo "<a href='form_inscription.php'>retour à l'inscription</a>";}
	} else {
		echo "Les mots de passes ne sont pas identiques.";
		echo "<a href='form_inscription.php'>retour à l'inscription</a>";
	}
	
?>