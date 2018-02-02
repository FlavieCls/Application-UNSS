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
function afficheTableau($tab, $nom) {
	$nomCheckBox = $nom."[]";
	
	echo "<table class=\"table\">";
	foreach($tab as $ligne) {
		echo "<tr class=\"ligne\">";
			echo "<td>";
				echo"<input type=\"checkbox\" class=\"filled-in\" name=\"$nomCheckBox\" id=\"$ligne[0]\"/>";
				echo "<label for=\"$ligne[0]\">$ligne[1]</label>";
			echo "</td>";
		echo "</tr>";
	}
	echo "</table>";
}



/*
 * affiche les données du tableau en argument dans un tableau
 */
function afficheResultatTableau($tab) {
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
}
?>