<?php
	setcookie("c_email", "", time() - 3600);
	setcookie("c_password", "", time() - 3600);
	header("Location: index.php");
?>