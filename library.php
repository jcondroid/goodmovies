<?php
require_once("db.php");

function get_user_by_user_id($person_id) {
    $sql = "SELECT *
            FROM person
            WHERE person_id=".$person_id;
    return query($sql);

}


?>