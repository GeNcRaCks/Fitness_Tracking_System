<?php
session_start(); // Start the session
include 'db.php'; // Include the database connection

// Check if the user is logged in
if (!isset($_SESSION['userid'])) {
    header("Location: login_Front.php");
    exit();
}

$userId = $_SESSION['userid']; // Assuming user ID is stored in session

// Initialize variables for report generation
$reportGenerated = false;
$error = '';

// Handle report generation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['generate_report'])) {
    // Fetch progress reports with workout names
    $query = "SELECT pr.*, w.w_name 
              FROM progress_report pr 
              JOIN workout w ON pr.workoutid = w.workoutid 
              WHERE pr.userid = '$userId'";
    
    $result = mysqli_query($conn, $query);

    if ($result) {
        $reports = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $reportGenerated = true; // Flag to indicate report generation success
    } else {
        $error = "Error fetching workout data: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>FitnessCo - Progress</title>
    <style>
        body {
            background-image: url('background.webp');
            background-size: cover;
            background-position: center;
            color: black;
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
        .progress-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        .report {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.9);
        }
        footer {
            text-align: center;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.7);
        }
    </style>
</head>
<body>
    <header>
        <h1>FitnessCo</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="register.php">Register</a>
            <a href="workouts.php">Workouts</a>
            <a href="logout.php" style="float: right;">Logout</a>
        </nav>
    </header>

    <div class="progress-container">
        <h2>Your Progress Report</h2>
        
        <form method="POST" action="">
            <button type="submit" name="generate_report">Generate Progress Report</button>
        </form>

        <?php if ($reportGenerated): ?>
            <div class="report">
                <?php foreach ($reports as $row): ?>
                    <h3>Report ID: <?php echo htmlspecialchars($row['reportid']); ?></h3>
                    <p>Workout Name: <?php echo htmlspecialchars($row['w_name']); ?></p>
                    <p>Start Date: <?php echo htmlspecialchars($row['start_date']); ?></p>
                    <p>End Date: <?php echo htmlspecialchars($row['end_date']); ?></p>
                    <p>Calories Burned: <?php echo htmlspecialchars($row['calories_burned']); ?></p>
                    
                    <hr>
                <?php endforeach; ?>
            </div>
        <?php elseif (isset($error)): ?>
            <p><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

    </div>

    <footer>
        <p>&copy; 2025 FitnessCo. All Rights Reserved.</p>
        <p>Contact us at: <a href="mailto:FitnessCo@gmail.com" style="color: wheat;">FitnessCo@gmail.com</a> | Phone: +92-327-6500915</p>
        <p>Follow us on social media: <a href="#" style="color: wheat;">Facebook</a> | <a href="#" style="color: wheat;">Twitter</a> | <a href="#" style="color: wheat;">Instagram</a></p>
    </footer>

</body>
</html>