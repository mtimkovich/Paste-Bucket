<?php

$PATH = $_SERVER['REQUEST_URI'];

$BASE_PATH = dirname($_SERVER['SCRIPT_NAME']);
$PATH = str_replace($BASE_PATH, '', $PATH);

?>
