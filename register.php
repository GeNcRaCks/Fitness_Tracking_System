<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>FitnessCo - Register</title>
    <style>
        body {
            background-image: url('background.webp');
            background-size: cover;
            background-position: center;
            color: white; /* Change text color for better visibility */
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
        .form-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 40px;
            background-color: rgba(0, 0, 0, 0.8); /* Semi-transparent background */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-container label {
            display: block;
            margin: 10px 0 5px;
        }
        .form-container input[type="text"],
        .form-container input[type="date"],
        .form-container input[type="email"],
        .form-container input[type="password"],
        .form-container input[type="number"],
        .form-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
        }
        .form-container input[type="submit"] {
            background-color: #28a745; /* Green background for the submit button */
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .form-container input[type="submit"]:hover {
            background-color: #218838; /* Darker green on hover */
        }
        footer {
            text-align: center;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent background */
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
            <a href="workouts.php">Workouts</a>
            <a href="progress.php">Progress</a>
            <a href="login_Front.php" style="float: right;">Login</a>
        </nav>
    </header>

    <div class="form-container">
        <h2>User Registration</h2>
        <form action="db.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" required max="<?php echo date('Y-m-d', strtotime('-15 years')); ?>" title="You must be at least 16 years old.">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Please enter a valid email address.">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required minlength="8" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}" title="Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character.">
            <label for="weight">Weight (kg):</label>
            <input type="number" id="weight" name="weight" step="0.01" required>
            <input type="submit" value="Register">
        </form>
    </div>

    <footer>
        <p>&copy; 2025 FitnessCo. All Rights Reserved.</p>
        <p>Contact us at: <a href="mailto:FitnessCo@gmail.com" style="color: wheat;">FitnessCo@gmail.com</a> | Phone: +92-327-6500915</p>
        <p>Follow us on social media: <a href="#" style="color: wheat;">Facebook</a> | <a href="#" style="color: wheat;">Twitter</a> | <a href="#" style="color: wheat;">Instagram</a></p>
    </footer>
</body>
</html>