<!DOCTYPE html>
<html lang="<?php print(SITE_LANG); ?>">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
		<title><?php print(htmlentities($page_title, ENT_COMPAT, "UTF-8")); ?></title>
		<link rel="canonical" href="<?php print(SITE_URL."/".SITE_LANG."/".$page_filename); ?>" />
		<?php
			for ($i = 0; $i < count(SITE_LANG_LIST); $i++) {
				if (SITE_LANG !== SITE_LANG_LIST[$i]) {
					print("<link rel=\"alternate\" href=\"../".SITE_LANG_LIST[$i]."/".$page_filename."\" hreflang=\"".SITE_LANG_LIST[$i]."\" />\n");
				}
			}
			if (! empty(SITE_LANG_DEFAULT)) {
				print("<link rel=\"alternate\" href=\"".SITE_URL."/".SITE_LANG_DEFAULT."/".$page_filename."\" hreflang=\"x-default\" />\n");
			}
			if (defined("APPLE_APP_ID") && (! empty(APPLE_APP_ID))) {
				print("<meta name=\"apple-itunes-app\" content=\"app-id=".APPLE_APP_ID."\" />\n");
			}
			if (defined("META_ROBOTS") && (! empty(META_ROBOTS))) {
				print("<META NAME=\"ROBOTS\" CONTENT=\"".META_ROBOTS."\">\n");
			}
			if (defined("FAVICON_URL") && (! empty(FAVICON_URL))) {
				print("<link rel=\"icon\" type=\"image/x-icon\" href=\"".FAVICON_URL."\">\n");
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
				if (defined("LOGO_URL") && (! empty(LOGO_URL))) {
					if (defined("LOGO_ALT") && (! empty(LOGO_ALT))) {
						print("<p class=\"LogoTitre\"><img src=\"".LOGO_URL."\" alt=\"".LOGO_ALT."\"></p>");
					}
					else {
						print("<p class=\"LogoTitre\"><img src=\"".LOGO_URL."\"></p>");
					}
				}
				?><nav><?php
					if (isset($navlinks) && is_array($navlinks) && (count($navlinks)>0)) {
						foreach($navlinks as $text=>$url) {
							if ($url == $page_filename) {
								print("<a class=\"link active\" href=\"".$url."\">".$text."</a> ");
							}
							else {
								print("<a class=\"link\" href=\"".$url."\">".$text."</a> ");
							}
						}
					}

					for ($i = 0; $i < count(SITE_LANG_LIST); $i++) {
						if (SITE_LANG !== SITE_LANG_LIST[$i]) {
							if (file_exists(__DIR__."/../img/flags/".strtolower(SITE_LANG_LIST[$i]).".png")) {
								print("<a href=\"../".SITE_LANG_LIST[$i]."/".$page_filename."\"><img src=\"../img/flags/".strtolower(SITE_LANG_LIST[$i]).".png\" class=\"flag\" alt=\"".strtoupper(SITE_LANG_LIST[$i])."\"></a> ");
							}
							else {
								print("<a href=\"../".SITE_LANG_LIST[$i]."/".$page_filename."\">".strtoupper(SITE_LANG_LIST[$i])."</a> ");
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
					if (isset($footerlinks) && is_array($footerlinks) && (count($footerlinks)>0)) {
						foreach($footerlinks as $text=>$url) {
							if ($url == $page_filename) {
								print("<a class=\"link active\" href=\"".$url."\">".$text."</a> ");
							}
							else {
								print("<a class=\"link\" href=\"".$url."\">".$text."</a> ");
							}
						}
					}
				?><br>
				<?php
					if (isset($copy_text)) {
						print($copy_text);
					}
				?><br>
				&copy; <?php
					print(COPYRIGHT_FIRST_YEAR.((COPYRIGHT_FIRST_YEAR<date("Y"))?"-".date("Y"):"")." ");
					if (! empty(COPYRIGHT_PUBLISHER_URL)) {
						print("<a href=\"".COPYRIGHT_PUBLISHER_URL."\">".COPYRIGHT_PUBLISHER_NAME."</a>");
					}
					else {
						print(COPYRIGHT_PUBLISHER_NAME);
					}
				?></p>
			</footer>
		</div>
	</body>
</html>