<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chapa Payment</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .container {
      margin-top: 50px;
      width: 2000px; /* Increase width for better presentation */
    }
    .table-header {
      background-color: #007bff;
      color: #fff;
    }
    .table-data {
      background-color: #f8f9fa; /* Light gray background color */
    }
    .back-button {
      background-color: #007bff;
      color: #fff;
      border: none;
    }
    .back-button:hover {
      background-color: #0056b3;
      color: #fff;
    }
  </style>
</head>
<body>

<div class="container">
  <h2 style="border: 5px solid #ddd; border-radius: 8px; padding: 20px; 
  box-shadow: 15px 15px 15px rgba(0, 0, 0, 0.1);">Payment Details</h2>
  
  <!-- Add back button link -->
  <a href="dashboard.php" class="btn btn-secondary mb-3 back-button">Back </a>

  <table class="table table-striped">
    <thead class="table-header">
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Address</th>
        <th>Email</th>
        <th>Amount</th>
       <!-- New column for verification -->
      </tr>
    </thead>

    <tbody>
      <?php
        // Database connection parameters
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

        // Prepare SQL statement to fetch data from payment table
        $sql = "SELECT id, first_name, last_name, address, email, amount FROM payment";

        // Execute SQL query
        $result = $conn->query($sql);

        // Check if the query was successful
        if ($result === false) {
            die("Error executing query: " . $conn->error);
        }

        // Check if there are any rows returned
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr class='table-data'>";
                echo "<td>" . $row["first_name"] . "</td>";
                echo "<td>" . $row["last_name"] . "</td>";
                echo "<td>" . $row["address"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["amount"] . "</td>";
               
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No payment records found</td></tr>";
        }

        // Close connection
        $conn->close();
      ?>
    </tbody>
  </table>
</div>

</body>
</html>
