<?php 
session_start();
@$id = $_SESSION['id'];
if(isset($id)) {

include("entete.php"); 
$id_employe = $_GET['id_employe'];
?>
<?php
	@$id_employe = $_GET['id_employe'];
	$requete = "SELECT * FROM employe WHERE id_employe = '".$id_employe."'";
	$reponse = mysqli_query($db, $requete) or die("Echec de l'enregistrement");
	$eleve = mysqli_fetch_array($reponse);	   
	if(isset($_POST['submit']))
	{	
		if(empty($_FILES['avatar']['size'])) {
			$nomavatar = $eleve['photo'];
		} else {
			$nomavatar=(!empty($_FILES['avatar']['size']))?move_avatar($_FILES['avatar']):'';
		}
		$requete = "SELECT * FROM employe WHERE id_employe = '".$id_employe."'";
		$resultat = mysqli_query($db, $requete) or die("Echec de l'enregistrement");
		$eleve = mysqli_fetch_array($resultat);
		
		$requete = "UPDATE employe SET nom='".$_POST['nom']."', prenom='".$_POST['prenom']."', sexe='".$_POST['sexe']."',
		date_naissance='".$_POST['date_naissance']."', telephone='".$_POST['telephone']."', adresse='".$_POST['adresse']."',
		diplome='".$_POST['diplome']."', grade='".$_POST['grade']."', echelon='".$_POST['echelon']."',
		indice='".$_POST['indice']."', date_prise_fonction='".$_POST['date_prise_fonction']."', fonction='".$_POST['fonction']."', 
		service='".$_POST['service']."', photo='".$nomavatar."' WHERE id_employe = '".$id_employe."'";
		$reponse = mysqli_query($db, $requete) or die("Echec de l'enregistrement");
	 
		if($reponse==true) {
			$date_avancement = date('20y-m-d');
			$response = mysqli_query($db, "INSERT INTO avancement VALUES ('', '".$eleve['matricule']."', 
			'".$_POST['echelon']."', '".$_POST['indice']."', '".$_POST['grade']."',  '".$date_avancement."')") 
			or die ("Echec de l'ajout dans avancement");
		} 
		echo "<script> alert('Les informations de l\'employé ont été mises à jour avec succès'); </script>";
	}
?>
			<div id="repere">
				<span class="nom-page">Edition Employé</span>
				<span class="lien"><a href="accueil-app-gestion-school.php">Accueil</a> > <a href="employes.php">Employés</a> > <i>Editer Employé</i></span> 
			</div>
			<div id="corps">
			<?php
				$requete = "SELECT * FROM employe WHERE id_employe = '".$id_employe."'";
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
				<p class="erreur">Mise à jour des informations de l'employé <?php echo $designation.' '.$eleve['nom']." ".$eleve['prenom']; ?></p>
				<div id="page-edition">
					<form action="" method="post" enctype="multipart/form-data" id="form-edition">
						<h5 class="edit-photo">
							<img src="images/eleves/<?php echo $eleve['photo']; ?>" width='150' height='150'/><br/>
							<input class="champ-file"  type="file" name="avatar" title="Cliquer pour changer la photo de l'employé"/>
						</h5>
						<p><span>Nom</span><br/><input type="text" name="nom" maxlength="30" value="<?php echo $eleve['nom']; ?>" required /></p>
						<p><span>Prenom</span><br/><input type="text" name="prenom" value="<?php echo $eleve['prenom']; ?>" maxlength="30" required /></p>
						<p><span>Sexe</span><br/><input type="text" maxlength="1" name="sexe" value="<?php echo $eleve['sexe']; ?>" required /></p>
					    <p><span>Date de naissance</span><input type="text" placeholder=" ex: 04/09/2023" value="<?php echo $eleve['date_naissance']; ?>" name="date_naissance" maxlength="10"  pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])[/](0[1-9]|1[012])[/][0-9]{4}" required /></p>
						<p><span>Téléphone</span><input type="tel" maxlength="19" value="<?php echo $eleve['telephone']; ?>" name="telephone"  required /></p>
						<p><span>Adresse</span><input type="text" value="<?php echo $eleve['adresse']; ?>" name="adresse" maxlength="30" required /></p>
						<p><span>Diplôme</span><input type="text" value="<?php echo $eleve['diplome']; ?>" name="diplome" maxlength="50"  required /></p>
						<p><span>Grade</span><select name="grade">
							<option value="<?php echo $eleve['grade']; ?>"><?php echo $eleve['grade']; ?></option><option value="Personnel de service">Personnel de service</option>
							<option value="Personnel de service spécialisé">Personnel de service spécialisé</option>
							<option value="Commis">Commis</option><option value="Commis principal">Commis principal</option>
							<option value="Contrôleur">Contrôleur</option><option value="Contrôleur Principal">Contrôleur Principal</option>
							<option value="Vérificateur">Vérificateur</option><option value="Inspecteur">Inspecteur</option>
							<option value="Inspecteur Principal">Inspecteur Principal</option><option value="Hors classe">Hors classe</option>
						</select></p>
						<p><span>Echelon</span><input type="text" value="<?php echo $eleve['echelon']; ?>" name="echelon" maxlength="30" required /></p>
						<p><span>Indice</span><input type="text" name="indice" value="<?php echo $eleve['indice']; ?>" required /></p>
						<p><span>Date prise fonction</span><input type="text" value="<?php echo $eleve['date_prise_fonction']; ?>" name="date_prise_fonction" maxlength="10"  pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])[/](0[1-9]|1[012])[/][0-9]{4}" required /></p>
						<p><span>Bureau</span><input type="text" value="<?php echo $eleve['fonction']; ?>" name="fonction" maxlength="30" required /></p>
						<p><span>Service</span><input type="text" value="<?php echo $eleve['service']; ?>" name="service" maxlength="30" required /></p>
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