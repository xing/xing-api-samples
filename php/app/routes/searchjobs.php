<?php

// search for jobs
$app->get(
    '/searchjobs(/?)(:query)(/:currentPaginatorPage)',
    function ( $query = null,$currentPaginatorPage=null) use ( $hybridauth, $config, $app ) {
        if ($query === null || !$hybridauth->isConnectedWith( 'XING' )) {
            // redirect to home
            $app->redirect( $app->urlFor( RouteName::HOME ) );
        }

        $xingProvider = $hybridauth->authenticate( 'XING' );
        /* @var $xingProvider Hybrid_Providers_XING */
        $viewVariablesArray = unserialize($_SESSION['viewVariables']) ;
        $jobsCountPerPage = 10;

        $currentPaginatorPage = $currentPaginatorPage != null ? $currentPaginatorPage : 1;
        $offset = $jobsCountPerPage * ( $currentPaginatorPage - 1 );

        list ($items,$totalCount, )= $xingProvider->findJobsByQuery( $query ,$offset);
        $viewVariablesArray = array_merge( $viewVariablesArray, array(
            'currentPage' => 'jobs',
            'jobs' => array(
                'items' => $items,
                'totalCount' => $totalCount,
                'currentPaginatorPage' => $currentPaginatorPage,
                'query' => $query,
                'jobsCountPerPag' => $jobsCountPerPage
            )
        ) );

        $_SESSION['viewVariables'] = serialize($viewVariablesArray);
        $_SESSION['items'] = $items;
        $app->render( 'index.twig', $viewVariablesArray );
    }
)->name( RouteName::SEARCH_JOBS );
