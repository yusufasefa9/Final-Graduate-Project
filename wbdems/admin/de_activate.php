<?php
include('dbcon.php');
$get_id = $_GET['id'];

// Deactivate the account in the database
mysqli_query($conn, "UPDATE teacher SET teacher_stat = 'Deactivated' WHERE teacher_id = '$get_id'");

// Additional steps to disable the account
// For example, you might want to log the user out if they are currently logged in.
// You can also add checks in your application to prevent access or usage of the deactivated account.

// For illustration purposes, you can unset any session variables associated with this account
session_start();
unset($_SESSION['user_id']); // Assuming you store user_id in the session

// Redirect to the teachers page
header('location: teachers.php');
?>
