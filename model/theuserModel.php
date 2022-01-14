<?php

/*
Récupération de tous les utilisateurs pour l'insertion ou la modification d'articles par l'admin
*/
function theuserSelectAll(mysqli $db): array
{
    $sql = "SELECT idtheuser, theuserName, theuserLogin
            FROM theuser ORDER BY theuserName ASC;";
    $request = mysqli_query($db, $sql) or die("Erreur SQL :" . mysqli_error($db));
    return mysqli_fetch_all($request, MYSQLI_ASSOC);
}

/*
Récupération de tous les utilisateurs pour l'affichage par l'admin
*/
function theuserWithRightSelectAll(mysqli $db): array
{
    $sql = "SELECT u.idtheuser, u.theuserName, u.theuserLogin,
                   r.*
            FROM theuser u
                INNER JOIN theright r
                ON u.theright_idtheright = r.idtheright
             ORDER BY u.theuserName ASC;";
    $request = mysqli_query($db, $sql) or die("Erreur SQL :" . mysqli_error($db));
    return mysqli_fetch_all($request, MYSQLI_ASSOC);
}

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

// récupération d'un utilisateur et ses droits grâce à son ID
function theuserSelectOneByIdForAdmin(mysqli $db, int $id): ?array
{
    // ici on utilise pas le nom des tables ni des alias (mauvaise pratique) car tous nos champs de nos tables de la DB ont des noms différents
    $sql = "SELECT idtheuser, theuserName, theuserLogin, theuserPwd, therightName, therightdesc, therightPerm
            FROM theuser
                INNER JOIN theright
                    ON theright_idtheright = idtheright
            WHERE idtheuser=$id;";
    $request = mysqli_query($db, $sql) or die("Erreur SQL :" . mysqli_error($db));

    return mysqli_fetch_assoc($request);
}

/**
 * theuserSelectOneByLogin
 *
 * @param  mysqli $db
 * @param  string $login
 * @param  string $pwd
 * @return bool
 */
function theuserSelectOneByLogin(mysqli $db, string $login, string $pwd): bool
{
    $sql = "SELECT u.idtheuser, u.theuserName, u.theuserLogin,
                   r.therightName, r.therightPerm 
            FROM theuser u
                INNER JOIN theright r
                    ON u.theright_idtheright = r.idtheright
            WHERE u.theuserLogin = '$login' AND u.theuserPwd = '$pwd';";
    $request = mysqli_query($db, $sql) or die("Erreur SQL : " . mysqli_error($db));

    // on vérifie si on a récupéré un utilisateur valide (1 == true, 0 == false)
    if (mysqli_num_rows($request)) {

        // transformation du résultat en tableau associatif
        $result = mysqli_fetch_assoc($request);

        // appel de la fonction qui crée la session (pour l'exemple vers l'OO)
        theuserConnect($result);

        return true;
    } else {
        return false;
    }
}

// fonction d'insertion d'un nouvel utilisateur dans la DB
function theuserInsertWithNameLoginPwdRight(mysqli $db, string $name, string $login, string $pwd, int $right): bool
{
    // requête préparée pour bloquer toutes injections SQL
    $sqlPrepare = mysqli_prepare($db, "INSERT INTO `theuser`(`theuserName`, `theuserLogin`, `theuserPwd`, `theright_idtheright`) VALUES (?,?,?,?)");

    // sssi -> string string string int
    mysqli_stmt_bind_param($sqlPrepare, "sssi", $name, $login, $pwd, $right);

    // rexécution de la reqête
    return mysqli_stmt_execute($sqlPrepare) or die("Erreur SQL :" . mysqli_error($db));
}

// Mise à jour d'un utilisateur grâce à un formulaire (POST) et son id (GET)
function theuserUpdateWithNameLoginPwdRight(mysqli $db, string $name, string $login, string $pwd, int $right, int $id): bool
{

    // préparation de la requête
    $sqlPrepare = mysqli_prepare($db, "UPDATE `theuser` SET `theuserName`=?,`theuserLogin`=?,`theuserPwd`=?,`theright_idtheright`=? WHERE `idtheuser`= ?");

    // application des variables dans le requête sssii -> string string string int int
    mysqli_stmt_bind_param($sqlPrepare, "sssii", $name, $login, $pwd, $right, $id);

    // exécution de la requête
    return mysqli_stmt_execute($sqlPrepare) or die("Erreur SQL :" . mysqli_error($db));
}

// suppression d'un utilisateur si il n'est pas un admin (theright_idtheright != 4)
function theuserDeleteById(mysqli $db, int $iduser): bool
{
    $sql = "DELETE FROM theuser WHERE idtheuser = $iduser AND theright_idtheright != 4";
    mysqli_query($db, $sql) or die("Erreur SQL :" . mysqli_error($db));
    // renvoie le nombre de lignes affectée par la dernière requête (réussite =>1, échec =>0)
    return mysqli_affected_rows($db);
}

// connexion
function theuserConnect(array $user)
{
    $_SESSION = $user;
    $_SESSION['myID'] = session_id();
}

// déconnexion
function theuserDisconnect()
{
    // Détruit toutes les variables de session
    $_SESSION = array();

    // Si vous voulez détruire complètement la session, effacez également
    // le cookie de session.
    // Note : cela détruira la session et pas seulement les données de session !
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    // Finalement, on détruit la session.
    session_destroy();
}
