<?php session_start(); 
if(isset($_SESSION['idCompte'])) {
?>
	<!DOCTYPE html>
	<html id="page">
		<head>
			<!-- nom de la page -->
			<TITLE>Profil</TITLE>
			<meta charset="utf-8" />
		
			<!--Importation des icones Google Icon Font-->
			<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
			<!--Importation materialize.css-->
			<link type="text/css" rel="stylesheet" href="../css/materialize.css"  media="screen,projection"/>
			<link type="text/css" rel="stylesheet" href="../css/style.css"/>

			<!--Let browser know website is optimized for mobile-->
			<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		</head>     

		<body>  
			<!-- on inclu l'entête comprenant le logo et le menu de navigation du site -->
			<?php include('../include/header.php'); ?>

			<div class="container">
			    <!-- Première ligne -->
				<div class="row center">
				    <!-- Titre de la page -->
					<h1 class="center" id="titre">Votre espace</h1>
				</div>
				
				<div class="row center borderForm">
				    <!--  Formulaire contenant tous les champs concernant un profil  -->
					<form method="post" class="col s12 formulaire" id="infosPerso" action="#">
						<br/>
						<!-- ligne 1 -->
						<div class="row center">
							<div class="input-field col m4 s0">
							</div>

							<div class="input-field center col m4 s12">
								<!-- Première zone de texte pour le nom de l'utilisateur -->
								<label for="nom">Nom : </label>
								<!-- on insère le nom de l'utilisateur -->
								<input value="<?php echo $_SESSION['nom'] ?>" disabled="true" id="nom" type="text" class="validate">
							</div> 
							
							<!-- Modification des infos au click -->
							<div class="input-field col m4 s0">
							    <!-- Bouton de modification -->
								<a  id="button_modifier"onclick="enabledInput()" class="waves-effect waves-light btn">
									<i class="material-icons left">mode_edit</i>Modifier
								</a>
								<!-- Bouton de validation de modification -->
								<button id="button_save" onclick="save()" type="submit" class="waves-effect waves-light btn" style="display: none;">
									<i class="material-icons left">check</i>Valider
								</button>
							</div>
						</div>	
						<!-- ligne 2 -->
						<div class="row center">	
							<div class="input-field col m4 s0">
							</div>
							<!-- Seconde zone de texte pour le prénon de l'utilisateur -->
							<div class="input-field center col m4 s12">
								<label for="prenom">Prénom : </label>
								<!-- on insère le prénom de l'utilisateur -->
								<input value="<?php echo $_SESSION['prenom'] ?>" disabled="true" id="prenom" type="text" class="validate">
							</div> 

							<div class="input-field col m4 s0">
							</div>
						</div>
						<!-- ligne 3 -->
						<div class="row center">	
							<div class="input-field col m4 s0">
							</div>
							<!-- troisieme zone de texte pour l'email de l'utilisateur -->
							<div class="input-field center col m4 s12">
								<label for="email">Email : </label>
								<!-- on insère le mail de l'utilisateur -->
								<input value="<?php echo $_SESSION['email'] ?>" disabled="true" id="email" type="text" class="validate">
							</div> 

							<div class="input-field col m4 s0">
							</div>
						</div>
						<!-- ligne 4 -->
						<div class="row center mdp"  hidden="true">	
							<div class="input-field col m4 s0">
							</div>
							<!-- quatrième zone de texte pour le nouveau mot de passe de l'utilisateur -->
							<div class="input-field center col m4 s12">
								<label for="mdp">Mot de passe : </label>
								<input value="" placeholder="Nouveau mot de passe" disabled="true" id="mdp" type="password" class="validate">
							</div> 

							<div class="input-field col m4 s0">
							</div>
						</div>
						<!-- ligne 5 -->
						<div class="row center confMdp"  hidden="true">	
							<div class="input-field col m4 s0">
							</div>
							<!-- cinquième zone de texte pour la confirmation du nouveau mot de passe de l'utilisateur -->
							<div class="input-field center col m4 s12">
								<label for="confMdp">Confirmation du mot de passe : </label>
								<input value="" placeholder="Confirmer votrenouveau mot de passe" disabled="true" id="confMdp" type="password" class="validate">
							</div> 

							<div class="input-field col m4 s0">
							</div>
						</div>
					</form>
				</div>
			</div>

			<?php include('../include/footer.php'); ?>

			<script>
				// active la modification des données et affiche les champs de mot de passe
				function enabledInput(){
					$( "form#infosPerso input:text" ).prop('disabled', false);
					$( "form#infosPerso input:password" ).prop('disabled', false);
					$( "form#infosPerso .mdp" ).prop('hidden', false);
					$( "form#infosPerso .confMdp" ).prop('hidden', false);
					$("button#button_save").show();
					$("a#button_modifier").hide();
				}
				// sauvegarde les nouvelles données, désactive la modification et cache les champs de mot de passe
				function save(){
					$( "form#infosPerso input:text" ).prop('disabled', true);
					$( "form#infosPerso input:password" ).prop('disabled', true);
					$( "form#infosPerso .mdp" ).prop('hidden', true);
					$( "form#infosPerso .confMdp" ).prop('hidden', true);
					$("button#button_save").hide();
					$("a#button_modifier").show();
				}
			</script>
		</body>	
	</html>
<?php
} else {
	header('Location: ../index.php');
}
?>