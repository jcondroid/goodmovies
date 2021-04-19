<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>Sign up</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="./css/style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<!-- <script src="./javascript/person.js"></script> -->

<?php
require_once("db.php");
// print_r($_SESSION);
is_already_logged_in();
$email = null;
$password = null;

if(validate_account_does_not_exist()) {
    sign_up();
}

close_db();


function is_already_logged_in() {
    if ((isset($_SESSION['person_id']))) {
        header("location: index.php");
    }
}

function validate_account_does_not_exist() {
    // echo "test</br>";
    if (isset($_POST['email'])) {
        $email = $_POST['email'];

        $sql = "SELECT *
                FROM person
                WHERE email=\"".$email."\"";
        
        $data = query($sql);

        if(isset($data)) { // Account already exists. Show sign up page with error message
            $error_message = 'Sorry, that email has already been used to sign up for GoodMovies. <a href="./sign_in.php">Sign in</a>';
            display_sign_up($error_message);
        } else { // Display error and to try to Sign in again
            return true;
        }
    } else {
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

function sign_up() {
    if ((isset($_SESSION['person_id']))) {
        header("location: index.php");
    } else {
        if(isset($_POST['first_name']) && isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $first_name = $_POST['first_name'];

            $sql = "INSERT INTO person (first_name, email, pass_word)
                    VALUES (\"$first_name\", \"$email\", SHA1(\"$password\"))";
            
            $data = insert($sql);
            if($data) {
                // echo "response: " . $data;
                sign_in($email, $password);
            } else {
                $error_message = 'Sorry, something went wrong. Please try again.';
                display_sign_up($error_message);
            }
            // sign_in();
        }
    }
}

function validate_email_is_not_taken($email) {
    $sql = "SELECT *
            FROM person
            WHERE email=\"".$email."\"";

    $data = query($sql);
    print_r($data);
    if(isset($data)) {
        $error_message = 'Sorry, that email has already been used to sign up for GoodMovies. <a href="./sign_in.php">Sign in</a>';
        display_sign_up($error_message);
    }

}

function sign_in($email, $password) {
    if ((isset($_SESSION['person_id']))) {
        header("location: index.php");
    } else {
        ?>
            <form name="sign_in" id="sign_in" method="post" action="./sign_in.php">
                <input name="email" id="formSignInEmail" placeholder="Email address" value=<?=$email?> type="hidden"></input>
                <input name="password" id="formSignInPassword" placeholder="Password" value=<?=$password?> type="hidden"></input>
                <input type="submit" value="Sign in" type="hidden">
            </form>

            <script type="text/javascript">
                document.getElementById('sign_in').submit();
            </script>
        <?php
    }
}

function display_sign_up($error_message) {
    ?>
    <body style="background-color: #cccccc;">
        <div id="header">
            <img src="./resources/logo.svg" alt="Logo" style="width:50px">
        </div>

        <div id="signup_container">
            <div id="signup_row_1">
            <?php
            if(!empty($error_message)) {
                echo "<p class=\"alert-danger\">$error_message</p>";
            }
            ?>
            </div>
            <div id="signup_row_2">
            <div id="marketing_signup_container">
                <div id="marketing_signup_row_1">
                    <h2>Create a free account!</h2>
                </div>
                <div id="marketing_signup_row_2">
                    <form name="sign_up" id="sign_up" method="post" action="./sign_up.php">
                        <input name="email" id="formSignUpEmail" placeholder="Name"></input>
                        <input placeholder="Email address"></input>
                        <input name="password" id="formSignUpPassword" placeholder="Password" type="password"></input>
                        <input type="submit" value="Sign up">
                        <p>By clicking "Sign up" I agree to the Logo Terms of Service and confirm that I am at least 13 years old.</p>
                    </form>
                </div>
            <!-- </div> -->
            </div>
        </div>

    </body>
    <?php
}

?>
</html>