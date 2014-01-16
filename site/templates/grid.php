<?php snippet_detect('html_head'); ?>

	<?php snippet('banner'); ?>

	<div class="Container">

		<div role="main" class="Copy">

			<h1><?php echo smartypants($page->title()); ?></h1>

			<?php echo kirbytext($page->intro()); ?>
			<?php echo kirbytext($page->text()); ?>

			<section>

				<h2>&lsquo;BlockGrid&rsquo; grid</h2>

				<div class="BlockGrid BlockGrid--compact2col BlockGrid--medium3to1 BlockGrid--large4col">

					<div class="BlockGrid-cell BlockGrid-cell--1">

						<p><strong>BlockGrid column I</strong>: etiam commodo fermentum imperdiet. Aliquam non velit ac nisi sollicitudin suscipit id et eros. Cras sed erat eros, imperdiet cursus odio. Nunc et commodo.</p>

					</div>

					<div class="BlockGrid-cell BlockGrid-cell--2">

						<p><strong>BlockGrid column II</strong>: nulla vestibulum magna quis eros accumsan in ultrices massa imperdiet. Curabitur at enim risus. Ut lacus nulla, tincidunt sit amet euismod eu, vehicula ut nisl. Duis a sapien.</p>

					</div>

					<div class="BlockGrid-cell BlockGrid-cell--3">

						<p><strong>BlockGrid column III</strong>: nulla vestibulum magna quis eros accumsan in ultrices massa imperdiet. Curabitur at enim risus. Ut lacus nulla, tincidunt sit amet euismod eu, vehicula ut nisl. Duis a sapien.</p>

					</div>

					<div class="BlockGrid-cell BlockGrid-cell--4">

						<p><strong>BlockGrid column IV</strong>: nulla vestibulum magna quis eros accumsan in ultrices massa imperdiet. Curabitur at enim risus. Ut lacus nulla, tincidunt sit amet euismod eu, vehicula ut nisl. Duis a sapien.</p>

					</div>

				</div>

			</section>

			<section>

				<h2>&lsquo;Grid&rsquo; grid</h2>

				<div class="Grid">

					<div class="Grid-cell u-size1of1--small u-size1of2--compact u-size1of4--medium u-sizeGoldenCol1of4--large">

						<p><strong>Grid column I</strong>: etiam commodo fermentum imperdiet. Aliquam non velit ac nisi sollicitudin suscipit id et eros. Cras sed erat eros, imperdiet cursus odio. Nunc et commodo.</p>

					</div>

					<div class="Grid-cell u-size1of1--small u-size1of2--compact u-size1of4--medium u-sizeGoldenCol2of4--large">

						<p><strong>Grid column II</strong>: nulla vestibulum magna quis eros accumsan in ultrices massa imperdiet. Curabitur at enim risus. Ut lacus nulla, tincidunt sit amet euismod eu, vehicula ut nisl. Duis a sapien.</p>

					</div>

					<div class="Grid-cell u-size1of1--small u-size1of2--compact u-size1of4--medium u-sizeGoldenCol3of4--large">

						<p><strong>Grid column III</strong>: nulla vestibulum magna quis eros accumsan in ultrices massa imperdiet. Curabitur at enim risus. Ut lacus nulla, tincidunt sit amet euismod eu, vehicula ut nisl. Duis a sapien.</p>

					</div>

					<div class="Grid-cell u-size1of1--small u-size1of2--compact u-size1of4--medium u-sizeGoldenCol4of4--large">

						<p><strong>Grid column IV</strong>: nulla vestibulum magna quis eros accumsan in ultrices massa imperdiet. Curabitur at enim risus. Ut lacus nulla, tincidunt sit amet euismod eu, vehicula ut nisl. Duis a sapien.</p>

					</div>

				</div>

			</section>

		</div>

		<?php snippet('share_page'); ?>

	</div>

<?php snippet_detect('footer'); ?>
