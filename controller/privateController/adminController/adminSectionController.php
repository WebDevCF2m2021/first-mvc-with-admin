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

        // insertion
        $insert = thesectionCreate($dbConnect, $title, $desc);

        // si l'insertion est réussie
        if ($insert) {
            // redirection
            header("Location: ./?p=section");
            die();
        }
    }

    // Appel de la vue
    require_once "../view/adminView/sectionsCreateAdminView.php";


    /*
 si on veut créer mettre à jour une section (crUd)
 */
} elseif (isset($_GET['update']) && ctype_digit($_GET["update"]) && !empty($_GET["update"])) {

    $id = (int) $_GET["update"];

    // si on a cliqué sur envoyer
    if (isset($_POST['thesectionTitle'])) {
        // traîtement des variables
        $id = (int) $_POST['idthesection'];
        $title = htmlspecialchars(strip_tags(trim($_POST['thesectionTitle'])), ENT_QUOTES);
        $desc = htmlspecialchars(strip_tags(trim($_POST['thesectionDesc'])), ENT_QUOTES);

        // titre non valide
        if (empty($title)) {
            $error = "Titre non valide";
        }
        // modification
        elseif (thesectionUpdateById($dbConnect, $title, $desc, $id)) {
            // redirection
            header("Location: ./?p=section");
            die();
        }
    }

    $item = thesectionSelectOne($dbConnect, $id);
    // Appel de la vue
    require_once "../view/adminView/sectionsUpdateAdminView.php";

    /*
 Sinon si on veut supprimer une section (cruD)  
 */
} elseif (isset($_GET['delete']) && ctype_digit($_GET["delete"]) && !empty($_GET["delete"])) {

    // transtypage en int
    $delete = (int) $_GET['delete'];

    // on valide la suppression
    if (isset($_GET['confirm'])) {
        // si ça a fonctionné
        if (thesectionDeleteById($dbConnect, $delete)) {
            // redirection
            header("location: ./?p=section");
            exit();
        }
    }

    // récupération de la section
    $item = thesectionSelectOne($dbConnect, $delete);

    // Appel de la vue
    require_once "../view/adminView/sectionsDeleteAdminView.php";


    /*
 sinon affichages de toutes les sections (cRud)
 */
} else {
    // variables qui va contenir toutes les sections
    $recupSections = thesectionSelectAllWithDesc($dbConnect);
    // Appel de la vue
    require_once "../view/adminView/sectionsAdminView.php";
}
