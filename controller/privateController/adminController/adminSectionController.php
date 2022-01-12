<?php

if (isset($_GET["create"])) {

    if (isset($_POST["thesectionTitle"])) {
        $title = htmlspecialchars(strip_tags(trim($_POST["thesectionTitle"])), ENT_QUOTES);
        $desc = htmlspecialchars(strip_tags(trim($_POST["thesectionDesc"])), ENT_QUOTES);

        if ($title && $desc) {
            thesectionInsert($dbConnect, $title, $desc);
            header("Location: ./?p=section");
        }
    }

    require_once "../view/adminView/sectionsCreateAdminView.php";
} elseif (isset($_GET["delete"]) && ctype_digit($_GET["delete"]) && !empty($_GET["delete"])) {
    $idsection = (int)$_GET["delete"];

    if (isset($_GET['confirm'])) {
        if (thesectionDeleteById($dbConnect, $idsection)) {
            header("Location: ./?p=section&message=" . "La section ID $idsection supprimée");
        }
    }

    $section = thesectionSelectOne($dbConnect, $idsection);
    require "../view/adminView/sectionsDeleteAdminView.php";
} elseif (isset($_GET["update"]) && ctype_digit($_GET["update"]) && !empty($_GET["update"])) {
    $idsection = (int)$_GET["update"];

    if (isset($_POST["thesectionTitle"])) {
        $title = htmlspecialchars(strip_tags(trim($_POST["thesectionTitle"])), ENT_QUOTES);
        $desc = htmlspecialchars(strip_tags(trim($_POST["thesectionDesc"])), ENT_QUOTES);

        if ($title && $desc) {
            thesectionUpdateById($dbConnect, $title, $desc, $idsection);
            header("Location: ./?p=section");
        }
    }
    $section = thesectionSelectOne($dbConnect, $idsection);
    require "../view/adminView/sectionsUpdateAdminView.php";
} else {
    $recupSections = thesectionSelectAllForAdmin($dbConnect);

    require_once "../view/adminView/sectionsAdminView.php";
}
