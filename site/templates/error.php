<?php snippet_detect('html_head'); ?>

	<?php snippet('banner'); ?>

	<div role="main" class="Copy u-container">

		<h1><?php echo smartypants(widont($page->title())); ?></h1>

		<?php echo kirbytext($page->text()); ?>

	</div><!--/main/Container-->

<?php snippet_detect('footer'); ?>
