<?php snippet_detect('html_head'); ?>

	<?php snippet('banner'); ?>

	<div role="main" class="Container">

		<div class="Copy">

			<h1><?php echo smartypants(widont($page->title())); ?></h1>

			<?php echo kirbytext($page->text()); ?>

			<div class="Tweets">
				<?php $tweets = tweets('studiodumbar', array('hiderep' => true, 'limit' => 25, 'cache' => true, 'refresh' => 60 * 30)); ?>
				<ul>
					<?php $i = 1; ?>
					<?php foreach($tweets as $tweet): ?>
						<?php if($i <= 5): ?>
						<li>
							<p><?php echo $tweet->text(true) ?></p>
							<a class="date" href="<?php echo $tweet->url() ?>"><?php echo $tweet->date('h:i A - d M y') ?></a>
						</li>
						<?php endif; ?>
						<?php $i++; ?>
					<?php endforeach; ?>
				</ul>
				<p><a href="http://twitter.com/studiodumbar">Follow us on Twitter</a></p>
			</div>

		</div>

	</div>

<?php snippet_detect('footer'); ?>
