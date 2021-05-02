<?php
header("Cache-Control: no cache");
session_cache_limiter("private_no_expire");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>Sign in</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="./css/style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<?php
require_once("db.php");
is_already_logged_in();
authenticate_person();

close_db();

function is_already_logged_in() {
    if ((isset($_SESSION['person_id']))) {
        header("location: index.php");
    }
}

function authenticate_person() {
    if(isset($_POST['email']) && isset($_POST['password'])) { // Required data to check if authentication is successful
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT *
                FROM person
                WHERE email=\"".$email."\"
                AND pass_word=SHA1(\"".$password."\")
                AND active=1";
        
        $data = query($sql);
        
        if(isset($data)) { // Successfully logged in. Now redirect
            $_SESSION['person_id'] = $data[0];
            $_SESSION['first_name'] = $data[1];
            $_SESSION['last_name'] = $data[2];
            $_SESSION['email'] = $data[3];

            if ((isset($_SESSION['person_id']))) {
                header("location: index.php");
            }
        } else { // Display error and to try to Sign in again
            display_sign_in("Sorry, that email or password isn't right.");
        }
        
    } else {
        header("location: index.php");
    }
}

function display_sign_in($error_message) {
    ?>
    <body style="background-color: #cccccc;">
        <div id="header">
            <div style="height: 67px">
                <a href="./">
                    <img src='./resources/logonew.svg' style="width: 100%;max-height: 100%">
                </a>
         </div>
        </div>

        <div id="signup_container">
            <div id="signup_row_1">
            <?php
            if(!empty($error_message)) {
                echo "<p class=\"alert-danger\">$error_message</p>";
            }
            ?>
            </div>
            <div id="signup_row_2" style="width: 100%;">
            <div id="marketing_signup_container" style="flex-flow: column nowrap; width: 100%;">
                <h2>Sign in</h2>
                <div id="marketing_signup_row_2">
                    <form name="sign_in" id="sign_in" method="post" action="./sign_in.php" style="flex-flow: column nowrap; width: 100%;">
                        <input name="email" id="formSignInEmail" placeholder="Email address" class="create_account_input" style="width: 100%;"></input>
                        <input name="password" id="formSignInPassword" placeholder="Password" type="password" class="create_account_input" style="width: 100%;"></input>
                        <input type="submit" value="Sign in" class="btn btn-primary" style="background-color: #7917a6;">
                    </form>
                </div>
            </div>
        </div>

    </body>
    <?php
}

?>
</html>