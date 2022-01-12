<?php

// création des fonctions liées à la gestion de la table thearticle

/**
 * thearticleSelectAllByTheuserId
 *
 * @param  mysqli $db
 * @param  int $iduser
 * @return array
 */
function thearticleSelectAllByTheuserId(mysqli $db, int $iduser): array
{
    // requête, ici la jointure avec theuser n'est pas nécessaire (pris dans une autre requête), comme l'id de l'utilisateur se trouve déjà dans la table thearticle (thearticle_idthearticle 1->m), on peut mettre dans le WHERE : "a.theuser_idtheuser = $iduser"
    $sql = " SELECT a.idthearticle, a.thearticleTitle, LEFT(a.thearticleText,250) AS thearticleText, a.thearticleDate, 
# u.idtheuser, u.theuserName, u.theuserLogin,	
                  GROUP_CONCAT(s.idthesection) AS idthesection, 
                  GROUP_CONCAT(s.thesectionTitle SEPARATOR '|||') AS thesectionTitle
FROM thearticle a
#INNER JOIN theuser u
#ON a.theuser_idtheuser = u.idtheuser 
  LEFT JOIN thearticle_has_thesection h
      ON a.idthearticle = h.thearticle_idthearticle
  LEFT JOIN thesection s
      ON h.thesection_idthesection = s.idthesection
WHERE a.thearticleStatus = 1 AND a.theuser_idtheuser = $iduser
  GROUP BY a.idthearticle
  ORDER BY a.thearticleDate DESC;  ";

    $request = mysqli_query($db, $sql) or die("Erreur SQL : " . mysqli_error($db));

    return mysqli_fetch_all($request, MYSQLI_ASSOC);
}

/**
 * thearticleSelectOneById
 * 
 * récupération d'un article complet (tant qu'ils ont un auteur et sont publiés) avec auteur et sections incluses
 * 
 * si l'id du tableau envoyer vaut null, l'article n'a pas été trouvé : (is_null($array('idthearticle')))
 *
 * @param  mysqli $db
 * @param  int $idarticle
 * @return array
 * 
 */
function thearticleSelectOneById(mysqli $db, int $idarticle): array
{
    // requête de sélection d'un article par son id, avec ses rubriques classées par ordre alphabétique (! dans le GROUP_CONCAT, il faut les même ORDER BY pour les colonnes venant de la même table!). Comme on ne peut avoir qu'un (ou 0) résultat, le GROUP BY est inutile
    $sql = " SELECT a.idthearticle, a.thearticleTitle, a.thearticleText, a.thearticleDate,
                    u.idtheuser, u.theuserName, u.theuserLogin,	
                    GROUP_CONCAT(s.idthesection ORDER BY s.thesectionTitle ASC) AS idthesection, 
                    GROUP_CONCAT(s.thesectionTitle ORDER BY s.thesectionTitle ASC SEPARATOR '|||') AS thesectionTitle
             FROM thearticle a
                INNER JOIN theuser u
                ON a.theuser_idtheuser = u.idtheuser 
            LEFT JOIN thearticle_has_thesection h
                ON a.idthearticle = h.thearticle_idthearticle
            LEFT JOIN thesection s
                ON h.thesection_idthesection = s.idthesection
            WHERE a.thearticleStatus = 1 AND a.idthearticle = $idarticle;";

    // récupération d'un article (ou d'aucun), ou affichage de l'erreur SQL et arrêt
    $recup = mysqli_query($db, $sql) or die("Erreur SQL :" . mysqli_error($db));

    return mysqli_fetch_assoc($recup);
}

/**
 * thearticleAdminSelectOneById
 * 
 * récupération d'un article complet avec auteur et sections incluses
 * 
 * si l'id du tableau envoyer vaut null, l'article n'a pas été trouvé : (is_null($array('idthearticle')))
 *
 * @param  mysqli $db
 * @param  int $idarticle
 * @return array
 * 
 */
function thearticleAdminSelectOneById(mysqli $db, int $idarticle): array
{
    // requête de sélection d'un article par son id, avec ses rubriques classées par ordre alphabétique (! dans le GROUP_CONCAT, il faut les même ORDER BY pour les colonnes venant de la même table!). Comme on ne peut avoir qu'un (ou 0) résultat, le GROUP BY est inutile
    $sql = " SELECT a.idthearticle, a.thearticleTitle, a.thearticleText, a.thearticleDate, a.thearticleStatus,
                    u.idtheuser, u.theuserName,	
                    GROUP_CONCAT(s.idthesection ORDER BY s.thesectionTitle ASC) AS idthesection, 
                    GROUP_CONCAT(s.thesectionTitle ORDER BY s.thesectionTitle ASC SEPARATOR '|||') AS thesectionTitle
             FROM thearticle a
                LEFT JOIN theuser u
                ON a.theuser_idtheuser = u.idtheuser 
            LEFT JOIN thearticle_has_thesection h
                ON a.idthearticle = h.thearticle_idthearticle
            LEFT JOIN thesection s
                ON h.thesection_idthesection = s.idthesection
            WHERE a.idthearticle = $idarticle;";

    // récupération d'un article (ou d'aucun), ou affichage de l'erreur SQL et arrêt
    $recup = mysqli_query($db, $sql) or die("Erreur SQL :" . mysqli_error($db));

    return mysqli_fetch_assoc($recup);
}

function thearticleAdminDeleteById(mysqli $db, int $idarticle): bool
{
    $sql = "DELETE FROM thearticle WHERE idthearticle = $idarticle";
    return mysqli_query($db, $sql) or die("Erreur SQL :" . mysqli_error($db));
}

/**
 * thearticleAdminSelectOneByIdForDelete
 *
 * Sélection minimale pour approuver la suppression d'un article (Admin uniquement)
 * 
 * @param  mysqli $db
 * @param  int $idarticle
 * @return array|NULL
 */
function thearticleAdminSelectOneByIdForDelete(mysqli $db, int $idarticle): ?array
{
    // requête de sélection d'un article par son id avec les champs minimaux
    $sql = " SELECT idthearticle, thearticleTitle, thearticleText, thearticleDate
             FROM thearticle 
                WHERE idthearticle = $idarticle;";

    // récupération d'un article (ou d'aucun), ou affichage de l'erreur SQL et arrêt
    $recup = mysqli_query($db, $sql) or die("Erreur SQL :" . mysqli_error($db));

    return mysqli_fetch_assoc($recup);
}

/*
Insertion d'un article avec son auteur et ses section
*/
/**
 * thearticleInsertWithUserAndSection
 *
 * @param  mysqli $db
 * @param  string $title
 * @param  string $text
 * @param  int $status
 * @param  int $iduser
 * @param  array $idsection
 * @return bool
 */
function thearticleInsertWithUserAndSection(mysqli $db, string $title, string $text, int $status, int $iduser, array $idsection): bool
{
    // insertion d'article
    $sql = "INSERT INTO thearticle (`thearticleTitle`,`thearticleText`,`thearticleStatus`,`theuser_idtheuser`) VALUES ('$title','$text',$status,$iduser);";

    $request = mysqli_query($db, $sql) or die("Erreur SQL :" . mysqli_error($db));

    // insertion ok
    if ($request && !empty($idsection)) {
        // récupération du dernier inséré par cette connexion (nous donc)
        $idarticle = mysqli_insert_id($db);

        // $sql pour la jointure entre article et section
        $sql = "INSERT INTO `thearticle_has_thesection` (`thearticle_idthearticle`,`thesection_idthesection`) values ";

        // tant qu'on a des sections (au moins une)
        foreach ($idsection as $item) {
            $item = (int) $item;
            $sql .= "($idarticle,'$item'),";
        }
        $sqlok = substr($sql, 0, -1);
        $insert_join = mysqli_query($db, $sqlok)  or die("Erreur SQL :" . mysqli_error($db));

        return $insert_join;
    }
    return true;
}

// récupération de tous les articles par date DESC pour la page d'accueil (tant qu'ils ont un auteur et sont publiés), avec un texte de 250 caractères, avec auteurs et sections incluses
function thearticleHomepageSelectAll(mysqli $db): array
{
    // requête
    $sql = " SELECT a.idthearticle, a.thearticleTitle, LEFT(a.thearticleText,250) AS thearticleText, a.thearticleDate,
    u.idtheuser, u.theuserName, u.theuserLogin,	
                  GROUP_CONCAT(s.idthesection) AS idthesection, 
                  GROUP_CONCAT(s.thesectionTitle SEPARATOR '|||') AS thesectionTitle
FROM thearticle a
  INNER JOIN theuser u
      ON a.theuser_idtheuser = u.idtheuser 
  LEFT JOIN thearticle_has_thesection h
      ON a.idthearticle = h.thearticle_idthearticle
  LEFT JOIN thesection s
      ON h.thesection_idthesection = s.idthesection
WHERE a.thearticleStatus = 1
  GROUP BY a.idthearticle
  ORDER BY a.thearticleDate DESC;  ";

    // récupération des articles, ou affichage de l'erreur SQL et arrêt
    $recup = mysqli_query($db, $sql) or die("Erreur SQL :" . mysqli_error($db));

    return mysqli_fetch_all($recup, MYSQLI_ASSOC);
}


// récupération de tous les articles par date DESC pour la page d'accueil, avec un texte de 250 caractères, avec auteurs et sections incluses
function thearticleAdminSelectAll(mysqli $db): array
{
    // requête
    $sql = " SELECT a.idthearticle, a.thearticleTitle, LEFT(a.thearticleText,250) AS thearticleText, a.thearticleDate, a.thearticleStatus,
    u.idtheuser, u.theuserName, u.theuserLogin,	
                  GROUP_CONCAT(s.idthesection) AS idthesection, 
                  GROUP_CONCAT(s.thesectionTitle SEPARATOR '|-*-|') AS thesectionTitle
FROM thearticle a
  LEFT JOIN theuser u
      ON a.theuser_idtheuser = u.idtheuser 
  LEFT JOIN thearticle_has_thesection h
      ON a.idthearticle = h.thearticle_idthearticle
  LEFT JOIN thesection s
      ON h.thesection_idthesection = s.idthesection
  GROUP BY a.idthearticle
  ORDER BY a.thearticleDate DESC;  ";

    // récupération des articles, ou affichage de l'erreur SQL et arrêt
    $recup = mysqli_query($db, $sql) or die("Erreur SQL :" . mysqli_error($db));

    return mysqli_fetch_all($recup, MYSQLI_ASSOC);
}

// récupération de tous les articles par date DESC pour la page section (tant qu'ils ont un auteur et sont publiés), avec un texte de 250 caractères, avec auteurs et sections incluses SI l'article se trouve dans la section
function thearticleSectionSelectAll(mysqli $db, int $idsection): array
{
    // requête
    $sql = " SELECT a.idthearticle, a.thearticleTitle, LEFT(a.thearticleText,250) AS thearticleText, a.thearticleDate,
    u.idtheuser, u.theuserName, u.theuserLogin,	
# Au lieu de prendre la jointure où le WHERE ne permet d'avoir qu'une section
# On va prendre s2 qui est une jointure sœur mais avec un autre alias
                  GROUP_CONCAT(s2.idthesection) AS idthesection, 
                  GROUP_CONCAT(s2.thesectionTitle SEPARATOR '|||') AS thesectionTitle
FROM thearticle a
  INNER JOIN theuser u
      ON a.theuser_idtheuser = u.idtheuser 

# jointure pour récupérer les articles de la section
  LEFT JOIN thearticle_has_thesection h
      ON a.idthearticle = h.thearticle_idthearticle
  LEFT JOIN thesection s
      ON h.thesection_idthesection = s.idthesection

# jointure équivalente mais sans lien avec le WHERE qui nous permet de 
# récupérer toutes les sections dans lesquelles se trouve l'article
  LEFT JOIN thearticle_has_thesection h2
      ON a.idthearticle = h2.thearticle_idthearticle
  LEFT JOIN thesection s2
      ON h2.thesection_idthesection = s2.idthesection 

# condition qui récupère les articles de la section
WHERE a.thearticleStatus = 1 AND s.idthesection = $idsection
  GROUP BY a.idthearticle
  ORDER BY a.thearticleDate DESC;  ";

    // récupération des articles, ou affichage de l'erreur SQL et arrêt
    $recup = mysqli_query($db, $sql) or die("Erreur SQL :" . mysqli_error($db));

    return mysqli_fetch_all($recup, MYSQLI_ASSOC);
}

// changement de visibilité d'article pour la gestion de ceux-ci sur l'administration de ?p=article en one click
function thearticleValidationById(mysqli $db, int $idarticle, bool $validation)
{
    // requête
    $sql = "UPDATE `thearticle` SET `thearticleStatus`= " . (int) $validation . " WHERE `idthearticle` = $idarticle;";

    mysqli_query($db, $sql) or die("Erreur SQL :" . mysqli_error($db));
}


/**
 * thearticleAdminUpdateById
 *
 * En va faire une requête préparée en mysqli procédurale (rare en procédural, très fréquent en OO - Orienté objet) pour éviter toutes injection SQL, mais sans vérifier de manière stricte les valeurs
 * 
 * @param  mysqli $db
 * @param  array $datas
 * @return bool
 */
function thearticleAdminUpdateById(mysqli $db, array $datas): bool
{

    $datas['thearticleTitle'] = htmlspecialchars(strip_tags(trim($datas['thearticleTitle'])), ENT_QUOTES);
    $datas['thearticleText'] = htmlspecialchars(strip_tags(trim($datas['thearticleText'])), ENT_QUOTES);
    $datas['thearticleDate'] = date("Y-m-d H:i:s", strtotime($datas['thearticleDate']));
    // Requête préparée, elle empèche les injections SQL, mais n'est généralement pas suffisante pour éviter les bugs et/ou manipulations non désirées d'utilisateurs malveillants. Cependant il ya a une règle de base:
    // Toute requête avec ne serait-ce qu'une entrée utilisateur DOIT toujours être une requête préparée
    $sqlPrepare = mysqli_prepare($db, "UPDATE `thearticle` SET  
    `thearticleTitle`=?,
    `thearticleDate`=?,
    `thearticleStatus`= ?,
    `thearticleText`=?, 
    `theuser_idtheuser`=?

     WHERE `idthearticle` = ?;");

    mysqli_stmt_bind_param($sqlPrepare, "ssisii", $datas['thearticleTitle'], $datas['thearticleDate'], $datas['thearticleStatus'], $datas['thearticleText'], $datas['theuser_idtheuser'], $datas['idthearticle']);

    mysqli_stmt_execute($sqlPrepare) or die("Erreur SQL :" . mysqli_error($db));

    // quoi qu'il arrive, on doit supprimer le lien (m2m) vers les anciennes sections de la base de données liées avec l'article actuel (on a par exemple décoché toutes les sections de l'article)
    $sql = "DELETE FROM `thearticle_has_thesection` WHERE `thearticle_idthearticle` = ?";
    $sqlPrepare2 = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($sqlPrepare2, "i", $datas['idthearticle']);

    mysqli_stmt_execute($sqlPrepare2) or die("Erreur SQL :" . mysqli_error($db));

    // Si on a coché une section (au moins)
    if (isset($datas['idthesection']) && is_array($datas['idthesection'])) {

        // transformation de notre id en integer
        $idarticle = (int) $datas['idthearticle'];

        // début de la requête préparée
        $sql = "INSERT INTO thearticle_has_thesection (`thearticle_idthearticle`,`thesection_idthesection`) VALUES ";

        // tant qu'on a des sections, on concatène notre requête SQL (pour n'envoyer qu'une requête et donc gagner en rapidité d'exécution)
        foreach ($datas['idthesection'] as $value) {
            $idsection = (int) $value;
            $sql .= "($idarticle, $idsection),";
        }
        // attention, pour éviter l'erreur SQL , on retir la dernière virgule avec substr
        $sql = substr($sql, 0, -1);
        mysqli_query($db, $sql)  or die("Erreur SQL :" . mysqli_error($db));
    }

    return true;
}

/**
 * cuteTheText
 *
 * @param  mixed $text
 * @param  mixed $length
 * @return string
 * coupe sans couper les mots
 */
function cuteTheText(string $text, int $length = 255): string
{
    if (strlen($text) > $length) { //si le texte est plus grand que $length
        $text = substr($text, 0, $length); // couper le text à la valeur donnée dans la fonction
        $int = strrpos($text, ' '); // retourne le dernier espace sur la phrase coupée (int)
        $text = substr($text, 0, $int); //coupe au dernier espace
        return $text . " ..."; //retourne la phrase en concaténant "..."
    } else {
        return $text; //retourne le texte initiale
    }
    // idem en ternaire
    return strlen($text) > $length ? substr($text, 0, strrpos(substr($text, 0, $length), ' ')) . " ..." : $text;
}

/**
 * frenchDate
 * 
 * Permet de transformer une date au format datetime (en français YYYY-MM-JJ HH:MM:SS - en date("Y-m-d H:i/s"))
 * 
 * Si le paramètre est 1, le résultat de 
 * 2019-07-15 09:11:05 sera ... "lundi 15 juillet 2019 à 09:11"
 * 
 * Si le paramètre vaut 2, le résultat de 
 * 2019-07-15 09:11:05 sera ... "15 juillet 2019 à 09h11"
 * 
 * Si le paramètre vaut 3, le résultat de 
 * 2019-07-15 09:11:05 sera ... "lundi 15 juillet 2019 à 9 heures" (si <= 1 heure -> pas de s à heure !!!)
 * 
 * @param  String $date
 * @return String
 */
function frenchDate($date, $format = 1)
{

    // sortie
    $out = "";

    // Les jours en français
    $joursTab = ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"];

    // Les mois en français, on le fait commencer à 1, car l'expression "n" de date nous donne les mois de 1 (janvier) à 12 (décembre)
    $moisTab = [1 => "janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"];

    // transformation de la date en Timestamp (secondes depuis le 1/1/1970 )
    $date = strtotime($date);

    // En switch (vérification d'égalité non stricte "==")
    switch ($format) {

        case 1:
            $out .=  $joursTab[date("w", $date)] . " " // jour de la semaine en français
                . date("d", $date) . " " // chiffre du jour
                . $moisTab[date("n", $date)] . " " // mois en français
                . date("Y à H:i", $date); // année / heures / minutes
            break;

        case 2:
            $out .=  date("d", $date) . " " // chiffre du jour
                . $moisTab[date("n", $date)] . " " // mois en français
                . date("Y à H\hi", $date); // antislash pour éviter l'interprétation de h
            break;
        case 3:
            $out .=  $joursTab[date("w", $date)] . " " // jour de la semaine en français
                . date("d", $date) . " " // chiffre du jour
                . $moisTab[date("n", $date)] . " " // mois en français
                . date("Y à ", $date); // année
            // vérification pour le "s" de heure (si au dessus "01", récupération de l'heure, toujours unstring)
            $h = date("H", $date);
            // avec un comparaison non stricte, par défaut PHP utilise le transtypage, donc "H" qui est un string, par exemple "02" (convertit en int) sera comparé à 2 
            if ($h >= 2) {
                $out .= $h . " heures";
            } else {
                $out .= $h . " heure";
            }
            break;

            // équivalence du else (si rien n'est vrai)
        default:

            return "Format de date non reconnue";
    }


    return $out;
}
