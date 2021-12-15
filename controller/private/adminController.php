<?php

// existence de la variable get "p"
if (isset($_GET['p'])) {

    // si on gère les articles
    if ($_GET['p'] == "article") {

        // si on veut créer un nouvel article
        if (isset($_GET['create'])) {

            // sinon affichage de tous les articles    
        } else {

            // appel de la fonction qui récupère tous les articles
            $recupArticles = thearticleAdminSelectAll($dbConnect);
            // var_dump($recupArticles);

            // appel de la vue des articles
            require_once "../view/adminView/articlesAdminView.php";
        }
    }

    // si la variable get "p" n'existe pas    
} else {

    // importation de la vue de l'accueil
    require_once "../view/adminView/homepageAdminView.php";
}
