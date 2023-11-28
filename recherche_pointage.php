<?php 
session_start();
@$id = $_SESSION['id'];
if(isset($id)) {
?>
<?php include("entete.php"); ?>
			<div id="repere">
				<span class="nom-page">Recherche Employé</span>
				<span class="lien"><a href="accueil-app-gestion-school.php">Accueil</a> > <a href="pointages.php">Liste pointage</a> > <i>Rechercher Employé Présent</i></span> 
			</div>
			<div id="corps">
				<form action="recherche_pointage.php" method="post" id="search" title="Format de la date : Année-Mois-Jour">
					<p>
						<input type="search" value="<?php echo @$_POST['recherche']; ?>" name="recherche" required size="40" placeholder="Rechercher par date. Ex: 24/10/2023"  pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])[/](0[1-9]|1[012])[/][0-9]{4}"/>
						<input type="image" src="images/search.png" title="Cliquer sur le bouton pour effectuer la recherche"/>
					</p>  
				</form>
<?php
$recherche = htmlentities(@$_POST['recherche']);
$recherche = stripslashes(htmlspecialchars($recherche));
if (strlen($recherche)<2)
{
	echo "<p class='erreur'> Vous devez saisir au moins 2 caracteres !</p>";
} 
else   
{
	$luka="select * from pointage where date_pointage = '".$recherche."' order by id_pointage";
	$eyano=mysqli_query($db, $luka) or die("Echec de la vérification");
	$compter=mysqli_num_rows($eyano);
	if ($compter<=0){
		echo "<p class='erreur'>Oups, désolé la date entrée ne correspond à aucune date ! Veuillez réessayer avec une autre s'il vous plait...</p>"; 
	}
	else 
	{
?>	
			<div class="bloc_tab">
			<?php echo "<p style='margin-top:-20px;' class='erreur'>Liste journalière de pointage du ".$_POST['recherche']."</p>";?><br/>
				<table border="1" class="liste">
				<tr>
					<th>Photo</th><th>Nom et Prénom<br/>de l'employé</th><th>Heure d'arrivée</th><th>Heure de départ</th><th>Date</th><th>Opérations</th>
				</tr>
		<?php
		$requete = "SELECT * FROM pointage, employe where pointage.id_employe = employe.id_employe 
		and date_pointage = '$recherche' order by id_pointage";
		$reponse = mysqli_query($db, $requete) or die("Refusé !!!!!!!!!!!");
		while($data = mysqli_fetch_array($reponse)) {
			$id = $data['id_pointage'];
			if($data['photo'] == "") {    
				$nom_photo = "utilisateur.png";
			} else {
				$nom_photo = $data['photo'];
			}	
			if($data['sexe']=="M") {
				$designation = "M.";
			} else {
				$designation = "Mme";
			}
			echo "<tr>
				<td><img src='images/eleves/".$nom_photo."' width='50' height='50'/></td><td>".$designation." ".$data['nom']." ".$data['prenom']."</td>
				<td>".$data['heure_arrivee']."</td><td>".$data['heure_depart']."</td><td>".$data['date_pointage']."</td>";
	?>
			<td width="100">
				<a href="editer_pointage.php?id_pointage=<?php echo $id; ?>"><img class="icone" width="25" height="25" src="images/editer.png" title="Modifier les informations de l'employé."></a>
				<a id="supp_enseignant" href="supprimer.php?id_pointage=<?php echo $id; ?>"><img class="icone" width="25" height="25" src="images/supprimer.png" title="supprimer l'employé."></a>
			</td>
		</tr>
		<script type="text/javascript">
			// Dès que le document est soumis...
			var supp_eleve = document.getElementById('supp_eleve');
			supp_eleve.onclick = function() {
			// On affiche une fenêtre de confirmation
				var resultat = confirm("êtes-vous certain de vouloir effectuer cette suppression ?");
				// On retourne la réponse de l'utilisateur
				return resultat;
			}
		</script>
	<?php			 
		}
	
	}
}
	?>
		</table><br/><br/>
		</div>
	</body>
	</div>
		</div>
			<?php 
			include("page_aide.php");
		?>
</html> 		
<?php
}
else {
	include('connexion.php');
}
?>