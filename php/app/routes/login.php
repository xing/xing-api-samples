<?php

// start the OAuth handshake
$app->get(
    '/login',
    function () use ( $hybridauth ) {
        // HybridAuth will take care to send the user to $config['base_url'],
        // which is the /endpoint route by default. After the handshake,
        // the user will be redirected to the hauth_return_to route.
        $hybridauth->authenticate( 'XING', array( 'hauth_return_to' => '/' ) );
    }
)->name( RouteName::LOGIN );

