<?php 
session_start();
@$id = $_SESSION['id'];
if(isset($id)) {

include("entete.php"); 
$id_affectation = $_GET['id_affectation'];
?>
<?php
if(isset($_POST['submit']))
{
	$requete = "UPDATE affectation SET motif='".$_POST['motif']."', date_affectation='".$_POST['date_affectation']."',  
	lieu_affectation='".$_POST['lieu_affectation']."' WHERE id_affectation='".$id_affectation."'";
	$reponse = mysqli_query($db, $requete) or die("Accès Refusé !!!!!!!!!!!");
	echo "<script> alert('Les informations d\'affectation de l\'employé ont été mises à jour avec succès'); </script>";
}
?>
			<div id="repere">
				<span class="nom-page">Edition Affectation Employé</span>
				<span class="lien"><a href="accueil-app-gestion-school.php">Accueil</a> > <a href="pointages.php">Liste Affectations</a> > <i>Editer Affectation</i></span> 
			</div>
			<div id="corps">
			<?php
				$requete = "SELECT * FROM affectation, employe where affectation.id_employe = employe.id_employe and 
				id_affectation = '".$id_affectation."'";
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
				<p class="erreur">Mise à jour d'affectation l'employé <?php echo $designation.' '.$eleve['nom']." ".$eleve['prenom']; ?></p>
				<div id="page-edition">
					<form action="" method="post" enctype="multipart/form-data" id="form-edition">
						<p><span>Motif</span><input type="text" value="<?php echo $eleve['motif']; ?>" name="motif" required/></p>
						<p><span>Date d'affectation </span><input type="text" value="<?php echo $eleve['date_affectation']; ?>"  name="date_affectation" placeholder="25/04/2023" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])[/](0[1-9]|1[012])[/][0-9]{4}" required/></p>
						<p><span>Lieu d'affectation </span><input type="text" value="<?php echo $eleve['lieu_affectation']; ?>"  name="lieu_affectation" required/></p>
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