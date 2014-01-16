<?php ///////////////////////////////////////////////////////
// ----------------------------------------------------------
// SNIPPET
// ----------------------------------------------------------
////////////////////////////////////////////////////////// ?>

<nav role="navigation" id="NavMain" class="NavMain js-navMain">
	<ul class="NavMain-list">
		<li class="NavMain-item"><a rel="home" href="<?php echo $site->url(); ?>">Home</a></li>
		<?php foreach($pages->visible() as $page): ?>
			<li class="NavMain-item<?php echo ($page->isOpen()) ? ' is-active' : ''; ?>"><a href="<?php echo $page->url(); ?>"><?php echo html($page->title()); ?></a></li>
		<?php endforeach; ?>
	</ul>
	<a href="#PageTop" class="NavMainToggle NavMainToggle--close js-navMainHide">Back to top</a>
</nav>
