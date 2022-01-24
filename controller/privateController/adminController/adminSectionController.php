<?php
/*
 si on veut créer une nouvelle section (Crud)
 */
if (isset($_GET['create'])) {


    /*
 si on veut créer mettre à jour une section (crUd)
 */
} elseif (isset($_GET['update']) && ctype_digit($_GET["update"]) && !empty($_GET["update"])) {

    /*
 Sinon si on veut supprimer une section (cruD)  
 */
} elseif (isset($_GET['delete']) && ctype_digit($_GET["delete"]) && !empty($_GET["delete"])) {

    /*
 sinon affichages de toutes les sections (cRud)
 */
} else {
    // variables qui va contenir toutes les sections
    $recupSections = thesectionSelectAllWithDesc($dbConnect);
    // Appel de la vue
    require_once "../view/adminView/sectionsAdminView.php";
}
