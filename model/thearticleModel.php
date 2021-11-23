<?php

// création des fonctions liées à la gestion de la table thearticle

// affichage de tous les articles sur la page d'accueil (tant qu'ils ont un auteur)
function thearticleHomepageSelectAll(mysqli $db): array{
    // requête
    $sql="SELECT a.idthearticle, a.thearticleTitle, LEFT(a.thearticleText,250) AS thearticleText, a.thearticleDate,
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
  GROUP BY a.idthearticle    ;";

// récupération des articles, ou affichage de l'erreur SQL et arrêt
$recup = mysqli_query($db,$sql) or die("Erreur SQL :".mysqli_error($db));

return mysqli_fetch_all($recup,MYSQLI_ASSOC);

}