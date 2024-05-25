<?php
//default header:
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

$requestMethod = $_SERVER["REQUEST_METHOD"];
$versions = "$url[0]/$url[1]";

if ($versions == "api/v1") {

    if ($requestMethod == "GET" && $url[2] == "show_subject_area") { //get: all subject area
        require("$versions/show-subject-area.php");

    } elseif ($requestMethod == "POST" && $url[2] == "add_subject_area") { //post: new subject area
        require("$versions/add-subject-area.php");

    } else {
        return errorMethod($requestMethod);
    }

} else {
    return errorForbidden();
}