<?php
	// Block Page Site Server
	// (c) 2025 Patrick Prémartin
	//
	// Distributed under license AGPL.
	//
	// Infos and updates :
	// https://blockpagesiteserver.trucs-de-developpeur-web.fr

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

	// Path to API files
	if (!defined("_PathToAPIFolder"))
		define("_PathToAPIFolder", __DIR__."/_api-xxxxxxx");

	// Path to CACHE files
	if (!defined("_PathToCacheFolder"))
		define("_PathToCacheFolder", __DIR__."/_cache-xxxxxxx");

	// Path to DB files
	if (!defined("_PathToDatabaseFolder"))
		define("_PathToDatabaseFolder", __DIR__."/_db-xxxxxxx");

	// Path to THEME-DIST files
	if (!defined("_PathToDefaultThemeFolder"))
		define("_PathToDefaultThemeFolder", __DIR__."/_theme-dist-xxxxxxx");

	// Path to THEME files
	if (!defined("_PathToThemeFolder"))
		define("_PathToThemeFolder", _PathToDefaultThemeFolder);

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

	// Absolute URL of your website
	if (!defined("_SiteURL"))
		define("_SiteURL", "http://localhost/Link-Website-Server/src");
