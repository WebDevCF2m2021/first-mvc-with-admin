<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Article : <?= $recupArticle['thearticleTitle'] ?></title>
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
                        <a class="nav-link" href="?p=connect">Connexion</a>
                    </li>
                </ul>

            </div>
        </div>
    </div>

    <div class="container">

        <div class="page-header" id="banner">
            <div class="row">
                <div class="col-lg-12 mx-auto">

                    <h1>Article : <?= $recupArticle['thearticleTitle'] ?></h1>
                    <div class="alert alert-dark" role="alert">
                        Ce site est un travail scolaire et n'est pas référencé, il est en lien avec ce référentiel
                        <a href="https://github.com/WebDevCF2m2021/first-mvc-with-admin" target="_blank">Github</a>.<br> Ce site est un exemple de MVC en PHP/MySQL procédural d'une administration à plusieurs niveaux de droits
                    </div>

                    <hr>

                    <div>
                        <h4><?= $recupArticle['thearticleTitle'] ?></h4>
                        <?php
                        // on va chercher à transformer la chaîne de caractère en tableau indexé, avec comme valeurs, les éléments coupés grâce à un séparateur
                        $titleSection = explode("|||", $recupArticle['thesectionTitle']);
                        $idSection = explode(",", $recupArticle['idthesection']);


                        // var_dump($titleSection, $idSection);

                        // si on a au moins une section (pour éviter le bug d'affichage, on vérifie si la variable de la première clef n'est pas vide)
                        if (!empty($idSection[0])) :
                        ?>
                            <div>
                                <?php
                                // tant qu'on a des sections, on les affiches 
                                foreach ($idSection as $clef => $valeur) :
                                ?>
                                    <a href="?idsection=<?= $valeur ?>"><?= $titleSection[$clef] ?></a> |
                                <?php
                                endforeach;
                                ?>
                            </div>
                        <?php
                        endif;
                        ?>
                        <p><?= nl2br($recupArticle['thearticleText']) ?> </p>
                        <div>Ecrit par <a href="?iduser=<?= $recupArticle['idtheuser'] ?>"><?= $recupArticle['theuserName'] ?></a> le <?= frenchDate($recupArticle['thearticleDate'], 3) ?></div>
                        <hr>
                    </div>

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