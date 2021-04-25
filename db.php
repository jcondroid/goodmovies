<?php 
require_once("constants.php");

// Create connection in MySQLi
function connect_to_db($server_name, $user_name, $password, $data_base='') {
    return mysqli_connect($server_name, $user_name, $password, $data_base);
}
 
$db = connect_to_db($db_credentials['server_name'], $db_credentials['db_login'], $db_credentials['db_password'], $db_credentials['db_project']);
 
//Check connection in MySQLi
if(!$db){
    die("Error on the connection");// .mysqli_error());
} else {
    // echo "Connected Sucessfully";
}

function query($sql, $single_row=true) {
    global $db;
    
    if ($result = $db -> query($sql)) {
        if($single_row) {
            $row = $result -> fetch_row();

            return $row;
        } else {
            $array = $result -> fetch_all();

            return $array;
        }
        

        
    } else {
        return null;
    }

    
}

function insert($sql) {
    global $db;

    return $db -> query($sql);
}

function update($sql) {
    global $db;

    $db -> query($sql);

    return $db -> affected_rows;
}

function close_db() {
    global $db;
    $db -> close();
}