<?php
session_start();
include('includes/connect.php');
if(isset($_POST['submit']))
{	
	$result = mysqli_query($db, "INSERT INTO affectation VALUES ('', '".$_POST['id_employe']."', 
	'".$_POST['motif']."', '".$_POST['date_affectation']."', '".$_POST['lieu_affectation']."')") 
	or die ("Echec de l'ajout de l'employé");
	$reponse = "<p class='erreur'>L'employé ".$_POST['nom']." ".$_POST['prenom']." a été ajouté avec succès dans la liste d'affectation.</p>";
	header("location: affectations.php?reponse=".$reponse."");
}                   
?>


