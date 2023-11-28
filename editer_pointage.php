<?php 
session_start();
@$id = $_SESSION['id'];
if(isset($id)) {

include("entete.php"); 
$id_pointage = $_GET['id_pointage'];
?>
<?php
if(isset($_POST['submit']))
{
	$requete = "UPDATE pointage SET heure_arrivee='".$_POST['heure_arrivee']."', 
	heure_depart='".$_POST['heure_depart']."' WHERE id_pointage='".$id_pointage."'";
	$reponse = mysqli_query($db, $requete) or die("Echec de l'enregistrement");
	echo "<script> alert('L\'horaire journalière de l\'employé a été mise à jour avec succès'); </script>";
}
?>
			<div id="repere">
				<span class="nom-page">Edition Horaire Employé</span>
				<span class="lien"><a href="accueil-app-gestion-school.php">Accueil</a> > <a href="pointages.php">Liste Pointages</a> > <i>Editer Horaire</i></span> 
			</div>
			<div id="corps">
			<?php
				$requete = "SELECT * FROM pointage, employe where pointage.id_employe = employe.id_employe and 
				id_pointage = '".$id_pointage."'";
				$reponse = mysqli_query($db, $requete) or die("Echec de l'enregistrement");
				$eleve = mysqli_fetch_array($reponse);	
			?>
			<?php
				if($eleve['sexe']=="M") {
					$designation = "M.";
				} else {
					$designation = "Mme";
				}
			?>
				<p class="erreur">Mise à jour de l'horaire journalière de l'employé <?php echo $designation.' '.$eleve['nom']." ".$eleve['prenom']; ?></p>
				<div id="page-edition">
					<form action="" method="post" enctype="multipart/form-data" id="form-edition">
						<p><span>Heure d'arrivée</span><input type="time" value="<?php echo $eleve['heure_arrivee']; ?>" name="heure_arrivee" required/></p>
						<p><span>Heure de départ </span><input type="time" value="<?php echo $eleve['heure_depart']; ?>"  name="heure_depart" required/></p>
						<h3><button type="submit" name="submit"><img src="images/valider.png" /><i>Mettre à jour</i></button></h3>
					</form>
				</div>
				</div>
		</div>
			<?php 
			include("page_aide.php");
		?>
	</body>
</html>
<?php
}
else {
	include('connexion.php');
}
?>