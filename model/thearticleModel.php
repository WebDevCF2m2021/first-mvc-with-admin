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
