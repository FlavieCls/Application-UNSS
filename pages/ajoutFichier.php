<?php session_start(); 
if(isset($_SESSION['idCompte'])) {
?>
	<!DOCTYPE html>
	<html id="page">
		<head>
			<!-- nom de la page -->
			<TITLE>Importation des données</TITLE>
			<meta charset="utf-8" />
			
			<!--Import Google Icon Font-->
			<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
			<!--Import materialize.css-->
			<link type="text/css" rel="stylesheet" href="../css/materialize.css"  media="screen,projection"/>
			<link type="text/css" rel="stylesheet" href="../css/style.css"/>

			<!--Let browser know website is optimized for mobile-->
			<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		</head>

		<body>
			<!-- insertion de l'en-tête contenant le logo et le mennu de navigation -->
			<?php include('../include/header.php'); ?>

			<div class="container color bodyImport">
				<div class="row center">
					<!-- titre de la page -->
					<h1 id="titre">Importation des données</h1>
				</div>
				<div class="row center">
					<!-- message d'avertissement si problème lors de l'upload du fichier -->
					<?php
					if(isset($_GET['info'])) {
						echo $_GET['info'];
					}
					?>
				</div>
				<div class="row center">
					<form action="traitement_import.php" method="POST" enctype="multipart/form-data" class="upload">
						<!-- champ de drag and drop du fichier en premier plan -->
						<div class="file-field" id="fieldsFiles">
							<div class="file-path-wrapper">
								<input type="file"  name="fichCSV">
							</div>
						</div>
						
						<!-- consigne d'utilisation du drag and drop qui évolu lorsque un fichier et chargé -->
						<div class="center lblFichCSV">
							<i class="material-icons white-text large">backup</i>
							<p id="lblFichCSV">Sélectionner un fichier ou déposez le ici.</p>
						</div>

						<!-- bouton de validation du formulaire -->
						<div class="center btnUpload" id="btnUpload">
							<button class="btn waves-effect waves-light btnUpload" type="submit" name="actionV">Télécharger</button>
						</div>
					</form>
				</div>
			</div>

			<?php include('../include/footer.php'); ?>

			<!-- JAVASCRIPT FOR COLOR CHANGE AND AUTO SUBMIT -->
			<script type="text/javascript">
				// Changement de couleur de fond lorsque le curseur est sur la zone du drag and drop
				$(document).on('dragover', '#fieldsFiles', function(e) {
					e.preventDefault();
					$(this).css('background-color', 'rgba(218,231,242,0.5)');
				});
				// Changement de couleur de fond lorsque le curseur n'est plus sur la zone de drag and drop
				$(document).on('dragleave', '#fieldsFiles', function(e) {
					$(this).css('background-color', 'rgba(218,231,242,0)');
				});
				// Changement de couleur de fond lorsque le fichier a été 'dropé'
				$(document).on('drop', '#fieldsFiles', function(e) {
					$(this).css('background-color', 'rgba(218,231,242,0)');
				});
				// Changement du text de la zone de drag and drop lorsqu'un fichier a été 'dropé'
				$(document).ready(function(){
					$('form input').change(function () {
						$('#lblFichCSV').text(this.files.length + " file(s) selected");
					});
				});
			</script>
		</body>
	</html>
<?php
} else {
	header('Location: ../index.php');
}
?>