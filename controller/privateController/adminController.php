<?php

// existence de la variable get "p"
if (isset($_GET['p'])) {

    // si on gère les articles
    switch ($_GET['p']) {
        case  "article":
            // Appel du contrôleur admin qui gère les articles
            require_once "adminController/adminArticleController.php";
            break;
    }
    // si la variable get "p" n'existe pas    
} else {

    // importation de la vue de l'accueil
    require_once "../view/adminView/homepageAdminView.php";
}
