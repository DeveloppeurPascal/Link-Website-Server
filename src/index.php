<?php
	// Link Website Generator
	// (c) 2025 Patrick Prémartin
	//
	// Distributed under license AGPL.
	//
	// Infos and updates :
	// https://github.com/DeveloppeurPascal/Link-Website-Server

	function GetAbsoluteURL($RelativePath) {
		if ((strlen(_SiteURL)-1) !== strrpos(_SiteURL, "/")) {
			return _SiteURL."/".$RelativePath);
		}
		else {
			return _SiteURL.$RelativePath);
		}
	}
	
	function RedirectToPage($LanguageISOCode, $PageName) {
		if (empty($LanguageISOCode)) {
			RedirectToFileNotFoundPage();
		}
		else if (empty($PageName)) {
			RedirectToFileNotFoundPage($LanguageISOCode);
		}
		else {
			http_response_code(301);
			header("location: ".GetAbsoluteURL($LanguageISOCode."/".$PageName));
		}
	}

	function RedirectToFileNotFoundPage($LanguageISOCode = "") {
		if (! empty($LanguageISOCode)) {
			RedirectToPage($LanguageISOCode, _DefaultFileNotFoundPageName);
			die();
		}
		else {
			http_response_code(404);
			die("File not found");
		}
	}

	function RedirectToForbiddenPage($LanguageISOCode = "") {
		if (! empty($LanguageISOCode)) {
			RedirectToPage($LanguageISOCode, _DefaultForbiddenPageName);
			die();
		}
		else {
			http_response_code(403);
			die("Forbidden");
		}
	}

	function GetLanguageCode() {
		if (isset($_GET) && isset($_GET["lng"])) {
			$lng = strtolower(substr(trim($_GET["lng"]),0,2));
			for ($i = 0; $i < count(_AvailableLanguagesList); $i++) {
				if ($lng == _AvailableLanguagesList[$i]) {
					return $lng;
				}
			}
		}

		if (isset($_SERVER) && isset($_SERVER["HTTP_ACCEPT_LANGUAGE"])) {
			$tab = explode(",", $_SERVER["HTTP_ACCEPT_LANGUAGE"]);
			for ($j = 0; $j < count($tab); $j++) {
				$lng = strtolower(substr(trim($tab[$j]),0,2));
				for ($i = 0; $i < count(_AvailableLanguagesList); $i++) {
					if ($lng == _AvailableLanguagesList[$i]) {
						return $lng;
					}
				}
			}
		}

		return _DefaultLanguage;
	}

	require_once(__DIR__."/__common_settings-dist.inc.php");

	// Get the URI (part of the URL between the domaine name (with port) and the QUERY_STRING)
	$uri = trim($_SERVER["REQUEST_URI"]);

	// Remove the "/" character starting the URI
	while ((! empty($uri)) && (0 === strpos($uri, "/"))) {
		$uri = substr($uri, 1);
	}

	// Check the URI et show a page if available
	if (! empty($uri)) { // The URI is not empty, something has been asked
		if (false === ($tab = explode("/", $uri))) {
			// No "/" in the URI, try to access to a language folder or to a page without specifying the language

			$lang = $uri;
			$lang_lowercase = strtolower($lang);

			// Check if this language ISO code is available
			$LanguageISOCode = "";
			for ($i = 0; $i < count(_AvailableLanguagesList); $i++) {
				if ($lang_lowercase == _AvailableLanguagesList[$i]) {
					$LanguageISOCode = $lang_lowercase;
					break;
				}
			}
			
			if (! empty($LanguageISOCode)) {
				// The URI is a language code, show it's default page
				RedirectToPage($LanguageISOCode, _DefaultIndexPageName);
			}
			else {
				// The URI is not a language code, try to show it as a page under current browser language "folder"
				RedirectToPage(GetLanguageCode(), $page);
			}
		}
		else if (2 !== count($tab)) {
			// More than 1 "/" in the URI, it's not a valid path
			RedirectToFileNotFoundPage();
		}
		else {
			// Valid path ("xx/yyy"), try to show this page
			
			$lang = trim($tab[0]);
			$lang_lowercase = strtolower($lang);
			
			// Check if this language ISO code is available
			$LanguageISOCode = "";
			for ($i = 0; $i < count(_AvailableLanguagesList); $i++) {
				if ($lang_lowercase == _AvailableLanguagesList[$i]) {
					$LanguageISOCode = $lang_lowercase;
					break;
				}
			}

			if (empty($LanguageISOCode)) { // Invalid language code
				RedirectToFileNotFoundPage(GetLanguageCode());
			}
			else { // Valid language ISO code, we check the page name
				$page = trim($tab[1]);

				if (empty($page)) {
					// Page name is empty, we use the default page name
					$page = _DefaultIndexPageName;
				}

				if ($lang != $LanguageISOCode) {
					// The asked language folder name has the wrong case, redirect to the good one
					RedirectToPage($LanguageISOCode, $page);
				}
				else {
					require_once(_PathToIncludesFolder."/sendpage.inc.php");
					GenerateAndSendPage($LanguageISOCode, $page);
				}
			}
		}
	}
	else { // Show the home page of this website
		RedirectToPage(GetLanguageCode(), _DefaultIndexPageName);
	}
