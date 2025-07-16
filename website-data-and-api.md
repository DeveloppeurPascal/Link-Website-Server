# Données du site et API

Le serveur stocke des informations en JSON sous forme de fichier texte dans l'arborescence du site.

Lors de l'affichage d'une page web le programme regarde si la langue est prise en charge et affiche la page en cache ou la génère si elle n'est pas disponible.

Lors d'un appel d'API, le serveur reçoit ou transfère les données au logiciel client connecté.

## Structure des données d'un site

Objet JSON contenant les informations de version de sa description, des paramètres d'entête et de pied de page, des informations pour le header des pages, la liste des liens à affichers en fonction de la langue du visiteur, des informations en saisie brute pour les CGU ("UGC"), CGV ("SGC"), RGPD et traitement des données personnelles et mentions légales.

```
	settings
		default-lang
	pages
		links
			title [
				lang
				text
				public O/N
			]
			photo
				url
				description [
					lang
					text
					public O/N
				]
				public O/N
			before-links [
				lang
				text
				public O/N
			]
			links [
				lang
				title
				url
				text
				url-image
				url-picto
				public O/N
			]
			after-links [
				lang
				text
				public O/N
			]
		docs [
			lang
			title
			text
			uri-title
			uri-link
			public O/N
		]
		legal [
			lang
			title
			before-text
			editor-text
			publisher-text
			hosting-text
			after-text
			uri-title
			uri-link
			public O/N
		]
	copyright
		links [
			lang
			title
			url
			public O/N
		]
		year
		editor [
			lang
			name
			url
			public O/N
		]
		text [
			lang
			text
			public O/N
		]
	head
		metas [
			lang
			name
			content
			public O/N
		]
		links [
			lang
			rel
			href
			public O/N
		]
```

## Stockage des informations

Les données du site sont stockées en JSON dans un fichier texte enregistré dans un dossier protégé de l'hébergement dont le nom peut être modifié sur chaque installation.

En cas d'effacement de ce fichiers, les données du site sont perdues. Une sauvegarde de l'hébergement est fortement conseillée.

## Site web statique ou dynamique ?

Le site est dynamique mais le serveur gère un cache des pages web afin de limiter la consommation de ressources inutiles.

Ce cache est vidé à chaque mise à jour de la base de données. Il est rempli au fil des affichages de pages entre deux mises à jour de la base de données. Les fichiers en cache sont stockés dans un dossier protégé du serveur.

Le dossier contenant les pages en cache peut être renommé lors de l'installation du script afin de le rendre unique par rapport à d'autres sites. Par défaut le dossier du cache est ./cache-xxxxxxx

En cas d'effacement du dossier contenant les fichiers en cache les pages sont générées lors de l'affichage suivant.


## API du serveur

Les programmes d'API sont accessibles depuis le sous-dossier ./api-xxxxxxx de l'hébergement du site. Le nom de ce dossier doit être changé pour chaque installation si l'utilisateur fait les choses correctement et veut limiter les risques d'attaques de son site.

Une clé publique est demandée lors de chaque appel d'API.

Une clé privée connus du serveur et du client permet l'ajout d'une signature des données transférées.

Les clés publiques et privées sont stockées dans le même dossier que les données du site. Le nom du fichier contenant ces clés peut être personnalisé pour chaque site afin de limiter les risques de fuites de données suite à une attaque de type "brut force" ou DDoS.

### export de la base de données

Utilisé par le logiciel client pour rapatrier la base de données en local.

GET download-xxxxxxx.php

Paramètres :
* version : 1
* pub-key : la clé publique définie pour ce site
* signature : la signature des paramètres en sha1

Réponse (sous forme d'un objet JSON) :
* data : les données de la base telles qu'elles sont stockées sur le serveur

### import de la base de données

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
