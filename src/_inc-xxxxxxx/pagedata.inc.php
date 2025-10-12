<?php
	// Block Page Site Server
	// (c) 2025 Patrick Prémartin
	//
	// Distributed under license AGPL.
	//
	// Infos and updates :
	// https://blockpagesiteserver.trucs-de-developpeur-web.fr

	function GetPageDataFilePath($PageName) {
		return _PathToDatabaseFolder."/page_".sha1($PageName).".json";
	}

	function GetPageData($PageName) {
		$FilePath = GetPageDataFilePath($PageName);
		
		if (file_exists($FilePath)) {
			$json = json_decode(file_get_contents($FilePath));
			if ($json === null) {
				// TODO : add an error to log if an error occurs during JSON decode
//				die(json_last_error_msg());
				return false;
			}
			return $json;
		}
		// TODO : add an error to log if the file doesn't exist
		return false;
	}

	function GetSettingsData() {
		$FilePath = _PathToDatabaseFolder."/settings.json";
		
		if (file_exists($FilePath)) {
			$json = json_decode(file_get_contents($FilePath));
			if ($json === null) {
				// TODO : add an error to log if an error occurs during JSON decode
//				die(json_last_error_msg());
				return false;
			}
			return $json;
		}
		// TODO : add an error to log if the file doesn't exist
		return false;
	}

	function GetObjectByLanguage($ObjectsList, $LanguageISOCode, $ForceIsPublic = true) {
		global $Settings;
		
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
		if ($Settings->default_lang != $LanguageISOCode) {
			return GetObjectByLanguage($ObjectsList, $Settings->default_lang, $ForceIsPublic);
		}
		else {
			return false;
		}
	}

	function GetValueForKey($Where, $Key) {
		if (is_object($Where) && isset($Where->storage) && is_array($Where->storage) && (count($Where->storage)>0)) {
			foreach($Where->storage as $LItem) {
				if (is_object($LItem) && isset($LItem->key) && ($LItem->key == $Key)) {
					return $LItem->value;
				}
			}
		}
		return false;
	}
