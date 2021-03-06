<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Administration: Les sections</title>
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
                        <a class="nav-link active">Gestion des sections</a>
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

                    <h1>Administration: Les sections</h1>
                    <p class="lead">Bienvenue <?= $_SESSION['theuserName'] ?>, vous êtes connectés en tant que <?= $_SESSION['therightName'] ?></p>
                    <div class="alert alert-dark" role="alert">
                        Ce site est un travail scolaire et n'est pas référencé, il est en lien avec ce référentiel
                        <a href="https://github.com/WebDevCF2m2021/first-mvc-with-admin" target="_blank">Github</a>.<br> Ce site est un exemple de MVC en PHP/MySQL procédural d'une administration à plusieurs niveaux de droits
                    </div>

                    <hr>
                    <div>
                        <h3>- Créer un <a href="?p=section&create">nouvelle section</a></h3>
                        <hr>
                    </div>
                    <?php
                    if (isset($_GET['message'])) :
                    ?>
                        <div class="alert alert-success" role="alert">
                            <?= $_GET['message'] ?>
                        </div>
                    <?php
                    endif;
                    // si pas de sections (section vide)
                    if (empty($recupSections)) :
                    ?>
                        <h3>Pas encore de section</h3>
                    <?php
                    // sinon (on a au moins un article)
                    else :
                    ?>
                        <h3>Nombre de sections : <?= count($recupSections) ?></h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">idthesection</th>
                                    <th scope="col">thesectionTitle</th>
                                    <th scope="col">thesectionDesc</th>
                                    <th scope="col">Modifier</th>
                                    <th scope="col">Supprimer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($recupSections as $section) {
                                ?>
                                    <tr>
                                        <td scope="row"><?= $section["idthesection"] ?></td>
                                        <td><?= $section["thesectionTitle"] ?></td>
                                        <td><?= $section["thesectionDesc"] ?></td>

                                        <td><a href="?p=section&update=<?= $section["idthesection"] ?>"><img src="img/update.png" alt="update" /></a></td>
                                        <td><a href="?p=section&delete=<?= $section["idthesection"] ?>"><img src="img/delete.png" alt="delete" /></a></td>
                                    </tr>
                                <?php
                                }

                                ?>
                            <tbody>
                        </table>
                    <?php
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