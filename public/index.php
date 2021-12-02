<?php
// activation des erreurs si on est en mode production
ini_set('display_errors', 1);

// pour compter le temps de chargement du site (alternative au hrtime)
$begin = microtime(true);

// sleep(3); // attente de 3 secondes pour tester le chargement

/*
 chargement des dépendances
*/

/*
    EXERCICE

    - création du modèle dans /model/theuserModel.php
    - appel de ce modèle dans index.php (require_once)
    - création d'une vue dans /view/publicView/userView.php
    - modification de /controller/publicController.php au niveau du commentaire " // si on a cliqué sur le détail d'un utilisateur" ligne ~=61 pour charger 2 fonctions puis la vue "/view/publicView/userView.php"
    - création d'une fonction dans /model/theuserModel.php nommée 
    
    theuserSelectOneById(mysqli $db, int $id): ?array {}
    
    : Elle va récupérer les champs idtheuser, theuserName, theuserLogin de la table theuser ET le champs therightName, therightdesc et therightPerm du rôle lié à cette utilisateur : jointure interne amenant theright. Cette fonction renvoit un tableau associatif ou du NULL

    - création d'une fonction dans '../model/thearticleModel.php' qui va récupérer tous les articles  ordonnés par date DESC et le texte à 250 caractères, avec les rubriques SI elles existent (jointure externe) écrites par un utilisateur via son id

    thearticleSelectAllByTheuserId(mysqli $db, int $iduser): array{}

    Au niveau du publicController

    - Si l'auteur n'existe pas (theuserSelectOneById vide ou null): 
        - Erreur 404 personnalisée

    - Si il existe (theuserSelectOneById est un tableau valide)
        - Charger tous ses articles (/model/thearticleModel.php -> thearticleSelectAllByTheuserId)
            - chargement de la vue /view/publicView/userView.php
            - pas d'article: affichage "Pas encore d'articles pour cet auteur"
            - affichages des articles comme sur la homepage (mais mettre le nom de l'auteur)


*/

// chargement de la configuration
require_once "../config.php";
// chargement du modèle thearticle (ici dans le CF car utilisé partout)
require_once "../model/thearticleModel.php";
// chargement du modèle de thesection
require_once "../model/thesectionModel.php";

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
echo "<!-- $end -->";
