<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Accueil</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>

	<h2>Inscription</h2>
	<form method="POST" name="inscript" action="action_inscription.php">
		<input type="text" name="nom" placeholder="nom">
		<input type="text" name="prenom" placeholder="prenom">
		<input type="text" name="email" placeholder="email">
		<input type="password" name="password" placeholder="mot de passe">
		<input type="password" name="password_verif" placeholder="vérification mot de passe">
		<input type="submit">
	</form>

	<script src="index.js"></script>
  </body>
</html>

