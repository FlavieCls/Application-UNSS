<?php
session_start(); // On démarre une session
if(isset($_SESSION['idCompte'])) //On teste si une session existe déjà
{
	//Si oui, on affiche la page,
?>
	<!DOCTYPE html>
	<html>
		<head>
			<!--Import Google Icon Font-->
			<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
			<!--Import materialize.css-->
			<link type="text/css" rel="stylesheet" href="../css/materialize.css"/>
			<link type="text/css" rel="stylesheet" href="../css/style.css"/>

			<!-- nom de la page -->
			<title>Accueil</title>
			<meta charset="utf-8" />
			<!--Let browser know website is optimized for mobile-->
			<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		</head>

		<body>
			<?php include('../include/header.php'); ?>

			<!-- première image de la page -->
			<div class="parallax-container">
				<div class="parallax"><img src="../images/unss1.png" alt="photo d'un cross départemental féminin"></div>
			</div>
			<div class="section white">
				<div class="row container">
					<!-- titre de la page -->
					<h2 class="header">UNSS Aveyron</h2>
					<!-- Insertion d'un paragraphe explicatif de l'outil -->
					<p class="grey-text text-darken-3 lighten-3">
					L’établissement du planning est une tâche complexe, car elle exige de prendre en
					compte de très nombreuses contraintes, certaines clairement posées, d’autres ponctuelles
					et non formalisées (par exemple, un gymnase en travaux sur une période donnée ou encore les dates de stage de 
					certains élèves.) et donc
					ponctuellement inutilisable pour des rencontres.  <br/>

					La réalisation d’une application web permettra à l’utilisateur de gérer plus facilement
					ses plannings. Pour cela l’utilisateur insérera des fichiers csv qui seront mis dans une base de
					données reliée à une application et celle-ci génèrera ensuite automatiquement des
					plannings en fonction des équipes, des dates et des contraintes.</p>
					<p>
					En cas de problème de connexion ou de problèmes techniques il n’y a pas de perte de
					données car elles sont sauvegardées régulièrement. Cela permet que lors d’un problème
					technique, pendant la remise en route, l’application récupère la dernière sauvegarde pour
					éviter d’avoir à tout reprendre à zéro.
					</p>
					<a  href="trieDonnees.php" class="waves-effect waves-light btn-large">Consulter les données<i class="material-icons right">assignment</i></a>
					<a href="ajoutFichier.php" class="waves-effect waves-light btn-large">Ajouter un fichier CSV<i class="material-icons right">file_upload</i></a>
				</div>
			</div>
			<!-- Parallax est une classe de Materialize pour afficher des images avec un effet design -->
			<div class="parallax-container">
				<div class="parallax"><img src="../images/unss2.jpg" alt="photo d'un cross départemental féminin"></div>
			</div>

			<!-- insertion du pied de page avec du script commun à toutes les pages -->
			<?php include('../include/footer.php'); ?>
			
			<!-- Javascript lié à la classe parallax -->
			<script>
			$(document).ready(function(){
				$('.parallax').parallax();
			});
			</script>
			
		</body>
	</html>
<?php
} else {
	// sinon on redirige vers la page de connexion
	header('Location: ../index.php');
}
?>