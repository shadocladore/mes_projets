<?php
@session_start();
include('includes/connect.php');
include('includes/config.php');
?>
<?php
if(isset($_POST['nom']) AND isset($_POST['password']))
{	
	$req = "SELECT * FROM admin WHERE nom = '".$_POST['nom']."'";
	$verif = mysqli_query($db, $req) or die("Echec de la vérification");
	$data = mysqli_fetch_array($verif);
	if($data['password'] == md5($_POST['password'])) {
			$_SESSION['id'] = $data['id'];
			$_SESSION['nom'] = $data['nom'];
			$_SESSION['photo'] = $data['photo'];
			header("location: accueil-app-gestion-school.php");
	} else {
		$reponse = "Le nom d'admin<span class='diminutif'>istrateur</span> ou le mot de passe entré est incorrect";
	}
}
else
{
	$reponse = "<span class='diminutif'>Cher administrateur Veuillez</span> entrer vos identifiants afin de vous connecter";
}
?>
<html>
	<head>
		<title><?php echo $nom_etablissement; ?></title>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css" />
		<link rel="icon" type="image/x-icon" href="<?php echo $logo; ?>">
		<script type="text/javascript" src="fichierScript"></script>
	</head>
	<body id="page_connexion">
		<div id="formule">
			<div id="admin"><img id="phot" src="images/eleves/utilisateur.png" width="90" height="90" /></div>
			<form action="connexion.php" method="post">
				<h4><?php echo $reponse; ?></h4> 
				<div id="bloc-champ">
					<p><label>Nom admin<span class='diminutif'>istrateur</span></label><br/><input class="champ" maxlength="9" type="text" name="nom" size=20 required /></p>
					<p><label>Mot de passe</label><br/><input type="password" name="password" class="champ"  size=20  required /></p>
					<p><input type="submit" name="submit" class="champ" value="Se Connecter" /></p>
				<div>
				<div id="ajouter"><a href="#">Mot de passe oublié ?</a></div><div id="pass"></div>	
			</form>
	</div>
		<!-- Page de récupération du mot de passe -->
		<div id="page_recuperation">
		<div id="page-inscription" class="page_form">
			<form action="verif_pass.php" method="post" enctype="multipart/form-data" id="form-verif">
				<a id="close" href="#"><img src="images/close.png" class="close" width="13" height="15" /></a><h3><em>Verification Informations</em></h3>
				<p><span>Date de Naissance</span><input id="champ_verif" type="text" name="date_naissance" placeholder=" ex : 09/05/1995"  required /></p>
				<p><span>Nom Tante Préférée</span><input type="text" id="champ_verif" name="passion" placeholder=" ex : JACQUELINE" required /></p>
				<h5><button type="submit" name="submit"><img src="images/add.png" /> <i>Valider</i></button></h5>
			</form>
		</div>
		</div>
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
	</body>
</html>
	