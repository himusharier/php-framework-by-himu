<?php
//define method header:
header('Access-Control-Allow-Method: POST');

//database operation:
function storeSubjectArea($data) {
    global $db;
    global $domain_link;

    //getting token from header:
    $headers = getallheaders();
    if (isset($headers['Authorization'])) {
        $tokenHeader = $headers['Authorization'];
    } else {
        $tokenHeader = null;
    }

    //filter inputs:
    $submitToken = clean_inputs($tokenHeader);
    $subjectName = clean_inputs($data['subject_name']);

    //handling required info
    if (empty($submitToken)) {
        return errorAuth('Authorization token missing');
    } elseif (empty($subjectName)) {
        return errorMsg('Enter subject name');

    } else {
        //token verifying:
        $verify = verify_jwt($submitToken);

        if ($verify && $verify['domain'] == $domain_link) {
            $checkQuery = "SELECT * FROM subject_area WHERE subject_name = '$subjectName'";
            $checkQuery_run = mysqli_query($db, $checkQuery);
            if ($checkQuery_run) {
                if (mysqli_num_rows($checkQuery_run) == 0) { //checking for duplicate submission
                    //database query:
                    $query = "INSERT INTO subject_area (subject_name) VALUES ('$subjectName')";
                    $result = mysqli_query($db, $query);
                    if ($result) {
                        $data = [
                            'status' => 201,
                            'message' => 'Subject name created successfully'
                        ];
                        header("HTTP/1.0 201 Created");
                        echo json_encode($data);

                    } else {
                        return errorInternal();
                    }
                } else {
                    return errorMsg('Subject name already exists');
                }
            } else {
                return errorInternal();
            }
        } else {
            return errorAuth('Authorization failed');
        }

    }
}

//receiving data from a form:
$inputData = json_decode(file_get_contents("php://input"), true);

//data source detection (form or json):
if (empty($inputData)) {
    $response = storeSubjectArea($_POST);
} else {
    $response = storeSubjectArea($inputData);
}
echo $response; //output