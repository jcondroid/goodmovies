<?php
require_once("db.php");

/**
 * CREATE
 */
function insert_person_movie_by_person_and_movie_id($person_id, $movie_id, $rating) {
    $sql = "INSERT INTO person_movie (person_id, movie_id, rating)
            VALUES ($person_id, $movie_id, $rating)";

    echo $sql;
    return insert($sql);
}

/**
 * READ
 */
function get_person_by_person_id($person_id) {
    $sql = "SELECT *
            FROM person
            WHERE person_id=".$person_id;
    return query($sql);
}

function get_movies_array() {
    $sql = "SELECT title
            FROM movie
            WHERE active=1";
    return query($sql, false);
}

function get_movies() {
    $sql = "SELECT *
            FROM movie
            WHERE active=1";
    return query($sql, false);
}

function get_person_movie_by_person_and_movie_id($person_id, $movie_id) {
    $sql = "SELECT *
            FROM person_movie
            WHERE movie_id=$movie_id
            AND person_id=$person_id";
    return query($sql);
}

function get_person_movie_by_person_id($person_id) {
    $sql = "SELECT *
            FROM person_movie
            WHERE person_id=$person_id";
    // echo $sql;
    return query($sql, false);
}

function get_movie_by_movie_id($movie_id) {
    $sql = "SELECT *
            FROM movie
            WHERE movie_id=$movie_id
            AND active=1";
    return query($sql);
}

function get_movie_id_by_title($title) {
    $sql = "SELECT movie_id
            FROM movie
            WHERE title=\"$title\"
            AND active=1";
    return query($sql, true);
}

/**
 * UPDATE
 */
function update_person_movie_by_person_and_movie_id($person_id, $movie_id, $rating) {
    $sql = "UPDATE person_movie
            SET rating=$rating
            WHERE movie_id=$movie_id
            AND person_id=$person_id";
    return update($sql);
}

function update_person_by_person_id($person_id, $first_name, $last_name, $gender) {
    $sql = "UPDATE person
            SET first_name=\"$first_name\"
            , last_name=\"$last_name\"
            , gender=$gender
            WHERE person_id=$person_id";
    echo $sql;
    return update($sql);
}
