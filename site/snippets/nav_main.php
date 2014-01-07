<?php ///////////////////////////////////////////////////////
//	---------------------------------------------------------
//	SNIPPET
//	---------------------------------------------------------
////////////////////////////////////////////////////////// ?>
<nav role="navigation" class="NavWrapper js-nav" id="nav">
	<ul id="nav" class="NavMain js-nav-content">
		<li class="NavMain-item"><a rel="home" href="<?php echo $site->url(); ?>">Home</a></li>
		<?php foreach($pages->visible() as $page): ?>
			<li class="NavMain-item<?php echo ($page->isOpen()) ? ' is-active' : ''; ?>"><a href="<?php echo $page->url(); ?>"><?php echo html($page->title()); ?></a></li>
		<?php endforeach; ?>
	</ul>
	<a href="#top" class="NavMainToggle NavMainToggle--close js-nav-close">Back to top</a>
</nav>
