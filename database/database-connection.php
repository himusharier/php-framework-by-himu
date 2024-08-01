<?php
error_reporting(0);

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'php_framework_dbX');
$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
mysqli_set_charset($db, 'utf8');

$key = 'd1cc663d038011891040e54d959dbb3f27a05e97b609e7ec09905711cabcabae';
