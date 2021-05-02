<?php
session_start();
require_once("library.php");
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>GoodMovies</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="./css/style.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
<script defer src="./javascript/all.js"></script>
<script src="./javascript/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="./javascript/typeahead.bundle.js"></script>
<script>
    // This script uses the Bloodhound typeahead
    // See https://github.com/twitter/typeahead.js/blob/master/doc/bloodhound.md
    $(document).ready(function() {
        initialize_typeahead();

        $('.typeahead').on('typeahead:selected', function(e, datum) {
            console.log("datum: ", datum);
            let url = "./api.php?action=getmoviebytitle&title=" + encodeURI(datum);

            fetch(url)
                .then(function(response) {
                    return response.json();
                }).then(function(data) {
                    window.location.href = "movie.php?movie_id=" + data.data;
                });
        });
    });

    function initialize_typeahead() {
        console.log("get_movies_array");
        let url = "./api.php?action=getmoviesarray";

        fetch(url)
            .then((response) => response.json())
            .then(function(data) {
                var movies = data.data;

                var movies = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.whitespace,
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    local: movies
                });

                // Initializing the typeahead
                $('.typeahead').typeahead({
                    hint: true,
                    highlight: true,
                    /* Enable substring highlighting */
                    minLength: 1 /* Specify minimum characters required for showing suggestions */
                }, {
                    name: 'movies',
                    source: movies
                });
            });
    }
</script>
<?php
// This conditional helped with page loading $loadMovie is set in movie.php only
if (isset($loadMovie)) {
    echo "<body onload=\"get_movie($movie_id)\" style=\"display: none;\">";
} else {
    echo "<body style=\"display: none;\">";
}
?>

<div id="header">
    <div style="height: 67px">
        <a href="./">
            <img src='./resources/logonew.svg' style="width: 100%;max-height: 100%">
        </a>
    </div>
    <div id="header_login_container" style="width:60%">
        <?php
        if ((isset($_SESSION['person_id']))) {
        ?>
            <div id="home_container">
                <div id="home">
                    <a href="./">Home</a>
                </div>
                <div id="my_movies">
                    <a href="./my_movies.php">My Movies</a>
                </div>
                <!-- For when I impliment the Recommendations feature -->
                <!-- <div id="recommendations">
                    Recommendations
                </div> -->
            </div>
            <input placeholder="Search movies" style="border-radius: 8px;" class="typeahead"></input>

            <a href="profile.php">
                <i class="fas fa-user" style="padding: 0 5px; color: #7917a6; width: 50px;"></i>
            </a>

            <a href="logout.php">
                Logout
            </a>

            <!-- For when I impliment the friends feature -->
            <!-- <a href="friends">
                <i class="fas fa-users" style="padding: 0 5px;"></i>
            </a> -->


        <?php
        } else {
        ?>
            <div id="header_login_row_1">
                <form name="sign_in" id="sign_in" method="post" action="./sign_in.php">
                    <input name="email" id="formSignInEmail" placeholder="Email address" class="sign_in_input"></input>
                    <input name="password" id="formSignInPassword" placeholder="Password" type="password" class="sign_in_input"></input>
                    <input type="submit" value="Sign in" class="btn btn-primary" style="background-color: #7917a6;">
                </form>
            </div>
            <div id="header_login_row_2">
            </div>
        <?php

        }
        ?>
    </div>
</div>