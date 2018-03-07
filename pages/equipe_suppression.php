<?php
    session_start();
    include "bd.inc.php";
    
    // on vérifie que l'utilisateur est connecté
    if(!isset($_SESSION['idCompte'])) header('Location: ../index.php');
    
    $_SESSION['info'] = "";
    if(!empty($_POST['idUtil'])) {
        // on essaie de supprimer l'utilisateur
        $res = supprEquipe($_POST['idEquipe']);
        
        // si une erreur est survenue on affichera ce message d'erreur
        if (!$res) $_SESSION['info'] = "Erreur de suppression de l'équipe";
    }
    
    header('Location: equipe_choix.php');
?>