<?php

$con = new mysqli ("localhost", "root", "", "db_wedang_ronde", 3306);

// Check connection
if ($con->connect_error) {
    die("Connection Failed: " . $con->connect_error);
}
?>


