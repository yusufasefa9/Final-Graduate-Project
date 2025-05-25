<?php 
include("admin/dbcon.php");

$output = "";

if (isset($_POST['register'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $uname = $_POST['uname'];
    $role = $_POST['role'];
    $pass = $_POST['pass'];
    $c_pass = $_POST['c_pass'];

    $error = array();

    if (empty($fname)) {
        $error['error'] = "Firstname is Empty";
    } elseif (empty($lname)) {
        $error['error'] = "Lastname is empty";
    } elseif (empty($email)) {
        $error['error'] = "Email is empty";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error['error'] = "Invalid email format";
    } elseif (empty($uname)) {
        $error['error'] = "Username is empty";
    } elseif (empty($role)) {
        $error['error'] = "Select role";
    } elseif (empty($pass)) {
        $error['error'] = "Enter Password";
    } elseif (empty($c_pass)) {
        $error['error'] = "Confirm Password";
    } elseif ($pass != $c_pass) {
        $error['error'] = "Both passwords do not match";
    }

    if (isset($error['error'])) {
        $output .= $error['error'];
    } else {
        $rd2 = mt_rand(1000, 9999) . "_File";

        // File upload handling
        if (!empty($_FILES['file']['name'])) {
            $file_name = $_FILES['file']['name'];
            $file_tmp = $_FILES['file']['tmp_name'];
            // Adjust the destination directory as needed
            $file_destination = "admin/uploads/". $file_name;
            // Move the uploaded file to the desired location
            move_uploaded_file($file_tmp, $file_destination);
        } else {
            // If no file uploaded, set file destination to empty
            $file_destination = "";
        }

        // Insert user into appropriate table based on role
        if ($role == "Student") {
            // Check if the student already exists
            $check_student_query = "SELECT * FROM student WHERE username = '$uname' OR email = '$email'";
            $check_student_result = mysqli_query($conn, $check_student_query);
            if (mysqli_num_rows($check_student_result) > 0) {
                $output .= "Student already exists.";
            } else {
                $student_query = "INSERT INTO student (firstname, lastname, email, username, password, file) VALUES ('$fname', '$lname', '$email', '$uname', '$pass', '$file_destination')";
                $res_student = mysqli_query($conn, $student_query);
                if ($res_student) {
                    $output .= "You have successfully registered as a student.";
                } else {
                    $output .= "Failed to register as a student.";
                }
            }
        } elseif ($role == "Teacher") {
            // Insert into teacher table
            $teacher_query = "INSERT INTO teacher (firstname, lastname, email, username, password, file) VALUES ('$fname', '$lname', '$email', '$uname', '$pass', '$file_destination')";
            $res_teacher = mysqli_query($conn, $teacher_query);
            if ($res_teacher) {
                $output .= "You have successfully registered as a teacher.";
            } else {
                $output .= "Failed to register as a teacher.";
            }
        }

        // Redirect after processing
        header("Location: login.php");
        exit();
    }
}
?>





<<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        /* Custom CSS styles */
        body {
            background-color: #f8f9fa;
            padding-top: 50px; /* Add padding to create space at the top */
        }
        .container {
            padding: 0 15px; /* Add padding to the container */
        }
        .form-container {
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        }
        h3 {
            color: #007bff;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
        }
        label {
            font-weight: bold;
            margin-top: 10px;
        }
        input[type="text"],
        input[type="password"],
        select {
            border: 1px solid #ced4da;
            border-radius: 5px;
            padding: 10px;
            width: 100%;
            margin-top: 5px;
        }
        .btn-register {
            margin-top: 20px;
        }
        .btn-register,
        .ca {
            display: block;
            text-align: center;
        }
        .ca {
            margin-top: 10px;
            color: #007bff;
        }
        .error-msg {
            color: #dc3545;
            margin-top: 10px;
            text-align: center;
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
   <li><a href="login.php">Login</a></li>

  </ul>
     
    </div>
    </div>
  </header>
 

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="form-container">
                <form method="post" enctype="multipart/form-data">
                    <h3>Register</h3>
                    <div class="error-msg"><?php echo $output; ?></div>
                    <label for="fname">Firstname</label>
                    <input type="text" id="fname" name="fname" class="form-control" placeholder="Enter Firstname" autocomplete="off">
                    <label for="lname">Lastname</label>
                    <input type="text" id="lname" name="lname" class="form-control" placeholder="Enter Lastname" autocomplete="off">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" class="form-control" placeholder="Enter email" autocomplete="off">
                    <label for="uname">Username</label>
                    <input type="text" id="uname" name="uname" class="form-control" placeholder="Enter Username" autocomplete="off">
                    <label for="role">Select Role</label>
                    <select id="role" name="role" class="form-control">
                        <option value="">Select Role</option>
                        <option value="Student">Student</option>
                        <option value="Teacher">Teacher</option>
                    </select>
                    <label for="pass">Password</label>
                    <input type="password" id="pass" name="pass" class="form-control" placeholder="Enter Password">
                    <label for="c_pass">Confirm Password</label>
                    <input type="password" id="c_pass" name="c_pass" class="form-control" placeholder="Confirm Password">
                    <!-- File upload input field -->
                    <label for="file">Upload File</label>
                    <input type="file" id="file" name="file" class="form-control">
                    <input type="submit" name="register" class="btn btn-primary btn-register" value="Register">
                    <a href="login.php" class="ca">Login here</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
