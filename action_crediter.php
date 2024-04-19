<?php

	include("config.php");
	
	$result = $bdd->query("SELECT credits FROM utilisateur WHERE email='".$_POST["email"]."';");
	$row = $result->fetch();
	
	$credits = $row["credits"] + $_POST["credits"];
	
	if(intval($_COOKIE["c_est_admin"])){
		$bdd->query("UPDATE utilisateur SET credits=". $credits." WHERE email='".$_POST["email"]."';");
		echo "Ajout de " . $_POST["credits"] . " sur le compte " . $_POST["email"] . ".";
		echo '<br><a href="index.php">accueil</a>';
	}
?>