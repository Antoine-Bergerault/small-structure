<?php

define('ROOT', dirname(__DIR__));
define('PUBLIC', __DIR__);
define('APP', ROOT . '/app');
define('VIEWS', ROOT . '/views');

$url = $_GET['rewriteurl'] ?? '/home';

$GLOBALS['FULL_URL'] = $url;
$GLOBALS['URL'] = explode('?', $url)[0];

include APP.'/router.php';

echo router::call();