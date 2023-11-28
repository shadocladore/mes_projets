<?php 
session_start();
@$id = $_SESSION['id'];
if(isset($id)) {
?>
<?php include("entete.php"); ?>
			<div id="repere">
				<span class="nom-page">Pointage Journalier</span>
				<span class="lien"><a href="accueil-app-gestion-school.php">Accueil</a> > <i>Employés Présents</i></span> 
			</div>
			<div id="corps">
				<?php echo @$_GET['reponse']; ?>
				<a class="nouveau" id="ajouter" href="#" title="Ajouter un employé présent">
					<img class="icones" src="images/add.png" width="25" height="25" />Nouveau
				</a><br/>
				<a href="pointages_impression.php" id="impression" class="imprimer" title="Imprimer la liste journalière d'employés présents">
					<img class="icones" src="images/imprimer.png" width="20" height="20" /> Imprimer
				</a>
				<form action="recherche_pointage.php" method="post" id="search" title="Format de la date : Année-Mois-Jour">
					<p>
						<input type="search" value="<?php echo @$_POST['recherche']; ?>" name="recherche" required size="40" placeholder="Rechercher par date. Ex: 24/10/2023"  pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])[/](0[1-9]|1[012])[/][0-9]{4}"/>
						<input type="image" src="images/search.png" title="Cliquer sur le bouton pour effectuer la recherche"/>
					</p>
				</form>
				<div class="bloc_tab">
				<table border="1" class="liste">
				<tr>
					<th>Photo</th><th>Nom et Prénom<br/>de l'employé</th><th>Heure d'arrivée</th><th>Heure de départ</th><th>Date</th><th>Opérations</th>
				</tr>
					<?php 
$rowsPerPage =10;  $pageNum = 1;
if(isset($_GET['page'])) {
	$pageNum = $_GET['page'];
} else { 
	$page=1;
}
$offset = ($pageNum - 1) * $rowsPerPage;

$query = "SELECT COUNT(id_pointage) AS numrows from pointage";
$result = mysqli_query($db, $query);
$row = mysqli_fetch_array($result);    
$numrows = $row['numrows'];
// how many pages we have when using paging?
$maxPage = ceil($numrows/$rowsPerPage); 
?>
	<?php
		$requete = "SELECT * FROM pointage, employe where pointage.id_employe = employe.id_employe order by id_pointage LIMIT $offset, $rowsPerPage ";
		$reponse = mysqli_query($db, $requete) or die("Echec de l'enregistrement");
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
			var supp_enseignant = document.getElementById('supp_enseignant');
			supp_enseignant.onclick = function() {   
			// On affiche une fenêtre de confirmation
				var resultat2 = confirm("êtes-vous certain de vouloir effectuer cette suppression ?");
				// On retourne la réponse de l'utilisateur
				return resultat2;
			}
		</script>
	<?php			 
		}
	?>
		</table>
		</div>
	<br/>
	<script type="text/javascript">
	// Dès que le document est soumis...
		var suppprimer = document.getElementById('suppprimer');
		suppprimer.onclick = function(){
		// On affiche une fenêtre de confirmation
			var c = confirm("êtes-vous certain de vouloir effectuer cette supression ?");
			// On retourne la réponse de l'utilisateur
			return c;
		};  
	</script>
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
			echo "<i class='page' ><a href=\"$self?page=$page\">".$page."</a></i>";
		}
}	
?>
				</div>
			</div>
		</div>
	</div>
	</div>
<!-------- Page d'inscription ------>
		<div id="page-inscription" class="page_form" >
			<form action="ajouter_pointage.php" method="post" id="form-inscription">
				<a id="close" href="#"><img src="images/close.png" class="close" width="13" height="15" /></a><h3><em>AJout Employé présent</em></h3>
				
				<?php $date_pointage = date('d/m/20y'); ?>
				<input type="hidden" value="<?php echo $date_pointage; ?>"  name="date_pointage" /></p>
				<p><span>Nom & Prénom</span><select name="id_employe" required><option>Sélectionner l'employé</option> 
			<?php
			$requete = "SELECT * FROM employe order by nom";
			$reponse = mysqli_query($db, $requete) or die("Echec de l'enregistrement");
			while($data = mysqli_fetch_array($reponse)) {
				$id_employe = $data['id_employe'];
				echo '<option value="'.$id_employe.'">'.$data['nom'].' '.$data['prenom'].'</option>';
			}
			?></select></p>
				<p><span>Heure d'arrivée</span><input type="time" placeholder=" ex: 07H30"  maxlength="5" name="heure_depart" required/></p>
				<p><span>Heure de départ </span><input type="time" placeholder=" ex: 18H30"  maxlength="5"  name="heure_arrivee" /></p>
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