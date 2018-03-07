<?php session_start(); 
if(isset($_SESSION['idCompte'])) {
        $_SESSION['info'] = "";
?>
<!DOCTYPE html>
<html id="page">
    <head>
        <!-- nom de la page -->
        <title>Ajouter équipe</title>
        <meta charset="utf-8" />

                    <!-- permet de forcer le déréférencement -->
                    <META NAME="ROBOTS" content="none,noarchive">
    
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
        <?php 
            include('../include/header_admin.php'); 
            include "bd.inc.php";
            include "affichage.inc.php";
        ?>

        <div class="container page">
            <!-- Première ligne -->
            <div class="row center">
                <!-- Titre de la page -->
                <h1 class="center" id="titre">Ajouter une équipe</h1>
            </div>
            
            <div class="row center borderForm">
                        
                <!--  Formulaire contenant tous les champs concernant un profil  -->
                <form method="post" class="col s12 formulaire" id="infosPerso" action="<?php echo $_SERVER['PHP_SELF']?>">
                    <div class="col m4 s12 left">	
                        <!-- lien page pour modifier un utilisateur -->
                        <a  href="utilisateur_accueil.php" id="button_back" class="waves-effect waves-light btn btnLarge">
                            <i class="material-icons left">backspace</i>Retour
                        </a>
                    </div>
                    <br/>
                    <h2 id="h2"><center>Veuillez saisir les informations de la nouvelle équipe puis les valider.<center></h2>
                    <br/>
                    <!-- ligne 1 -->
                    
                    <div class="row center">	
                        <div class="input-field col m4 s12 center">
                            <i class="material-icons prefix">person_outline</i>
                            <!-- Première zone de texte pour le nom de l'utilisateur -->
                            <label for="numEtablissement">Numéro établissement : </label>
                            <input type="text" name="numEtablissement" id="numEtablissement" class="validate" >
                        </div> 
                        <!-- Deuxieme zone de texte pour le prénom de l'utilisateur -->
                        <div class="input-field center col m4 s12">
                            <i class="material-icons prefix">person_outline</i>
                            <label for="prenom">Prénom : </label>
                            <input type="text" name="prenom" id="prenom" class="validate" >
                        </div> 
                    </div>	
                    <!-- ligne 2-->
                    <div class="row center">	
                        <!-- Troisieme zone de texte pour le mail de l'utilisateur -->						
                        <div class="input-field center col m4 s12">
                            <i class="material-icons prefix">mail_outline</i>
                            <label for="email">Email : </label>
                            <input type="text" name="email" id="email" class="validate" >
                        </div> 
                        <!-- Quatrieme zone de texte pour le mot de passe de l'utilisateur -->
                        <div class="input-field center col m4 s12">
                            <i class="material-icons prefix">lock_outline</i>
                            <label for="mdp">Mot de passe : </label>
                            <input type="password" name="mdp" placeholder="" id="mdp" class="validate">
                        </div> 		

                    </div>
                    <!-- Ajout de l'utilisateur à la bd-->
                    <?php
                        if(!empty($_POST['numEtablissement']) && !empty($_POST['numCategorie']) && !empty($_POST['numSport'])) {
                            // appel de la fonction pour ajouter un utilisateur
                            $res = ajoutUtil($_POST['numEtablissement'],$_POST['numCategorie'],$_POST['numSport']);
                            
                            if($res) {
                                echo "Ajout effectué";
                            } else {
                                echo "Erreur : impossible d'ajouter ".$numEtablissement." ".$numCategorie." ".$numSport." ";
                            }
                        }
                    ?>
                    <!-- Bouton de validation de l'ajout -->
                
                    <div class="input-field right col m4 s12">
                        <button id="button_save" type="submit" class="waves-effect waves-light btn btnLarge">
                            <i class="material-icons left">check</i>Valider
                        </button>
                    </div>
                                                
                </form>
            </div>
                
                
            
        </div>
        

        <?php include('../include/footer.php'); ?>
    </body>	
</html>
<?php
} else {
	header('Location: ../index.php');
}
?>	