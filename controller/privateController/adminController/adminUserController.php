<?php

/*
Si on veut supprimer un auteur (cruD)
*/
if (isset($_GET['delete']) && ctype_digit($_GET['delete']) && !empty($_GET['delete'])) {

    $iduser = (int) $_GET['delete'];

    if (isset($_GET['confirm'])) {
        if (theuserDeleteById($dbConnect, $iduser)) {
            header("Location: ./?p=user&message=" . "L'utilisateur ID $iduser supprimé");
        } else {
            header("Location: ./?p=user&error=" . "Vous ne pouvez pas supprimer un admin!");
        }
    }

    // sélection de l'utilisateur
    $user = theuserSelectOneById($dbConnect, $iduser);

    if (is_null($user)) {
        $error = "Utilisateur inexistant";
        $recupSection = [];
        require_once "../view/error404View.php";
        die();
    }
    if ($user["therightPerm"] != 3) {
        require_once "../view/adminView/usersDeleteAdminView.php";
    } else {
        header("Location: ./?p=user&error=" . "Vous ne pouvez pas supprimer un admin!");
    }

    /*
Sinon on veut afficher tous les auteurs
*/
} elseif (isset($_GET["create"])) {
    $rights = theRightSelectAll($dbConnect);

    if (isset($_POST["theuserName"])) {
        $name = htmlspecialchars(strip_tags(trim($_POST["theuserName"])), ENT_QUOTES);
        $login = htmlspecialchars(strip_tags(trim($_POST["theuserLogin"])), ENT_QUOTES);
        $pwd = trim($_POST["theuserPwd"]);
        $pwdConfirm = trim($_POST["theuserPwdConfirm"]);
        $right = (int) $_POST["idtheright"];

        if ($pwd !== $pwdConfirm) {
            $error = "Vos mots de passe ne correspondent pas!";
        } else {
            if ($name && $login && $pwd && $right) {
                theuserInsertWithNameLoginPwdRight($dbConnect, $name, $login, $pwd, $right);
                header("Location: ./?p=user");
            } else {
                $error = "L'insertion ne s'est pas effectuée, veuillez recommencer.";
            }
        }
    }
    require_once "../view/adminView/usersCreateAdminView.php";
} elseif (isset($_GET['update']) && ctype_digit($_GET['update']) && !empty($_GET['update'])) {
    $iduser = (int) $_GET['update'];
    $rights = theRightSelectAll($dbConnect);
    $user = theuserSelectOneByIdForAdmin($dbConnect, $iduser);

    if (isset($_POST["theuserName"])) {
        $name = htmlspecialchars(strip_tags(trim($_POST["theuserName"])), ENT_QUOTES);
        $login = htmlspecialchars(strip_tags(trim($_POST["theuserLogin"])), ENT_QUOTES);
        $pwd = trim($_POST["theuserPwd"]);
        $pwdConfirm = trim($_POST["theuserPwdConfirm"]);
        $right = (int) $_POST["idtheright"];

        if ($pwd !== $pwdConfirm) {
            $error = "Vos mots de passe ne correspondent pas!";
        } else {
            if ($name && $login && $pwd && $right) {
                theuserUpdateWithNameLoginPwdRight($dbConnect, $name, $login, $pwd, $right, $iduser);
                header("Location: ./?p=user");
            } else {
                $error = "L'insertion ne s'est pas effectuée, veuillez recommencer.";
            }
        }
    }

    if ($user["idtheuser"] != $_SESSION["idtheuser"]) {
        require_once "../view/adminView/usersUpdateAdminView.php";
    } else {
        header("Location: ./?p=user&error=" . "Vous ne pouvez pas vous modifier!");
    }
} else {
    $recupUsers = theuserWithRightSelectAll($dbConnect);
    // appel de la vue (cRud)
    require_once "../view/adminView/usersAdminView.php";
}
