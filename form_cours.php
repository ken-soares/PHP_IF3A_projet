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
		<label for='date'>date cours :</label>
		<input
			type="date"
			name="date"
		required /><br>
		<label for='heure_debut'>heure de debut du cours:</label>
		<input
			type="time"
			name="heure_debut"
		required /><br>
		<label for='heure_fin'>heure de fin du cours :</label>
		<input
			type="time"
			name="heure_fin"
		required /><br>
		<input type="number" name="nb_places" placeholder="nombre de places"><br>
		<select name='id_salle'>
		<?php
		include("config.php");
		foreach($bdd->query("SELECT * FROM salle") as $row){
			echo "<option value={$row["id"]}>".$row["numero"]." ".$row["rue"]." à ".$row["ville"]."</option>";
		}
		?>
		</select>
		<br>
		<input type="submit" value="Créer">
		
	</form>
  </body>
</html>
