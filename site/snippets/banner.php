<?php ///////////////////////////////////////////////////////
//	---------------------------------------------------------
//	PARTIAL
//	---------------------------------------------------------
////////////////////////////////////////////////////////// ?>

<header role="banner" class="Banner u-container">

	<?php snippet('nav_main'); ?>

	<?php if($page->isHomePage()): echo '<h1'; else: echo '<a href="' . $site->url() . '" rel="home"'; endif; echo ' class="Masthead">'?>
		<img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" alt="<?php echo smartypants($site->title()); ?>">
	<?php if($page->isHomePage()): echo '</h1>'; else: echo '</a>'; endif; ?>

</header><!--/Banner-->
