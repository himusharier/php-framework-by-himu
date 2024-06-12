<?php
global $url;

//default header:
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

$requestMethod = $_SERVER["REQUEST_METHOD"];
$versions = "$url[0]/$url[1]";

switch ($versions) {
    case "api/v1":
        switch ($requestMethod) {
            case "GET":
                if ($url[2] == "show-subject-area") {
                    require("$versions/show-subject-area.php");
                    exit(); // Exit after handling the request
                }
                else {errorInternal();}

                break;
            case "POST":
                if ($url[2] == "add-subject-area") {
                    require("$versions/add-subject-area.php");
                    exit(); // Exit after handling the request
                }
                else {errorInternal();}

                break;
            default:
                errorMethod($requestMethod);
        }
        break;
    default:
        errorForbidden();
}

