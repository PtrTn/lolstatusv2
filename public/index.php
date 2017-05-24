<?php
use Silex\Provider\ServiceControllerServiceProvider;

require(__DIR__ . '/../app/app.php');

/** @var $app Silex\Application */
$app->register(new ServiceControllerServiceProvider());

$app->get('/', function() { return 'hello world'; });
$app->run();
