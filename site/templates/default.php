<?php snippet_detect('html_head', array('prev_next' => true, 'prerender' => true, 'prefetch' => false)); ?>

	<?php snippet('banner'); ?>

	<div class="u-container">

		<article role="main" class="Copy">

			<h1><?php echo smartypants(widont($page->title())); ?></h1>

			<?php echo kirbytext($page->intro()); ?>
			<?php echo kirbytext($page->text()); ?>

		</article><!--/main/Copy-->

		<?php snippet('share_page'); ?>

	</div><!--/u-container-->

<?php snippet_detect('footer'); ?>
