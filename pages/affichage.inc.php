<?php
/*
 * affiche les données du tableau passé en argumant sous forme de liste déroulante
 */
function listeDeroulante($tab, $nom) {
	echo "<select name=\"$nom\" id=\"$nom\" class=\"browser-default formulaireTrie\" required>";
	echo "<option value=\"\" disabled selected>Choisissez votre sport</option>";
		foreach($tab as $ligne) {
				echo "<option value=\"$ligne[0]\">$ligne[1]</option>";
		}
	echo "</select>";
}



/*
 * affiche les données du tableau en argument sous forme de checkbox dans un tableau
 */
function afficheTableauCheckBox($tab, $nom) {
	$nomCheckBox = $nom."[]";
	
	echo "<table class=\"table\">";
	foreach($tab as $cell) {
		echo "<tr class=\"ligne\">";
			echo "<td>";
				echo"<input type=\"checkbox\" class=\"filled-in\" name=\"$nomCheckBox\" value=\"$cell\" id=\"$cell\"/>";
				echo "<label for=\"$cell\">$cell</label>";
			echo "</td>";
		echo "</tr>";
	}
	echo "</table>";
}

/*
 * affiche les données du tableau en argument sous forme de radio bouton dans un tableau
 */
function afficheTableauRadioButton($tab) {
	$i = 0;
	
	echo "<table class=\"table\">";
	foreach($tab as $cell) {
		echo "<tr class=\"ligne\">";
			echo "<td>";
				echo"<input type=\"radio\" class=\"filled-in\" name=\"idUtil\" value=\"".$cell["idCompte"]."\" id=\"util$i\" ".($i == 0 ? "checked" : "")."/>";
				echo "<label for=\"util$i\">".$cell["prenom"]." ".$cell["nom"]." (".$cell["email"].") "."</label>";
			echo "</td>";
		echo "</tr>";
		
		$i++;
	}
	echo "</table>";
}

/*
 * affiche les données du tableau en argument dans un tableau
 */
function afficheResultatTableau($tab) {
	if(is_array($tab) && !empty($tab)) {
		echo "<table class=\"table\">";
		echo "<tr id=\"enTete\"><th>Nom de l'établissement</th><th>Sport</th><th>Catégorie</th><th>Nombre d'équipe</th></tr>";
		foreach($tab as $ligne) {
			echo "<tr class=\"ligne\">";
			foreach($ligne as $cell) {
				echo "<td>";
					echo"<p>".$cell."</p>";
				echo "</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
	} else {
		echo "<div class=\"row center\">";
		echo "<p>Il n'y a aucun résultat correspondant avec vos critères de recherche.</p>";
		echo "</div>";
	}
}


/**
 * Vérifie si le mail passé en argument est présent dans le tableau de mail (passé aussi en argument)
 */
function emailPresent($email, $tabEmail) {
	//
	for($i = 0; $i < sizeof($tabEmail); $i++) {
		if($email == $tabEmail[$i]) {
			// retourne vraie si l'email est présent dans le tableau
			return true;
			echo 'existe';
		}
	}
	// sinon retourne faux
	return false;
	echo 'existe pas';
}


/**
 * Génère un mot de passe de 8 chiffres ou lettres aléatoires
 */
function motDePasseRandom() {
	$mdp ="";
	$chaine = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	$nb_chars = strlen($chaine);

	for($i=0; $i<8; $i++) {
		$mdp .= $chaine[rand(0,($nb_chars-1))];
	}
	return $mdp;
}

function envoiMail($email, $motdepasse) {
	$subject = "Nouveau mot de passe UNSS";
	$message = "Vore nouveau mot de passe est ".$motdepasse."\n\nReconnectez-vous sur unssaveyron.fr"
	." puis modifiez votre mot de passe dans la section profil.";
	$header = "From : unssaveyron.fr";

	mail($email, $subject, $message, $header);
}
?>