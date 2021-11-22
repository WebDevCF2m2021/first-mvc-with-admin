<?php

// création des fonctions liées à la gestion de la table thearticle

function thearticleHomepageSelectAll(mysqli $db): array{
    // requête
    $sql="SELECT thearticle.*, 
    theuser.theuserName, theuser.theuserLogin,	
                 GROUP_CONCAT(thesection.idthesection) AS idthesection, 
                 GROUP_CONCAT(thesection.thesectionTitle SEPARATOR '|||') AS thesectionTitle
FROM thearticle
 INNER JOIN theuser
     ON thearticle.theuser_idtheuser = theuser.idtheuser 
 LEFT JOIN thearticle_has_thesection
     ON thearticle.idthearticle = thearticle_has_thesection.thearticle_idthearticle
 LEFT JOIN thesection
     ON thearticle_has_thesection.thesection_idthesection = thesection.idthesection 
 GROUP BY thearticle.idthearticle    ;";


/*

ICI

*/

$recup = mysqli_query($db,$sql);

return mysqli_fetch_all($recup,MYSQLI_ASSOC);

}