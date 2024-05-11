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
	<h2>Connexion</h2>
	
	<div class="contain">
	<form method="POST" name="conn" action="action_connexion.php">
		<input type="text" name="email" placeholder="email">
		<input type="password" name="password" placeholder="mot de passe">
		<input class="submit" type="submit">
	</form>
	</div>
	
	<a href="./form_inscription.php">pas de compte? S'inscrire</a>

	<script src="index.js"></script>
  </body>
</html>