<?php
//session started here:
session_start();
session_regenerate_id(true);

//add includes here:
require('configs/canonical-link.php'); //canonical
require('controller/route-controller.php'); //router
require('database/database-connection.php'); //database
require('configs/ip-details.php'); //ip
require('language/language-settings.php'); //language

//include functions here:
require('functions/input-sanitizer.php');
require('functions/db-connection-check.php');
require('functions/html-page-header.php');
require('functions/api-error-messages.php');

//include authentications here:
require('token/jwt-token.php');

//add alpha pages:
if (!dbConnectionCheck()) { //check database connection:
    require("database/database-settings.php");
    exit();

} elseif ($url[0] == "api") { //api controller
    require("controller/api-controller.php");
    exit();

} elseif ($url[0] == "auth") { //authentication controller
    require("controller/auth-controller.php");
    exit();

} elseif ($url[0] == "user") { //user controller
    require("controller/user-controller.php");
    exit();

} else { //website controller
    require("controller/website-controller.php");
    exit();
}
