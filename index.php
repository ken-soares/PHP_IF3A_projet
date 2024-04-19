<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Accueil</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
	<h1>Club de Dance</h1>
	
	<a href="join.php">rejoindre un cours</a>

	<?php
		include("config.php");
		
		$connecte = false;
		// check cookie identifiant sinon afficher lien pour se co
		if(isset($_COOKIE["c_email"]) && isset($_COOKIE["c_password"])) {
			$connecte = true;
			$result = $bdd->query("SELECT credits FROM utilisateur WHERE email='".$_COOKIE["c_email"]."' AND mdp = '".$_COOKIE["c_password"]."';");
			$row = $result->fetch();
		echo " | Connecté en tant que " . $_COOKIE["c_email"] . " | credits: " .$row["credits"]. " | ";
			echo '<a href="action_deconnexion.php">se deconnecter</a>';
		} else {
			echo ' | <a href="form_connexion.php">se connecter</a>';
		}
		
		
		if($connecte && intval($_COOKIE["c_est_admin"]) == 1) {
			
			echo "<h3>Options d'Administrateur</h3>";
			echo "<ul>";		
			echo '<li><a href="form_permissions.php">Promouvoir/rétrograder un membre</a></li>';
			echo '<li><a href="form_crediter.php">créditer un compte</a></li>';
			echo "</ul>";
		}
		
		if($connecte && intval($_COOKIE["c_est_prof"]) == 1) {
			echo "<h3> Options de Professeur </h3>";
			echo "<ul>";		
			echo '<li><a href="">Créer un cours</a></li>';
			echo '<li><a href="">Gérer mes cours</a></li>';
			echo "</ul>";

		}
		
		?>
	
	
	<script src="index.js"></script>
  </body>
</html>