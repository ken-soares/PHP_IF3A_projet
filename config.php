<?php

	$host       = "localhost";
	$database   = "mysql";
	$dbname     = "pdaddict";
	$port       = 3306;
	$username   = "root";
	$password   = "";
		$bdd = new PDO($database . ":host=" . $host . ";dbname=" . $dbname . ";port=" . $port, $username, $password);
	try {
	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
	
	unset($host);
	unset($database);
	unset($port);
	unset($username);
	unset($password);
	
?>