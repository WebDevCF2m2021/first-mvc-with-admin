# first-mvc-with-admin
first MVC with administration in PHP 7 procedural - MariaDB with InnoDB engine - Session management

## GIT

## Structure

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

