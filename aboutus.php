<?php
// Start the session if needed
session_start();

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_id']); // Assuming 'user_id' is stored in session on successful login
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Medical Team Website</title>
    <style>
        /* Include your styles here */
        :root {
            --primary-color: #3fa83e; /* Define primary color */
        }

        /* Body Styling with Background Image */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('https://www.softclinicsoftware.com/wp-content/uploads/2020/06/stockfresh_4557865_doctor-holding-smartphone-with-medical-app_sizeL-1-1-1024x695.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        /* Navbar Styling */
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

        /* About Us Section Styling */
        .about-us-section {
            padding: 40px 20px;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.8); /* Light background for text readability */
            border-radius: 10px;
            margin-top: 20px;
        }

        .about-us-content {
            max-width: 800px;
            margin: 20px auto;
            line-height: 1.8;
            font-size: 1.2rem;
            color: var(--primary-color);
        }

        /* Change paragraph color to black */
        .about-us-content p {
            color: black; /* Set paragraph color to black */
        }

        .team {
            margin-top: 40px;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .team-member {
            text-align: center;
        }

        .team-member p {
            margin-top: 10px;
            font-size: 1.2rem;
            color: var(--primary-color);
        }

        /* Footer Styling */
        footer {
            background-color: #3fa83e;
            color: white;
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

        <!-- Conditionally render login/logout link -->
        <?php if ($isLoggedIn): ?>
            <a href="logout.php" class="login-button">Logout</a>
        <?php else: ?>
            <a href="login.php" class="login-button">Login</a>
        <?php endif; ?>
    </div>

    <!-- About Us Section -->
    <section id="about-us" class="page">
        <main class="about-us-section">
            <h1 style="color: var(--primary-color);">About Us</h1>
            <div class="about-us-content">
                <p>
                    Welcome to the Medical Team platform, your trusted partner in streamlining healthcare services. Our mission is to create a bridge between
                    patients and healthcare providers, ensuring timely care and accessibility. Whether it's booking OPD appointments, checking bed availability,
                    or accessing specialized care, we're here to simplify healthcare for you.
                </p>
                <p>
                    Together, we aim to build a smarter and more integrated healthcare ecosystem, connecting hospitals across the city and empowering communities.
                </p>
            </div>
            <div class="team">
                <h2 style="color: var(--primary-color);">Meet Our Team</h2>
                <div class="team-grid">
                    <?php
                    // Example of dynamic team members, could be fetched from a database
                    $teamMembers = [
                        ['name' => 'Shivani Suryawanshi', 'role' => 'Project Member'],
                        ['name' => 'Shivam Swami', 'role' => 'Project Member'],
                        ['name' =>  'Neha Biradar', 'role' => 'Project Member'],
                        ['name' => 'Aditi Chitnis ', 'role' => 'Project Member']
                       
                    ];

                    // Loop through team members and display them
                    foreach ($teamMembers as $member) {
                        echo '<div class="team-member">';
                        echo '<p>' . htmlspecialchars($member['name']) . '</p>';
                        echo '<p>' . htmlspecialchars($member['role']) . '</p>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </main>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Medical Team | All Rights Reserved</p>
        <p>For inquiries, <a href="mailto:info@medicalteam.com">contact us via email</a>.</p>
        <p>Visit our <a href="#">Privacy Policy</a> and <a href="#">Terms & Conditions</a>.</p>
    </footer>

</body>
</html>
