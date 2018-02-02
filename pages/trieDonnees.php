<?php session_start(); 
if(isset($_SESSION['idCompte'])) {
?>
	<!DOCTYPE html>
	<html>
		<head>
			<!-- nom de la page -->
			<TITLE>Trie des données</TITLE>
			<meta charset="utf-8" />
			
			<META NAME="Description" CONTENT="UNSS Aveyron - Trie des données">
			
			<!--Import Google Icon Font-->
			<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
			<!--Import materialize.css-->
			<link type="text/css" rel="stylesheet" href="../css/materialize.css"  media="screen,projection"/>
			<link type="text/css" rel="stylesheet" href="../css/style.css"/>

			<!--Let browser know website is optimized for mobile-->
			<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		</head>

		<body>
			<?php 
			// on inclu l'en-tête contenant le logo et le menu de navigation
			include('../include/header.php');
			include "bd.inc.php";
			include "affichage.inc.php";
			?>
			
		  
			<div class="container ">
				<div class="row center">
					<!-- titre de la page -->
					<h1 id="titre">Trier les données</h1>
				</div>
				<div class="row formulaire center borderForm">
					<?php
					if(!isset($_POST['sport'])) {
						//affichage du formulaire si aucun tri n'a été fait
					?>
						<form method="post" action="trieDonnees.php">
							<!-- Formulaire : liste déroulante des sports-->
							<h2 id="h2">Sélectionnez vos paramètres pour trier les données</h2>
							<!-- Formulaire : liste déroulante des sports-->
							<fieldset>
								<legend>Choix du sport</legend> <!-- Titre du fieldset --> 
								<p class="center choixSelect">Sélectionnez un sport :</p>
								
								<?php $tab = array();
								$tab = recupererSport();
								listeDeroulante($tab, "sport"); ?>
								<br/>
							</fieldset>	
								<br />
								<br />
							<!-- Formulaire : choix multiples des catégories-->
							<fieldset>	
								<legend>Choix de la catégorie</legend> <!-- Titre du fieldset --> 
								<p class="center choixSelect">Sélectionnez une catégorie :</p>
								<br />
								<?php
								$tab = recupererCategorie();
								afficheTableau($tab, "cat");
								?>
								
							</fieldset>	
								<br />
								<br />
							<!-- Formulaire : choix multiples des établissements-->	
							<fieldset>		
								<legend>Choix de l'établissement</legend>
								<p class="center choixSelect">Sélectionnez une catégorie d'établissement :</p>
								<br />
								<?php
								$tab = recupererTypeEtablissement();
								afficheTableau($tab, "typeEtab");
								?>
									
								<br />
								<br />
							</fieldset>	
								<br />
								<br/>
								<button class="btn waves-effect waves-light" type="submit" name="action">Valider</button>
						</form>
					<?php
					} else {
						// sinon on affiche le résultat du tri
						?>
						<div class="row center">
							<p>Section en cours de réalisation</p>
						</div>
						<?php
					}
					?>
				</div>	
			</div>	
				<?php include('../include/footer.php'); ?>
		</body>
			
	</html>
<?php
} else {
	header('Location: ../index.php');
}
?>