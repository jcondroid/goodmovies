<?php
session_start();
if(isset($_SESSION['person_id'])) {
    response(200, "Successfully returned session data", $_SESSION);
}

function response($status, $message, $data)
{
    header("HTTP/1.1 $status");

    $response['status'] = $status;
    $response['message'] = $message;
    $response['data'] = $data;

    $json_response = json_encode($response);
    echo $json_response;
}
?>