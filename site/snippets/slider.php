<?php ///////////////////////////////////////////////////////
//	---------------------------------------------------------
//	SNIPPET
//	---------------------------------------------------------
//	More info here: http://getkirby.com/forum/general/topic:45
//	---------------------------------------------------------
////////////////////////////////////////////////////////// ?>
<div id="slider" class="slider">
	<ol class="slider__group">
    <?php foreach($images as $image): ?>
		<li class="slider__item"><img src="<?php echo html($image->url()); ?>" width="<?php echo $image->width(); ?>" height="<?php echo $image->height()); ?>" class="slider__img"/></li>
    <?php endforeach; ?>
	</ol>
</div>