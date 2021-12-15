<?php


// si on a cliqué sur déconnexion, ou que la session n'est plus valide, on force la déconnexion
if (isset($_GET['disconnect']) || $_SESSION['myID'] != session_id()) {
    // déconnexion
    theuserDisconnect();
    // redirection
    header("Location: ./");
    exit();
}

// on va charger des contrôleurs différents suivant les permissions
switch ($_SESSION['therightPerm']) {
        // admin
    case 3:
        // chargement du contrôleur de l'admin
        require_once "private/adminController.php";
        break;
        // moderator
    case 2:

        // redactor    
    case 1:

        // user (0)
    default:
        // vue par défaut si non admin (provisoire)
        $error = "Vous n'existez pas encore ! " . $_SESSION['therightName'];
        $recupSection = [];
        require_once "../view/error404View.php";
}
