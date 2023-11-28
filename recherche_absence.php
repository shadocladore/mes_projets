<?php 
include("entete.php");
?>
			<div id="repere">
				<span class="nom-page">Recherche Absence</span>
				<span class="lien"><a href="accueil-app-gestion-school.php">Accueil</a> > <a href="absences.php">Absences</a> > <i>Rechercher Absence</i></span> 
			</div>
			<div id="corps">
				<form action="recherche_absence.php" method="post" id="search">
					<p>
						<input type="search" value="<?php echo @$_POST['recherche']; ?>" name="recherche" required size="40" placeholder="Rechercher un employé par son nom ou son grade"/>
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
	$luka="SELECT * from absence, employe where absence.id_employe = employe.id_employe and upper(nom)
	or lower(nom) like '%$recherche%' or upper(grade) or lower(grade) like '%$recherche%' order by nom";
	$eyano=mysqli_query($db, $luka) or die(mysql_error());
	$compter=mysqli_num_rows($eyano);
	if ($compter<=0){  
		echo "<p class='erreur'>Oups, désolé le nom ou le grade entré ne correspond à aucun employé
		de l'entreprise ! Veuillez réessayer avec un autre s'il vous plait...</p>"; 
	}                      
	else 

	{
?>		
			<?php echo "<p style='margin-top:-20px;' class='erreur'>Recherche sur le mot clé : [ ".$_POST['recherche']." ]</p>";?><br/>
			<table border="1" class="liste">
				<tr>
				<th>Photo</th><th>Nom et Prénom</th><th>Motif de <br/>l'absence</th><th>Date début <br/>d'absence</th>
				<th>Date fin<br/> d'absence</th><th>Date Reprise <br/>Service</th><th>Opérations</th>
				</tr>
					<?php
		$requete = "SELECT * from absence, employe where absence.id_employe = employe.id_employe and upper(nom)
		or lower(nom) like '%$recherche%' or upper(grade) or lower(grade) like '%$recherche%' order by id_absence DESC";

		$reponse = mysqli_query($db, $requete) or die("Echec de l'enregistrement");
		while($data = mysqli_fetch_array($reponse)) {
			$id = $data['id_absence'];
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
				<td><img src='images/eleves/".$nom_photo."' width='50' height='50'/></td><td>".$designation." ".$data['nom']." ".$data['prenom']."</td><td>".$data['motif']."</td>
				<td>".$data['date_debut']."</td><td>".$data['date_fin']."</td><td>".$data['date_reprise_service']."</td>";
	?>
			<td width="100">
				<a href="editer_absence.php?id_absence=<?php echo $id; ?>"><img class="icone" width="25" height="25" src="images/editer.png" title="Modifier les informations de l'employé."></a>
				<a id="supp_enseignant" href="supprimer.php?id_absence=<?php echo $id; ?>"><img class="icone" width="25" height="25" src="images/supprimer.png" title="supprimer l'employé."></a>
				<a href="impression/demande_autorisation_absence.php?id_absence=<?php echo $id; ?>"><img class="icone" width="23" height="23" src="images/impression.png" title="Imprimer une demande d'autorisation pour cet employé."></a>
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