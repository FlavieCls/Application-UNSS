<?php session_start(); 
include "bd.inc.php";

if(isset($_SESSION['idCompte'])) {
    $_SESSION['info'] = "";
    $util = null;
    
    if (empty($_POST["idUtil"])) header('Location: utilisateur_choix.php');
    
    if (!empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["email"])) {
        // modifications lancées
        $res = modifUtil($_POST["idUtil"], $_POST["nom"], $_POST["prenom"], $_POST["email"]);
        if (!$res) {
            $_SESSION['info'] = "Erreur modifications des données";
            header('Location: utilisateur_choix.php');
        }
        $util = recupererUtil($_POST["idUtil"]);
        if ($util === null) {
            $_SESSION['info'] = "Erreur récupérations des données";
            header('Location: utilisateur_choix.php');
        }
    } else {
        // affichage des données
        $util = recupererUtil($_POST["idUtil"]);
        if ($util === null) {
            $_SESSION['info'] = "Erreur récupérations des données";
            header('Location: utilisateur_choix.php');
        }
    }
?>
<!DOCTYPE html>
<html id="page">
    <head>
        <!-- nom de la page -->
        <TITLE>Modifier un utilisateur</TITLE>
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
            //include "bd.inc.php";
            include "affichage.inc.php";
        ?>

        <div class="container page">
            <!-- Première ligne -->
            <div class="row center">
                <!-- Titre de la page -->
                <h1 class="center" id="titre">Modifier un utilisateur</h1>
            </div>
            
            <div class="row center borderForm">
                <!--  Formulaire contenant tous les champs concernant un profil  -->
                <form method="post" class="col s12 formulaire" id="infosPerso" action="#">
                    <input type="text" name="idUtil" value="<?php echo $_POST["idUtil"]; ?>" hidden />
                    <div class="col m4 s12 left">
                        <!-- lien page pour modifier un utilisateur -->
                        <a  href="utilisateur_choix.php" id="button_back" class="waves-effect waves-light btn btnLarge">
                            <i class="material-icons left">backspace</i>Retour
                        </a>
                    </div>
                    <br/>
                    <h2 id="h2"><center>Veuillez modifier les informations de l'utilisateur sélectionné<center></h2>
                    <br/>
                    <!-- ligne 1 -->
                    
                    <div class="row center">	
                        <div class="input-field col m6 center">
                            <i class="material-icons prefix">person_outline</i>
                            <!-- Première zone de texte pour le nom de l'utilisateur -->
                            <label for="nom">Nom : </label>
                            <!-- on insère le nom de l'utilisateur -->
                            <input type="text" name="nom" value="<?php echo $util['nom']; ?>" id="nom" disabled="true" class="validate" >
                        </div>
                        <div class="input-field center col m6">
                            <i class="material-icons prefix">person_outline</i>
                            <label for="prenom">Prénom : </label>
                            <input type="text" name="prenom" value="<?php echo $util['prenom']; ?>" id="prenom" disabled="true" class="validate" >
                        </div>
                        
                    </div>	
                    <div class="row center">
                        <div class="input-field center col m6">
                            <i class="material-icons prefix">mail_outline</i>
                            <label for="email">Email : </label>
                            <input type="text" name="email" value="<?php echo $util['email']; ?>" id="email" disabled="true" class="validate" >
                        </div>
                    </div>
                
                    <?php
                        if (!empty($_SESSION['info'])) {
                            echo $_SESSION['info'];
                        }
                    ?>
                    
                    <!-- Bouton de validation de l'ajout -->
                    <div class="row center">
                        <div class="input-field right col m4 s12">
                            <a id="button_modifier" onclick="enabledInput()" class="waves-effect waves-light btn btnLarge">
                                <i class="material-icons left">edit</i>Modifier
                            </a>
                            <button id="button_save" onclick="save()" type="submit" class="waves-effect waves-light btn btnLarge" style="display: none;">
                                <i class="material-icons left">check</i>Valider
                            </button>
                        </div>
                        <div class="input-field right col m4 s12">
                            <a id="button_annuler" onclick="annuler()" class="waves-effect waves-light btn btnLarge" style="display: none;">
                                <i class="material-icons left">cancel</i>Annuler
                            </a>
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
                $("button#button_save").show();
                $("a#button_modifier").hide();
                $("a#button_annuler").show();
            }
            // sauvegarde les nouvelles données, désactive la modification et cache les champs de mot de passe
            function save(){
                //$( "form#infosPerso input:text" ).prop('disabled', true);
                $("button#button_save").hide();
                $("a#button_modifier").show();
                $("a#button_annuler").hide();
            }
            
            function annuler(){
                $( "form#infosPerso input:text" ).prop('disabled', true);
                $("button#button_save").hide();
                $("a#button_modifier").show();
                $("a#button_annuler").hide();
                
                $("#nom").val("<?php echo $util['nom']; ?>");
                $("#prenom").val("<?php echo $util['prenom']; ?>");
                $("#email").val("<?php echo $util['email']; ?>");
            }
        </script>
    </body>	
</html>
<?php
} else {
	header('Location: ../index.php');
}
?>	