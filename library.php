<?php
require_once("db.php");



function get_person_by_person_id($person_id) {
    // gloabl $db;

    $sql = "SELECT *
            FROM person
            WHERE person_id=".$person_id;
    return query($sql);
}

function get_movies() {
    $sql = "SELECT *
            FROM movie
            WHERE active=1";
    return query($sql, false);
}


?>