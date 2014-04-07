<?php snippet_detect('html_head', array('prev_next' => true, 'prefetch' => false)); ?>

	<?php snippet('banner'); ?>

	<div class="Container">

		<?php snippet('breadcrumb'); ?>

		<div role="main" class="Copy u-spaceTrailerM">

			<h1><?php echo smartypants(widont($page->title())); ?></h1>

			<?php if($page->date($format=true)) { ?>
				<p><small><?php snippet('datetime'); ?></small></p>
			<?php } ?>

			<?php echo kirbytext($page->intro()); ?>
			<?php echo kirbytext($page->text()); ?>

			<!-- start: load photos from folder -->
			<?php if($page->hasImages()) : ?>

				<h2>Photo(s) form page</h2>

				<?php foreach($page->images() as $image): ?>
				<figure>
					<?php if($image->caption()=='') {
						$imageAlt = $image->title();
					} else {
						$imageAlt = '';
					} ?>
					<?php echo thumb($image, array('width' => 450, 'height' => 450, 'hd' => false, 'crop' => true, 'alt' => $imageAlt)); ?>
					<!-- <img src="<?php echo $image->url(); ?>" alt="<?php echo $image->title(); ?>" /> -->
					<!-- <img src="http://photos.artlantis.nl/2012/<?php echo $image->title(); ?>.jpg" alt="<?php echo $image->title(); ?>" /> -->
					<?php if($image->caption()!='') : ?>
					<figcaption>
						<p><?php echo $image->caption(); ?></p>
					</figcaption>
					<?php endif; ?>
				</figure>
				<?php endforeach; ?>

			<?php endif; ?>
			<!-- end -->

		</div>

		<?php snippet('share_page'); ?>

		<?php snippet('nav_sub'); ?>

	</div>

<?php snippet_detect('footer'); ?>
