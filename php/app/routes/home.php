<?php

// default route: display the user details and offer log-in/out button
$app->get(
    '/',
    function () use ( $hybridauth, $config, $app ) {

        if (isset( $_SESSION[ 'viewVariables' ] )) {
            $viewVariablesArray = unserialize( $_SESSION[ 'viewVariables' ] );
        } else {
            $viewVariablesArray = array();
        }

        $viewVariablesArray = array_merge( $viewVariablesArray, array(
                'consumerKey' => $config[ 'providers' ][ 'XING' ][ 'keys' ][ 'key' ],
                'profile' => array(
                    'displayName' => 'Anonymous',
                    'photoURL' => 'https://www.xing.com/img/n/nobody_m.192x192.jpg'
                )
            )
        );
        if ($hybridauth->isConnectedWith( 'XING' )) {
            // Get the existing hybridauth session.
            // In theory `authenticate` could start the handshake,
            // but since we already know that hybridauth isConnectedWith XING,
            // this will work fine.
            /* @var $xingProvider Hybrid_Providers_XING */
            $xingProvider = $hybridauth->authenticate( 'XING' );
            $currentUser = $xingProvider->getUserProfile();

            $viewVariablesArray = array_merge( $viewVariablesArray, array(
                'currentPage' => 'home',
                'profile' => array(
                    'displayName' => $currentUser->displayName,
                    'photoURL' => $currentUser->photoURL
                ),
                'isLoggedIn' => $hybridauth->isConnectedWith( 'XING' ),
                'contacts' => $xingProvider->getUserContacts( XingUserPicureSize::SIZE_64X64 )
            ) );
        }
        $_SESSION[ 'viewVariables' ] = serialize( $viewVariablesArray );

        $app->render( 'index.twig', $viewVariablesArray );
    }
)->name( RouteName::HOME );
