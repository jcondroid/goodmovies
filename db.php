<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "goodmovies";
 
// Create connection in MySQLi
 
$db = mysqli_connect($servername, $username, $password, $dbname);
 
//Check connection in MySQLi
if(!$db){
    die("Error on the connection");// .mysqli_error());
} else {
    // echo "Connected Sucessfully";
}

function query($sql) {
    global $db;
    
    if ($result = $db -> query($sql)) {
        $row = $result -> fetch_row();
        $person_array = array(
            'person_id' => $row[0]
            , 'first_name' => $row[1]
            , 'last_name' => $row[2]
            , 'email' => $row[3]
        );
    }

    $db -> close();
    return $person_array;
}
