<?php
// tests/bootstrap.php
if (isset($_ENV['BOOTSTRAP_CLEAR_CACHE_ENV'])) {
    // executes the "php bin/console cache:clear" command
    passthru(sprintf(
        'php "%s/../bin/console" cache:clear --env=%s --no-warmup',
        __DIR__,
        $_ENV['BOOTSTRAP_CLEAR_CACHE_ENV']
    ));
}

// executes the "php bin/console doctrine:database:create --env=test" command
passthru(sprintf(
    'php "%s/../bin/console doctrine:database:create --env=test --no-warmup',
    __DIR__,
    $_ENV['BOOTSTRAP_CLEAR_CACHE_ENV']
));

// executes the "php bin/console doctrine:schema:drop --env=test" command
passthru(sprintf(
    'php "%s/../bin/console doctrine:schema:drop --env=test --no-warmup',
    __DIR__,
    $_ENV['BOOTSTRAP_CLEAR_CACHE_ENV']
));

// executes the "php bin/console doctrine:schema:create --env=test" command
passthru(sprintf(
    'php "%s/../bin/console doctrine:schema:create --env=test --no-warmup',
    __DIR__,
    $_ENV['BOOTSTRAP_CLEAR_CACHE_ENV']
));

// executes the "php bin/console doctrine:schema:validate --env=test" command
passthru(sprintf(
    'php "%s/../bin/console doctrine:schema:validate --env=test --no-warmup',
    __DIR__,
    $_ENV['BOOTSTRAP_CLEAR_CACHE_ENV']
));

// executes the "php bin/console doctrine:fixtures:load --env=test" command
passthru(sprintf(
    'php "%s/../bin/console doctrine:fixtures:load --env=test --no-warmup',
    __DIR__,
    $_ENV['BOOTSTRAP_CLEAR_CACHE_ENV']
));


require __DIR__.'/../vendor/autoload.php';