<?php ///////////////////////////////////////////////////////
//	---------------------------------------------------------
//	SNIPPET
//	---------------------------------------------------------
////////////////////////////////////////////////////////// ?>
<nav role="navigation" class="NavWrapper">
	<ul id="nav" class="NavMain">
		<li class="NavMain-item"><a rel="home" href="<?php echo $site->url(); ?>">Home</a></li>
		<?php foreach($pages->visible() as $page): ?>
			<li class="NavMain-item<?php echo ($page->isOpen()) ? ' is-active' : ''; ?>"><a href="<?php echo $page->url(); ?>"><?php echo html($page->title()); ?></a></li>
		<?php endforeach; ?>
	</ul>
	<ul class="NavMainToggle">
		<li class="NavMainToggle-open"><a href="#nav" class="NavMainToggle-item">Menu</a></li>
		<li class="NavMainToggle-close"><a href="#top">Top</a></li>
	</ul>
</nav>
