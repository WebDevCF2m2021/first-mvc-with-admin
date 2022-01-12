<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Administration: Mettre à jour un article</title>
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

                    <h1>Administration: Mettre à jour un article</h1>
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
                                <label>Titre : </label>
                                <!-- la valeur du champ (input) est égale à ce qu'on récupère de la variable $article que l'on récupère dans l'adminController ici pour la valeur thearticleTitle-->
                                <input type="text" name="thearticleTitle" maxlength="180" class="form-control" value="<?= $article["thearticleTitle"] ?>" required>
                            </div>

                            <div class="form-group">
                                <!-- On vérfie le status sur chaque inputs via la variable $article à l'id thearticleStatus. Si l'une est vrai, on attribue à l'input l'attribut checked qui cochera le bouton-->
                                <label>Visibilité : </label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="thearticleStatus" id="inlineRadio1" value="0" <?= $article["thearticleStatus"] == 0 ? "checked" : "" ?>>
                                    <label class="form-check-label" for="inlineRadio1">0 => wait validation</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="thearticleStatus" id="inlineRadio2" value="1" <?= $article["thearticleStatus"] == 1 ? "checked" : "" ?>>
                                    <label class="form-check-label" for="inlineRadio2">1 => validate</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="thearticleStatus" id="inlineRadio3" value="2" <?= $article["thearticleStatus"] == 2 ? "checked" : "" ?>>
                                    <label class="form-check-label" for="inlineRadio3">2 => wait correction</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="thearticleStatus" id="inlineRadio3" value="3" <?= $article["thearticleStatus"] == 3 ? "checked" : "" ?>>
                                    <label class="form-check-label" for="inlineRadio3">3 => ban</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Texte de l'article : </label>
                                <!-- la valeur du champ (textarea) est égale à ce qu'on récupère de la variable $article que l'on récupère dans l'adminController ici pour la valeur thearticleText-->
                                <textarea name="thearticleText" class="form-control" id="exampleFormControlTextarea1" rows="5"><?= $article["thearticleText"] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Auteur : </label>
                                <select name="theuser_idtheuser" class="form-control" id="exampleFormControlSelect1">
                                    <?php
                                    // tant qu'on a des auteurs
                                    foreach ($authors as $item) :
                                        // on sélectionne la personne ayant écrit l'article au préalable en vérifiant l'id de l'utilisateur qui a écrit l'article avec l'idtheuser de la variable $article que l'on crée dans l'adminController
                                        $selected = ($item['idtheuser'] == $article['idtheuser'])
                                            ? "selected"
                                            : "";
                                    ?>
                                        <option value="<?= $item['idtheuser'] ?>" <?= $selected ?>><?= $item['theuserName'] ?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Date : </label><br>
                                <input type="datetime-local" name="thearticleDate" class="form-control" value="<?= date("Y-m-d\TH:i", strtotime($article["thearticleDate"])) ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Rubriques : </label><br>
                                <?php
                                foreach ($sections as $item) :
                                ?>
                                    <!-- On vérfie les sections sur chaque inputs via la variable $article à l'id idthesction. Ici on vérifie dans un tableau créé à la volée à chaque boucle (vu qu'on boucle sur chaque sections) avec l'explode de la chaine de caractère qu'on récupère de la variable $article à l'id idthesection. Si l'id de la section est bien dans le tableau créé à la volée, alors on aloue l'attribut "checked" à l'input-->
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox<?= $item['idthesection'] ?>" name="idthesection[]" value="<?= $item['idthesection'] ?>" <?= in_array($item['idthesection'], explode(",", $article["idthesection"])) ? "checked" : "" ?>>
                                        <label class="form-check-label" for="inlineCheckbox<?= $item['idthesection'] ?>"><?= $item['thesectionTitle'] ?></label>
                                    </div>
                                <?php
                                endforeach;
                                ?>
                            </div>
                            <input type="hidden" name="idthearticle" value="<?= $article['idthearticle'] ?>" />

                            <button type="submit" class="btn btn-primary">Modifier l'article</button>
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