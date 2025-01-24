<?php
session_start(); 
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>FitnessCo - Home</title>
    <style>
        body {
            background-image: url('background.webp'); 
            background-size: cover;
            background-position: center;
            color: white; 
            font-family: Arial, sans-serif;
        }
        .intro {
            text-align: center;
            margin: 20px;
color:black;
        }
        .image-row {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }
        .image-row img {
            width: 30%; 
            margin: 0 10px;
            border-radius: 10px; 
        }
        .details-section {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin: 20px;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.7); 
            border-radius: 10px;
        }
        .details-section img {
            width: 200px; 
            border-radius: 10px; 
            margin-right: 20px; 
        }
        .content-section {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.7); 
            border-radius: 10px;
        }
        .profile {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9); 
            color: black; 
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        .profile h3 {
            text-align: center;
            margin-bottom: 15px;
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
            <a href="progress.php">Progress</a>
            <?php if (isset($_SESSION['userid'])): ?>
                <a href="logout.php" style="float: right;">Logout</a>
            <?php else: ?>
                <a href="login_Front.php" style="float: right;">Login</a>
            <?php endif; ?>
        </nav>
    </header>

   
<br>
 <?php if (isset($_SESSION['userid'])): ?>
        <div class="profile">
            <h3>User Profile</h3>
            <p>Username: <?php echo $_SESSION['username']; ?></p>
            <?php
            $userid = $_SESSION['userid'];
            $sql = "SELECT * FROM user WHERE userid = '$userid'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                echo "<p>Date of Birth: " . htmlspecialchars($user['DOB']) . "</p>";
                echo "<p>Email: " . htmlspecialchars($user['e_mail']) . "</p>";
                echo "<p>Weight: " . htmlspecialchars($user['weight']) . " kg</p>";
            }
            ?>
        </div>
    <?php endif; ?>

 <div class="intro">
        <h2>Welcome to FitnessCo!</h2>
        <p>Your one-stop destination for tracking your fitness journey. Log your workouts, monitor your progress, and achieve your fitness goals!</p>
        <a href="register.php" class="get-started-button">Get Started</a>
    </div>

    <div class="content-section">
        <h3>Why Choose FitnessCo?</h3>
        <p>At FitnessCo, we believe in empowering individuals to take charge of their health and fitness. Our platform offers a variety of features to help you stay motivated and on track:</p>
    </div>

    <div class="details-section">
        <img src="personalized.webp" alt="Feature 1"> 
        <div>
            <h4>Personalized Workouts</h4>
            <p>Tailor your fitness routine to meet your specific goals, whether it's weight loss, muscle gain, or overall health improvement.</p>
        </div>
    </div>

    <div class="details-section">
 <img src="progress.png" alt="Feature 2"> 
        <div>
            <h4>Progress Tracking</h4>
            <p>Monitor your workouts and progress over time with our easy-to-use tracking tools.</p>
        </div>
    </div>

    <div class="details-section">
        <img src="community.png" alt="Feature 3"> 
        <div>
            <h4>Community Support</h4>
            <p>Join a community of fitness enthusiasts who share tips, motivation, and encouragement.</p>
        </div>
    </div>

    <div class="content-section">
        <h3>Join Us Today!</h3>
        <p>Access resources and advice on healthy eating to complement your fitness journey. Get insights from fitness professionals and trainers to optimize your workouts. Start your journey towards a healthier, fitter you!</p>
    </div>

   

    <footer>
        <p>&copy; 2025 FitnessCo. All Rights Reserved.</p>
        <p>Contact us at: <a href="mailto:FitnessCo@gmail.com" style="color: wheat;">FitnessCo@gmail.com</a> | Phone: +92-327-6500915</p>
        <p>Follow us on social media: <a href="#" style="color: wheat;">Facebook</a> | <a href="#" style="color: wheat;">Twitter</a> | <a href="#" style="color: wheat;">Instagram</a></p>
    </footer>
</body>
</html>