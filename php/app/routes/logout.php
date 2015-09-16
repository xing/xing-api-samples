<?php

// log the user out
$app->get(
    '/logout',
    function () use ( $hybridauth, $app ) {
        // clear the session
        session_destroy();
        $hybridauth->logoutAllProviders();
        $app->redirect( '/' );
    }
)->name( RouteName::LOGOUT );