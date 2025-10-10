# Données du site et API

Le serveur stocke des informations en JSON sous forme de fichier(s) dans l'arborescence du site.

Lors de l'affichage d'une page web le programme regarde si la langue est prise en charge et affiche la page en cache ou la génère si elle n'est pas disponible ou que le fichier JSON correspondant a été modifié après génération de son cache.

Lors d'un appel d'API, le serveur reçoit ou transfère les données au logiciel client connecté sous forme d'un seul fichier contenant l'intégralité des données du site.

Lorsque le logiciel de gestion de la base transfert les modifications à appliquer, le serveur compare les éléments transférés aux données existantes, efface les pages de cache si les informations par défaut ou paramètres globaux ont été modifiées, génére les fichiers de données indépendants pour chaque langue de chaque page (s'il ont été modifiés).

## Base de données du site

La base de données globale du site contient les paramètres globaux, les informations à appliquer par défaut et les informations de chaque page dans leurs langues.

La structure de ce fichier JSON (utilisé en stockage comme lros des échanges entre le serveur du site et le logiciel client de mise à jour) est la suivante :

```
	settings {
		langs [
			isocode
			by_default (true/false)
		]
		site_url
		favicon_url
		apple_application_id
		default_theme_file ("default" par défaut pour /_theme-xxxxxxx/default.php)
		default_image {
			alt [
				lang
				text
				is_public (boolean)
			]
			url
			is_public (boolean)
		}
		menu_header [
			[ // any menu option can have a different name or URL depending on page language
				lang
				text
				url
				is_public (boolean)
			]
		]
		menu_footer [
			[ // any menu option can have a different name or URL depending on page language
				lang
				text
				url
				is_public (boolean)
			]
		]
		copyright {
			text [
				lang
				text
				is_public (boolean)
			]
			created_year
			editors [
				[ // any editor can have a different name or URL depending on page language
					lang
					name
					url
					is_public (boolean)
				]
			]
		}
	}
	pages [
		is_public (boolean)
		page_name
		theme_file (si absent ou vide => default_theme_file)
		head {
			metas [
				[ // any META tag can have a different name or content depending on page language
					lang
					name
					content
					is_public (boolean)
				]
			]
			links [
				[ // any LINK tag can have a different name or content depending on page language
					lang
					rel
					href
					is_public (boolean)
				]
			]
			title [
				lang
				text
				is_public (boolean)
			]
		}
		body {
			contents [
				{
					type : "image"
					alt [
						lang
						text
						is_public (boolean)
					]
					url
					is_public (boolean)
				}
				{
					type : "title_1"
					title [
						lang
						text
						is_public (boolean)
					]
				}
				{
					type : "text"
					text [
						lang
						text
						is_public (boolean)
					]
				}
				{
					type : "link"
					link [
						lang
						text
						url
						picto_url
						picto_alt
						is_public (boolean)
					]
				}
			]
		}
	]
```

## Stockage des informations de chaque page

Lors de l'import de la base de données globale ou des mises à jour, le serveur génère un fichier par page (contenant toutes les langues) pour chaque page où seules les informations nécessaires sont indiquées.

Un fichier de paramétrage des données globales est également généré.

Les pages sont recalculées à partir de ces fichiers et non de la base globale.

## Site web statique ou dynamique ?

Le site est dynamique mais le serveur gère un cache des pages web afin de limiter la consommation de ressources inutiles.

La gestion du cache est faite en option pour chaque affichage de page ou globalement lors d'une mise à jour.

Les fichiers en cache sont stockés dans un dossier protégé du serveur. Ils correspondent au contenu HTML de chaque page à afficher.

Le dossier contenant les pages en cache peut être renommé lors de l'installation du script afin de le rendre unique par rapport à d'autres sites. Par défaut le dossier du cache est ./_cache-xxxxxxx

En cas d'effacement du dossier contenant les fichiers en cache les pages sont générées lors de l'affichage suivant.

## API du serveur

Les programmes d'API sont accessibles depuis le sous-dossier ./_api-xxxxxxx de l'hébergement du site. Le nom de ce dossier doit être changé pour chaque installation si l'utilisateur fait les choses correctement et veut limiter les risques d'attaques de son site.

Une clé publique est demandée lors de chaque appel d'API.

Une clé privée connue du serveur et du client permet l'ajout d'une signature des données transférées.

Les clés publiques et privées sont stockées dans le même dossier que les données du site. Le nom du fichier contenant ces clés peut être personnalisé pour chaque site afin de limiter les risques de fuites de données suite à une attaque de type "brut force" ou DDoS.

### Export de la base de données

Utilisé par le logiciel client pour rapatrier la base de données en local.

GET download-xxxxxxx.php

Paramètres :
* version : 1
* pub-key : la clé publique définie pour ce site
* signature : la signature des paramètres en sha1

Réponse (sous forme d'un objet JSON) :
* data : les données de la base telles qu'elles sont stockées sur le serveur

### Import de la base de données

Utilisé par le logiciel client pour envoyer les données au serveur.

POST upload-xxxxxxx.php

Paramètres :
* version : 1
* data : les données de la base telles qu'elles seront stockées sur le serveur
* pub-key : la clé publique définie pour ce site
* signature : la signature des paramètres en sha1

Réponse (sous forme d'un objet JSON) :
* error-code : code d'erreur si le code http de retour du serveur n'est pas 200
* error-text : texte associé à l'erreur (en anglais)
