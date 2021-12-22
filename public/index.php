<<<<<<< HEAD
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

/*
ICI
*/

var_dump($recupArticle);

// chargement de la vue de homepage
include_once "../view/publicView/homepageView.php";
=======
// chargement des dépendances
require_once "../config.php";

<<<<<<< HEAD
<?php

   echo "Hello World !";
?>
=======
// chargement de la vue de homepage
include_once "../view/publicView/homepageView.php";
>>>>>>> 74050f98b8be328990cb7c90dd9623d190099805
>>>>>>> 8f5469b1fa8b2d7f9fca611f9a6b64b84769876c
