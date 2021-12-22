<?php

// existence de la variable get "p"
if (isset($_GET['p'])) {

    // si on gère les articles
    if ($_GET['p'] == "article") {

        // si on veut créer un nouvel article (Crud)
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
                // si on a au moins une section il sera au format tableau indexé
                $sections = (isset($_POST['idthesection']) && is_array($_POST['idthesection']))
                    ?   $_POST['idthesection']
                    // sinon on lui passe un tableau vide
                    : [];
                $insert = thearticleInsertWithUserAndSection($dbConnect, $titre, $texte, $status, $iduser, $sections);


                // insertion de l'article et de ses rubriques (si existantes) dans la base de donnée
                $insert = thearticleInsertWithUserAndSection($dbConnect, $titre, $texte, $status, $iduser, $sections);

                // si l'insertion est effectuée
                if ($insert) {
                    // redirection vers la gestion d'articles
                    header("location: ./?p=article");
                    die;
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

            // transtypage de string à int
            $idArticle = (int) $_GET["update"];

            // le formulaire a été envoyé (champs caché avec l'id de l'article) et est l'équivalent de celui passé en get (protection de base)
            if (isset($_POST['idthearticle']) && $_POST['idthearticle'] == $idArticle) {

                //var_dump($_POST);

                // si modification ok
                if (thearticleAdminUpdateById($dbConnect, $_POST)) {
                    // redirection
                    header("Location: ./?p=article");
                    exit;
                }
            }

            // chargement de l'article grâce à son id
            $article =  thearticleAdminSelectOneById($dbConnect, $idArticle);


            if (!empty($article["idthearticle"])) {

                // chargement de tous les auteurs disponibles
                $authors = theuserSelectAll($dbConnect);

                // chargement de toutes les sections
                $sections = thesectionSelectAll($dbConnect);

                // chargement de la vue
                require_once "../view/adminView/articlesUpdateAdminView.php";
            } else {
                header("Location: ./?p=article");
                exit;
            }
        } elseif (isset($_GET['delete']) && ctype_digit($_GET["delete"]) && !empty($_GET["delete"])) {
        } else {

            // appel de la fonction qui récupère tous les articles
            $recupArticles = thearticleAdminSelectAll($dbConnect);

            // Pour valider ou invalider l'affichage d'un article en 1 clic
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
