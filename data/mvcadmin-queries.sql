# Affichez tous les champs de la table thearticle
SELECT * FROM thearticle;

# Affichez tous les champs de la table thearticle_has_thesection
SELECT * FROM thearticle_has_thesection;

# Affichez tous les champs de la table theright
SELECT * FROM theright;

# Affichez tous les champs de la table thesection
SELECT * FROM thesection;

# Affichez tous les champs de la table theuser
SELECT * FROM theuser;

# Affichez tous les champs de la table thearticle en y joignant 
# obligatoirement les champs theuserName et theuserLogin de la table
# theuser
SELECT thearticle.*, theuser.theuserName, theuser.theuserLogin
	FROM thearticle
    INNER JOIN theuser
		ON thearticle.theuser_idtheuser = theuser.idtheuser;

# Affichez tous les champs de la table thearticle en y joignant 
# facultativement les champs idthesection et thesectionTitle de 
# la table thesection (2 lignes de résultats)
SELECT thearticle.*, thesection.idthesection, thesection.thesectionTitle
FROM thearticle
	LEFT JOIN thearticle_has_thesection
		ON thearticle.idthearticle = thearticle_has_thesection.thearticle_idthearticle
    LEFT JOIN thesection
		ON thearticle_has_thesection.thesection_idthesection = thesection.idthesection
        ;

# Affichez tous les champs de la table thearticle en y joignant 
# facultativement les champs idthesection et thesectionTitle de 
# la table thesection mais sur une ligne, en concaténant idthesection
# avec une "," et thesectionTitle avec "|||"
SELECT thearticle.*, GROUP_CONCAT(thesection.idthesection) AS idthesection, 
					GROUP_CONCAT(thesection.thesectionTitle SEPARATOR '|||') AS thesectionTitle
FROM thearticle
	LEFT JOIN thearticle_has_thesection
		ON thearticle.idthearticle = thearticle_has_thesection.thearticle_idthearticle
    LEFT JOIN thesection
		ON thearticle_has_thesection.thesection_idthesection = thesection.idthesection
    GROUP BY thearticle.idthearticle    ;

# Affichez tous les champs de la table thearticle en y joignant 
# obligatoirement les champs theuserName et theuserLogin de la table
# theuser et
# facultativement les champs idthesection et thesectionTitle de 
# la table thesection mais sur une ligne, en concaténant idthesection
# avec une "," et thesectionTitle avec "|||"
SELECT thearticle.*, 
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
        
    GROUP BY thearticle.idthearticle    ;
    
# idem précédent  mais avec un WHERE sur l'id de l'article   (0 ou 1 résultat possible)
SELECT thearticle.*, 
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
     WHERE thearticle.idthearticle=2
 GROUP BY thearticle.idthearticle     ;
