<?php
session_start();

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_id']);
if (!$isLoggedIn) {
    echo "You must be logged in to book a bed.";
    exit;
}

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "swati";

// Create a new connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form input values
    $state = $_POST['state'];
    $city = $_POST['city'];
    $hospital = $_POST['hospital'];
    $bed_type = $_POST['bed_type'];
    $booking_date = $_POST['date'];
    $user_id = $_SESSION['user_id'];  // User ID from session

    // SQL query to insert the data into the bedbookings table
    $sql = "INSERT INTO bedbookings (state, city, hospital, bed_type, booking_date, user_id) 
            VALUES (?, ?, ?, ?, ?, ?)";

    // Prepare the SQL statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters to the SQL query
        $stmt->bind_param("sssssi", $state, $city, $hospital, $bed_type, $booking_date, $user_id);

        // Execute the query
        if ($stmt->execute()) {
            // Show success message
            echo "<script type='text/javascript'>alert('Bed Booked Successfully');</script>";
        } else {
            // Show error message if query fails
            echo "Error during insertion: " . $stmt->error;
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // Show error message if query preparation fails
        echo "Error preparing SQL statement: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book a Bed - Medical Team Website</title>
  <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        background: url('https://www.softclinicsoftware.com/wp-content/uploads/2020/06/stockfresh_4557865_doctor-holding-smartphone-with-medical-app_sizeL-1-1-1024x695.jpg') no-repeat center center fixed;
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
    .book-bed-container input[type="date"] {
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
    // Function to update hospitals based on city selection
    function updateHospitals() {
        var city = document.getElementById("city").value;
        var hospitalSelect = document.getElementById("hospital");
        
        // Clear existing options
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
        ],
        "Nagpur": [
            "Orange City Hospital", 
            "Kailash Hospital", 
            "Medicover Hospital", 
            "Care Hospital", 
            "Nagpur Hospital",
            "Avanti Hospital", 
            "Wockhardt Hospital"
        ],
        "Aurangabad": [
            "Dr. K. B. Wagh Hospital", 
            "Aurangabad Medical Center", 
            "Hinduja Hospital", 
            "Laxmi Hospital",
            "Sanjay Gandhi Hospital",
            "Medicover Hospital"
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
        ],
        "Mysuru": [
            "Mysuru Hospital", 
            "JSS Hospital", 
            "Krishna Hospital",
            "KRS Hospital", 
            "Sreeraj Hospital"
        ]
    },
    "Tamil Nadu": {
        "Chennai": [
            "Apollo Hospital", 
            "Kaveri Hospital", 
            "MIOT International", 
            "Fortis Malar Hospital", 
            "Billroth Hospital",
            "SRM Hospital",
            "Madras Medical Mission", 
            "Global Hospital", 
            "The Kings Hospital", 
            "Vijaya Hospital"
        ],
        "Coimbatore": [
            "GKNM Hospital", 
            "PSG Hospitals", 
            "Cure Hospital",
            "KMCH Hospital", 
            "Aishwarya Hospital"
        ]
    },
    "Uttar Pradesh": {
        "Lucknow": [
            "King George's Medical University", 
            "Rama Medical College Hospital", 
            "SGPGI Hospital", 
            "Lokbandhu Hospital", 
            "Kashi Hospital",
            "Shri Ram Hospital"
        ],
        "Varanasi": [
            "Banaras Hindu University Hospital", 
            "Pandit Deen Dayal Upadhyay Hospital", 
            "VSS Medical College", 
            "Shri Hari Hospital"
        ]
    },
    "Gujarat": {
        "Ahmedabad": [
            "Apollo Hospitals", 
            "HCG Cancer Center", 
            "Medicare Hospital", 
            "Sterling Hospital", 
            "Shalby Hospital", 
            "Kokilaben Dhirubhai Ambani Hospital", 
            "V S Hospital"
        ],
        "Surat": [
            "Surat Municipal Institute of Medical Education & Research", 
            "Sanjivani Hospital", 
            "Shree Hari Hospital"
        ]
    },
    "Rajasthan": {
        "Jaipur": [
            "Fortis Escorts Hospital", 
            "Manipal Hospital", 
            "Sawai Man Singh Hospital", 
            "Mahatma Gandhi Hospital", 
            "Rajasthan Hospital"
        ],
        "Udaipur": [
            "M.B. Hospital", 
            "Arvind Eye Hospital", 
            "Shree Gopi Hospital"
        ]
    },
    "West Bengal": {
        "Kolkata": [
            "Belle Vue Clinic", 
            "AMRI Hospitals", 
            "Medica Super Specialty Hospital", 
            "R.N. Tagore International Institute of Cardiac Sciences", 
            "Calcutta Medical College"
        ]
    },
    "Delhi": {
        "New Delhi": [
            "All India Institute of Medical Sciences", 
            "Fortis Escorts Heart Institute", 
            "Indraprastha Apollo Hospital", 
            "Max Super Specialty Hospital", 
            "AIIMS Trauma Centre"
        ]
    },
    "Haryana": {
        "Gurugram": [
            "Medanta - The Medicity", 
            "Fortis Memorial Research Institute", 
            "Artemis Hospital", 
            "Park Hospital"
        ]
    },
    "Punjab": {
        "Chandigarh": [
            "PGI Chandigarh", 
            "Fortis Hospital", 
            "Max Super Specialty Hospital", 
            "Chandigarh Hospital"
        ]
    },
    "Madhya Pradesh": {
        "Indore": [
            "Choithram Hospital", 
            "Sri Aurobindo Institute of Medical Sciences", 
            "Medi-Caps Hospital", 
            "LPS Institute of Cardiology"
        ],
        "Bhopal": [
            "Hamidia Hospital", 
            "Sultan Hospital", 
            "Dr. B.R. Ambedkar Memorial Hospital"
        ]
    },
    "Kerala": {
        "Kochi": [
            "Amrita Institute of Medical Sciences", 
            "Sree Chitra Tirunal Institute for Medical Sciences", 
            "Kochi Medical College"
        ],
        "Thiruvananthapuram": [
            "Regional Cancer Centre", 
            "Kerala Institute of Medical Sciences", 
            "Sree Chitra Tirunal Hospital"
        ]
    },
    "Andhra Pradesh": {
        "Visakhapatnam": [
            "Kamineni Hospitals", 
            "Aster Prime Hospital", 
            "Dr. Pinnamaneni Siddhartha Institute of Medical Sciences"
        ]
    }
};

        // Get selected state
        var state = document.getElementById("state").value;
        var cityHospitals = hospitals[state] ? hospitals[state][city] : [];

        // Populate hospitals dropdown based on selected city
        cityHospitals.forEach(function(hospital) {
            var option = document.createElement("option");
            option.value = hospital;
            option.textContent = hospital;
            hospitalSelect.appendChild(option);
        });
    }

    // Update cities when state changes
    function updateCities() {
        var state = document.getElementById("state").value;
        var citySelect = document.getElementById("city");
        
        // List of cities by state
        var cities = {
            "Maharashtra": ["Pune", "Mumbai", "Latur", "Nagpur", "Aurangabad"],
            "Karnataka": ["Bengaluru", "Mysuru"],
            "Tamil Nadu": ["Chennai", "Coimbatore"]
        };

        // Clear existing options and populate cities
        citySelect.innerHTML = "";
        cities[state].forEach(function(city) {
            var option = document.createElement("option");
            option.value = city;
            option.textContent = city;
            citySelect.appendChild(option);
        });

        // Update hospitals based on the selected city
        updateHospitals();
    }

    // Initialize cities on page load
    window.onload = function() {
        updateCities();
    };
  </script>
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

    <!-- Conditionally display Login or Logout -->
    <div class="nav-links">
        <?php if ($isLoggedIn): ?>
            <a href="logout.php" class="login-button">Logout</a>
        <?php else: ?>
            <a href="login.php" class="login-button">Login</a>
        <?php endif; ?>
    </div>
  </div>

  <!-- Book Bed Form -->
  <div class="book-bed-container">
    <h1>Book a Bed</h1>
    <form method="POST" action="">
        <label for="state">Select State</label>
        <select id="state" name="state" required onchange="updateCities()">
            <option value="Maharashtra">Maharashtra</option>
            <option value="Karnataka">Karnataka</option>
            <option value="Tamil Nadu">Tamil Nadu</option>
        </select>

        <label for="city">Select City</label>
        <select id="city" name="city" required onchange="updateHospitals()">
            <!-- Cities will be populated based on the selected state -->
        </select>

        <label for="hospital">Select Hospital</label>
        <select id="hospital" name="hospital" required>
            <!-- Hospitals will be populated based on the selected city -->
        </select>

        <label for="bed-type">Select Bed Type</label>
        <select id="bed-type" name="bed_type" required>
            <option value="General">General</option>
            <option value="VIP">VIP</option>
            <option value="ICU">ICU</option>
        </select>

        <label for="date">Select Date</label>
        <input type="date" id="date" name="date" required>

        <button type="submit">Book Bed</button>
    </form>
  </div>

  <footer>
    <p>&copy; 2024 Medical Team | All Rights Reserved</p>
    <p>For inquiries, <a href="mailto:info@medicalteam.com">contact us via email</a>.</p>
    <p>Visit our <a href="#">Privacy Policy</a> and <a href="#">Terms & Conditions</a>.</p>
  </footer>

</body>
</html>
