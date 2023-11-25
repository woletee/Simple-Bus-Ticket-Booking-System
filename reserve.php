<?php
// Database connection credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sbtbsphp";

// Create a new instance of MySQLi
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_POST["cid"];
    $booked_seat = $_POST["seatInput"];
    $bus_no = $_POST["bus_no"];

    // Check if the seat is already booked for the same bus number
    $query = "SELECT * FROM bookings WHERE booked_seat = '$booked_seat' AND bus_no = '$bus_no'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo '<div class="alert alert-danger">Seat ' . $booked_seat . ' is already booked for bus number ' . $bus_no . '.</div>';
    } else {
        performBooking($conn, $customer_id, $booked_seat, $bus_no);
    }
}

// Function to perform the booking and insert the data into the database
function performBooking($conn, $customer_id, $booked_seat, $bus_no) {
    // Generate a booking ID
    $booking_id = generateBookingId();

    // Perform the booking and insert the data into the database
    $customer_name = $_POST["cname"];
    $amount = $_POST["bookAmount"];
    $booking_created = date("Y-m-d H:i:s");

    $query = "INSERT INTO bookings (booking_id, customer_id, customer_route, booked_seat, booked_amount, booking_created, bus_no)
              VALUES ('$booking_id', '$customer_id','$customer_name', '$booked_seat', '$amount', '$booking_created', '$bus_no')";

    if ($conn->query($query) === TRUE) {
        echo '<div class="alert alert-success">Booking successfully made. Booking ID: ' . $booking_id . '</div>';
    } else {
        echo '<div class="alert alert-danger">Error creating booking: ' . $conn->error . '</div>';
    }
}

// Function to generate a unique booking ID
function generateBookingId() {
    // Logic to generate a unique booking ID, you can modify this according to your requirements
    $prefix = "BOOK";
    $random_number = mt_rand(100000, 999999);
    $booking_id = $prefix . $random_number;

    return $booking_id;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/d8cfbe84b9.js" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }
        .btn-primary:focus,
        .btn-primary.focus {
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.5);
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Book a Seat</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="mb-3">
            <label for="cid" class="form-label">Customer ID:</label>
            <input type="text" class="form-control" id="cid" name="cid" required>
        </div>
        <div class="mb-3">
            <label for="cname" class="form-label">Customer Name:</label>
            <input type="text" class="form-control" id="cname" name="cname" required>
        </div>
        <div class="mb-3">
            <label for="seatInput" class="form-label">Seat Number:</label>
            <select class="form-control" id="seatInput" name="seatInput">
                <?php
                // Display seat options from 1 to 40
                for ($i = 1; $i <= 40; $i++) {
                    echo '<option value="' . $i . '">' . $i . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="bookAmount" class="form-label">Booking Amount:</label>
            <input type="text" class="form-control" id="bookAmount" name="bookAmount" required>
        </div>
        <div class="mb-3">
            <label for="bus_no" class="form-label">Bus Number:</label>
            <input type="text" class="form-control" id="bus_no" name="bus_no" required>
        </div>
        <button type="submit" class="btn btn-primary">Book Now</button>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
