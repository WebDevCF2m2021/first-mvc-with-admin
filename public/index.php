<?php

/*
 chargement des dépendances
*/

// chargement de la configuration
require_once "../config.php";
// chargement du modèle thearticle (ici dans le CF car utilisé partout)
require_once "../model/thearticleModel.php";

// connexion à la DB
$dbConnect = mysqli_connect(DB_HOST,DB_LOGIN,DB_PWD,DB_NAME,DB_PORT);
mysqli_set_charset($dbConnect,DB_ENCODE);

// pour le moment on est sur accueil
$recupArticle = thearticleHomepageSelectAll($dbConnect);


// chargement de la vue de homepage
include_once "../view/publicView/homepageView.php";