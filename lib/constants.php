<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'username');
define('DB_PASSWORD', 'password');
define('DB_NAME', 'phpdb');

$BASE_PATH = dirname($_SERVER['SCRIPT_NAME']);
$PATH = str_replace($BASE_PATH, '', $_SERVER['REQUEST_URI']);
$PATH = str_replace('/index.php', '', $PATH);
$PATH = empty($PATH) ? '/' : $PATH;

?>
