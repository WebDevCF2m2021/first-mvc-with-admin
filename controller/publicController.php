<?php


// si on a cliqué sur une section
if (isset($_GET['idsection'])) {
    echo "id de la section : " . $_GET['idsection'];
    // si on a cliqué sur le détail d'un article
} elseif (isset($_GET['idarticle'])) {

    echo "id de l'article : " . $_GET['idarticle'];

    // si on a cliqué sur le détail d'un utilisateur
} elseif (isset($_GET['iduser'])) {

    echo "id de l'utilisateur : " . $_GET['iduser'];
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
