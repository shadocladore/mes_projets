<?php 
session_start();
@$id = $_SESSION['id'];
if(isset($id)) {
?>
<?php include("entete.php"); ?>
			<div id="repere">
				<span class="nom-page">Liste Statut Employé</span>
				<span class="lien"><a href="accueil-app-gestion-school.php">Accueil</a> > <i>Employés</i></span> 
			</div>
			<div id="corps">
				<?php echo @$_GET['reponse']; ?>
				<form action="recherche_employe.php" method="post" id="search">
					<p>
						<input type="search" value="<?php echo @$_POST['recherche']; ?>" name="recherche" required size="40" placeholder="Rechercher un employé par son nom ou son grade"/>
						<input type="image" src="images/search.png" title="Cliquer sur le bouton pour effectuer la recherche"/>
					</p>  
				</form>
				<div class="bloc_tab">
				<table border="1" class="liste">
					<tr>
						<th>Photo</th><th>Nom et Prénom</th><th>Echelon</th><th>Grade</th>
						<th>Indice</th><th>Date avancement</th><th>Opérations</th>
					</tr>
					<?php 
$rowsPerPage =10;  $pageNum = 1;
if(isset($_GET['page'])) {
	$pageNum = $_GET['page'];
} else { 
	$page=1;
}
$offset = ($pageNum - 1) * $rowsPerPage;

$query = "SELECT COUNT(id_avancement) AS numrows from avancement";
$result = mysqli_query($db, $query);
$row = mysqli_fetch_array($result);
$numrows = $row['numrows'];
// how many pages we have when using paging?
$maxPage = ceil($numrows/$rowsPerPage); 
?>
	<?php
		$requete = "SELECT * FROM avancement, employe where avancement.matricule = employe.matricule order by nom LIMIT $offset, $rowsPerPage ";
		$reponse = mysqli_query($db, $requete) or die("Echec de l'enregistrement");
		while($data = mysqli_fetch_array($reponse)) {
			$id = $data['id_avancement'];
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
			<td>".$data['echelon']."</td><td>".$data['grade']."</td><td>".$data['indice']."</td><td>".@$data['date_avancement']."</td>";
	?>
			<td width="100">
				<a id="supp_eleve" href="supprimer_avancement.php?id_avancement=<?php echo $id; ?>"><img class="icone" width="25" height="25" src="images/supprimer.png" title="supprimer l'employé."></a>
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
	?>
		</table>
		</div>
	<br/>
	<?php
 // print the link to access each page
$self = $_SERVER['PHP_SELF'];

echo '<div class="nb_page"><p>Page :</p>';
for($page = 1; $page <= $maxPage; $page++)
{
	if ($page == $pageNum)
		{
			echo '<em> '.$page.' </em>';   // no need to create a link to current page
		}
		else
		{
			echo "<i class='page'><a href=\"$self?page=$page\">".$page."</a></i>";
		}
}	
?>
			</div>		
			</div>		
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
