<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Administration: Articles</title>
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
                    <li class="nav-item">
                        <a class="nav-link" href="?p=article">Gestion des articles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?p=user">Gestion des utilisateurs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?p=section">Gestion des sections</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?disconnect">Déconnexion</a>
                    </li>
                </ul>

            </div>
        </div>
    </div>

    <div class="container">

        <div class="page-header" id="banner">
            <div class="row">
                <div class="col-lg-12 mx-auto">

                    <h1>Administration des articles</h1>
                    <p class="lead">Bienvenue <?= $_SESSION["theuserName"] ?> vous êtes connectés en tant que <?= $_SESSION["therightName"] ?></p>
                    <div class="alert alert-dark" role="alert">
                        Ce site est un travail scolaire et n'est pas référencé, il est en lien avec ce référentiel
                        <a href="https://github.com/WebDevCF2m2021/first-mvc-with-admin" target="_blank">Github</a>.<br> Ce site est un exemple de MVC en PHP/MySQL procédural d'une administration à plusieurs niveaux de droits
                    </div>

                    <hr>
                    <div>
                        <h3>-Créer un <a href="?p=article&create">nouvel article</a></h3>
                    </div>
                    <hr>
                    <?php
                    if (!empty($recupArticles)) {
                    ?>
                        <h3>Nombre d'articles: <?= count($recupArticles) ?> </h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">idthearticle</th>
                                    <th scope="col">thearticleTitle</th>
                                    <th scope="col">thearticleStatus</th>
                                    <th scope="col">thearticleText</th>
                                    <th scope="col">thearticleDate</th>
                                    <th scope="col">theuserName</th>
                                    <th scope="col">thesectionTitle</th>
                                    <th scope="col">Modifier</th>
                                    <th scope="col">Supprimer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($recupArticles as $article) {
                                    $TD = $article["thearticleStatus"] == 1 ?: 'alert alert-secondary';
                                ?>
                                    <tr class="<?= $TD ?>">
                                        <td scope="row"><?= $article["idthearticle"] ?></td>
                                        <td><?= $article["thearticleTitle"] ?></td>
                                        <td>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" <?= $article["thearticleStatus"] == 1 ? ' class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />' : 'class="bi bi-eye-slash-fill" viewBox="0 0 16 16">
                                                <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                                                <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z"/>
                                          '; ?>></svg>
                                        </td>
                                        <td><?= cuteTheText($article["thearticleText"], 150) ?></td>
                                        <td><?= $article["thearticleDate"] ?></td>
                                        <td><?= $article["theuserName"] ?></td>
                                        <td>
                                            <?php

                                            $sections = explode("|||", $article["thesectionTitle"]);
                                            $str = "";
                                            foreach ($sections as $section) {
                                                $str .= "$section,";
                                            }
                                            echo substr($str, 0, -1);
                                            ?>
                                        </td>
                                        <td><a href="?p=articles&update=<?= $article["idthearticle"] ?>"><img src="img/update.png" /></a></td>
                                        <td><a href="?p=articles&delete=<?= $article["idthearticle"] ?>"><img src="img/delete.png" /></a></td>
                                    </tr>
                                <?php
                                }

                                ?>
                            <tbody>
                        </table>
                    <?php
                    } else {
                    ?>
                        <h3>Pas encore d'articles sur le site</h3>
                    <?php
                    }
                    ?>
                    <hr>
                    <a href=" #page-top">Retour en haut</a>
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