<!DOCTYPE html>
<html>
<head>
    <script>
        function showBusType(busType) {
         
            // You can replace the alert with any other logic to display the bus type as text
        }
		function showBusno(bus_no) {
            alert("Bus No: " + bus_no);
            // You can replace the alert with any other logic to display the bus type as text
        }
    </script>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        a {
            text-decoration: none;
            color: #4CAF50;
        }
		.custom-alert {
  background-color: #ff8566;
  color: white;
  padding: 15px;
  border: none;
  border-radius: 8px;
  font-size: 30px;
  width:40%;
  align-items:center;
  justify-content:center;
  margin:200px;
  padding-left:50px;
  margin-right:100px;
}

.custom-alert strong {
  font-weight: bold;
}
    </style>
</head>
<body>
    <?php
    require 'assets/partials/_functions.php';

    function searchAvailableTickets($from, $to) {
        $conn = db_connect();
        if (!$conn) {
            die("Connection Failed");
        }

        $from = mysqli_real_escape_string($conn, $from);
        $to = mysqli_real_escape_string($conn, $to);

        $query = "SELECT * FROM routes WHERE `From` = '$from' AND `To` = '$to'";

        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            echo "<style>
                table {
                    width: 100%;
                    border-collapse: collapse;
                }

                th, td {
                    padding: 8px;
                    text-align: left;
                    border-bottom: 1px solid #ddd;
                }

                tr:hover {
                    background-color: #f5f5f5;
                }

                th {
                    background-color: #4CAF50;
                    color: white;
                }

                a {
                    text-decoration: none;
                    color: #4CAF50;
                }
            </style>";

            echo "<table>";
            echo "<tr><th>From</th><th>To</th><th>Bus Type</th><th>Price</th><th>Bus Number</th><th>route_dep_date</th><th>Action</th></tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['From']) . "</td>";
                echo "<td>" . htmlspecialchars($row['To']) . "</td>";
                echo "<td>" . htmlspecialchars($row['bus_type']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Price']) . "</td>";
                echo "<td>" . htmlspecialchars($row['bus_no']) . "</td>";
                echo "<td>" . htmlspecialchars($row['route_dep_date']) . "</td>";
                echo "<td><a href='booking.php?id=" . $row['id'] . "&bus_type=" . urlencode($row['bus_type']) .  "&bus_no=" . urlencode($row['bus_no']) . "' onclick='return showBusType(" . json_encode($row['bus_type']) . ");'>Select</a></td>";

                echo "</tr>";
            }

            echo "</table>";
        } 
	
else {
    echo '<div class="alert alert-danger custom-alert">';
    echo '  <strong>No Matching Route found!</strong> Please enter the correct source and destination !.';
    echo '</div>';
}
        mysqli_close($conn);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['search'])) {
            $from = isset($_GET['From']) ? $_GET['From'] : '';
            $to = isset($_GET['To']) ? $_GET['To'] : '';
            searchAvailableTickets($from, $to);
        }
    }
    ?>
</body>
</html>











