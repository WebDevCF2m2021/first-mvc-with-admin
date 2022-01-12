<?php
?>
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
    <?php
    include "../view/adminView/adminNav.php";
    ?>
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
                                <input type="text" name="theuserName" minlength="6" maxlength="120" class="form-control" value="<?= $user["theuserName"] ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Login : </label>
                                <input type="text" name="theuserLogin" minlength="4" maxlength="50" class="form-control" value="<?= $user["theuserLogin"] ?> " required>
                            </div>
                            <div class="form-group">
                                <label>Mot de passe : </label>
                                <input type="password" name="theuserPwd" minlength="4" class="form-control" value="<?= $user["theuserPwd"] ?> " required>
                            </div>
                            <div class="form-group">
                                <label>Confirmation du Mot de passe : </label>
                                <input type="password" name="theuserPwdConfirm" minlength="4" class="form-control" value="<?= $user["theuserPwd"] ?> " required>
                            </div>



                            <button type="submit" class="btn btn-primary">Modifier l'utilisateur</button>
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