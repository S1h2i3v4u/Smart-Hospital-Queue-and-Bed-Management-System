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
    <title>Health Tips - Medical Team Website</title>
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

        /* Health Tips Section Styling */
        .health-tips-section {
            padding: 40px 20px;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.8); /* Light background for text readability */
            border-radius: 10px;
            margin-top: 20px;
        }

        .health-tips-content {
            max-width: 800px;
            margin: 20px auto;
            line-height: 1.8;
            font-size: 1.2rem;
            color: var(--primary-color);
        }

        /* Change paragraph color to black */
        .health-tips-content p {
            color: black; /* Set paragraph color to black */
        }

        .tips-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .tip-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            text-align: center;
            padding: 20px;
        }

        .tip-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
        }

        .tip-card h3 {
            margin-top: 15px;
            color: var(--primary-color);
        }

        .tip-card p {
            font-size: 1rem;
            color: #555;
            margin-top: 10px;
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

    <!-- Health Tips Section -->
    <section id="health-tips" class="page">
        <main class="health-tips-section">
            <h1 style="color: var(--primary-color);">Health Tips</h1>
            <div class="health-tips-content">
                <p>
                Health Tips for a Better Lifestyle

Staying healthy is essential for leading a fulfilling life. It’s not just about avoiding illness, but also about making choices that promote physical and mental well-being. Whether you're looking to improve your diet, stay active, or reduce stress, small changes can make a big difference. Incorporating healthy habits into your daily routine can help you feel more energized and improve your overall quality of life. Regular exercise, a balanced diet, hydration, and proper sleep are the foundation of good health. Moreover, mental health is equally important—practicing mindfulness and managing stress are key components of a healthy lifestyle. In this section, we’ll share practical tips to help you stay on track. These tips are simple but powerful and can be easily integrated into your life. Follow these recommendations to feel your best and maintain long-term health.


                </p>
            </div>
            <div class="tips-grid">
                <?php
                // Example health tips, could be fetched from a database
                $healthTips = [
                    ['title' => 'Stay Hydrated', 'description' => 'Drink plenty of water every day to keep your body hydrated and support all bodily functions.', 'img' => 'data:image/jpeg;base64,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'],
                    ['title' => 'Eat a Balanced Diet', 'description' => 'Include a variety of foods in your diet for essential vitamins, minerals, and energy.', 'img' => 'https://media.istockphoto.com/id/1375039697/photo/healthy-fruits-and-vegetables-salad-recipe.jpg?s=612x612&w=0&k=20&c=fvxLJJ94no6klA7n8SUvnpc_0LbfEL82OeiGGGU-wE4='],
                    ['title' => 'Exercise Regularly', 'description' => 'Engage in physical activity for at least 30 minutes a day to improve heart health and boost energy levels.', 'img' => 'https://recxpress.com.au/wp-content/uploads/2019/05/Four-Reasons-You-Should-Be-Exercising-Regularly.jpg'],
                    ['title' => 'Get Enough Sleep', 'description' => 'A good night\'s sleep is essential for mental and physical health. Aim for 7-9 hours each night.', 'img' => 'https://cdn-prod.medicalnewstoday.com/content/images/articles/325/325353/why-is-sleep-important.jpg'],
                ];

                // Loop through health tips and display them
                foreach ($healthTips as $tip) {
                    echo '<div class="tip-card">';
                    echo '<img src="' . htmlspecialchars($tip['img']) . '" alt="' . htmlspecialchars($tip['title']) . '">';
                    echo '<h3>' . htmlspecialchars($tip['title']) . '</h3>';
                    echo '<p>' . htmlspecialchars($tip['description']) . '</p>';
                    echo '</div>';
                }
                ?>
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
