<?php


// Database connection details
$servername = "localhost";
$username = "root";  // Default username for XAMPP/WAMP
$password = "";  // Default password is empty for XAMPP/WAMP
$dbname = "swati";  // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert data when the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Getting form data
    $state = $_POST['state'];
    $city = $_POST['city'];
    $hospital = $_POST['hospital'];
    $specialization = $_POST['specialization'];
    $booking_date = $_POST['date'];
    $booking_time = $_POST['time'];
    $user_id = 1; // Assuming the user ID is known (you can set it from the session if the user is logged in)

    // SQL query to insert data
    $sql = "INSERT INTO appointments (state, city, hospital, specialization, booking_date, booking_time, user_id) 
            VALUES ('$state', '$city', '$hospital', '$specialization', '$booking_date', '$booking_time', '$user_id')";

    // Check if the query is executed successfully
    if ($conn->query($sql) === TRUE) {
        echo "<script type='text/javascript'>alert('Appointment Booked Successfully');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book an Appointment - Medical Team Website</title>
  <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        background: url('https://img.freepik.com/free-photo/blurred-abstract-background-interior-view-looking-out-toward-empty-office-lobby-entrance-doors-glass-curtain-wall-with-frame_1339-6363.jpg') no-repeat center center fixed;
        background-size: cover;
        display: flex;
        flex-direction: column;
        height: 100vh;
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

    footer {
        background-color: #3fa83e;
        color: white;
        text-align: center;
        padding: 10px;
        margin-top: auto;
    }

    .book-bed-container {
        background-color: rgba(255, 255, 255, 0.9);
        padding: 30px;
        border-radius: 10px;
        width: 100%;
        max-width: 800px;
        margin: 50px auto;
        text-align: center;
    }

    .book-bed-container h1 {
        color: #3fa83e;
        margin-bottom: 20px;
    }

    .book-bed-container select,
    .book-bed-container input[type="date"],
    .book-bed-container input[type="time"] {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .book-bed-container button {
        padding: 10px 20px;
        background-color: #3fa83e;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
    }

    .book-bed-container button:hover {
        background-color: #4e8e34;
    }
  </style>
  <script>
    function updateHospitals() {
        var city = document.getElementById("city").value;
        var hospitalSelect = document.getElementById("hospital");

        hospitalSelect.innerHTML = "";

        // List of hospitals by city (State-wise)
        var hospitals = {
            "Maharashtra": {
                "Pune": [
                    "Sahyadri Hospital", 
                    "Ruby Hall Clinic", 
                    "KEM Hospital", 
                    "Jehangir Hospital", 
                    "Deenanath Mangeshkar Hospital", 
                    "Pune N M Wadia Hospital",
                    "Aditya Birla Memorial Hospital",
                    "Kokilaben Dhirubhai Ambani Hospital",
                    "Mayo Hospital", 
                    "Cloudnine Hospital"
                ],
                "Mumbai": [
                    "Lilavati Hospital", 
                    "Fortis Hospital", 
                    "Breach Candy Hospital", 
                    "Kokilaben Dhirubhai Ambani Hospital", 
                    "Hiranandani Hospital", 
                    "S L Raheja Hospital",
                    "Leelavati Hospital", 
                    "Jaslok Hospital",
                    "Nanavati Super Speciality Hospital", 
                    "P.D. Hinduja National Hospital"
                ],
                "Latur": [
                    "Sushrut Hospital", 
                    "Dr. Ramesh Hospital", 
                    "Matoshri Hospital", 
                    "Ashirwad Hospital", 
                    "Shree Hospital", 
                    "Sanjeevani Hospital",
                    "Sai Hospital", 
                    "Vishal Hospital"
                ]
            },
            "Karnataka": {
                "Bengaluru": [
                    "Manipal Hospital", 
                    "BGS Gleneagles Global Hospital", 
                    "Fortis La Femme Hospital", 
                    "Sakra Premium Hospital", 
                    "St. John's Medical College Hospital",
                    "Narayana Health", 
                    "Aster CMI Hospital",
                    "Bangalore Baptist Hospital", 
                    "Sri Shankara Cancer Foundation"
                ]
            }
        };

        var state = document.getElementById("state").value;
        var cityHospitals = hospitals[state] ? hospitals[state][city] : [];

        cityHospitals.forEach(function(hospital) {
            var option = document.createElement("option");
            option.value = hospital;
            option.textContent = hospital;
            hospitalSelect.appendChild(option);
        });
    }

    function updateCities() {
        var state = document.getElementById("state").value;
        var citySelect = document.getElementById("city");

        var cities = {
            "Maharashtra": ["Pune", "Mumbai", "Latur"],
            "Karnataka": ["Bengaluru"]
        };

        citySelect.innerHTML = "";
        cities[state].forEach(function(city) {
            var option = document.createElement("option");
            option.value = city;
            option.textContent = city;
            citySelect.appendChild(option);
        });

        updateHospitals();
    }

    window.onload = function() {
        updateCities();
    };
  </script>
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

    <div class="nav-links">
        <?php if ($isLoggedIn): ?>
            <a href="logout.php" class="login-button">Logout</a>
        <?php else: ?>
            <a href="login.php" class="login-button">Login</a>
        <?php endif; ?>
    </div>
  </div>

  <div class="book-bed-container">
    <h1>Book an Appointment</h1>
    <form method="POST" action="">
        <label for="state">Select State</label>
        <select id="state" name="state" required onchange="updateCities()">
            <option value="Maharashtra">Maharashtra</option>
            <option value="Karnataka">Karnataka</option>
        </select>

        <label for="city">Select City</label>
        <select id="city" name="city" required onchange="updateHospitals()">
            <!-- City options will be dynamically populated -->
        </select>

        <label for="hospital">Select Hospital</label>
        <select id="hospital" name="hospital" required>
            <!-- Hospital options will be dynamically populated -->
        </select>

        <label for="specialization">Select Specialization</label>
        <select name="specialization" id="specialization" required>
            <option value="Cardiology">Cardiology</option>
            <option value="Neurology">Neurology</option>
            <option value="Orthopedics">Orthopedics</option>
            <option value="Pediatrics">Pediatrics</option>
            <option value="General Surgery">General Surgery</option>
            <option value="Obstetrics & Gynecology">Obstetrics & Gynecology</option>
        </select>

        <label for="date">Select Date</label>
        <input type="date" id="date" name="date" required>

        <label for="time">Select Time</label>
        <input type="time" id="time" name="time" required>

        <button type="submit">Book Appointment</button>
    </form>
  </div>

  <footer>
    <p>&copy; 2024 Smart Hospital Queue and Bed Allocation System. All rights reserved.</p>
  </footer>

</body>
</html>
