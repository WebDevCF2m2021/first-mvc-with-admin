-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : lun. 06 déc. 2021 à 14:36
-- Version du serveur :  10.5.4-MariaDB
-- Version de PHP : 7.3.21

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données : `mvcadmin`
--
DROP DATABASE IF EXISTS `mvcadmin`;
CREATE DATABASE IF NOT EXISTS `mvcadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mvcadmin`;

-- --------------------------------------------------------

--
-- Structure de la table `thearticle`
--

DROP TABLE IF EXISTS `thearticle`;
CREATE TABLE IF NOT EXISTS `thearticle` (
  `idthearticle` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `thearticleTitle` varchar(180) NOT NULL,
  `thearticleText` text NOT NULL,
  `thearticleDate` datetime NOT NULL DEFAULT current_timestamp(),
  `thearticleStatus` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0 => wait validation\n1 => validate\n2 => wait correction\n3 => ban\n',
  `theuser_idtheuser` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`idthearticle`),
  KEY `fk_thearticle_theuser1_idx` (`theuser_idtheuser`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `thearticle`
--

INSERT INTO `thearticle` (`idthearticle`, `thearticleTitle`, `thearticleText`, `thearticleDate`, `thearticleStatus`, `theuser_idtheuser`) VALUES
(1, 'Les Secrets d\'un Esprit Millionaire', 'Savez-vous pourquoi certaines personnes s\'enrichissent facilement, alors que d\'autres semblent destinées à une vie remplie de difficultés financières? Est-ce une question d\'éducation, d\'intelligence, de compétences, de moments opportuns, d\'habitudes de travail, de contacts, de chance, ou encore de choix de carrière, d\'entreprise ou d\'investissement? Et bien non !\r\n\r\nPour T. Harv Eker, chaque personne a un plan financier personnel imprimé dans son subconscient, un plan qui détermine son avenir. Vous avez beau tout savoir sur le marketing, la vente, les négociations, la bourse, l\'immobilier et le monde de la finance, si votre plan financier intérieur ne vise pas un degré de réussite élevé, vous n\'aurez jamais beaucoup d\'argent. Et si, par hasard, vous veniez à avoir une somme importante, vous la perdriez fort probablement! Il est donc urgent de refaire son plan financier intérieur pour réussir de manière naturelle et automatique.\r\n\r\nGrâce à une brillante alliance de débrouillardise et d\'humour, T. Harv Eker explique comment l\'enfance façonne la destinée financière. Consultez aussi de nombreux dossiers qui décrivent exactement en quoi les riches pensent et agissent différemment de la plupart des gens pauvres et de la classe moyenne. \r\n\r\nVous y trouverez des actions simples à mettre en pratique pour accroître ses revenus et faire fortune.Pour T. Harv Eker, les choses sont simples : si vous pensez comme les riches et faites ce qu\'ils font, vous pouvez devenir aussi riche qu\'eux !', '2021-11-18 13:57:19', 1, 1),
(2, 'Kant et la paix universelle', 'Vers la paix perpétuelle (Titre original : Zum ewigen Frieden. Ein philosophischer Entwurf) est un essai philosophique d\'Emmanuel Kant publié en 1795.\r\n\r\nReprenant une idée de Charles-Irénée Castel de Saint-Pierre dont était paru en 1713 le Projet de paix perpétuelle, Kant y formule un certain nombre de principes destinés à créer les conditions d’une « paix perpétuelle » (par opposition à une simple « cessation des hostilités » provisoire qui est la seule forme de paix possible tant que « l’état de nature » continue de régner entre les États). \r\n\r\nIl constitue les prémices de la théorie de la paix démocratique, et du courant idéaliste en théorie des relations internationales.', '2021-11-23 14:22:11', 1, 2),
(3, 'Tri des tableaux', 'PHP dispose de nombreuses fonctions pour trier les tableaux, et cette section du manuel va vous aider à vous y retrouver.\r\n\r\nLes différences principales sont :\r\n\r\nCertains des tris de tableau sont basés sur les clés, tandis que les autres sont basés sur les valeurs : $array[\'cle\'] = \'valeur\';\r\n\r\nCertains tris maintiennent la corrélation entre les clés et les valeurs, et d\'autres non, ce qui signifie que les clés sont généralement réaffectées numériquement (0,1,2 ...)\r\nL\'ordre du tri peut être : alphabétique, croissant, décroissant, numérique, naturel, aléatoire, ou définit par l\'utilisateur.\r\n\r\nNote : toutes ces fonctions de tris travaillent sur le tableau lui-même, contrairement à la pratique normale qui serait de retourner le tableau trié.\r\nSi une de ces fonctions de tri évalue 2 membres comme égaux, alors ils retiennent l\'ordre original. Antérieur à PHP 8.0.0, leur ordre était indéfini (le tri n\'était pas stable).', '2021-11-26 11:37:41', 1, 1),
(4, 'Qu’est-ce que la Paix intérieure ?', 'Quand nous arrivons à prendre un moment de détente et à calmer notre mental, par exemple devant un beau paysage, en écoutant de la musique, en créant, ou encore lors de toute activité qui nous emplit complètement, nous pouvons alors observer un sentiment de Paix intérieure, de Calme, de Joie, de Plénitude qui apparaît indépendamment des circonstances extérieures. Ce sentiment émane du plus profond de nous, de l’immobilité, du silence et n’a rien à voir avec le mental.\r\n\r\nCe sentiment de Paix, de Joie, de Calme fondamental, de Plénitude voire même d’Amour qui émane du silence et de l’immobilité du mental est différent de la joie ou de la paix qui surviendrait après un événement agréable, il n’est dépendant d’aucun événement quel qu’il soit, il est inhérent à notre existence.\r\n\r\nEn fait, cette Paix est toujours présente en nous et nous pouvons y accéder quand nous le souhaitons à partir du moment où nous avons pris conscience de sa présence.\r\n\r\nVers la Paix intérieure ?\r\n\r\nMême lorsque nous passons par des sentiments d’inconfort comme la colère, la peur, la tristesse, ce sentiment de Paix est présent, c’est juste que nous sommes trop identifiés à notre colère, à notre peur ou à notre tristesse et que nous ne voyons plus alors cette Paix intrinsèque. Mais si nous calmons notre mental, elle va alors pouvoir émerger et nous pourrons y trouver repos et réconfort. Il s’agit « juste » de ne rien faire mentalement. Là, bien sûr est toute la difficulté, du moins en apparence, car cela peut aussi est très simple, aussi simple que regarder un coucher de soleil… Nous avons juste à nous laisser porter, sans rien chercher à faire, mais être présent à ce qui est là. La méditation peut être une aide bénéfique et en même temps, nous pouvons y accéder aussi de diverses manières, voici quelques pistes que vous pouvez explorer :\r\n\r\nObservez un coucher de soleil ou une nuit étoilée et soyez attentif à ce qui est là en vous, simplement en observant.\r\n\r\nObservez vos pensées qui défilent et percevez l’espace vide ou le silence entre les pensées, ou entre les images mentales qui apparaissent. Dans cet espace vide ou ce silence, réside la Paix intérieure.\r\n\r\nAu lieu de regarder les objets dans une pièce (ou par exemple les arbres dans une forêt) regardez le vide qui se trouve entre ces objets ou ces arbres. En hiver on peut également observer entre les branches des arbres, ce vide, cet espace qui est là. De ce regard décentré peut naître aussi la Paix.\r\n\r\nDessinez un sourire sur vos lèvres et laissez pénétrer ce sourire à l’intérieur de vous, laissez-le se répandre dans tout votre être comme un large sourire intérieur.\r\n\r\nPrenez conscience de vos sensations corporelles, percevez votre corps de l’intérieur, habitez-le pleinement et sentez la vie qui pétille dans toutes vos cellules.\r\n\r\nExplorez toutes ces possibilités. Et pour ceux qui pourraient avoir besoin de se faire guider pour aller vers la paix intérieure, la plénitude, le calme, je me tiens à votre disposition pour vous accompagner sur ce merveilleux chemin de découverte.', '2021-12-03 10:10:16', 1, 3),
(5, 'La méditation mot à mot', 'Lama Jigmé Rinpoché - Extrait du livret \"La méditation mot à mot\"\r\n\r\nCet enseignement porte sur la méditation et explore le vocabulaire spécifique à cette pratique. Les mots constituent une passerelle vers une compréhension qu\'il s\'agit d\'acquérir pour relier les enseignements du Dharma à notre expérience de tous les jours. Nous avons tous notre vie et devons accomplir nos tâches quotidiennes, mais il importe en même temps d’apprendre à appliquer les concepts1 du bouddhisme. Ce n’est pas facile, car l’idée même de la pratique est de parvenir à une continuité, c’est-à-dire devenir capable de vivre le sens de l’enseignement. Atteindre ce résultat signifie vivre comme un véritable pratiquant. L’idée est séduisante, cependant sa mise en œuvre présente des difficultés. Pourtant, un entrainement régulier et attentif nous permettra de prendre une nouvelle habitude2, afin de demeurer dans la pratique et d\'être un véritable pratiquant.\r\n\r\nL\'enseignement qui suit est court, mais dense, et offre matière à réfléchir et étudier pendant plusieurs mois. L’introduction à la méditation a été bien établie précédemment3, puisque nous avons déjà parlé des conditions nécessaires à sa mise en place. Soutenus par une pratique méditative régulière, nous obtiendrons des bases solides et nous pourrons vraiment appréhender le sens du Dharma.\r\n\r\nDans les enseignements, nous trouvons souvent les mêmes expressions et nous sommes tellement habitués à entendre certaines d\'entre elles que nous en oublions leur signification profonde. Chaque mot de l\'enseignement du Bouddha revêt une importance à laquelle il faut être attentif. Par exemple, le terme « ignorance4 », marikpa5 en tibétain, est si présent que nous finissons par ne plus y faire attention et ne plus considérer vraiment sa signification. Cependant, la compréhension de ce terme est utile dans différents contextes du Dharma. Cette ignorance fondamentale nous pousse à commettre des erreurs, il est donc important de connaître sa signification et de nous questionner à son sujet, afin d\'affiner sans cesse notre compréhension des enseignements. Le terme « nyönmongpa6 » aussi est récurrent et nous figeons facilement une interprétation de ce mot ; or, il s\'agit de voir comment notre perception est liée à ces nyönmongpa. Nous rencontrons souvent des problèmes lexicaux, car plusieurs traductions sont utilisées comme « émotions perturbatrices », « afflictions », « passions », et il est difficile de trouver le mot approprié. Notre vie quotidienne nous accapare beaucoup et, lorsqu’une émotion apparaît dans notre esprit, nous sommes confus et déroutés parce que nous ne comprenons pas sa provenance ni sa nature, et nous n\'identifions pas ce qui se passe. D\'autre part, le travail est encore plus difficile à cause de l\'habitude prise par notre esprit de voir les choses en noir ou blanc, en bien ou mal, sans jamais apercevoir les nuances ! Utiliser des expressions comme « émotions négatives » ou « émotions positives » constitue un mauvais entendement et peut induire une compréhension erronée. Chaque terme de l\'enseignement a un sens précis, une réflexion régulière doit donc être menée pour bien se pénétrer des notions importantes ; c’est ainsi que l’orientation de l’esprit changera lentement jusqu’à ce qu\'une tout autre vision prenne place.\r\n\r\n« Méditation7 »\r\n\r\nLe terme « méditation » est presque galvaudé de nos jours, il est utilisé de façon générale et recouvre différentes pratiques ; en revanche, la méditation dont il est question dans le contexte bouddhique est une pratique spécifique qui permet de comprendre les enseignements du Bouddha. L\'objectif n\'est pas d\'atteindre des niveaux spirituels élevés, mais d\'assimiler personnellement le Dharma pour ouvrir les yeux sur l’éveil, c\'est-à-dire faire un pas dans la direction de la libération. Faire un pas ne marque pas un point de départ, mais signifie « emprunter la direction de l\'éveil », selon le point de vue bouddhique. Les autres directions ne sont pas mauvaises pour autant, mais le but reste pour nous d\'embrasser celle qui mène à l’éveil.\r\n\r\nMéditer pour s’imprégner de l’enseignement du Bouddha demande d\'acquérir la compréhension de plusieurs éléments simples. Ils se résument souvent à leur essence, à quelques mots qui véhiculent un sens très profond. Ces notions requièrent davantage d’explications pour être vraiment comprises, ce qui demande de s’investir dans leur étude. Les enseignements sur la nature de bouddha ou les différentes vues philosophiques constituent autant de conditions nécessaires à rassembler pour parvenir à méditer. Il ne s’agit pas de sujets séparés, sans lien les uns avec les autres.\r\nLa nature de bouddha est une idée assez simple, facile à comprendre intellectuellement, mais l\'intégrer personnellement dans sa pratique méditative reste pour certaines personnes une gageure. Les termes utilisés pour communiquer et le sens qu\'ils véhiculent sont deux aspects différents, comprendre les mots ne signifie pas toujours en appréhender le sens dans toute sa complexité. Pourtant, si nous voulons que notre pratique évolue dans la direction de l\'éveil, nous devons savoir ce qu\'implique précisément l\'expression « nature de bouddha »8. Il est important de comprendre clairement la terminologie inhérente à ce type d\'enseignement : il faut affiner cette compréhension et faire attention de ne pas développer une idée fausse qui conditionnerait ensuite notre pratique méditative et son résultat. Étudier ensemble et échanger sur ces sujets permet de ne pas tomber dans ce piège. Si nous approfondissons ces thèmes en prenant le temps de les assimiler, sans brûler les étapes, cela nous conduira à l\'émergence d\'une compréhension claire de ce qu’est un bouddha, et c\'est primordial pour méditer.\r\n\r\nPour apprendre à méditer, diverses techniques sont transmises : certaines consistent à visualiser le Bouddha, d\'autres, comme shamatha9, se basent sur le souffle. Pour méditer de façon correcte, nous devons reconnaître les processus mentaux qui sont à l\'œuvre, afin de savoir comment les diriger dans la bonne direction. Entraîner son esprit à visualiser le Bouddha permet de recevoir son influence spirituelle et de se connecter à lui. En combinant cette méditation à celle de la quiétude mentale, nous parviendrons à ne faire qu\'un avec le concept de nature de bouddha. Demeurer en la nature de bouddha signifie commencer véritablement à méditer.\r\n\r\nDans un premier temps, nous nous concentrons donc sur la façon de méditer, avec le soutien de la posture (une habitude physique à adopter en fonction de nos possibilités). Le point principal est de rester absorbé de façon correcte dans cette quiétude mentale. La régularité d\'une telle pratique n\'a pas pour but d\'atteindre un nombre d\'heures précis, mais plutôt d\'habiter davantage sa pratique en la pénétrant plus profondément. Le résultat de la méditation de shamatha est de pouvoir demeurer dans la quiétude pendant une longue période, ce qui offre la possibilité de recevoir des instructions qui nous permettront vraiment de pratiquer. Sans une assise dans la méditation de shamatha, les instructions que nous entendrons ne seront pas réellement comprises et ne pourront donc pas être mises en œuvre.\r\n\r\n« Nature de l\'esprit »\r\n\r\nL’enseignement transmis par Shamar Rinpoché à propos de l\'entraînement de l\'esprit10 constitue un bon soutien à la méditation. Les termes employés ont toute leur importance et il faut vraiment y réfléchir. Le mot « ngowo » en tibétain11 est souvent utilisé dans l\'expression « sem kyi ngowo12 ». « Sem » désigne l’esprit et « ngowo » est la signification ou le sens de l’esprit. Cette expression fait référence à l’esprit qui demeure en méditation dans sa propre dimension, c\'est-à-dire en sa nature véritable. Nous sommes familiarisés avec la traduction littérale de cette expression : « l\'essence » ou « la nature de l\'esprit », mais le problème est que nous ne la comprenons pas vraiment, nous l’interprétons à notre façon ce qui crée une mauvaise habitude. Le résultat visé est celui de l\'état de bouddha, encore faut-il savoir ce qu\'est un bouddha ; c’est le but de l\'étude du Nyingpo Tenpa ou du Gyü Lama13. Dans notre position actuelle, nous ne sommes pas des bouddhas, pourtant demeure en nous ce qui constitue un bouddha ; au sein même de notre esprit se trouve l’essence d’un bouddha, c\'est ce que nous nommons communément la nature de bouddha.\r\n\r\nLa méditation doit conduire l’esprit à s’établir en sa propre essence. Actuellement, il est submergé de concepts qui s\'élèvent de cette base appelée « l’essence ». Le but de la méditation est le maintien dans cette dimension de l’esprit14. En effet, ce support constitue à la fois la base des concepts samsariques et la base des qualités d’un bouddha. Nos concepts, nos idées et nos différentes expériences de vie se solidifient en habitudes qui interdisent temporairement l\'accès à cette base. Nous ne pouvons ni la voir ni l’atteindre, le propos est donc d’apprendre à demeurer en cette nature de bouddha, notre essence.\r\nExpliquer cette notion en détail est capital, sinon cette expression résonne de façon fantastique à nos oreilles et nous mène à une grande illusion. Il faut donc revenir au plus près de la signification de ces termes. La formulation tibétaine quelque peu nébuleuse nous fascine souvent et, très vite, les mots prennent le pas sur le sens. Nous saisissons les mots et élaborons des idées qui s\'éloignent du sens ; c\'est ainsi que naissent les mauvaises compréhensions. Il nous faut aller à la réalité, qui est très simple et ensuite, quels que soient les termes employés, le sens sera compris.\r\nUne fois que le sens sera intégré à la pratique, il s\'agira de se poser dans cette compréhension afin de ne pas être distrait par des pensées liées au passé ou au futur, et de demeurer dans le moment présent. Sans apprentissage, il est impossible de s\'absorber plus d’une seconde dans cette compréhension, alors que nous détenons le potentiel pour y parvenir. Le corps physique est dense et solide, mais l’esprit est semblable à l’air : il prend la forme de toutes les tendances qui s’élèvent en lui. Nous croyons voir clair, mais en fait nous évoluons dans le brouillard sans vraiment savoir où nous nous situons.\r\nLe but de la pratique est de rester dans la dimension de notre nature de bouddha. Au départ, rien n\'est clair dans notre méditation et la clarté instantanée de l\'esprit n\'est pas perçue, car, pour cela, il est nécessaire d\'être habitué à un certain degré de quiétude mentale. Lorsque cette seconde de clarté est identifiée, il faut alors s\'entraîner à demeurer plus longtemps dans cette dimension. Même si nous n\'en sommes pas encore au stade de voir clairement, le ressenti sera différent et nous serons un jour capables de ne faire qu\'un avec l’essence de notre esprit, notre nature de bouddha. Sur la base d\'une plus longue absorption en méditation, nous commencerons à comprendre ce que signifie l\'expression « la nature de bouddha » et nous parviendrons à nous établir dans la dimension de sagesse. C’est ce que signifie « sem kyi ngowo », « qui demeure dans son essence ».\r\n\r\nPendant la session de méditation, il n\'est pas nécessaire de penser à toutes ces explications?; il est bon de les connaître et de les étudier avant, mais pas d\'y revenir au moment de la pratique. En effet, grâce à une méditation stable, l’assimilation vient naturellement. L’application réelle dans la pratique de l\'absorption en notre propre nature de bouddha s\'effectue par le biais de la quiétude mentale. Celle-ci permet de développer une habitude de pratique, nécessaire pour s\'absorber dans la dimension de la nature de bouddha, ngowo künzhi ngang la zhak15. Parvenir à cette réalisation demande du temps, mais n\'est pas hors de portée. C\'est sur cette base que s’élèvent les qualités de la pratique, par exemple une meilleure assimilation de ce que nous avons étudié (comme les différents textes sur la nature de bouddha, les différentes vues ou situations de l’esprit, etc.). Dès lors, nous ne sommes plus prisonniers d\'une terminologie, d\'un concept ou d\'une idée, mais nous accédons à une compréhension personnelle, en d\'autres termes à la réalisation de la pratique.', '2021-12-03 10:20:21', 0, 6),
(6, 'EXERCICE user', 'EXERCICE\r\n\r\n    X création du modèle dans /model/theuserModel.php\r\n    X appel de ce modèle dans index.php (require_once)\r\n    X création d\'une vue dans /view/publicView/userView.php\r\n    X modification de /controller/publicController.php au niveau du commentaire \" // si on a cliqué sur le détail d\'un utilisateur\" ligne ~=61 pour charger la vue \"/view/publicView/userView.php\"\r\n    X création d\'une fonction dans /model/theuserModel.php nommée \r\n    \r\n    theuserSelectOneById(mysqli $db, int $id): ?array {}\r\n    \r\n    : Elle va récupérer les champs idtheuser, theuserName, theuserLogin de la table theuser ET le champs therightName, therightdesc et therightPerm du rôle lié à cette utilisateur : jointure interne amenant theright. Cette fonction renvoit un tableau associatif ou du NULL\r\n\r\n    -X création d\'une fonction dans \'../model/thearticleModel.php\' qui va récupérer tous les articles  ordonnés par date DESC et le texte à 250 caractères, avec les rubriques SI elles existent (jointure externe) écrites par un utilisateur via son id\r\n\r\n    thearticleSelectAllByTheuserId(mysqli $db, int $iduser): array{}\r\n\r\n    Au niveau du publicController\r\n\r\n    X Si l\'auteur n\'existe pas (theuserSelectOneById vide ou null): \r\n        - Erreur 404 personnalisée\r\n\r\n    X Si il existe (theuserSelectOneById est un tableau valide)\r\n        - Charger tous ses articles (/model/thearticleModel.php -> thearticleSelectAllByTheuserId)\r\n            - chargement de la vue /view/publicView/userView.php\r\n            - pas d\'article: affichage \"Pas encore d\'articles pour cet auteur\"\r\n            - affichages des articles comme sur la homepage (mais mettre le nom de l\'auteur)', '2021-12-06 14:34:53', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `thearticle_has_thesection`
--

DROP TABLE IF EXISTS `thearticle_has_thesection`;
CREATE TABLE IF NOT EXISTS `thearticle_has_thesection` (
  `thearticle_idthearticle` int(10) UNSIGNED NOT NULL,
  `thesection_idthesection` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`thearticle_idthearticle`,`thesection_idthesection`),
  KEY `fk_thearticle_has_thesection_thesection1_idx` (`thesection_idthesection`),
  KEY `fk_thearticle_has_thesection_thearticle1_idx` (`thearticle_idthearticle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `thearticle_has_thesection`
--

INSERT INTO `thearticle_has_thesection` (`thearticle_idthearticle`, `thesection_idthesection`) VALUES
(1, 3),
(1, 6),
(2, 2),
(2, 5),
(2, 6),
(4, 1),
(4, 3),
(4, 6),
(5, 1),
(5, 2),
(5, 4),
(5, 6);

-- --------------------------------------------------------

--
-- Structure de la table `theright`
--

DROP TABLE IF EXISTS `theright`;
CREATE TABLE IF NOT EXISTS `theright` (
  `idtheright` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `therightName` varchar(60) NOT NULL,
  `therightdesc` varchar(300) DEFAULT NULL,
  `therightPerm` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 => user\n1 => redactor\n2 => moderator\n3 => admin',
  PRIMARY KEY (`idtheright`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `theright`
--

INSERT INTO `theright` (`idtheright`, `therightName`, `therightdesc`, `therightPerm`) VALUES
(1, 'Utilisateur', 'Vous pouvez consultez tous nos articles', 0),
(2, 'Rédacteur', 'Créat.eur.rice de contenu', 1),
(3, 'Modérateur', 'Gestionnaire de contenu', 2),
(4, 'Admin', 'Administrat.eur.rice', 3);

-- --------------------------------------------------------

--
-- Structure de la table `thesection`
--

DROP TABLE IF EXISTS `thesection`;
CREATE TABLE IF NOT EXISTS `thesection` (
  `idthesection` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `thesectionTitle` varchar(150) NOT NULL,
  `thesectionDesc` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`idthesection`),
  UNIQUE KEY `thesectionTitle_UNIQUE` (`thesectionTitle`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `thesection`
--

INSERT INTO `thesection` (`idthesection`, `thesectionTitle`, `thesectionDesc`) VALUES
(1, 'Méditation', 'Le terme méditation désigne une pratique mentale qui consiste généralement en une attention portée sur un certain objet, au niveau de la pensée, des émotions, du corps. Dans une approche spirituelle, elle peut être un exercice, voire une voie de réalisation du Soi et d\'éveil. '),
(2, 'Spirituel', 'La notion de spiritualité comporte aujourd\'hui des acceptions différentes selon le contexte de son usage. Elle se rattache conventionnellement, en Occident, à la religion dans la perspective de l\'être humain en relation avec des êtres supérieurs et le salut de l\'âme. '),
(3, 'Paix', 'La paix est un concept qui désigne un état de calme ou de tranquillité ainsi que l\'absence de perturbation, de trouble, de guerre et de conflit. Elle correspond aussi à un idéal social et politique. '),
(4, 'Nature', 'Le mot « nature »  peut désigner la composition et la matière d\'une chose (ce qu\'elle est, son essence), l\'origine et le devenir d\'une chose, l\'ensemble du réel indépendant de la culture humaine, ou l\'ensemble des systèmes et des phénomènes naturels'),
(5, 'Univers', 'L\'Univers, au sens cosmologique, est l\'ensemble de tout ce qui existe, régi par un certain nombre de lois. '),
(6, 'Esprit', 'L\'esprit est la totalité des phénomènes et des facultés mentales : perception, affectivité, intuition, pensée, jugement, morale, etc. ');

-- --------------------------------------------------------

--
-- Structure de la table `theuser`
--

DROP TABLE IF EXISTS `theuser`;
CREATE TABLE IF NOT EXISTS `theuser` (
  `idtheuser` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `theuserName` varchar(150) NOT NULL,
  `theuserLogin` varchar(60) NOT NULL,
  `theuserPwd` varchar(255) NOT NULL,
  `theright_idtheright` smallint(5) UNSIGNED NOT NULL,
  PRIMARY KEY (`idtheuser`),
  UNIQUE KEY `theuserLogin_UNIQUE` (`theuserLogin`),
  KEY `fk_theuser_theright_idx` (`theright_idtheright`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `theuser`
--

INSERT INTO `theuser` (`idtheuser`, `theuserName`, `theuserLogin`, `theuserPwd`, `theright_idtheright`) VALUES
(1, 'Pity Mika', 'admin', 'admin', 4),
(2, 'Jean-Luc Lebleu ', 'lebleu', 'lebleu', 2),
(3, 'Pierre Landon', 'Landon', 'Landon', 2),
(4, 'Zend Marie', 'Zend', 'Zend', 3),
(5, 'Marmoud Medhi', 'Marmoud', 'Marmoud', 1),
(6, 'Nabil Nbago', 'Modo', 'Modo', 3);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `thearticle`
--
ALTER TABLE `thearticle`
  ADD CONSTRAINT `fk_thearticle_theuser1` FOREIGN KEY (`theuser_idtheuser`) REFERENCES `theuser` (`idtheuser`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Contraintes pour la table `thearticle_has_thesection`
--
ALTER TABLE `thearticle_has_thesection`
  ADD CONSTRAINT `fk_thearticle_has_thesection_thearticle1` FOREIGN KEY (`thearticle_idthearticle`) REFERENCES `thearticle` (`idthearticle`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_thearticle_has_thesection_thesection1` FOREIGN KEY (`thesection_idthesection`) REFERENCES `thesection` (`idthesection`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `theuser`
--
ALTER TABLE `theuser`
  ADD CONSTRAINT `fk_theuser_theright` FOREIGN KEY (`theright_idtheright`) REFERENCES `theright` (`idtheright`) ON DELETE NO ACTION ON UPDATE NO ACTION;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
