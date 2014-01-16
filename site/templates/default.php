<?php snippet_detect('html_head', array('prev_next' => true, 'prerender' => true, 'prefetch' => false)); ?>

	<?php snippet('banner'); ?>

	<div class="CoverImage FluidEmbed FluidEmbed--3by2 FluidEmbed--compact16by9 FluidEmbed--medium2by1 FluidEmbed--large3by1"
		style="background-image: url('<?php echo $pages->find('home')->images()->filterBy('title', '*=', 'cover-')->shuffle()->first()->url(); ?>')">
	</div>

	<!-- <div class="FluidEmbed FluidEmbed--3by2 FluidEmbed--compact16by9 FluidEmbed--medium2by1 FluidEmbed--large3by1">
		<img src="<?php echo $pages->find('home')->images()->filterBy('title', '*=', 'cover-')->shuffle()->first()->url(); ?>" class="FluidEmbed-item">
	</div> -->

	<div class="u-container">

		<div role="main" class="Copy">

			<h1><?php echo smartypants(widont($page->title())); ?></h1>

			<?php echo kirbytext($page->intro()); ?>
			<?php echo kirbytext($page->text()); ?>

		</div><!--/main/Copy-->

		<?php snippet('share_page'); ?>

	</div><!--/u-container-->

<?php snippet_detect('footer'); ?>
