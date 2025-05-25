<?php
require_once "header_dashboard.php";
require_once "session.php";
require_once "admin/dbcon.php";
require_once "functions.php";
require_once "navbar_teacher.php";

$user = new login_registration_class();

$pageTitle = "Student Result";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="fonts/stylesheet.css">
   
    <style>
        /* Additional CSS styles specific to this page */
        .all_student {
            margin-top: 20px;
        }
        .tab_one {
            width: 80%;
            border-collapse: collapse;
            background-color: #fff;
            margin: 0 auto;
        }
        .tab_one th,
        .tab_one td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: center;
        }
        .tab_one th {
            background-color: #007bff;
            color: white;
        }
        .tab_one td a {
            text-decoration: none;
            color: #007bff;
        }
        .tab_one td a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>

<div class="all_student">
<?php include('teacher_sidebar.php'); ?>

    <table class="tab_one">
        <tr>
            <th>Name</th>
            <th>ID</th>
            <th>Add Result</th>
            <th>View Result</th>
        </tr>
        <?php 
        $i = 0;
        $alluser = $user->get_all_student();
        $query = "SELECT * FROM student";
        $result = $conn->query($query);
        
        if (!$result) {
            echo "<tr><td colspan='4'>Error: " . $conn->error . "</td></tr>";
        } else {
            while ($row = $result->fetch_assoc()) {
                // Process each row
        ?>
        <tr>
            <td><?php echo $row['firstname'];?></td>
            <td><?php echo $row['student_id'];?></td>
            <td><a href="add_result.php?ar=<?php echo $row['student_id']; ?>&vn=<?php echo $row['firstname'];?>">Add Result</a></td>
            <td><a href="view_result.php?vr=<?php echo $row['student_id']; ?>&vn=<?php echo $row['firstname'];?>">View Result</a></td>
        </tr>
        <?php
            }
            $result->free();
        }
        ?>
    </table>
</div>

<?php ob_end_flush(); ?>
<?php include('script.php'); ?>

</body>
</html>
