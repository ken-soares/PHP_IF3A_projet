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
	<div class="contain">
	<form method="POST" name="crea_cours" action="action_cours.php">
		<h3>Sujet et Coût</h3>
		<input type="text" name="titre" placeholder="intitulé du cours"><br>
		<input type="number" name="cout" placeholder="coût (crédits)"><br>
		<hr>
		<h3>horaires</h3>
		<label for='date'>date du cours:</label>
		<input
			type="date"
			name="date"
		required /><br>
		<label for='heure_debut'>heure de debut du cours:</label>
		<input
			type="time"
			name="heure_debut"
		required /><br>
		<label for='heure_fin'>heure de fin du cours:</label>
		<input
			type="time"
			name="heure_fin"
		required /><br>
		<hr>
		<h3>Salle et Places</h3>
		<label for="nombre de places">nombre de places:<input type="number" name="nb_places" placeholder="nombre de places"></label><br>
		<label for="Adresse">Adresse de la salle:<select name='id_salle'>
		<?php
		include("config.php");
		foreach($bdd->query("SELECT * FROM salle") as $row){
			echo "<option value={$row["id"]}>".$row["numero"]." ".$row["rue"]." à ".$row["ville"]."</option>";
		}
		?>
		</select></label>
		<br>
		<input type="submit" value="Créer" class="submit">
	</form>
	</div>
  </body>
</html>
