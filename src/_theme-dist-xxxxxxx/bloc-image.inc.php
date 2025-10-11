<?php
// {
// 	type : "image"
// 	content [
// 		lang
// 		text
// 		url_image
// 		url
// 		is_public (boolean)
// 	]
// 	is_public (boolean)
// }

	if (isset($CurrentBlock) && is_object($CurrentBlock) && isset($CurrentBlock->type) && ("image" == $CurrentBlock->type)) {
		if (isset($CurrentBlock->content) && is_array($CurrentBlock->content) && (false !== ($content = GetObjectByLanguage($CurrentBlock->content,$LanguageISOCode)))) {
			print("<p".(($LanguageISOCode!=$content->lang)?" lang=\"".$content->lang."\"":"").">");
			$WithLink = isset($content->url) && (!empty($content->url));
			if ($WithLink)
				print("<a href=\"".$content->url."\">");
			print("<img".((isset($content->url_image) && (!empty($content->url_image)))?" src=\"".$content->url_image."\"":"").((isset($content->text) && (!empty($content->text)))?" alt=\"".$content->text."\"":"").">");
			if ($WithLink)
				print("</a>");
			print("</p>");
		}
	}
