<?php
require ("../apps/common/config/config.php");

use Phalcon\Config;

return new Config(array_merge(
    $db,
    [
        'application' => [
            'controllersDir' => __DIR__ . '/../controllers/',
            'modelsDir'      => __DIR__ . '/../models/',
            'migrationsDir'  => __DIR__ . '/../migrations/',
            'viewsDir'       => __DIR__ . '/../views/',
            'baseUri'        => '/admin/'
        ]
    ]
));