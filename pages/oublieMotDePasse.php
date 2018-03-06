<!DOCTYPE html>
<html id="page">
    <head>
	  <?php include('bd.inc.php'); ?>
	  <?php include('affichage.inc.php'); ?>

          <!-- permet de forcer le déréférencement -->
          <META NAME="ROBOTS" content="none,noarchive"

          <!--Import Google Icon Font-->
          <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

          <!--Import materialize.css-->
          <link type="text/css" rel="stylesheet" href="../css/materialize.css"  media="screen,projection"/>
          <link type="text/css" rel="stylesheet" href="../css/style.css"/>

          <!--Let browser know website is optimized for mobile-->
          <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>     
	  
	<body>
		<!--Import jQuery before materialize.js-->
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="../js/materialize.min.js"></script>
		<img src="../images/logoUnss.png" alt="logo unss" class="brand-logo logoIndex">

		<div class="container">
			<div class="row center">
				<form class="col s12 formulaire" action="oublieMotDePasse.php" method="post">
					<div class="row">
						<div class="input-field col m4 s0">
						</div>
						<div class="input-field col m4 s0">
						<p class="center">Vous souhaitez réinitialiser votre mot de passe</p>
						<p class="center">Saisissez votre adresse email afin qu'un nouveau mot de passe vous soit envoyé</p>

						</div>
						<div class="input-field col m4 s0">
						</div>
					</div>
					<div class="row">
						<div class="input-field col m4 s0">
						</div>
						<div class="input-field col m4 s12">
							<input type="email" name="email" id="email" class="validate" required>
							<label for="email" data-error="Invalide" data-success="Valide">Email</label>
                                                        <a href="../index.php"><i class="material-icons">arrow_back</i>Retour</a>
						</div>
						<div class="input-field col m4 s0">
						</div>
					</div>
					<div class="row">
						<div class="input-field col m4 s0">
						</div>
						<?php
						if(isset($_POST['email'])) {
							$email=$_POST['email'];
							if (emailPresent($email,recupEmail())) {
								// envoyer mail fonction
								$motDePasse = motDePasseRandom();
								envoiMail($email, $motDePasse);
							}

							echo "<div class=\"input-field col m4 s12 center\">";
							echo "Si l'adresse existe, un email vous a été envoyé avec votre nouveau mot de passe.";
							echo "</div>";
						}
						
						?>
						<div class="input-field col m4 s0">
						</div>
					</div>

					<div class="row">
						<div class="input-field col m4 s0">
						</div>
						<div class="input-field center col m4 s12">
							<button class="btn waves-effect waves-light" type="submit" name="action">Envoyer
							<i class="material-icons right">arrow_forward</i>
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
