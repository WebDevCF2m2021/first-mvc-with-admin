<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Connexion</title>
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

                    <h1>Connexion</h1>
                    <p class="lead">Veuillez vous connecter</p>
                    <div class="alert alert-dark" role="alert">
                        Ce site est un travail scolaire et n'est pas référencé, il est en lien avec ce référentiel
                        <a href="https://github.com/WebDevCF2m2021/first-mvc-with-admin" target="_blank">Github</a>.<br> Ce site est un exemple de MVC en PHP/MySQL procédural d'une administration à plusieurs niveaux de droits
                    </div>

                    <hr>
                    <div>
                        <?php
                        if (isset($error)) :
                        ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $error ?>
                            </div>
                        <?php
                        endif;
                        ?>
                        <form action="" name="connexion" method="POST">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Votre login</label>
                                <input type="text" name="theuserLogin" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                <small id="emailHelp" class="form-text text-muted">Login incorrect</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Votre mot de passe</label>
                                <input type="password" name="theuserPwd" class="form-control" id="exampleInputPassword1" required>
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Restez connecté</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Se connecter</button>
                        </form>
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