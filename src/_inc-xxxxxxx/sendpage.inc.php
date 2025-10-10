<?php
	// Link Website Generator
	// (c) 2025 Patrick Prémartin
	//
	// Distributed under license AGPL.
	//
	// Infos and updates :
	// https://github.com/DeveloppeurPascal/Link-Website-Server

	function GenerateAndSendPage($LanguageISOCode, $PageName) {
		require_once(_PathToIncludesFolder."/pagedata.inc.php");
		
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
					if (false !== ($Settings = GetSettingsData())) {
						$ThemeFile = (isset($PageData->theme_file) && (!empty($PageData->theme_file)))?$PageData->theme_file:$Settings->default_theme_file;
						if (empty($ThemeFile))
							$ThemeFile = _DefaultTemplateFileName;
						if (!file_exists(_PathToThemeFolder."/".$ThemeFile.".inc.php")) {
							// TODO : add an error to log
							RedirectToForbiddenPage($LanguageISOCode);
						}
						else {
							// Open the theme file which can use $LanguageISOCode, $Settings and $PageData objects
							require_once(_PathToThemeFolder."/".$ThemeFile.".inc.php");
						}
					}
					else {
						// No local settings defined in the database, acces forbidden
						RedirectToForbiddenPage($LanguageISOCode);
					}
				}
				else {
					// The page is private, access forbidden
					RedirectToForbiddenPage($LanguageISOCode);
				}	
			}
		}
	}
