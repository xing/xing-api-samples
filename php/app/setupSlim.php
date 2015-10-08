<?php

$app = new \Slim\Slim( array( 'view' => new \Slim\Views\Twig() ) );

$view = $app->view();
$view->parserExension = array( new \Slim\Views\TwigExtension() );
