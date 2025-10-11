<?php
// {
// 	type : "link"
// 	content [
// 		lang
// 		text
// 		url
// 		picto_url
// 		picto_alt
// 		is_public (boolean)
// 	]
// 	is_public (boolean)
// }

	if (isset($CurrentBlock) && is_object($CurrentBlock) && isset($CurrentBlock->type) && ("link" == $CurrentBlock->type)) {
		if (isset($CurrentBlock->content) && is_array($CurrentBlock->content) && (false !== ($content = GetObjectByLanguage($CurrentBlock->content,$LanguageISOCode)))) {
			print("<div class=\"ListItem\"".(($LanguageISOCode!=$content->lang)?" lang=\"".$content->lang."\"":"").">");
			$HasURL = isset($content->url) && (!empty($content->url));
			if ($HasURL)
				print("<a href=\"".$content->url."\">");
			if (isset($content->picto_url) && (!empty($content->picto_url))) {
				if (isset($content->picto_alt) && (!empty($content->picto_alt))) {
					print("<img src=\"".$content->picto_url."\" alt=\"".$content->picto_alt."\"> ");
				}
				else {
					print("<img src=\"".$content->picto_url."\"> ");
				}
			}
			if (isset($content->text) && (!empty($content->text))) {
				print($content->text);
			}
			if ($HasURL)
				print("</a>");
			print("</div>");
		}
	}
