<?php 
session_start();
@$id = $_SESSION['id'];
if(isset($id)) {
?>
<?php include("entete.php"); ?>
			<div id="repere">
				<span class="nom-page">Liste de Pointages</span>
				<span class="lien"><a href="accueil-app-gestion-school.php">Accueil</a> > <a href="pointages.php">Employés Présents</a> > <i>Pointages</i></span> 
			</div>
			<div id="corps">
				<div id="bloc-bulletin"> 
					<form action="impression/impression_pointage_journalier.php" id="form-salaire" method="post">
						<p class="erreur">CONCEPTION DE LA FICHE DE PRESENCE JOURNALIERE DU PERSONNEL</p><br/>
						<fieldset>
							<legend>Date de Pointage Journalier</legend>
							<input class="salaire" type="date" placeholder="2023-10-25-" name="date_pointage" /></p>
						</fieldset>
						<h4><button class="bouton-salaire" type="submit" name="submit"><img src="images/imprimer.png" /><i> Imprimer</i></button></h4>
					</form>
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