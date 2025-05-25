
<?php
include('admin/dbcon.php');
session_start();

// Check if 'username' and 'password' keys are set in the $_POST array
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    /* student */
    $query_student = "SELECT * FROM student WHERE username='$username' AND password='$password'";
    $result_student = mysqli_query($conn, $query_student) or die(mysqli_error($conn));
    $row_student = mysqli_fetch_array($result_student);
    $num_row_student = mysqli_num_rows($result_student);

    /* teacher */
    $query_teacher = mysqli_query($conn, "SELECT * FROM teacher WHERE username='$username' AND password='$password'") or die(mysqli_error($conn));
    $num_row_teacher = mysqli_num_rows($query_teacher);
    $row_teacher = mysqli_fetch_array($query_teacher);

    /* users */
    $query_user = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result_user = mysqli_query($conn, $query_user) or die(mysqli_error($conn));
    $row_user = mysqli_fetch_array($result_user);
    $num_row_user = mysqli_num_rows($result_user);

    if ($num_row_student > 0) { 
        $_SESSION['id'] = $row_student['student_id'];
        echo json_encode(['status' => 'success', 'user_type' => 'student', 'user_info' => $row_student]);
        exit();
    } elseif ($num_row_teacher > 0) {
        $_SESSION['id'] = $row_teacher['teacher_id'];
        echo json_encode(['status' => 'success', 'user_type' => 'teacher', 'user_info' => $row_teacher]);
        exit();
    } elseif ($num_row_user > 0) { 
        $_SESSION['id'] = $row_user['user_id'];
        echo json_encode(['status' => 'success', 'user_type' => 'user', 'user_info' => $row_user]);
        exit();
    } else { 
        echo json_encode(['status' => 'failed']);
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>


    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <style>
       
        .login-container {
            max-width: 400px;
            margin: 150px auto 0; /* Adjust margin-top to move the container down */
            padding: 20px;
            border: 2px solid #007bff;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.2);
        }
        .form-signin .form-control {
            position: relative;
            box-sizing: border-box;
            height: auto;
            padding: 10px;
            font-size: 16px;
        }
        .form-signin .form-control:focus {
            z-index: 2;
        }
        .form-signin input[type="text"],
        .form-signin input[type="password"] {
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .form-signin button {
            margin-top: 40px;
            border-radius: 5px;
        }
        .ca {
            display: block;
            text-align: center;
            margin-top: 10px;
            margin-bottom: 20px;
            color: #007bff;
        }
    </style>
     <link href="assets/css/style.css" rel="stylesheet">
</head>
<body id="login">

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="index.php">Great Vision College</a></h1>
  

      <nav id="navbar" class="navbar order-last order-lg-0">
      <ul class="navigation-menu">
    <li><a href="index.php">Home</a></li>
    <li><a href="aboutt.php">About</a></li>
    <li><a href="courses.php">Courses</a></li>
    <li><a href="contact.html">Contact</a></li>
    <li><a href="register.php">Register</a></li>
            <!-- Changed "signup" to "Signup" for consistency -->
   <li><a class="active">Login</a></li>
   


  </ul>
     
    </div>
    </div>
  </header>
 

<div class="login-container">
    <form id="login_form1" class="form-signin" method="post">
        <h3 class="mb-3 font-weight-normal text-center">Sign in</h3>
        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        <a href="forgot.php" class="ca">Forgot Password</a>
        <button type="submit" name="signin" class="btn btn-primary btn-block">Sign In</button>
        <a href="register.php" class="ca">Register here</a>
        <div id="login_message" class="text-center mt-3"></div>
    </form>
</div>




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $('#signin').tooltip('show');
    $('#signin').tooltip('hide');
});

$(document).ready(function(){
    $("#login_form1").submit(function(e){
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "login.php",
            data: formData,
            dataType: 'json',
            success: function(response){
                if(response.status === 'success') {
                    var user_type = response.user_type;
                    var user_info = response.user_info;
                    if (user_type === 'student') {
                        $('#welcome_message').html('Welcome Student');
                        window.location.href = 'dashboard_student.php';
                    } else if (user_type === 'teacher') {
                        $('#welcome_message').html('Welcome Teacher');
                        window.location.href = 'dasboard_teacher.php';
                    } else if (user_type === 'user') {
                        $('#welcome_message').html('Welcome User');
                        window.location.href = 'admin/dashboard.php';
                    }
                } else {
                    $('#login_message').html('Your username and password is incorrect.').css('color', 'red');; // Display message
                }
            }
        });
        return false;
    });
});

</script>

</body>
</html>
