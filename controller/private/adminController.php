<?php
var_dump($_SESSION);
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

echo "<pre>?p=homepage
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
./ => homepage</pre>";
