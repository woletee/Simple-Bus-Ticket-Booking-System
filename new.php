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
        echo "<table>";
        echo "<tr><th>From</th><th>To</th><th>Bus Type</th><th>Price</th><th>Actions</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['From']) . "</td>";
            echo "<td>" . htmlspecialchars($row['To']) . "</td>";
            echo "<td>" . htmlspecialchars($row['bus_type']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Price']) . "</td>";
            echo "<td><a href='book.php?route_id=" . htmlspecialchars($row['route_id']) . "'>Book</a></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No available tickets found for the given criteria.";
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
