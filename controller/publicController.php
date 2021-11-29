<?php


// si on a cliqué sur une section et que sa valeur est de type texte ne contenant QUE des numériques (ctype_digit) et pas le 0 (!empty => différent de vide)
if (isset($_GET['idsection']) && ctype_digit($_GET['idsection']) && !empty($_GET['idsection'])) {
    // conversion en integer
    $idsection = (int) $_GET['idsection'];
    echo "id de la section : " . $idsection;

    // si on a cliqué sur le détail d'un article
} elseif (isset($_GET['idarticle']) && ctype_digit($_GET['idarticle']) && !empty($_GET['idarticle'])) {

    // conversion en integer
    $idarticle = (int) $_GET['idarticle'];
    echo "id de l'article : " . $idarticle;

    // si on a cliqué sur le détail d'un utilisateur
} elseif (isset($_GET['iduser']) && ctype_digit($_GET['iduser']) && !empty($_GET['iduser'])) {

    // conversion en integer
    $iduser = (int) $_GET['iduser'];
    echo "id de l'utilisateur : " . $iduser;

    // sinon on est sur l'accueil
} else {

    // pour le moment on est sur accueil
    // récupération des articles au format souhaité pour la page d'accueil
    $recupArticle = thearticleHomepageSelectAll($dbConnect);
    // récupération des sections pour le menu du haut
    $recupSection = thesectionSelectAll($dbConnect);



    // chargement de la vue de homepage
    include_once "../view/publicView/homepageView.php";
}
