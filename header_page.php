<?php
header("Cache-Control: no cache");
session_cache_limiter("private_no_expire");
session_start();
// print_r($person);
require_once("library.php");
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>Page Title</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="./css/style.css">
<script defer src="./javascript/all.js"></script>
<script src="./javascript/jquery-3.6.0.min.js"></script>
<script  type="text/javascript" src="./javascript/typeahead.bundle.js"></script>
<script>
$(document).ready(function(){
    initialize_typeahead();

    $('.typeahead').on('typeahead:selected', function (e, datum) {
        console.log("datum: ", datum);
        let url = "./api.php?action=getmoviebytitle&title=" + encodeURI(datum);

        fetch(url)
        .then(function(response) {
            // The response is a Response instance.
            // You parse the data into a useable format using `.json()`
            return response.json();
        }).then(function(data) {
            // `data` is the parsed version of the JSON returned from the above endpoint.
            // { "userId": 1, "id": 1, "title": "...", "body": "..." }
            window.location.href = "movie.php?movie_id=" + data.data;
        });
    });
});
function initialize_typeahead() {
    console.log("get_movies_array");
    let url = "./api.php?action=getmoviesarray";

    fetch(url)
        .then((response) => response.json())
        .then(function (data) {
            // console.log(data);
            var movies = data.data;
            // console.log(results);
            // Constructing the suggestion engine
            // var Bloodhound = require('bloodhound-js');
            var movies = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                local: movies
            });

            // Initializing the typeahead
            $('.typeahead').typeahead({
                hint: true,
                highlight: true, /* Enable substring highlighting */
                minLength: 1 /* Specify minimum characters required for showing suggestions */
            },
            {
                name: 'movies',
                source: movies
            });
        });
}
</script>
<?php
if(isset($loadMovie)) {
    echo "<body onload=\"get_movie($movie_id)\" style=\"display: none;\">";
    // echo "<body>";
} else {
    echo "<body>";
}
?>

    <div id="header">
         <div style="height: 67px">
            <img src='./resources/logonew.svg' style="width: 100%;max-height: 100%">
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
                <!-- <div id="recommendations">
                    Recommendations
                </div> -->
            </div>
            <input placeholder="Search movies" style="border-radius: 8px;" class="typeahead"></input>
            
            <a href="profile.php">
                <i class="fas fa-user" style="padding: 0 5px;"></i>
            </a>
            
            <i class="fas fa-users" style="padding: 0 5px; display: none;"></i>
            
            <?php
            } else {
            ?>
            <div id="header_login_row_1">
                <form name="sign_in" id="sign_in" method="post" action="./sign_in.php">
                    <input name="email" id="formSignInEmail" placeholder="Email address"></input>
                    <input name="password" id="formSignInPassword" placeholder="Password" type="password"></input>
                    <input type="submit" value="Sign in">
                </form>
            </div>
            <div id="header_login_row_2">
                <!-- <input type="checkbox" id="remember_me" name="remember_me" checked=""> -->
                <!-- Forgot password? -->
            </div>
            <?php
                
            }
            ?>
        </div>
    </div>