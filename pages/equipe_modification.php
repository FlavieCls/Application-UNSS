<?php session_start(); 
if(isset($_SESSION['idCompte'])) {
        $_SESSION['info'] = "";
?>
<!DOCTYPE html>
<html id="page">
    <head>
        <!-- nom de la page -->
        <TITLE>Espace équipe</TITLE>
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
        <?php include('../include/header_admin.php'); ?>

        <div class="container page">
            <!-- Première ligne -->
            <div class="row center">
                <!-- Titre de la page -->
                <h1 class="center" id="titre">Espace équipe</h1>
            </div>
            <!-- Deuxieme ligne -->
            <div class="row center ">
                <div class="col m4 s12">
                            
                    <!-- lien page pour ajouter un utilisateur -->
                    <a  href="#" id="button_modifier" class="waves-effect waves-light btn btnLarge">
                                <i class="material-icons left">person_add</i>Ajouter équipe
                    </a>
                </div>	
                <div class="col m4 s12">	
                    <!-- lien page pour modifier un utilisateur -->
                    <a  href="#" id="button_modifier" class="waves-effect waves-light btn btnLarge">
                                <i class="material-icons left">edit</i>Modifier équipe
                    </a>
                    
                </div>
                <div class="col m4 s12">
                    <!-- lien page pour supprimer un utilisateur -->					
                    <a  href="#" id="button_modifier" class="waves-effect waves-light btn btnLarge">
                                <i class="material-icons left">delete</i>Supprimer équipe
                    </a>
                </div>		
            </div>
                        
        </div>

        
        <!-- Pied de page -->
        <?php include('../include/footer.php'); ?>

    </body>	
</html>
<?php
} else {
	header('Location: ../index.php');
}
?>	