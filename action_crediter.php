<?php

	include("config.php");
	
	$result = $bdd->query("SELECT credits FROM utilisateur WHERE email='".$_POST["email"]."';");
	$row = $result->fetch();
	
	$credits = $row["credits"] + $_POST["credits"];
	
	$result = $bdd->query("SELECT * FROM roles INNER JOIN utilisateur ON utilisateur.email = roles.email WHERE roles.email='".$_COOKIE["c_email"]."' AND mdp='".$_COOKIE["c_password"]."';");
	$row = $result->fetch();
	
	if(intval($row["est_admin"])){
		$bdd->query("UPDATE utilisateur SET credits=". $credits." WHERE email='".$_POST["email"]."';");
		echo "Ajout de " . $_POST["credits"] . " sur le compte " . $_POST["email"] . ".";
		echo '<br><a href="index.php">accueil</a>';
	}
?>