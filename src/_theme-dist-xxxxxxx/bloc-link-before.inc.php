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
		print("<!-- before link tag -->");
	}
