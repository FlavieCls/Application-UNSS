<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="../js/materialize.js"></script>
<!-- menu de vaigation du site -->
<nav>
	<!-- menu pour ordinateur -->
	<div class="nav-wrapper blue lighten-3">
		<a href="accueil.php" class="brand-logo"><img src="../images/logoUnss.png"  class="logo"></a>
		<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
		<ul class="right hide-on-med-and-down 10px">
			<li><a href="trieDonnees.php">Consulter les données<i class="material-icons right">assignment</i></a class="taille"></li>
			<li><a href="ajoutFichier.php">Importer un fichier<i class="material-icons right">file_upload</i></a></li>
			<li><a href="#">Sauvegarder les données</a></li>
			<li><a href="deconnexion.php">Déconnexion<i class="material-icons right">exit_to_app</i></a></li>
			<li><a href="profil.php"><?php echo $_SESSION['nom']; ?>  <i class="material-icons right">person</i></a></li>
		</ul>
		<!--menu pour tablette  -->
		<ul class="side-nav" id="mobile-demo">
			<li><a href="trieDonnees.php"><i class="material-icons left">assignment</i>Consulter les données</a></li>
			<li><a href="ajoutFichier.php"><i class="material-icons left">file_upload</i>Importer un fichier</a></li>
			<li><a href="#">Sauvegarder les données</a></li>
			<li><a href="deconnexion.php"><i class="material-icons left">exit_to_app</i>Déconnexion</a></li>
			<li><a href="profil.php"><?php echo $_SESSION['nom']; ?>  <i class="material-icons left">person</i></a></li>
		</ul>
	</div>
</nav>