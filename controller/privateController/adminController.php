<?php

// existence de la variable get "p"
if (isset($_GET['p'])) {


    switch ($_GET['p']) {

            // si on gère les articles
        case  "article":

            // Appel du contrôleur admin qui gère les articles
            require_once "adminController/adminArticleController.php";
            break;

            // si on gère les utilisateurs
        case "user":

            // Appel du contrôleur admin qui gère les utilisateurs
            require_once "adminController/adminUserController.php";
            break;

        case "section":

            // Appel du contrôleur admin qui gère les utilisateurs
            require_once "adminController/adminSectionController.php";
            break;
    }
    // si la variable get "p" n'existe pas    
} else {

    // importation de la vue de l'accueil
    require_once "../view/adminView/homepageAdminView.php";
}
