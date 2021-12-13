<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Section : <?= $thesection['thesectionTitle'] ?> </title>
    <link rel="stylesheet" href="css/bootstrap.css" media="screen">
    <link rel="stylesheet" href="css/custom.min.css" media="screen">
    <link rel="stylesheet" href="css/lightbox.min.css" media="screen">
    <link rel="shortcut icon" href="/img/favicon.ico">
</head>

<body id="page-top">
    <div class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
        <div class="container">
            <a href="./" class="navbar-brand">Accueil</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav">
                    <?php
                    // var_dump($recupSection);
                    foreach ($recupSection as $section) :
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="?idsection=<?= $section['idthesection'] ?>"><?= $section['thesectionTitle'] ?></a>
                        </li>
                    <?php
                    endforeach;
                    ?>

                    <li class="nav-item">
                        <a class="nav-link" href="?connect">Connexion</a>
                    </li>
                </ul>

            </div>
        </div>
    </div>

    <div class="container">

        <div class="page-header" id="banner">
            <div class="row">
                <div class="col-lg-12 mx-auto">

                    <h1>Section : <?= $thesection['thesectionTitle'] ?></h1>
                    <p class="lead"><?= $thesection['thesectionDesc'] ?><br><br>Nombre d'articles de la section: <?= count($recupArticle) ?> </p>
                    <div class="alert alert-dark" role="alert">
                        Ce site est un travail scolaire et n'est pas référencé, il est en lien avec ce référentiel
                        <a href="https://github.com/WebDevCF2m2021/first-mvc-with-admin" target="_blank">Github</a>.<br> Ce site est un exemple de MVC en PHP/MySQL procédural d'une administration à plusieurs niveaux de droits
                    </div>

                    <hr>
                    <?php
                    // si pas d'articles (article vide)
                    if (empty($recupArticle)) :
                    ?>
                        <h3>Pas encore d'articles dans cette section</h3>
                        <?php
                    // sinon (on a au moins un article)
                    else :
                        // tant que l'on a des articles on les mets dans un alias nommé item
                        foreach ($recupArticle as $item) :
                        ?>
                            <div>
                                <h4><a href="?idarticle=<?= $item['idthearticle'] ?>"><?= $item['thearticleTitle'] ?></a></h4>
                                <?php
                                // on va chercher à transformer la chaîne de caractère en tableau indexé, avec comme valeurs, les éléments coupés grâce à un séparateur
                                $titleSection = explode("|||", $item['thesectionTitle']);
                                $idSection = explode(",", $item['idthesection']);

                                // Pour mettre les résultats dans l'ordre du titre ASC, comme celà n'a pas été fait côté SQL, on peut combiner les 2 tableaux générés ci-dessus avec array_combine ($clef => $valeur)
                                $sections = array_combine($idSection, $titleSection);

                                // on veut classer ce nouveau tableau par la valeur ascendante en gardant le rapport $clef -> $valeur : voir les fonctions de tri des tableaux : https://www.php.net/manual/fr/array.sorting.php
                                asort($sections);

                                //var_dump($sections);

                                // si on a au moins une section (pour éviter le bug d'affichage, array_key_first prend la première clef du tableau, si elle vaut false (dans notre cas sans section :"", donc => false) et donc pas de résultat à afficher)
                                if (array_key_first($sections)) :
                                ?>
                                    <div>
                                        <?php
                                        // tant qu'on a des sections, on les affiches 
                                        foreach ($sections as $clef => $valeur) :
                                        ?>
                                            <a href="?idsection=<?= $clef ?>"><?= $valeur ?></a> |
                                        <?php
                                        endforeach;
                                        ?>
                                    </div>
                                <?php
                                endif;
                                ?>
                                <p><?= cuteTheText($item['thearticleText'], 200) ?> <a href="?idarticle=<?= $item['idthearticle'] ?>">Lire la suite</a></p>
                                <div>Ecrit par <a href="?iduser=<?= $item['idtheuser'] ?>"><?= $item['theuserName'] ?></a> le <?= frenchDate($item['thearticleDate'], 3) ?></div>
                                <hr>
                            </div>
                    <?php
                        endforeach;
                    endif;
                    ?>

                    <hr>
                    <a href="#page-top">Retour en haut</a>
                    <hr>
                </div>

            </div>
        </div>

        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/custom.js"></script>
        <script src="js/lightbox.js"></script>
</body>

</html>