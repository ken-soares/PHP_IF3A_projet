<?php

	include("config.php");
	
	  echo "Pour l'utilisateur " . $_POST["email"] . ": ";
	
	if(intval($_COOKIE["c_est_admin"])) {
		// ajout/retrait perms admin
		if(isset($_POST["perm"][0])){
			echo "admin: " . $_POST["perm"][0];
			$bdd->query("UPDATE roles SET est_admin = TRUE WHERE email = '". $_POST["email"]."'");
		}else{
			$bdd->query("UPDATE roles SET est_admin = FALSE WHERE email = '". $_POST["email"]."'");
		}
		
		// ajout/retrait perms prof
		if(isset($_POST["perm"][1])){
			echo " prof: " . $_POST["perm"][1];
			$bdd->query("UPDATE roles SET est_prof = TRUE WHERE email = '". $_POST["email"]."'");
		}else{
			$bdd->query("UPDATE roles SET est_prof = FALSE WHERE email = '". $_POST["email"]."'");
		}
	}
	
	echo "<br><strong>Ne pas oublier de deco/reco l'utilisateur pour la prise d'effet des cookies<strong>";
	echo '<br><a href="index.php">accueil</a>'
	
?>