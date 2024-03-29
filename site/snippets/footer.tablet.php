<?php ///////////////////////////////////////////////////////
// ----------------------------------------------------------
// PARTIAL :: TABLET
// ----------------------------------------------------------
/////////////////////////////////////////////////////////////

// Assets (dev vs. min+hash)
$assets_js = f::read(server::get('document_root') . '/assets/javascript/min/hash.js.json', 'json');
if(c::get('environment') == 'local'):
	$env_suffix = 'dev';
	$main_js = 'main.scripts.dev';
else:
	$env_suffix = 'min';
	$main_js = a::get($assets_js, 'main');
endif;

////////////////////////////////////////////////////////// ?>

	<?php snippet('nav_main'); ?>

	<div role="contentinfo" class="ContentInfo">
		<footer>
			<?php echo kirbytext($site->copyright()); ?>
			<p><small>All contents licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/" title="Creative Commons Attribution-Non-Commercial-No-Derivs 4.0 International">CC BY-NC-ND license</a>.</small></p>
			<p>tablet</p>
		</footer>
	</div>

	<!-- <script defer src="<?php // echo url('assets/javascript/plugins/ios.orientation.fix.js'); ?>"></script> -->
	<script defer src="<?php echo url('assets/javascript/'. $env_suffix .'/' . $main_js . '.js'); ?>"></script>

	<?php snippet('analytics'); ?>
</body>
</html>
