<?php

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

/*

---------------------------------------
License Setup
---------------------------------------

Please add your license key, which you've received
via email after purchasing Kirby.

If you have no license yet, please buy one:
http://getkirby.com/buy and support an indie developer.

You are not allowed to run a website without a valid license key.
Please read the End User License Agreement for more information:
http://getkirby.com/license

*/

c::set('license', 'your license key');


/*

---------------------------------------
URL Setup
---------------------------------------

By default kirby tries to detect the correct url
for your site if this is set to false, but if this should fail
or you need to set it on your own, do it like this:

c::set('url', 'http://yourdomain.com');

Make sure to write the url without a trailing slash.

To work with relative URLs, you can set the URL like this:

c::set('url', '/');

*/

c::set('url', false);


/*

---------------------------------------
Subfolder Setup
---------------------------------------

Kirby will automatically try to detect the subfolder

i.e. http://yourdomain.com/subfolder

This might fail depending on your server setup.
In such a case, please set the correct subfolder here.

You must also set the right url then:

c::set('url', 'http://yoururl.com/subfolder');

if you are using the .htaccess file, make sure to
set the right RewriteBase there as well:

RewriteBase /subfolder

*/

c::set('subfolder', false);


/*

---------------------------------------
Rewrite URL Setup
---------------------------------------

Kirby uses apache's mod_rewrite to build nice
urls like http://yourdomain.com/about by default.
If you can't use mod_rewrite disable rewriting here.
Kirby will then switch to urls like this:

http://yourdomain.com/index.php/about

*/

c::set('rewrite', true);


/*

---------------------------------------
Homepage Setup
---------------------------------------

By default the folder/uri for your homepage is "home".
Sometimes it makes sense to change that to make your blog
your homepage for example. Just change it here in that case.

*/

c::set('home', 'home');


/*

---------------------------------------
Force SSL
---------------------------------------

If you want to make sure to force SSL on every
page, just set this setting to true.

Also make sure to include https in your url setup:
c::set('url', 'https://yourdomain.com');

*/

c::set('ssl', false);


/*

---------------------------------------
Environment
---------------------------------------

The environment this Kirby instance is running
such as: local, staging, production

*/

c::set('environment', 'production');

/*

---------------------------------------
Ignore Content Files
---------------------------------------

Sometimes it's necessary to ignore particular
content files/folders in all content folders.
Just add them to the array here. By default
the following files are being ignored:

array('.', '..', '.DS_Store', '.svn', '.git', '.htaccess');

…so you don't have to add them.

*/

c::set('content.file.ignore', array());


/*

---------------------------------------
Markdown Setup
---------------------------------------

You can globally switch Markdown parsing
on or off here.

To disable automatic line breaks in markdown
set markdown.breaks to false.

You can also switch between regular markdown
or markdown extra: http://michelf.com/projects/php-markdown/extra/

*/

c::set('markdown', true);
c::set('markdown.breaks', false);
c::set('markdown.extra', true);


/*

---------------------------------------
Smartypants Setup
---------------------------------------

Smartypants is a typography plugin, which
helps to improve things like quotes and ellipsises
and all those nifty little typography details.

You can read more about it here:
http://michelf.com/projects/php-smartypants/typographer/

Smartypants is switched off by default.
As soon as it is switched on it will affect all
texts which are parsed by kirbytext()

Set in smartypants.php to 1, 2 or 3 (default 1):
1  ->  "--" for em-dashes; no en-dash support
2  ->  "---" for em-dashes; "--" for en-dashes
3  ->  "--" for em-dashes; "---" for en-dashes

*/

c::set('smartypants', true);


/*

---------------------------------------
Tinyurl Setup
---------------------------------------

KirbyCMS has built in tiny urls for every
page. Tinyurls look like this:

http://yourdomain.com/x/asd2qd1c

the /x/ in the url is needed to detect tinyurls,
you can change the x to anything else but an existing page uri.

If you don't want to use tiny urls for your site
disable them here

*/

c::set('tinyurl.folder', 'x');
c::set('tinyurl.enabled', true);


/*

---------------------------------------
Cache
---------------------------------------

Enable or disable the cache.
It is enabled by default, but you
need to make sure that the site/cache
directory is writable.

You can also decide to disable/enable
either caching of the data structure
or the final html. If you are caching
the final html, make sure to clean
the cache, once you've modified your
templates. It's better to keep this
off until your site is ready for production.

Caching is switched off by default

With c::set('cache.autoupdate') you can set if
Kirby will automatically check for updates in your
content folder. Depending on the size of your site
this can slow down the performance, because the
filesystem is accessed a lot. Switch this off to
disabled autoupdating of cache files, but then you
need to make sure to delete cache files yourself after
each update.

With c::set('cache.ignore', array()); you can speficy
an array of URIs which should be skipped for caching.
If you got a search page for example you might not want
to cache each search result so you can add the URI of your
search site to the ignore array:

c::set('cache.ignore', array('search', 'some/other/uri/to/ignore'));

*/

c::set('cache', false);
c::set('cache.autoupdate', true);
c::set('cache.data', true);
c::set('cache.html', false);
c::set('cache.ignore', array('sitemap,feed,search'));


/*

---------------------------------------
Timezone Setup
---------------------------------------

You can change the default timezone used for all
date functions here. It is set to UTC by default.

Please read more about it at: http://php.net/manual/en/function.date-default-timezone-set.php

*/

c::set('timezone', 'UTC');


/*

---------------------------------------
Troubleshooting
---------------------------------------

Kirby has a built-in troubleshooting screen
with loads of information about your setup.

It's there to help you out when things don't work
as expected. Set it to true to activate it and
go to your homepage afterwards to display it on refresh.

*/

c::set('troubleshoot', false);


/*

---------------------------------------
Debug
---------------------------------------

Set this to true to enable php errors.
Make sure to keep this disabled for your
production site, so you won't get nasty
php errors there.

*/

c::set('debug', false);


/*

---------------------------------------
Your custom config file
---------------------------------------

this is your custom config file for your site.
you can set any variable here, which you want to reuse later.
setting custom config variables works like this:

c::set('yourvar', 'yourvalue');

you can access them later in your code like this

c::get('yourvar', 'some default value if the var is not set');

please be careful with existing config rules to not
overwrite them accidentally. Maybe just namespace them
in doubt like:

c::set('yourproject.yourvar', 'yourvalue');

*/


/*

---------------------------------------
Custom host setup
---------------------------------------

I've added a nice way to add different
config files for different environments

Let's say you run a development version of your
site at http://dev.yoursite.com and a production
version of your site at http://yoursite.com, you
can easily setup two different config files
by adding two more files in this directory and name them
like this:

config.dev.yoursite.com.php
config.yoursite.com.php

What happens is, that this global config.php
will be loaded first and afterwards only the
config file for the matching hostname will be
attached. So you can easily overwrite your global
custom config by specific rules for that host.

*/


/*

---------------------------------------
Embedded video setup
---------------------------------------

Set the default video width and height for
embedded flash videos from youtube or vimeo.

*/

c::set('kirbytext.video.width', 480);
c::set('kirbytext.video.height', 358);


/*

---------------------------------------
Thumb setup (image resizing)
---------------------------------------

Adjust the default settings of the thumb plugin
the thumb.php file must be located in the site/plugin folder.

*/

/* Cache settings */
c::set('thumb.cache.root', c::get('root') . '/thumbs');
c::set('thumb.cache.url',  c::get('url')  . '/thumbs');

/* General settings */
c::set('thumb.memory', 80);                      // make enough memory available to scale big(ger) images; something like 36M should be reasonble, but can be (much) higher for HiDPI images
c::set('thumb.progressive', true);               // set to true to output all thumb images as progressive, opposed to baseline (see: http://calendar.perfplanet.com/?p=1557)
c::set('resrc', false);                           // set to true to use resrc for retina images

/* Normal (@1x) thumb images */
c::set('thumb.quality', 70);                     // default JPG compression (or quality setting) for normal (@1x) thumb images
c::set('thumb.upscale', true);                   // set default upscale value for normal (@1x) thumb images

/* HiDPI (@2x) thumb images */
c::set('thumb.hd', true);                        // set to true to output all thumb images as HiDPI (@2x) images by default
// TO DO: ADD FROM RETINA_IMAGES BRANCH (KIRBY PACKAGE)!
// c::set('thumb.@2x', true);                       // set to true to output *both* normal (@1x) and HiDPI (@2x) thumb images if 'thumb.hd' setting is set to true (generates two same–name files, of which one has the '@2x' addition)
c::set('thumb.quality.hd', 40);                  // default JPG compression (or quality setting) for HiDPI (@2x) thumb images
c::set('thumb.upscale.hd', true);                // set default upscale value for HiDPI (@2x) thumb images

/* RWD container widths (needs the 'detect' (Mobile_Detect.php) plugin!) */
c::set('thumb.medium.container', 1224);          // 'medium' container width, defines max. width for image resizing (thumbs); mainly for desktop/laptop or wide screen devices (e.g. 'width: 1-1' is total container width)
c::set('thumb.compact.container', 1020);         // 'compact' container width, mainly for tablet or compact screen sizes
c::set('thumb.small.container', 568);            // 'small' container width, mainly for mobile (smartphone) devices (apply mobile first thus small is the default width)

/* Default multifigure breakpoint */
c::set('thumb.multifigure.break', 'small');      // set the default point of floating, breaking linearity (set as class on multifigure element)


/*

---------------------------------------
Multi-Language support setup
---------------------------------------

If you want to run a site with multiple languages,
enable support for it here. As soon as you set

c::set('lang.support', true);

Kirby will automatically create language-dependent
URLs like:

http://yourdomain.com/en/blog

or

http://yourdomain.com/de/blog

Make sure to set the default language code and
also the available language codes.

If you keep…

c::set('lang.detect', true);

Kirby will try to detect the default language
from the user agent string instead of using the
default language.

Use c::set('lang.locale', 'en_US'); for example
to set the default locale settings for all PHP functions

*/

c::set('lang.support', false);
c::set('lang.default', 'en');
c::set('lang.available', array('en', 'nl'));
c::set('lang.detect', true);
c::set('lang.locale', false);


/*

---------------------------------------
Content File Extension
---------------------------------------

Change the default file extension for your
content files here if you'd rather use something
else than txt. For example md or mdown.

*/

c::set('content.file.extension', 'md');


/*

---------------------------------------
Analytics, tracking, site stats
---------------------------------------

Set analytics method first [1] (ga-classic, ga-universal, gosquared or
segment-io) and then make sure the associated tracking ID/API KEY [2] is set
to start tracking/measuring for production environment only (tracking is
disabled for local and staging environments as long as no tracking code is
added to these environment specific config files!).

*/

/* Tracking method [1] */
c::set('analytics.tool', 'ga-universal');

/* Google analytics [2] */
c::set('google.analytics.id', 'TRACKING ID IS NOT SET');
c::set('google.analytics.code.optimized', true);

/* GoSquared [2] */
c::set('gosquared.id', 'TRACKING ID IS NOT SET');

/* Segment.io [2] */
c::set('segment.io.api.key', 'TRACKING API KEY IS NOT SET');
