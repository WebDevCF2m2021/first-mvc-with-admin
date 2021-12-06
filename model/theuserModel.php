<?php
/*
récupération d'un utilisateur et ses droit par son id, si on le trouve, on reçoit un tableau associatif (array) sinon ce return renvoit NULL: donc le ?array nous permets en PHP7 de récupérer OU un array ou null
*/
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
