<?php ///////////////////////////////////////////////////////
// ----------------------------------------------------------
// SNIPPET
// ----------------------------------------------------------
/////////////////////////////////////////////////////////////

// Find the open/active page on the first level
$open  = $pages->findOpen();
$items = ($open) ? $open->children()->visible() : false;

////////////////////////////////////////////////////////// ?>

<?php if($items && $items->count()): ?>
	<nav>
		<h2 class="DeltaHeading">Sub navigation</h2>
		<ul class="List List--links">
			<?php foreach($items as $item): ?>
				<li class="NavSub-item<?php echo ($item->isOpen()) ? ' is-active' : ''; ?>"><a href="<?php echo $item->url(); ?>"><?php echo html($item->title()); ?></a></li>
			<?php endforeach; ?>
		</ul>
	</nav>
<?php endif; ?>
