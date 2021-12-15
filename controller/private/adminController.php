<?php

if (isset($_GET["p"])) {
    if ($_GET["p"] == "article") {
        if (isset($_GET["create"])) {
        } else {
            $recupArticles = thearticleAdminSelectAll($dbConnect);
            require_once "../view/adminView/homepageArticlesAdminView.php";
        }
    } elseif ($_GET["p"] == "user") {
    } elseif ($_GET["p"] == "section") {
    }
} else {
    require_once "../view/adminView/homepageAdminView.php";
}
/*
?p=homepage
?p=article
    &create
        - choix de l'auteur
        - choix des sections
        - choix de l'affichage ou non
    &update={id}
        - choix de l'auteur
        - choix des sections
        - choix de l'affichage ou non
        - choix de la date
    &delete={id}
        - tous les articles, mais avec confirmation
?p=user
    &create
        - tout
        - choix du droit
    &update={id}
        - tout
        - choix du droit
    &delete={id}
        - Tous sauf lui-même
?p=section
    &create
    &update={id}
    &delete={id}
?disconnect
./ => homepage
*/
