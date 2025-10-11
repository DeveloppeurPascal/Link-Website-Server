<?php
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
		if (false !== ($content = (isset($CurrentBlock->content) && is_object($CurrentBlock->content))?GetObjectByLanguage($CurrentBlock->content,$LanguageISOCode))) {
			print("<h".$level.(($LanguageISOCode!=$content->lang)?" lang=\"".$content->lang."\"":"").">".$content->text."</h".$level.">");
		}
	}
