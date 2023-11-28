<?php 
session_start();
include("includes/connect.php");
?>
<meta charset="utf-8"/>
<?php
	$id_avancement= $_GET['id_avancement'];
	$reponse = mysqli_query($db, "DELETE FROM  avancement WHERE id_avancement = '".$id_avancement."'")
	or die ("Echec de la supression de cette classe");
	$reponse = "<p class='erreur'>L'avancement de l'employé a été supprimé avec succès.</p>";
	header("location: avancements.php?reponse=".$reponse."");
	
?>