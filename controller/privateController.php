<?php


// si on a cliqué sur déconnexion, ou que la session n'est plus valide, on force la déconnexion
if (isset($_GET['disconnect']) || $_SESSION['myID'] != session_id()) {
    theuserDisconnect();
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

        break;
        // redactor    
    case 1:

        break;
        // user (0)
    default:
}
