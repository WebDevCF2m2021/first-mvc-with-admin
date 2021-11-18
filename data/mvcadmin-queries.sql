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
SELECT a.* , u.theuserLogin, u.theuserName
FROM thearticle a
INNER JOIN theuser u
ON u.idtheuser = a.theuser_idtheuser;
# Affichez tous les champs de la table thearticle en y joignant 
# facultativement les champs idthesection et thesectionTitle de 
# la table thesection (2 lignes de résultats)
SELECT a.*, a_s.*, s.idthesection, s.thesectionTitle
FROM thearticle a
LEFT JOIN thearticle_has_thesection a_s
ON a_s.thearticle_idthearticle = a.idthearticle
LEFT JOIN thesection s
ON s.idthesection = a_s.thesection_idthesection;

# Affichez tous les champs de la table thearticle en y joignant 
# facultativement les champs idthesection et thesectionTitle de 
# la table thesection mais sur une ligne, en concaténant idthesection
# avec une "," et thesectionTitle avec "|||"

SELECT a.*, a_s.*,
GROUP_CONCAT(s.idthesection SEPARATOR ',') AS idthesection, 
GROUP_CONCAT(s.thesectionTitle SEPARATOR '|||') AS thesectionTitle
FROM thearticle a
LEFT JOIN thearticle_has_thesection a_s
ON a_s.thearticle_idthearticle = a.idthearticle
LEFT JOIN thesection s
ON s.idthesection = a_s.thesection_idthesection
GROUP BY a.idthearticle;

# Affichez tous les champs de la table thearticle en y joignant 
# obligatoirement les champs theuserName et theuserLogin de la table
# theuser et
# facultativement les champs idthesection et thesectionTitle de 
# la table thesection mais sur une ligne, en concaténant idthesection
# avec une "," et thesectionTitle avec "|||"

SELECT a.*, a_s.*,u.idtheuser, u.theuserName, u.theuserLogin,
GROUP_CONCAT(s.idthesection SEPARATOR ',') AS idthesection, 
GROUP_CONCAT(s.thesectionTitle SEPARATOR '|||') AS thesectionTitle
FROM thearticle a
LEFT JOIN thearticle_has_thesection a_s
ON a_s.thearticle_idthearticle = a.idthearticle
LEFT JOIN thesection s
ON s.idthesection = a_s.thesection_idthesection
INNER JOIN theuser u
ON u.idtheuser = a.theuser_idtheuser
GROUP BY a.idthearticle; 
