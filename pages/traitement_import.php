<?php session_start();
if(isset($_SESSION['idCompte']))
{
        $_SESSION['info'] = "";
	$info = '';
	$extension_upload = '';
	$chemin = '../fichier/';
	
	if($_FILES['fichCSV']['error'] == 0) {
		
		
		// On teste si le fichier à un poids maximal de 10 Mo
		if($_FILES['fichCSV']['size'] <= 10485760) {
			
			// On vérifie que le fichier à une bonne extension
			$extension_upload = substr( strrchr($_FILES['fichCSV']['name'], '.') , 1 );
			$extensions_autorisees = array('csv', 'CSV');
			
			// Si c'est bon, on enregistre le fichier
			if (in_array($extension_upload, $extensions_autorisees)) {
				include('bd.inc.php');
				$nomFichier = date("d-F-Y-G-i-s").'.'.$extension_upload;
				
				// On insère les données dans la BD
				$info .= traitFich($_FILES['fichCSV']['tmp_name']);
				
				if(empty($info)) {
					// On déplace le fichier et on créé le message de confirmation
					move_uploaded_file($_FILES['fichCSV']['tmp_name'], $chemin.''.$nomFichier);
					$info .= "<p class=\"green-text\">Importation terminé avec succès.</p>";
				}
			} else {
				// Sinon on informe l'administrateur que le fichier n'a pas la bonne extension
				$info .= "<p class=\"red-text\">Le fichier uploadé n'a pas la bonne extension.<br/>Les extensions autorisées sont : csv / CSV.<br/>Votre extension : '$extension_upload'.</p>";
			}
		} else {
			// Sinon on informe l'administrateur que le fichier est trop lourd
			$info .= "<p class=\"red-text\">Le fichier uploadé est trop lourd.</br>La limite est fixé à 10 Mo.</p>";
		}
	} else {
		$info .= "<p class=\"red-text\">Merci de télécharger un fichier avant de valider.</p>";
	}
        $_SESSION['info'] = $info;
	header('Location: ajoutFichier.php');
} else {
	header('Location: ../index.php');
}
	
	?>