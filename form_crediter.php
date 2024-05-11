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
	<div class="contain">
		<form method="POST" name="credit" action="action_crediter.php">
			<input type="text" name="email" placeholder="email"><br>
			<hr>
			<label for="crediter"><i>Crédits à ajouter</i><input type="number" name="credits"></label><br>
			<input type="submit" class="submit">
		</form>
	</div>

	<script src="index.js"></script>
  </body>
</html>
