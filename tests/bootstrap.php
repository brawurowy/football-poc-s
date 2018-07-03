<?php

// executes the "php bin/console doctrine:database:create --env=test" command
passthru(sprintf(
    'php %s/../bin/console doctrine:database:create --env=test',
    __DIR__
));

// executes the "php bin/console doctrine:schema:drop --env=test" command
passthru(sprintf(
    'php %s/../bin/console doctrine:schema:drop --env=test --force',
    __DIR__
));

// executes the "php bin/console doctrine:schema:create --env=test" command
passthru(sprintf(
    'php %s/../bin/console doctrine:schema:create --env=test',
    __DIR__
));

// executes the "php bin/console doctrine:schema:validate --env=test" command
passthru(sprintf(
    'php %s/../bin/console doctrine:schema:validate --env=test',
    __DIR__
));

// executes the "php bin/console doctrine:fixtures:load --env=test" command
passthru(sprintf(
    'php %s/../bin/console doctrine:fixtures:load --env=test',
    __DIR__
));


require __DIR__.'/../vendor/autoload.php';