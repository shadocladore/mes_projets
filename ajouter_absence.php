<?php
session_start();
include('includes/connect.php');
if(isset($_POST['submit']))
{	
	$result = mysqli_query($db, "INSERT INTO absence VALUES ('', '".$_POST['id_employe']."', 
	'".$_POST['motif']."', '".$_POST['date_debut']."', '".$_POST['date_fin']."', '".$_POST['nbre_jour_absence']."', 
	'".$_POST['date_reprise_service']."')") or die ("Echec de l'ajout de l'employé");
	$reponse = "<p class='erreur'>L'employé ".$_POST['nom']." ".$_POST['prenom']." a été ajouté avec succès dans la liste d'absence.</p>";
	header("location: absences.php?reponse=".$reponse."");
}                   
?>


