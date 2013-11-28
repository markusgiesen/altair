<?php ///////////////////////////////////////////////////////
//	---------------------------------------------------------
//	SNIPPET
//	---------------------------------------------------------
////////////////////////////////////////////////////////// ?>
<div role="pagination" class="pagination">

	<p class="count">
		<strong><?php echo $pagination->countItems(); ?></strong> Results / showing <strong><?php echo $pagination->numStart(); ?></strong> &ndash; <strong><?php echo $pagination->numEnd(); ?></strong>
	</p>


	<?php if($pagination->countItems() > $pagination->limit ): ?>
	<nav>
    	<?php
        if($pagination->hasPrevPage()):
            echo '<a href="'.$pagination->prevPageURL().'" class="previous">&lsaquo; Previous</a>';
        else :
            echo '<span class="previous">&lsaquo; Previous</span>';
    	endif;

    	if($pagination->hasNextPage()):
            echo '<a href="'.$pagination->nextPageURL().'" class="next">Next &rsaquo;</a>';
        else :
            echo '<span class="next">Next &rsaquo;</span>';
    	endif;
        ?>
	</nav>
	<?php endif; ?>

</div>

