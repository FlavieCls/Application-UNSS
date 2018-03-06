<?php
session_start(); // On démarre une session
?>
<!DOCTYPE html>
<html id="page">
	<head>
		<!-- nom de la page -->
		<TITLE>Connexion</TITLE>
		<meta charset="utf-8" />
                <!-- permet de forcer le déréférencement -->
                <META NAME="ROBOTS" content="none,noarchive">
		
		<!--Import Google Icon Font-->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

		<!--Import materialize.css-->
		<link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
		<link type="text/css" rel="stylesheet" href="css/style.css"/>

		<!--Let browser know website is optimized for mobile-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	</head>

	<body>
		<!--Import jQuery before materialize.js-->
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="js/materialize.min.js"></script>
		
		<!-- affichage du logo de l'UNSS -->
		<img src="images/logoUnss.png" alt="logo unss" class="brand-logo logoIndex">

		<div class="container">
			<div class="row center">
				<!-- formulaire de connexion -->
				<form class="col s12 formulaire" action="pages/traitement_connexion.php" method="post">
					<!-- ligne 1 -->
					<div class="row">
						<div class="input-field col m4 s0">
						</div>
						<div class="input-field col m4 s0">
							<!-- titre de la page -->
							<p class="center">Connectez-vous pour accéder à l'application</p>
							<!-- Affichage du message d'erreur si une erreur est présente -->
							<?php
							if(isset($_SESSION['avertissement'])) {
								echo $_SESSION['avertissement'];
							}

							?>
						</div>
						<div class="input-field col m4 s0">
						</div>
					</div>
					<!-- ligne 2 -->
					<div class="row">
						<div class="input-field col m4 s0">
						</div>
						<!-- Vérifié la valididté du mail rentrée -->
						<div class="input-field col m4 s12">
							<input type="email" name="email" id="email" class="validate" required>
							<label for="email" data-error="Invalide" data-success="Valide">Email</label>
						</div>
						<div class="input-field col m4 s0">
						</div>
					</div>
					<!-- ligne 3 -->
					<div class="row">
						<div class="input-field col m4 s0">
						</div>
						<!-- Champs correspondant au mot de passe -->
						<div class="input-field center col m4 s12">
							<input type="password" name="password" id="password" class="validate" required>
							<label for="password">Mot de passe</label>
							<a href="pages/oublieMotDePasse.php">Mot de passe oublié ?</a>
						</div> 
						<div class="input-field col m4 s0">
						</div>
					</div>
					<!-- ligne 4 -->
					<div class="row">
						<div class="input-field col m4 s0">
						</div>
						<!-- Bouton correspondant à la connexion -->
						<div class="input-field center col m4 s12">
							<button class="btn waves-effect waves-light" type="submit" name="action">Connexion
							<i class="material-icons right">arrow_forward</i> <!-- Ajout dun icône dans le bouton de connexion  -->
							</button>
						</div>
						<div class="input-field col m4 s0">
						</div>
					</div>
				</form>
			</div>
		</div>

	</body>
</html>	