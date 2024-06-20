<?php
error_reporting(0);

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'foundation_for_humanity_db');
$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
mysqli_set_charset($db, 'utf8');

$token = 'a73b208692d8c1dc559a7b045c1f2d3bb48a79c5a664e6ef6aa9f6356fdb1bf5';
