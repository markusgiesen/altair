<?php ///////////////////////////////////////////////////////
//	---------------------------------------------------------
//	PARTIAL :: MOBILE
//	---------------------------------------------------------
////////////////////////////////////////////////////////// ?>
<?php
// Assets (dev vs. min+hash)
$assets_js = f::read(server::get('document_root') . '/assets/javascript/min/hash.js.json', 'json');
if(c::get('environment') == 'local'):
	$env_suffix = 'dev';
	$mobile_js = 'mobile.scripts.dev';
else:
	$env_suffix = 'min';
	$mobile_js = a::get($assets_js, 'mobile');
endif;
?>
	<div role="contentinfo" class="ContentInfo u-container">
		<footer>
			<?php echo kirbytext($site->copyright()); ?>
			<p><small>All contents licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/3.0/" title="Creative Commons Attribution-Non-Commercial-No-Derivs 3.0 Unported">CC BY-NC-ND license</a>.</small></p>
			<p>mobile</p>
		</footer>
	</div><!--/ContentInfo-->

	<!-- JavaScript at the bottom of page for fast page loading -->
	<script defer src="<?php echo url('assets/javascript/'. $env_suffix .'/' . $mobile_js . '.js'); ?>"></script>

	<?php snippet('analytics'); ?>
</body>
</html>
