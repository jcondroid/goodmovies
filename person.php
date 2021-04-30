<?php
header("Content-Type:application/json");
require_once("library.php");
// require_once("db.php");

// $response['status'] = $status;
// $response['message'] = $message;
// $response['data'] = $data;

// $json_response = json_encode($response);
// echo $json_response;

if (!empty($_GET['person_id'])) {
    $person_id = $_GET['person_id'];
    print_r($_GET);
    print_r($_POST);

    if(isset($person_id) && $person_id > 0) {
        header("HTTP/1.1 200");

        $person_id = $_GET['person_id'];
        isset($_POST['first_name']) ? $first_name = $_POST["first_name"] : $first_name = "";
        isset($_POST['last_name']) ? $last_name = $_POST["last_name"] : $last_name = "";
        isset($_POST['gender']) ? $gender = $_POST["gender"] : $gender = "";
    
        // $json_response = json_encode($response);
    
        $sql = "UPDATE person
                SET first_name=\"$first_name\"
                AND last_name=\"$last_name\"
                AND gender=\"$gender\"
                WHERE person_id=$person_id";
        echo $sql;
        return update($sql);
        echo "set";

        response(200, "Person id $person_id", NULL);
    } else {
        echo "not set";
        response(400, "Invalid Operation $action", NULL);
    }
}



// if(isset($_POST) && isset($_POST['person_id'])) {

// } else {
    // echo "not set";
// }
?>