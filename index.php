<?php
include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<title><?php echo $nom_etablissement; ?></title>
		<link rel="icon" type="image/x-icon" href="<?php echo $logo; ?>">
		<meta http-equiv="refresh" content="3; URL=connexion.php">
	</head>
	<body id="bod">
		<div id="data">
			<img src="images/loading-1.gif" />
		</div>
		<style> 
			body#bod { 
				background-color: #083142;
				text-align: center;
			}
			div#data {
				margin-top: 40%;
				text-align: center;
			}
			div#data img {
				width: 90%;
				height: 80%;
			}
			@media screen and (min-width: 500px) {
				div#data {
					margin-left: 0% !important;
					margin-top: 3%;
					text-align: center;
				}
				div#data img {
					width: 600px !important;
					height: 450px !important;
				}
			}
		</style>
	</body>
</html>
	
