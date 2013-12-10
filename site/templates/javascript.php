<?php snippet_detect('html_head'); ?>

	<?php snippet('banner'); ?>

	<div class="u-container">

		<div role="main" class="Copy">

			<h1><?php echo smartypants(widont($page->title())); ?></h1>

			<?php echo kirbytext($page->intro()); ?>
			<?php echo kirbytext($page->text()); ?>

			<p>More to add&hellip;</p>

		</div><!--/main/Copy-->

		<?php snippet('share_page'); ?>

	</div><!--/u-container-->

	<script>
		push_message.push({status: 'info', type: 'modal', text: 'This page displays a few basic javascript functionality examples available in Altair.'});
	</script>

<?php snippet_detect('footer'); ?>
