<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>Sign in</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="./css/style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<!-- <script src="./javascript/person.js"></script> -->

<?php
require_once("db.php");
// print_r($_SESSION);
is_already_logged_in();
authenticate_person();

function is_already_logged_in() {
    if ((isset($_SESSION['person_id']))) {
        header("location: index.php");
    }
}

function log_out() {
    if ((isset($_SESSION['person_id'])) && isset($_GET['logout'])) {
        session_destroy();

        unset($_SESSION['person_id']);
        unset($_SESSION['first_name']);
        unset($_SESSION['last_name']);
        unset($_SESSION['email']);
        header("location: index.php");
    }
}

function authenticate_person() {
    if(isset($_POST['email']) && isset($_POST['password'])) { // Authentication successful
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT *
                FROM person
                WHERE email=\"".$email."\"
                AND pass_word=PASSWORD(\"".$password."\")";
        echo $sql;
        $data = query($sql);
        print_r($sql);
        if(isset($data)) { // Successfully logged in. Now redirect
            

            $_SESSION['person_id'] = $data[0];
            $_SESSION['first_name'] = $data[1];
            $_SESSION['last_name'] = $data[2];
            $_SESSION['email'] = $data[3];


            ?>
            <form id="redirect_to_home_page" method="post" action="home.php">
                <input type="hidden" id="customInvoiceId" .... />
                <input type="hidden" .... />

                <input type="submit" id="submitButton" />
            </form>
            <?php
        } else { // Display error and to try to Sign in again
            ?>
            <body style="background-color: #cccccc;">
                <div id="header">
                    <img src="./resources/logo.svg" alt="Logo" style="width:50px">
                </div>

                <div id="signup_container">
                    <div id="signup_row_1">
                    <p class="alert-danger">
                        Sorry, that email or password isn't right. <!-- Click here to <a>reset password.</a> -->
                    </p>
                    </div>
                    <div id="signup_row_2">
                    <form name="sign_in" id="sign_in" method="post" action="./sign_in.php">
                        <input name="email" id="formSignInEmail" placeholder="Email address"></input>
                        <input name="password" id="formSignInPassword" placeholder="Password" type="password"></input>
                        <input type="submit" value="Sign in">
                    </form>
                    </div>
                </div>

            </body>
            <?php
        }
        
    } else {
        echo "naw";
    }

}

?>
</html>