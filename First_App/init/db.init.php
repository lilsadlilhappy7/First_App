<?php

$host = '127.0.0.1'; // localhost
$dbname = 'db_group_y3b';
$user = 'root';
$password = '';

// mysql connect
$db = new mysqli($host, $user, $password, $dbname);

if ($db->connect_error) {
    echo 'Connection failed. ' . $db->connect_error;
    die();
}
