<?php ///////////////////////////////////////////////////////
// ----------------------------------------------------------
// SNIPPET
// ----------------------------------------------------------
/////////////////////////////////////////////////////////////
// ----------------------------------------------------------
// Example embed code:
//
// $projects = $pages->find('work')->children()->visible()->paginate(10);
// snippet('pagination', array('pagination' => $projects->pagination(), 'range' => 5));
// ----------------------------------------------------------
///////////////////////////////////////////////////////////?>

<div role="pagination" class="Pagination">

	<p class="Pagination-count">
		<strong><?php echo $pagination->countItems(); ?></strong> results / showing <strong><?php echo $pagination->numStart(); ?></strong> &ndash; <strong><?php echo ($pagination->countItems() < $pagination->numEnd()) ? $pagination->countItems() : $pagination->numEnd(); ?></strong>
	</p>

	<?php if($pagination->countItems() > $pagination->limit): ?>
	<nav>
		<?php if(isset($range) && $pagination->countPages() > $range): ?>
			<?php if(!$pagination->isFirstPage()): ?>
				<a href="<?php echo (str::substr($pagination->firstPageURL(),0,-7)); ?>" class="Pagination-first">&larr;&larr; First</a>
			<?php else: ?>
				<span class="Pagination-first">&larr;&larr; First</span>
			<?php endif; ?>
		<?php endif; ?>

		<?php if($pagination->hasPrevPage()): ?>
			<?php if($pagination->page() == 2): ?>
				<a href="<?php echo (str::substr($pagination->firstPageURL(),0,-7)); ?>" class="Pagination-prev">&larr; Previous</a>
			<?php else: ?>
				<a href="<?php echo $pagination->prevPageURL(); ?>" class="Pagination-prev">&larr; Previous</a>
			<?php endif; ?>
		<?php else: ?>
			<span class="Pagination-prev">&larr; Previous</span>
		<?php endif; ?>

		<?php if(isset($range) && $pagination->countPages() > 1): ?>
			<?php foreach($pagination->range($range) as $range_num): ?>
				<a href="<?php echo $pagination->pageURL($range_num) ?>" class="Pagination-range<?php if($pagination->page() == $range_num) echo ' is-active' ?>"><?php echo $range_num ?></a></li>
			<?php endforeach ?>
		<?php endif; ?>

		<?php if($pagination->hasNextPage()): ?>
			<a href="<?php echo $pagination->nextPageURL(); ?>" class="Pagination-next">Next &rarr;</a>
		<?php else: ?>
			<span class="Pagination-next">Next &rarr;</span>
		<?php endif; ?>

		<?php if(isset($range) && $pagination->countPages() > $range): ?>
			<?php if(!$pagination->isLastPage()): ?>
				<a href="<?php echo $pagination->lastPageURL() ?>" class="Pagination-last">Last &rarr;&rarr;</a>
			<?php else: ?>
				<span class="Pagination-last">Last &rarr;&rarr;</span>
			<?php endif; ?>
		<?php endif; ?>
	</nav>
	<?php endif; ?>

</div>
