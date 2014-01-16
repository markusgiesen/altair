<?php snippet_detect('html_head'); ?>

	<?php snippet('banner'); ?>

	<div class="Container">

		<div role="main" class="Copy">

			<h1><?php echo smartypants(widont($page->title())); ?></h1>

			<?php echo kirbytext($page->intro()); ?>
			<?php echo kirbytext($page->text()); ?>

			<p>More to add&hellip;</p>

		</div>

		<?php snippet('share_page'); ?>

	</div>

	<script>
		push_message.push({status: 'info', type: 'modal', text: 'This page displays a few basic javascript functionality examples available in Altair.'});
	</script>

<?php snippet_detect('footer'); ?>
