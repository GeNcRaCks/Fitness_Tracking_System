<?php
session_start();
include 'db.php';

if (!isset($_SESSION['userid'])) {
    header("Location: login_Front.php");
    exit();
}

$userId = $_SESSION['userid'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['workout_id'])) {
    $workoutId = $_POST['workout_id'];
    $startDate = date('Y-m-d H:i:s'); // Current date and time

    // Insert the workout into the database
    $query = "INSERT INTO workouts (userid, workoutid, start_date, status) VALUES ('$userId', '$workoutId', '$startDate', 'active')";
    
    if (mysqli_query($conn, $query)) {
        echo "Workout logged successfully.";
    } else {
        echo "Error logging workout: " . mysqli_error($conn);
    }
}
?>



