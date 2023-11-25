<?php

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

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM `super_admin` WHERE user_name='$username';";
        $result = mysqli_query($conn, $sql);

        if ($row = mysqli_fetch_assoc($result)) {
            $storedPassword = $row['user_password']; // This is the hashed password

            // Use password_verify() to compare the submitted password with the stored password
            if (password_verify($password, $storedPassword)) {
                // Login successful
                session_start();
                $_SESSION["loggedIn"] = true;
                $_SESSION["user_id"] = $row["user_id"];

                header("location: indexx.php");
                exit;
            }
            
            // Login failure
            $error = true;
            $storedPassword = password_hash($password, PASSWORD_DEFAULT); // Retrieve the hashed password from the database
header("location: ../../index.php?error=$error&password=" . urlencode($storedPassword) . "&message=Incorrect%20username%20or%20password");
        }
    }
?>
