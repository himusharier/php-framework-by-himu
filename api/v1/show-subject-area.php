<?php
//define method header:
header('Access-Control-Allow-Method: GET');

//database query:
$query = "SELECT * FROM subject_area ORDER BY id ASC";
$query_run = mysqli_query($db, $query);

if ($query_run) {
    if (mysqli_num_rows($query_run) > 0) {
        $result = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
        $data = [
            'status' => 200,
            'data' => $result
        ];
        header("HTTP/1.0 200 OK");
        echo json_encode($data);

    } else {
        $data = [
            'status' => 200,
            'data' => []
        ];
        header("HTTP/1.0 200 OK");
        echo json_encode($data);
    }

} else {
    return errorInternal();
}