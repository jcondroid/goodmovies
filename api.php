<?php
header("Content-Type:application/json");
require_once("library.php");

// For each request to api.php we use this controller to funnel requests into specified actions
if (!empty($_GET['action'])) {
    $action = $_GET['action'];

    switch (strtolower($action)) {
        case "getperson":
            getPerson();
            break;
        case "getpersonmovie":
            getPersonMovie();
            break;
        case "getmovie":
            getMovieByMovieId();
            break;
        case "getmoviebytitle":
            getMovieByTitle();
            break;
        case "getmovies":
            getMovies();
            break;
        case "getmoviesarray":
            getMoviesArray();
            break;
        case "insertpersonmovie":
            insertPersonMovie();
            break;
        case "updateperson":
            updatePerson();
            break;
        default:
            response(400, "Invalid Operation $action", NULL);
            break;
    }
}

/**
 * CREATE
 */
// These are stubs for future Admin features
function createMovie()
{
}
function createPerson()
{
}

/**
 * READ
 */
function getPersonMovie()
{
    isset($_GET['movie_id']) ? $movie_id = $_GET['movie_id'] : $movie_id = "";
    isset($_GET['person_id']) ? $person_id = $_GET['person_id'] : $person_id = "";

    if (!empty($movie_id) && !empty($person_id)) {
        $personMovie = get_person_movie_by_person_and_movie_id($person_id, $movie_id);
    }

    if (empty($personMovie)) {
        response(200, "Could not find person movie record", "");
    } else {
        $personMovieArray = array();
        $personMovieArray = array(
            'person_movie_id' => $personMovie[0], 'person_id' => $personMovie[1], 'movie_id' => $personMovie[2], 'rating' => $personMovie[3]
        );
        response(200, "Success: person movie found ", $personMovieArray);
    }
}

function getMovieByMovieId()
{
    isset($_GET['movie_id']) ? $movie_id = $_GET['movie_id'] : $movie_id = "";

    if (!empty($movie_id)) {
        $movie = get_movie_by_movie_id($movie_id);
    }

    if (empty($movie)) {
        response(401, "Could not find movie", NULL);
    } else {
        response(200, "Success: movies Found ", $movie);
    }
}

function getMovieByTitle()
{
    isset($_GET['title']) ? $title = $_GET['title'] : $title = "";

    if (!empty($title)) {
        $movie_id = get_movie_id_by_title($title);
    }

    if (empty($movie_id)) {
        response(401, "Could not find movie id using title", NULL);
    } else {
        $movie_id = $movie_id[0];
        response(200, "Movie id found", $movie_id);
    }
}

function getMovies()
{
    $movies = get_movies();

    if (empty($movies)) {
        response(401, "Could not find movies", NULL);
    } else {
        response(200, "Success: movies Found ", $movies);
    }
}

function getMoviesArray()
{
    $movies = get_movies_array();

    if (empty($movies)) {
        response(401, "Could not find movies", NULL);
    } else {
        $movies_array = array_column($movies, 0);
        response(200, "Success: movies Found ", $movies_array);
    }
}

/**
 * insertPersonMovie
 * This is the most complex of the api calls. This call tries to update a person_movie record first if a person_movie record
 * already exists. If one does not exist then it will insert a new record.
 */
function insertPersonMovie()
{
    isset($_GET['movie_id']) ? $movie_id = $_GET['movie_id'] : $movie_id = "";
    isset($_GET['person_id']) ? $person_id = $_GET['person_id'] : $person_id = "";
    isset($_GET['rating']) ? $rating = $_GET['rating'] : $rating = "";

    if (!empty($movie_id) && !empty($person_id) && !empty($rating)) {
        $updatePersonMovie = update_person_movie_by_person_and_movie_id($person_id, $movie_id, $rating);

        if (empty($updatePersonMovie)) { // No person_movie record exists so create one
            $insertPersonMovie = insert_person_movie_by_person_and_movie_id($person_id, $movie_id, $rating);
            if (empty($insertPersonMovie)) { // No person_movie record exists so create one
                response(401, "Could not insert a new person movie record", NULL);
            } else {
                response(200, "Success: inserted new person movie record ", $insertPersonMovie);
            }
        } else {
            response(200, "Success: updated person movie record ", $updatePersonMovie);
        }
    } else {
        response(400, "Invalid Request", NULL);
    }
}

function getPerson()
{
    if (!empty($_GET['person_id'])) {
        $person_id = $_GET['person_id'];
        $person = get_person_by_person_id($person_id);

        if (empty($person)) {
            response(401, "Could not find person", NULL);
        } else {
            $person_array = array(
                'person_id' => $person[0], 'first_name' => $person[1], 'last_name' => $person[2], 'gender' => $person[3], 'email' => $person[4]
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
function updateMovie($movieID)
{
}
function updatePerson()
{
    if (!empty($_GET['person_id'])) {
        $person_id = $_GET['person_id'];

        if (isset($person_id) && $person_id > 0) {
            header("HTTP/1.1 200");

            $person_id = $_GET['person_id'];
            isset($_GET['first_name']) ? $first_name = $_GET["first_name"] : $first_name = "";
            isset($_GET['last_name']) ? $last_name = $_GET["last_name"] : $last_name = "";
            isset($_GET['gender']) ? $gender = $_GET["gender"] : $gender = "";

            $status = update_person_by_person_id($person_id, $first_name, $last_name, $gender);

            if (empty($status)) {
                response(401, "Could not update person", NULL);
            } else {
                response(200, "Success: updated person", $status);
            }
        } else {
            response(400, "Invalid Request", NULL);
        }
    }
}
// Deactivate is not deleting but updating and setting active = 0
function deactivateMovie($movieID)
{
}
function deactivatePerson($personID)
{
}

/**
 * DELETE
 */

function response($status, $message, $data)
{
    header("HTTP/1.1 $status");

    $response['status'] = $status;
    $response['message'] = $message;
    $response['data'] = $data;

    $json_response = json_encode($response);
    echo $json_response;
}
