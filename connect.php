<?php

$server = "localhost";
$user = "root";
$password = "";
$database = "artf";

$db = mysqli_connect($server, $user, $password, $database);

if(!$db) {
	echo "Connexion impossible à la base de données";
	exit;
}	

?>
