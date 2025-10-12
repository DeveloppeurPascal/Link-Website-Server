<?php
	// Block Page Site Server
	// (c) 2025 Patrick Prémartin
	//
	// Distributed under license AGPL.
	//
	// Infos and updates :
	// https://blockpagesiteserver.trucs-de-developpeur-web.fr

// {
// 	type : "title"
// 		level (1 to 6)
// 		content [
// 			lang
// 			text
// 			is_public (boolean)
// 		]
// 	is_public (boolean)
// }

	if (isset($CurrentBlock) && is_object($CurrentBlock) && isset($CurrentBlock->type) && ("title" == $CurrentBlock->type)) {
		$level = (isset($CurrentBlock->level) && is_numeric($CurrentBlock->level) && ($CurrentBlock->level>=1) && ($CurrentBlock->level<=6))?$CurrentBlock->level:1;
		if (isset($CurrentBlock->content) && is_array($CurrentBlock->content) && (false !== ($content = GetObjectByLanguage($CurrentBlock->content,$LanguageISOCode)))) {
			print("<h".$level.(($LanguageISOCode!=$content->lang)?" lang=\"".$content->lang."\"":"").">".$content->text."</h".$level.">");
		}
	}
