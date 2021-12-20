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

            // si on veut modifier un article (crUd), et qu'on passe un id valide (string ne contenant que des numériques dont le 0) et on accèpte pas une variable vide (0==vide)
        } elseif (isset($_GET['update']) && ctype_digit($_GET['update']) && !empty($_GET['update'])) {

            // transtypage de string à int
            $idarticle = (int) $_GET['update'];

            // chargement de l'article grâce à son id
            var_dump(thearticleAdminSelectOneById($dbConnect, $idarticle));

            // chargement de tous les auteurs disponibles
            $authors = theuserSelectAll($dbConnect);

            // chargement de toutes les sections
            $sections = thesectionSelectAll($dbConnect);

            // chargement de la vue

            //var_dump($_GET['update']);
            // si on veut supprimer un article (cruD)
        } elseif (isset($_GET['delete'])) {

            // sinon affichage de tous les articles (cRud)   
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
