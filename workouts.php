<?php
session_start(); 
include 'db.php'; // Ensure this is included to establish the database connection

// Check if the connection is valid
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!isset($_SESSION['userid'])) {
    header("Location: login_Front.php");
    exit();
}

$userId = $_SESSION['userid']; 

// Handle logging a workout
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['log_workout'])) {
    $workoutId = $_POST['workout_id'];
    $startDate = date('Y-m-d H:i:s'); 
    $caloriesBurned = rand(100, 500); 

    // Prepare the insert query
    $insertQuery = "INSERT INTO user_participation (userid, workoutid, participation_status, start_date) 
                    VALUES (?, ?, 'YES', ?)";
    
    $stmt = $conn->prepare($insertQuery);
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("iss", $userId, $workoutId, $startDate);
    
    if ($stmt->execute()) {
        // Prepare the report query
        $reportQuery = "INSERT INTO progress_report (start_date, userid, workoutid, calories_burned) 
                        VALUES (?, ?, ?, ?)";
        $stmtReport = $conn->prepare($reportQuery);
        if ($stmtReport === false) {
            die("Prepare failed: " . $conn->error);
        }
        $stmtReport->bind_param("siis", $startDate, $userId, $workoutId, $caloriesBurned);
        $stmtReport->execute();
        
        header("Location: workouts.php");
        exit();
    } else {
        die("Error logging workout: " . $stmt->error);
    }
}

// Fetch currently logged workouts
$workoutsQuery = "SELECT up.*, w.w_name, GROUP_CONCAT(e.ex_name SEPARATOR ', ') AS exercises 
                  FROM user_participation up 
                  JOIN workout w ON up.workoutid = w.workoutid 
                  JOIN exercises e ON w.workoutid = e.workoutid 
                  WHERE up.userid = ? AND up.participation_status = 'YES'
                  GROUP BY up.workoutid";
$stmtWorkouts = $conn->prepare($workoutsQuery);
if ($stmtWorkouts === false) {
    die("Prepare failed: " . $conn->error);
}
$stmtWorkouts->bind_param("i", $userId);
$stmtWorkouts->execute();
$workoutsResult = $stmtWorkouts->get_result();

if (!$workoutsResult) {
    die("Database query failed: " . mysqli_error($conn));
}

// Fetch available workouts with exercises
$availableWorkoutsQuery = "SELECT w.*, GROUP_CONCAT(e.ex_name SEPARATOR ', ') AS exercises 
                            FROM workout w 
                            LEFT JOIN exercises e ON w.workoutid = e.workoutid 
                            GROUP BY w.workoutid";
$availableWorkoutsResult = $conn->query($availableWorkoutsQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>FitnessCo - Workouts</title>
    <style>
        body {
            background-image: url('background.webp');
            background-size: cover;
            background-position: center;
            color: white; 
            font-family: Arial, sans-serif;
        }
        header {
            text-align: center;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.7);
        }
        nav a {
            margin: 0 15px;
            color: white;
            text-decoration: none;
        }
        .workout-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.8); 
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        .workout-list {
            margin-bottom: 20px;
            color: black;
        }
        .workout-item {
            padding: 15px;
            border-bottom: 1px solid #444;
        }
        .workout-item:last-child {
            border-bottom: none;
        }
        footer {
            text-align: center;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.7); 
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>FitnessCo</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="register.php">Register</a>
            <a href="progress.php">Progress</a>
            <a href="login_Front.php" style="float: right;">Login</a>
        </nav>
    </header>

    <div class="workout-container">
        <h2>Currently Logged Workouts</h2>
        <div class="workout-list">
        <?php
            if (mysqli_num_rows($workoutsResult) > 0) {
                while ($workout = mysqli_fetch_assoc($workoutsResult)) {
                    echo "<div class='workout-item'>";
                    echo "<h3>Workout: " . htmlspecialchars($workout['w_name']) . "</h3>";
                    echo "<p>Exercises: " . htmlspecialchars($workout['exercises']) . "</p>";
                    echo "<p>Start Date: " . htmlspecialchars($workout['start_date']) . "</p>";
                    echo "<form method='POST' action='end_workout.php'>";
                    echo "<input type='hidden' name='workout_id' value='" . htmlspecialchars($workout['workoutid']) . "'>";
                    echo "<button type='submit' name='end_workout'>End Workout</button>";
                    echo "</form>";
                    echo "</ div>";
                }
            } else {
                echo "<p>No active workouts found.</p>";
            }
        ?>
        </div>

        <h3>Available Workouts</h3>
        <div class="workout-list">
        <?php
            if ($availableWorkoutsResult && mysqli_num_rows($availableWorkoutsResult) > 0) {
                while ($row = mysqli_fetch_assoc($availableWorkoutsResult)) {
                    echo "<div class='workout-item'>";
                    echo "<h3>" . htmlspecialchars($row['w_name']) . "</h3>";
                    echo "<p>Exercises: " . htmlspecialchars($row['exercises']) . "</p>";
                    echo "<p>Duration: " . htmlspecialchars($row['w_time']) . "</p>";
                    echo "<form method='POST' action=''>";
                    echo "<input type='hidden' name='workout_id' value='" . htmlspecialchars($row['workoutid']) . "'>";
                    echo "<button type='submit' name='log_workout'>Log Workout</button>";
                    echo "</form>";
                    echo "</div>";
                }
            } else {
                echo "<p>No available workouts found.</p>";
            }
        ?>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 FitnessCo. All Rights Reserved.</p>
        <p>Contact us at: <a href="mailto:FitnessCo@gmail.com" style="color: wheat;">FitnessCo@gmail.com</a> | Phone: +92-327-6500915</p>
        <p>Follow us on social media: <a href="#" style="color: wheat;">Facebook</a> | <a href="#" style="color: wheat;">Twitter</a> | <a href="#" style="color: wheat;">Instagram</a></p>
    </footer>

</body>
</html>