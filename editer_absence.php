<?php 
session_start();
@$id = $_SESSION['id'];
if(isset($id)) {

include("entete.php");
$id_absence = $_GET['id_absence'];
?>
<?php
if(isset($_POST['submit']))
{
	$requete = "UPDATE absence SET motif='".$_POST['motif']."', date_debut='".$_POST['date_debut']."',  
	date_fin='".$_POST['date_fin']."', date_reprise_service='".$_POST['date_reprise_service']."' WHERE id_absence='".$id_absence."'";
	$reponse = mysqli_query($db, $requete) or die("Accès Refusé !!!!!!!!!!!");
	echo "<script> alert('Les informations d\'absences de l\'employé ont été mises à jour'); </script>";
}
?>
			<div id="repere">
				<span class="nom-page">Edition Absence Employé</span>
				<span class="lien"><a href="accueil-app-gestion-school.php">Accueil</a> > <a href="absences.php">Liste Absences</a> > <i>Editer Absence</i></span> 
			</div>
			<div id="corps">
			<?php
				$requete = "SELECT * FROM absence, employe where absence.id_employe = employe.id_employe 
				and id_absence = '".$id_absence."'";
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
				<p class="erreur">Mise à jour d'abscence de l'employé <?php echo $designation.' '.$eleve['nom']." ".$eleve['prenom']; ?></p>
				<div id="page-edition">
					<form action="" method="post" enctype="multipart/form-data" id="form-edition">
						<p><span>Motif</span><input type="text" value="<?php echo $eleve['motif']; ?>" name="motif" /></p>
						<p><span>Date début </span><input type="text" name="date_debut" value="<?php echo $eleve['date_debut']; ?>"   maxlength="10" placeholder="05/04/2023" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])[-](0[1-9]|1[012])[-][0-9]{4}" /></p>
						<p><span>Date fin </span><input type="text" name="date_fin" value="<?php echo $eleve['date_fin']; ?>"   maxlength="10" placeholder="05/04/2023" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])[-](0[1-9]|1[012])[-][0-9]{4}"/></p>
						<p><span>Date reprise fonction </span><input type="text" name="date_reprise_service" value="<?php echo $eleve['date_reprise_service']; ?>" maxlength="10" placeholder="15/10/2023" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])[-](0[1-9]|1[012])[-][0-9]{4}" /></p>
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