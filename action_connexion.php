<?php
	include("config.php");
	
	$req = $bdd->prepare("SELECT * FROM utilisateur WHERE email = ? AND mdp = ?");
	if($req->execute([$_POST["email"], $_POST["password"]])) {
		setcookie("c_email", $_POST["email"], 0);
		setcookie("c_password", $_POST["password"],0);
		
		$result = $bdd->query("SELECT * FROM roles WHERE email='".$_POST["email"]."';");
		$row = $result->fetch();
		

		setcookie("c_est_prof", "" . $row["est_prof"], 0);
		setcookie("c_est_admin", "" . $row["est_admin"], 0);
		
		
		echo "Connexion en tant que " . $_POST["email"] . " réussie";
		header("Location: index.php");
	}
?>