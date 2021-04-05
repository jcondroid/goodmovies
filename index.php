<?php
require_once("library.php");
$person = get_user_by_user_id(1);

// print_r($person);
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>Page Title</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="./css/style.css">
<script src=""></script>

<body>
    <div id="header">
        <img src="logo.png" alt="Logo" style="width:50%">
        <div id="header_login_container">
            <div id="header_login_row_1">
                <form method="post" action="sign_in.php">
                    <input placeholder="Email address"></input>
                    <input placeholder="Password" type="password"></input>
                    <button>Sign in</button>
                </form>
            </div>
            <div id="header_login_row_2">
                <!-- <input></input> Checkbox-->
                Forgot password?
            </div>
        </div>
    </div>


    <div id="marketing" class="marketing-image">
        <!-- <img src="marketing.png" alt="Marketing" style="width:100%"> -->
        <div id="marketing_signup_container">
            <div id="marketing_signup_row_1">
                <h2>Create a free account!</h2>
            </div>
            <div id="marketing_signup_row_2">
                <form method="post" action="sign_up.php">
                    <input placeholder="Name"></input>
                    <input placeholder="Email address"></input>
                    <input placeholder="Password" type="password"></input>
                    <button>Sign up</button>
                    <p>By clicking "Sign up" I agree to the Logo Terms of Service and confirm that I am at least 13 years old.</p>
                </form>
            </div>
        </div>
    </div>

</body>

</html>