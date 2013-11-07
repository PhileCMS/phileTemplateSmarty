<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
	<meta charset="utf-8" />
	<base href="{$base_url}/" />
	<title>{$meta.title} | {$site_title}</title>
	<meta property="og:type" content="article" />
	<meta property="og:title" content="{$current_page.title} | {$site_title}" />
	<meta property="og:description" content="{$meta.description}" />
	<meta property="og:url" content="{$current_page.url}" />
	<meta property="og:site_name" content="{$site_title}" />
	<link rel="stylesheet" href="{$theme_url}/css/style.css" type="text/css" />
	<link rel="stylesheet" href="{$theme_url}/css/tomorrow-night.css" type="text/css" />
</head>
<body>
	<header id="header">
		<div class="inner clearfix">
			<h1><a href="{$base_url}">{$site_title}</a></h1>
			<ul class="nav">
				{foreach $pages as $page}
				<li><a href="{$page.url}">{$page.title}</a></li>
				{/foreach}
			</ul>
		</div>
	</header>
	<section id="content">
		<div class="inner">
			{$content}
		</div>
	</section>
	<footer id="footer">
		<div class="inner">
			<a href="https://github.com/PhileCMS/Phile">Phile</a> was made by <a href="https://github.com/PhileCMS">The PhileCMS Community</a>.
		</div>
	</footer>
	<script src="{$theme_url}/js/highlight.js"></script>
	<script>hljs.initHighlightingOnLoad();</script>
</body>
</html>
