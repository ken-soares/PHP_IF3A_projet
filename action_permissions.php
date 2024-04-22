<?php

	include("config.php");
	
	  echo "Pour l'utilisateur " . $_POST["email"] . ": ";
	
	
	$result = $bdd->query("SELECT * FROM roles INNER JOIN utilisateur ON utilisateur.email = roles.email WHERE roles.email='".$_COOKIE["c_email"]."' AND mdp='".$_COOKIE["c_password"]."';");
	$row = $result->fetch();
	
	if(intval($row["est_admin"])) {
		// ajout/retrait perms admin
		if(isset($_POST["admin"])){
			echo "admin: " . $_POST["admin"];
			$bdd->query("UPDATE roles SET est_admin = TRUE WHERE email = '". $_POST["email"]."'");
		}else{
			$bdd->query("UPDATE roles SET est_admin = FALSE WHERE email = '". $_POST["email"]."'");
		}
		
		// ajout/retrait perms prof
		if(isset($_POST["prof"])){
			echo " prof: " . $_POST["prof"];
			$bdd->query("UPDATE roles SET est_prof = TRUE WHERE email = '". $_POST["email"]."'");
		}else{
			$bdd->query("UPDATE roles SET est_prof = FALSE WHERE email = '". $_POST["email"]."'");
		}
	}
	
	echo "<br><strong>Ne pas oublier de deco/reco l'utilisateur pour la prise d'effet des cookies<strong>";
	echo '<br><a href="index.php">accueil</a>'
	
?>