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
			if (isset($PageData->title) && is_array($PageData->title) && (false !== ($LTitle = GetObjectByLanguage($PageData->title,$LanguageISOCode)))) {
				print("<title lang=\"".$LTitle->lang."\">".$LTitle->text."</title>");
			}
		?><link rel="canonical" href="<?php print(GetAbsoluteURL($LanguageISOCode."/".$page_filename)); ?>" />
		<?php
			for ($i = 0; $i < count($Settings->langs); $i++) {
				if ($LanguageISOCode !== $Settings->langs[$i]->lang) {
					print("<link rel=\"alternate\" href=\"".GetAbsoluteURL($Settings->langs[$i]->lang."/".$page_filename)."\" hreflang=\"".$Settings->langs[$i]->lang."\" />\n");
				}
			}
			if (isset($Settings->default_lang) && (! empty($Settings->default_lang))) {
				print("<link rel=\"alternate\" href=\"".GetAbsoluteURL($Settings->default_lang."/".$page_filename)."\" hreflang=\"x-default\" />\n");
			}
			if (isset($Settings->apple_application_id) && (! empty($Settings->apple_application_id))) {
				print("<meta name=\"apple-itunes-app\" content=\"app-id=".$Settings->apple_application_id."\" />\n");
			}
			if (isset($PageData->meta_robots) && (! empty($PageData->meta_robots))) {
				print("<META NAME=\"ROBOTS\" CONTENT=\"".$PageData->meta_robots."\">\n");
			}
			else if (isset($Settings->default_meta_robots) && (! empty($Settings->default_meta_robots))) {
				print("<META NAME=\"ROBOTS\" CONTENT=\"".$Settings->default_meta_robots."\">\n");
			}
			if (isset($Settings->favicon_url) && (! empty($Settings->favicon_url))) {
				print("<link rel=\"icon\" type=\"image/x-icon\" href=\"".GetAbsoluteURL(favicon_url)."\">\n");
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
				if (isset($Settings->default_image) && is_object($Settings->default_image) && isset($Settings->default_image->is_public) && $Settings->default_image->is_public) {
					if (false !== ($LAltText = GetObjectByLanguage($Settings->default_image->alt, $LanguageISOCode))) {
						print("<p class=\"LogoTitre\"><img src=\"".$Settings->default_image->url."\" alt=\"".$LAltText->text."\"></p>");
					}
					else {
						print("<p class=\"LogoTitre\"><img src=\"".$Settings->default_image->url."\"></p>");
					}
				}
				?><nav><?php
					if (isset($Settings->menu_header) && is_array($Settings->menu_header) && (count($Settings->menu_header)>0)) {
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

					for ($i = 0; $i < count($Settings->langs); $i++) {
						if ($LanguageISOCode !== $Settings->langs[$i]->lang) {
							if (isset(Settings->langs[$i]->url) && (!empty(Settings->langs[$i]->url))) {
								print("<a href=\"../".$Settings->langs[$i]->lang."/".$page_filename."\"><img src=\"".GetAbsoluteURL($Settings->langs[$i]->url)."\" class=\"flag\" alt=\"".strtoupper($Settings->langs[$i]->lang)."\"></a> ");
							}
							else {
								print("<a href=\"../".$Settings->langs[$i]->lang."/".$page_filename."\">".strtoupper($Settings->langs[$i]->lang)."</a> ");
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
					if (isset($Settings->menu_footer) && is_array($Settings->menu_footer) && (count($Settings->menu_footer)>0)) {
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
						print("<br>\n");
					}
					if (isset($Settings->copyright) && is_object($Settings->copyright)) {
						if (false !== ($LText = GetObjectByLanguage($Settings->copyright->text))) {
							if ($LanguageISOCode != $LText->lang) {
								print("<span lang=\"".$LItem->lang."\">".$LText->text."</span><br>\n");
							}
							else {
								print($LText->text."<br>\n");
							}
						}
						print("&copy; ".$Settings->copyright->created_year.(($Settings->copyright->created_year<date("Y"))?"-".date("Y"):"")." ");
						if (isset($Settings->copyright) && isset($Settings->copyright->editors) && is_array($Settings->copyright->editors) && (0 < count($Settings->copyright->editors))) {
							$LFirst = true;
							foreach($Settings->copyright->editors as $LEditor) {
								if (false !== ($LItem = GetObjectByLanguage($LEditor, $LanguageISOCode))) {
									$LWithURL = isset($LItem->url) && (!empty($LItem->url));
									print(((!$LFirst)?"/ "."").($LWithURL?"<a href=\"".$LItem->url."\">":"").(($LanguageISOCode!=$LItem->lang)?"<span lang=\"".$LItem->lang."\">".$LItem->text."</span>":$LItem->text).($LWithURL?"</a>":"")." ");
									$LFirst = false;
								}
							}
						}
					}
				?></p>
			</footer>
		</div>
	</body>
</html>
