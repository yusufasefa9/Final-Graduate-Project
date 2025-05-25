<!DOCTYPE html>
<html>  
<head>  
    <title>Forgot Password</title>  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
    <?php
    include('admin/dbcon.php');
    ?>
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

.btn-default {
    background-color: #007bff;
}
</style>
<?php
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

if(isset($_REQUEST['pwdrst'])) {
    $email = $_REQUEST['email'];
    $check_email = mysqli_query($conn, "SELECT email FROM teacher WHERE email='$email'");
    $res = mysqli_num_rows($check_email);

    if($res > 0) {
        $message = '<div>
             <p><b>Hello!</b></p>
             <p>You are receiving this email because we received a password reset request for your account.</p>
             <br>
             <p><button class="btn btn-primary"><a href="http://localhost/tryendd/passwordreset.php?secret='.base64_encode($email).'">Reset Password</a></button></p>
             <br>
             <p>If you did not request a password reset, no further action is required.</p>
        </div>';

        include_once("vendor/phpmailer/phpmailer/src/PHPMailer.php");
        include_once("vendor/phpmailer/phpmailer/src/SMTP.php");

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->Username = "yeshinehabebaw@gmail.com";   //Enter your username/emailid
        $mail->Password = "ckoc xhab sand wrzu ";   //Enter your password
        $mail->FromName = "yeshineh abebaw";
        $mail->AddAddress($email);
        $mail->Subject = "Reset Password";
        $mail->isHTML( TRUE );
        $mail->Body = $message;
            {
        };

        if ($mail->send()) {
            $msg = "We have e-mailed your password reset link!";
            $msgClass = "success";
        } else {
            $msg = "Mailer Error: " . $mail->ErrorInfo;
            $msgClass = "error";
        }
    } else {
        $msg = "We can't find a user with that email address";
        $msgClass = "error";
    }
}
?>

<body>
<div class="container">  
    <div class="table-responsive">  
    <h3 align="center">Forgot Password</h3><br/>
    <div class="box">
     <form id="validate_form" method="post" >  
       <div class="form-group">
       <label for="email">Email Address</label>
       <input type="text" name="email" id="email" placeholder="Enter Email" required 
       data-parsley-type="email" data-parsley-trigger="keyup" class="form-control" />
      </div>
      <div class="form-group">
<input type="submit" id="login" name="pwdrst" value="Send Password Reset Link" class="btn btn-success" />
       </div>
       
       <p class="<?php echo $msgClass; ?>"><?php if(!empty($msg)){ echo $msg; } ?></p>

       <!-- Back Button and Link -->
       <div class="form-group">
            <a href="login.php" class="btn btn-default">Back</a>
       </div>
     </form>
     </div>
   </div>  
  </div>
</body>
</html>
