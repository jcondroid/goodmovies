<?php
include_once("header_page.php");

// unset all of the session variables.
$_SESSION = null;
session_unset();

// destroy the session.
session_destroy();

// navigate back to the home page
header("location: index.php");
?>