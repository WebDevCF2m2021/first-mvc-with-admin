<?php
// activation des erreurs si on est en mode production
ini_set('display_errors', 1);

// pour compter le temps de chargement du site (alternative au hrtime)
$begin = microtime(true);

// sleep(3); // attente de 3 secondes pour tester le chargement

/*
 chargement des dépendances
*/


// chargement de la configuration
require_once "../config.php";
// chargement du modèle thearticle (ici dans le CF car utilisé partout)
require_once "../model/thearticleModel.php";
// chargement du modèle de thesection
require_once "../model/thesectionModel.php";
// chargement du modèle de theuser
require_once "../model/theuserModel.php";

// connexion à la DB
$dbConnect = mysqli_connect(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME, DB_PORT);
mysqli_set_charset($dbConnect, DB_ENCODE);


/*
Division des contrôleurs:
Contrôleur en mode publique
*/

require_once "../controller/publicController.php";

// facultatif mais conseillé
mysqli_close($dbConnect);

// temps de fin du script
$end = microtime(true) - $begin;
// affichage en commentaire du temps en secondes
echo "\n<!-- $end -->";
