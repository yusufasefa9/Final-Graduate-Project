
<?php

// Retrieve the payment ID from the request body
$data = json_decode(file_get_contents("php://input"));
$paymentId = $data->paymentId;

// Connect to MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wbdems";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update the database entry to mark the payment as verified
$sql = "UPDATE payment SET verification = true WHERE id = $paymentId";

if ($conn->query($sql) === TRUE) {
    echo "Payment verified successfully";
} else {
    echo "Error updating payment: " . $conn->error;
}

$conn->close();

?>
