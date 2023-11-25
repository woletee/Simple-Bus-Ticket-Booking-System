<?php
session_start();

// Retrieve the bus_no from the previous page
$bus_no = isset($_GET['bus_no']) ? $_GET['bus_no'] : '';

?>

<!DOCTYPE html>
<html>
<head>
    <title>Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        h1 {
            text-align: center;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        .bus-type {
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 5px;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bus Booking</h1>
        <div class="bus-type">
            Bus No: <?php echo htmlspecialchars($bus_no); ?>
        </div>
        <div>
            <h2>Available Bus Numbers:</h2>
            <?php
            // Create a database connection
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "sbtbsphp";
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check if the connection is successful
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Query to retrieve bus numbers for the specified bus_no
            $query = "SELECT bus_no FROM routes WHERE bus_no = '$bus_no'";
            $result = $conn->query($query);

            if ($result && $result->num_rows > 0) {
                echo '<ul>';
                while ($row = $result->fetch_assoc()) {
                    $busNo = $row["bus_no"];
                    echo '<li><a href="booking_summary_redirect.php?bus_no=' . $busNo . '">' . $busNo . '</a></li>';
                }
                echo '</ul>';
            } else {
                echo 'No available buses for the selected bus number.';
            }

            // Close the database connection
            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
