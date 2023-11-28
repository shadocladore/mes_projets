<?php 
session_start();
@$id = $_SESSION['id'];
if(isset($id)) {
?>
<?php include("entete.php"); ?>
			<div id="repere">
				<span class="nom-page">Liste Congés</span>
				<span class="lien"><a href="accueil-app-gestion-school.php">Accueil</a> > <i>Employés en Congé</i></span> 
			</div>
			<div id="corps">
				<?php echo @$_GET['reponse']; ?>
				<a class="nouveau" id="ajouter" href="#" title="Ajouter un employé absent">
					<img class="icones" src="images/add.png" width="25" height="25" />Nouveau
				</a><br/>
				<a href="conges_impression.php" id="impression" class="imprimer" title="Imprimer une liste d'employés absents">
					<img class="icones" src="images/imprimer.png" width="20" height="20" /> Imprimer
				</a>
				<form action="recherche_conge.php" method="post" id="search">
					<p>
						<input type="search" value="<?php echo @$_POST['recherche']; ?>" name="recherche" required size="40" placeholder="Rechercher par le nom, disponibilté ou classes tenues..."/>
						<input type="image" src="images/search.png" title="Cliquer sur le bouton pour effectuer la recherche"/>
					</p>
				</form>
				<div class="bloc_tab">
				<table border="1" class="liste">
				<tr>
				<th>Photo</th><th>Nom et Prénom</th><th>Motif du <br/>Congé</th><th>Date début <br/>Congé</th>
				<th>Date fin<br/> Congé</th><th>Date Reprise <br/>Service</th><th>Opérations</th>
				</tr>
					<?php 
$rowsPerPage =10;  $pageNum = 1;
if(isset($_GET['page'])) {
	$pageNum = $_GET['page'];
} else { 
	$page=1;
}
$offset = ($pageNum - 1) * $rowsPerPage;

$query = "SELECT COUNT(id_conge) AS numrows from conge";
$result = mysqli_query($db, $query);
$row = mysqli_fetch_array($result);    
$numrows = $row['numrows'];
// how many pages we have when using paging?
$maxPage = ceil($numrows/$rowsPerPage); 
?>
	<?php
		$requete = "SELECT * FROM conge, employe where conge.id_employe = employe.id_employe order by id_conge DESC LIMIT $offset, $rowsPerPage ";
		$reponse = mysqli_query($db, $requete) or die("Echec de l'enregistrement");
		while($data = mysqli_fetch_array($reponse)) {
			$id = $data['id_conge'];
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
				<a href="editer_conge.php?id_conge=<?php echo $id; ?>"><img class="icone" width="25" height="25" src="images/editer.png" title="Modifier les informations de l'employé."></a>
				<a id="supp_enseignant" href="supprimer.php?id_conge=<?php echo $id; ?>"><img class="icone" width="25" height="25" src="images/supprimer.png" title="supprimer l'employé."></a>
				<a href="impression/demande_autorisation_conge.php?id_conge=<?php echo $id; ?>"><img class="icone" width="23" height="23" src="images/impression.png" title="Imprimer une demande d'autorisation pour cet employé."></a>
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
			<form action="ajouter_conge.php" method="post" id="form-inscription">
				<a id="close" href="#"><img src="images/close.png" class="close" width="13" height="15" /></a><h3><em>AJout employé en congé</em></h3>
				<p><span>Nom & Prénom</span><select name="id_employe" required><option>Sélectionner l'employé</option> 
			<?php
			$requete = "SELECT * FROM employe order by nom";
			$reponse = mysqli_query($db, $requete) or die("Echec de l'enregistrement");
			while($data = mysqli_fetch_array($reponse)) {
				echo '<option value="'.$data['id_employe'].'">'.$data['nom'].' '.$data['prenom'].'</option>';
			}
			?></select></p>
				<p><span>Motif du congé</span><input type="text" placeholder=" ex: Maladie"  maxlength="35" name="motif" required/></p>
				<p><span>Date début du congé</span><input type="text" maxlength="10" name="date_debut" placeholder="05/04/2023" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])[/](0[1-9]|1[012])[/][0-9]{4}" required/></p>
				<p><span>Date fin du congé </span><input type="text" maxlength="10"  name="date_fin" placeholder="25/04/2023" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])[/](0[1-9]|1[012])[/][0-9]{4}"/></p>
				<p><span>Date reprise service </span><input type="text"  maxlength="10"  name="date_reprise_service" placeholder="13/04/2023" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])[/](0[1-9]|1[012])[/][0-9]{4}"/></p>
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