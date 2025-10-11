<?php
	// Link Website Generator
	// (c) 2025 Patrick Prémartin
	//
	// Distributed under license AGPL.
	//
	// Infos and updates :
	// https://github.com/DeveloppeurPascal/Link-Website-Server

	function GenerateAndSendPage($LanguageISOCode, $PageName) {
		global $Settings;
		
		$FilePath = GetPageDataFilePath($PageName);
		
		if (! file_exists($FilePath)) {
			RedirectToFileNotFoundPage($LanguageISOCode);
		}
		else {
			if (false === ($PageData = GetPageData($PageName))) {
				RedirectToFileNotFoundPage($LanguageISOCode);
			}
			else {
				if ($PageData->is_public) {
					$ThemeFile = (isset($PageData->theme_file) && (!empty($PageData->theme_file)))?$PageData->theme_file:$Settings->default_theme_file;
					if (empty($ThemeFile) || (!file_exists(_PathToThemeFolder."/".$ThemeFile.".inc.php"))) {
						// TODO : add an error to log
						RedirectToForbiddenPage($LanguageISOCode);
					}
					else {
						// Open the theme file which can use $LanguageISOCode, $Settings and $PageData objects
						@include_once(_PathToThemeFolder."/".$ThemeFile.".inc.php");
					}
				}
				else {
					// The page is private, access forbidden
					RedirectToForbiddenPage($LanguageISOCode);
				}	
			}
		}
	}
