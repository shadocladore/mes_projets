<?php
session_start();
include('includes/connect.php');
if(isset($_POST['submit']))
{	
	$result = mysqli_query($db, "INSERT INTO pointage VALUES ('', '".$_POST['id_employe']."', '".$_POST['date_pointage']."',
	'".$_POST['heure_arrivee']."', '".$_POST['heure_depart']."')") or die ("Echec de l'ajout de l'employé");
	
	$reponse = "<p class='erreur'>L'employé ".$_POST['nom']." ".$_POST['prenom']." a été ajouté avec succès dans la fiche de pointage.</p>";
	header("location: pointages.php?reponse=".$reponse."");
}                   
?>


