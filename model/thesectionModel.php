<?php


/*

READ

*/

// fonction qui récupère les sections classées par thesectionTitle ASC, sans thesectionDesc (menu + insert et update)

function thesectionSelectAll(mysqli $db): array
{
    $sql = "SELECT idthesection, thesectionTitle
            FROM thesection
            ORDER BY thesectionTitle ASC;";
    $request = mysqli_query($db, $sql) or die("Erreur sql : " . mysqli_error($db));
    return mysqli_fetch_all($request, MYSQLI_ASSOC);
}

// fonction qui récupère tous les champs des sections classées par thesectionTitle ASC, pour l'update et le Read, create et delete de thesection

function thesectionSelectAllWithDesc(mysqli $db): array
{
    $sql = "SELECT *
            FROM thesection
            ORDER BY thesectionTitle ASC;";
    $request = mysqli_query($db, $sql) or die("Erreur sql : " . mysqli_error($db));
    return mysqli_fetch_all($request, MYSQLI_ASSOC);
}

// fonction qui récupère une section grâce son id, arguments obligatoires ($db en mysqli, $id en int) et retour obligatoir un tableau (array) ou en PHP 7 un tableau ou null (?array)

function thesectionSelectOne(mysqli $db, int $id): ?array
{
    $sql = "SELECT idthesection, thesectionTitle, thesectionDesc
            FROM thesection
            WHERE idthesection = $id";
    $request = mysqli_query($db, $sql) or die("Erreur sql : " . mysqli_error($db));

    // si on a un résultat (la section existe) envoi d'un tableau associatif ou null si il est vide
    return mysqli_fetch_assoc($request);
}

/*

CREATE

*/

/**
 * Ïnsertion dans la table thesection
 */
function thesectionCreate(mysqli $db, string $theTitle, string $theDesc): bool
{

    // requête préparée
    $sql = "INSERT INTO `thesection` (`thesectionTitle`,`thesectionDesc`) VALUES (?,?)";
    // préparation réelle de la requête
    $sqlPrepare = mysqli_prepare($db, $sql);
    // attribution des valeurs (ss => string, string)
    mysqli_stmt_bind_param($sqlPrepare, "ss", $theTitle, $theDesc);
    // exécution de la requête préparée
    return mysqli_stmt_execute($sqlPrepare) or die("Erreur SQL :" . mysqli_error($db));
}

/*


DELETE


*/
// suppression d'une section de la table section
function thesectionDeleteById(mysqli $db, int $idsection): bool
{
    $sql = mysqli_prepare($db, "DELETE FROM thesection WHERE idthesection=?");
    mysqli_stmt_bind_param($sql, "i", $idsection);
    return mysqli_stmt_execute($sql) or die("Erreur SQL :" . mysqli_error($db));
}

/*


UPDATE


*/
// modification d'une section de la table section
function thesectionUpdateById(mysqli $db, string $title, string $desc, int $idsection): bool
{
    $sql = mysqli_prepare($db, "UPDATE `thesection` SET `thesectionTitle`= ?,`thesectionDesc`= ? WHERE `idthesection`= ?");
    mysqli_stmt_bind_param($sql, "ssi", $title, $desc, $idsection);
    return mysqli_stmt_execute($sql) or die("Erreur SQL :" . mysqli_error($db));
}
