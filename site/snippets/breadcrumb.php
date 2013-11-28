<?php ///////////////////////////////////////////////////////
//	---------------------------------------------------------
//	SNIPPET
//	---------------------------------------------------------
////////////////////////////////////////////////////////// ?>
<p class="breadcrumb">
	<?php foreach($site->breadcrumb() as $crumb): ?>
	<?php if ($crumb->isActive()): ?>
	<?php continue; else: ?>
		<a href="<?php echo $crumb->url(); ?>"><?php echo $crumb->title(); ?></a>&nbsp;&nbsp;<span>/</span>&nbsp;
	<?php endif; endforeach; ?>
</p>
