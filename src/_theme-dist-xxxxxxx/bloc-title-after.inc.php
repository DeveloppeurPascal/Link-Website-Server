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
// 		lang
// 		text
// 		is_public (boolean)
// 	]
// 	is_public (boolean)
// }

	if (isset($CurrentBlock) && is_object($CurrentBlock) && isset($CurrentBlock->type) && ("title" == $CurrentBlock->type)) {
		print("<!-- after title tag -->");
	}
