<?php 
session_start();
@$id = $_SESSION['id'];
if(isset($id)) {
?>
<?php include("entete.php"); ?>
			<div id="repere">
				<span class="nom-page">Liste Employés</span>
				<span class="lien"><a href="accueil-app-gestion-school.php">Accueil</a> > <i>Employés</i></span> 
			</div>
			<div id="corps">
				<?php echo @$_GET['reponse']; ?>
				<a class="nouveau" id="ajouter" href="#" title="Ajouter un nouvel employé">
					<img class="icones" src="images/add.png" width="25" height="25" />Nouveau
				</a><br/>
				<a href="impression/impression_employe.php" id="impression" class="imprimer" title="Imprimer la liste d'employés de l'entreprise">
					<img class="icones" src="images/imprimer.png" width="20" height="20" /> Imprimer
				</a>
				<form action="recherche_employe.php" method="post" id="search">
					<p>
						<input type="search" value="<?php echo @$_POST['recherche']; ?>" name="recherche" required size="40" placeholder="Rechercher un employé par son nom ou son grade"/>
						<input type="image" src="images/search.png" title="Cliquer sur le bouton pour effectuer la recherche"/>
					</p>  
				</form>
				<div class="bloc_tab">
				<table border="1" class="liste">
					<tr>
						<th>Photo</th><th>Matricule</th><th>Nom et Prénom</th><th>Date de<br/>Naissance</th>
						<th>Téléphone</th><th>Adresse</th><th>Diplôme</th><th>Grade</th><th>Echélon</th>
						<th>Date Prise<br/>Fonction</th><th>Bureau</th><th>Services</th><th>Indice</th><th>Opérations</th>
					</tr>
					<?php 
$rowsPerPage =10;  $pageNum = 1;
if(isset($_GET['page'])) {
	$pageNum = $_GET['page'];
} else { 
	$page=1;
}
$offset = ($pageNum - 1) * $rowsPerPage;

$query = "SELECT COUNT(id_employe) AS numrows from employe";
$result = mysqli_query($db, $query);
$row = mysqli_fetch_array($result);
$numrows = $row['numrows'];
// how many pages we have when using paging?
$maxPage = ceil($numrows/$rowsPerPage); 
?>
	<?php
		$requete = "SELECT * FROM employe order by nom LIMIT $offset, $rowsPerPage ";
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
			<td><img src='images/eleves/".$nom_photo."' width='50' height='50'/></td><td>".$data['matricule']."</td><td id='nom'><b>".$designation."</b> ".$data['nom']." ".$data['prenom']."</td>
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
			<form action="ajouter_employe.php" method="post" enctype="multipart/form-data" id="form-inscription">
				<a id="close" href="#"><img src="images/close.png" class="close" width="13" height="15" /></a><h3><em>AJout Nouvel Employé</em></h3>
				<?php $rand = '';    
					$chaine = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
					for($i=0; $i<9; $i++) { // on genere les 5 caracteres 
					$carac = strlen($chaine);
					$carac = rand(0,($carac-1));
					$rand .= $chaine[$carac];
				}   
				?>
				<p><span>Matricule</span><input type="type" name="matricule" maxlength="30" placeholder="" /></p>
				<p><span>Nom</span><input type="text" placeholder=" ex: TCHANDO" name="nom" maxlength="30" required /></p>
				<p><span>Prénom</span><input type="text" placeholder=" ex: CLADORE" name="prenom" maxlength="30" required /></p>
				<p><span>Sexe</span><input type="text" placeholder=" ex: M" maxlength="1" name="sexe" required /></p>
				<p><span>Date de naissance</span><input type="text" placeholder=" ex: 04/09/2023" name="date_naissance" maxlength="10"  pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])[/](0[1-9]|1[012])[/][0-9]{4}" required /></p>
				<p><span>Téléphone</span><input type="tel" placeholder=" ex: +242 654025600" maxlength="19"  name="telephone"  required /></p>
				<p><span>Adresse</span><input type="text" placeholder=" ex: Tradex Borne 10" name="adresse" maxlength="30" required /></p>
				<p><span>Diplôme</span><input type="text" placeholder=" ex: Licence" name="diplome" maxlength="50"  required /></p>
				<p><span>Grade</span><select name="grade">
					<option>Sélection du grade</option><option value="Personnel de service">Personnel de service</option>
					<option value="Personnel de service spécialisé">Personnel de service spécialisé</option>
					<option value="Commis">Commis</option><option value="Commis principal">Commis principal</option>
					<option value="Contrôleur">Contrôleur</option><option value="Contrôleur Principal">Contrôleur Principal</option>
					<option value="Vérificateur">Vérificateur</option><option value="Inspecteur">Inspecteur</option>
					<option value="Inspecteur Principal">Inspecteur Principal</option><option value="Hors classe">Hors classe</option>
				</select></p>
				<p><span>Echelon</span><input type="text" placeholder="" name="echelon" maxlength="30" /></p>
				<p><span>Indice</span><input type="text" name="indice" placeholder="ex: 1"/></p>
				<p><span>Date prise de fonction</span><input type="type" placeholder=" ex: 04/09/2023" name="date_prise_fonction" maxlength="10"  pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])[/](0[1-9]|1[012])[/][0-9]{4}" required /></p>
				<p><p><span>Bureau</span><input type="text"  name="fonction" maxlength="30" /></p>
				<p><span>Service</span><input type="text"  name="service" maxlength="30" /></p>
				<p><span>Photo</span><input type="file" name="avatar" class="champ" /></p>
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