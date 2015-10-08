<?php

// HybridAuth endpoint to handle the OAuth handshake
$app->get(
    '/endpoint',
    function () use ( $config, $app ) {
        try {
            // Let HybridAuth handle the OAuth handshake.
            // If successful HybridAuth will redirect to the hauth_return_to URL
            // that is configured when calling $hybridauth->authenticate
            Hybrid_Endpoint::process();
        } catch (Exception $e) {
            $app->render(
                'error.twig',
                array(
                    'consumerKey' => $config[ 'providers' ][ 'XING' ][ 'keys' ][ 'key' ],
                    'error' => $e,
                )
            );
        }
    }
);
