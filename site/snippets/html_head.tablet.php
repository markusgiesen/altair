<?php ///////////////////////////////////////////////////////
// ----------------------------------------------------------
// PARTIAL :: TABLET
// ----------------------------------------------------------
/////////////////////////////////////////////////////////////

// Assets (dev vs. min+hash)
$assets_css = f::read(server::get('document_root') . '/assets/stylesheets/min/hash.css.json', 'json');
$assets_js = f::read(server::get('document_root') . '/assets/javascript/min/hash.js.json', 'json');
if(c::get('environment') == 'local'):
	$env_suffix = 'dev';
	$main_css = 'main.dev';
	$print_css = 'print.dev';
	$head_js = 'head.scripts.dev';
else:
	$env_suffix = 'min';
	$main_css = a::get($assets_css, 'main');
	$print_css = a::get($assets_css, 'print');
	$head_js = a::get($assets_js, 'head');
endif;

// Language(s)
if(c::get('lang.support')): $language_code = c::get('lang.current'); $canonical_slash = '';
else: $language_code = c::get('lang.default'); $canonical_slash = '/'; endif;

// Page title
if($page->isHomePage() && $site->descriptor() != ''): $pagetitle = smartypants(titlecase($site->descriptor()));
elseif($page->subtitle() && $page->subtitle() != ''): $pagetitle = smartypants(titlecase($page->subtitle()));
else: $pagetitle = smartypants(titlecase($page->title())); endif;

// Meta description
if($page->meta_description() && $page->meta_description() != ''): $meta_description = smartypants($page->meta_description());
elseif($page->intro() && $page->intro() != ''): $meta_description = excerpt($page->intro(), 154);
elseif($page->text() && $page->text() != ''): $meta_description = excerpt($page->text(), 154);
else: $meta_description = ''; endif;

// Variable to set next and previous rel="next/prev" links.
// To enable add array to 'snippet_detect('html_head');' at top of template:
// 'snippet_detect('html_head', array('prev_next' => true));'
if(!isset($prev_next)): $prev_next = false; endif;

// Variable to set next and previous rel="prerender" links.
// To enable add add array to 'snippet_detect('html_head');' at top of template:
// 'snippet_detect('html_head', array('prerender' => true));'
if(!isset($prerender)): $prerender = false; endif;

// Variable to set next and previous rel="prefetch" links.
// To enable add add array to 'snippet_detect('html_head');' at top of template:
// 'snippet_detect('html_head', array('prefetch' => true));'
if(!isset($prefetch)): $prefetch = false; endif;

////////////////////////////////////////////////////////// ?>

<!doctype html>
<!-- <html manifest="/cache.appcache" class="no-js" lang="<?php echo $language_code; ?>"> -->
<html class="no-js" lang="<?php echo $language_code; ?>">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">

	<!-- Prefetch DNS for external assets (Typekit, Google APIs, etc). -->
	<link rel="dns-prefetch" href="//use.typekit.net">
	<link rel="dns-prefetch" href="//fonts.googleapis.com">
	<link rel="dns-prefetch" href="//ajax.googleapis.com">
	<link rel="dns-prefetch" href="//www.google-analytics.com">

	<title><?php echo smartypants($site->title()) . ': ' . $pagetitle; ?></title>

	<link rel="home" href="<?php echo $site->url(); ?>">
	<link rel="sitemap" type="application/xml" title="<?php echo smartypants(titlecase($pages->find('sitemap/xmlsitemap')->title())); ?>" href="<?php echo html($site->pages()->find('sitemap')->url()); ?>">
	<link rel="alternate" type="application/rss+xml" title="<?php echo smartypants(titlecase($pages->find('blog/feed')->title())); ?>" href="<?php echo html(url('blog/feed')); ?>">
	<link rel="publisher" href="https://plus.google.com/xxxxxxxxxxxxxxxxxxxxx">

	<meta name="author" content="<?php echo smartypants($site->author()); ?>">
	<?php if($meta_description != ''): ?><meta name="description" content="<?php echo smartypants($meta_description); ?>"><?php endif; ?>
	<?php if(c::get('environment') == 'local' || c::get('environment') == 'stage'): ?><meta name="robots" content="noindex, nofollow"><?php else: ?><meta name="robots" content="index, follow"><?php endif; ?>

	<?php
	// Canonical rel links (also/especially for multiple languages)
	if($page->isHomepage()):
		echo '<link rel="canonical" href="' . $site->url() . '">' . "\n\t";
	else:
		echo '<link rel="canonical" href="' . $site->url($language_code) . $canonical_slash . $site->uri->path() . '">' . "\n\t";
	endif;
	if((c::get('lang.support')) && ($page->contents()->count() > 1 )):
		foreach(c::get('lang.available') as $lang):
			echo '<link rel="alternate" href="' . $page->url($lang) . '" hreflang="' . $lang . '">' . "\n\t";
		endforeach;
	endif;

	// Shortlink (to use enable tinyurl in config.php)
	if((c::get('tinyurl.enabled')) && ($site->uri->path(1) != '')): echo '<link rel="shortlink" href="' . $page->tinyurl() . '">' . "\n\t"; endif;

	// Next and previous rel links (to use set $prev_next varibale in template)
	if($prev_next && $page->hasNextVisible()): echo '<link rel="next" href="' . $page->nextVisible()->url() . '" title="' . smartypants($page->nextVisible()->title()) . '">' . "\n\t"; endif;
	if($prev_next && $page->hasPrevVisible()): echo '<link rel="prev" href="' . $page->prevVisible()->url() . '" title="' . smartypants($page->prevVisible()->title()) . '">' . "\n\t"; endif;

	// Prerender next and previous pages (to use set $prerender varibale in template)
	// if($prerender):
	// 	if($page->hasNextVisible()): echo '<link rel="prerender" href="' . $page->nextVisible()->url() . '">' . "\n\t"; endif; // Chrome only?!
	// 	if($page->hasPrevVisible()): echo '<link rel="prerender" href="' . $page->prevVisible()->url() . '">' . "\n"; endif; // Chrome only?!
	// endif;

	// Prefetch next and previous pages (to use set $prefetch varibale in template)
	// if($prefetch):
	// 	if($page->hasNextVisible()): echo '<link rel="prefetch" href="' . $page->nextVisible()->url() . '">' . "\n\t"; endif;
	// 	if($page->hasPrevVisible()): echo '<link rel="prefetch" href="' . $page->prevVisible()->url() . '">' . "\n\t"; endif;
	// endif;
	?>

	<!-- Custom (and shorter!) label for iOS6 home screen bookmarks -->
	<meta name="apple-mobile-web-app-title" content="<?php echo smartypants($site->title()); ?>">

	<!-- Favicons (https://github.com/audreyr/favicon-cheat-sheet) -->
	<link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo url('assets/images/favicon-152.png'); ?>">
	<link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php echo url('assets/images/favicon-120.png'); ?>">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo url('assets/images/favicon-72.png'); ?>">
	<link rel="apple-touch-icon-precomposed" href="<?php echo url('assets/images/favicon-57.png'); ?>">
	<link rel="icon" href="<?php echo url('assets/images/favicon-228.png'); ?>" sizes="228x228">
	<link rel="icon" href="<?php echo url('assets/images/favicon-195.png'); ?>" sizes="195x195">
	<link rel="icon" href="<?php echo url('assets/images/favicon-96.png'); ?>" sizes="96x96">
	<link rel="icon" href="<?php echo url('assets/images/favicon-32.png'); ?>" sizes="32x32">
	<meta name="msapplication-TileImage" content="<?php echo url('assets/images/favicon-144.png'); ?>">
	<meta name="msapplication-TileColor" content="#332C29">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="<?php echo url('assets/stylesheets/' . $env_suffix . '/' . $main_css . '.css'); ?>">
	<link rel="stylesheet" href="<?php echo url('assets/stylesheets/' . $env_suffix . '/' . $print_css . '.css'); ?>" media="print">

	<!-- Head scripts (Enable for CuttingTheMustard, Typekit, WebFont Loader or ReSRC.it!) -->
	<script src="<?php echo url('assets/javascript/'. $env_suffix .'/' . $head_js . '.js'); ?>"></script>

	<!-- Initialize empty array for possible messages -->
	<script>var push_message = [];</script>
</head>
<body>
