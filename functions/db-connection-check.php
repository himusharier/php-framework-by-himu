<?php
function dbConnectionCheck() {
    global $db;

    if (isset($db) && !$db->connect_error) {
        $db_query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '" . DB_NAME . "'";
        $db_result = $db->query($db_query);
        if ($db_result->num_rows > 0) {
            $connection_status = true;
        } else {
            $connection_status = false;
        }
    } else {
        $connection_status = false;
    }
    if (!$connection_status){
        define('DB_HOST', '');
        define('DB_USER', '');
        define('DB_PASS', '');
        define('DB_NAME', '');
    }

    return $connection_status;
}