<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Administration: Création d'un utilisateur</title>
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
                        <a class="nav-link  active" href="?p=user">Gestion des utilisateurs</a>
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

                    <h1>Administration: Création d'un utilisateur</h1>
                    <p class="lead">Bienvenue <?= $_SESSION['theuserName'] ?>, vous êtes connectés en tant que <?= $_SESSION['therightName'] ?></p>
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
                                <label>Nom : </label>
                                <input type="text" name="theuserName" minlength="6" maxlength="120" class="form-control" value="<?php if (isset($_POST['theuserName'])) echo $_POST['theuserName'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Login : </label>
                                <input type="text" name="theuserLogin" minlength="4" maxlength="50" class="form-control" value="<?php if (isset($_POST['theuserLogin'])) echo $_POST['theuserLogin'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Mot de passe : </label>
                                <input type="password" name="theuserPwd" minlength="4" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Confirmation du Mot de passe : </label>
                                <input type="password" name="theuserPwdConfirm" minlength="4" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Droits : </label><br>
                                <?php
                                foreach ($rights as $right) :
                                ?>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="inlineCheckbox<?= $right['idtheright'] ?>" name="idtheright" value="<?= $right['idtheright'] ?>" <?= $right["idtheright"] == 1 ? "checked" : ""; ?>>

                                        <label class="form-check-label" for="inlineCheckbox<?= $right['idtheright'] ?>" data-toggle="tooltip" data-placement="top" title="<?= $right["therightdesc"] ?>"><?= $right['therightName'] ?></label>
                                    </div>
                                <?php
                                endforeach;
                                ?>
                            </div>


                            <button type="submit" class="btn btn-primary">Créer l'utilisateur</button>
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