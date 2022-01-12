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
} else {
    $recupSections = thesectionSelectAllForAdmin($dbConnect);

    require_once "../view/adminView/sectionsAdminView.php";
}
