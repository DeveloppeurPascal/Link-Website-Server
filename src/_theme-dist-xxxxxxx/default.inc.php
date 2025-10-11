<?php
	// Link Website Generator
	// (c) 2025 Patrick Prémartin
	//
	// Distributed under license AGPL.
	//
	// Infos and updates :
	// https://github.com/DeveloppeurPascal/Link-Website-Server

?><!DOCTYPE html>
<html lang="<?php print($LanguageISOCode); ?>">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
		<?php
			if (false !== ($LTitle = GetObjectByLanguage($PageData->head->title,$LanguageISOCode))) {
				print("<title lang=\"".$LTitle->lang."\">".$LTitle->text."</title>");
			}
		?><link rel="canonical" href="<?php print(GetAbsoluteURL($LanguageISOCode."/".$page_filename)); ?>" />
		<?php
			for ($i = 0; $i < count(_AvailableLanguagesList); $i++) {
				if ($LanguageISOCode !== _AvailableLanguagesList[$i]) {
					print("<link rel=\"alternate\" href=\"".GetAbsoluteURL(_AvailableLanguagesList[$i]."/".$page_filename)."\" hreflang=\""._AvailableLanguagesList[$i]."\" />\n");
				}
			}
			if (! empty(_DefaultLanguage)) {
				print("<link rel=\"alternate\" href=\"".GetAbsoluteURL(_DefaultLanguage."/".$page_filename)."\" hreflang=\"x-default\" />\n");
			}
			if (defined("_AppleApplicationId") && (! empty(_AppleApplicationId))) {
				print("<meta name=\"apple-itunes-app\" content=\"app-id="._AppleApplicationId."\" />\n");
			}
			if (defined("_MetaRobots") && (! empty(_MetaRobots))) {
				print("<META NAME=\"ROBOTS\" CONTENT=\""._MetaRobots."\">\n");
			}
			if (defined("_FavIconFilePath") && (! empty(_FavIconFilePath))) {
				print("<link rel=\"icon\" type=\"image/x-icon\" href=\"".GetAbsoluteURL(_FavIconFilePath)."\">\n");
			}
		?>
		<style>
			#container {
				width: 800px;
				margin: auto;
				max-width: 100%;
			}
			header {
				margin-bottom: 1em;
			}
			.LogoTitre img {
				max-width: 100%;
			}
			nav {
				text-align: center;
			}
			nav .link {
			}
			nav .link.active {
				text-decoration: none;
			}
			nav .flag {
				height: 1em;
			}
			.PageTitle {
				text-align: center;
			}
			.ListItem {
				margin-top: 0.5em;
				margin-bottom: 0.5em;
				background-color: #DDDDDD;
			}
			.ListItem a {
				display: block;
				text-decoration: none;
				color: #000000;
				font-size: 1.5em;
			}
			.ListItem a:hover {
				// border-width: 0.1em;
				// border-color: #FF8800;
				// border-style: solid;
				background-color: #EEEEEE;
			}
			.ListItem img {
				vertical-align: middle;
				margin: 0.5em 0.5em 0.5em 0.5em;
				max-width: 100%;
				max-height: 2em;
			}
			.VideoItem {
				margin-top: 0.5em;
				margin-bottom: 0.5em;
				background-color: #DDDDDD;
			}
			footer {
				text-align: center;
				margin-top: 1em;
				border-top-width: 1px;
				border-top-color: #000000;
				border-top-style: solid;
			}
			footer .link {
			}
		</style>
	</head>
	<body>
		<div id="container">
			<header><?php
				if ($Settings->default_image->is_public) {
					if (false !== ($LAltText = GetObjectByLanguage($Settings->default_image->alt, $LanguageISOCode))) {
						print("<p class=\"LogoTitre\"><img src=\"".$Settings->default_image->url."\" alt=\"".$LAltText->text."\"></p>");
					}
					else {
						print("<p class=\"LogoTitre\"><img src=\"".$Settings->default_image->url."\"></p>");
					}
				}
				?><nav><?php
					if (count($Settings->menu_header)>0)) {
						foreach($Settings->menu_header as $LMenuHeader) {
							if (false !== ($LItem = GetObjectByLanguage($LMenuHeader, $LanguageISOCode))) {
								if ($LanguageISOCode != $LItem->lang) {
									if ($LItem->url == $PageData->page_name) {
										print("<a class=\"link active\" href=\"".$LItem->url."\"><span lang=\"".$LItem->lang."\">".$LItem->text."</span></a> ");
									}
									else {
										print("<a class=\"link\" href=\"".$LItem->url."\"><span lang=\"".$LItem->lang."\">".$LItem->text."</span></a> ");
									}
								}
								else {
									if ($LItem->url == $PageData->page_name) {
										print("<a class=\"link active\" href=\"".$LItem->url."\">".$LItem->text."</a> ");
									}
									else {
										print("<a class=\"link\" href=\"".$LItem->url."\">".$LItem->text."</a> ");
									}
								}
							}
						}
					}

					for ($i = 0; $i < count(_AvailableLanguagesList); $i++) {
						if ($LanguageISOCode !== _AvailableLanguagesList[$i]) {
							if (file_exists(__DIR__."/../img/flags/".strtolower(_AvailableLanguagesList[$i]).".png")) {
								print("<a href=\"../"._AvailableLanguagesList[$i]."/".$page_filename."\"><img src=\"../img/flags/".strtolower(_AvailableLanguagesList[$i]).".png\" class=\"flag\" alt=\"".strtoupper(_AvailableLanguagesList[$i])."\"></a> ");
							}
							else {
								print("<a href=\"../"._AvailableLanguagesList[$i]."/".$page_filename."\">".strtoupper(_AvailableLanguagesList[$i])."</a> ");
							}
						}
					}
				?></nav>
			</header>
			<section>
				<h1 class="PageTitle"><?php
					print(htmlentities($page_title, ENT_COMPAT, "UTF-8"));
				?></h1><?php
				if (isset($page_text_top)) {
					print($page_text_top);
				}
				if (isset($page_list) && is_array($page_list) && (count($page_list)>0)) {
					foreach($page_list as $item) {
						?><div class="ListItem"><?php
							if (isset($item->url) && (!empty($item->url))) {
								print("<a href=\"".$item->url."\">");
							}
							if (isset($item->logo_url) && (!empty($item->logo_url))) {
								if (isset($item->logo_alt) && (!empty($item->logo_alt))) {
									print("<img src=\"".$item->logo_url."\" alt=\"".$item->logo_alt."\"> ");
								}
								else {
									print("<img src=\"".$item->logo_url."\"> ");
								}
							}
							if (isset($item->text) && (!empty($item->text))) {
								print($item->text);
							}
							if (isset($item->url) && (!empty($item->url))) {
								print("</a>");
							}
						?></div><?php
					}
				}
				if (isset($page_video) && is_array($page_video) && (count($page_video)>0)) {
					foreach($page_video as $item) {
						?><div class="VideoItem"><?php
							if (isset($item->text_top)) {
								print($item->text_top);
							}
							if (isset($item->video)) {
								print($item->video);
							}
							if (isset($item->text_bottom)) {
								print($item->text_bottom);
							}
						?></div><?php
					}
				}
				if (isset($page_text_bottom)) {
					print($page_text_bottom);
				}
			?></section>
			<footer>
				<p><?php
					if (count($Settings->menu_footer)>0)) {
						foreach($Settings->menu_footer as $LMenuFooter) {
							if (false !== ($LItem = GetObjectByLanguage($LMenuFooter, $LanguageISOCode))) {
								if ($LanguageISOCode != $LItem->lang) {
									if ($LItem->url == $PageData->page_name) {
										print("<a class=\"link active\" href=\"".$LItem->url."\"><span lang=\"".$LItem->lang."\">".$LItem->text."</span></a> ");
									}
									else {
										print("<a class=\"link\" href=\"".$LItem->url."\"><span lang=\"".$LItem->lang."\">".$LItem->text."</span></a> ");
									}
								}
								else {
									if ($LItem->url == $PageData->page_name) {
										print("<a class=\"link active\" href=\"".$LItem->url."\">".$LItem->text."</a> ");
									}
									else {
										print("<a class=\"link\" href=\"".$LItem->url."\">".$LItem->text."</a> ");
									}
								}
							}
						}
					}
				?><br>
				<?php
					if (false !== ($LText = GetObjectByLanguage($Settings->copyright->text))) {
						if ($LanguageISOCode != $LText->lang) {
							print("<span lang=\"".$LItem->lang."\">".$LText->text."</span><br>\n");
						}
						else {
							print(.$LText->text."<br>\n");
						}
					}
				?>&copy; <?php
					print($Settings->copyright->created_year.(($Settings->copyright->created_year<date("Y"))?"-".date("Y"):""));
					if (! empty(_CopyrightPublisherURL)) {
						print("<a href=\""._CopyrightPublisherURL."\">"._CopyrightPublisherName."</a>");
					}
					else {
						print(_CopyrightPublisherName);
					}
				?></p>
			</footer>
		</div>
	</body>
</html>
