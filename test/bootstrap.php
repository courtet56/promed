<?php
define('ROOT', __DIR__ . '/../');
define('SLASH', DIRECTORY_SEPARATOR);

// Charge les constantes et la config DB
require ROOT . 'app/const.php';

// Autoload Composer
require ROOT . 'vendor/autoload.php';