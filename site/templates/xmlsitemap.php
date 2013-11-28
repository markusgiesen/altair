<?php

// exclude certain pages
$ignore = array('sitemap', 'search', 'error');

// send the right header
header('Content-type: text/xml; charset="utf-8"');

// echo the doctype
echo '<?xml version="1.0" encoding="utf-8"?>';

?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"<?php if(c::get('lang.support')): echo 'xmlns:xhtml="http://www.w3.org/1999/xhtml"'; endif; ?>>
<?php foreach($pages->index() as $page): ?>
<?php if(in_array($page->uri(), $ignore)) continue ?>
	<url>
		<loc><?php echo html($page->url()); ?></loc>
		<lastmod><?php echo $page->modified('c'); ?></lastmod>
		<priority><?php echo ($page->isHomePage()) ? 1 : number_format(0.5/$page->depth(), 1); ?></priority>
		<?php
		if(c::get('lang.support')):
			foreach(c::get('lang.available') as $lang):
				echo "<xhtml:link rel=\"alternate\" hreflang=\"".$lang."\" href=\"".$page->url($lang)."\" />\n\t\t";
			endforeach;
		endif;
		echo "\n";
		?>
	</url>
<?php endforeach; ?>
</urlset>