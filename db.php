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
    echo "Connected Sucessfully";
}

function query($sql) {
    global $db;
    
    if ($result = $db -> query($sql)) {
        $row = $result -> fetch_row();

        $db -> close();
        return $row;
    } else {
        $db -> close();
        return null;
    }

    
}
