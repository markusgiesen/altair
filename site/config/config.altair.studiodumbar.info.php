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

Set analytics method and associated ID/API KEY in main config.
Tracking is disabled on local and staging environments.

*/

c::set('analytics.tool', false);
