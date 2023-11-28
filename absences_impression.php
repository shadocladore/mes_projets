<?php 
session_start();
@$id = $_SESSION['id'];
if(isset($id)) {
?>
<?php include("entete.php"); ?>
			<div id="repere">
				<span class="nom-page">Impression Employés</span>
				<span class="lien"><a href="accueil-app-gestion-school.php">Accueil</a> > <i>Impression Employés</i></span> 
			</div>
			<div id="corps">
				<div id="bloc-bulletin"> 
					<form action="impression/impression_absence.php" id="form-salaire" method="post">
						<p class="erreur">CONCEPTION DE LA FICHE D'ABSENCE PERIODIQUE DU PERSONNEL</p><br/>
						<fieldset>
							<legend>Date Début</legend>
							<input class="salaire" type="text" placeholder=" 05/04/2023" name="date_debut" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])[/](0[1-9]|1[012])[/][0-9]{4}" title="format à respecter : Jour-Mois-Année" required /></p>
						</fieldset><br/>
						<fieldset>
							<legend>Date Fin</legend>
							<input class="salaire" type="text" placeholder=" 27/11/2023" name="date_fin" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])[/](0[1-9]|1[012])[/][0-9]{4}" title="format à respecter : Jour-Mois-Année" required /></p>
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