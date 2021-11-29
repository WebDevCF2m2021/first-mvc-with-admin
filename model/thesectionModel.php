<?php

// fonction qui récupère les sections classées par thesectionTitle ASC, sans thesectionDesc (menu + insert et update)

function thesectionSelectAll(mysqli $db): array {
    $sql = "SELECT idthesection, thesectionTitle
            FROM thesection
            ORDER BY thesectionTitle ASC;";
    $request = mysqli_query($db,$sql) or die("Erreur sql : ".mysqli_error($db));
    return mysqli_fetch_all($request,MYSQLI_ASSOC);
}