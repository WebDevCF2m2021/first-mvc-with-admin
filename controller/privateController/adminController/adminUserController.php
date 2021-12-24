<?php

/*
Si on veut supprimer un auteur (cruD)
*/
if (
    isset($_GET['delete']) &&
    ctype_digit($_GET['delete']) &&
    !empty($_GET['delete'])
) {

    $iduser = (int) $_GET['delete'];

    /*

ON EST ICI


    */

    // sélection de l'utilisateur
    $user = theuserSelectOneById($dbConnect, $iduser);

    // Appel de la vue
    require_once "../view/adminView/usersDeleteAdminView.php";

    /*
Sinon on veut afficher tous les auteurs
*/
} else {
    $recupUsers = theuserWithRightSelectAll($dbConnect);
    // appel de la vue (cRud)
    require_once "../view/adminView/usersAdminView.php";
}
