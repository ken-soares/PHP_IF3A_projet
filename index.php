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
		echo "Connecté en tant que " . $_COOKIE["c_email"] . " | credits: " .$row["credits"]. " | ";
			echo '<a href="action_deconnexion.php">se deconnecter</a>';
		} else {
			echo ' | <a href="form_connexion.php">se connecter</a>';
		}
		if($connecte) {
		echo ' | <a href="join.php">mes cours</a>';
			
		}
	?>
		
		<h2> Liste des cours ouverts </h2>
		<table>
		<tr>
			<th>Intitulé</th>
			<th>professeur</th>
			<th>date</th>
			<th>horaires</th>
			<th>coût (en crédits)</th>
			<th>nombre de places</th>
		</tr>		
	<?php
	
		// fonction pour convertir les durées de cours en minutes
		function minutes($time){
			$time = explode(':', $time);
			return ($time[0]*60) + ($time[1]) + ($time[2]/60);
		}
		
		// affichage de la liste des cours
		if($connecte) {
			foreach($bdd->query("SELECT * from cours") as $row) {
				
				echo "<tr>";
				echo "<td>" . $row["titre"] . "</td>";
				
				// affichage NOM Prenom (email) du professeur
				$stmt = $bdd->prepare("SELECT nom, prenom FROM utilisateur WHERE email = ?");
				$stmt->execute([$row["email_prof"]]);
				$r_prof = $stmt->fetch(PDO::FETCH_ASSOC);
				
				if($r_prof){
					echo "<td>" . strtoupper($r_prof["nom"]) . " " . $r_prof["prenom"]. " (". $row["email_prof"] . ")" . "</td>";
				} else {
					// si jamais il y a une erreur dans la requête SQL du dessus suite à une modification
					echo "<td>" . $row["email_prof"] . "</td>";
					
				}
				
				// affichage de la date du cours (sans horaire)
				echo "<td>" . date('d/m/Y', strtotime($row["date_debut"])) . "</td>";
				
				// affichage des horaires du cours (utilise la fonction minutes définie plus haut)
				echo "<td>" . date('H:i', strtotime($row["date_debut"])) . "-" . date('H:i', strtotime('+' . minutes($row["duree"]) . ' minutes', strtotime($row["date_debut"]))) . "</td>";
				
				
				echo "<td>" . $row["cout_credits"] . "</td>";
				echo "<td>" . $row["nb_places"] . "</td>";
				echo "</tr>";
			}
		}
		
	?>	
		</table>
		
		<?php
			// vérification des rôles pour les options admin et prof
			if($connecte) {
				$result = $bdd->query("SELECT * FROM roles INNER JOIN utilisateur ON utilisateur.email = roles.email WHERE roles.email='".$_COOKIE["c_email"]."' AND mdp='".$_COOKIE["c_password"]."';");
				$row = $result->fetch();			
			}
			
			
			if($connecte && intval($row["est_admin"]) == 1) {
				
				echo "<h3>Options d'Administrateur</h3>";
				echo "<ul>";		
				echo '<li><a href="form_permissions.php">Promouvoir/rétrograder un membre</a></li>';
				echo '<li><a href="form_crediter.php">créditer un compte</a></li>';
				echo "</ul>";
			}
			
			if($connecte && intval($row["est_prof"]) == 1) {
				echo "<h3> Options de Professeur </h3>";
				echo "<ul>";		
				echo '<li><a href="">Créer un cours</a></li>';
				echo '<li><a href="">Gérer mes cours</a></li>';
				echo "</ul>";

			}
		
		?>
	
	<script src="index.js"></script>
  </body>
</html>