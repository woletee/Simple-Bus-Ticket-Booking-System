<!DOCTYPE html>
<html>

<head>
    <title>Customer Registration</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
<?php
// Define MySQL database connection parameters
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'sbtbsphp';

// Establish a connection to the MySQL database
$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

// Check if the connection was successful
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

// Initialize the registration status variable
$registrationStatus = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute an SQL statement to insert the data into the customers table
    $sql = "INSERT INTO customers (first_name, last_name, username, password) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $firstName, $lastName, $username, $password);

    if (mysqli_stmt_execute($stmt)) {
        // Registration successful
        $registrationStatus = 'Registration successful!';
    } else {
        // Registration failed
        $registrationStatus = 'Registration failed. Please try again.';
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($conn);
?>

    <div class="modal fade" id="loginModalll" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Customer Registration</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="">
                        <label for="first_name">First Name:</label>
                        <input type="text" name="first_name" required><br><br>

                        <label for="last_name">Last Name:</label>
                        <input type="text" name="last_name" required><br><br>

                        <label for="username">Username:</label>
                        <input type="text" name="username" required><br><br>

                        <label for="password">Password:</label>
                        <input type="password" name="password" required><br><br>

                        <input type="submit" value="Register">
                    </form>
                </div>
                <?php if (!empty($registrationStatus)) : ?>
                    <div class="modal-footer">
                        <p><?php echo $registrationStatus; ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
