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
	body {
	
	display:flex;
	flex-direction: column;
	align-items: center;
	justify-content:center;
	font-family: 'Verdana', sans-serif;
	}

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
	<span>
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
			echo '<a href="form_connexion.php">se connecter</a>';
		}
		?>
		</span>
	
		<img src="logo.svg" width="5%" height="5%"/>

		<?php
		if ($connecte){
			echo "<h2> Liste des cours ouverts (2 semaines) </h2>
		<table>
		<tr>
			<th>Intitulé</th>
			<th>professeur</th>
			<th>date</th> 
			<th>horaires</th>
			<th>coût (en crédits)</th>
			<th>salle</th>
			<th>inscris</th>
			<th>inscription</th>
		</tr>";
		}
	
		// fonction pour convertir les durées de cours en minutes
		function minutes($time){
			$time = explode(':', $time);
			return ($time[0]*60) + ($time[1]) + ($time[2]/60);
		}
		
		// affichage de la liste des cours
		if($connecte) {
			foreach($bdd->query("SELECT * FROM cours WHERE date>=NOW() AND date<=DATE_ADD(NOW(),INTERVAL 14 DAY) ORDER BY date,heure_debut;") as $row) {
				echo "<tr>";
				echo "<td> ".$row["titre"]." </td>";
				
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
				
				
				if ($_COOKIE["c_email"]==$row["email_prof"]){
					echo "<td>Pas d'inscription à son propre cours</td>";
				}
				else if ($est_inscrit->rowCount() > 0){
					echo "<td>
						<form method='POST' name='cours' action='action_quitter.php'>
							<input type='hidden' name='id_cours' placeholder='id_cours' value='{$row['id']}'>
							<input type='submit' name = 'submit' value=\"Se désinscire\">
						</form>
					</td>";
				}
				else if ($bdd->query("SELECT email FROM utilisateur WHERE email = '{$_COOKIE["c_email"]}' AND credits<{$row["cout_credits"]};")->rowCount()){
					echo "<td>Pas assez de credits</td>";
				}
				else if (($est_inscrit->rowCount() == 0) and ($bdd->query("SELECT email FROM utilisateur WHERE email = '{$_COOKIE["c_email"]}' AND credits>={$row["cout_credits"]};")->rowCount()) and $nb_places_prises->rowCount()<$row["nb_places"]){
					echo "<td>
						<form method='POST' name='cours' action='action_rejoindre.php'>
							<input type='hidden' name='id_cours' placeholder='id_cours' value='{$row['id']}'>
							<input type='submit' name = 'submit' value=\"S'inscrire\">
						</form>
					</td>";
				} 
				else {
					echo "<td>cours pleins</td>";
				}
				echo "</tr>";
			}
			echo "</table>";
		}
			// vérification des rôles pour les options admin et prof
			if($connecte) {
				$result = $bdd->query("SELECT * FROM roles INNER JOIN utilisateur ON utilisateur.email = roles.email WHERE roles.email='".$_COOKIE["c_email"]."' AND mdp='".$_COOKIE["c_password"]."';");
				$row = $result->fetch();			
			}
			
			
			if($connecte && intval($row["est_admin"]) == 1) {
				echo "<div class=\"admin\">";
				echo "<h3>Options d'Administrateur</h3>";
				echo "<ul>";		
				echo '<li><a href="form_permissions.php">Promouvoir/rétrograder un membre</a></li>';
				echo '<li><a href="form_crediter.php">créditer un compte</a></li>';
				echo '<li><a href="statistiques.php">Statistiques</a></li>';
				echo "</ul>";
				echo "</div>";
			}
			
			if($connecte && intval($row["est_prof"]) == 1) {
				echo "<div class=\"prof\">";
				echo "<h3> Options de Professeur </h3>";
				echo "<ul>";		
				echo '<li><a href="form_cours.php">Créer un cours</a></li>';
				echo '<li><a href="form_gerer.php">Gérer mes cours</a></li>';
				echo "</ul>";
				echo "</div>";

			}
		
		?>
	<p id="paragraph"> Le club de danse PDA est une association crée en 20XX et dont la vocation est de donner des cours de danse à des passionnées de tout âge.
		Notre site réalisé dans le cadre de l'UV d'IF3A est notre outil principal en terme d'automatisation de création de cours et d'inscription à un cours.
		Le système de monnaie virtuelle permet aux professeurs de mettre en place leurs propres tarifs par cours.
	</p>
	<button id="show-hide">description du club</button>
  </body>
  
  	<script src="script.js">
	</script>
</html>