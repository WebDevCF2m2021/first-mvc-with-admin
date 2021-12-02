<?php
// récupération des sections pour le menu du haut
// Est utile pour toutes les pages !
$recupSection = thesectionSelectAll($dbConnect);

// si on a cliqué sur une section et que sa valeur est de type texte ne contenant QUE des numériques (ctype_digit) et pas le 0 (!empty => différent de vide)
if (isset($_GET['idsection']) && ctype_digit($_GET['idsection']) && !empty($_GET['idsection'])) {
    // conversion en integer
    $idsection = (int) $_GET['idsection'];

    // récupération de la section
    $thesection = thesectionSelectOne($dbConnect, $idsection);


    // si la réponse à thesectionSelectOne est null (on a pas trouvé la section)
    if (is_null($thesection)) {

        // création du message d'erreur
        $error = "Cette section n'existe plus, cliquez dans le menu du haut de page pour voir les sections existantes,<br> ou retournez sur notre page d'<a href='./'>accueil</a>";


        // Appel de la vue de l'erreur 404'
        include_once "../view/error404View.php";

        // sinon    
    } else {

        // récupération des articles se trouvant dans la section
        $recupArticle = thearticleSectionSelectAll($dbConnect, $idsection);

        // Appel de la vue de la section
        include_once "../view/publicView/sectionView.php";
    }

    // si on a cliqué sur le détail d'un article
} elseif (isset($_GET['idarticle']) && ctype_digit($_GET['idarticle']) && !empty($_GET['idarticle'])) {

    // conversion en integer
    $idarticle = (int) $_GET['idarticle'];

    // Appel de la récupération de l'article
    $recupArticle = thearticleSelectOneById($dbConnect, $idarticle);

    // si on a pas récupéré d'article (idthearticle est null)
    if (is_null($recupArticle['idthearticle'])) {

        // création du message d'erreur
        $error = "Cet article n'existe plus, cliquez dans le menu du haut de page pour voir les sections existantes,<br> ou retournez sur notre page d'<a href='./'>accueil</a>";

        // Appel de la vue de l'erreur 404'
        include_once "../view/error404View.php";

        // on a récupéré un article    
    } else {

        // Appel de la vue: 
        include_once "../view/publicView/articleView.php";
    }

    // si on a cliqué sur le détail d'un utilisateur
} elseif (isset($_GET['iduser']) && ctype_digit($_GET['iduser']) && !empty($_GET['iduser'])) {

    // conversion en integer
    $iduser = (int) $_GET['iduser'];

    // à commenter
    echo "id de l'utilisateur : " . $iduser;

    /*
    EXERCICE

    */




    // sinon on est sur l'accueil
} else {

    // pour le moment on est sur accueil
    // récupération des articles au format souhaité pour la page d'accueil
    $recupArticle = thearticleHomepageSelectAll($dbConnect);




    // chargement de la vue de homepage
    include_once "../view/publicView/homepageView.php";
}
