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

	<h2>Créer un cours</h2>
	<form method="POST" name="crea_cours" action="action_cours.php">
		<input type="text" name="titre" placeholder="intitulé du cours"><br>
		<input type="number" name="cout" placeholder="coût (crédits)"><br>
		<input
			type="datetime-local"
			name="date_debut"
		required /><br>
		<input type="number" name="duree" placeholder="durée du cours (minutes)"><br>
		<input type="number" name="nb_places" placeholder="nombre de places"><br>
		
		
		<input type="submit">
		
		</script>
	</form>

	<script src="index.js"></script>
  </body>
</html>
