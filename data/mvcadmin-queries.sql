# Affichez tous les champs de la table thearticle
SELECT * FROM thearticle;
<<<<<<< HEAD

# Affichez tous les champs de la table thearticle_has_thesection
SELECT * FROM thearticle_has_thesection;

# Affichez tous les champs de la table theright
SELECT * FROM theright;

# Affichez tous les champs de la table thesection
SELECT * FROM thesection;

# Affichez tous les champs de la table theuser
SELECT * FROM theuser;
=======
# Affichez tous les champs de la table thearticle_has_thesection

# Affichez tous les champs de la table theright

# Affichez tous les champs de la table thesection

# Affichez tous les champs de la table theuser
>>>>>>> 8f5469b1fa8b2d7f9fca611f9a6b64b84769876c

# Affichez tous les champs de la table thearticle en y joignant 
# obligatoirement les champs theuserName et theuserLogin de la table
# theuser
<<<<<<< HEAD
SELECT thearticle.*, theuser.theuserName, theuser.theuserLogin
	FROM thearticle
    INNER JOIN theuser
		ON thearticle.theuser_idtheuser = theuser.idtheuser;
=======
>>>>>>> 8f5469b1fa8b2d7f9fca611f9a6b64b84769876c

# Affichez tous les champs de la table thearticle en y joignant 
# facultativement les champs idthesection et thesectionTitle de 
# la table thesection (2 lignes de résultats)
<<<<<<< HEAD
SELECT thearticle.*, thesection.idthesection, thesection.thesectionTitle
FROM thearticle
	LEFT JOIN thearticle_has_thesection
		ON thearticle.idthearticle = thearticle_has_thesection.thearticle_idthearticle
    LEFT JOIN thesection
		ON thearticle_has_thesection.thesection_idthesection = thesection.idthesection
        ;
=======
>>>>>>> 8f5469b1fa8b2d7f9fca611f9a6b64b84769876c

# Affichez tous les champs de la table thearticle en y joignant 
# facultativement les champs idthesection et thesectionTitle de 
# la table thesection mais sur une ligne, en concaténant idthesection
# avec une "," et thesectionTitle avec "|||"
<<<<<<< HEAD
SELECT thearticle.*, GROUP_CONCAT(thesection.idthesection) AS idthesection, 
					GROUP_CONCAT(thesection.thesectionTitle SEPARATOR '|||') AS thesectionTitle
FROM thearticle
	LEFT JOIN thearticle_has_thesection
		ON thearticle.idthearticle = thearticle_has_thesection.thearticle_idthearticle
    LEFT JOIN thesection
		ON thearticle_has_thesection.thesection_idthesection = thesection.idthesection
    GROUP BY thearticle.idthearticle    ;
=======
>>>>>>> 8f5469b1fa8b2d7f9fca611f9a6b64b84769876c

# Affichez tous les champs de la table thearticle en y joignant 
# obligatoirement les champs theuserName et theuserLogin de la table
# theuser et
# facultativement les champs idthesection et thesectionTitle de 
# la table thesection mais sur une ligne, en concaténant idthesection
# avec une "," et thesectionTitle avec "|||"
<<<<<<< HEAD
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
=======
>>>>>>> 8f5469b1fa8b2d7f9fca611f9a6b64b84769876c
