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
		
		// check cookie identifiant sinon afficher lien pour se co
		if(isset($_COOKIE["c_email"]) && isset($_COOKIE["c_password"])) {
			$result = $bdd->query("SELECT credits FROM utilisateur WHERE email='".$_COOKIE["c_email"]."' AND mdp = '".$_COOKIE["c_password"]."';");
			$row = $result->fetch();
		echo " | Connecté en tant que " . $_COOKIE["c_email"] . " | credits: " .$row["credits"]. " | ";
			echo '<a href="action_deconnexion.php">se deconnecter</a>';
		} else {
			echo ' | <a href="form_connexion.php">se connecter</a>';
		}
	?>
	
	<!--- a retirer -->
	<!-- fin a retirer -->
	<script src="index.js"></script>
  </body>
</html>