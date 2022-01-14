<?php

// chargement du modèle de theright pour le "create" et l' "update"
require_once "../model/therightModel.php";

/*

Si on veut supprimer un auteur (cruD)

DELETE 
*/
// si la variable get 'delete' est définie ET qu'elle est une chaîne de caractère qui ne contient que des numériques entiers positifs ET qu'elle est différente de vide (pour le 0) 
if (isset($_GET['delete']) && ctype_digit($_GET['delete']) && !empty($_GET['delete'])) {

    // trabstypage de string to int
    $iduser = (int) $_GET['delete'];

    // si il existe confirm (on a cliqué sur OUI)
    if (isset($_GET['confirm'])) {
        // suppression de l'utilisateur
        if (theuserDeleteById($dbConnect, $iduser)) {
            header("Location: ./?p=user&message=" . "L'utilisateur ID $iduser supprimé");
            exit;
        } else {
            header("Location: ./?p=user&error=" . "Vous ne pouvez pas supprimer un admin!");
            exit;
        }
    }

    // sélection de l'utilisateur
    $user = theuserSelectOneById($dbConnect, $iduser);

    // pas d'utilisateur = erreur 404
    if (is_null($user)) {
        $error = "Utilisateur inexistant";
        $recupSection = [];
        require_once "../view/error404View.php";
        die();
    }
    // si on veut supprimer un admin
    if ($user["therightPerm"] != 3) {
        // Appel de la vue de confirmation
        require_once "../view/adminView/usersDeleteAdminView.php";
    } else {
        // on ne peut pas supprimer un admin
        header("Location: ./?p=user&error=" . "Vous ne pouvez pas supprimer un admin!");
        die;
    }

    /*

    Sinon on veut créer un auteur

    */
} elseif (isset($_GET["create"])) {

    // chargement de tous les droits disponibles pour un nouvel utilisateur
    $rights = theRightSelectAll($dbConnect);

    // si on a envoyé le formulaire
    if (isset($_POST["theuserName"])) {
        // protection des données
        $name = htmlspecialchars(strip_tags(trim($_POST["theuserName"])), ENT_QUOTES);
        $login = htmlspecialchars(strip_tags(trim($_POST["theuserLogin"])), ENT_QUOTES);
        // récupération des 2 mots de passe, utilisation seulement du trim pour permettre l'utilisation de caractères spéciaux dans le mot de passe (! il faudra une requête préparée pour éviter une injection SQL)
        $pwd = trim($_POST["theuserPwd"]);
        $pwdConfirm = trim($_POST["theuserPwdConfirm"]);

        // récupération du droit
        $right = (int) $_POST["idtheright"];

        // vérification que les 2 mots de passe ne sont pas les mêmes
        if ($pwd !== $pwdConfirm) {
            // création de l'erreur
            $error = "Vos mots de passe ne correspondent pas!";
        } else {
            // les champs sont valides
            if ($name && $login && $pwd && $right) {
                // Insertion dans le DB (! vérification pour le login Duplicate à faire)
                theuserInsertWithNameLoginPwdRight($dbConnect, $name, $login, $pwd, $right);
                // redirection
                header("Location: ./?p=user");
                exit();
            } else {
                $error = "L'insertion ne s'est pas effectuée, veuillez recommencer.";
            }
        }
    }
    // Appel de la vue
    require_once "../view/adminView/usersCreateAdminView.php";

    /*

    Sinon on veut modifier un auteur

    UPDATE

    */

    // sinon si la variable get 'update' est définie ET qu'elle est une chaîne de caractère qui ne contient que des numériques entiers positifs ET qu'elle est différente de vide (pour le 0)  
} elseif (isset($_GET['update']) && ctype_digit($_GET['update']) && !empty($_GET['update'])) {

    // transformation de string vers integer
    $iduser = (int) $_GET['update'];
    // chargement de tous les droits disponibles pour un nouvel utilisateur
    $rights = theRightSelectAll($dbConnect);
    // récupération d'un utilisateur et ses droits grâce à son ID
    $user = theuserSelectOneByIdForAdmin($dbConnect, $iduser);

    // si on a cliqué modifié
    if (isset($_POST["theuserName"])) {
        // protection des champs
        $name = htmlspecialchars(strip_tags(trim($_POST["theuserName"])), ENT_QUOTES);
        $login = htmlspecialchars(strip_tags(trim($_POST["theuserLogin"])), ENT_QUOTES);
        $pwd = trim($_POST["theuserPwd"]);
        $pwdConfirm = trim($_POST["theuserPwdConfirm"]);
        $right = (int) $_POST["idtheright"];

        // les 2 mots de passe ne sont pas les mêmes
        if ($pwd !== $pwdConfirm) {

            $error = "Vos mots de passe ne correspondent pas!";

            // les 2 mots de passe sont les mêmes
        } else {

            // Et nos variables sont "acceptables" (pas vides)
            if ($name && $login && $pwd && $right) {

                // Mise à jour de l'utilisateur
                theuserUpdateWithNameLoginPwdRight($dbConnect, $name, $login, $pwd, $right, $iduser);
                // redirection
                header("Location: ./?p=user");
                exit;
            } else {
                $error = "L'insertion ne s'est pas effectuée, veuillez recommencer.";
            }
        }
    }

    if (!is_null($user)) {
        // si l'utilisateur dans la DB n'est pas l'utilisateur connecté (impossible de se modifier soi-même)
        if ($user["idtheuser"] != $_SESSION["idtheuser"]) {
            // Affichage de la vue du formulaire rempli avec les données de l'utilisateur venant de la DB
            require_once "../view/adminView/usersUpdateAdminView.php";
        } else {
            // redirection si on essaie de se modifier soi-même
            header("Location: ./?p=user&error=" . "Vous ne pouvez pas vous modifier!");
        }
    } else {
        $error = "Utilisateur inexistant";
        $recupSection = [];
        require_once "../view/error404View.php";
        die();
    }
    /*

    Sinon on affiche la liste des utilisateurs

    READ

    */
} else {
    // sélection de tous les utilisateurs
    $recupUsers = theuserWithRightSelectAll($dbConnect);
    // appel de la vue (cRud)
    require_once "../view/adminView/usersAdminView.php";
}
