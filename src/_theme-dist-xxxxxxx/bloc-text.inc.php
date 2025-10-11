<?php
// {
// 	type : "text"
// 	content [
// 		lang
// 		text
// 		is_public (boolean)
// 	]
// 	is_public (boolean)
// }

	if (isset($CurrentBlock) && is_object($CurrentBlock) && isset($CurrentBlock->type) && ("text" == $CurrentBlock->type)) {
		if (false !== ($content = (isset($CurrentBlock->content) && is_object($CurrentBlock->content))?GetObjectByLanguage($CurrentBlock->content,$LanguageISOCode))) {
			print("<p".(($LanguageISOCode!=$content->lang)?" lang=\"".$content->lang."\"":"").">".$content->text."</p>");
		}
	}
