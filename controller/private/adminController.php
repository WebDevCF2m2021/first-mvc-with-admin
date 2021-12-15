<?php

// importation de la vue de l'accueil
require_once "../view/adminView/homepageAdminView.php";

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
