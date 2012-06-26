<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'username');
define('DB_PASSWORD', 'password');
define('DB_NAME', 'paste');

$PATH = $_SERVER['REQUEST_URI'];

$BASE_PATH = dirname($_SERVER['SCRIPT_NAME']);
$PATH = str_replace($BASE_PATH, '', $PATH);

?>
