<?php
	
	include("config.php");
	
	$result = $bdd->query("SELECT * FROM roles INNER JOIN utilisateur ON utilisateur.email = roles.email WHERE roles.email='".$_COOKIE["c_email"]."' AND mdp='".$_COOKIE["c_password"]."';");
	$row = $result->fetch();
	
	if(intval($row["est_prof"])) {

		$titre = $_POST["titre"];
		$cout = $_POST["cout"];
		$date = $_POST["date"];
		$heure_debut = $_POST["heure_debut"];
		$heure_fin = $_POST["heure_fin"];
		$nb_places = $_POST["nb_places"];
		$id_salle = $_POST["id_salle"];
		
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
		if($date < date('Y-m-d H:i:s')) {
			echo "La date ne peut pas etre inférieur à maitenant<br>";
			$cours_valide = false;
		}
		
		//heure_fin > heure_debut
		if ($heure_fin<$heure_debut){
			echo "L'heure de fin doit etre plus grande que l'heure de début<br>";
			$cours_valide = false;
		}
		
		// VÉRIFICATION DE LA DISPONIBILITÉ DE LA SALLE
		$dispo = $bdd->query("SELECT date FROM cours WHERE ((heure_debut<'$heure_fin' AND heure_debut>='$heure_debut') OR (heure_fin<='$heure_fin' AND heure_fin>'$heure_debut')) AND (id_salle=$id_salle) AND date = $date ;");
		if ($dispo->rowCount() >= 1){
			echo "cet horaire est déjà prise<br>";
			$cours_valide = false;
		}

		//duree d'au moins 10 min
		if(strtotime($heure_fin)-strtotime($heure_debut) <= 10) {
			echo "Le cours doit durer au minimum 10 minutes<br>";
			$cours_valide = false;
		}
		
		if($nb_places < 1) {
			echo "Le cours doit comporter au minimum une place<br>";
			$cours_valide = false;
		}
		
		
		if($cours_valide) {
			$bdd->query("INSERT INTO cours (titre, cout_credits, email_prof, id_salle, nb_places, date, heure_debut, heure_fin) VALUES ('".$titre."', ".$cout.", '".$_COOKIE["c_email"]."', $id_salle, $nb_places, '$date', '$heure_debut', '$heure_fin');");
			header("Location: index.php");
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