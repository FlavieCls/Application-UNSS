<?php session_start(); 
if(isset($_SESSION['idCompte'])) {
        $_SESSION['info'] = "";
?>
<!DOCTYPE html>
<html id="page">
    <head>
        <!-- nom de la page -->
        <TITLE>Profil</TITLE>
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
        <?php include('../include/header.php'); ?>

        <div class="container page">
            <!-- Première ligne -->
            <div class="row center">
                <!-- Titre de la page -->
                <h1 class="center" id="titre">Votre espace</h1>
            </div>
            
            <div class="row center borderForm">
                <?php
                if(isset($_GET['info'])) {
                    echo $_GET['info'];
                }
                ?>
                
                <!--  Formulaire contenant tous les champs concernant un profil  -->
                <form method="post" class="col s12 formulaire" id="infosPerso" action="#">
                    <br/>
                    <!-- ligne 1 -->
                    <div class="row center">	
                        <div class="input-field center col m4 s12">
                            <!-- bouton pour ajouter un utilisateur -->
                            <a  href="utilisateur_ajout.php" id="button_modifier"onclick="enabledInput()" class="waves-effect waves-light btn btnLarge">
                                <i class="material-icons left">person_add</i>Ajouter un utilisateur
                            </a>
                            
                            <!-- Bouton de validation de modification -->
                            <button id="button_save" onclick="save()" type="submit" class="waves-effect waves-light btn btnLarge" style="display: none;">
                                <i class="material-icons left">check</i>Valider
                            </button>
                        </div>
                        <!-- Seconde zone de texte pour le prénon de l'utilisateur -->
                        <div class="input-field col m4 s12">
                                                            <i class="material-icons prefix">person_outline</i>
                            <!-- Première zone de texte pour le nom de l'utilisateur -->
                            <label for="nom">Nom : </label>
                            <!-- on insère le nom de l'utilisateur -->
                            <input type="text" name="nom" value="<?php echo $_SESSION['nom'] ?>" disabled="true" id="nom" class="validate" required>
                        </div> 

                        <div class="input-field col m4 s0">
                        </div>
                    </div>
                    <!-- ligne 2 -->
                    <div class="row center">
                        <div class="input-field col m4 s12">
                                                        <!-- Bouton de modification -->
                            <a  id="button_modifier"onclick="enabledInput()" class="waves-effect waves-light btn btnLarge">
                                <i class="material-icons left">mode_edit</i>Modifier
                            </a>
                        </div>

                        <div class="input-field center col m4 s12">
                                                            <i class="material-icons prefix">person_outline</i>
                            <label for="prenom">Prénom : </label>
                            <!-- on insère le prénom de l'utilisateur -->
                            <input type="text" name="prenom" value="<?php echo $_SESSION['prenom'] ?>" disabled="true" id="prenom" class="validate" required>
                        </div> 
                        
                        <!-- Modification des infos au click -->
                        <div class="input-field col m4 s0">
                        </div>
                    </div>	
                    <!-- ligne 3 -->
                    <div class="row center">	
                        <div class="input-field col m4 s0">
                        </div>
                        <!-- Seconde zone de texte pour le prénon de l'utilisateur -->
                        <div class="input-field center col m4 s12">
                                                            <i class="material-icons prefix">mail_outline</i>
                            <label for="email">Email : </label>
                            <!-- on insère le mail de l'utilisateur -->
                            <input type="text" name="email" value="<?php echo $_SESSION['email'] ?>" disabled="true" id="email" class="validate" required>
                        </div> 

                        <div class="input-field col m4 s0">
                        </div>
                    </div>
                    <!-- ligne 4 -->
                    <div class="row center mdp"  hidden="true">	
                        <div class="input-field col m4 s0">
                        </div>
                        <!-- troisieme zone de texte pour l'email de l'utilisateur -->
                        <div class="input-field center col m4 s12">
                                                            <i class="material-icons prefix">lock_outline</i>
                            <label for="mdp">Nouveau mot de passe : </label>
                            <input type="password" name="mdp" value="" placeholder="Nouveau mot de passe" disabled="true" id="mdp" class="validate">
                        </div> 

                        <div class="input-field col m4 s0">
                        </div>
                    </div>
                    <!-- ligne 5 -->
                    <div class="row center confMdp"  hidden="true">	
                        <div class="input-field col m4 s0">
                        </div>
                        <!-- quatrième zone de texte pour le nouveau mot de passe de l'utilisateur -->
                        <div class="input-field center col m4 s12">
                                                            <i class="material-icons prefix">lock_outline</i>
                            <label for="confMdp">Confirmation du mot de passe : </label>
                            <input type="password" name="confMdp" value="" placeholder="Confirmer votre nouveau mot de passe" disabled="true" id="confMdp" class="validate">
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
                $("button#button_addPerson").hide();
            }
            // sauvegarde les nouvelles données, désactive la modification et cache les champs de mot de passe
            function save(){
                $( "form#infosPerso input:text" ).prop('disabled', true);
                $( "form#infosPerso input:password" ).prop('disabled', true);
                $( "form#infosPerso .mdp" ).prop('hidden', true);
                $( "form#infosPerso .confMdp" ).prop('hidden', true);
                $("button#button_save").hide();
                $("a#button_modifier").show();
                $("button#button_addPerson").show();
            }
        </script>
    </body>	
</html>
<?php
} else {
	header('Location: ../index.php');
}
?>	