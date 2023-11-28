<?php
	include('includes/connect.php');
	include('includes/config.php');
	include('includes/functions.php');
?>
<!Doctype html>
<html>
	<head>
		<title><?php echo $nom_etablissement; ?></title>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css" />
		<link rel="icon" type="image/x-icon" href="<?php echo $logo; ?>">
		<script type="text/javascript">
		function Horloge() {
			maintenant=new Date();
			heures=maintenant.getHours();
			minutes=maintenant.getMinutes();
			secondes=maintenant.getSeconds();
			if(heures<10) {
				heures="0"+heures;
			}
			if(minutes<10) {
				minutes="0"+minutes;
			}
			if(secondes<10) {
				secondes="0"+secondes;
			}
			document.form1.Pendule.value=heures+":"+minutes+":"+secondes;
			setTimeout("Horloge()", 1000);
			document.form2.Champ.value=heures+":"+minutes+":"+secondes;
			setTimeout("Horloge()", 1000);
		}
		</script>
		<script type="text/javascript" src="fichierScript"></script>
	</head>
	<body id="page-entete" onLoad="Horloge()">
	<div id="page-opacity">
		<div class="slogan">
			<p>
				<span>
					<img id="etab" src="images/bouton.png" width="25" height="25" alt="" />
					<strong>GESSCHOOL</strong><br/>
					<div><img class="logo" src="<?php echo $logo; ?>" width="23" height="23"/><em> <?php echo $nom_etablissement; ?></em></div>
					<form name="form2" id="form1" method="post" action="">
						<?php $Today = date('j/m/Y');  // $new = date('l, F d Y',strtotime($Today)); ?>
							<input type="text" value="<?php echo $Today;?>" /><input name='Pendule' type='text' id='Champ'>
					</form>
				</span>
			</p>
		</div>
		<p class="bienvenue"><marquee>Cher(e) Administrateur(trice), soyez la Bienvenue au << <?php echo $nom_etablissement; ?> >> et bonne administration de l'application GESSCHOOL !</marquee></p>
		<div id="nav" class="bloc">
			<h3>Tableau de bord</h3>
			<div id="profil">
				<?php
				$reponse = mysqli_query($db, "SELECT * FROM admin WHERE id='".@$_SESSION['id']."' ") or die("Echec d'affichage");
				$data = mysqli_fetch_array($reponse);
				?>
				<img id="photo" src="images/eleves/<?php echo $data['photo']; ?>" width="50" height="55" alt="" />
				<span><i><?php echo $data['nom']; ?></i> <br/> <img id="photo" src="images/ligne.png" width="10" height="10" alt="" /> <em>En ligne</em></span>
			</div>
			<div id="block_menu">
				<p class="titre"><a href="#">Rapports</a></p>
				<p id="lien_menu"><img class="ico" src="images/statistiques.png" width="25" height="23"/> <a href="accueil-app-gestion-school.php">Statistiques</a></p>

				<p class="titre"><a href="#">Gestion 1</a></p>
				<p id="lien_menu" ><img src="images/utilisateurs.png" width="20" height="20"/> <a href="employes.php">Employés</a></p>
				<p id="lien_menu" ><img src="images/pointage.png" width="20" height="20"/> <a href="pointages.php">Pointages</a></p>
				<p id="lien_menu"><img src="images/aide.png" width="21" height="23"/> <a href="absences.php"> Absences</a></p>
				
				<p class="titre"><a href="#">Gestion 2</a></p>
				<p id="lien_menu"><img src="images/conges.jpeg" style="border-radius: 17px;" width="20" height="22"/> <a href="conges.php"> Congés</a></p>
				<p id="lien_menu" ><img src="images/avancements.png" width="20" height="23"/> <a href="avancements.php">Avancement</a></p>
				<p id="lien_menu"><img src="images/affectations.png" width="20" height="20"/> <a href="affectations.php">Affectations</a></p>
				
				<p class="titre"><a href="#">Paramètres</a></p>
				<p id="lien_menu"><img class="ico" src="images/profil.png" width="18" height="19"/> <a href="modifier_profil.php"> &nbsp;Mon Profil</a></p>
				<p id="lien_menu"><img class="ico" src="images/depannage.png" width="23" height="23"/> <a href="#">Fonctionalités</a></p>
				<p class="titre"><a href="#">Session</a></p>
				<p id="lien_menu" ><img class="utilisateurs" src="images/utilisateurs.png" width="21" height="20"/> <a href="admin_bd.php">Utilisateurs</a></p>
				<p class="lien_menu" id="deconnexion"><img class="ico" src="images/deconn.png" width="17" height="19"/> <a href="deconnexion.php">&nbsp;Déconnexion</a></p>
			</div>
			<script type="text/javascript">
				// Confirmation de déconnexion ou de suppression.
				var deconnexion = document.getElementById('deconnexion');
				deconnexion.onclick = function(e) {
					// On affiche une fenêtre de confirmation
					var c = confirm("êtes-vous certain de vouloir effectuer cette action ?");
					// On retourne la réponse de l'utilisateur
					return c;
				};
			</script>
			<script type="text/javascript" src="fichierScript.js"></script>
		</div>
 		<div id="section" class="bloc">
			<div id="header">
				<div class="entete">
					<p>
						<span class="nom-etab">
							<img id="bouton" src="images/bouton.png" width="20" height="17" alt="" /> &nbsp; &nbsp;
							<img class="logo" src="<?php echo $logo; ?>" width="26" height="27"/><em><?php echo $nom_etablissement; ?></em>
						</span>
						<script type="text/javascript" language="javascript">
							// Masquer le menu de navigation :
							var bouton = document.getElementById('bouton');
							var nav = document.getElementById('nav');
							var section = document.getElementById('section');
							bouton.onclick = function() {
								if(nav.style.width=="0%") {
									nav.style.width="22%";
									section.style.width="77.5%";     
									document.getElementById('header').style.width="76%";
									document.getElementById('header').style.marginLeft="0px";
									document.getElementById('corps').style.width="95%";
									document.getElementById('page-entete').style.backgroundColor="#222d32";
									document.getElementById('aide').style.marginLeft="-25px";
								} else {
									nav.style.width="0%";
									nav.style.display="hidden";
									document.getElementById('header').style.width="99%";
									document.getElementById('header').style.marginLeft="-7px";
									document.getElementById('corps').style.width="96%";
									section.style.width="99.5%";
									document.getElementById('page-entete').style.backgroundColor="#ecf0f5";
									document.getElementById('aide').style.marginLeft="210px";
								}    
							}
						</script>
						<script type="text/javascript" language="javascript">
							// Masquer le menu de navigation :
							var etab = document.getElementById('etab');
							var page_navigation = document.getElementById('nav');
							etab.onclick = function() {
								if(page_navigation.style.height=="920px") {
									page_navigation.style.height="2px";
									page_navigation.style.borderBottom="0px";
								} else {
									page_navigation.style.height="920px";
									page_navigation.style.borderBottom="25px solid #ecf0f5";
								}    
							}
						</script>
						<a class="aide" href="#"><img src="images/aide.png" width="23" height="27" id="aide" title="Recevoir de l'aide"/></a>
						<div class="temps">
							<?php $Today = date('j/m/Y');  // $new = date('l, F d Y',strtotime($Today)); ?>
							<form name="form1" id="form1" method="post" action="">
								<img class='date' src='images/calendrier.png' width='21' height='21' /> <input type="text" value="<?php echo $Today;?>" /> &nbsp; <img class='time' src='images/time.png' width='30' height='30' /><input name='Pendule' type='text'id='Pendule'>
							</form>
						</div>
					</p>
				</div>
			</div>
