<?php
// {
// 	type : "html"
// 	content [
// 		lang
// 		text
// 		is_public (boolean)
// 	]
// 	is_public (boolean)
// }

	if (isset($CurrentBlock) && is_object($CurrentBlock) && isset($CurrentBlock->type) && ("html" == $CurrentBlock->type)) {
		if (false !== ($content = (isset($CurrentBlock->content) && is_object($CurrentBlock->content))?GetObjectByLanguage($CurrentBlock->content,$LanguageISOCode))) {
			print($content->text);
		}
	}
