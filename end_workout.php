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
    $endDate = date('Y-m-d H:i:s'); // Current date and time

    $endQuery = "UPDATE user_participation SET participation_status = 'NO' WHERE workoutid = '$workoutId' AND userid = '$userId'";
    
    if (mysqli_query($conn, $endQuery)) {
        $updateReportQuery = "UPDATE progress_report SET end_date = '$endDate' WHERE userid = '$userId' AND workoutid = '$workoutId' AND end_date IS NULL";
        mysqli_query($conn, $updateReportQuery);
        
        header("Location: workouts.php");
        exit();
    } else {
        die("Error ending workout: " . mysqli_error($conn));
    }
}
?>