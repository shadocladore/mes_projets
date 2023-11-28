<?php
session_start();
include('includes/connect.php');
if(isset($_POST['submit']))
{	
	$result = mysqli_query($db, "INSERT INTO conge VALUES ('', '".$_POST['id_employe']."', 
	'".$_POST['motif']."', '".$_POST['date_debut']."', '".$_POST['date_fin']."', '".$_POST['date_reprise_service']."')") 
	or die ("Echec de l'ajout de l'employé");
	$reponse = "<p class='erreur'>L'employé ".$_POST['nom']." ".$_POST['prenom']." a été ajouté avec succès dans la liste des employés en congé.</p>";
	header("location: conges.php?reponse=".$reponse."");
}                   
?>


