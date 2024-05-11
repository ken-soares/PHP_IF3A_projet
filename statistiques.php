<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Accueil</title>
    <link rel="stylesheet" href="style.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  </head>
  <body>
  <h1>Club de Dance</h1>
  <h2>Statistiques</h2>
  <ul>
	<?php
		include("config.php");
		echo "<li> Nombre d'adhérents du club : ".$bdd->query("SELECT email FROM utilisateur;")->rowCount();
		echo "<li> heures réservées sur l'année par adhérent
		<table>
		<tr>
			<th>nombre d'heures réservées </th> 
			<th>Nom</th>
			<th>Prénom</th>
		</tr>";
		foreach($bdd->query("SELECT * FROM utilisateur;") as $row) {
			echo "<tr>";
			$temps = $bdd->query("SELECT SUM(TIME_TO_SEC(TIMEDIFF(cours.heure_fin, cours.heure_debut))) as temps FROM utilisateur INNER JOIN inscription ON utilisateur.email=inscription.email INNER JOIN cours ON cours.id = inscription.id_cours WHERE utilisateur.email='{$row['email']}' AND EXTRACT(YEAR FROM date) = EXTRACT(YEAR FROM NOW());");
			$req = $temps->fetch(PDO::FETCH_ASSOC);
			if ($req['temps'] == ''){echo "<td>0</td>";}else{echo "<td>".(intval($req['temps'])/3600)."</td>";}
			echo "<td>{$row['nom']}</td>";
			echo "<td>{$row['prenom']}</td>";
			echo "</tr>";
		}
	?>
	</li>
	</table>
  </body>
</html> 