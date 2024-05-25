<?php
function errorAuth($message) {
    $data = [
        'status' => 401,
        'message' => $message
    ];
    header("HTTP/1.0 401 Unauthorized");
    echo json_encode($data);
    exit();
}

function errorForbidden() {
    $data = [
        'status' => 403,
        'message' => 'Forbidden'
    ];
    header("HTTP/1.0 403 Forbidden");
    echo json_encode($data);
    exit();
}

function errorNotFound() {
    $data = [
        'status' => 404,
        'message' => 'No data found'
    ];
    header("HTTP/1.0 404 No Data Found");
    echo json_encode($data);
    exit();
}

function errorMethod($requestMethod) {
    $data = [
        'status' => 405,
        'message' => $requestMethod. ' method not allowed'
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data);
    exit();
}

function errorMsg($message) {
    $data = [
        'status' => 422,
        'message' => $message
    ];
    header("HTTP/1.0 422 Unprocessable Entity");
    echo json_encode($data);
    exit();
}

function errorInternal() {
    $data = [
        'status' => 500,
        'message' => 'Internal server error'
    ];
    header("HTTP/1.0 500 Internal Server Error");
    echo json_encode($data);
    exit();
}