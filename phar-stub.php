<?php

Phar::mapPhar('guzzle.phar');

require_once 'phar://guzzle.phar/vendor/symfony/class-loader/Symfony/Component/ClassLoader/UniversalClassLoader.php';

$classLoader = new Symfony\Component\ClassLoader\UniversalClassLoader();
$classLoader->registerNamespaces(array(
    'Guzzle' => 'phar://guzzle.phar/src',
    'Symfony\\Component\\EventDispatcher' => 'phar://guzzle.phar/vendor/symfony/event-dispatcher',
    'Doctrine' => 'phar://guzzle.phar/vendor/doctrine/common/lib',
    'Monolog' => 'phar://guzzle.phar/vendor/monolog/monolog/src'
));
$classLoader->register();

// Copy the cacert.pem file from the phar if it is not in the temp folder.
\Guzzle\Http\Client::extractPharCacert('phar://guzzle.phar/src/Guzzle/Http/Resources/cacert.pem');

__HALT_COMPILER();
