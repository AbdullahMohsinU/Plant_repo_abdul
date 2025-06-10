<?php
// Enable error reporting for debugging (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get values from the form
$Firstname = $_POST['firstname'];
$Lastname = $_POST['lastname'];
$Email = $_POST['email'];
$Mobile = $_POST['mobile'];
$Address = $_POST['address'];
$Password = $_POST['password'];

// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'plants_nursery');

// Check connection
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
} else {
    // Prepare SQL statement to insert data safely
    $stmt = $conn->prepare("INSERT INTO Registration (FirstName, LastName, Email, Mobile, Address, Password) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiss", $Firstname, $Lastname, $Email, $Mobile, $Address, $Password);

    // Execute and handle result
    if ($stmt->execute()) {
        echo '<script> alert("Registered Successfully!"); window.location="Homepage.html"; </script>';
    } else {
        echo '<script> alert("Error: Could not register. Please try again."); window.location="Login_Register.html"; </script>';
    }

    $stmt->close();
    $conn->close();
}
?>
