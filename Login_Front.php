<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>FitnessCo - Login</title>
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
        .form-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 40px;
            background-color: rgba(0, 0, 0, 0.8); 
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
        .form-container input[type="password"],
        .form-container input[type="submit"] {
            width: 95%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
        }
        .form-container input[type="submit"] {
            background-color: #28a745; 
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .form-container input[type="submit"]:hover {
            background-color: #218838; 
        }
        .error {
            color: red; /* Error message color */
            margin-top: -10px; 
            margin-bottom: 10px; 
        }
        footer {
            text-align: center;
            padding: 20px;
            background-color: rgba(0, 0, 0 , 0.7); 
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
            <a href="workouts.php">Workouts</a>
            <a href="progress.php">Progress</a>
        </nav>
    </header>

    <div class="form-container">
        <h2>User Login</h2>
        <form action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <?php 
            session_start();
            if (isset($_SESSION['errorMessage'])): ?>
                <div class="error"><?php echo htmlspecialchars($_SESSION['errorMessage']); ?></div>
                <?php unset($_SESSION['errorMessage']); // Clear the error message after displaying it ?>
            <?php endif; ?>
            <input type="submit" value="Login">
        </form>
    </div>

    <footer>
        <p>&copy; 2025 FitnessCo. All Rights Reserved.</p>
        <p>Contact us at: <a href="mailto:FitnessCo@gmail.com" style="color: wheat;">FitnessCo@gmail.com</a> | Phone: +92-327-6500915</p>
        <p>Follow us on social media: <a href="#" style="color: wheat;">Facebook</a> | <a href="#" style="color: wheat;">Twitter</a> | <a href="#" style="color: wheat;">Instagram</a></p>
    </footer>
</body>
</html>