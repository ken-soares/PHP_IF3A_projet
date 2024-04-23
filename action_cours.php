<?php
	
	include("config.php");
	
	$result = $bdd->query("SELECT * FROM roles INNER JOIN utilisateur ON utilisateur.email = roles.email WHERE roles.email='".$_COOKIE["c_email"]."' AND mdp='".$_COOKIE["c_password"]."';");
	$row = $result->fetch();
	
	if(intval($row["est_prof"])) {

		$titre = $_POST["titre"];
		$cout = $_POST["cout"];
		$date_debut = $_POST["date_debut"];
		$duree = $_POST["duree"];
		$places = $_POST["nb_places"];
		
		
		$cours_valide = true;
		
		if($titre == "") {
			echo "L'intitulé du cours ne peut être vide.<br>";
			$cours_valide = false;
		}
		
		if($cout < 0) {
			echo "Le coût du cours ne peut être négatif<br>";
			$cours_valide = false;
		}
		
		// VÉRIFICATION DE LA DATE DE DÉBUT
		// VÉRIFICATION DE LA DISPONIBILITÉ DE LA SALLE
		
		if($duree <= 10) {
			echo "Le cours doit durer au minimum 10 minutes<br>";
			$cours_valide = false;
		}
		
		if($places < 1) {
			echo "Le cours doit comporter au minimum une place<br>";
			$cours_valide = false;
		}
		
		
		if($cours_valide) {
			// enregister le nouveau cours....
		} else {
			echo "<strong> informations de cours invalides </strong>";
		}
	} else {
		echo 
		'<h2 style="color:red; font-size:50px;
		    left: 0;
			line-height: 200px;
			margin-top: -100px;
			position: absolute;
			text-align: center;
			font-family: Arial;
			top: 50%;
			width: 100%;">
			Accès refusé! Page réservée aux professeurs</h2>';
	}
?>