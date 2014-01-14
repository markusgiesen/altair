<?php ///////////////////////////////////////////////////////
// ----------------------------------------------------------
// 1. Rename feed.php to whatever feed you need (e.g. newsfeed.php or
//    blogfeed.php), same name as f.i. blogfeed.txt
// 2. Replace '<your-feed-channel>' by the content channel of your choice
//    (e.g. news or blog)
// 3. More feeds, then copy feed.php and repeat step 1 and 2
// ----------------------------------------------------------
// More information: http://getkirby.com/blog/how-to-add-a-rss-feed
// ----------------------------------------------------------
/////////////////////////////////////////////////////////////

$feed_items = $pages->find('<your-feed-channel>')->children()->visible()->flip()->limit(10);

snippet('feed', array(
	'link' => url('<your-feed-channel>'),
	'items' => $feed_items,
	'descriptionField'  => 'text',
	'descriptionLength' => 300
));

?>
