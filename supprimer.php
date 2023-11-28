<?php 
session_start();
include("includes/connect.php");
?>
<meta charset="utf-8"/>
<?php
	$id = "";
	if($id = $_GET['id_employe'])
	{
		$id_employe = $_GET['id_employe'];
		$reponse = mysqli_query($db, "DELETE FROM employe WHERE id_employe = '".$id_employe."'")
		or die ("Echec de la supression de cet enseignant");
		$reponse = "<p class='erreur'>L'employé a été supprimé de la base de données avec succès.</p>";
		header("location: employes.php?reponse=".$reponse."");
	}
	elseif($id = $_GET['id_pointage']) 
	{
		$id_pointage = $_GET['id_pointage'];
		$reponse = mysqli_query($db, "DELETE FROM pointage WHERE id_pointage = '".$id_pointage."'")
		or die("Echec de la suppression du présent");
		$reponse = "<p class='erreur'>L'employé présent a été supprimé de la liste de pointage journalier.</p>";
		header("location: pointages.php?reponse=".$reponse."");
	}	
	elseif($id = $_GET['id_absence'])
	{
		$id_absence = $_GET['id_absence'];
		$reponse = mysqli_query($db, "DELETE FROM absence WHERE id_absence = '".$id_absence."'")
		or die ("Echec de la supression de cet absent");
		$reponse = "<p class='erreur'>L'employé absent a été supprimé de la liste d'absence avec succès .</p>";
		header("location: absences.php?reponse=".$reponse."");
	}
	elseif($id = $_GET['id_conge'])
	{
		$id_conge = $_GET['id_conge'];
		$reponse = mysqli_query($db, "DELETE FROM conge WHERE id_conge = '".$id_conge."'")
		or die ("Echec de la supression de cette classe");
		$reponse = "<p class='erreur'>L'employé a été supprimé de la liste du personel ayant pris congés avec succès .</p>";
		header("location: conges.php?reponse=".$reponse."");
	}
	elseif($id = $_GET['id_affectation'])
	{
		$id_affectation = $_GET['id_affectation'];
		$reponse = mysqli_query($db, "DELETE FROM affectation WHERE id_affectation = '".$id_affectation."'")
		or die ("Echec de la supression de cette classe");
		$reponse = "<p class='erreur'>L'employé a été supprimé de la liste du staff ayant été affectés avec succès.</p>";
		header("location: affectations.php?reponse=".$reponse."");
	}
?>