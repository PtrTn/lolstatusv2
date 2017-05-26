<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use Kurl\Silex\Provider\DoctrineMigrationsProvider;
use Rpodwika\Silex\YamlConfigServiceProvider;
use ServiceProviders\ImportServiceProvider;
use Silex\Provider\DoctrineServiceProvider;

$app = new Silex\Application();
$app['debug'] = true;
$app->register(new YamlConfigServiceProvider(
    __DIR__ . '/../app/config.yml'

));
$app->register(new DoctrineServiceProvider, [
    'db.options' => [
        'dbname' => 'lolstatusv2',
        'user' => 'root',
        'password' => '',
        'host' => 'localhost',
        'driver' => 'pdo_mysql'
    ],
]);
$app->register(new DoctrineOrmServiceProvider, [
    'orm.proxies_dir' => __DIR__ . '/../var/proxies',
    'orm.em.options' => [
        'mappings' => [
            [
                'type' => 'annotation',
                'namespace' => 'Entity',
                'path' => __DIR__ . '/../src/Entity',
            ]
        ],
    ],
]);
$app->register(new DoctrineMigrationsProvider(), [
        'migrations.directory' => __DIR__ . '/../app/Migrations',
        'migrations.namespace' => 'Migrations',
    ]
);
$app->register(new ImportServiceProvider());
