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



<body>
    <div id="header">
        <img src="./resources/logo.svg" alt="Logo" style="width:50px">
        <div id="header_login_container" style="width:60%">
            <?php
            if ((isset($_SESSION['person_id']))) {
            ?>
            <div id="menu_container">
                <div id="menu">
                    Menu
                </div>
                <div id="my_movies">
                    My Movies
                </div>
                <div id="recommendations">
                    Recommendations
                </div>
            </div>
            <input placeholder="Search movies"></input>
                
            
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

    <!-- Test Fetch -->
    <!-- <button onclick="send_to_api('getperson', '', '', 1)">Click HERE</button> -->
    <?php
    if (!(isset($_SESSION['person_id']))) {
    ?>
    <div id="marketing" class="marketing-image">
        <!-- <img src="marketing.png" alt="Marketing" style="width:100%"> -->
        <div id="marketing_signup_container">
            <div id="marketing_signup_row_1">
                <h2>Create a free account!</h2>
            </div>
            <div id="marketing_signup_row_2">
                <form name="sign_up" id="sign_up" method="post" action="./sign_up.php">
                    <input name="first_name" id="formSignUpFirstName" placeholder="Name"></input>
                    <input name="email" id="formSignUpEmail" placeholder="Email address"></input>
                    <input name="password" id="formSignUpPassword" placeholder="Password" type="password"></input>
                    <input type="submit" value="Sign up">
                    <p>By clicking "Sign up" I agree to the Logo Terms of Service and confirm that I am at least 13 years old.</p>
                </form>
            </div>
        </div>
    </div>
    <?php
    } else {
        // Show movies
        ?>
        
        <!-- Hello, <?=$_SESSION['first_name']?> -->
        <div id="movies_editor_picks">Editor's Picks</div>
        <hr style="width: 85%;">
        <div id=movies_container>;
            <!-- <div id="movie">
                <div id="poster_link"></div>
                <div id="movie_title"></div>
            </div> -->
        </div>
        <?php
    }
    ?>

<script src="./javascript/person.js"></script>
<script src="./javascript/movies.js"></script>
</body>

</html>