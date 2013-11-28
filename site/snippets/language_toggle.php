<?php ///////////////////////////////////////////////////////
//	---------------------------------------------------------
//	SNIPPET
//	---------------------------------------------------------
////////////////////////////////////////////////////////// ?>
<?php if((c::get('lang.support'))): ?>
	<ul>
		<?php foreach(c::get('lang.available') as $lang):
			$active = ($lang == c::get('lang.current')) ? ' class="active"' : '';
			echo '<li' . $active . '><a href="' . $page->url($lang) . '">' . $lang . '</a></li>' . "\n\t";
		endforeach; ?>
	</ul>
<?php else: ?>
	<p>Language support is not enabled in config.php!</p>
<?php endif; ?>
