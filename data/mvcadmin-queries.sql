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

# Affichez tous les champs de la table thearticle en y joignant 
# facultativement les champs idthesection et thesectionTitle de 
# la table thesection mais sur une ligne, en concaténant idthesection
# avec une "," et thesectionTitle avec "|||"

# Affichez tous les champs de la table thearticle en y joignant 
# obligatoirement les champs theuserName et theuserLogin de la table
# theuser et
# facultativement les champs idthesection et thesectionTitle de 
# la table thesection mais sur une ligne, en concaténant idthesection
# avec une "," et thesectionTitle avec "|||"
