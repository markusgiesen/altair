<?php

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

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
Environment
---------------------------------------

The environment this Kirby instance is running
such as: local, staging, production

*/

c::set('environment', 'stage');


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

c::set('debug', true);


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
c::set('analytics.tool', false);

/* Google analytics [2] */
c::set('google.analytics.id', 'TRACKING ID IS NOT SET');
c::set('google.analytics.code.optimized', true);

/* GoSquared [2] */
c::set('gosquared.id', 'TRACKING ID IS NOT SET');

/* Segment.io [2] */
c::set('segment.io.api.key', 'TRACKING API KEY IS NOT SET');
