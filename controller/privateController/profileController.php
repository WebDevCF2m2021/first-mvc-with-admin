<?php

$user = theuserSelectOneByIdForAdmin($dbConnect, $_SESSION["idtheuser"]);

if (isset($_POST["theuserName"])) {
    $name = htmlspecialchars(strip_tags(trim($_POST["theuserName"])), ENT_QUOTES);
    $login = htmlspecialchars(strip_tags(trim($_POST["theuserLogin"])), ENT_QUOTES);
    $pwd = trim($_POST["theuserPwd"]);
    $pwdConfirm = trim($_POST["theuserPwdConfirm"]);

    if ($pwd !== $pwdConfirm) {
        $error = "Vos mots de passe ne correspondent pas!";
    } else {
        if ($name && $login && $pwd) {
            theuserUpdateWithNameLoginPwd($dbConnect, $name, $login, $pwd, $_SESSION["idtheuser"]);
            header("Location: ./?p=user");
        } else {
            $error = "L'insertion ne s'est pas effectuée, veuillez recommencer.";
        }
    }
}

require "../view/privateView/updateUserProfileView.php";
