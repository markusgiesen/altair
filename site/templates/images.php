<?php snippet_detect('html_head'); ?>

	<?php snippet('banner'); ?>

	<div class="u-container">

		<div role="main" class="Copy">

			<h1><?php echo smartypants(widont($page->title())); ?></h1>

			<?php echo kirbytext($page->intro()); ?>
			<?php echo kirbytext($page->text()); ?>

			<div class="MultiFigure">
				<?php echo kirbytext($page->multi_figure()); ?>
			</div>

			<div class="imgrid-container">
				<?php echo kirbytext($page->imgrid()); ?>
			</div>

		</div><!--/main/Copy>-->

		<?php snippet('share_page'); ?>

	</div><!--/u-container-->

<?php snippet_detect('footer'); ?>
