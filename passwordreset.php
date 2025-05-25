<html>  
<head>  
    <title>Password Reset</title>  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
</head>
<style>
 .box
 {
  width:100%;
  max-width:600px;
  background-color:#f9f9f9;
  border:1px solid #ccc;
  border-radius:5px;
  padding:16px;
  margin:0 auto;
 }
 input.parsley-success,
 select.parsley-success,
 textarea.parsley-success {
   color: #468847;
   background-color: #DFF0D8;
   border: 1px solid #D6E9C6;
 }

 input.parsley-error,
 select.parsley-error,
 textarea.parsley-error {
   color: #B94A48;
   background-color: #F2DEDE;
   border: 1px solid #EED3D7;
 }

 .parsley-errors-list {
   margin: 2px 0 3px;
   padding: 0;
   list-style-type: none;
   font-size: 0.9em;
   line-height: 0.9em;
   opacity: 0;

   transition: all .3s ease-in;
   -o-transition: all .3s ease-in;
   -moz-transition: all .3s ease-in;
   -webkit-transition: all .3s ease-in;
 }

 .parsley-errors-list.filled {
   opacity: 1;
 }
 
 .parsley-type, .parsley-required, .parsley-equalto{
  color:#ff0000;
 }

 .error
 {
   color: red;
   font-weight: 700;
 }

 .success {
   color: green;
 }
</style>
<?php
include('admin/dbcon.php');

// Check if 'secret' key is set in $_GET

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pwdrst'])) {
    $email = base64_decode($_GET['secret']);
    $password = md5($_POST['pwd']);
    $confirmPassword = md5($_POST['cpwd']);

    // Check if the new password and confirm password match
    if ($password != $confirmPassword) {
        $msg = "New password and confirm password do not match.";
        $msgClass = "error";
    } else {
        // Update the password in the database
        $update_query = mysqli_query($conn, "UPDATE teacher SET password='$password' WHERE email='$email'");

        if ($update_query) {
            $msg = "Password updated successfully!";
            echo '<script>alert("We have e-mailed your password reset link!");</script>';
            header('location:login.php');
            $msgClass = "success";
        } else {
            $msg = "Failed to update password. Please try again.";
            $msgClass = "error";
        }
    }
}
?>

<html>
<head>
    <title>Password Reset</title>
    <!-- Add your stylesheets and other head elements here -->
</head>
<body>
    <div class="container">  
        <div class="table-responsive">  
            <h3 align="center">Reset Password</h3><br/>
            <div class="box">
                <form id="validate_form" method="post" >  
                    <input type="hidden" name="email" value="<?php echo $email; ?>"/>
                    <div class="form-group">
                        <label for="pwd">Password</label>
                        <input type="password" name="pwd" id="pwd" placeholder="Enter Password" required 
                               data-parsley-type="pwd" data-parsley-trigger="keyup" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="cpwd">Confirm Password</label>
                        <input type="password" name="cpwd" id="cpwd" placeholder="Enter Confirm Password" required 
                               data-parsley-type="cpwd" data-parsley-trigger="keyup" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <input type="submit" id="login" name="pwdrst" value="Reset Password" class="btn btn-success" />
                    </div>
                    <p class="<?php echo $msgClass; ?>"><?php if(!empty($msg)){ echo $msg; } ?></p>
                </form>
            </div>
        </div>  
    </div>
</body>
</html>