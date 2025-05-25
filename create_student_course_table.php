<?php
include('admin/dbcon.php');

// Create student to course table
$sql = "CREATE TABLE `student_to_course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `grade` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`student_id`) REFERENCES `student`(`student_id`),
  FOREIGN KEY (`subject_id`) REFERENCES `subject`(`subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

if ($conn->query($sql) === TRUE) {
    echo "Student to course table created successfully";
} else {
    echo "Error creating student to course table: " . $conn->error;
}

$conn->close();
?>