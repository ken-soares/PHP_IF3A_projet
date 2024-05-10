<?php
include("config.php");
$bdd->query("DELETE FROM inscription WHERE id_cours=".$_POST["id_cours"]." AND email='".$_COOKIE["c_email"]."';");
$bdd->query("UPDATE utilisateur SET credits = (SELECT credits FROM utilisateur WHERE email='".$_COOKIE["c_email"]."')+(SELECT cout_credits FROM cours WHERE id=".$_POST["id_cours"].") WHERE email='".$_COOKIE["c_email"]."';");
header("Location: index.php");


?>