<?php
// Start session to manage logged-in user
session_start();

// Database connection settings
$servername = "localhost"; // Change if necessary
$username = "root";        // Replace with your MySQL username
$password = "";            // Replace with your MySQL password
$dbname = "swati";        // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$loginError = ""; // Variable to store error messages

// Check if login form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    // Sanitize input
    $email = $_POST['email'];
    $password = $_POST['password'];
    

    // Prepare SQL query to fetch user data based on email
    $stmt = $conn->prepare("SELECT id, password FROM register WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // If user exists with the entered email
    if ($stmt->num_rows > 0) {
        // Fetch the user data
        $stmt->bind_result($id, $hashedPassword);
        $stmt->fetch();

        // Verify the entered password with the hashed password in the database
        if (password_verify($password, $hashedPassword)) {
            // Login successful, set session variables
            $_SESSION['user_id'] = $id;
            $_SESSION['email'] = $email;
           

            // Redirect to home.php
            header('Location: home.php');
            exit;
        } else {
            // Invalid password
            $loginError = "Invalid email or password!";
        }
    } else {
        // Email not found in database
        $loginError = "Invalid email or password!";
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Medical Team Website</title>
  <style>
    /* Basic reset */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Body styling */
    body {
        font-family: Arial, sans-serif;
        background: url('https://www.softclinicsoftware.com/wp-content/uploads/2020/06/stockfresh_4557865_doctor-holding-smartphone-with-medical-app_sizeL-1-1-1024x695.jpg') no-repeat center center fixed;
        background-size: cover;
        display: flex;
        flex-direction: column;
        height: 100vh;
    }

    /* Navbar container */
    .navbar {
        display: flex;
        align-items: center;
        padding: 10px 20px;
        background-color: rgba(248, 248, 248, 0.9); /* semi-transparent background */
    }

    /* Logo styling */
    .logo {
        display: flex;
        align-items: center;
        margin-right: auto;
    }

    .logo img {
        height: 30px;
        margin-right: 8px;
    }

    .logo span {
        font-size: 18px;
        color: #666;
    }

    /* Navigation links styling */
    .nav-links {
        display: flex;
        gap: 20px;
    }

    .nav-links a {
        text-decoration: none;
        color: #3fa83e;
        font-size: 16px;
    }

    /* Login button styling */
    .login-button {
        padding: 8px 16px;
        background-color: #3fa83e;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
    }

    /* General Styles */
    :root {
      --primary-color: #3fa83e;
      --secondary-color: #53AC33;
      --text-color: #ffffff;
      --background-color: #f5f5f5;
    }

    /* Login Container */
    .login-container {
      background-color: rgba(255, 255, 255, 0.9);
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
      text-align: center;
      margin: 50px auto;
    }

    .login-container h2 {
      color: var(--primary-color);
      margin-bottom: 20px;
    }

    .input-field {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid var(--primary-color);
      border-radius: 5px;
      font-size: 16px;
    }

    .login-btn, .register-btn {
      background-color: var(--secondary-color);
      color: var(--text-color);
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 1rem;
      width: 100%;
      margin-top: 10px;
    }

    .login-btn:hover, .register-btn:hover {
      background-color: #4e8e34;
    }

    .forgot-password {
      color: var(--primary-color);
      text-decoration: none;
      font-size: 14px;
      margin-top: 10px;
      display: inline-block;
    }

    .forgot-password:hover {
      text-decoration: underline;
    }

    /* Footer Styles */
    footer {
      background-color: var(--primary-color);
      color: var(--text-color);
      text-align: center;
      padding: 10px;
      margin-top: auto;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  
  <div class="navbar">
    <div class="logo">
        <img src="https://media.istockphoto.com/id/1312665318/vector/medical-logo-design-vector.jpg?s=612x612&w=0&k=20&c=dp5fFItTDGnZy8j1gB0GVjqVyJPG_Xznp_JTRZFXCXs=" alt="Medical Team Logo">
        <span>Smart Hospital Queue and Bed Allocation System</span>
    </div>

    <div class="nav-links">
        <a href="home.php">Home</a>
        <a href="book.php">Book Bed</a>
        <a href="bookappointment.php">Book Appointment</a>
        <a href="aboutus.php">About Us</a>
        <a href="healthtips.php">Health Tips</a>
    </div>
  </div>

  <!-- Login Container -->
  <div class="login-container">
    <h2>Login to Your Account</h2>

    <?php if (isset($loginError)) { echo "<p style='color:red;'>$loginError</p>"; } ?>

    <form method="POST" action="">
      <input type="email" class="input-field" name="email" placeholder="Enter your email" required>
      <input type="password" class="input-field" name="password" placeholder="Enter your password" required>
      <button type="submit" class="login-btn" name="login">Login</button>
    </form>
    
    <p>New to Medical Team? <button class="register-btn" onclick="window.location.href='register.php'">Register Here</button></p>
    <a href="#" class="forgot-password">Forgot your password?</a>
  </div>

  <footer>
    <p>&copy; 2024 Medical Team | All Rights Reserved</p>
    <p>For inquiries, <a href="mailto:info@medicalteam.com">contact us via email</a>.</p>
    <p>Visit our <a href="#">Privacy Policy</a> and <a href="#">Terms & Conditions</a>.</p>
  </footer>

</body>
</html>
