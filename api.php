<?php
header("Content-Type:application/json");
require_once("library.php");

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
        default:
            response(400, "Invalid Operation $action", NULL);
            break;
    }
}

/**
 * CREATE
 */
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
        response(401, "Could not find person movie record", NULL);
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
        $movie_array = array();
        // for($i = 0; $i < sizeof($movies); $i++) {
        //     $movie_array = array(
        //         'movie_id' => $movies[$i], 'poster_link' => $movies[1], 'title' => $movies[2], 'released_year' => $movies[3]
        //     );
        //     array_push($movies_array, )
        // }
        $movie_array = array(
            'movie_id' => $movie[0], 'poster_link' => $movie[1], 'title' => $movie[2], 'released_year' => $movie[3]
        );
        response(200, "Success: movies Found ", $movie);
    }
}

function getMovieByTitle()
{
    isset($_GET['title']) ? $title = $_GET['title'] : $title = "";
    // echo "TITLE = " . $title;
    
    if (!empty($title)) {
        $movie_id = get_movie_id_by_title($title);
    }

    if (empty($movie_id)) {
        response(401, "Could not find movie id using title", NULL);
    } else {
        $movie_id = $movie_id[0];
        // echo "mid: " . $movie_id;
        response(200, "Movie id found", $movie_id);
        // header("Location: movie.php?movie_id=$movie_id");
    }
}

function getMovies()
{
    $movies = get_movies();

    if (empty($movies)) {
        response(401, "Could not find movies", NULL);
    } else {
        $movies_array = array();
        // for($i = 0; $i < sizeof($movies); $i++) {
        //     $movie_array = array(
        //         'movie_id' => $movies[$i], 'poster_link' => $movies[1], 'title' => $movies[2], 'released_year' => $movies[3]
        //     );
        //     array_push($movies_array, )
        // }
        // $movies_array = array(
        //     'movie_id' => $movies[0], 'poster_link' => $movies[1], 'title' => $movies[2], 'released_year' => $movies[3]
        // );
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
        // for($i = 0; $i < sizeof($movies); $i++) {
            // $movie_array = array(
            //     'movie_id' => $movies[$i], 'poster_link' => $movies[1], 'title' => $movies[2], 'released_year' => $movies[3]
            // );
            // array_push($movies_array, $movies[$i]);
        // }
        // $movies_array = array(
        //     'movie_id' => $movies[0], 'poster_link' => $movies[1], 'title' => $movies[2], 'released_year' => $movies[3]
        // );
        response(200, "Success: movies Found ", $movies_array);
    }
}

function insertPersonMovie()
{
    isset($_GET['movie_id']) ? $movie_id = $_GET['movie_id'] : $movie_id = "";
    isset($_GET['person_id']) ? $person_id = $_GET['person_id'] : $person_id = "";
    isset($_GET['rating']) ? $rating = $_GET['rating'] : $rating = "";
    
    if (!empty($movie_id) && !empty($person_id) && !empty($rating)) {
        // echo "test";
        // Try to update first
        $updatePersonMovie = update_person_movie_by_person_and_movie_id($person_id, $movie_id, $rating);
        // echo $updatePersonMovie;

        if (empty($updatePersonMovie)) { // No person_movie record exists so create one
            $insertPersonMovie = insert_person_movie_by_person_and_movie_id($person_id, $movie_id, $rating);
            if (empty($insertPersonMovie)) { // No person_movie record exists so create one
                response(401, "Could not insert a new person movie record", NULL);
            } else {
                response(200, "Success: inserted new person movie record ", $insertPersonMovie);
            }
            // response(401, "Could not find person movie record", NULL);
        } else {
            // $personMovieArray = array();
            // $personMovieArray = array(
                // 'person_movie_id' => $personMovie[0], 'person_id' => $personMovie[1], 'movie_id' => $personMovie[2], 'rating' => $personMovie[3]
            // );
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
                'person_id' => $person[0], 'first_name' => $person[1], 'last_name' => $person[2], 'email' => $person[3]
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
function updatePerson($personID)
{
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
