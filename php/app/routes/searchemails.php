<?php

//search for emails
$app->get(
    '/searchemails(/?)(:query)',
    function ( $query = null ) use ( $hybridauth, $config, $app ) {
        if ($query === null || !$hybridauth->isConnectedWith( 'XING' )) {
            // redirect to home
            $app->redirect( $app->urlFor( RouteName::HOME ) );
        }

        /* @var $xingProvider Hybrid_Providers_XING */
        $xingProvider = $hybridauth->authenticate( 'XING' );
        $query = urldecode( $query );
        $usersFound = $xingProvider->findUsersByEmail( explode( ',', $query ), XingUserPicureSize::SIZE_64X64 );
        $viewVariablesArray = unserialize( $_SESSION[ 'viewVariables' ] );
        $viewVariablesArray = array_merge( $viewVariablesArray, array(
            'currentPage' => 'emails',
            'emails' => array(
                'query' => $query,
                'users' => $usersFound
            )
        ) );

        $_SESSION[ 'viewVariables' ] = serialize( $viewVariablesArray );
        $app->render( 'index.twig', $viewVariablesArray );
    }
)->name( RouteName::SEARCH_EMAILS );

