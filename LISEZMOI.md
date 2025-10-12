# Block Page Site Server

[This page in English.](README.md)

Ce projet est un moteur de sites multilingue développé en PHP. Il prend en charge le routage des pages, d'éventuelles redirections, le SEO, les partages sur les réseaux sociaux, un système de cache et de modèles de pages à plusieurs niveaux.

Les pages sont définies comme des ensembles de blocs que vous pouvez utiliser à partir du modèle par défaut. Il bien entendu possible de créer votre propre modèle de pages et vos propres blocs.

Les données sont stockées sous forme de fichiers JSON. Le stockage en base de données (plutôt pour les gros sites) est envisagé.

Ce moteur de site n'a pas d'interface d'aministration mais propose une API pour mettre à jour sa base de données. Des logiciels et des backoffices clients de cette APIs seront proposés. Ils seront listés sur le site du projet.

Vous pouvez vous servir de ce moteur pour créer vos propres sites et bénéficier des fonctionnalités incluses à condition de respecter les informations minimales à avoir dans les trois types de fichiers de la base de données. Le reste est entièrement autonome.

## Présentations et conférences

### Twitch

Suivez mes streams de développement de logiciels, jeux vidéo, applications mobiles et sites web sur [ma chaîne Twitch](https://www.twitch.tv/patrickpremartin) ou en rediffusion sur [Serial Streameur](https://serialstreameur.fr) la plupart du temps en français.

## Utiliser ce script

Copiez les fichiers du sous-dossier ./src à l'emplacement de votre site (racine d'un domaine, d'un sous-domaine ou dans un sous-dossier d'un site existant.

Afficher la page d'accueil et copiez les informations indiquées dans votre version du générateur de sites.

Une fois fait le programme passera en affichage des données, vous n'aurez plus qu'à le remplir depuis le logiciel.

Vous pouvez aussi [consulter le site du script](https://blockpagesiteserver.trucs-de-developpeur-web.fr) pour en savoir plus sur son fonctionnement, accéder à des vidéos et articles, connaître les différentes versions disponibles et leurs fonctionnalités, contacter le support utilisateurs...

## Installation des codes sources

Pour télécharger ce dépôt de code il est recommandé de passer par "git" mais vous pouvez aussi télécharger un ZIP directement depuis [son dépôt GitHub](https://github.com/DeveloppeurPascal/Link-Website-Server).

## Compatibilité

Quand je développe, je travaille localement avec XAMPP sur Windows. Mes projets fonctionnent avec cette stack.

Aucune garantie de compatibilité avec d'autres logiciels ou versions n'est fournie même si je m'efforce de faire du code propre et ne pas trop utiliser de trucs spécifiques.

Si vous détectez des anomalies sur des versions antérieures n'hésitez pas à [les rapporter](https://github.com/DeveloppeurPascal/Link-Website-Server/issues) pour que je teste et tente de corriger ou fournir un contournement.

## Licence d'utilisation de ce dépôt de code et de son contenu

Ces codes sources sont distribués sous licence [AGPL 3.0 ou ultérieure](https://choosealicense.com/licenses/agpl-3.0/).

Vous êtes globalement libre d'utiliser le contenu de ce dépôt de code n'importe où à condition :
* d'en faire mention dans vos projets
* de diffuser les modifications apportées aux fichiers fournis dans ce projet sous licence AGPL (en y laissant les mentions de copyright d'origine (auteur, lien vers ce dépôt, licence) obligatoirement complétées par les vôtres)
* de diffuser les codes sources de vos créations sous licence AGPL

Si cette licence ne convient pas à vos besoins vous pouvez acheter un droit d'utilisation de ce projet sous la licence [Apache License 2.0](https://choosealicense.com/licenses/apache-2.0/) ou une licence commerciale dédiée ([contactez l'auteur](https://trucs-de-developpeur-web.fr/nous-contacter.php) pour discuter de vos besoins).

Ces codes sources sont fournis en l'état sans garantie d'aucune sorte.

Certains éléments inclus dans ce dépôt peuvent dépendre de droits d'utilisation de tiers (images, sons, ...). Ils ne sont pas réutilisables dans vos projets sauf mention contraire.

# Licence appliquée aux images des drapeaux

Les images en SVG des drapeaux présentes dans le dossier ./src/img/flags proviennent du dépôt https://github.com/lipis/flag-icons

Elles sont distribuées sous licence MIT.

Si vous désirez les utiliser dans vos projets, assurez vous de respecter leur licence.

## Comment demander une nouvelle fonctionnalité, signaler un bogue ou une faille de sécurité ?

Si vous voulez une réponse du propriétaire de ce dépôt la meilleure façon de procéder pour demander une nouvelle fonctionnalité ou signaler une anomalie est d'aller sur [le dépôt de code sur GitHub](https://github.com/DeveloppeurPascal/Link-Website-Server) et [d'ouvrir un ticket](https://github.com/DeveloppeurPascal/Link-Website-Server/issues).

Si vous avez trouvé une faille de sécurité n'en parlez pas en public avant qu'un correctif n'ait été déployé ou soit disponible. [Contactez l'auteur du dépôt en privé](https://trucs-de-developpeur-web.fr/nous-contacter.php) pour expliquer votre trouvaille.

Vous pouvez aussi cloner ce dépôt de code et participer à ses évolutions en soumettant vos modifications si vous le désirez. Lisez les explications dans le fichier [CONTRIBUTING.md](CONTRIBUTING.md).

## Supportez ce projet et son auteur

Si vous trouvez ce dépôt de code utile et voulez le montrer, merci de faire une donation [à son auteur](https://github.com/DeveloppeurPascal). Ca aidera à maintenir ce projet et tous les autres.

Vous pouvez utiliser l'un de ces services :

* [GitHub Sponsors](https://github.com/sponsors/DeveloppeurPascal)
* Ko-fi [en français](https://ko-fi.com/patrick_premartin_fr) ou [en anglais](https://ko-fi.com/patrick_premartin_en)
* [Patreon](https://www.patreon.com/patrickpremartin)
* [Liberapay](https://liberapay.com/PatrickPremartin)

Vous pouvez acheter une licence d'utilisateur pour [mes logiciels](https://lic.olfsoftware.fr/products.php?lng=fr) et [mes jeux vidéo](https://lic.gamolf.fr/products.php?lng=fr) ou [une licence de développeur pour mes bibliothèques](https://lic.developpeur-pascal.fr/products.php?lng=fr) si vous les utilisez dans vos projets.

Je suis également disponible en tant que prestataire pour vous aider à utiliser ce projet ou d'autres, comme pour vos développements de logiciels, applications mobiles et sites Internet. [Contactez-moi](https://vasur.fr/about) pour en discuter.
