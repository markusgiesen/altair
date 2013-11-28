<?php snippet_detect('html_head'); ?>

	<?php snippet('banner'); ?>

	<div role="main" class="u-container">

		<div class="Copy">

			<h1><?php echo smartypants(widont($page->title())); ?></h1>

			<?php echo kirbytext($page->text()); ?>

			<!-- Inline Alert example -->
			<div class="Alert Alert--inline js-dismissable">
				<div class="Alert-message">
					<p>Declare us your love and you will receive eternal gratitude!</p>
				</div>
					<button type="button" class="Alert-close" data-dismiss="Alert" aria-hidden="true" role="presentation">&times;</button>
			</div>

		</div>

		<?php snippet('contactform'); ?>

	</div><!--/main/u-container-->

<?php snippet_detect('footer'); ?>
