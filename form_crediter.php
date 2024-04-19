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

	<h2>Promouvoir/Rétrograder un membre</h2>
	<form method="POST" name="credit" action="action_crediter.php">
		<input type="text" name="email" placeholder="email"><br>
		<input type="number" name="credits"> Crédits à ajouter <br>
		<input type="submit">
	</form>

	<script src="index.js"></script>
  </body>
</html>
