<?php

require_once __DIR__.'/../vendor/autoload.php';

use Rpodwika\Silex\YamlConfigServiceProvider;

$app = new Silex\Application();
$app['debug'] = true;
$app->register(new YamlConfigServiceProvider(
    __DIR__ . '/../app/config.yml'
));
