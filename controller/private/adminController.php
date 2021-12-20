<?php

// existence de la variable get "p"
if (isset($_GET['p'])) {

    // si on gère les articles
    if ($_GET['p'] == "article") {

        // si on veut créer un nouvel article
        if (isset($_GET['create'])) {

            // si on poste le formulaire
            if (isset($_POST['thearticleTitle'])) {

                // protection des variables POST et tranformation en variables locales
                $titre = htmlspecialchars(strip_tags(trim($_POST['thearticleTitle'])), ENT_QUOTES);
                // A permettre plus tard, ne pas oublier les html_entity_decode, et les strip_tags dans les versions raccourcies (250 caractères etc...)
                // $texte = htmlspecialchars(strip_tags(trim($_POST['thearticleText']), "<h3><h4><h5><h6><br><p><a><img>"), ENT_QUOTES);
                $texte = htmlspecialchars(strip_tags(trim($_POST['thearticleText'])), ENT_QUOTES);
                $status = (int) $_POST['thearticleStatus'];
                $iduser = (int) $_POST['theuser_idtheuser'];
                $sections = (isset($_POST['idthesection']) && is_array($_POST['idthesection']))
                    ?   $_POST['idthesection']
                    : [];
                $insert = thearticleInsertWithUserAndSection($dbConnect, $titre, $texte, $status, $iduser, $sections);

                if ($insert) {
                    header("Location: ./?p=article");
                    exit;
                }
            }

            // chargement de tous les auteurs disponibles
            $authors = theuserSelectAll($dbConnect);

            // chargement de toutes les sections
            $sections = thesectionSelectAll($dbConnect);


            // chargement de la vue
            require_once "../view/adminView/articlesCreateAdminView.php";

            // sinon affichage de tous les articles    
        } elseif (isset($_GET['update']) && ctype_digit($_GET["update"]) && !empty($_GET["update"])) {

            $idArticle = (int) $_GET["update"];

            $article =  thearticleAdminSelectOneById($dbConnect, $idArticle);
            $sections = thesectionSelectAll($dbConnect);

            if (!empty($article["idthearticle"])) {

                $authors = theuserSelectAll($dbConnect);

                require_once "../view/adminView/articlesUpdateAdminView.php";
            } else {
                header("Location: ./?p=article");
            }
        } elseif (isset($_GET['delete']) && ctype_digit($_GET["delete"]) && !empty($_GET["delete"])) {
        } else {

            // appel de la fonction qui récupère tous les articles
            $recupArticles = thearticleAdminSelectAll($dbConnect);
            if (isset($_POST["valid"])) {
                $id = (int) $_POST["valid"];
                $validation = true;
            } elseif (isset($_POST["unvalid"])) {
                $id = (int) $_POST["unvalid"];
                $validation = false;
            }
            if (isset($_POST["valid"]) || isset($_POST["unvalid"])) {
                thearticleValidationById($dbConnect, $id, $validation);
                header("location: ./?p=article");
            }

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
