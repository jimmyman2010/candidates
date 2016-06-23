<?php

/**
 * Register application modules
 */
$application->registerModules(array(
    'common' => array(
        'className' => 'Candidates\Common\Module',
        'path' => __DIR__ . '/../apps/common/Module.php'
    ),
    'frontend' => array(
        'className' => 'Candidates\Frontend\Module',
        'path' => __DIR__ . '/../apps/frontend/Module.php'
    ),
    'backoffice' => array(
        'className' => 'Candidates\Backoffice\Module',
        'path' => __DIR__ . '/../apps/backoffice/Module.php'
    )

));
