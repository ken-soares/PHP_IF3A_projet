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
  
  
	<!--- style local a la page, modifier dès que possible --->
	<style>
	table, th, td {
		border: 1px solid;
		border-collapse:collapse;
	}

	
	th, td {
		padding:5px;
		text-align:center;
	}
	</style>
	
	
	<h1>Club de Dance</h1>
	
	<?php
		include("config.php");
		
		
		$connecte = false;
		// check cookie identifiant sinon afficher lien pour se co
		if(isset($_COOKIE["c_email"]) && isset($_COOKIE["c_password"])) {
			$connecte = true;
			$result = $bdd->query("SELECT credits FROM utilisateur WHERE email='".$_COOKIE["c_email"]."' AND mdp = '".$_COOKIE["c_password"]."';");
			$row = $result->fetch();
			echo "<span>";
			echo "Connecté en tant que " . $_COOKIE["c_email"] . " | credits: " .$row["credits"]. " | ";
			echo '<a href="action_deconnexion.php">se deconnecter</a>';
		} else {
			echo ' | <a href="form_connexion.php">se connecter</a>';
		}
		echo "</span>";
		if ($connecte){
			echo "<h2> Liste de mes cours </h2>
		<table>
		<tr>
			<th>Intitulé</th>
			<th>date</th>
			<th>horaires</th>
			<th>coût (en crédits)</th>
			<th>salle</th>
			<th>inscris</th>
			<th>inscription</th>
		</tr>";
		}
		
		// affichage de la liste des cours
		if($connecte) {
			foreach($bdd->query("SELECT * FROM cours WHERE email_prof='{$_COOKIE["c_email"]}' ORDER BY date,heure_debut;") as $row) {
				echo "<tr>";
				echo "<td> ".$row["titre"]." </td>";
				
				// affichage de la date du cours (sans horaire)
				echo "<td> ". $row["date"] ." </td>";
				
				// affichage des horaires du cours (utilise la fonction minutes définie plus haut)
				echo "<td>" . $row["heure_debut"] . " - " . $row["heure_fin"] . "</td>";
				
				echo "<td>" . $row["cout_credits"] . "</td>";
				
				$salle = $bdd->query("SELECT * FROM salle WHERE id={$row["id_salle"]};");
				$r_salle = $salle->fetch(PDO::FETCH_ASSOC);
				echo "<td>".$r_salle["numero"]." ".$r_salle["rue"]." à ".$r_salle["ville"]."</td>";
				
				$nb_places_prises = $bdd->query("SELECT email FROM inscription WHERE id_cours={$row['id']};");
				echo "<td>" . $nb_places_prises->rowCount() . "/" . $row["nb_places"] . "</td>";
				
				$est_inscrit = $bdd->query("SELECT email FROM inscription WHERE id_cours={$row["id"]} AND email='{$_COOKIE['c_email']}';");
				
				echo "<td>
							<form method='POST' name='cours' action='action_supprimer.php'>
								<input type='hidden' name='id_cours' placeholder='id_cours' value='{$row['id']}'>
								<input type='submit' name = 'submit' value=\"Suprimer\">
							</form>
						</td>";
				echo "</tr>";
			}
			echo "</table>";
		}
		
		?>
	
	<script src="index.js"></script>
  </body>
</html>