<?php
include('admin/dbcon.php');
include('session.php'); // Assuming this file has the necessary session handling
include('navbar_teacher.php');
 include('header_dashboard.php'); 
include('teacher_sidebar.php'); 


// Assuming $teacher_id holds the ID of the logged-in teacher
$id = $_SESSION['id'];

// Your SQL query
$sql = "SELECT tcs.teacher_id, tcs.student_id, s.firstname, s.lastname, 
               SUM(scq.grade) AS total_grade, 
               SUM(sa.grade) AS total_assignment
        FROM teacher_class_student tcs
        INNER JOIN student s ON tcs.student_id = s.student_id
        LEFT JOIN student_class_quiz scq ON tcs.student_id = scq.student_id
        LEFT JOIN student_assignment sa ON tcs.student_id = sa.student_id
        WHERE tcs.teacher_id = $id
        GROUP BY tcs.student_id";

$result = $conn->query($sql);

echo "<style>
        table {
            width: 80%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
            color: white;
        }
      </style>";

if ($result !== false && $result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>STUDENT ID</th>
                <th>FIRST NAME</th>
                <th>LAST NAME</th>
                <th>EXAM RESULT</th>
                <th>ASSIGNMENT</th>
                <th>GRADE</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        $total_grade = $row["total_grade"];
        $total_assignment = $row["total_assignment"];
        $overall_grade = calculateOverallGrade($total_grade, $total_assignment);
        
        echo "<tr>
                <td>" . $row["student_id"] . "</td>
                <td>" . $row["firstname"] . "</td>
                <td>" . $row["lastname"] . "</td>
                <td>" . $total_grade . "</td>
                <td>" . $total_assignment . "</td>
                <td>" . $overall_grade . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p style='text-align: center;'>No results found</p>";
}

$conn->close();


function calculateOverallGrade($grade, $assignment) {
    $total_mark = $grade + $assignment;
    
    if ($total_mark >= 40 && $total_mark < 50) {
        return 'C-';
    } elseif ($total_mark >= 50 && $total_mark < 60) {
        return 'C';
    } elseif ($total_mark >= 60 && $total_mark < 70) {
        return 'B-';
    } elseif ($total_mark >= 70 && $total_mark < 75) {
        return 'B';
    } elseif ($total_mark >= 75 && $total_mark < 80) {
        return 'B+';
    } elseif ($total_mark >= 80 && $total_mark < 85) {
        return 'A-';
    } elseif ($total_mark >= 85 && $total_mark < 90) {
        return 'A';
    } elseif ($total_mark >= 90 && $total_mark <= 100) {
        return 'A+';
    } else {
        // Handle invalid marks
        return 'F';
    }
    
}
 include('script.php');

?>
