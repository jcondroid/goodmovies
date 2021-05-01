<?php
include_once("header_page.php");
print_r($_SESSION);
?>

    <!-- Test Fetch -->
    <!-- <button onclick="send_to_api('getperson', '', '', 1)">Click HERE</button> -->
    <?php
    if (!(isset($_SESSION['person_id']))) {
    ?>
    <div id="marketing" class="marketing-image">
        <div style="height: 5%;"></div>
        <div id="marketing_signup_container">
            <div id="marketing_signup_row_1">
                <h2>Create a free account!</h2>
            </div>
            <div id="marketing_signup_row_2">
                <form name="sign_up" id="sign_up" method="post" action="./sign_up.php">
                    <input name="first_name" id="formSignUpFirstName" placeholder="Name" class="create_account_input"></input>
                    <input name="email" id="formSignUpEmail" placeholder="Email address" class="create_account_input"></input>
                    <input name="password" id="formSignUpPassword" placeholder="Password" type="password" class="create_account_input"></input>
                    <div class="sign_up_button_container">
                        <input type="submit" value="Sign up" class="btn btn-primary">
                        <p>By clicking "Sign up" I agree to the Logo Terms of Service and confirm that I am at least 13 years old.</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    } else {
        // Show movies
        ?>
        <div id="movies_editor_picks">Editor's Picks</div>
        <hr style="width: 85%;">
        <div id=movies_container>
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