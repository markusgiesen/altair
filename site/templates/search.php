<?php ///////////////////////////////////////////////////////
// ----------------------------------------------------------
// Search (results) settings
// ----------------------------------------------------------
/////////////////////////////////////////////////////////////

$search = new search(array(
	'searchfield'   => 'q',
	'ignore'        => array('search', 'error'),
	'mode'          => 'and',
	'words'         => true,
	'minlength'     => 3,
	'stopwords'     => array('the', 'or', 'in', 'and'),
	'score'         => array('title' => 4, 'text' => 2),
	'words'         => true,
	'paginate'      => 10
));

// Get the search results
$results = $search->results();

if(!empty($results)) {
	$pagination = $results->pagination();
}

/////////////////////////////////////////////////////////////
?>

<?php snippet_detect('html_head'); ?>

	<?php snippet('banner'); ?>

	<div role="main" class="Copy u-container">

		<h1>
			<?php
			if(!empty($results)) {
				echo $pagination->countItems()." searchresult(s) for <mark>".$search->query()."</mark>";
			} else {
				echo smartypants(widont($page->title()));
			}?>
		</h1>

		<form action="<?php echo thisURL(); ?>">
			<input type="text" placeholder="Type in your searchword…" name="q" value="<?php echo html($search->query()); ?>" class="TextInput" />
			<input type="submit" value="Search" class="Btn Btn--fancy" />
		</form>

		<div class="SearchResults">
			<?php if($results) : ?>

				<?php snippet('pagination', array('pagination' => $pagination)); ?>
					<?php foreach($results as $result): ?>
						<article>
							<a href="<?php echo $result->url(); ?>">
								<h2 class="delta"><?php echo smartypants($result->title()); ?></h2>

								<!-- With sarch keyword highlighting -->
								<p><?php echo search_highlight(excerpt($result->text()), $search->query(), 10); ?></p>

								<!-- Without sarch keyword highlighting -->
								<!-- <p><?php echo excerpt($result->text()); ?></p> -->

								<p class="SearchResults-url"><?php echo html($result->url()); ?></p>
							</a>
						</article>
					<?php endforeach; ?>
				<?php snippet('pagination', array('pagination' => $pagination)); ?>

			<?php elseif($search->query()): ?>
				<div class="SearchNoResults">No results for <strong><?php echo html($search->query()); ?></strong></div>
			<?php endif; ?>
		</div>

	</div><!--/Copy/u-container-->

<?php snippet_detect('footer'); ?>
