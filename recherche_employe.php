<?php 
include("entete.php");
?>
			<div id="repere">
				<span class="nom-page">Recherche Employé</span>
				<span class="lien"><a href="accueil-app-gestion-school.php">Accueil</a> > <a href="employes.php">Employés</a> > <i>Rechercher Employé</i></span> 
			</div>
			<div id="corps">
				<form action="recherche_employe.php" method="post" id="search">
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
	$luka="select * from employe where upper(nom) or lower(nom) like '%$recherche%' 
	or upper(grade) or lower(grade) like '%$recherche%' order by nom";
	$eyano=mysqli_query($db, $luka) or die(mysql_error());
	$compter=mysqli_num_rows($eyano);
	if ($compter<=0){
		echo "<p class='erreur'>Oups, désolé le nom ou le grade entré ne correspond à aucun employé
		de l'entreprise ! Veuillez réessayer avec un autre s'il vous plait...</p>"; 
	}
	else 
	{
?>	
			<div class="bloc_tab">
				<?php echo "<p style='margin-top:-20px;' class='erreur'>Recherche sur le mot clé : [ ".$_POST['recherche']." ]</p>";?><br/>
				<table border="1" class="liste">
					<tr>
						<th>Photo</th><th>Nom et Prénom</th><th>Date de<br/>Naissance</th>
						<th>Téléphone</th><th>Adresse</th><th>Diplôme</th><th>Grade</th><th>Echélon</th>
						<th>Date Prise<br/>Fonction</th><th>Fonctions</th><th>Services</th><th>Indice</th><th>Opérations</th>
					</tr>
					<?php
		$requete = "SELECT * FROM employe WHERE upper(nom) or lower(nom) like '%$recherche%' 
		or upper(grade) or lower(grade) like '%$recherche%' ORDER BY nom";

		$reponse = mysqli_query($db, $requete) or die("Echec de l'enregistrement");
		while($data = mysqli_fetch_array($reponse)) {
			$id = $data['id_employe'];
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
			<td><img src='images/eleves/".$nom_photo."' width='50' height='50'/></td><td id='nom'><b>".$designation."</b> ".$data['nom']." ".$data['prenom']."</td>
			<td>".$data['date_naissance']."</td><td>".$data['telephone']."</td><td>".$data['adresse'].
			"</td><td>".$data['diplome']."</td><td>".$data['grade']."</td><td>".$data['echelon']."</td>
			<td>".$data['date_prise_fonction']."</td><td>".$data['fonction']."</td><td>".$data['service']."</td><td>".$data['indice']."</td>";
	?>
			<td width="100">
				<a id="editer"href="editer_employe.php?id_employe=<?php echo $id; ?>" ><img class="icone" src="images/editer.png" width="25" height="25" title="Modifier les informations de l'employé."></a>
				<a id="supp_eleve" href="supprimer.php?id_employe=<?php echo $id; ?>"><img class="icone" width="25" height="25" src="images/supprimer.png" title="supprimer l'employé."></a>
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