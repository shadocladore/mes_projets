<?php
session_start();
include('includes/connect.php');
?>
<?php
if(isset($_POST['date_naissance']) AND isset($_POST['passion']))
{	
	$req = "SELECT * FROM admin WHERE date_naissance = '".$_POST['date_naissance']."'
	and passion = '".$_POST['passion']."'";
	$verif = mysqli_query($db, $req) or die("Echec de la vérification");
	$data = mysqli_fetch_array($verif);
	if($_POST['date_naissance'] == $data['date_naissance'] and 
	$_POST['passion'] == $data['passion']) 
	{
			$_SESSION['id'] = $data['id'];
			$_SESSION['nom'] = $data['nom'];
			$_SESSION['password'] = $data['password'];
			$_SESSION['photo'] = $data['photo'];
			header("location: accueil-app-gestion-school.php");
	} 
	else 
	{
		echo "<script>alert('Les informations entrées sont fausses');</script>";
		header("location: connexion.php");
	}
}
?>