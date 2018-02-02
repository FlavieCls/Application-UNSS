<?php
	// Vérification de l'existence du compte
	try
	{
		//tentative de connexion à la BD
		$bdd = new PDO('mysql:host=localhost;dbname=unss;charset=utf8', 'root', 'root');
	}
	catch (Exception $e)
	{
			//echec de connexion déclanche une erreur
			die('Erreur : ' . $e->getMessage());
	}
	
	// on récupère le mail 
	$email=$_POST['email'];
	// on récupèe le mot de passe
	$password = $_POST['password'];
	// on récupère les données dans la BD correspondantes à l'email entré par l'utilisateur
	$req = $bdd->prepare('SELECT idCompte, nom, prenom, password, email FROM compte WHERE email = :email') or die(print_r($bdd->errorInfo()));
	$req->execute(array('email' => $email));	
	$resultat=$req->fetch();
	// si il n'y a pas de résultat ou que le mdp est incorrect
	if(!$resultat || !password_verify($password, $resultat['password']))
	{
		// on en informe l'utilisateur et on redirige vers la page de connexion
		$avertissement= "<p class=\"center deep-orange-text darken-1\">Le mail ou le mot de passe est incorrect.</p>";
		$req->closeCursor();
		header('Location: ../index.php?avertissement='.$avertissement.'');
	}else{
		// sinon on démarre une session et on lui affecte les données de l'utilisateur courant puis on reidirge vers la page d'accueil
		session_start();
		$_SESSION['idCompte']=$resultat['idCompte'];
		$_SESSION['nom']=$resultat['nom'];
		$_SESSION['prenom']=$resultat['prenom'];
		$_SESSION['email']=$resultat['email'];
		$req->closeCursor();
		header('Location: accueil.php');
	}
?>