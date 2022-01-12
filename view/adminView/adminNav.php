<?php
?>
<div class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
    <div class="container">
        <a href="./" class="navbar-brand">Accueil</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?= isset($_GET["p"]) && $_GET["p"] === "article" ? "active" : ""; ?>" href="?p=article">Gestion des articles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= isset($_GET["p"]) && $_GET["p"] === "user" ? "active" : ""; ?>" href="?p=user">Gestion des utilisateurs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= isset($_GET["p"]) && $_GET["p"] === "section" ? "active" : ""; ?>" href="?p=section">Gestion des sections</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= isset($_GET["p"]) && $_GET["p"] === "profile" ? "active" : ""; ?>" href="?p=profile">Gestion du profil</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="?disconnect">Déconnexion</a>
                </li>
            </ul>

        </div>
    </div>
</div>