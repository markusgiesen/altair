<?php ///////////////////////////////////////////////////////
// ----------------------------------------------------------
// PARTIAL
// ----------------------------------------------------------
////////////////////////////////////////////////////////// ?>

<header role="banner" class="Banner">
	<?php if($page->isHomePage()): echo '<h1'; else: echo '<a href="' . $site->url() . '" title="Return to the homepage" rel="home"'; endif; echo ' class="Masthead">'?>
		<img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Altair"/>
	<?php if($page->isHomePage()): echo $site->title() . '</h1>'; else: echo '</a>'; endif; ?>
	<a href="#NavMain" class="NavMainToggle NavMainToggle--open js-navMainShow">Jump to navigation</a>
</header>
