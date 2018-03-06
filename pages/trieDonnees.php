<?php session_start(); 
if(isset($_SESSION['idCompte'])) {
        $_SESSION['info'] = "";
?>
	<!DOCTYPE html>
	<html>
		<head>
			<!-- nom de la page -->
			<TITLE>Trie des données</TITLE>
			<meta charset="utf-8" />

                        <!-- permet de forcer le déréférencement -->
                        <META NAME="ROBOTS" content="none,noarchive">
			
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
								$donneesManquante = 0;
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
								<?php
								$tab = recupererCategorie();
								if(!empty($tab)) {
									echo "<p class=\"center choixSelect infoSmallBlue\">(Par défaut, s'il n'y a aucune catégorie de cochée, on recherchera toutes les catégories en lien avec le sport choisit.)</p>";
									echo "<br/>";
									afficheTableauCheckBox($tab, "cat");
								} else {
									$donneesManquante++;
									echo "<p class=\"center\">Il n'y a auncune catégorie d'enregistrée dans la base de données.<br/>Merci d'importer un premier fichier pour pouvoir trier.</p>";
								}
								?>
								<br />
							</fieldset>	
								<br />
								<br />
							<!-- Formulaire : choix multiples des établissements-->	
							<fieldset>		
								<legend>Choix de l'établissement</legend>
								<p class="center choixSelect">Sélectionnez une catégorie d'établissement :</p>
								<?php
								$tab = recupererTypeEtablissement();
								if(!empty($tab)) {
									echo "<p class=\"center choixSelect infoSmallBlue\">(Par défaut, s'il n'y a aucun type d'établissement de coché, on recherchera touts les types d'établissement en lien avec le sport choisit.)</p>";
									echo "<br/>";
									afficheTableauCheckBox($tab, "typeEtab");
								} else {
									$donneesManquante++;
									echo "<p class=\"center\">Il n'y a auncun type d'établissement d'enregistré dans la base de données.<br/>Merci d'importer un premier fichier pour pouvoir trier.</p>";
								}
								?>
								<br />
							</fieldset>	
								<br />
								<br/>
								<?php
								// s'il n'y a pas de données dans la BD, on informe l'utilisateur qu'il doit d'abord importer un fichier
								if($donneesManquante != 0) echo "<p class=\"center red-text\">Vous devez importer des données avant de pouvoir effectuer un tri sur celles-ci.</p>";
								?>
								<button class="btn waves-effect waves-light" type="submit" name="action" 
								<?php
								if($donneesManquante != 0) echo "disabled";
								?>>Valider</button>
						</form>
					<?php
					} else {
						
						// on vérifie la présence des valeurs retournées
						$sport = isset($_POST['sport'])?$_POST['sport']:1;
						$cat = isset($_POST['cat'])?$_POST['cat']:1;
						$typeEtab = isset($_POST['typeEtab'])?$_POST['typeEtab']:1;
						
						
						// sinon on affiche le résultat du tri
						$result = chercheDonnees($sport, $cat, $typeEtab);
						afficheResultatTableau($result);
						?>
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