<?php
header("Cache-Control: no cache");
session_cache_limiter("private_no_expire");
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

// echo "hi";

if(validate_account_does_not_exist()) {
    if(input_validation_passes()) {
        sign_up();
    }
    
} else {
    // echo "Sorry, you must enter a name to sign up for GoodMovies.";
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
                WHERE email=\"".$email."\"
                AND active=1";
        
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

function input_validation_passes() {
    if (validate_required_inputs_are_not_empty()) {
        // If we make it this far then we need to validate that each input is legit
        validate_email($_POST['email']) ? $email = $_POST['email'] : $email = "";

        if(empty($email)) {
            $error_message = 'Sorry, you must enter a valid email address to sign up for GoodMovies.';
            display_sign_up($error_message);
        } else {
            if(validate_password($_POST['password'])) {
                return true; // input validation passed
            } else {
                $error_message = "Sorry, your password must contain at least 8 characters to sign up for GoodMovies.";
                display_sign_up($error_message);
            }
        }
        
    } else {
        if (!isset($_POST['first_name']) || empty($_POST['first_name'])) {
            $error_message = 'Sorry, you must enter a first name to sign up for GoodMovies.';
        } else if (!isset($_POST['email']) || empty($_POST['email'])) {
            $error_message = 'Sorry, you must enter an email address to sign up for GoodMovies.';
        } else if (!isset($_POST['password']) || empty($_POST['password'])) {
            $error_message = 'Sorry, you must enter a password to sign up for GoodMovies.';
        }
        
        display_sign_up($error_message);
    }
}

function validate_email($checkEmail) {
    return filter_var($checkEmail, FILTER_VALIDATE_EMAIL);
}

function validate_password($password) {
    return strlen($password) > '7';
}

function validate_required_inputs_are_not_empty() {
    return isset($_POST['first_name']) && isset($_POST['email']) && isset($_POST['password'])
    && !empty($_POST['first_name']) && !empty($_POST['email']) && !empty($_POST['password']);
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
        if(validate_required_inputs_are_not_empty()) {
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
            <div style="height: 67px">
                <!-- <img src='./resources/logonew.svg' style="width: 100%;max-height: 100%"> -->
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
                <!-- <div id="marketing_signup_row_1">
                    <h2>Sign Up with Email</h2>
                </div> -->
                <h2>Sign Up with Email</h2>
                <div id="marketing_signup_row_2">
                    <form name="sign_up" id="sign_up" method="post" action="./sign_up.php">
                        <input name="first_name" id="formSignUpFirstName" placeholder="First Name" class="create_account_input" style="width: 100%;"></input>
                        <input name="email" id="formSignUpEmail" placeholder="Email address" class="create_account_input" style="width: 100%;"></input>
                        <input name="password" id="formSignUpPassword" placeholder="Password" type="password" class="create_account_input" style="width: 100%;"></input>
                        <!-- <input name="first_name" id="formSignUpFirstName" placeholder="First Name"></input>
                        <input name="email" id="formSignUpEmail" placeholder="Email address"></input>
                        <input name="password" id="formSignUpPassword" placeholder="Password" type="password"></input> -->
                        <!-- <input type="submit" value="Sign up">
                        <p>By clicking "Sign up" I agree to the Logo Terms of Service and confirm that I am at least 13 years old.</p> -->
                        <!-- <div class="sign_up_button_container"> -->
                            <input type="submit" value="Sign up" class="btn btn-primary" style="background-color: #7917a6;">
                            <!-- <p class="sign_up_terms">By clicking "Sign up" I agree to the Logo Terms of Service and confirm that I am at least 13 years old.</p> -->
                        <!-- </div> -->
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