<?php
// Start the session to check if the user is logged in
session_start();

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_id']); // Assuming 'user_id' is stored in session on successful login

// If the user is logged in and tries to access the logout page, destroy the session
if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
    session_unset();  // Remove all session variables
    session_destroy();  // Destroy the session
    header("Location: home.php"); // Redirect to home page after logout
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home - Medical Team Website</title>
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        background: url('https://img.freepik.com/premium-photo/abstract-blur-hospital-interior-corridor-background-with-defocused-effect_441990-15551.jpg?semt=ais_hybrid') no-repeat center center fixed;
        background-size: cover;
        display: flex;
        flex-direction: column;
        min-height: 100vh; /* Ensure body takes full height */
    }

    .navbar {
        display: flex;
        align-items: center;
        padding: 10px 20px;
        background-color: rgba(248, 248, 248, 0.9);
    }

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

    .nav-links {
        display: flex;
        gap: 20px;
    }

    .nav-links a {
        text-decoration: none;
        color: #3fa83e;
        font-size: 16px;
    }

    .login-button {
        text-decoration: none;
        color: #3fa83e;
        font-size: 16px;
        margin-left: 20px;
    }

    .login-button:hover {
        color: #4e8e34;
    }

    .home-container {
        background-color: rgba(255, 255, 255, 0.9);
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 800px;
        margin: 50px auto;
        text-align: center;
    }

    .home-container h1 {
        color: #3fa83e;
        margin-bottom: 20px;
    }

    .home-container p {
        font-size: 18px;
        margin-bottom: 20px;
    }

    .home-container button {
        padding: 10px 20px;
        background-color: #3fa83e;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
    }

    .home-container button:hover {
        background-color: #4e8e34;
    }

    .features-container {
        background-color: rgba(248, 248, 248, 0.9);
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 800px;
        margin: 20px auto;
        text-align: left;
    }

    .features-container h2 {
        color: #3fa83e;
        margin-bottom: 15px;
        text-align: center;
    }

    .features-container ul {
        list-style-type: disc;
        margin-left: 20px;
    }

    .features-container li {
        font-size: 16px;
        color: #333;
        margin-bottom: 8px;
    }

    .features-container li:hover {
        color: #3fa83e;
        background-color: rgba(63, 168, 62, 0.1);
        padding: 8px;
        border-radius: 5px;
    }

    .stats-container {
        background-color: rgba(248, 248, 248, 0.9);
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 800px;
        margin: 20px auto;
        display: flex;
        justify-content: space-around;
        text-align: center;
    }

    .stat-item {
        font-size: 16px;
        color: #333;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .stat-item i {
        font-size: 40px;
        color: #3fa83e;
        margin-bottom: 10px;
    }

    .stat-item p {
        font-size: 18px;
        color: #333;
    }

    .testimonials {
        background-color: rgba(248, 248, 248, 0.9);
        padding: 30px;
        text-align: center;
    }

    .testimonial-item {
        font-size: 18px;
        margin: 20px 0;
        font-style: italic;
    }

    .testimonial-item span {
        display: block;
        font-weight: bold;
        margin-top: 10px;
        color: #3fa83e;
    }

    footer {
        background-color: #3fa83e;
        color: white;
        text-align: center;
        padding: 10px;
        margin-top: auto; /* Push footer to the bottom */
    }
    footer {
    background-color: #3fa83e;
    color: white;
    text-align: center;
    padding: 40px 20px; /* Increased padding for a larger footer */
    margin-top: auto;
}

footer .footer-content p {
    margin: 10px 0;
}

footer a {
    color: white;
    text-decoration: none;
    font-weight: bold;
}

footer a:hover {
    color: #f1f1f1;
}


    .cta-section {
        background-color: #3fa83e;
        color: white;
        text-align: center;
        padding: 40px 20px;
    }

    .cta-section h2 {
        font-size: 32px;
        margin-bottom: 20px;
    }

    .cta-section button {
        padding: 15px 30px;
        background-color: white;
        color: #3fa83e;
        border: none;
        border-radius: 5px;
        font-size: 18px;
        cursor: pointer;
    }

    .cta-section button:hover {
        background-color: #4e8e34;
        color: white;
    }

  </style>
</head>
<body>

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

    <!-- Conditionally render login/logout link -->
    <?php if ($isLoggedIn): ?>
        <!-- Show Logout if user is logged in -->
        <a href="?logout=true" class="login-button">Logout</a>
    <?php else: ?>
        <!-- Show Login if user is not logged in -->
        <a href="login.php" class="login-button">Login</a>
    <?php endif; ?>
  </div>

  <div class="home-container">
    <h1>Welcome to Medical Team</h1>
    <p>Your trusted healthcare provider. Find the best hospitals and specialists near you.</p>

    <!-- Display a message if user is logged in -->
    <?php if ($isLoggedIn): ?>
      <p>Hello, <?php echo htmlspecialchars($_SESSION['user_name']); ?>! You are logged in.</p>
    <?php else: ?>
      <p>Please <a href="login.php">Login</a> to access more features.</p>
    <?php endif; ?>

    <!-- Display Register button only if user is not logged in -->
    <?php if (!$isLoggedIn): ?>
      <button onclick="window.location.href='register.php'">Register</button>
    <?php endif; ?>
  </div>

  <!-- New container for website features -->
  <div class="features-container">
    <h2>Our Website Features</h2>
    <ul>
        <li><i class="fas fa-user-md"></i> Find the best specialists near you</li>
        <li><i class="fas fa-hospital"></i> Easy bed booking system</li>
        <li><i class="fas fa-notes-medical"></i> Health tips and articles</li>
        <li><i class="fas fa-calendar-check"></i> Simple appointment scheduling</li>
    </ul>
  </div>

  <!-- Statistics section -->
  <div class="stats-container">
    <div class="stat-item">
        <i class="fas fa-hospital"></i>
        <p>200+ hospitals partnered</p>
    </div>
    <div class="stat-item">
        <i class="fas fa-stethoscope"></i>
        <p>100+ specialists available</p>
    </div>
  </div>

  <!-- Testimonials section -->
  <div class="testimonials">
    <h3>What Our Patients Say</h3>
    <div class="testimonial-item">
    "The website’s user-friendly design made it easy to find the right hospital and book a bed. Great service!"
        <span>-  Shivani Suryawanshi</span>
    </div>
    <div class="testimonial-item">
        "I was able to find the right specialist and book a bed easily. The service was excellent!" 
        <span>- Shivam Swami</span>
    </div>
    <div class="testimonial-item">
        "The health tips provided by the website helped me a lot in maintaining my health." 
        <span>- Neha Biradar</span>
    </div>
    <div class="testimonial-item">
        "The appointment booking process was smooth, and I received timely medical attention. Highly recommend!" 
        <span>- Aditi Chitnis</span>
    </div>
    
  </div>

  <!-- Call-to-action section -->
  <div class="cta-section">
    <h2>Get Started with Us Today!</h2>
    <button onclick="window.location.href='register.php'">Register Now</button>
  </div>

  <footer>
    <div class="footer-content">
        <p>&copy; 2024 Medical Team. All rights reserved.</p>
        <p>Smart Hospital Queue and Bed Allocation System</p>
        <p>Contact us: info@medicalteam.com</p>
        <p>Follow us on:
            <a href="#">Facebook</a> | 
            <a href="#">Twitter</a> | 
            <a href="#">Instagram</a>
        </p>
    </div>
</footer>


</body>
</html>
