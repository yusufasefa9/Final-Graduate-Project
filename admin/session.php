<?php
 session_start(); 
//Check whether the session variable SESS_MEMBER_ID is present or not
if (!isset($_SESSION['id']) || (trim($_SESSION['id']) == '')) { ?>
<script>
window.location = "index.php";
</script>
<?php
}
$session_id=$_SESSION['id'];

$user_query = mysqli_query($conn,"select * from users where user_id = '$session_id'")or die(mysqli_error($conn));
$user_row = mysqli_fetch_array($user_query);

if(isset($user_row) && is_array($user_row) && array_key_exists('username', $user_row)) {
    $user_username = $user_row['username'];
} else {

    $user_username = ""; 
}

?>