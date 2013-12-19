<?php

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

/*

---------------------------------------
Cache
---------------------------------------

*/

c::set('cache', false);


/*

---------------------------------------
Timezone Setup
---------------------------------------

*/

c::set('timezone', 'UTC');


/*

---------------------------------------
Environment
---------------------------------------

*/

c::set('environment', 'stage');


/*

---------------------------------------
Troubleshooting
---------------------------------------

*/

c::set('troubleshoot', false);


/*

---------------------------------------
Debug
---------------------------------------

*/

c::set('debug', true);


/*

---------------------------------------
Resrc.io setup
---------------------------------------

*/

c::set('resrc', false);
c::set('resrc.domain', 'http://altair.studiodumbar.info');


/*

---------------------------------------
Analytics, tracking, site stats
---------------------------------------

*/

c::set('analytics.tool', false);
