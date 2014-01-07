<?php ///////////////////////////////////////////////////////
//	---------------------------------------------------------
//	PARTIAL :: DESKTOP
//	---------------------------------------------------------
////////////////////////////////////////////////////////// ?>

	<?php snippet('nav_main'); ?>

<?php
// Assets (dev vs. min+hash)
$assets_js = f::read(server::get('document_root') . '/assets/javascript/min/hash.js.json', 'json');
if(c::get('environment') == 'local'):
	$env_suffix = 'dev';
	$main_js = 'main.scripts.dev';
else:
	$env_suffix = 'min';
	$main_js = a::get($assets_js, 'main');
endif;
?>
	<div role="ontentinfo" class="ContentInfo u-container">
		<footer>
			<?php echo kirbytext($site->copyright()); ?>
			<p><small>All contents licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/3.0/" title="Creative Commons Attribution-Non-Commercial-No-Derivs 3.0 Unported">CC BY-NC-ND license</a>.</small></p>
			<p>desktop</p>
		</footer>
	</div><!--/ContentInfo-->

	<!-- JavaScript at the bottom of page for fast page loading -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<?php echo url('assets/javascript/vendor/jquery.min.js'); ?>"><\/script>')</script>
	<script defer src="<?php echo url('assets/javascript/'. $env_suffix .'/' . $main_js . '.js'); ?>"></script>

	<?php snippet('analytics'); ?>
</body>
</html>
