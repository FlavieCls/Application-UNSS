<?php session_start(); 
if(isset($_SESSION['idCompte'])) {
        $_SESSION['info'] = "";
?>
<!DOCTYPE html>
<html id="page">
    <head>
        <!-- nom de la page -->
        <TITLE>Choisir utilisateur</TITLE>
        <meta charset="utf-8" />

                    <!-- permet de forcer le déréférencement -->
                    <META NAME="ROBOTS" content="none,noarchive">
    
        <!--Importation des icones Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Importation materialize.css-->
        <link type="text/css" rel="stylesheet" href="../css/materialize.css"  media="screen,projection"/>
        <link type="text/css" rel="stylesheet" href="../css/style.css"/>
        <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="../js/materialize.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.modal').modal();
                $('.modal-trigger').modal();
            });
        </script>

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

        <div class="container ">
            <div class="row center">
                <!-- titre de la page -->
                <h1 id="titre">Choisir un utilisateur</h1>
            </div>
            <div class="row formulaire center borderForm">
                <form method="post" action="utilisateur_suppression.php">
                    <div class="col m4 left">   
                        <!-- lien page pour modifier un utilisateur -->
                        <a  href="utilisateur_accueil.php" id="button_back" class="waves-effect waves-light btn btnLarge">
                                    <i class="material-icons left">backspace</i>Retour
                        </a>
                    </div>
                    <br/>               
                    <h2 id="h2">Liste des utilisateurs</h2>
                    <div class="row center">
                        <div class="center col m12">    
                            <?php
                                $tab = recupererUtils();
                                if(!empty($tab)) {                                  
                                    afficheTableauRadioButton($tab);
                                } else {
                                    $donneesManquante++;
                                    echo "<p class=\"center\">Il n'y a auncun utilisateur d'enregistré dans la base de données.<br/>Merci d'ajouter un premier utilisateur pour pouvoir le modifier.</p>";
                                }
                            ?>
                            <br />
                        </div>
                    </div>
                    <?php
                        if (!empty($_SESSION['info'])) {
                            echo $_SESSION['info'];
                        }
                    ?>
                    <div class="col m4 s12 right">  
                        <!-- lien page pour modifier un utilisateur -->
                        <button type="submit"  formaction="utilisateur_modification.php" id="button_modifier" class="waves-effect waves-light btn btnLarge">
                            <i class="material-icons left">edit</i>Modifier
                        </button>
                    </div>
                    <div class="col m4 s12 right">
                        <!-- supprimer un utilisateur -->                   
                        <a  href="#confirmationSuppr" id="button_suppr" class="waves-effect waves-light modal-trigger btn btnLarge">
                            <i class="material-icons left">delete</i>Supprimer
                        </a>
                    </div>
                    
                    <!-- Fenêtre modale de confirmation de suppression -->
                    <div id="confirmationSuppr" class="modal">
                        <div class="modal-content">
                            <h5>Confirmation de suppression</h5>
                            <p>Êtes-vous sûr de vouloir supprimer cet utilisateur ?</p>
                        </div>
                        <div class="modal-footer">
                            <a href="#!" class="modal-action modal-close waves-effect waves-light btn">Annuler</a>
                            <button type="submit" class="modal-action waves-effect waves-light btn">Valider</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>      
        <br/>   
        <?php include('../include/footer.php'); ?>
    </body> 
</html>
<?php
} else {
    header('Location: ../index.php');
}
?>  