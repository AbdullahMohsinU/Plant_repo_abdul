<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$Email = $_POST['email'];
$Password = $_POST['password'];

$conn = new mysqli('localhost','root','','Plants Nursery');


if($conn->connect_error){
	echo "$conn->connect_error";
	die("Connection Failed : ". $conn->connect_error);
} else {
	$stmt = $conn->prepare("select * from Registration where email = ?");
	$stmt->bind_param("s", $Email);
	$stmt->execute();
	$stmt_result = $stmt->get_result();

	if($stmt_result->num_rows > 0) {
		$data = $stmt_result->fetch_assoc();

		if($data['Password'] === $Password) {
			echo '<script> alert("Login Successfull !"); window.location="Homepage.html" </script>';
			session_start();
		} else {
			echo '<script> alert("Invalid Password !"); window.location="Login_Register.html" </script>';
		}
	} else {
		echo '<script> alert("Invalid Email or Password !"); window.location="Login_Register.html" </script>';
	}
}
?>
