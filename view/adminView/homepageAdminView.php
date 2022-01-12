<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Administration: Accueil</title>
    <link rel="stylesheet" href="css/bootstrap.css" media="screen">
    <link rel="stylesheet" href="css/custom.min.css" media="screen">
    <link rel="stylesheet" href="css/lightbox.min.css" media="screen">
    <link rel="shortcut icon" href="/img/favicon.ico">
</head>

<body id="page-top">
    <?php
    include "../view/adminView/adminNav.php";
    ?>

    <div class="container">

        <div class="page-header" id="banner">
            <div class="row">
                <div class="col-lg-12 mx-auto">

                    <h1>Accueil de l'administration</h1>
                    <p class="lead">Bienvenue <?= $_SESSION['theuserName'] ?>, vous êtes connectés en tant que <?= $_SESSION['therightName'] ?></p>
                    <div class="alert alert-dark" role="alert">
                        Ce site est un travail scolaire et n'est pas référencé, il est en lien avec ce référentiel
                        <a href="https://github.com/WebDevCF2m2021/first-mvc-with-admin" target="_blank">Github</a>.<br> Ce site est un exemple de MVC en PHP/MySQL procédural d'une administration à plusieurs niveaux de droits
                    </div>

                    <hr>
                    <div>
                        <h3>- Créer un <a href="?p=article&create">nouvel article</a></h3>
                        <h3>- <a href="?p=article">Gestion des articles</a></h3>
                        <h3>- <a href="?p=user">Gestion des utilisateurs</a></h3>
                        <h3>- <a href="?p=section">Gestion des sections</a></h3>
                    </div>
                    <div>
                        <pre class="alert alert-dark">?p=article
    &create
        - choix de l'auteur
        - choix des sections
        - choix de l'affichage ou non
    &update={id}
        - choix de l'auteur
        - choix des sections
        - choix de l'affichage ou non
        - choix de la date
    &delete={id}
        - tous les articles, mais avec confirmation
?p=user
    &create
        - tout
        - choix du droit
    &update={id}
        - tout
        - choix du droit
    &delete={id}
        - Tous sauf lui-même
?p=section
    &create
    &update={id}
    &delete={id}
?disconnect
./ => homepage
</pre>
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