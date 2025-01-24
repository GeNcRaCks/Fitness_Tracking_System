<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fitness_tracker";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username'])) {
    $username = $_POST['username'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
   $weight = $_POST['weight'];

    $sql = "INSERT INTO user (username, DOB, e_mail, password, weight) VALUES ('$username', '$dob', '$email', '$password', '$weight')";
    
    if ($conn->query($sql) === TRUE) {
header("Location: login_Front.php");
        exit();    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>