<?php
/*
 si on veut créer une nouvelle section (Crud)
 */
if (isset($_GET['create'])) {

    //var_dump($_POST);

    // si le formulaire est envoyé
    if (isset($_POST['thesectionTitle'])) {

        // traîtement des variables
        $title = htmlspecialchars(strip_tags(trim($_POST['thesectionTitle'])), ENT_QUOTES);
        $desc = htmlspecialchars(strip_tags(trim($_POST['thesectionDesc'])), ENT_QUOTES);

        // titre non valide
        if (empty($title)) {
            $error = "Titre non valide";
            require_once "../view/adminView/sectionsCreateAdminView.php";
            exit();
        }
    }

    // Appel de la vue
    require_once "../view/adminView/sectionsCreateAdminView.php";


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
