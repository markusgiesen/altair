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
		<strong><?php echo $pagination->countItems(); ?></strong> results / showing <strong><?php echo $pagination->numStart(); ?></strong> &ndash; <strong><?php echo $pagination->numEnd(); ?></strong>
	</p>

	<?php if($pagination->countItems() > $pagination->limit ): ?>
	<nav>
		<?php if(!$pagination->isFirstPage()): ?>
			<a class="Pagination-first" href="<?php echo $pagination->firstPageURL() ?>">&larr;&larr; First</a>
		<?php else: ?>
			<span class="Pagination-first">&larr;&larr; First</span>
		<?php endif ?>

		<?php if($pagination->hasPrevPage()): ?>
			<a href="<?php echo $pagination->prevPageURL(); ?>" class="Pagination-prev">&larr; Previous</a>
		<?php else: ?>
			<span class="Pagination-prev">&larr; Previous</span>
		<?php endif; ?>

		<?php if(isset($range) && $pagination->countPages() > 1): ?>
			<?php foreach($pagination->range($range) as $range): ?>
				<a href="<?php echo $pagination->pageURL($range) ?>" class="Pagination-range<?php if($pagination->page() == $range) echo ' is-active' ?>"><?php echo $range ?></a></li>
			<?php endforeach ?>
		<?php endif; ?>

		<?php if($pagination->hasNextPage()): ?>
			<a href="<?php $pagination->nextPageURL(); ?>" class="Pagination-next">Next &rarr;</a>
		<?php else: ?>
			<span class="Pagination-next">Next &rarr;</span>
		<?php endif; ?>

		<?php if(!$pagination->isLastPage()): ?>
			<a class="Pagination-last" href="<?php echo $pagination->lastPageURL() ?>">Last &rarr;&rarr;</a>
		<?php else: ?>
			<span class="Pagination-last">Last</span>
		<?php endif ?>
	</nav>
	<?php endif; ?>

</div>
