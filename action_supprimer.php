<?php
include("config.php");
foreach($bdd->query("SELECT * FROM inscription WHERE id_cours={$_POST["id_cours"]};") as $row){
	$bdd->query("UPDATE utilisateur SET credits = (SELECT credits FROM utilisateur WHERE email='".$row["email"]."')+(SELECT cout_credits FROM cours WHERE id=".$_POST["id_cours"].") WHERE email='".$row["email"]."';");
	$bdd->query("DELETE FROM inscription WHERE id_cours=".$_POST["id_cours"]." AND email='".$row["email"]."';");
}
$bdd->query("DELETE FROM cours WHERE id=".$_POST["id_cours"].";");
header("Location: form_gerer.php");
?>