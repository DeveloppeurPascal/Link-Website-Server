<?php
// {
// 	type : "title"
// 		level (1 to 6)
// 		content [
// 		lang
// 		text
// 		is_public (boolean)
// 	]
// 	is_public (boolean)
// }

	if (isset($CurrentBlock) && is_object($CurrentBlock) && isset($CurrentBlock->type) && ("title" == $CurrentBlock->type)) {
		print("<!-- before title tag -->");
	}
