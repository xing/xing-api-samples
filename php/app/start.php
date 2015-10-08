<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/config.php';
$hybridauth = new Hybrid_Auth( $config );

if (isset( $config[ 'providers' ][ 'XING' ][ 'wrapper' ][ 'path' ] )) {
    // Require all the XING related classes so we can unserialize correctly object from the session
    // Otherwise we'll end up with __PHP_Incomplete_Class when unserializing
    $xingIncludesDir = dirname( $config[ 'providers' ][ 'XING' ][ 'wrapper' ][ 'path' ] );
    foreach (glob( $xingIncludesDir . '/*.php' ) as $filename) {
        require_once $filename;
    }
}