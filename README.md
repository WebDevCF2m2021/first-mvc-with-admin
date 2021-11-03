# first-mvc-with-admin
first MVC with administration in PHP 7 procedural - MariaDB with InnoDB engine - Session management

## GIT

## Structure

## Nos dossier de bases

Ce sont nos dossiers "non MVC" mise à part le contrôleur frontal se trouvant dans : public/index.php

### Nos dossiers MVC

MVC est un design pattern (patron de conception) qui signifie
- Model
- View
- Controller

C'est une manière de diviser le code pour :

1. Avoir une structure commune sur un projet
2. Déléguer les tâches sans risque d'écrasement de fichiers
3. Pourvoir séparer en logique metier la structure du site (le webdesigner travaille sur les vues, les webdeveloppers travaillent sur les modèles et les contrôleurs, le chef de projet impose la structure.)



https://fr.wikipedia.org/wiki/Mod%C3%A8le-vue-contr%C3%B4leur

`/.git`

Contient nos changements Git, ne jamais envoyer sur le FTP

`/data`

Nos données de préparation de création du site peuvent se retrouver sur github (ou pas !),
par contre c'est inutile en FTP

`/public`

C'est le seul dossier qui sera accessible à l'utilisateur de votre site, c'est ici que l'on mettra le contrôleur frontal `index.php`, ainsi que les dossiers publiques tels que `css`, `js`, `img` etc...

index.php => notre front controller
## Virtualhost

On crée en local un virtualhost avec Wamp (ou autre). 

Attention, cette adresse pointe bien vers le dossier `public` du site

`.../first-mvc-with-admin/public`

pour avoir une adresse de type:

http://first-mvc-with-admin

