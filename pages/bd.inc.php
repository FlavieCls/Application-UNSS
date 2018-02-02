<?php
/*
 * permet la connexion à la base de données
 */
function connectBD() {
	try
	{
		// connexion à la bd
		$bdd = new PDO('mysql:host=localhost; dbname=unss; charset=utf8', 'root', 'root');
		$bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		return $bdd;
	} catch (Exception $e) {
		// affichage de l'erreur précise
		//die('Erreur : ' . $e->getMessage());
		// si connexion impossible
		$info = "<p class=\"center\">Impossible de se connecter à la base de données.<br/>Réessayer plus tard.</p>";
	}
}



/*
 * Permet de supprimer les lignes en doubles dans un tableau multi dimensions
 * @param $array le tableau à dédoublonner
 */
function unique_multidim_array($array) { 
	$temp_array = array(); 
	$i = 0;
	$key_array = array();
	
	foreach($array as $val) {
		// si la valeur à l'indice $key n'est pas perésent dans le tableau $key_array,
		if (!in_array($val, $key_array) && $val[0] != null) {
			// alorsv on l'y insère et on enregistre la ligne entière dans un nouveau tableau
			$temp_array[$i] = $val; 
		}
		// sinon on ne fait rien
		
		$i++; 
	} 
	return $temp_array; 
}



/*
 * Permet de supprimer les lignes en doubles dans un tableau multi dimensions
 * @param $array le tableau à dédoublonner
 * @param $key l'indice/la clé du tableau sur laquelle le dédoublonnage se basera
 */
function unique_multidim_array_with_key($array, $key) { 
    $temp_array = array(); 
    $i = 0; 
    $key_array = array(); 
    
    foreach($array as $val) {
		// si la valeur à l'indice $key n'est pas perésent dans le tableau $key_array,
        if (!in_array($val[$key], $key_array)) {
			// alorsv on l'y insère et on enregistre la ligne entière dans un nouveau tableau
            $key_array[$i] = $val[$key]; 
            $temp_array[$i] = $val; 
        }
		// sinon on ne fait rien
		
        $i++; 
    } 
    return $temp_array; 
}



/*
 * extrait les données du fichier csv
 */
function traitFich($nomFichier) {
	// message d'information
	$info = '';
	
	$indiceMax = -1;          // indice de la dernière colonne du tableau à importer
	$csv[] = array();         // tableau contenant les données du fichier avant traitement
	$tabCategorie = array();  // tableau contenant les catégories présentes dans le fichier
	$tabTypeEtab = array();   // tableau contenant les types d'établissement présents dans le fichier
	$tabEtab = array();       // tableau contenant les établissements présents dans le fichier
	$tabEquipe = array();     // tableau contenant les équipes présentes dans le fichier
	$tabContrainte = array(); // tableau contenant les contraintes présentes dans le fichier
	
	try {
		// on stocke le nom du fichier dans une variable
		
		$csv = new SplFileObject($nomFichier);       // On instancie l'objet SplFileObject
		$csv->setFlags(SplFileObject::READ_CSV);  // On indique que on veut lire le fichier
		$csv->setCsvControl(';');                  // On indique le caractère délimiteur ';'
		
		// permet de déterminer si on se trouve à la première ligne du tableau $csv ou non
		$i = 0;
		// ligne suivante du tableau des équipes
		$m = 0;
		foreach($csv as $ligne) {
			
			// on ne prend pas en compte la première ligne du fichier csv
			if($i != 0 && !empty($ligne[0])) {
				// on insère le type d'établissement dans le tableau adéquat
				$tabTypeEtab[$i-1] = $ligne[1];
				// on insère la catégorie dans le tableau adéquat
				$tabCategorie[$i-1] = $ligne[$indiceMax];
				// on insère l'établissementdans dans le tableau adéquat
				$tabEtab[$i-1] = array($ligne[0], $ligne[1], $ligne[2], $ligne[3], $ligne[4], $ligne[5], $ligne[6], $ligne[7], $ligne[8], $ligne[9], $ligne[10], $ligne[11], $ligne[12], $ligne[13], $ligne[14], $ligne[15], $ligne[16]);
				
				// numéro de la colonne de sport correspondant à l'identifiant du sport
				$j = 1;
				// on insère les équipes de chaque ligne dans le tableau adéquat
				for($k = 17; $k < 24; $k++) {
					$tabEquipe[$m] = array($ligne[0], $ligne[$indiceMax], (int)$j, $ligne[$k]);
					$m++;
					$j++;
				}
				
				// on insère les contraintes dans le tableau adéquat
				$tabContrainte[$i-1] = array($ligne[0], $ligne[$indiceMax], $ligne[24], $ligne[25], $ligne[26], $ligne[27]);
				
			} else {
				// indice max qui correspond à la colonne des catégories
				$indiceMax = count($ligne) - 1;
			}
			
			$i++;
		}
		
		// on supprime les catégories qui sont en doubles
		$tabCategorie = array_unique($tabCategorie);
		// on insère dans la base de données les catégories
		$info .= insertionCategorie($tabCategorie);
		
		// on supprime les catégories qui sont en doubles
		$tabTypeEtab = array_unique($tabTypeEtab);
		// on insère dans la base de données les catégories
		$info .=insertionTypeEtablissement($tabTypeEtab);
		
		// on supprime les catégories qui sont en doubles
		$tabEtab = unique_multidim_array_with_key($tabEtab, 0);
		// on insère dans la base de données les catégories
		$info .= insertionEtablissement($tabEtab);
		
		// on supprime les équipes qui sont en doubles
		$tabEquipe = unique_multidim_array($tabEquipe);
		// on insère dans la base de données les équipes
		$info .= insertionEquipe($tabEquipe);
		
		// on supprime les contraintes qui sont en doubles
		$tabContrainte = unique_multidim_array($tabContrainte);
		// on insère dans la base de données les contraintes
		$info .= insertionContrainte($tabContrainte);
		
		return $info;
		
	} catch(Exception $e) {
		$info .= "<p class=\"center\">Erreur lors du traitement du fichier.</p>";
		return $info;
	}
	
}



/*
 * Insertion des catégorie dans la table categorie
 */
function insertionCategorie($tabCat) {
	// message d'information
	$info = '';
	
	$i = 0;
	$tabCategoriePresent = array();
	$aInserer = array();
	
	// on tente d'executer une requête
	try {
		
		$bdd = connectBD(); // connexion à la bd
		
		$rqt = $bdd->query('SELECT nomCategorie FROM categorie') or die(print_r($bdd->errorInfo()));
		
		// pour chaque résultat retourné, on les stocke dans un tableau
		while($categorie = $rqt->fetch()) {
			$tabCategoriePresent[$i] = $categorie['nomCategorie'];
			$i++;
		}
		
		// on remet l'indice à 0 et on test cellule par cellule du tableau $tabCat si elles sont présentes dans la BD
		// si elles ne le sont pas, ont les rajoute dans le tableau $aInserer, sinon on ne fait rien
		$i = 0;
		foreach($tabCat as $cellCategorie) {
			if(!in_array($cellCategorie, $tabCategoriePresent)) {
				$aInserer[$i] = $cellCategorie;
				$i++;
			}
		}
		$rqt->closeCursor();
		
		// si le tableau de valeur à insérer est non vide,
		if(count($aInserer) > 0 && $aInserer[0] != null) {
			$i = 0;
			// on insère maintenant les catégories manquantes dans la table des categories
			$categorie = $bdd->prepare('INSERT INTO categorie(nomCategorie) VALUES(?)') or die(print_r($bdd->errorInfo()));
			foreach($aInserer as $cell) {
				$categorie->execute(array($cell));
				$i++;
			}
		}
		if($i != 0 && $aInserer[0] != null) {
			$categorie->closeCursor();
		}
		
		$info .='';
		return $info;
		
	} catch(Exception $e) {
		$info .=  "<p class=\"center\">Impossible de communiquer avec la base de données (catégorie).</p>";
		return $info;
	}
}



/*
 * Insertion des types d'établissement dans la table typeetablissement
 */
function insertionTypeEtablissement($tabTypeEtab) {
	// message d'information
	$info = '';
	
	$i = 0;
	$tabTypeEtabPresent = array();
	$aInserer = array();
	$tabTypeEtabNonVide = array();
	
	// on récupère uniquement les lignes où le code du type de l'établissement est différent de NULL
	foreach($tabTypeEtab as $cell) {
		if(!empty($cell)) {
			$tabTypeEtabNonVide[$i] = $cell;
			$i++;
		}
	}
	
	// on tente d'executer une requête
	try {
		$bdd = connectBD(); // connexion à la bd
		
		$rqt = $bdd->query('SELECT codeTypeEtablissement FROM typeetablissement') or die(print_r($bdd->errorInfo()));
		
		// pour chaque résultat retourné, on les stockent dans un tableau
		while($typeEtab = $rqt->fetch()) {
			$tabTypeEtabPresent[$i] = $typeEtab['codeTypeEtablissement'];
			$i++;
		}
		
		// on remet l'indice à 0 et on test cellule par cellule du tableau $tabTypeEtab si elles sont présentes dans la BD
		// si elles ne le sont pas, ont les rajoute dans le tableau $aInserer, sinon on ne fait rien
		$i = 0;
		foreach($tabTypeEtabNonVide as $cellTypeEtab) {
			if(!in_array($cellTypeEtab, $tabTypeEtabPresent)) {
				$aInserer[$i] = $cellTypeEtab;
				$i++;
			}
		}
		$rqt->closeCursor();
		
		// si le tableau de valeur à insérer est non vide,
		if(count($aInserer) > 0 && $aInserer[0] != null) {
			$i = 0;
			// on insère maintenant les catégories manquantes dans la table des categories
			$typeEtab = $bdd->prepare('INSERT INTO typeetablissement(codeTypeEtablissement) VALUES(?)') or die(print_r($bdd->errorInfo()));
			foreach($aInserer as $cell) {
				$typeEtab->execute(array($cell));
				$i++;
			}
		}
		if($i != 0 && $aInserer[0] != null) {
			$typeEtab->closeCursor();
		}
		
		$info .='';
		return $info;
		
	} catch(Exception $e) {
		$info .=  "<p class=\"center\">Impossible de communiquer avec la base de données (type établissement).</p>";
		return $info;
	}
	
}



/*
 * Insertion des établissements dans la table etablissement
 */
function insertionEtablissement($tabEtab) {
	// message d'information
	$info = '';
	
	$i = 0;
	$tabEtabPresent = array();
	$aInserer = array();
	$tabEtabNonVide = array();
	
	// on récupère uniquement les lignes où le code AS est différent de NULL
	foreach($tabEtab as $ligne) {
		if(!empty($ligne[0])) {
			$tabEtabNonVide[$i] = $ligne;
			$i++;
		}
	}
	
	// on tente d'executer une requête
	try {
		$bdd = connectBD();
		
		$rqt = $bdd->query('SELECT codeAS FROM etablissement') or die(print_r($bdd->errorInfo()));
	
		// pour chaque résultat retourné, on les stockent dans un tableau
		while($etablissement = $rqt->fetch()) {
			$tabEtabPresent[$i] = $etablissement['codeAS'];
			$i++;
		}
		
		// on lie la table etablissement à la table typeetablissement par le couple numTypeEtablissement-idType
		$typeEtab = $bdd->prepare('SELECT idType FROM typeetablissement WHERE codeTypeEtablissement = ?') or die(print_r($bdd->errorInfo()));
		// on remet l'indice à 0 et on test cellule par cellule du tableau $tabEtab si elles sont présentes dans la BD
		// si elles ne le sont pas, ont les rajoute dans le tableau $aInserer, sinon on ne fait rien
		$i = 0;
		foreach($tabEtabNonVide as $ligneEtab) {
			if(!in_array($ligneEtab[0], $tabEtabPresent)) {
				$typeEtab->execute(array($ligneEtab[1]));
				$idType = $typeEtab->fetch();
				$aInserer = array($ligneEtab);
				$aInserer[$i][1] = $idType[0];
				$i++;
			}
		}
		$rqt->closeCursor();
		$typeEtab->closeCursor();
		
		// si le tableau de valeur à insérer est non vide,
		if(count($aInserer) > 0 && $aInserer[0] != null) {
			$i = 0;
			// on insère maintenant les établissements manquantss dans la table des établissements
			$etab = $bdd->prepare('INSERT INTO etablissement(codeAS, numTypeEtablissement, nomEtablissement, adresse, codePostal, ville, district, departement, 
			academie, nomChefEtablissement, civiliteChefEtablissement, emailChefEtablissement, telChefEtablissement, nomSecretaire, civiliteSecretaire, 
			emailSecretaire, telSecretaire) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)') or die(print_r($bdd->errorInfo()));
			foreach($aInserer as $ligne) {
				$etab->execute(array(
					(String)$ligne[0],
					(int)$ligne[1],
					(String)$ligne[2],
					(String)$ligne[3],
					(String)$ligne[4],
					(String)$ligne[5],
					(String)$ligne[6],
					(String)$ligne[7],
					(String)$ligne[8],
					(String)$ligne[9],
					(String)$ligne[10],
					(String)$ligne[11],
					(String)$ligne[12],
					(String)$ligne[13],
					(String)$ligne[14],
					(String)$ligne[15],
					(String)$ligne[16]
				));
				$i++;
			}
		}
		if($i != 0 && $aInserer[0] != null) {
			$etab->closeCursor();
		}
		
		$info .='';
		return $info;
		
	} catch(Exception $e) {
		$info .=  "<p class=\"center\">Impossible de communiquer avec la base de données (établissement).</p>";
	}
}



/*
 * Insertion des équipes dans la table equipe
 */
function insertionEquipe($tabEquipe) {
	// message d'information
	$info = '';
	
	$i = 0;
	$tabEquipePresent = array();
	$aInserer = array();
	$tabEquipeNonVide = array();
	
	// on récupère uniquement les lignes où le nombre d'équipe est différent de NULL
	foreach($tabEquipe as $ligne) {
		if(!empty($ligne[3])) {
			$tabEquipeNonVide[$i] = array($ligne[0], fkCategorie($ligne[1]), $ligne[2], (int)$ligne[3]);
			$i++;
		}
	}
	
	// on tente d'executer une requête
	try {
		$bdd = connectBD();
		
		$rqt = $bdd->query('SELECT numEtablissement, numCategorie, numSport, nbEquipe FROM equipe') or die(print_r($bdd->errorInfo()));
		$i = 0;
		// pour chaque résultat retourné, on les stockent dans un tableau
		while($equipe = $rqt->fetch()) {
			$tabEquipePresent[$i] = array($equipe['numEtablissement'], $equipe['numCategorie'], $equipe['numSport'], $equipe['nbEquipe']);
			$i++;
		}
		
		// on remet l'indice à 0 et on test cellule par cellule du tableau $tabEquipeNonVide si elles sont présentes dans la BD
		// si elles ne le sont pas, ont les rajoute dans le tableau $aInserer, sinon on ne fait rien
		$i = 0;
		foreach($tabEquipeNonVide as $ligneEquipe) {
			if(!in_array($ligneEquipe, $tabEquipePresent)) {
				$aInserer[$i] = $ligneEquipe;
				$i++;
			}
		}
		$rqt->closeCursor();
		
		// si le tableau de valeur à insérer est non vide,
		if(count($aInserer) > 0 && $aInserer[0] != null) {
			$i = 0;
			// on insère maintenant les catégories manquantes dans la table des categories
			$equipe = $bdd->prepare('INSERT INTO equipe(numEtablissement, numCategorie, numSport, nbEquipe) VALUES(?, ?, ?, ?)') or die(print_r($bdd->errorInfo()));
			foreach($aInserer as $ligne) {
				$equipe->execute(array(
					$ligne[0],
					$ligne[1],
					$ligne[2],
					$ligne[3]
				));
			}
		}
		if($i != 0 && $aInserer[0] != null) {
			$equipe->closeCursor();
		}
		
		$info .='';
		return $info;
		
	} catch(Exception $e) {
		$info .= "<p class=\"center\">Impossible de communiquer avec la base de données (équipe).</p>";
		return $info;
	}
}



/*
 * Insertion des contraintes dans la table contrainte
 */
function insertionContrainte($tabContrainte) {
	// message d'information
	$info = '';
	
	$i = 0;
	$tabContraintePresent = array();
	$aInserer = array();
	$tabContrainteNonVide = array();
	
	// on récupère uniquement les lignes où il y a des contraintes
	foreach($tabContrainte as $ligne) {
		if(!empty($ligne[2]) || !empty($ligne[3]) || !empty($ligne[4]) || !empty($ligne[5])) {
			$tabContrainteNonVide[$i] = array($ligne[0], fkCategorie($ligne[1]), $ligne[2], $ligne[3], $ligne[4], $ligne[5]);
			$i++;
		}
	}
	
	// on tente d'executer une requête
	try {
		$bdd = connectBD();
		
		$rqt = $bdd->query('SELECT numEtablissement, numCategorie, contrainteStage, contrainteActivite1, contrainteCategorie1, contrainteParticipation FROM contrainte') or die(print_r($bdd->errorInfo()));
		$i = 0;
		// pour chaque résultat retourné, on les stockent dans un tableau
		while($contrainte = $rqt->fetch()) {
			$tabContraintePresent[$i] = array($contrainte['numEtablissement'], $contrainte['numCategorie'], $contrainte['contrainteStage'], 
											$contrainte['contrainteActivite1'], $contrainte['contrainteCategorie1'], $contrainte['contrainteParticipation']);
			$i++;
		}
		
		// on remet l'indice à 0 et on test cellule par cellule du tableau $tabContrainteNonVide si elles sont présentes dans la BD
		// si elles ne le sont pas, ont les rajoute dans le tableau $aInserer, sinon on ne fait rien
		$i = 0;
		foreach($tabContrainteNonVide as $ligneContrainte) {
			if(!in_array($ligneContrainte, $tabContraintePresent)) {
				$aInserer[$i] = $ligneContrainte;
				$i++;
			}
		}
		$rqt->closeCursor();
		
		// si le tableau de valeur à insérer est non vide,
		if(count($aInserer) > 0 && $aInserer[0] != null) {
			$i = 0;
			// on insère maintenant les contraintes manquantes dans la table des contraintes
			$contrainte = $bdd->prepare('INSERT INTO contrainte(numEtablissement, numCategorie, contrainteStage, contrainteActivite1, contrainteCategorie1, contrainteParticipation) VALUES(?, ?, ?, ?, ?, ?)') or die(print_r($bdd->errorInfo()));
			foreach($aInserer as $ligne) {
				$contrainte->execute(array(
					$ligne[0],
					$ligne[1],
					$ligne[2],
					$ligne[3],
					$ligne[4],
					$ligne[5]
				));
			}
		}
		if($i != 0 && $aInserer[0] != null) {
			$contrainte->closeCursor();
		}
		
		$info .='';
		return $info;
		
	} catch(Exception $e) {
		$info .= "<p class=\"center\">Impossible de communiquer avec la base de données (contrainte).</p>";
		return $info;
	}
}



/*
 * permet d'obtenir l'identifiant de la catégorie passé en argument
 */
function fkCategorie($cat) {
	$bdd = connectBD();
	$rqt = $bdd->prepare('SELECT idCategorie FROM categorie WHERE nomCategorie = ?') or die(print_r($bdd->errorInfo()));
	$rqt->execute(array($cat));
	$resultat = $rqt->fetch();
	return $resultat[0];
}



/*
 * permet d'obtenir l'identifiant du sport passé en argument
 */
function fkSport($sport) {
	$bdd = connectBD();
	$rqt = $bdd->prepare('SELECT idSport FROM sport WHERE nomSport = ?') or die(print_r($bdd->errorInfo()));
	$rqt->execute(array($sport));
	$resultat = $rqt->fetch();
	return $resultat;
}



/*
 * permet de récupérer les sports dans la BD
 */
function recupererSport() {
	try {
		
		$bdd = connectBD();
		
		/* exécution d'une requete */
		$sport=$bdd->query("SELECT idSport, nomSport FROM sport"); // on va chercher tous les membres de la table 
		
		$tab = array();
		$i = 0;
		// on range les résultats dans un tableau
		while($cell =$sport->fetch()) {
			$tab[$i] = array($cell['idSport'], $cell['nomSport']);
			$i++;
		}
		/* 	on a terminé alors on ferme le curseur */
		$sport->closeCursor();
		/* on retourne tout les sports */
		return $tab;
	} catch (Exception $err) {
		echo "Erreur, il est impossible de récupérer les sports" ;
	}
}



/*
 * permet de récupérer les catégories dans la BD
 */
function recupererCategorie() {
	try {
		
		$bdd = connectBD();
		
		/* exécution d'une requete */
		$categorie=$bdd->query("SELECT idCategorie, nomCategorie FROM categorie"); // on va chercher tous les membres de la table 
		
		
		$tab = array();
		$i = 0;
		// on range les résultats dans un tableau
		while($cell =$categorie->fetch()) {
			$tab[$i] = array($cell['idCategorie'], $cell['nomCategorie']);
			$i++;
		}
		/* 	on a terminé alors on ferme le curseur */
		$categorie->closeCursor();
		/* on retourne toutes les catégories */
		return $tab;
	} catch (Exception $err) {
		echo "Erreur il est impossible de les categories" ;
	}
}



/*
 * permet de récupérer les types d'établissement dans la BD
 */
function recupererTypeEtablissement() {
	try {
		
		$bdd = connectBD();
		
		/* exécution d'une requete */
		$typeEtab=$bdd->query("SELECT idType, codeTypeEtablissement FROM typeetablissement "); // on va chercher tous les membres de la table 

		$tab = array();
		$i = 0;
		// on range les résultats dans un tableau
		while($cell =$typeEtab->fetch()) {
			$tab[$i] = array($cell['idType'], $cell['codeTypeEtablissement']);
			$i++;
		}
		/* 	on a terminé alors on ferme le curseur */
		$typeEtab->closeCursor();
		/* on retourne toutes les types d'établissement */
		return $tab;
		
	} catch (Exception $err) {
		echo "Erreur il est impossible de les établissements" ;
	}
}



/*
 * permet de chercher toutes les données correspondantes aux critères de l'utilisateur
 */
/*function chercheDonnees($sport, $cat, $typeEtab) {
	try {
		
		$bdd = connectBD();
		
		// requête pour extraire certaine données
		$sql = "SELECT nomEtablissement, nomSport, nomCategorie, nbEquipe FROM equipe JOIN etablissement ON numEtablissement = codeAS JOIN sport ON numSport = idSport JOIN categorie ON numCategorie = idCategorie";
		$condition = "WHERE";
		$order = "ORDER BY nomEtablissement";
		$critSport = "";
		$critCat = "";
		$critTypeEtab = "";
		$crit = "";
		
		if($sport != "vide") {
			$critSport = "idSport LIKE ".$sport;
			
			if(!empty($cat)) {
				
			} else {
				return 1;
			}
			
		} else {
			return 1;
		}
		
	} catch(Exception $e) {
		echo "Erreur lors de la recherche des données correspondantes aux critères de sélection";
	}
	
	
}*/
?>	