<?php 
session_start();
@$id = $_SESSION['id'];
if(isset($id)) {
?>
<?php include("entete.php"); ?>
			<div id="repere">
				<span class="nom-page">Statistiques</span>
				<span class="lien"><a href="#">Accueil</a> > Statistiques</span> 
			</div>
			<div id="corps">
			<?php
	require "includes/connect.php";
	$reponse = mysqli_query($db, "SELECT COUNT(id_employe) AS numrows FROM employe")
	or die("Echec");
	$data = mysqli_fetch_array($reponse);
	$total_employes = $data['numrows'];
	
	$reponse = mysqli_query($db, "SELECT COUNT(id_conge) AS numrows FROM conge")
	or die("Echec");
	$data = mysqli_fetch_array($reponse);
	$total_conges = $data['numrows'];
	
	$reponse = mysqli_query($db, "SELECT COUNT(id_affectation) AS numrows FROM affectation")
	or die("Echec");
	$data = mysqli_fetch_array($reponse);
	$total_affectations = $data['numrows'];
	
	$reponse = mysqli_query($db, "SELECT COUNT(id_absence) AS numrows FROM absence")
	or die("Echec");
	$data = mysqli_fetch_array($reponse);
	$total_absences = $data['numrows'];

	$reponse = mysqli_query($db, "SELECT COUNT(id_pointage) AS numrows FROM pointage")
	or die("Echec");
	$data = mysqli_fetch_array($reponse);
	$total_pointages = $data['numrows'];
	
	$reponse = mysqli_query($db, "SELECT COUNT(id_avancement) AS numrows FROM avancement")
	or die("Echec");
	$data = mysqli_fetch_array($reponse);
	$total_avancements = $data['numrows'];
	?>
		<table id="stat">
			<tr>
				<td id="cli"><a href="employes.php"><img class="ind" src="images/utilisateurs.png" width="60" height="65"/><br/> Total Employés <br/><br/><?php echo $total_employes; ?> </a></td>
				<td id="con"><a href="conges.php"><img class="ind" style="border-radius: 27px;" src="images/conges.jpeg" width="55" height="55"/><br/>Total Congés <br/><br/><?php echo $total_conges; ?></a></td>
			</tr>
			<tr>
				<td id="dep"><a href="pointages.php"><img class="ind" src="images/pointage.png" style="border-radius: 15px 13px;" width="50" height="52"/><br/> Total Pointage Journalier <br/><br/><?php echo $total_pointages; ?></a></td>
				<td id="classe"><a href="affectations.php"><img class="ind" style="border-radius: 17px;" src="images/affectations.png" width="60" height="65"/><br/> Total Affectations <br/><br/><?php echo $total_affectations; ?> </a></td>
			</tr>
			<tr>
				<td id="user"><a href="absences.php"><img class="ind" src="images/aide.png" width="65" height="65"/><br/>Total Absences <br/><br/><?php echo $total_absences; ?></a></td>
				<td id="ser"><a href="avancements.php"><img class="ind" style="border-radius: 20px;" src="images/avancements.png" width="60" height="60"/><br/>Total Avancements <br/><br/><?php echo $total_avancements; ?></a></td>
			</tr>
		</table>
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
		