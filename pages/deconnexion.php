<!--  Permet de déconnecter le profil actuel  -->
<?php
	session_start(); // démarre une session
	session_destroy(); // détruit la session
	header('location: ../index.php'); //redirige vers la page de connexion
?>