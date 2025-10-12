<?php
	// Block Page Site Server
	// (c) 2025 Patrick Prémartin
	//
	// Distributed under license AGPL.
	//
	// Infos and updates :
	// https://blockpagesiteserver.trucs-de-developpeur-web.fr

	function GetPathForThemeFile($ThemeFile, $UseDefaultThemeIfNotExist = true) {
		if (empty($ThemeFile))
			return false;
		if (file_exists($path = _PathToThemeFolder."/".$ThemeFile.".inc.php"))
			return $path;
		if ($UseDefaultThemeIfNotExist && file_exists($path = _PathToDefaultThemeFolder."/".$ThemeFile.".inc.php"))
			return $path;
		return false;
	}

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
					if (false !== ($ThemeFilePath = GetPathForThemeFile($ThemeFile))) {
						// Open the theme file which can use $LanguageISOCode, $Settings and $PageData objects
						@include_once($ThemeFilePath);
					}
					else {
						// TODO : add an error to log
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
