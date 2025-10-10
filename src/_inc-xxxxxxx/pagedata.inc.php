<?php
	// Link Website Generator
	// (c) 2025 Patrick Prémartin
	//
	// Distributed under license AGPL.
	//
	// Infos and updates :
	// https://github.com/DeveloppeurPascal/Link-Website-Server

	function GetPageDataFilePath($PageName) {
		return _PathToDatabaseFolder."/".sha1($PageName).".json";
	}

	function GetPageData($PageName) {
		$FilePath = GetPageDataFilePath($PageName);
		// TODO : add an error to log
	}

	function GetSettingsData() {
		$FilePath = _PathToDatabaseFolder."/settings.json";
		// TODO : add an error to log
	}

	function GetObjectByLanguage($ObjectsList, $LanguageISOCode, $ForceIsPublic = true) {
		if ((! is_array($ObjectsList)) || (0 == count($ObjectsList)) || empty($LanguageISOCode)) {
			return false;
		}
		for ($i = 0; $i < count($ObjectsList); $i++) {
			if ($ObjectsList[$i]->lang == $LanguageISOCode) {
				if (($ForceIsPublic && $ObjectsList[$i]->is_public) || (! $ForceIsPublic)) {
					return $ObjectsList[$i];
				}
				else {
					break;
				}
			}
		}
		if (_DefaultLanguage != $LanguageISOCode) {
			return GetObjectByLanguage($ObjectsList, _DefaultLanguage, $ForceIsPublic);
		}
		else {
			return false;
		}
	}
