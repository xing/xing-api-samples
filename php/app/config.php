<?php

// Hybrid-Auth Config file: http://hybridauth.sourceforge.net/userguide/Configuration.html
function getSiteBaseUrl()
{
    $protocol = ( !empty( $_SERVER[ 'HTTPS' ] ) && $_SERVER[ 'HTTPS' ] !== 'off' || $_SERVER[ 'SERVER_PORT' ] == 443 ) ? "https://" : "http://";
    $domainName = $_SERVER[ 'HTTP_HOST' ];

    return $protocol . $domainName;
}

$config = array(
    "base_url" => getSiteBaseUrl() . '/endpoint',
//      if we want to debug the Hybrid Auth flow
//        "debug_mode" => true,
//        "debug_file" => sys_get_temp_dir() . '/hybridauth.log',
    "providers" => array(
        "XING" => array(
            "enabled" => true,
            // go to https://dev.xing.com/applications and create an app to get a test key
            "keys" => array(
                "key" => "YOUR_CONSUMER_KEY",
                "secret" => "YOUR_CONSUMER_SECRET",
            ),
            "wrapper" => array(
                "path" => __DIR__ . "/../vendor/hybridauth/hybridauth/additional-providers/hybridauth-xing/Providers/XING.php",
                "class" => "Hybrid_Providers_XING",
            ),
        ),
    ),
);

