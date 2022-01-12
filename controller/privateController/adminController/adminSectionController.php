<?php

if (isset($_GET["create"])) {
    require_once "../view/adminView/sectionsCreateAdminView.php";
} else {
    $recupSections = thesectionSelectAllForAdmin($dbConnect);

    require_once "../view/adminView/sectionsAdminView.php";
}
