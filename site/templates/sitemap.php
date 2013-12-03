<?php
$ignore = array('sitemap', 'search', 'error', 'drafts');
header('Content-type: text/xml; charset="utf-8"');
echo '<?xml version="1.0" encoding="utf-8"?>';
?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.google.com/schemas/sitemap/0.84 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"<?php if(c::get('images.in.sitemap')): ?> xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"<?php endif; ?><?php if(c::get('lang.support')): ?> xmlns:xhtml="http://www.w3.org/1999/xhtml"<?php endif; ?>>
<?php foreach($pages->index() as $page): ?>
<?php if(in_array($page->uri(), $ignore)) continue ?>
	<url>
		<loc><?php echo html($page->url()); ?></loc>
		<?php if(c::get('images.in.sitemap')): ?>
			<?php if ($page->hasImages()): ?>
				<?php foreach($page->images() as $image): ?>
					<image:image>
						<image:loc><?php echo $image->url() ?></image:loc>
					</image:image>
				<?php endforeach; ?>
			<?php endif; ?>
		<?php endif; ?>
		<lastmod><?php echo $page->modified('c'); ?></lastmod>
		<priority><?php echo ($page->isHomePage()) ? 1 : number_format(0.5/$page->depth(), 1); ?></priority>
		<?php if(c::get('lang.support')): ?>
			<?php foreach(c::get('lang.available') as $lang): ?>
				<?php if($lang != c::get('lang.current')): ?>
					<xhtml:link rel="alternate" hreflang="<?php echo $lang; ?>" href="<?php echo $page->url($lang); ?>"/>
				<?php endif; ?>
			<?php endforeach; ?>
		<?php endif; ?>
	</url>
<?php endforeach; ?>
</urlset>
