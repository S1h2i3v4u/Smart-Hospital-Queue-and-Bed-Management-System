<?php
// Initialize session
session_start();

// Database configuration
$servername = "localhost";  // Your database server
$username = "root";         // MySQL username
$password = "";             // MySQL password
$dbname = "swati";         // Your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$name = $age = $gender = $email = $password = "";
$nameErr = $ageErr = $genderErr = $emailErr = $passwordErr = "";
$registerSuccess = $registerError = "";

// Handle registration request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get POST data
    $name = $_POST['name'] ?? '';
    $age = $_POST['age'] ?? 0;
    $gender = $_POST['gender'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validate input fields
    if (empty($name)) {
        $nameErr = "Name is required!";
    }
    if (empty($age)) {
        $ageErr = "Age is required!";
    }
    if (empty($gender)) {
        $genderErr = "Gender is required!";
    }
    if (empty($email)) {
        $emailErr = "Email is required!";
    }
    if (empty($password)) {
        $passwordErr = "Password is required!";
    }

    // If no errors, proceed to insert data into database
    if (empty($nameErr) && empty($ageErr) && empty($genderErr) && empty($emailErr) && empty($passwordErr)) {
        // Check if user already exists
        $stmt = $conn->prepare("SELECT id FROM register WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $registerError = "User already exists!";
        } else {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Insert new user into the database
            $stmt = $conn->prepare("INSERT INTO register (name, age, gender, email, password) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sisss", $name, $age, $gender, $email, $hashedPassword);

            if ($stmt->execute()) {
                $registerSuccess = "Registration successful! You can now log in.";
            } else {
                $registerError = "Error during registration: " . $stmt->error;
            }
        }
        $stmt->close();
    }
}

// Close the database connection
$conn->close();
?>

<!-- HTML Form for Registration -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - Medical Team Website</title>
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

    /* Register button styling */
    .register-button {
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

    /* Header Styles */
    header {
      background-color: var(--primary-color);
      color: var(--text-color);
      padding: 20px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .logo img {
      height: 40px;
    }

    nav a {
      color: var(--text-color);
      text-decoration: none;
      margin: 0 15px;
      font-size: 18px;
    }

    nav a:hover {
      text-decoration: underline;
    }

    /* Register Container */
    .register-container {
      background-color: rgba(255, 255, 255, 0.9); /* semi-transparent white */
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
      text-align: center;
      margin: 50px auto;
    }

    .register-container h2 {
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

    .register-btn {
      background-color: var(--secondary-color);
      color: var(--text-color);
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 1rem;
      width: 100%;
      margin-top: 20px;
    }

    .register-btn:hover {
      background-color: #4e8e34;
    }

    .login-link {
      color: var(--primary-color);
      text-decoration: none;
      font-size: 14px;
      margin-top: 10px;
      display: inline-block;
    }

    .login-link:hover {
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

    /* Gender select styling */
    .gender-select {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid var(--primary-color);
      border-radius: 5px;
      font-size: 16px;
    }
    
    .age-input {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid var(--primary-color);
      border-radius: 5px;
      font-size: 16px;
    }
    
  </style>

</head>
<body>
   
  <div class="navbar">
    <div class="logo">
        <img src="https://media.istockphoto.com/id/1312665318/vector/medical-logo-design-vector.jpg?s=612x612&w=0&k=20&c=dp5fFItTDGnZy8j1gB0GVjqVyJPG_Xznp_JTRZFXCXs=" alt="Medical Team Logo">
        <span>Smart Hospital Queue and Bed Allocation System</span>
    </div>
    <!-- Navigation Links -->
    <div class="nav-links">
        <a href="home.php">Home</a>
        <a href="book.php">Book Bed</a>
        <a href="bookappointment.php">Book Appointment</a>
        <a href="aboutus.php">About Us</a>
        <a href="healthtips.php">Health Tips</a>
    </div>

    <!-- Register Button -->
    <button class="register-button">Register</button>
  </div>

  <!-- Register Container -->
  <div class="register-container">
    <h2>Register a New Account</h2>
    
    <!-- Registration Form -->
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <!-- Name Field -->
      <input type="text" class="input-field" name="name" placeholder="Enter your name" value="<?php echo $name;?>" required>
      <span class="error"><?php echo $nameErr;?></span>

      <!-- Age Field -->
      <input type="number" class="age-input" name="age" placeholder="Enter your age" value="<?php echo $age;?>" required min="18" max="100">
      <span class="error"><?php echo $ageErr;?></span>
      
      <!-- Gender Selection -->
      <select class="gender-select" name="gender" required>
        <option value="" disabled selected>Select your gender</option>
        <option value="male" <?php if ($gender == "male") echo "selected";?>>Male</option>
        <option value="female" <?php if ($gender == "female") echo "selected";?>>Female</option>
        <option value="other" <?php if ($gender == "other") echo "selected";?>>Other</option>
      </select>
      <span class="error"><?php echo $genderErr;?></span>

      <!-- Email Field -->
      <input type="email" class="input-field" name="email" placeholder="Enter your email" value="<?php echo $email;?>" required>
      <span class="error"><?php echo $emailErr;?></span>

      <!-- Password Field -->
      <input type="password" class="input-field" name="password" placeholder="Set a password" value="<?php echo $password;?>" required>
      <span class="error"><?php echo $passwordErr;?></span>

      <!-- Register Button -->
      <button type="submit" class="register-btn">Register</button>
    </form>
    
    <p>Already have an account? <a href="login.php" class="login-link">Login here</a></p>

    <!-- Success/Error Messages -->
    <?php if ($registerSuccess): ?>
      <p style="color: green;"><?php echo $registerSuccess; ?></p>
    <?php endif; ?>
    <?php if ($registerError): ?>
      <p style="color: red;"><?php echo $registerError; ?></p>
    <?php endif; ?>
  </div>

  <!-- Footer Section -->
  <footer>
    <p>&copy; 2024 Medical Team | All Rights Reserved</p>
    <p>For inquiries, <a href="mailto:info@medicalteam.com">contact us via email</a>.</p>
    <p>Visit our <a href="#">Privacy Policy</a> and <a href="#">Terms & Conditions</a>.</p>
  </footer>

</body>
</html>
