<?php
header("Content-Type:application/json");
require_once("library.php");

if(!empty($_GET['action'])) {
    $action = $_GET['action'];

    switch(strtolower($action)) {
        case "getperson":
            getPerson();
            break;
        default:
            response(400, "Invalid Operation $action", NULL);
            break;
    }
}

/**
 * CREATE
 */
function createMovie() {

}
function createPerson() {
    
}

/**
 * READ
 */
function getMovie($movieID) {

}
function getPerson() {
    if(!empty($_GET['person_id'])) {
        $person_id = $_GET['person_id'];
        $person = get_person_by_person_id($person_id);

        if(empty($person)) {
            response(401, "Could not find person", NULL);
        } else {
            $person_array = array(
                'person_id' => $person[0]
                , 'first_name' => $person[1]
                , 'last_name' => $person[2]
                , 'email' => $person[3]
            );
            response(200, "Success: Person Found ", $person_array);
        }
    } else {
        response(400, "Invalid Request", NULL);
    }
    
}

/**
 * UPDATE
 */
function updateMovie($movieID) {

}
function updatePerson($personID) {
    
}
// Deactivate is not deleting but updating and setting active = 0
function deactivateMovie($movieID) {

}
function deactivatePerson($personID) {
    
}

/**
 * DELETE
 */

function response($status, $message, $data) {
    header("HTTP/1.1 $status");

    $response['status'] = $status;
    $response['message'] = $message;
    $response['data'] = $data;

    $json_response = json_encode($response);
    echo $json_response;
}
?>