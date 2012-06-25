<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'username');
define('DB_PASSWORD', 'password');
define('DB_NAME', 'paste');

function get_paste($name) {
    $db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);


    $query = $db->prepare('SELECT content FROM pastes WHERE name = :name');
    $query->execute(array(':name' => $name));
    $row = $query->fetch(PDO::FETCH_ASSOC);
//     error_log('DB QUERY');

    $db = null;

    return $row['content'];
}
