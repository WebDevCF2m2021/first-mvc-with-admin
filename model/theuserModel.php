<?php

function theuserSelectOneById(mysqli $db, int $id): ?array
{
    // requête
    $sql =
        "SELECT u.idtheuser, u.theuserName, r.therightName
FROM theuser u
INNER JOIN theright r
ON r.idtheright = u.theright_idtheright
WHERE u.idtheuser = $id";


    // récupération des articles, ou affichage de l'erreur SQL et arrêt
    $recup = mysqli_query($db, $sql) or die("Erreur SQL :" . mysqli_error($db));

    return mysqli_fetch_assoc($recup);
}
