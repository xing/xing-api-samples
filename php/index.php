<?php

// prepare the configuration for Hybryd_Auth  and require the XING classes that are needed for unserialization
require_once 'app/start.php';

// setup the slim framework
require_once 'app/setupSlim.php';

// define the routes used in the webapp
require_once 'app/routes.php';

$app->run();
