<?php 
session_start();
@$id = $_SESSION['id'];
if(isset($id)) {
?>
<?php include("entete.php"); ?>
<?php
$reponse = mysqli_query($db, "SELECT * FROM admin WHERE id = '".$_SESSION['id']."'")
or die ("Echec de l'affichage");
$admin = mysqli_fetch_array($reponse);
?>
<?php
$bouton_actualiser = "";
if(isset($_POST['submit']))
{
	$bouton_actualiser = '<a class="nouveau" href="modifier_profil.php">
	<img style="position: relative; top: 4.5px;" id="actualiser" src="images/actualiser.png" 
	width=20" height=20" /> Actualiser </a>';
	
	$nomavatar = "";
	if(empty($_FILES['avatar']['size'])) {
		$nomavatar = $admin['photo'];
	} else {
		$nomavatar=(!empty($_FILES['avatar']['size']))?move_avatar($_FILES['avatar']):'';
	}
	$nom = addslashes($_POST['nom']);
	$date_naissance = addslashes($_POST['date_naissance']);
	$passion = addslashes($_POST['passion']);
	$password = md5($_POST['password']);
	$requete = "UPDATE admin SET nom='" . $nom. "', password='" .$password. "', 
	photo='" . $nomavatar . "', date_naissance='" . $date_naissance. "',
	passion='" . $passion. "' WHERE id='".$_SESSION['id']."'";
	
	$reponse = mysqli_query($db, $requete) or die("Echec de l'enregistrement");
	echo "<script> alert('La modification de votre profil a été effectuée.'); </script>";
}

?>
			<div id="repere">
				<span class="nom-page">Modification Profil</span>
				<span class="lien"><a href="accueil-app-gestion-school.php">Accueil</a> > <i>Profil</i></span> 
			</div>
			<div id="corps">
<?php 
$requete = "SELECT * FROM admin WHERE id = '".$_SESSION['id']."'";
$reponse = mysqli_query($db, $requete) or die("Echec de l'enregistrement");
$profil = mysqli_fetch_array($reponse);
?>
			<?php echo $bouton_actualiser; ?>
				<div id="page-edition">
				<form action="" method="post" enctype="multipart/form-data" id="form-edition">
					<h5 class="edit-photo">
						<img src="images/eleves/<?php echo $profil['photo']; ?>" width='150' height='150'/><br/>
						<input type="file" name="avatar" title="Cliquer pour changer la photo de l'élève"/>
					</h5>
					<p><span>Nom Administrateur</span><br/><input class="champ" type="text"  maxlength="9" value="<?php echo $profil['nom']; ?>" name="nom" required /></p>
					<p><span>Mot de passe</span><br/><input type="password" value="<?php echo $profil['password']; ?>" name="password" pattern="(?=^.{8,}$)((?=.*d)|(?=.*W+))(?![.n])(?=.*[A-Z])(?=.*[a-z]).*" 
					title="Au moins 8 caractères : au moins un chiffre, une lettre majuscule et minuscule" required/></p>
					<p><span>Date de naissance</span><br/><input type="text" placeholder=" ex : 03/05/2002" value="<?php echo $profil['date_naissance']; ?>" name="date_naissance" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])[-](0[1-9]|1[012])[-][0-9]{4}" required /></p>
					<p><span>Nom Tante Préférée</span><br/><input type="text" placeholder=" ex : JACQUELINE" value="<?php echo $profil['passion']; ?>" name="passion" required /></p>
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