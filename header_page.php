<?php
session_start();
// print_r($person);
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>Page Title</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="./css/style.css">
<script defer src="./javascript/all.js"></script>
<script src="./javascript/jquery-3.6.0.min.js"></script>

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
                    My Movies
                </div>
                <div id="recommendations">
                    Recommendations
                </div>
            </div>
            <input placeholder="Search movies" style="width: 33%; border-radius: 8px;"></input>
            
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