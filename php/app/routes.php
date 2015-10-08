<?php
//
/**
 * RouteName
 *
 * routes are named with constants, so we can refer that them later by name
 *
 */
class RouteName
{
    const HOME = 'home';
    const LOGOUT = 'logout';
    const LOGIN = 'login';
    const SEARCH_JOBS = 'searchjobs';
    const SEARCH_EMAILS = 'searchemails';
}

// includes all the defined routes
foreach (glob( __DIR__ . '/routes/' . '*.php' ) as $routeFilename) {
    require_once $routeFilename;
}

