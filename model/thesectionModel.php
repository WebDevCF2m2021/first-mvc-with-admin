<?php

// fonction qui récupère les sections classées par thesectionTitle ASC, sans thesectionDesc (menu + insert et update)

function thesectionSelectAll(mysqli $db): array
{
    $sql = "SELECT idthesection, thesectionTitle
            FROM thesection
            ORDER BY thesectionTitle ASC;";
    $request = mysqli_query($db, $sql) or die("Erreur sql : " . mysqli_error($db));
    return mysqli_fetch_all($request, MYSQLI_ASSOC);
}

function thesectionSelectAllForAdmin(mysqli $db): array
{
    $sql = "SELECT *
            FROM thesection
            ORDER BY idthesection;";
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

function thesectionInsert(mysqli $db, string $title, string $desc): bool
{
    $sql = mysqli_prepare($db, "INSERT INTO `thesection` (`thesectionTitle`, `thesectionDesc`) VALUES (?, ?);");

    mysqli_stmt_bind_param($sql, "ss", $title, $desc);

    return mysqli_stmt_execute($sql) or die("Erreur SQL :" . mysqli_error($db));
}

function thesectionUpdateById(mysqli $db, string $title, string $desc, int $idsection): bool
{
    $sql = mysqli_prepare($db, "UPDATE `thesection` SET `thesectionTitle`= ?,`thesectionDesc`= ? WHERE `idthesection`= ?");

    mysqli_stmt_bind_param($sql, "ssi", $title, $desc, $idsection);

    return mysqli_stmt_execute($sql) or die("Erreur SQL :" . mysqli_error($db));
}

function thesectionDeleteById(mysqli $db, int $idsection): bool
{
    $sql = mysqli_prepare($db, "DELETE FROM thesection WHERE idthesection = ?");
    mysqli_stmt_bind_param($sql, "i", $idsection);
    return mysqli_stmt_execute($sql) or die("Erreur SQL :" . mysqli_error($db));
}
