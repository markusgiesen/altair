<?php ///////////////////////////////////////////////////////
//	---------------------------------------------------------
//	SNIPPET
//	---------------------------------------------------------
////////////////////////////////////////////////////////// ?>
<?php
if($site->uri->path(1) == '') { $shareUrl = $site->url(); } else { $shareUrl = $page->tinyurl(); } // make sure to enable tinyurl in config.php
$twittertext = 'Check out this “' . $page->title() . '” page on ' . $site->title() . ': ' . $shareUrl;
?>
<h2 class="u-deltaHeading">Share this page</h2>
<ul class="social">
	<li class="facebook"><a href="http://www.facebook.com/sharer.php?u=<?php echo $shareUrl; ?>&amp;t=<?php echo $page->title(); ?>" title="Share this page on Facebook (opens in new window)" target="external" class="js-popup">On Facebook</a></li>
	<li class="twitter"><a href="http://twitter.com/share?text=<?php echo rawurlencode($twittertext); ?>&amp;url=" title="Share this page on Twitter (opens in new window)" target="external" class="js-popup">On Twitter</a></li>
</ul>
