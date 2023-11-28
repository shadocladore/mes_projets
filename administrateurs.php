<?php 
session_start();
@$id = $_SESSION['id'];
if(isset($id)) {
?>
<?php include("entete.php"); ?>
			<div id="repere">
				<span class="nom-page">Liste Utilisateurs</span>
				<span class="lien"><a href="accueil-app-gestion-school.php">Accueil</a> > <i>Utilisateurs</i></span> 
			</div>
			<div id="corps">
				<?php echo @$_GET['reponse']; ?>
				<a class="nouveau" id="ajouter" href="#" title="Ajouter une nouvel utilisateur">
					<img class="icones" src="images/add.png" width="25" height="25" />Nouveau
				</a>
				<form action="recherche_utilisateur.php" method="post" id="search">
					<p>
						<input type="search" value="<?php echo @$_POST['recherche']; ?>" name="recherche" required size="40" placeholder="Rechercher un utilisateur par son nom..."/>
						<input type="image" src="images/search.png" title="Cliquer sur le bouton pour effectuer la recherche"/>
					</p>  
				</form>
				<div class="bloc_tab">
				<table border="1" class="liste">
					<tr>
						<th>Statut</th><th>Fonction</th><th>Mot de passe</th><th>Opérations</th>
					</tr>
					<?php 
$rowsPerPage =10;  $pageNum = 1;
if(isset($_GET['page'])) {
	$pageNum = $_GET['page'];
} else { 
	$page=1;
}
$offset = ($pageNum - 1) * $rowsPerPage;

$query = "SELECT COUNT(id_utilisateur) AS numrows from utilisateur";
$result = mysqli_query($db, $query);
$row = mysqli_fetch_array($result);
$numrows = $row['numrows'];
// how many pages we have when using paging?
$maxPage = ceil($numrows/$rowsPerPage); 
?>
	<?php
		$requete = "SELECT * FROM utilisateur order by id_utilisateur LIMIT $offset, $rowsPerPage ";
		$reponse = mysqli_query($db, $requete) or die("Echec de l'enregistrement");
		while($data = mysqli_fetch_array($reponse)) {
			$id = $data['id_utilisateur'];			
			echo "<tr>
			<td>".$data['statut_utilisateur']."</td><td>".$data['fonction']."</td><td>".$data['password']."</td>";
	?>
			<td width="100">
				<a id="editer"href="editer_utilisateur.php?id_utilisateur=<?php echo $id; ?>" ><img class="icone" src="images/editer.png" width="25" height="25" title="Modifier les informations de l'utilisateur."></a>
				<a id="supp_eleve" href="supprimer.php?id_utilisateur=<?php echo $id; ?>"><img class="icone" width="25" height="25" src="images/supprimer.png" title="supprimer l'utilisateur."></a>
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
	<!-------- Page d'inscription ------>
		<div id="page-inscription" class="page_form">
			<form action="ajouter_utilisateur.php" method="post" enctype="multipart/form-data" id="form-inscription">
				<a id="close" href="#"><img src="images/close.png" class="close" width="13" height="15" /></a><h3><em>AJout Nouvel Utilisateur</em></h3>
				<p><span>Statut Utilisateur</span>
					<select name="statut_utilisateur" required >
						<option value="">Sélectionner le statut</option> 
						<option value="enseignant">enseignant</option> 
							<option value="econome">econome</option> 
							<option value="comptable">comptable</option>
							<option value="cenceur">cenceur</option>
							<option value="surveillant general">surveillant general</option>
							<option value="eleve">eleve</option>
					</select>
				</p>
				<p><span>Fonction</span>
					<select name="fonction" required >
						<option value="">Sélectionner la fonction</option> 
						<option value="Inscription des élèves & réçus">Inscription des élèves et réçus</option> 
						<option value="Remplissage des notes">Remplissage des notes</option> 
						<option value="Traitement des matières, des bulletins & tableaux honneur">Traitement des matières, des bulletins et tableaux d'honneur</option>
						<option value="Traitement des salaires">Traitement des salaires</option>
						<option value="Traitement des Classes">Traitement des Classes</option>
						<option value="Consultation des annonces">Consultation des annonces</option>
					</select>
				</p>
				<p><span>Mot de passe</span><input type="text"  name="password" maxlength="30" required /></p>
				<h4><button type="submit" name="submit"><img src="images/add.png" /> <i>Ajouter</i></button></h4>
			</form>
			<script type="text/javascript" language="javascript">
							// Masquer le menu de navigation :
							var ajouter = document.getElementById('ajouter');
							var page_inscription = document.getElementById('page-inscription');
							ajouter.onclick = function() {
								if(page_inscription.style.marginTop=="0px") {
									page_inscription.style.marginTop="-15000px";
									document.getElementById('page-opacity').style.opacity="1";
								} else {
									page_inscription.style.marginTop="0px";
									document.getElementById('page-opacity').style.opacity="0.2";
								}    
							}
							document.getElementById('close').onclick = function() {
								page_inscription.style.marginTop="-15000px";
								document.getElementById('page-opacity').style.opacity="1";
							}
				</script>
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