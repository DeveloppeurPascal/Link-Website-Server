<?php
	// Link Website Generator
	// (c) 2025 Patrick Prémartin
	//
	// Distributed under license AGPL.
	//
	// Infos and updates :
	// https://github.com/DeveloppeurPascal/Link-Website-Server

	// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	// !!! NEVER CHANGE THIS FILE ON YOUR SITES !!!
	// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

	// This file contains the default settings of the software.
	// It will be overwritten each time the code repository is
	// updated when there are changes in default values or new
	// settings. Never modify it directly.
	//
	// For localhost server, copy your defines in a "./__common_settings-localhost.inc.php" file.
	//
	// For real domaine or IP, copy your defines in a "./__common_settings-web.inc.php" file.

	if (("127.0.0.1" == $_SERVER["SERVER_ADDR"]) || ("::1" == $_SERVER["SERVER_ADDR"])) {
		define("_IsLocal", true);
		// parameters for a localhost web site (dev, debug, test)
		@include_once(__DIR__."/__common_settings-localhost.inc.php");
	} else {
		define("_IsLocal", false);
		// parameters for a real domain name or IP (release)
		@include_once(__DIR__."/__common_settings-web.inc.php");
	}

	// *************************************************
	// * Parameters you can define in your config file *
	// *************************************************

	// Your URL to show as this site publisher in copyright texts
	if (!defined("_CopyrightPublisherURL")) // TODO : à remplacer par $Settings
		define("_CopyrightPublisherURL", "");

	// Your name to show as this site publisher in copyright texts
	if (!defined("_CopyrightPublisherName")) // TODO : à remplacer par $Settings
		define("_CopyrightPublisherName", "Your Publisher Name");

	// Your name to show as this site publisher in copyright texts
	if (!defined("_DefaultTemplateFileName"))
		define("_DefaultTemplateFileName", __DIR__."/theme/default.php");

	// Available languages for this website
	if (!defined("_AvailableLanguagesList")) // TODO : à remplacer par $Settings
		define("_AvailableLanguagesList", ["fr","en"]);

	// Default language to use for this website
	if (!defined("_DefaultLanguage")) // TODO : à remplacer par $Settings
		define("_DefaultLanguage", "en");

	// Absolute URL of your website
	if (!defined("_SiteURL"))
		define("_SiteURL", "http://localhost/Simple-Multilingual-Site/src");
		// define("_SiteURL", "https://mywebsite.zorglub.web");
		// define("_SiteURL", "https://mywebsite.zorglub.web/InAFolder/");

	// ID of your application on iTunes (or Apple Connect)
	if (!defined("_AppleApplicationId")) // TODO : à remplacer par $Settings
		define("_AppleApplicationId", "");

	// Value to use for the ROBOTS META tag (cf https://www.robotstxt.org)
	if (!defined("_MetaRobots")) // TODO : à remplacer par $Settings
		define("_MetaRobots", "index,follow");

	// Relative path of the favicon file from site URL ("favicon.ico" or other)
	if (!defined("_FavIconFilePath")) // TODO : à remplacer par $Settings
		if (file_exists(__DIR__."/favicon.ico")) {
			define("_FavIconFilePath", "favicon.ico");
		}
		else if (file_exists(__DIR__."/favicon.png")) {
			define("_FavIconFilePath", "favicon.png");
		}
		else if (file_exists(__DIR__."/favicon.gif")) {
			define("_FavIconFilePath", "favicon.gif");
		}
		else if (file_exists(__DIR__."/favicon.jpg")) {
			define("_FavIconFilePath", "favicon.jpg");
		}
		else {
			define("_FavIconFilePath", "");
		}

	// Path to API files
	if (!defined("_PathToAPIFolder"))
		define("_PathToAPIFolder", __DIR__."/_api-xxxxxxx");

	// Path to CACHE files
	if (!defined("_PathToCacheFolder"))
		define("_PathToCacheFolder", __DIR__."/_cache-xxxxxxx");

	// Path to DB files
	if (!defined("_PathToDatabaseFolder"))
		define("_PathToDatabaseFolder", __DIR__."/_db-xxxxxxx");

	// Path to THEME files
	if (!defined("_PathToThemeFolder"))
		define("_PathToThemeFolder", __DIR__."/_theme-xxxxxxx");

	// Path to INC files
	if (!defined("_PathToIncludesFolder"))
		define("_PathToIncludesFolder", __DIR__."/_inc-xxxxxxx");

	// Default INDEX page file name
	if (!defined("_DefaultIndexPageName"))
		define("_DefaultIndexPageName", "index.html");

	// Default 403-Forbidden page file name
	if (!defined("_DefaultForbiddenPageName"))
		define("_DefaultForbiddenPageName", "403-forbidden.html");

	// Default 404-FileNotFound page file name
	if (!defined("_DefaultFileNotFoundPageName"))
		define("_DefaultFileNotFoundPageName", "404-filenotfound.html");
