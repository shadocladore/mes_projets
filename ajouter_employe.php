<?php
session_start();
include('includes/connect.php');
include('includes/functions.php');
if(isset($_POST['submit']))
{	
	$reponse = "";
	$result = mysqli_query($db, "SELECT COUNT(*) AS numrows FROM employe  WHERE matricule = '".$_POST['matricule']."'")
	or die ("Echec du matricule");
	$rows = mysqli_fetch_array($result);
	$ligne = $rows['numrows'];
	if($ligne != 0)
	{
		$reponse = "<p class='erreur'>Echec de l'ajout car Le matricule est déja utilisé pour un autre employé. Veuillez-en entrer un autre.</p>";
		header("location: employes.php?reponse=".$reponse."");
	}
	else
	{
		if($_FILES['avatar']=="") {
			$nomavatar = "utilisateur.png";
		} else {
			$nomavatar=(!empty($_FILES['avatar']['size']))?move_avatar($_FILES['avatar']):'';
		}
		$nomavatar=(!empty($_FILES['avatar']['size']))?move_avatar($_FILES['avatar']):'';
		$result = mysqli_query($db, "INSERT INTO employe VALUES ('', '".$_POST['matricule']."', '".$_POST['nom']."', '".$_POST['prenom']."', 
		'".$_POST['sexe']."', '".$_POST['date_naissance']."', '".$_POST['telephone']."', '".$_POST['adresse']."', '".$_POST['diplome']."', 
		'".$_POST['grade']."', '".$_POST['echelon']."', '".$_POST['indice']."', '".$_POST['date_prise_fonction']."', '".$_POST['fonction']."', '".$_POST['service']."','".$nomavatar."')") 
		or die ("Echec de l'ajout de l'employé");
		$reponse = "<p class='erreur'>Félicitation ! L'employé ".$_POST['nom']." ".$_POST['prenom']." a été ajouté(e) avec succès dans la base de données.</p>";
		
		if($result==true) {
			$date_avancement = date('20y-m-d');
			$response = mysqli_query($db, "INSERT INTO avancement VALUES ('', '".$_POST['matricule']."', 
			'".$_POST['echelon']."', '".$_POST['indice']."', '".$_POST['grade']."',  '".$date_avancement."')") 
			or die ("Echec de l'ajout dans avancement");
		} 
		header("location: employes.php?reponse=".$reponse."");
	}
	exit;
}                     
?>


