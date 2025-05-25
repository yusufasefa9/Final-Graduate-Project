<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Subject Information</title>
<style>
    /* Styling for the table */
    table {
        border-collapse: collapse;
        width: 90%;
    }
    th, td {
        padding: 8px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #007bff; /* Set the background color of table head */
        color: white; /* Set the text color of table head */
    }
</style>

</head>

<body>

<table>
    <thead>
        <tr>
            <th>Subject Title</th>
            <th>Price</th>
            <th>Semester</th>
        </tr>
    </thead>
    <tbody>
        <!-- PHP code to fetch data from database -->
        <?php
            // Assuming you are using PHP to fetch data from the database
            // Replace this with your actual database connection code
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "WBDEMS";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // SQL query to fetch data from subject table
            $sql = "SELECT subject_title, price, semester FROM subject";

            // Execute the query
            $result = $conn->query($sql);

            // Fetching data from the result set
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["subject_title"] . "</td>";
                    echo "<td>" . $row["price"] . "</td>";
                    echo "<td>" . $row["semester"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No subjects found</td></tr>";
            }

            // Close connection
            $conn->close();
        ?>
    </tbody>
</table>

<!-- Button to go back to pay.php -->
<button onclick="window.location.href = 'pay.php';" style="background-color: #007bff; color: white; padding: 10px 20px; border: none; cursor: pointer; border-radius: 5px;">Back</button>

</body>
</html>
