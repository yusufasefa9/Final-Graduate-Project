
<?php
include('admin/dbcon.php');
 include('session.php'); 

if (!isset($_SESSION['id'])) {
    // Handle unauthorized access, redirect the user to login page or display an error message
    echo "Unauthorized access!";
    exit();
}

// Fetch the user ID from the session
$id = $_SESSION['id'];
$sql = "SELECT s.student_id, s.firstname, s.lastname, sa.grade AS assignment_grade, scq.grade AS quiz_grade,
               (COALESCE(sa.grade, 0) + COALESCE(scq.grade, 0)) AS sum_grade
        FROM student s
        LEFT JOIN student_assignment sa ON s.student_id = sa.student_id
        LEFT JOIN student_class_quiz scq ON s.student_id = scq.student_id
        WHERE s.student_id = $id";

$result = $conn->query($sql);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Exam Results</title>
    <style>
        /* Add your CSS styles here */
        body {
            background-color: #f2f2f2; /* Light gray background for the entire page */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff; /* White background for the table */
            margin: 0 auto; /* Center align the table */
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #007bff; /* Original blue color */
            color: white; /* White text */
        }
        h1 {
            color: green;
            text-align: center; /* Center align the heading */
            margin-top: 20px; /* Add some margin at the top */
        }
    </style>
</head>
<body>
<div style="text-align: center; margin-top: 20px;">
    <a href="dashboard_student.php" style="text-decoration: none; color: white; background-color: #007bff; font-size: 16px; padding: 10px 20px; border-radius: 5px;">&larr; Back </a>
</div>

<?php
require_once "navbar_student.php";
require_once "header_dashboard.php";

function calculateGrade($mark) {
    if ($mark >= 40 && $mark < 50) {
        return 'C-';
    } elseif ($mark >= 50 && $mark < 60) {
        return 'C';
    } elseif ($mark >= 60 && $mark < 70) {
        return 'B-';
    } elseif ($mark >= 70 && $mark < 75) {
        return 'B';
    } elseif ($mark >= 75 && $mark < 80) {
        return 'B+';
    } elseif ($mark >= 80 && $mark < 85) {
        return 'A-';
    } elseif ($mark >= 85 && $mark < 90) {
        return 'A';
    } elseif ($mark >= 90 && $mark <= 100) {
        return 'A+';
    } else {
        // Handle invalid marks
        return 'F';
    }
}


if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>Student ID</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Assignment Grade</th>
                <th>Exam result</th>
                <th>Sum</th>
                <th>Grade</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        $sumGrade = $row["sum_grade"];
        $sumGradeLetter = calculateGrade($sumGrade);
        echo "<tr>
                <td>" . $row["student_id"] . "</td>
                <td>" . $row["firstname"] . "</td>
                <td>" . $row["lastname"] . "</td>
                <td>" . $row["assignment_grade"] . "</td>
                <td>" . $row["quiz_grade"] . "</td>
                <td>" . $row["sum_grade"] . "</td>
                <td>" . $sumGradeLetter . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p style='text-align: center;'>No results found</p>";
}

$conn->close();
?>


<?php include('script.php'); ?>

</body>
</html>