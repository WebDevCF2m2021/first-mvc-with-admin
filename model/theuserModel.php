<?php

function theuserSelectOneById(mysqli $db, int $id): ?array
{
    // on est ICI
    // ici on utilise pas le nom des tables ni des alias (mauvaise pratique) car tous nos champs de nos tables de la DB ont des noms différents
    $sql = "SELECT idtheuser, theuserName, theuserLogin, therightName, therightdesc, therightPerm
            FROM theuser
                INNER JOIN theright
                    ON theright_idtheright = idtheright
            WHERE idtheuser=$id;";
    $request = mysqli_query($db, $sql) or die("Erreur SQL :" . mysqli_error($db));

    return mysqli_fetch_assoc($request);
}
